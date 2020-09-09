<?php
$pagination_type = cinerama_edge_get_meta_field_intersect('blog_pagination_type');

if(!empty($pagination_type) && !empty($params)) {
	cinerama_edge_get_module_template_part('templates/parts/pagination/'.$pagination_type, 'blog', '', $params);
}