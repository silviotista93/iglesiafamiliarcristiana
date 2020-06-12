<?php
/**
 * @package 	WordPress
 * @subpackage 	My Religion
 * @version		1.0.0
 * 
 * Video Project Format Template
 * Created by CMSMasters
 * 
 */


$cmsmasters_option = my_religion_get_global_options();


$cmsmasters_project_title = get_post_meta(get_the_ID(), 'cmsmasters_project_title', true);

$cmsmasters_project_features = get_post_meta(get_the_ID(), 'cmsmasters_project_features', true);


$cmsmasters_project_link_text = get_post_meta(get_the_ID(), 'cmsmasters_project_link_text', true);
$cmsmasters_project_link_url = get_post_meta(get_the_ID(), 'cmsmasters_project_link_url', true);
$cmsmasters_project_link_target = get_post_meta(get_the_ID(), 'cmsmasters_project_link_target', true);


$cmsmasters_project_video_type = get_post_meta(get_the_ID(), 'cmsmasters_project_video_type', true);
$cmsmasters_project_video_link = get_post_meta(get_the_ID(), 'cmsmasters_project_video_link', true);
$cmsmasters_project_video_links = get_post_meta(get_the_ID(), 'cmsmasters_project_video_links', true);


$cmsmasters_project_details_title = get_post_meta(get_the_ID(), 'cmsmasters_project_details_title', true);


$cmsmasters_project_features_one_title = get_post_meta(get_the_ID(), 'cmsmasters_project_features_one_title', true);
$cmsmasters_project_features_one = get_post_meta(get_the_ID(), 'cmsmasters_project_features_one', true);

$cmsmasters_project_features_two_title = get_post_meta(get_the_ID(), 'cmsmasters_project_features_two_title', true);
$cmsmasters_project_features_two = get_post_meta(get_the_ID(), 'cmsmasters_project_features_two', true);

$cmsmasters_project_features_three_title = get_post_meta(get_the_ID(), 'cmsmasters_project_features_three_title', true);
$cmsmasters_project_features_three = get_post_meta(get_the_ID(), 'cmsmasters_project_features_three', true);


$project_details = '';

if (
	$cmsmasters_option['my-religion' . '_portfolio_project_like'] || 
	$cmsmasters_option['my-religion' . '_portfolio_project_date'] || 
	$cmsmasters_option['my-religion' . '_portfolio_project_cat'] || 
	$cmsmasters_option['my-religion' . '_portfolio_project_comment'] || 
	$cmsmasters_option['my-religion' . '_portfolio_project_author'] || 
	$cmsmasters_option['my-religion' . '_portfolio_project_tag'] || 
	(
		!empty($cmsmasters_project_features[0][0]) && 
		!empty($cmsmasters_project_features[0][1])
	) || 
	$cmsmasters_option['my-religion' . '_portfolio_project_link']
) {
	$project_details = 'true';
}


$project_sidebar = '';


if (
	$project_details == 'true' || 
	(
		!empty($cmsmasters_project_features_one[0][0]) && 
		!empty($cmsmasters_project_features_one[0][1])
	) || (
		!empty($cmsmasters_project_features_two[0][0]) && 
		!empty($cmsmasters_project_features_two[0][1])
	) || (
		!empty($cmsmasters_project_features_three[0][0]) && 
		!empty($cmsmasters_project_features_three[0][1])
	)
) {
	$project_sidebar = 'true';
}

?>

<!--_________________________ Start Video Project _________________________ -->

