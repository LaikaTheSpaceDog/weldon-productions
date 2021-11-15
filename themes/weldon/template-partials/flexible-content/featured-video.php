<?php

$image = get_sub_field('video_thumbnail');
$size = '';

if( $image ) {

	$thumb = wp_get_attachment_image_src( $image['id'], $size );

}

$field = get_sub_field('autoplay');
$autoplayValue = $field['value'];

?>

<section class="video-block block-spacing <?php the_sub_field('background_color'); ?>-block <?php the_sub_field('spacing'); ?>">
	<div class="l-constrained--main no--hidden">
		<h2><?php the_sub_field('fullwidth_video_title'); ?></h2>

		<?php
			// Pull in oembed, make it raw by adding false false to the field
			$video = get_sub_field('fullwidth_video', false, false);
			$v = parse_video_uri( $video );
			$vid = $v['id'];
			$videoType = $v['type'];
		?>
		<div class="video-wrapper" data-id="<?php echo $vid; ?>"></div>

		<div class="block-spacing no-bottom featured-content">
			<?php the_sub_field('fullwidth_video_content'); ?>
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
		return '<img width="1280" height="720" src="' + thumb[0] + '"><div class="play-button"></div>';
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

			// Inject YouTube API script
			var tag = document.createElement('script');
			tag.src = "//www.youtube.com/player_api";
			var firstScriptTag = document.getElementsByTagName('script')[0];
			firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

			onYouTubePlayerAPIReady();

//		jQuery("#youtube-iframe").attr("src", jQuery("#youtube-iframe").attr("src").replace("autoplay=0", "autoplay=1"));

	}


		// https://developers.google.com/youtube/iframe_api_reference

		// global variable for the player
		var player;

		// this function gets called when API is ready to use
		function onYouTubePlayerAPIReady() {
			// create the global player from the specific iframe (#video)
			player = new YT.Player('youtube-iframe', {
				events: {
					// call this function when player is ready to use
					'onReady': onPlayerReady
				}
			});
		}



		function onPlayerReady(event) {

			// bind events
		  console.log('Inside Youtube API player');
			player.playVideo();
		}

</script>