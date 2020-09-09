<?php

if(!defined('ABSPATH')) exit;


/**
 * Class CineramaInstagramHelper
 */
class CineramaInstagramHelper {
    /**
     * Generates HTML for given image from Instagram feed. Defines cinerama_instagram_image_atts filter
     * @param $image associative array of image informations
     * @param $imageSize image size that we want to show
     * @return string generated HTML string
     */
    public function getImageHTML($image, $imageSize) {
        $atts = '';

        $imageAtts = apply_filters('cinerama_instagram_image_atts',
            array(
                'class' => $imageSize,
                'src' => $this->getImageSrc($image, $imageSize),
                'alt' => $this->getImageAlt($image),
                'width' => $this->getImageWidth($image, $imageSize),
                'height' => $this->getImageHeight($image, $imageSize)
        ));

        if(is_array($imageAtts) && count($imageAtts)) {
            foreach ($imageAtts as $attName => $attValue) {
                $atts .= $attName.'="'.$attValue.'" ';
            }
        }


        return '<img '.$atts.' />';
    }

    /**
     * Returns URL to Instagram image
     * @param $imageArr associative array of image informations
     * @param string $size image size that we want to show
     * @return string URL to Instagram image
     */
    public function getImageSrc($imageArr, $size = 'thumbnail') {
        $imageSrc = '';
        if(is_array($imageArr) && count($imageArr)) {
            $images = $imageArr['images'];

            $size = array_key_exists($size, $images) ? $size : 'thumbnail';
            $imageSrc = $images[$size]['url'];
        }

        return $imageSrc;
    }

    /**
     * Returns image description
     * @param $imageArr associative array of image informations
     * @return string image alt text
     */
    public function getImageAlt($imageArr) {
        $imageAlt = '';
        if(is_array($imageArr) && count($imageArr)) {
            $imageCaption = ($imageArr['caption']) ? $imageArr['caption'] : array();

            $imageAlt = array_key_exists('text', $imageCaption) ? $imageCaption['text'] : '';
        }

        return $imageAlt;
    }

    /**
     * Returns image width based on image size
     * @param $imageArr associative array of image informations
     * @param string $imageSize image size that we want to show
     * @return string image width
     */
    public function getImageWidth($imageArr, $imageSize = 'thumbnail ') {
        $imageWidth = '';
        if(is_array($imageArr) && count($imageArr)) {
            $images = $imageArr['images'];

            $imageSize = array_key_exists($imageSize, $images) ? $imageSize : 'thumbnail';
            $imageWidth = $images[$imageSize]['width'];
        }

        return $imageWidth;
    }

    /**
     * Returns image height based on image size
     * @param $imageArr associative array of image informations
     * @param string $imageSize image size that we want to show
     * @return string image height
     */
    public function getImageHeight($imageArr, $imageSize = 'thumbnail ') {
        $imageHeight = '';
        if(is_array($imageArr) && count($imageArr)) {
            $images = $imageArr['images'];

            $imageSize = array_key_exists($imageSize, $images) ? $imageSize : 'thumbnail';
            $imageHeight = $images[$imageSize]['height'];
        }

        return $imageHeight;
    }

    /**
     * Returns a link to instagram image
     * @param $imageArr
     * @return string
     */
    public function getImageLink($imageArr) {
        if(array_key_exists('link', $imageArr)) {
            return $imageArr['link'];
        }

        return '';
    }
}