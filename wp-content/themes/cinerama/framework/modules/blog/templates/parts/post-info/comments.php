<?php if(comments_open()) { ?>
	<div class="edgtf-post-info-comments-holder">
		<a itemprop="url" class="edgtf-post-info-comments" href="<?php comments_link(); ?>">
			<span class="edgtf-comments-mark icon_comment_alt"></span>
			<?php comments_number('0', '1', '%'); ?>
		</a>
	</div>
<?php } ?>