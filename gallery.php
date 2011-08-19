<?php
/*
Plugin Name: Gallery Extended
Plugin URI: http://vidanov.com/gallery-extended
Description: Additional standard Wordpress gallery capabilities
Version: 1.0
Author: Vidanov
Author URI: http://vidanov.com
*/


remove_shortcode('gallery');
add_shortcode('gallery', 'av_gallery_shortcode');

/**
 * The Gallery shortcode.
 *
 * This implements the functionality of the Gallery Shortcode for displaying
 * WordPress images on a post.
 *
 * @since 2.5.0
 *
 * @param array $attr Attributes attributed to the shortcode.
 * @return string HTML content to display gallery.
 */



function av_gallery_styles()
{
   if (!is_admin())
   wp_enqueue_style('gallery-extended', WP_PLUGIN_URL .'/gallery-extended/gallery.css');
}
add_action('init','av_gallery_styles');
add_shortcode('gallery', 'av_gallery_shortcode');

function av_gallery_shortcode($attr) {
	global $post;



		


	static $instance = 0;
	$instance++;

	// Allow plugins/themes to override the default gallery template.
	$output = apply_filters('post_gallery', '', $attr);
	if ( $output != '' )
		return $output;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'DESC',  // CHANGED - order DESC
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail'
	), $attr));

	$id = intval($id);
	$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$columns = intval($columns);
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;

	$selector = "gallery";

	$output = apply_filters('gallery_style', "
		<div id='$selector' class='gallery galleryid-{$id}'>");



	$i = 0;

// CHANGED  -- FUNCTIONALITY FOR $start and $end in GALLERY
	$start=0;
	$end=100000;
	$counter = -1;
			if ( isset( $attr['start'] ) ) 
			{ $start=$attr['start'];}
			if ( isset( $attr['end'] ) ) 
			{ $end=$attr['end'];}
						
// CHANGED
	$thumb_id=get_post_thumbnail_id($post_id);
	foreach ( $attachments as $id => $attachment ) {
		
		$counter++; // CHANGED
		if ($counter>=$start and $counter<=$end and $id!=$thumb_id ) { // CHANGED
		
							$link = true ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false); // CHANGED - link to file
					
							$output .= "<{$itemtag} class='gallery-item'>";
							$output .= "
								<{$icontag} class='gallery-icon'>
									$link
								</{$icontag}>";
							if ( $captiontag && trim($attachment->post_excerpt) ) {
								$output .= "
									<{$captiontag} class='gallery-caption'>
									" . wptexturize($attachment->post_excerpt) . "
									</{$captiontag}>";
							}
							$output .= "</{$itemtag}>";
							if ( $columns > 0 && ++$i % $columns == 0 )
								$output .= '<br style="clear: both" />';
								
		} // CHANGED  -- FUNCTIONALITY FOR $start and $end in GALLERY
	}

	$output .= "
			<br style='clear: both;' />
		</div>\n";

	return $output;
}
?>