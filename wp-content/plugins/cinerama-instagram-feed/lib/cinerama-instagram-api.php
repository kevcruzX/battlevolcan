<?php
if(!defined('ABSPATH')) exit;

include 'cinerama-instagram-helper.php';

/**
 * Class CineramaInstagramApi
 */
class CineramaInstagramApi {
    /**
     * @var string ID of Instagram application
     */
    private $clientID;
    /**
     * @var string secret code of Instagram application
     */
    private $clientSecret;
    /**
     * @var string URL to which to redirect user after he has allowed access.
     * It's the same as in Instagram application
     */
    private $redirectUri;
    /**
     * @var string type of connection that want to make
     * Can be 'code' or 'token'. We are using 'code' because it's more secure
     */
    private $responseType;
    /**
     * @var mixed|void code that was returned by Instagram.
     * Based on this code we get access token that we use for communication with API
     */
    private $code;
    /**
     * @var mixed|void access token that we send on each request to the API
     */
    private $accessToken;
    /**
     * @var mixed|void Instagram ID of authenticated user
     */
    private $userID;
    /**
     * @var string URL from which we get access token after code is received
     */
    private $tokenURL;
    /**
     * @var string URL from which we fetch data
     */
    private $apiURL;
    /**
     * @var CineramaInstagramApi instance of current class
     */
    private static $instance;

    /**
     * Helper object
     * @var CineramaInstagramHelper
     */
    private $helper;

    const CODE_OPTION_NAME = 'cinerama_instagram_code';
    const USER_ID_OPTION_NAME = 'cinerama_instagram_user_id';
    const ACCESS_TOKEN_OPTION_NAME = 'cinerama_instagram_access_token';
    const CODE_REDIRECT_URI_OPTION_NAME = 'cinerama_instagram_code_redirect_uri';

    /**
     * Private constructor because of singletone pattern. It sets all necessary properties
     */
    private function __construct() {
        $this->clientID = '0eea5a600b98497b8ab3de39e3fcaf84';
        $this->clientSecret = '36e46446ad40495cb0deaa1595b47184';
        $this->redirectUri = defined( 'EDGE_PROFILE_SLUG' ) ?  'http://demo.' . EDGE_PROFILE_SLUG . '-themes.com/instagram-app/instagram-redirect.php' : '';
        $this->responseType = 'code';
        $this->tokenURL = 'https://api.instagram.com/oauth/access_token';
        $this->code = get_option(self::CODE_OPTION_NAME);
        $this->userID = get_option(self::USER_ID_OPTION_NAME);
        $this->accessToken = get_option(self::ACCESS_TOKEN_OPTION_NAME);
        $this->apiURL = 'https://api.instagram.com/v1';
        $this->helper = new CineramaInstagramHelper();
    }


    /**
     * Must override magic method because of singletone
     */
    private function __clone() {}

    /**
     * Must override magic method because of singletone
     */
    private function __wakeup() {}

    /**
     * @return string
     */
    public function getResponseType() {
        return $this->responseType;
    }

    /**
     * @return CineramaInstagramApi
     */
    public static function getInstance() {
        if(self::$instance === null) {
            return new self();
        }

        return self::$instance;
    }

    /**
     * @return string
     */
    public function getClientID() {
        return $this->clientID;
    }

    /**
     *
     * @return string
     *
     * @see CineramaInstagramApi::buildCurrentPageURI()
     */
    public function getRedirectUri() {
        return $this->redirectUri.'?redirect_uri='.$this->buildCurrentPageURI();
    }

    /**
     * @return CineramaInstagramHelper
     */
    public function getHelper() {
        return $this->helper;
    }

    /**
     * Builds current page url that we use to redirect user to the page from which
     * he made request to sign in to Instagram.
     * @return string
     */
    private function buildCurrentPageURI() {
        $protocol = is_ssl() ? 'https' : 'http';
        $site     = $_SERVER['SERVER_NAME'];
        $slug     = $_SERVER['REQUEST_URI'];

        return urlencode($protocol.'://'.$site.$slug);
    }

    /**
     * Saves code redirect uri to database. It will be used when requesting token
     */
    public function storeCodeRequestURI() {
        update_option(self::CODE_REDIRECT_URI_OPTION_NAME, $this->getRedirectUri());
    }

    /**
     * Saves code that will be used when requesting token
     */
    public function storeCode() {
        if(!empty($_GET['code'])) {
            $this->code = $_GET['code'];
            update_option(self::CODE_OPTION_NAME, $_GET['code']);
        }
    }

    /**
     * Retrieves images data from Instagram
     * @param int $limit
     * @param array $transient transient config
     * @return mixed returns either array of retrieved data if request was successful, or it returns false if it wasn't
     *
     * @see CineramaInstagramApi::fetchData()
     */
    public function getImages($limit = '', $tag = '', $transient = array()) {
        $response = $this->fetchData($limit, $tag, $transient);

        if(property_exists($response, 'status') && $response->status == 'ok') {
            return $response->data;
        }

        return false;
    }

