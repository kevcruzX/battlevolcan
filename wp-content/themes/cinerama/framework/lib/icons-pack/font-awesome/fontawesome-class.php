<?php

if ( ! function_exists( 'cinerama_edge_add_font_awesome_icon_pack' ) ) {
	function cinerama_edge_add_font_awesome_icon_pack( $iconCollections ) {
		$iconCollections['font_awesome'] = new CineramaEdgeClassIconsFontAwesome( 'Font Awesome', 'fa_icon' );
		
		return $iconCollections;
	}
	
	add_filter( 'cinerama_edge_filter_add_icon_pack_into_collection', 'cinerama_edge_add_font_awesome_icon_pack' );
}

if ( ! function_exists( 'cinerama_edge_add_font_awesome_icon_pack_option' ) ) {
	function cinerama_edge_add_font_awesome_icon_pack_option( $options ) {
		$options['font_awesome'] = esc_html__( 'Font Awesome', 'cinerama' );
		
		return $options;
	}
	
	add_filter( 'cinerama_edge_filter_add_icon_pack_into_options', 'cinerama_edge_add_font_awesome_icon_pack_option' );
	add_filter( 'cinerama_edge_filter_add_icon_pack_into_social_options', 'cinerama_edge_add_font_awesome_icon_pack_option' );
}

class CineramaEdgeClassIconsFontAwesome implements iCineramaEdgeInterfaceIconCollection {
	public $icons;
	public $title;
	public $param;
	public $styleUrl;

	function __construct($title_label = "", $param = "") {
		$this->icons = array();
		$this->socialIcons = array();
		$this->title = $title_label;
		$this->param = $param;
		$this->setIconsArray();
		$this->setSocialIconsArray();
		$this->styleUrl = EDGE_FRAMEWORK_ICONS_ROOT . '/font-awesome/css/fontawesome-all.min.css';
	}

	private function setIconsArray() {
		$this->icons = $this->getNewIconsArray();
	}

    /**
     * Checks if icon collection has social icons
     * @return mixed
     */
    public function hasSocialIcons() {
        return true;
    }

    public function setSocialIconsArray() {
		$this->socialIcons = $this->getNewIconsArray( true );
	}

	public function getIconsArray() {
		return $this->icons;
	}

	public function getSocialIconsArray() {
		return $this->socialIcons;
	}
	
	public function getSocialIconsArrayVC() {
		return array_flip( $this->getSocialIconsArray() );
	}
	
	/*
	 * Function will return new FontAwesome icons array
	 *
	 * @params boolean $brandsIcons - set true to get brands icons array
	 */
	private function getNewIconsArray( $brandsIcons = false ) {
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		
		global $wp_filesystem;
		WP_Filesystem();
		
		$icons = json_decode( $wp_filesystem->get_contents( EDGE_FRAMEWORK_ICONS_ROOT_DIR . '/font-awesome/icons.json' ) );
		
		$iconsArray = array( '' => '' );
		if ( ! empty( $icons ) ) {
			foreach ( $icons as $key => $value ) {
				$iconLabel = ucwords( str_replace( '-', ' ', $value->label ) );
				
				if ( $brandsIcons ) {
					if ( in_array( 'brands', $value->styles ) ) {
						$iconsArray[ 'fab fa-' . $key ] = $iconLabel;
					}
				} else {
					$iconsArray[ $iconLabel ] = ( in_array( 'brands', $value->styles ) ? 'fab' : 'fa' ) . ' fa-' . $key;
				}
			}
		}
		
		return $iconsArray;
		
		/***
		 ** Old way to parse css file
		 ** $pattern = '/\.(fa-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
		 ** $subject = file_get_contents( str_replace( '.min', '', $this->styleUrl ) );
		 **
		 ** preg_match_all( $pattern, $subject, $matches, PREG_SET_ORDER );
		 **
		 ** $icons = array();
		 **
		 ** foreach ( $matches as $match ) {
		 ** 	$icons[ "'" . $match[1] . "'" ] = "'" . $match[2] . "',";
		 ** }
		 ** ksort( $icons );
		 ** echo '<pre>';
		 ** print_r( $icons );
		 ** echo '</pre>';
		 ***/
	}
	
	public function render( $icon, $params = array() ) {
		$html = '';
		extract( $params );
		$iconAttributesString = '';
		$iconClass            = '';
		
		if ( isset( $icon_attributes ) && count( $icon_attributes ) ) {
			foreach ( $icon_attributes as $icon_attr_name => $icon_attr_val ) {
				if ( $icon_attr_name === 'class' ) {
					$iconClass = $icon_attr_val;
					unset( $icon_attributes[ $icon_attr_name ] );
				} else {
					$iconAttributesString .= $icon_attr_name . '="' . $icon_attr_val . '" ';
				}
			}
		}
		
		if ( isset( $before_icon ) && $before_icon !== '' ) {
			$beforeIconAttrString = '';
			if ( isset( $before_icon_attributes ) && count( $before_icon_attributes ) ) {
				foreach ( $before_icon_attributes as $before_icon_attr_name => $before_icon_attr_val ) {
					$beforeIconAttrString .= $before_icon_attr_name . '="' . $before_icon_attr_val . '" ';
				}
			}
			
			$html .= '<' . $before_icon . ' ' . $beforeIconAttrString . '>';
		}
		
		$html .= '<i class="edgtf-icon-font-awesome ' . $icon . ' ' . $iconClass . '" ' . $iconAttributesString . '></i>';
		
		if ( isset( $before_icon ) && $before_icon !== '' ) {
			$html .= '</' . $before_icon . '>';
		}
		
		return $html;
	}

	public function getSearchIcon() {

		return $this->render('fa fa-search');
	}

	public function getSearchClose() {

		return $this->render('fa fa-times');
	}

	public function getDropdownCartIcon() {

		return $this->render('fa fa-shopping-basket');
	}

	public function getMenuIcon() {

		return $this->render('fa fa-bars');
	}

	public function getMenuCloseIcon() {

		return $this->render('fa fa-times');
	}

	public function getBackToTopIcon() {

		return $this->render('fa fa-angle-up');
	}

	public function getMobileMenuIcon() {

		return $this->render('fa fa-bars');
	}

	public function getQuoteIcon() {

		return $this->render('fa fa-quote-left');
	}

	public function getFacebookIcon() {

		return 'fab fa-facebook';
	}

	public function getTwitterIcon() {

		return 'fab fa-twitter';
	}

	public function getGooglePlusIcon() {

		return 'fab fa-google-plus';
	}

	public function getLinkedInIcon() {

		return 'fab fa-linkedin';
	}

	public function getTumblrIcon() {

		return 'fab fa-tumblr';
	}

	public function getPinterestIcon() {

		return 'fab fa-pinterest';
	}

	public function getVKIcon() {

		return 'fab fa-vk';
	}
}