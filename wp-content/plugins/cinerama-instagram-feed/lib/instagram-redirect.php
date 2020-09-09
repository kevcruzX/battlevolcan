<?php

if(!empty($_GET['redirect_uri']) && !empty($_GET['code'])) {
    $glue = strstr($_GET['redirect_uri'], '?') ? '&' : '?';
    header('Location: '.($_GET['redirect_uri'].$glue.'code='.$_GET['code']));
}
