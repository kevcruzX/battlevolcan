<?php

if(!empty($_GET['redirect_url']) && !empty($_GET['oauth_token']) && !empty($_GET['oauth_verifier'])) {
    $glue = strstr($_GET['redirect_url'], '?') ? '&' : '?';
    header('Location: '.($_GET['redirect_url'].$glue.'oauth_token='.$_GET['oauth_token']).'&oauth_verifier='.$_GET['oauth_verifier']);
}