    /**
     * Gets requested data from Instagram API
     *
     * @param int $limit how much images to retrieve
     * @param array $transient transient config
     * @return stdClass
     *
     * @see CineramaInstagramApi::getAccessToken()
     */
    private function fetchData($limit = '', $tag = '', $transient = array('use_transient' => false)) {
        $returnObject = new stdClass();

        //if access_token isn't stored in db
        if(!get_option(self::ACCESS_TOKEN_OPTION_NAME)) {
            //get token
            $tokenObject = $this->getAccessToken();

            //if token wasn't retrieved for any reason
            if($tokenObject->status !== 'ok') {
                $returnObject->status = $tokenObject->status;
                $returnObject->message = $tokenObject->message;

                //return object that contains error code and message
                return $returnObject;
            }
        }

        //do we use transient and does it exists in the database?
        if($this->useTransients($transient) && get_transient($transient['transient_name'])) {
            //get transient value
            $data = get_transient($transient['transient_name']);
        } else {
            if($tag !== '') {
                //request data from API
                $httpResponse = wp_remote_get($this->apiURL.'/tags/'.$tag.'/media/recent/?access_token='.$this->accessToken.'&count='.$limit);
            } else {
                //request data from API
                $httpResponse = wp_remote_get($this->apiURL.'/users/'.$this->userID.'/media/recent/?access_token='.$this->accessToken.'&count='.$limit);
            }

            //parse returned JSON response to assoc array
            $httpBody = json_decode($httpResponse['body'], true);

            //is response an error or if response code is somethinf different than ok?
            if(is_wp_error($httpResponse) || (isset($httpBody['meta']['code']) && $httpBody['meta']['code'] !== 200)) {
                $returnObject->status = 'error';
                $returnObject->message = esc_html__('Can\'t connect with Instagram', 'cinerama-instagram-feed');

                return $returnObject;
            }

            $data = $httpBody['data'];

            //do we use transients?
            if($this->useTransients($transient)) {
                //store transient so we can use it later
                set_transient($transient['transient_name'], $data, $transient['transient_time']);
            }
        }

        if((count($data) > $limit) && $limit !== '') {
            $data = array_slice($data, 0, $limit);
        }

        //prepare return object and return it
        $returnObject->status = 'ok';
        $returnObject->message = esc_html__('Success', 'cinerama-instagram-feed');
        $returnObject->data = $data;

        return $returnObject;
    }

    /**
     * Gets access token from Instagram auth based on code that we retrieved when user allowed us access
     * @return stdClass return object. Contains status attribute and message attribute
     */
    public function getAccessToken() {
        $returnObject = new stdClass();

        //if code property is empty, user hasn't allowed us access
        if(empty($this->code)) {
            $returnObject->status = 'error';
            $returnObject->message = esc_html__('User hasn\'t connected with Instagram', 'cinerama-instagram-feed');

            return $returnObject;
        } else {
            $getTokenArgs = array(
                'body' => array(
                    'client_id' => $this->clientID,
                    'client_secret' => $this->clientSecret,
                    'grant_type' => 'authorization_code',
                    'redirect_uri' => urldecode(get_option(self::CODE_REDIRECT_URI_OPTION_NAME)),
                    'code' => $this->code
                )
            );

            //request access token from Instagram
            $httpResponse = wp_remote_post($this->tokenURL, $getTokenArgs);

            //check if response wasn't successful
            if(is_wp_error($httpResponse) || (isset($httpResponse['response']['code']) && $httpResponse['response']['code'] !== 200)) {
                $returnObject->status = 'error';
                $returnObject->message = esc_html__('Can\'t connect with Instagram API', 'cinerama-instagram-feed');

                return $returnObject;
            }

            //parse json response from API to assoc array
            $responseBody = json_decode($httpResponse['body'], true);

            //if access token was returned store it to database. Also store user id
            if(isset($responseBody['access_token']) && isset($responseBody['user']['id'])) {
                update_option(self::ACCESS_TOKEN_OPTION_NAME, $responseBody['access_token']);
                update_option(self::USER_ID_OPTION_NAME, $responseBody['user']['id']);
                $this->accessToken = $responseBody['access_token'];
                $this->userID = $responseBody['user']['id'];
            } else {
                $returnObject->status = 'error';
                $returnObject->message = esc_html__('Can\'t get Instagram access token', 'cinerama-instagram-feed');

                return $returnObject;
            }
        }

        //prepare return object and return it
        $returnObject->status = 'ok';
        $returnObject->message = esc_html__('Stored access token', 'cinerama-instagram-feed');

        return $returnObject;
    }

    /**
     * Check if user has authorized our application
     * @return bool
     */
    public function hasUserConnected() {
        $accessToken = get_option(self::ACCESS_TOKEN_OPTION_NAME);

        return !empty($accessToken);
    }

    /**
     * Checks whether transient config array is set to use transients or not
     * @param $transientConfig associative array of transient configuration
     * @return bool
     */
    private function useTransients($transientConfig) {
        return (isset($transientConfig['use_transients']) && $transientConfig['use_transients']) && (!empty($transientConfig['transient_time']));
    }

    /**
     * Generates authorize URL which is used to allow access to our application and get instagram code
     * @return string
     */
    public function getAuthorizeUrl() {
        return 'https://api.instagram.com/oauth/authorize?client_id='.$this->getClientID().'&redirect_uri='.$this->getRedirectUri().'&response_type='.$this->getResponseType();
    }
}