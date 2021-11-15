<?php

$image = get_sub_field('video_thumbnail');
$size = 'image-content-block';

if( $image ) {

	$thumb = wp_get_attachment_image_src( $image['id'], $size );

}

$field = get_sub_field('autoplay');
$autoplayValue = $field['value'];

?>

<section class="about-us-block video-block block-spacing <?php the_sub_field('background_color'); ?>-block <?php the_sub_field('spacing'); ?>">
	<div class="container">
		<?php
		if ( is_user_logged_in() ) {
			?>
			<a class="iframe green-dot tooltip-top" data-tooltip="Edit block" href="/wp-admin/post.php?post=<?php echo get_the_ID(); ?>&action=edit&mode=modal&type=<?php echo get_row_layout(); ?>">Edit content</a>
			<?php
		}
		?>
		<div class="inner-wrapper">
			<div class="pure-g">
				<div class="pure-u-1-1 pure-u-md-1-2">
					<div class="content-block no-left animate-right">

						<?php
							// Pull in oembed, make it raw by adding false false to the field
							$video = get_sub_field('video_url', false, false);
							$v = parse_video_uri( $video );
							$vid = $v['id'];
							$videoType = $v['type'];
						?>
						<div class="video-wrapper" data-id="<?php echo $vid; ?>"></div>

					</div>
				</div>
				<div class="pure-u-1-1 pure-u-md-1-2">
					<div class="content-block no-right general-content-block">
						<div class="content-wrapper just-sides">
							<h2 class="half-spacing"><?php the_sub_field('video_title'); ?></h2>
							<?php the_sub_field('video_content'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script>
	var thumb = <?php echo json_encode(wp_get_attachment_image_src( $image['id'], $size )); ?>,
		type = <?php echo json_encode($videoType); ?>,
		autoplay = <?php echo json_encode($autoplayValue); ?>;

	(function() {
		var v = document.getElementsByClassName("video-wrapper");
		for (var n = 0; n < v.length; n++) {
			var p = document.createElement("div");
			p.innerHTML = labnolThumb(v[n].dataset.id);
			p.onclick = labnolIframe;
			v[n].appendChild(p);
		}
	})();

	function labnolThumb(id) {
		return '<img src="' + thumb[0] + '"><span class="play-button"></span>';
	}

	function labnolIframe() {
		var iframe = document.createElement("iframe");

		if (type === 'youtube') {
			iframe.setAttribute("src", "//www.youtube.com/embed/" + this.parentNode.dataset.id + "?autoplay=" + autoplay + "&autohide=2&border=0&wmode=opaque&enablejsapi=1&controls=1&showinfo=0");
			iframe.setAttribute("frameborder", "0");
			iframe.setAttribute("id", "youtube-iframe");
		}

		if (type === 'vimeo') {
			iframe.setAttribute("src", "//player.vimeo.com/video/" + this.parentNode.dataset.id + "?autoplay=" + autoplay + "");
			iframe.setAttribute("frameborder", "0");
			iframe.setAttribute("id", "vimeo-iframe");
		}

		this.parentNode.replaceChild(iframe, this);
	}
</script>