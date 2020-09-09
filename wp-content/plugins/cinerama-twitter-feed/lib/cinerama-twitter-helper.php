<?php

if(!defined('ABSPATH')) exit;

class CineramaTwitterHelper {
	
	public function getTweetCleanText($tweet) {
		return ! empty( $tweet['text'] ) ? $tweet['text'] : '';
	}
	
    public function getTweetText($tweet) {
        $protocol = is_ssl() ? 'https' : 'http';
        if(!empty($tweet['text'])) {
            //add links around https or http parts of text
            $tweet['text'] = preg_replace('/(https?)\:\/\/([a-z0-9\/\.\&\#\?\-\+\~\_\,]+)/i', '<a target="_blank" href="'.('$1://$2').'">$1://$2</a>', $tweet['text']);

            //add links around @mentions
            $tweet['text'] = preg_replace('/\@([a-aA-Z0-9\.\_\-]+)/i', '<a target="_blank" href="'.esc_url($protocol.'://twitter.com/$1').'">@$1</a>', $tweet['text']);

            //add span html tag around #WordPress parts of text
            $tweet['text'] = preg_replace('/(#WordPress)/i', '<span>$1</span>', $tweet['text']);

            return $tweet['text'];
        }

        return '';
    }

    public function getTweetProfileImage($tweet) {
        if(!empty($tweet['user'])) {
            $user = $tweet['user'];
            if(isset($user) && !empty($user)) {
                $image = is_ssl() ? $user['profile_image_url_https'] : $user['profile_image_url'];
                $image = str_replace('normal', 'bigger', $image);
                return $image;
            }
            return '';
        }

        return '';
    }

    public function getTweetProfileName($tweet) {
        if(!empty($tweet['user'])) {
            $user = $tweet['user'];
            if(isset($user['name']) && $user['name'] != '') {
                $name = $user['name'];
                return $name;
            }
            return '';
        }

        return '';
    }

    public function getTweetProfileScreenName($tweet) {
        if(!empty($tweet['user'])) {
            $user = $tweet['user'];
            if(isset($user['screen_name']) && $user['screen_name'] != '') {
                $name = '@' . $user['screen_name'];
                return $name;
            }
            return '';
        }

        return '';
    }

    public function getTweetProfileURL($tweet) {
        $url = 'https://twitter.com/';
        if(!empty($tweet['user'])) {
            $user = $tweet['user'];
            if(isset($user['screen_name']) && $user['screen_name'] != '') {
                $url .= $user['screen_name'];
            }
        }

        return $url;
    }

    public function getTweetTime($tweet) {
        if(!empty($tweet['created_at'])) {
            return human_time_diff(strtotime($tweet['created_at']), current_time('timestamp') ).' '.esc_html__('ago', 'cinerama-twitter-feed');
        }

        return '';
    }
	
	public function getTweetCreatedTime( $tweet ) {
		if ( ! empty( $tweet['created_at'] ) ) {
			return date( "F d, Y", strtotime( $tweet['created_at'] ) );
		}
		
		return '';
	}

    public function getTweetURL($tweet) {
        if(!empty($tweet['id_str']) && $tweet['user']['screen_name']) {
            return 'https://twitter.com/'.$tweet['user']['screen_name'].'/statuses/'.$tweet['id_str'];
        }

        return '#';
    }
	
	public function getTweetAuthor( $tweet ) {
		return ! empty( $tweet['user'] ) ? $tweet['user']['screen_name'] : '';
	}
}