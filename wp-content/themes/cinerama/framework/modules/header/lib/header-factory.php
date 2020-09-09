<?php
namespace CineramaEdgeNamespace\Modules\Header\Lib;

/**
 * Class that builds header object and holds reference to it
 *
 * Class HeaderFactory
 */
class HeaderFactory {
    /**
     * Instance of current class
     *
     * @var
     */
    private static $instance;
    /**
     * Instance of HeaderType
     *
     * @var
     */
    private $headerObject;

    /**
     * Private construct because of singletone
     */
    private function __construct() {
    }

    /**
     * Private construct because of singletone
     */
    private function __clone() {
    }

    /**
     * Private construct because of singletone
     */
    private function __wakeup() {
    }

    /**
     * Returns current header object
     *
     * @return mixed
     */
    public function getHeaderObject() {
        return $this->headerObject;
    }

    /**
     * Returns instance of current class
     *
     * @return HeaderFactory
     */
    public static function getInstance() {
        if(self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Checks if header object, whether passed as parameter or not, is valid object that extends HeaderType class
     *
     * @param null $header_object
     *
     * @return bool
     */
    public function validHeaderObject($header_object = null) {
        $header_object = $header_object == null ? $this->headerObject : $header_object;

        return is_subclass_of($header_object, 'CineramaEdgeNamespace\Modules\Header\Lib\HeaderType');
    }

    /**
     * Builds header object based on option read from database
     *
     * @param string $headerType value read from database
     * @param array $headerTypesOption
     *
     * @return bool|HeaderType
     */
    public function build($headerType, $headerTypesOption) {
		if(!empty($headerType) && !empty($headerTypesOption)) {
			foreach ($headerTypesOption as $header_type_option_key => $header_type_option_value) {
				if($headerType === $header_type_option_key) {
					$this->headerObject = new $header_type_option_value;
					
					break;
				}
			}
			
			return $this->headerObject;
		} else {
			return false;
		}
    }
}