<article id="post-<?php the_ID(); ?>" <?php post_class('cmsmasters_open_project'); ?>>
	<?php
	echo '<div class="project_content' . (($project_sidebar == 'true') ? ' with_sidebar' : '') . '">';
		
		if (!post_password_required()) {
			if ($cmsmasters_project_video_type == 'selfhosted' && !empty($cmsmasters_project_video_links) && sizeof($cmsmasters_project_video_links) > 0) {
				$video_size = cmsmasters_image_thumbnail_list();
				
				
				$attrs = array( 
					'preload'  => 'none', 
					'height'   => $video_size['cmsmasters-project-full-thumb']['height'], 
					'width'    => $video_size['cmsmasters-project-full-thumb']['width'] 
				);
				
				
				if (has_post_thumbnail()) {
					$video_poster = wp_get_attachment_image_src((int) get_post_thumbnail_id(get_the_ID()), 'cmsmasters-project-full-thumb');
					
					
					$attrs['poster'] = $video_poster[0];
				}
				
				
				foreach ($cmsmasters_project_video_links as $cmsmasters_project_video_link_url) {
					$attrs[substr(strrchr($cmsmasters_project_video_link_url, '.'), 1)] = $cmsmasters_project_video_link_url;
				}
				
				
				echo '<div class="cmsmasters_video_wrap">' . 
					wp_video_shortcode($attrs) . 
				'</div>';
			} elseif ($cmsmasters_project_video_type == 'embedded' && $cmsmasters_project_video_link != '') {
				global $wp_embed;
				
				
				$video_size = cmsmasters_image_thumbnail_list();
				
				
				echo '<div class="cmsmasters_video_wrap">' . 
					do_shortcode($wp_embed->run_shortcode('[embed width="' . $video_size['cmsmasters-project-full-thumb']['width'] . '" height="' . $video_size['cmsmasters-project-full-thumb']['height'] . '"]' . $cmsmasters_project_video_link . '[/embed]')) . 
				'</div>';
			} elseif (has_post_thumbnail()) {
				my_religion_thumb(get_the_ID(), 'cmsmasters-full-masonry-thumb', false, 'img_' . get_the_ID(), true, true, false, true, false);
			}
		}
		
		
		if ($cmsmasters_project_title == 'true') {
			echo '<header class="cmsmasters_project_header entry-header">';
				my_religion_project_title_nolink(get_the_ID(), 'h2');
			echo '</header>';
		}
		
		
		if (get_the_content() != '') {
			echo '<div class="cmsmasters_project_content entry-content">' . "\n";
				
				the_content();
				
				
				wp_link_pages(array( 
					'before' => '<div class="subpage_nav" role="navigation">' . '<strong>' . esc_html__('Pages', 'my-religion') . ':</strong>', 
					'after' => '</div>', 
					'link_before' => ' [ ', 
					'link_after' => ' ] ' 
				));
				
			echo '</div>';
		}
		
	echo '</div>';
	
	
	if ($project_sidebar == 'true') {
		echo '<div class="project_sidebar">';
			
			if ($project_details == 'true') {
				if ($cmsmasters_project_details_title != '') {
					echo '<h5 class="project_details_title">' . esc_html($cmsmasters_project_details_title) . '</h5>';
				}
				
				echo '<div class="project_details entry-meta">';
					
					my_religion_get_project_likes('post');
					
					my_religion_get_project_comments('post');
					
					my_religion_get_project_author('post');
					
					my_religion_get_project_date('post');
					
					my_religion_get_project_category(get_the_ID(), 'pj-categs', 'post');
					
					my_religion_get_project_tags(get_the_ID(), 'pj-tags');
					
					my_religion_get_project_features('details', $cmsmasters_project_features, false, 'h5', true);
					
					my_religion_project_link($cmsmasters_project_link_text, $cmsmasters_project_link_url, $cmsmasters_project_link_target);
					
				echo '</div>';
			}
			
			
			my_religion_get_project_features('features', $cmsmasters_project_features_one, $cmsmasters_project_features_one_title, 'h5', true);
			
			my_religion_get_project_features('features', $cmsmasters_project_features_two, $cmsmasters_project_features_two_title, 'h5', true);
			
			my_religion_get_project_features('features', $cmsmasters_project_features_three, $cmsmasters_project_features_three_title, 'h5', true);
			
		echo '</div>';
	}
	?>
</article>
<!--_________________________ Finish Video Project _________________________ -->

