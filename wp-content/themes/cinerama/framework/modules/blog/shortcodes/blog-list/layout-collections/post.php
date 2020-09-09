<li class="edgtf-bl-item edgtf-item-space clearfix">
	<div class="edgtf-bli-inner">
		<?php if ( $post_info_image == 'yes' ) {
			cinerama_edge_get_module_template_part( 'templates/parts/media', 'blog', '', $params );
		} ?>
        <div class="edgtf-bli-content">
            <?php if ($post_info_section == 'yes') { ?>
                <div class="edgtf-bli-info">
	                <?php
		                if ( $post_info_date == 'yes' ) {
			                cinerama_edge_get_module_template_part( 'templates/parts/post-info/date', 'blog', '', $params );
		                }
		                if ( $post_info_author == 'yes' ) {
			                cinerama_edge_get_module_template_part( 'templates/parts/post-info/author', 'blog', '', $params );
		                }
		                if ( $post_info_category == 'yes' ) {
			                cinerama_edge_get_module_template_part( 'templates/parts/post-info/category', 'blog', '', $params );
		                }
		                if ( $post_info_comments == 'yes' ) {
			                cinerama_edge_get_module_template_part( 'templates/parts/post-info/comments', 'blog', '', $params );
		                }
		                if ( $post_info_like == 'yes' ) {
			                cinerama_edge_get_module_template_part( 'templates/parts/post-info/like', 'blog', '', $params );
		                }
		                if ( $post_info_share == 'yes' ) {
			                cinerama_edge_get_module_template_part( 'templates/parts/post-info/share', 'blog', '', $params );
		                }
	                ?>
                </div>
            <?php } ?>
	
	        <?php cinerama_edge_get_module_template_part( 'templates/parts/title', 'blog', '', $params ); ?>
	
	        <div class="edgtf-bli-excerpt">
		        <?php
		            cinerama_edge_get_module_template_part( 'templates/parts/excerpt', 'blog', '', $params );
		            if ( $post_read_more == 'yes' ) {
			            cinerama_edge_get_module_template_part( 'templates/parts/post-info/read-more', 'blog', '', $params );
		            }
		        ?>
	        </div>
        </div>
	</div>
</li>