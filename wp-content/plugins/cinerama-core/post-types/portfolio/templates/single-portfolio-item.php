<?php

get_header();

cinerama_edge_get_title();

do_action('cinerama_edge_action_before_main_content');

cinerama_core_get_single_portfolio();

get_footer();