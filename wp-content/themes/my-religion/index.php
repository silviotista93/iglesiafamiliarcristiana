<?php 
/**
 * @package 	WordPress
 * @subpackage 	My Religion
 * @version		1.0.3
 * 
 * Default Main Page Template
 * Created by CMSMasters
 * 
 */


get_header();


list($cmsmasters_layout) = my_religion_theme_page_layout_scheme();


echo '<!--_________________________ Start Content _________________________ -->' . "\n";


if ($cmsmasters_layout == 'r_sidebar') {
	echo '<div class="content entry" role="main">' . "\n\t";
} elseif ($cmsmasters_layout == 'l_sidebar') {
	echo '<div class="content entry fr" role="main">' . "\n\t";
} else {
	echo '<div class="middle_content entry" role="main">' . "\n\t";
}

	echo '<div class="blog">' . "\n";
	
	if (have_posts()) :
		while (have_posts()) : the_post();
			if (get_post_format() != '') {
				get_template_part('framework/post-type/blog/page/default/' . get_post_format());
			} else {
				get_template_part('framework/post-type/blog/page/default/standard');
			}
		endwhile;
		
		echo cmsmasters_pagination();
	endif;
		
	echo '</div>' . "\n" . 
'</div>' . "\n" . 
'<!-- _________________________ Finish Content _________________________ -->' . "\n\n";


if ($cmsmasters_layout == 'r_sidebar') {
	echo "\n" . '<!-- _________________________ Start Sidebar _________________________ -->' . "\n" . 
	'<div class="sidebar" role="complementary">' . "\n";
	
	get_sidebar();
	
	echo "\n" . '</div>' . "\n" . 
	'<!-- _________________________ Finish Sidebar _________________________ -->' . "\n";
} elseif ($cmsmasters_layout == 'l_sidebar') {
	echo "\n" . '<!-- _________________________ Start Sidebar _________________________ -->' . "\n" . 
	'<div class="sidebar fl" role="complementary">' . "\n";
	
	get_sidebar();
	
	echo "\n" . '</div>' . "\n" . 
	'<!-- _________________________ Finish Sidebar _________________________ -->' . "\n";
}


get_footer();

