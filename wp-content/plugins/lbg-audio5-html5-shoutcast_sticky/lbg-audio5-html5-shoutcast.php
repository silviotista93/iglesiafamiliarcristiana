<?php
/*
Plugin Name: Sticky Radio Player - Full Width Shoutcast and Icecast HTML5 Player
Description: This plugin will allow you to insert an advanced HTML5 Radio Player With Playlist, Categories and Search
Version: 2.2.2
Author: Lambert Group
Author URI: https://codecanyon.net/user/LambertGroup/portfolio?ref=LambertGroup
*/

ini_set('display_errors', 0);
$lbg_audio5_html5_shoutcast_path = trailingslashit(dirname(__FILE__));  //empty

//all the messages
$lbg_audio5_html5_shoutcast_messages = array(
		'version' => '<div class="error">Sticky Radio Player - Full Width Shoutcast and Icecast HTML5 Player plugin requires WordPress 3.0 or newer. <a href="https://codex.wordpress.org/Upgrading_WordPress">Please update!</a></div>',
		'data_saved' => 'Data Saved!',
		'empty_name' => 'Name - required',
		'empty_stream' => 'Stream - required',
		'empty_mp3' => 'MP3 - required',
		'empty_ogg' => 'OGG - required',
		'empty_categ' => 'Category - required',
		'invalid_request' => 'Invalid Request!',
		'generate_for_this_player' => 'You can start customizing this player.',
		'duplicate_complete' => 'Duplication process is complete!'
	);


global $wp_version;

if ( !version_compare($wp_version,"3.0",">=")) {
	wp_die ($lbg_audio5_html5_shoutcast_messages['version']);
}




function lbg_audio5_html5_shoutcast_activate() {
	//db creation, create admin options etc.
	global $wpdb;

	$lbg_audio5_html5_shoutcast_collate = ' COLLATE utf8_general_ci';

	$sql0 = "CREATE TABLE `" . $wpdb->prefix . "lbg_audio5_html5_shoutcast_players` (
			`id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
			`name` VARCHAR( 255 ) NOT NULL ,
			PRIMARY KEY ( `id` )
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

	$sql1 = "CREATE TABLE `" . $wpdb->prefix . "lbg_audio5_html5_shoutcast_settings` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `playerWidth` smallint(5) unsigned NOT NULL DEFAULT '5000',
  `responsive` varchar(8) NOT NULL DEFAULT 'true',
  `skin` varchar(255) NOT NULL DEFAULT 'whiteControllers',
  `initialVolume` float unsigned NOT NULL DEFAULT '0.5',
  `autoPlay` varchar(8) NOT NULL DEFAULT 'true',
  `volumeOffColor` varchar(10) NOT NULL DEFAULT '454545',
  `volumeOnColor` varchar(10) NOT NULL DEFAULT 'FFFFFF',
  `songTitleColor` varchar(10) NOT NULL DEFAULT '000000',
  `radioStationColor` varchar(10) NOT NULL DEFAULT '000000',
  `frameBehindPlayerColor` varchar(10) NOT NULL DEFAULT '000000',
  `imageBorderWidth` smallint(5) unsigned NOT NULL DEFAULT '4',
  `imageBorderColor` varchar(10) NOT NULL DEFAULT '000000',
  `showVolume` varchar(8) NOT NULL DEFAULT 'true',
  `showRadioStation` varchar(8) NOT NULL DEFAULT 'true',
  `showTitle` varchar(8) NOT NULL DEFAULT 'true',
  `showNextPrevBut` varchar(8) NOT NULL DEFAULT 'true',
  `autoHidePlayButton` varchar(8) NOT NULL DEFAULT 'true',
  `showFacebookBut` varchar(8) NOT NULL DEFAULT 'true',
  `facebookAppID` varchar(255) NOT NULL DEFAULT '',
  `facebookShareTitle` varchar(255) NOT NULL DEFAULT 'HTML5 Radio Player With Playlist - Shoutcast and Icecast',
  `facebookShareDescription` varchar(255) NOT NULL DEFAULT 'A top-notch responsive HTML5 Radio Player compatible with all major browsers and mobile devices.',
  `showTwitterBut` varchar(8) NOT NULL DEFAULT 'true',
  `beneathTitleBackgroundColor_VisiblePlaylist` varchar(10) NOT NULL DEFAULT 'c55151',
  `beneathTitleBackgroundOpacity_VisiblePlaylist` smallint(5) unsigned NOT NULL DEFAULT '100',
  `beneathTitleBackgroundColor_HiddenPlaylist` varchar(10) NOT NULL DEFAULT 'c55151',
  `beneathTitleBackgroundOpacity_HiddenPlaylist` smallint(5) unsigned NOT NULL DEFAULT '100',
  `beneathTitleBackgroundBorderColor` varchar(10) NOT NULL DEFAULT '000000',
  `beneathTitleBackgroundBorderWidth` smallint(5) unsigned NOT NULL DEFAULT '3',
  `translateRadioStation` varchar(255) NOT NULL DEFAULT 'Radio Station: ',
  `translateSongTitle` varchar(255) NOT NULL DEFAULT 'Now Playing: ',
  `translateReadingData` varchar(255) NOT NULL DEFAULT 'reading data...',
  `translateAllRadioStations` varchar(255) NOT NULL DEFAULT 'ALL RADIO STATIONS',
  `showPlaylistBut` varchar(8) NOT NULL DEFAULT 'true',
  `showPlaylist` varchar(8) NOT NULL DEFAULT 'true',
  `showPlaylistOnInit` varchar(8) NOT NULL DEFAULT 'false',
  `playlistTopPos` smallint(5) NOT NULL DEFAULT '5',
  `playlistBgColor` varchar(10) NOT NULL DEFAULT 'c55151',
  `playlistRecordBgOffColor` varchar(10) NOT NULL DEFAULT '000000',
  `playlistRecordBgOnColor` varchar(10) NOT NULL DEFAULT '000000',
  `playlistRecordBottomBorderOffColor` varchar(10) NOT NULL DEFAULT '333333',
  `playlistRecordBottomBorderOnColor` varchar(10) NOT NULL DEFAULT '4d4d4d',
  `playlistRecordTextOffColor` varchar(10) NOT NULL DEFAULT '777777',
  `playlistRecordTextOnColor` varchar(10) NOT NULL DEFAULT '00b4f9',
  `categoryRecordBgOffColor` varchar(10) NOT NULL DEFAULT '000000',
  `categoryRecordBgOnColor` varchar(10) NOT NULL DEFAULT '252525',
  `categoryRecordBottomBorderOffColor` varchar(10) NOT NULL DEFAULT '2f2f2f',
  `categoryRecordBottomBorderOnColor` varchar(10) NOT NULL DEFAULT '2f2f2f',
  `categoryRecordTextOffColor` varchar(10) NOT NULL DEFAULT '777777',
  `categoryRecordTextOnColor` varchar(10) NOT NULL DEFAULT '00b4f9',
  `numberOfThumbsPerScreen` smallint(5) unsigned NOT NULL DEFAULT '7',
  `playlistPadding` smallint(5) unsigned NOT NULL DEFAULT '18',
  `showCategories` varchar(8) NOT NULL DEFAULT 'true',
  `firstCateg` varchar(255) NOT NULL DEFAULT 'ALL RADIO STATIONS',
  `selectedCategBg` varchar(10) NOT NULL DEFAULT '000000',
  `selectedCategOffColor` varchar(10) NOT NULL DEFAULT 'FFFFFF',
  `selectedCategOnColor` varchar(10) NOT NULL DEFAULT '00b4f9',
  `selectedCategMarginBottom` smallint(5) unsigned NOT NULL DEFAULT '12',
  `showSearchArea` varchar(8) NOT NULL DEFAULT 'true',
  `searchAreaBg` varchar(10) NOT NULL DEFAULT '000000',
  `searchInputText` varchar(255) NOT NULL DEFAULT 'search...',
  `searchInputBg` varchar(10) NOT NULL DEFAULT 'ffffff',
  `searchInputBorderColor` varchar(10) NOT NULL DEFAULT '333333',
  `searchInputTextColor` varchar(10) NOT NULL DEFAULT '333333',
  `showPlaylistNumber` varchar(8) NOT NULL DEFAULT 'true',
  `nowPlayingInterval` smallint(5) unsigned NOT NULL DEFAULT '35',
  `grabLastFmPhoto` varchar(8) NOT NULL DEFAULT 'true',
  `grabStreamnameAndGenre` varchar(8) NOT NULL DEFAULT 'true',
  `noImageAvailable` text NOT NULL DEFAULT '',
  `showHeadphone` varchar(8) NOT NULL DEFAULT 'true',
  `nextPrevAdditionalPadding` smallint(5) NOT NULL DEFAULT '-5',
  `minButtonColor` varchar(10) NOT NULL DEFAULT 'FFFFFF',
  `activateForFooter` varchar(8) NOT NULL DEFAULT 'false',
	`delay` smallint(5) unsigned NOT NULL DEFAULT '1',
	  PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

	$sql2 = "CREATE TABLE `". $wpdb->prefix . "lbg_audio5_html5_shoutcast_playlist` (
	  `id` int(10) unsigned NOT NULL auto_increment,
	  `playerid` int(10) unsigned NOT NULL,
	  `xradiostream` text NOT NULL,
	  `xassociatedpageurl` text,
	  `category` text,
	  `xstation` text,
	  `ord` int(10) unsigned NOT NULL,
	  PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

	$sql3 = "CREATE TABLE `". $wpdb->prefix . "lbg_audio5_html5_shoutcast_categories` (
	  `id` int(10) unsigned NOT NULL auto_increment,
	  `categ` varchar(255) NOT NULL,
	  PRIMARY KEY  (`id`),
	  UNIQUE KEY `categ` ( `categ` )
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql0.$lbg_audio5_html5_shoutcast_collate);
	dbDelta($sql1.$lbg_audio5_html5_shoutcast_collate);
	dbDelta($sql2.$lbg_audio5_html5_shoutcast_collate);
	dbDelta($sql3.$lbg_audio5_html5_shoutcast_collate);

	//initialize the players table with the first player type
	$rows_count = $wpdb->get_var( "SELECT COUNT(*) FROM ". $wpdb->prefix ."lbg_audio5_html5_shoutcast_players;" );
	if (!$rows_count) {
		$wpdb->insert(
			$wpdb->prefix . "lbg_audio5_html5_shoutcast_players",
			array(
				'name' => 'White Controllers'
			),
			array(
				'%s'
			)
		);
	}

	// initialize the settings
	$rows_count = $wpdb->get_var( "SELECT COUNT(*) FROM ". $wpdb->prefix ."lbg_audio5_html5_shoutcast_settings;" );
	if (!$rows_count) {
		lbg_audio5_html5_shoutcast_insert_settings_record(1);
	}


/*	//initialize categories
	$rows_count = $wpdb->get_var( "SELECT COUNT(*) FROM ". $wpdb->prefix ."lbg_audio5_html5_shoutcast_categories;" );
	if (!$rows_count) {
		$wpdb->insert(
			$wpdb->prefix . "lbg_audio5_html5_shoutcast_categories",
			array(
				'categ' => 'ALL RADIO STATIONS'
			),
			array(
				'%s'
			)
		);
	}
*/

}


function lbg_audio5_html5_shoutcast_uninstall() {
	global $wpdb;
	/*mysql_query("DROP TABLE `" . $wpdb->prefix . "lbg_audio5_html5_shoutcast_settings`" );
	mysql_query("DROP TABLE `" . $wpdb->prefix . "lbg_audio5_html5_shoutcast_playlist`" );
	mysql_query("DROP TABLE `" . $wpdb->prefix . "lbg_audio5_html5_shoutcast_players`" );
	mysql_query("DROP TABLE `" . $wpdb->prefix . "lbg_audio5_html5_shoutcast_categories`" );*/

	$sql = "DROP TABLE IF EXISTS `" . $wpdb->prefix . "lbg_audio5_html5_shoutcast_settings`";
	$wpdb->query($sql);

	$sql = "DROP TABLE IF EXISTS `" . $wpdb->prefix . "lbg_audio5_html5_shoutcast_playlist`";
	$wpdb->query($sql);

	$sql = "DROP TABLE IF EXISTS `" . $wpdb->prefix . "lbg_audio5_html5_shoutcast_players`";
	$wpdb->query($sql);

	$sql = "DROP TABLE IF EXISTS `" . $wpdb->prefix . "lbg_audio5_html5_shoutcast_categories`";
	$wpdb->query($sql);
}

function lbg_audio5_html5_shoutcast_insert_settings_record($player_id) {
	global $wpdb;
	$wpdb->insert(
			$wpdb->prefix . "lbg_audio5_html5_shoutcast_settings",
			array(
				'skin' => 'whiteControllers',
				'noImageAvailable' => plugins_url("", __FILE__).'/audio5_html5/noimageavailable.jpg'
			),
			array(
				'%s',
				'%s'
			)
		);
}


function lbg_audio5_html5_shoutcast_init_sessions() {
	global $wpdb;
	if (is_admin()) {
		if (!session_id()) {
			session_start();

			//initialize the session
			if (!isset($_SESSION['xid'])) {
				$safe_sql="SELECT * FROM (".$wpdb->prefix ."lbg_audio5_html5_shoutcast_players) LIMIT 0, 1";
				$row = $wpdb->get_row($safe_sql,ARRAY_A);
				//$row=lbg_audio5_html5_shoutcast_unstrip_array($row);
				$_SESSION['xid'] = $row['id'];
				$_SESSION['xname'] = $row['name'];
			}
		}
	}
}


function lbg_audio5_html5_shoutcast_load_styles() {
	if(strpos($_SERVER['PHP_SELF'], 'wp-admin') !== false) { //loads css in admin
		$page = (isset($_GET['page'])) ? $_GET['page'] : '';
		if(preg_match('/LBG_AUDIO5_HTML5_SHOUTCAST/i', $page)) {
			/*wp_enqueue_style('lbg-audio5-html5-shoutcast_jquery-custom_css', plugins_url('css/custom-theme/jquery-ui-1.8.10.custom.css', __FILE__));*/
			wp_enqueue_style('lbg-jquery-ui-custom_css', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/pepper-grinder/jquery-ui.min.css');
			wp_enqueue_style('lbg-audio5-html5-shoutcast_css', plugins_url('css/styles.css', __FILE__));
			wp_enqueue_style('lbg-audio5-html5-shoutcast_colorpicker_css', plugins_url('css/colorpicker/colorpicker.css', __FILE__));

			wp_enqueue_style('thickbox');
		}
	} else if (!is_admin()) { //loads css in front-end
		wp_enqueue_style('audio5-html5_site_css', plugins_url('audio5_html5/audio5_html5.css', __FILE__));
	}
}

function lbg_audio5_html5_shoutcast_load_scripts() {
	$page = (isset($_GET['page'])) ? $_GET['page'] : '';
	if(preg_match('/LBG_AUDIO5_HTML5_SHOUTCAST/i', $page)) {
		//loads scripts in admin
		//if (is_admin()) {
			/*wp_deregister_script('jquery-ui-core');
			wp_deregister_script('jquery-ui-widget');
			wp_deregister_script('jquery-ui-mouse');
			wp_deregister_script('jquery-ui-accordion');
			wp_deregister_script('jquery-ui-autocomplete');
			wp_deregister_script('jquery-ui-slider');
			wp_deregister_script('jquery-ui-tabs');
			wp_deregister_script('jquery-ui-sortable');
			wp_deregister_script('jquery-ui-draggable');
			wp_deregister_script('jquery-ui-droppable');
			wp_deregister_script('jquery-ui-selectable');
			wp_deregister_script('jquery-ui-position');
			wp_deregister_script('jquery-ui-datepicker');
			wp_deregister_script('jquery-ui-resizable');
			wp_deregister_script('jquery-ui-dialog');
			wp_deregister_script('jquery-ui-button');	*/

			wp_enqueue_script('jquery');
			/*wp_register_script('lbg-admin-jquery', plugins_url('js/jquery-1.5.1.js', __FILE__));
			wp_enqueue_script('lbg-admin-jquery');*/

			//wp_register_script('lbg-admin-jquery-ui-min', plugins_url('js/jquery-ui-1.8.10.custom.min.js', __FILE__));
			//wp_register_script('lbg-admin-jquery-ui-min', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js');
			/*wp_register_script('lbg-admin-jquery-ui-min', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js');
			wp_enqueue_script('lbg-admin-jquery-ui-min');*/
			wp_enqueue_script('jquery-ui-core');
			wp_enqueue_script('jquery-ui-widget');
			wp_enqueue_script('jquery-ui-mouse');
			wp_enqueue_script('jquery-ui-accordion');
			wp_enqueue_script('jquery-ui-autocomplete');
			wp_enqueue_script('jquery-ui-slider');
			wp_enqueue_script('jquery-ui-tabs');
			wp_enqueue_script('jquery-ui-sortable');
			wp_enqueue_script('jquery-ui-draggable');
			wp_enqueue_script('jquery-ui-droppable');
			wp_enqueue_script('jquery-ui-selectable');
			wp_enqueue_script('jquery-ui-position');
			wp_enqueue_script('jquery-ui-datepicker');
			wp_enqueue_script('jquery-ui-resizable');
			wp_enqueue_script('jquery-ui-dialog');
			wp_enqueue_script('jquery-ui-button');/***************************/

			wp_enqueue_script('jquery-form');
			wp_enqueue_script('jquery-color');
			wp_enqueue_script('jquery-masonry');
			wp_enqueue_script('jquery-ui-progressbar');
			wp_enqueue_script('jquery-ui-tooltip');

			wp_enqueue_script('jquery-effects-core');
			wp_enqueue_script('jquery-effects-blind');
			wp_enqueue_script('jquery-effects-bounce');
			wp_enqueue_script('jquery-effects-clip');
			wp_enqueue_script('jquery-effects-drop');
			wp_enqueue_script('jquery-effects-explode');
			wp_enqueue_script('jquery-effects-fade');
			wp_enqueue_script('jquery-effects-fold');
			wp_enqueue_script('jquery-effects-highlight');
			wp_enqueue_script('jquery-effects-pulsate');
			wp_enqueue_script('jquery-effects-scale');
			wp_enqueue_script('jquery-effects-shake');
			wp_enqueue_script('jquery-effects-slide');
			wp_enqueue_script('jquery-effects-transfer');

			wp_register_script('lbg-admin-colorpicker', plugins_url('js/colorpicker/colorpicker.js', __FILE__));
			wp_enqueue_script('lbg-admin-colorpicker');

			wp_register_script('lbg-admin-editinplace', plugins_url('js/jquery.editinplace.js', __FILE__));
			wp_enqueue_script('lbg-admin-editinplace');

			wp_register_script('lbg-admin-toggle', plugins_url('js/myToggle.js', __FILE__));
			wp_enqueue_script('lbg-admin-toggle');

			wp_enqueue_script('media-upload'); // before w.p 3.5
			wp_enqueue_media();// from w.p 3.5
			wp_enqueue_script('thickbox');



		//}

		//wp_enqueue_script('jquery');
		//wp_enqueue_script('jquery-ui-core');
		//wp_enqueue_script('jquery-ui-sortable');
		//wp_enqueue_script('thickbox');
		//wp_enqueue_script('media-upload');
		//wp_enqueue_script('farbtastic');
	} else if (!is_admin()) { //loads scripts in front-end
			/*wp_deregister_script('jquery-ui-core');
			wp_deregister_script('jquery-ui-widget');
			wp_deregister_script('jquery-ui-mouse');
			wp_deregister_script('jquery-ui-accordion');
			wp_deregister_script('jquery-ui-autocomplete');
			wp_deregister_script('jquery-ui-slider');
			wp_deregister_script('jquery-ui-tabs');
			wp_deregister_script('jquery-ui-sortable');
			wp_deregister_script('jquery-ui-draggable');
			wp_deregister_script('jquery-ui-droppable');
			wp_deregister_script('jquery-ui-selectable');
			wp_deregister_script('jquery-ui-position');
			wp_deregister_script('jquery-ui-datepicker');
			wp_deregister_script('jquery-ui-resizable');
			wp_deregister_script('jquery-ui-dialog');
			wp_deregister_script('jquery-ui-button');*/

		wp_enqueue_script('jquery');

		//wp_enqueue_script('jquery-ui-core');

		//wp_register_script('lbg-jquery-ui-min', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js');
		/*wp_register_script('lbg-jquery-ui-min', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js');
		wp_enqueue_script('lbg-jquery-ui-min');*/

			wp_enqueue_script('jquery-ui-core');
			/*wp_enqueue_script('jquery-ui-widget');
			wp_enqueue_script('jquery-ui-mouse');
			wp_enqueue_script('jquery-ui-accordion');
			wp_enqueue_script('jquery-ui-autocomplete');*/
			wp_enqueue_script('jquery-ui-slider');
			/*wp_enqueue_script('jquery-ui-tabs');
			wp_enqueue_script('jquery-ui-sortable');
			wp_enqueue_script('jquery-ui-draggable');
			wp_enqueue_script('jquery-ui-droppable');
			wp_enqueue_script('jquery-ui-selectable');
			wp_enqueue_script('jquery-ui-position');
			wp_enqueue_script('jquery-ui-datepicker');
			wp_enqueue_script('jquery-ui-resizable');
			wp_enqueue_script('jquery-ui-dialog');
			wp_enqueue_script('jquery-ui-button');

			wp_enqueue_script('jquery-form');
			wp_enqueue_script('jquery-color');
			wp_enqueue_script('jquery-masonry');
			wp_enqueue_script('jquery-ui-progressbar');
			wp_enqueue_script('jquery-ui-tooltip');*/

			wp_enqueue_script('jquery-effects-core');
			/*wp_enqueue_script('jquery-effects-blind');
			wp_enqueue_script('jquery-effects-bounce');
			wp_enqueue_script('jquery-effects-clip');
			wp_enqueue_script('jquery-effects-drop');
			wp_enqueue_script('jquery-effects-explode');
			wp_enqueue_script('jquery-effects-fade');
			wp_enqueue_script('jquery-effects-fold');
			wp_enqueue_script('jquery-effects-highlight');
			wp_enqueue_script('jquery-effects-pulsate');
			wp_enqueue_script('jquery-effects-scale');
			wp_enqueue_script('jquery-effects-shake');
			wp_enqueue_script('jquery-effects-slide');
			wp_enqueue_script('jquery-effects-transfer');*/

		wp_register_script('lbg-mousewheel', plugins_url('audio5_html5/js/jquery.mousewheel.min.js', __FILE__));
		wp_enqueue_script('lbg-mousewheel');

		wp_register_script('lbg-touchSwipe', plugins_url('audio5_html5/js/jquery.touchSwipe.min.js', __FILE__));
		wp_enqueue_script('lbg-touchSwipe');

		wp_register_script('lbg-swfobject', plugins_url('audio5_html5/js/swfobject.js', __FILE__));
		wp_enqueue_script('lbg-swfobject');

		wp_register_script('lbg-audio5_html5', plugins_url('audio5_html5/js/audio5_html5.js', __FILE__));
		wp_enqueue_script('lbg-audio5_html5');
	}

}



// adds the menu pages
function lbg_audio5_html5_shoutcast_plugin_menu() {
	add_menu_page('LBG AUDIO5 HTML5 Admin Interface', 'LBG AUDIO5 HTML5', 'edit_posts', 'LBG_AUDIO5_HTML5_SHOUTCAST', 'lbg_audio5_html5_shoutcast_overview_page',
	plugins_url('images/lbg_audio5_icon.png', __FILE__));
	add_submenu_page( 'LBG_AUDIO5_HTML5_SHOUTCAST', 'LBG AUDIO5 HTML5 Overview', 'Overview', 'edit_posts', 'LBG_AUDIO5_HTML5_SHOUTCAST', 'lbg_audio5_html5_shoutcast_overview_page');
	add_submenu_page( 'LBG_AUDIO5_HTML5_SHOUTCAST', 'LBG AUDIO5 HTML5 Manage Players', 'Manage Players', 'edit_posts', 'LBG_AUDIO5_HTML5_SHOUTCAST_Manage_Players', 'lbg_audio5_html5_shoutcast_player_manage_players_page');
	add_submenu_page( 'LBG_AUDIO5_HTML5_SHOUTCAST', 'LBG AUDIO5 HTML5 Manage Players Add New', 'Add New', 'edit_posts', 'LBG_AUDIO5_HTML5_SHOUTCAST_Add_New', 'lbg_audio5_html5_shoutcast_player_manage_players_add_new_page');
	add_submenu_page( 'LBG_AUDIO5_HTML5_SHOUTCAST', 'LBG AUDIO5 HTML5 Manage Categories', 'Manage Categories', 'edit_posts', 'LBG_AUDIO5_HTML5_SHOUTCAST_Manage_Categories', 'lbg_audio5_html5_shoutcast_player_manage_categories_page');
	add_submenu_page( 'LBG AUDIO5 HTML5 Manage Categories', 'LBG AUDIO5 HTML5 Manage Categories Add New', 'Add New', 'edit_posts', 'LBG_AUDIO5_HTML5_SHOUTCAST_Add_New_Category', 'lbg_audio5_html5_shoutcast_player_manage_players_add_new_category_page');
	add_submenu_page( 'LBG AUDIO5 HTML5 Manage Players', 'LBG AUDIO5 HTML5 Player Settings', 'Player Settings', 'edit_posts', 'LBG_AUDIO5_HTML5_SHOUTCAST_Settings', 'lbg_audio5_html5_shoutcast_player_settings_page');
	add_submenu_page( 'LBG AUDIO5 HTML5 Manage Players', 'LBG AUDIO5 HTML5 Player Playlist', 'Playlist', 'edit_posts', 'LBG_AUDIO5_HTML5_SHOUTCAST_Playlist', 'lbg_audio5_html5_shoutcast_player_playlist_page');
	add_submenu_page( 'LBG_AUDIO5_HTML5_SHOUTCAST_Settings', 'LBG AUDIO5 HTML5 Player Settings', 'Duplicate Player', 'edit_posts', 'LBG_AUDIO5_HTML5_SHOUTCAST_Duplicate_Player', 'lbg_audio5_html5_shoutcast_duplicate_player_page');
	add_submenu_page( 'LBG_AUDIO5_HTML5_SHOUTCAST', 'LBG AUDIO5 HTML5 Help', 'Help', 'edit_posts', 'LBG_AUDIO5_HTML5_SHOUTCAST_Help', 'lbg_audio5_html5_shoutcast_player_help_page');
}


//HTML content for overview page
function lbg_audio5_html5_shoutcast_overview_page()
{
	global $lbg_audio5_html5_shoutcast_path;
	include_once($lbg_audio5_html5_shoutcast_path . 'tpl/overview.php');
}

//HTML content for Manage Players
function lbg_audio5_html5_shoutcast_player_manage_players_page()
{
	global $wpdb;
	global $lbg_audio5_html5_shoutcast_messages;
	global $lbg_audio5_html5_shoutcast_path;

	//delete player
	if (isset($_GET['id'])) {
		//delete from wp_lbg_audio5_html5_shoutcast_players
		$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix."lbg_audio5_html5_shoutcast_players WHERE id = %d",$_GET['id']));

		//delete from wp_lbg_audio5_html5_shoutcast_settings
		$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix."lbg_audio5_html5_shoutcast_settings WHERE id = %d",$_GET['id']));

		//delete from wp_lbg_audio5_html5_shoutcast_playlist
		$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix."lbg_audio5_html5_shoutcast_playlist WHERE playerid = %d",$_GET['id']));

		//initialize the session
		$safe_sql="SELECT * FROM (".$wpdb->prefix ."lbg_audio5_html5_shoutcast_players) ORDER BY id";
		$row = $wpdb->get_row($safe_sql,ARRAY_A);
		$row=lbg_audio5_html5_shoutcast_unstrip_array($row);
		if ($row['id']) {
			$_SESSION['xid']=$row['id'];
			$_SESSION['xname']=$row['name'];
		}
	}


	$safe_sql="SELECT * FROM (".$wpdb->prefix ."lbg_audio5_html5_shoutcast_players) ORDER BY id";
	$result = $wpdb->get_results($safe_sql,ARRAY_A);
	//echo $wpdb->last_query;
	include_once($lbg_audio5_html5_shoutcast_path . 'tpl/players.php');

}

//HTML content for Manage Categories
function lbg_audio5_html5_shoutcast_player_manage_categories_page()
{
	global $wpdb;
	global $lbg_audio5_html5_shoutcast_messages;
	global $lbg_audio5_html5_shoutcast_path;

	//delete player
	if (isset($_GET['id'])) {
		//delete from wp_lbg_audio5_html5_shoutcast_categories
		$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix."lbg_audio5_html5_shoutcast_categories WHERE id = %d",$_GET['id']));
	}

	if (isset($_GET['categID']) && isset($_GET['origCategName'])) {
		$wpdb->update(
				$wpdb->prefix .'lbg_audio5_html5_shoutcast_categories',
				array(
				'categ' => $_POST['update_value']
				),
				array( 'id' => $_GET['categID'] )
			);
	}


	$safe_sql="SELECT * FROM (".$wpdb->prefix ."lbg_audio5_html5_shoutcast_categories) ORDER BY id";
	$result = $wpdb->get_results($safe_sql,ARRAY_A);
	//echo $wpdb->last_query;
	include_once($lbg_audio5_html5_shoutcast_path . 'tpl/categories.php');

}


//HTML content for Manage Players - Add New
function lbg_audio5_html5_shoutcast_player_manage_players_add_new_page()
{
	global $wpdb;
	global $lbg_audio5_html5_shoutcast_messages;
	global $lbg_audio5_html5_shoutcast_path;

	//if($_POST['Submit'] == 'Add New') {
	if(array_key_exists('Submit', $_POST) && $_POST['Submit'] == 'Add New') {
		$errors_arr=array();
		if (empty($_POST['name']))
			$errors_arr[]=$lbg_audio5_html5_shoutcast_messages['empty_name'];

		if (count($errors_arr)) {
				include_once($lbg_audio5_html5_shoutcast_path . 'tpl/add_player.php'); ?>
				<div id="error" class="error"><p><?php echo implode("<br>", $errors_arr);?></p></div>
		  	<?php } else { // no errors
					$wpdb->insert(
						$wpdb->prefix . "lbg_audio5_html5_shoutcast_players",
						array(
							'name' => $_POST['name']
						),
						array(
							'%s'
						)
					);
					//insert default player settings for this new player
					lbg_audio5_html5_shoutcast_insert_settings_record($wpdb->insert_id);
					?>
						<div class="wrap">
							<div id="lbg_logo">
								<h2>Manage Players - Add New Player</h2>
				 			</div>
							<div id="message" class="updated"><p><?php echo $lbg_audio5_html5_shoutcast_messages['data_saved'];?></p><p><?php echo $lbg_audio5_html5_shoutcast_messages['generate_for_this_player'];?></p></div>
							<div>
								<p>&raquo; <a href="?page=LBG_AUDIO5_HTML5_SHOUTCAST_Add_New">Add New (player)</a></p>
								<p>&raquo; <a href="?page=LBG_AUDIO5_HTML5_SHOUTCAST_Manage_Players">Back to Manage Players</a></p>
							</div>
						</div>
		  	<?php }
	} else {
		include_once($lbg_audio5_html5_shoutcast_path . 'tpl/add_player.php');
	}

}


//HTML content for Manage Categories - Add New Category
function lbg_audio5_html5_shoutcast_player_manage_players_add_new_category_page()
{
	global $wpdb;
	global $lbg_audio5_html5_shoutcast_messages;
	global $lbg_audio5_html5_shoutcast_path;

	//if($_POST['Submit'] == 'Add New') {
	if(array_key_exists('Submit', $_POST) && $_POST['Submit'] == 'Add New') {
		$errors_arr=array();
		if (empty($_POST['categ']))
			$errors_arr[]=$lbg_audio5_html5_shoutcast_messages['empty_name'];

		if (count($errors_arr)) {
				include_once($lbg_audio5_html5_shoutcast_path . 'tpl/add_category.php'); ?>
				<div id="error" class="error"><p><?php echo implode("<br>", $errors_arr);?></p></div>
		  	<?php } else { // no errors
					$wpdb->insert(
						$wpdb->prefix . "lbg_audio5_html5_shoutcast_categories",
						array(
							'categ' => $_POST['categ']
						),
						array(
							'%s'
						)
					);
					?>
						<div class="wrap">
							<div id="lbg_logo">
								<h2>Manage Categories - Add New Category</h2>
				 			</div>
							<div id="message" class="updated"><p><?php echo $lbg_audio5_html5_shoutcast_messages['data_saved'];?></p></div>
							<div>
								<p>&raquo; <a href="?page=LBG_AUDIO5_HTML5_SHOUTCAST_Add_New_Category">Add New (category)</a></p>
								<p>&raquo; <a href="?page=LBG_AUDIO5_HTML5_SHOUTCAST_Manage_Categories">Back to Manage Categories</a></p>
							</div>
						</div>
		  	<?php }
	} else {
		include_once($lbg_audio5_html5_shoutcast_path . 'tpl/add_category.php');
	}

}



//HTML content for playersettings
function lbg_audio5_html5_shoutcast_player_settings_page()
{
	global $wpdb;
	global $lbg_audio5_html5_shoutcast_messages;
	global $lbg_audio5_html5_shoutcast_path;

	if (isset($_GET['id']) && isset($_GET['name'])) {
		$_SESSION['xid']=$_GET['id'];
		$_SESSION['xname']=$_GET['name'];
	}

	//$wpdb->show_errors();
	/*if (check_admin_referer('lbg_audio5_html5_shoutcast_settings_update')) {
		echo "update";
	}*/


	//if($_POST['Submit'] == 'Update Player Settings') {
	if(array_key_exists('Submit', $_POST) && $_POST['Submit'] == 'Update Player Settings') {
		$_GET['xmlf']='';
		$except_arr=array('Submit','name','pll_ajax_backend','page_scroll_to_id_instances');
			$wpdb->update(
				$wpdb->prefix .'lbg_audio5_html5_shoutcast_players',
				array(
				'name' => $_POST['name']
				),
				array( 'id' => $_SESSION['xid'] )
			);
			$_SESSION['xname']=stripslashes($_POST['name']);


			foreach ($_POST as $key=>$val){
				if (in_array($key,$except_arr)) {
					unset($_POST[$key]);
				}
			}

			$wpdb->update(
				$wpdb->prefix .'lbg_audio5_html5_shoutcast_settings',
				$_POST,
				array( 'id' => $_SESSION['xid'] )
			);


			?>
			<div id="message" class="updated"><p><?php echo $lbg_audio5_html5_shoutcast_messages['data_saved'];?></p></div>
	<?php
	}


	//echo "WP_PLUGIN_URL: ".WP_PLUGIN_URL;
	$safe_sql=$wpdb->prepare( "SELECT * FROM (".$wpdb->prefix ."lbg_audio5_html5_shoutcast_settings) WHERE id = %d",$_SESSION['xid'] );
	$row = $wpdb->get_row($safe_sql,ARRAY_A);
	$row=lbg_audio5_html5_shoutcast_unstrip_array($row);
	$_POST = $row;
	$_POST=lbg_audio5_html5_shoutcast_unstrip_array($_POST);

	//categories
	/*$safe_sql="SELECT * FROM (".$wpdb->prefix ."lbg_audio5_html5_shoutcast_categories) ORDER BY categ";
	$result = $wpdb->get_results($safe_sql,ARRAY_A);*/
	include_once($lbg_audio5_html5_shoutcast_path . 'tpl/settings_form.php');

}


function lbg_audio5_html5_shoutcast_player_playlist_page()
{
	global $wpdb;
	global $lbg_audio5_html5_shoutcast_messages;
	global $lbg_audio5_html5_shoutcast_path;

	if (isset($_GET['id']) && isset($_GET['name'])) {
		$_SESSION['xid']=$_GET['id'];
		$_SESSION['xname']=$_GET['name'];
	}

	$safe_sql="SELECT * FROM (".$wpdb->prefix ."lbg_audio5_html5_shoutcast_categories) ORDER BY categ";
	$result = $wpdb->get_results($safe_sql,ARRAY_A);

	//if ($_GET['xmlf']=='add_playlist_record') {
	if (array_key_exists('xmlf', $_GET) && $_GET['xmlf']=='add_playlist_record') {
		//if($_POST['Submit'] == 'Add Record') {
		if(array_key_exists('Submit', $_POST) && $_POST['Submit'] == 'Add Record') {
			$errors_arr=array();
			if (empty($_POST['xradiostream']))
				 $errors_arr[]=$lbg_audio5_html5_shoutcast_messages['empty_stream'];

			if (count($errors_arr)) {
				include_once($lbg_audio5_html5_shoutcast_path . 'tpl/add_playlist_record.php'); ?>
				<div id="error" class="error"><p><?php echo implode("<br>", $errors_arr);?></p></div>
	  <?php } else { // all requested fields are filled



		if (count($errors_arr)) {
			include_once($lbg_audio5_html5_shoutcast_path . 'tpl/add_playlist_record.php'); ?>
			<div id="error" class="error"><p><?php echo implode("<br>", $errors_arr);?></p></div>
	  	<?php } else { // no upload errors
				$max_ord = 1+$wpdb->get_var( $wpdb->prepare( "SELECT max(ord) FROM ". $wpdb->prefix ."lbg_audio5_html5_shoutcast_playlist WHERE playerid = %d",$_SESSION['xid'] ) );
				$all_categs='';
				//if ($_POST['category']!='') {
				if (array_key_exists('category', $_POST) && $_POST['category']!='') {
					$all_categs=implode(";", $_POST['category']);
				}
				$wpdb->insert(
					$wpdb->prefix . "lbg_audio5_html5_shoutcast_playlist",
					array(
						'playerid' => $_POST['playerid'],
						'xradiostream' => $_POST['xradiostream'],
						'xassociatedpageurl' => $_POST['xassociatedpageurl'],
						'category' => $all_categs,
						'xstation' => $_POST['xstation'],
						'ord' => $max_ord
					),
					array(
						'%d',
						'%s',
						'%s',
						'%s',
						'%s',
						'%d'
					)
				);
				//echo $wpdb->last_query;
	  			if (isset($_POST['setitfirst'])) {
					$sql_arr=array();
					$ord_start=$max_ord;
					$ord_stop=1;
					$elem_id=$wpdb->insert_id;
					$ord_direction='+1';

					$sql_arr[]="UPDATE ".$wpdb->prefix."lbg_audio5_html5_shoutcast_playlist SET ord=ord+1  WHERE playerid = ".$_SESSION['xid']." and ord>=".$ord_stop." and ord<".$ord_start;
					$sql_arr[]="UPDATE ".$wpdb->prefix."lbg_audio5_html5_shoutcast_playlist SET ord=".$ord_stop." WHERE id=".$elem_id;

					//echo "elem_id: ".$elem_id."----ord_start: ".$ord_start."----ord_stop: ".$ord_stop;
					foreach ($sql_arr as $sql)
						$wpdb->query($sql);
				}
				?>
					<div class="wrap">
						<div id="lbg_logo">
							<h2>Playlist for player: <span style="color:#FF0000; font-weight:bold;"><?php echo $_SESSION['xname']?> - ID #<?php echo $_SESSION['xid']?></span> - Add New</h2>
			 			</div>
						<div id="message" class="updated"><p><?php echo $lbg_audio5_html5_shoutcast_messages['data_saved'];?></p></div>
						<div>
							<p>&raquo; <a href="?page=LBG_AUDIO5_HTML5_SHOUTCAST_Playlist&xmlf=add_playlist_record">Add New</a></p>
							<p>&raquo; <a href="?page=LBG_AUDIO5_HTML5_SHOUTCAST_Playlist">Back to Playlist</a></p>
						</div>
					</div>
	  	<?php }
	  		}
		} else {
			include_once($lbg_audio5_html5_shoutcast_path . 'tpl/add_playlist_record.php');
		}

	} else {
		//if ($_GET['duplicate_id']!='') {
		if (array_key_exists('duplicate_id', $_GET) && $_GET['duplicate_id']!='') {
						$max_ord = 1+$wpdb->get_var( $wpdb->prepare( "SELECT max(ord) FROM ". $wpdb->prefix ."lbg_audio5_html5_shoutcast_playlist WHERE playerid = %d",$_SESSION['xid'] ) );
						$safe_sql=$wpdb->prepare( "INSERT INTO ".$wpdb->prefix ."lbg_audio5_html5_shoutcast_playlist ( `playerid` ,`xradiostream` ,`xassociatedpageurl` ,`category` ,`xstation` ,`ord`  )  SELECT `playerid` ,`xradiostream` ,`xassociatedpageurl` ,`category` ,`xstation` , ".$max_ord." FROM (".$wpdb->prefix ."lbg_audio5_html5_shoutcast_playlist) WHERE id = %d",$_GET['duplicate_id'] );
						$wpdb->query($safe_sql);
						//$lastID=$wpdb->insert_id;
						//echo $wpdb->last_query;


						echo "<script>location.href='?page=LBG_AUDIO5_HTML5_SHOUTCAST_Playlist&id=".$_SESSION['xid']."&name=".$_SESSION['xname']."'</script>";
		}

		$safe_sql=$wpdb->prepare( "SELECT * FROM (".$wpdb->prefix ."lbg_audio5_html5_shoutcast_playlist) WHERE playerid = %d ORDER BY ord",$_SESSION['xid'] );
		$result = $wpdb->get_results($safe_sql,ARRAY_A);

		$safe_sql="SELECT * FROM (".$wpdb->prefix ."lbg_audio5_html5_shoutcast_categories) ORDER BY categ";
	    $result_categ = $wpdb->get_results($safe_sql,ARRAY_A);

		//$_POST=lbg_audio5_html5_shoutcast_unstrip_array($_POST);
		include_once($lbg_audio5_html5_shoutcast_path . 'tpl/playlist.php');
	}
}


//HTML duplicate player
function lbg_audio5_html5_shoutcast_duplicate_player_page()
{
	global $wpdb;
	global $lbg_audio5_html5_shoutcast_messages;
	global $lbg_audio5_html5_shoutcast_path;

	if (isset($_GET['id']) && isset($_GET['name'])) {
		$_SESSION['xid']=$_GET['id'];
		$_SESSION['xname']=$_GET['name'];
	}

	//$wpdb->show_errors();


	//echo "WP_PLUGIN_URL: ".WP_PLUGIN_URL;
	//$safe_sql=$wpdb->prepare( "INSERT INTO ".$wpdb->prefix ."lbg_audio5_html5_shoutcast_settings SELECT * FROM (".$wpdb->prefix ."lbg_audio5_html5_shoutcast_settings) WHERE id = %d",$_SESSION['xid'] );
	//insert player
	$wpdb->insert(
			$wpdb->prefix . "lbg_audio5_html5_shoutcast_players",
			array(
				'name' => 'Duplicate of Player '.$_SESSION['xid']
			),
			array(
				'%s'
			)
		);

	//duplicate settings
	$safe_sql=$wpdb->prepare( "INSERT INTO ".$wpdb->prefix ."lbg_audio5_html5_shoutcast_settings (`playerWidth`, `responsive`, `skin`, `initialVolume`, `autoPlay`, `delay`, `volumeOffColor`, `volumeOnColor`, `songTitleColor`, `radioStationColor`, `frameBehindPlayerColor`, `imageBorderWidth`, `imageBorderColor`, `showVolume`, `showRadioStation`, `showTitle`, `showNextPrevBut`, `autoHidePlayButton`, `showFacebookBut`, `facebookAppID`, `facebookShareTitle`, `facebookShareDescription`, `showTwitterBut`, `beneathTitleBackgroundColor_VisiblePlaylist`, `beneathTitleBackgroundOpacity_VisiblePlaylist`, `beneathTitleBackgroundColor_HiddenPlaylist`, `beneathTitleBackgroundOpacity_HiddenPlaylist`, `beneathTitleBackgroundBorderColor`, `beneathTitleBackgroundBorderWidth`, `translateRadioStation`, `translateSongTitle`, `translateReadingData`, `translateAllRadioStations`, `showPlaylistBut`, `showPlaylist`, `showPlaylistOnInit`, `playlistTopPos`, `playlistBgColor`, `playlistRecordBgOffColor`, `playlistRecordBgOnColor`, `playlistRecordBottomBorderOffColor`, `playlistRecordBottomBorderOnColor`, `playlistRecordTextOffColor`, `playlistRecordTextOnColor`, `categoryRecordBgOffColor`, `categoryRecordBgOnColor`, `categoryRecordBottomBorderOffColor`, `categoryRecordBottomBorderOnColor`, `categoryRecordTextOffColor`, `categoryRecordTextOnColor`, `numberOfThumbsPerScreen`, `playlistPadding`, `showCategories`, `firstCateg`, `selectedCategBg`, `selectedCategOffColor`, `selectedCategOnColor`, `selectedCategMarginBottom`, `showSearchArea`, `searchAreaBg`, `searchInputText`, `searchInputBg`, `searchInputBorderColor`, `searchInputTextColor`, `showPlaylistNumber`, `nowPlayingInterval`, `grabLastFmPhoto`, `grabStreamnameAndGenre`, `noImageAvailable`, `showHeadphone`, `nextPrevAdditionalPadding`, `minButtonColor` ) SELECT `playerWidth`, `responsive`, `skin`, `initialVolume`, `autoPlay`, `delay`, `volumeOffColor`, `volumeOnColor`, `songTitleColor`, `radioStationColor`, `frameBehindPlayerColor`, `imageBorderWidth`, `imageBorderColor`, `showVolume`, `showRadioStation`, `showTitle`, `showNextPrevBut`, `autoHidePlayButton`, `showFacebookBut`, `facebookAppID`, `facebookShareTitle`, `facebookShareDescription`, `showTwitterBut`, `beneathTitleBackgroundColor_VisiblePlaylist`, `beneathTitleBackgroundOpacity_VisiblePlaylist`, `beneathTitleBackgroundColor_HiddenPlaylist`, `beneathTitleBackgroundOpacity_HiddenPlaylist`, `beneathTitleBackgroundBorderColor`, `beneathTitleBackgroundBorderWidth`, `translateRadioStation`, `translateSongTitle`, `translateReadingData`, `translateAllRadioStations`, `showPlaylistBut`, `showPlaylist`, `showPlaylistOnInit`, `playlistTopPos`, `playlistBgColor`, `playlistRecordBgOffColor`, `playlistRecordBgOnColor`, `playlistRecordBottomBorderOffColor`, `playlistRecordBottomBorderOnColor`, `playlistRecordTextOffColor`, `playlistRecordTextOnColor`, `categoryRecordBgOffColor`, `categoryRecordBgOnColor`, `categoryRecordBottomBorderOffColor`, `categoryRecordBottomBorderOnColor`, `categoryRecordTextOffColor`, `categoryRecordTextOnColor`, `numberOfThumbsPerScreen`, `playlistPadding`, `showCategories`, `firstCateg`, `selectedCategBg`, `selectedCategOffColor`, `selectedCategOnColor`, `selectedCategMarginBottom`, `showSearchArea`, `searchAreaBg`, `searchInputText`, `searchInputBg`, `searchInputBorderColor`, `searchInputTextColor`, `showPlaylistNumber`, `nowPlayingInterval`, `grabLastFmPhoto`, `grabStreamnameAndGenre`, `noImageAvailable`, `showHeadphone`, `nextPrevAdditionalPadding`, `minButtonColor` FROM (".$wpdb->prefix ."lbg_audio5_html5_shoutcast_settings) WHERE id = %d",$_SESSION['xid'] );
	$wpdb->query($safe_sql);
	?>
	<div id="message" class="updated"><p><?php echo $lbg_audio5_html5_shoutcast_messages['duplicate_complete'];?></p></div>
	<?php

	//echo $wpdb->last_query;
	$safe_sql="SELECT * FROM (".$wpdb->prefix ."lbg_audio5_html5_shoutcast_players) ORDER BY id";
	$result = $wpdb->get_results($safe_sql,ARRAY_A);
	include_once($lbg_audio5_html5_shoutcast_path . 'tpl/players.php');


}


function lbg_audio5_html5_shoutcast_player_help_page()
{
	//include_once(plugins_url('tpl/help.php', __FILE__));
	global $lbg_audio5_html5_shoutcast_path;
	include_once($lbg_audio5_html5_shoutcast_path . 'tpl/help.php');
}


function lbg_audio5_html5_shoutcast_generate_preview_code($sliderID) {
	global $wpdb;
	global $lbg_audio5_html5_shoutcast_path;

	$safe_sql=$wpdb->prepare( "SELECT * FROM (".$wpdb->prefix ."lbg_audio5_html5_shoutcast_settings) WHERE id = %d",$sliderID );
	$row = $wpdb->get_row($safe_sql,ARRAY_A);
	$row=lbg_audio5_html5_shoutcast_unstrip_array($row);

	$safe_sql="SELECT * FROM (".$wpdb->prefix ."lbg_audio5_html5_shoutcast_categories) ORDER BY categ";
	$result_categ = $wpdb->get_results($safe_sql,ARRAY_A);

	//$path_to_plugin = plugin_dir_url().str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
	$preload_aux='metadata';
	/*if ($row["preload"])
		$preload_aux=$row["preload"];*/

	/*//float
	$float_aux='';
	if ($row["float"]!='none') {
		$float_aux='float:'.$row["float"].';';
		if ($row["float"]=='left')
			$float_aux.=' padding-top:5px;padding-right:20px;padding-bottom:15px;padding-left:0px;';
		else
			$float_aux.=' padding-top:5px;padding-right:0px;padding-bottom:15px;padding-left:20px;';
	}*/

	//first categ
	/*$first_categ='';
	foreach ( $result_categ as $row_categ ) {
			if ( $row['firstCateg']==$row_categ['id']) {
				$first_categ=$row_categ['categ'];
			}
	}*/

	//download
	//$pathToDownloadFile_aux=$path_to_plugin.'audio5_html5/';
	//$pathToAjaxFiles_aux=$path_to_plugin.'audio5_html5/';

	/*//playlistOver
	$playlistOver_aux='';
	$player_height=0;
	$playlist_unit_height=31;
	$playlist_height=0;
	$numberOfThumbsPerScreen_aux=$row["numberOfThumbsPerScreen"];
	//$playerPadding_aux=$row["playerPadding"];
	$playlistPadding_aux=$row["playlistPadding"];
	$playlistTopPos_aux=$row["playlistTopPos"];
	$selectedCategMarginBottom_aux=$row["selectedCategMarginBottom"];
	if ($row["playlistOver"]=='false' && $row["showPlaylist"]=='true') {
		//$playlist_height=$row["numberOfThumbsPerScreen"]*$playlist_unit_height+2*$playlistPadding_aux+$playlistTopPos_aux;
		$player_height+=175;
	}*/

	$safe_sql=$wpdb->prepare( "SELECT * FROM (".$wpdb->prefix ."lbg_audio5_html5_shoutcast_playlist) WHERE playerid = %d ORDER BY ord",$sliderID );
	$result = $wpdb->get_results($safe_sql,ARRAY_A);

	/*if ($player_height) {
		$playlist_height=2*$playlistPadding_aux+$playlist_unit_height*$numberOfThumbsPerScreen_aux+25+24+2*$selectedCategMarginBottom_aux+$playlistTopPos_aux; //25 - audio5_html5_selectedCategDiv & 24 - audio5_html5_searchDiv
		$playlistOver_aux="height:".($player_height+$playlist_height)."px;";
	}*/

	$playlist_str='';
	foreach ( $result as $row_playlist ) {

		$row_playlist=lbg_audio5_html5_shoutcast_unstrip_array($row_playlist);


		/*$mp3_path=$row_playlist["mp3"];
		$ogg_path=$row_playlist["ogg"];*/
		$categ_arr=array();
		foreach ( $result_categ as $row_categ ) {
			if (preg_match_all('/\b'.$row_categ["id"].'\b/', $row_playlist['category'], $matches)) {
			//if ( strpos($row_playlist['category'], $row_categ['id']) === false ) {
				// nothing
			//} else {
				$categ_arr[]=$row_categ['categ'];
			}
		}


		$playlist_str.='<ul>
                	<li class="xradiostream">'.$row_playlist["xradiostream"].'</li>';
		$playlist_str.='<li class="xassociatedpageurl">'.$row_playlist["xassociatedpageurl"].'</li>';
        $playlist_str.=($row_playlist["xstation"]=='')?'':'<li class="xstation">'.$row_playlist["xstation"].'</li>';
		$playlist_str.=(count($categ_arr)===0)?'':'<li class="xcategory">'.implode(";",$categ_arr).'</li>';
        $playlist_str.='        </ul>';
	}

	$new_div_start='';
	$new_div_end='';

	$content='<script>
		jQuery(function() {
setTimeout(function(){
			jQuery("#lbg_audio5_html5_shoutcast_'.$row["id"].'").audio5_html5({
				skin:"'.$row["skin"].'",
				playerWidth:'.$row["playerWidth"].',
				responsive:'.$row["responsive"].',
				initialVolume:'.$row["initialVolume"].',
				autoPlay:'.$row["autoPlay"].',
				volumeOffColor:"#'.$row["volumeOffColor"].'",
				volumeOnColor:"#'.$row["volumeOnColor"].'",
				songTitleColor:"#'.$row["songTitleColor"].'",
				radioStationColor:"#'.$row["radioStationColor"].'",
				frameBehindPlayerColor:"#'.$row["frameBehindPlayerColor"].'",
				imageBorderWidth:'.$row["imageBorderWidth"].',
				imageBorderColor:"#'.$row["imageBorderColor"].'",
				showVolume:'.$row["showVolume"].',
				showRadioStation:'.$row["showRadioStation"].',
				showTitle:'.$row["showTitle"].',
				showNextPrevBut:'.$row["showNextPrevBut"].',
				autoHidePlayButton:'.$row["autoHidePlayButton"].',
				showFacebookBut:'.$row["showFacebookBut"].',
				facebookAppID:"'.$row["facebookAppID"].'",
				facebookShareTitle:"'.$row["facebookShareTitle"].'",
				facebookShareDescription:"'.$row["facebookShareDescription"].'",
				showTwitterBut:'.$row["showTwitterBut"].',
				beneathTitleBackgroundColor_VisiblePlaylist:"#'.$row["beneathTitleBackgroundColor_VisiblePlaylist"].'",
				beneathTitleBackgroundOpacity_VisiblePlaylist:'.$row["beneathTitleBackgroundOpacity_VisiblePlaylist"].',
				beneathTitleBackgroundColor_HiddenPlaylist:"#'.$row["beneathTitleBackgroundColor_HiddenPlaylist"].'",
				beneathTitleBackgroundOpacity_HiddenPlaylist:'.$row["beneathTitleBackgroundOpacity_HiddenPlaylist"].',
				beneathTitleBackgroundBorderColor:"#'.$row["beneathTitleBackgroundBorderColor"].'",
				beneathTitleBackgroundBorderWidth:'.$row["beneathTitleBackgroundBorderWidth"].',
				translateRadioStation:"'.$row["translateRadioStation"].'",
				translateSongTitle:"'.$row["translateSongTitle"].'",
				translateReadingData:"'.$row["translateReadingData"].'",
				translateAllRadioStations:"'.$row["translateAllRadioStations"].'",
				showPlaylistBut:'.$row["showPlaylistBut"].',
				showPlaylist:'.$row["showPlaylist"].',
				showPlaylistOnInit:'.$row["showPlaylistOnInit"].',
				playlistTopPos:'.$row["playlistTopPos"].',
				playlistBgColor:"#'.$row["playlistBgColor"].'",
				playlistRecordBgOffColor:"#'.$row["playlistRecordBgOffColor"].'",
				playlistRecordBgOnColor:"#'.$row["playlistRecordBgOnColor"].'",
				playlistRecordBottomBorderOffColor:"#'.$row["playlistRecordBottomBorderOffColor"].'",
				playlistRecordBottomBorderOnColor:"#'.$row["playlistRecordBottomBorderOnColor"].'",
				playlistRecordTextOffColor:"#'.$row["playlistRecordTextOffColor"].'",
				playlistRecordTextOnColor:"#'.$row["playlistRecordTextOnColor"].'",
				categoryRecordBgOffColor:"#'.$row["categoryRecordBgOffColor"].'",
				categoryRecordBgOnColor:"#'.$row["categoryRecordBgOnColor"].'",
				categoryRecordBottomBorderOffColor:"#'.$row["categoryRecordBottomBorderOffColor"].'",
				categoryRecordBottomBorderOnColor:"#'.$row["categoryRecordBottomBorderOnColor"].'",
				categoryRecordTextOffColor:"#'.$row["categoryRecordTextOffColor"].'",
				categoryRecordTextOnColor:"#'.$row["categoryRecordTextOnColor"].'",
				numberOfThumbsPerScreen:'.$row["numberOfThumbsPerScreen"].',
				playlistPadding:'.$row["playlistPadding"].',
				firstCateg:"'.$row['firstCateg'].'",
				showCategories:'.$row["showCategories"].',
				selectedCategBg:"#'.$row["selectedCategBg"].'",
				selectedCategOffColor:"#'.$row["selectedCategOffColor"].'",
				selectedCategOnColor:"#'.$row["selectedCategOnColor"].'",
				selectedCategMarginBottom:'.$row["selectedCategMarginBottom"].',
				showSearchArea:'.$row["showSearchArea"].',
				searchAreaBg:"#'.$row["searchAreaBg"].'",
				searchInputText:"'.$row["searchInputText"].'",
				searchInputBg:"#'.$row["searchInputBg"].'",
				searchInputBorderColor:"#'.$row["searchInputBorderColor"].'",
			    searchInputTextColor:"#'.$row["searchInputTextColor"].'",
				showPlaylistNumber:'.$row["showPlaylistNumber"].',
				pathToAjaxFiles:"'.plugins_url("audio5_html5/", __FILE__).'",
				nowPlayingInterval:'.$row["nowPlayingInterval"].',
				grabLastFmPhoto:'.$row["grabLastFmPhoto"].',
				grabStreamnameAndGenre:'.$row["grabStreamnameAndGenre"].',
				noImageAvailable:"'.$row["noImageAvailable"].'",
				showHeadphone:'.$row["showHeadphone"].',
				nextPrevAdditionalPadding:'.$row["nextPrevAdditionalPadding"].',
				minButtonColor:"#'.$row["minButtonColor"].'"
			});
}, '.($row["delay"]*1000).');
		});
	</script>
    '.$new_div_start.'<div class="audio5_html5_sticky">
		<div class="audio5_html5">
            <audio id="lbg_audio5_html5_shoutcast_'.$row["id"].'" preload="'.$preload_aux.'">
                  <div class="xaudioplaylist">'.$playlist_str.'</div>
              No HTML5 audio playback capabilities for this browser. Use <a href="https://www.google.com/intl/en/chrome/browser/">Chrome Browser!</a>
            </audio>
     </div>
	<br style="clear:both;">
	<div class="audio5_html5_min audio5_html5_arrow_down"></div>

  </div>  '.$new_div_end;

	return str_replace("\r\n", '', $content);
}

function lbg_audio5_html5_shoutcast_shortcode($atts, $content=null) {
	global $wpdb;

	shortcode_atts( array('settings_id'=>''), $atts);
	if ($atts['settings_id']=='')
		$atts['settings_id']=1;


	return lbg_audio5_html5_shoutcast_generate_preview_code($atts['settings_id']);
}



register_activation_hook(__FILE__,"lbg_audio5_html5_shoutcast_activate"); //activate plugin and create the database
register_uninstall_hook(__FILE__, 'lbg_audio5_html5_shoutcast_uninstall'); // on unistall delete all databases
add_action('init', 'lbg_audio5_html5_shoutcast_init_sessions');	// initialize sessions
add_action('init', 'lbg_audio5_html5_shoutcast_load_styles');	// loads required styles
add_action('init', 'lbg_audio5_html5_shoutcast_load_scripts');			// loads required scripts
add_action('admin_menu', 'lbg_audio5_html5_shoutcast_plugin_menu'); // create menus
add_shortcode('lbg_audio5_html5_shoutcast', 'lbg_audio5_html5_shoutcast_shortcode');				// LBG AUDIO5 HTML5 shortcode









/** OTHER FUNCTIONS **/

//stripslashes for an entire array
function lbg_audio5_html5_shoutcast_unstrip_array($array){
	if (is_array($array)) {
		foreach($array as &$val){
			if(is_array($val)){
				$val = unstrip_array($val);
			} else {
				$val = stripslashes($val);

			}
		}
	}
	return $array;
}



function lbg_audio5_html5_footer_function() {
	global $wpdb;
	//$safe_sql=$wpdb->prepare( "SELECT `id`,`activateForFooter` FROM (".$wpdb->prefix ."lbg_audio5_html5_shoutcast_settings)");
	$safe_sql="SELECT `id`,`activateForFooter` FROM (".$wpdb->prefix ."lbg_audio5_html5_shoutcast_settings)";
	$result = $wpdb->get_results($safe_sql,ARRAY_A);


	$shortcode_id=0;
	foreach ( $result as $row ) {
		$row=lbg_audio5_html5_shoutcast_unstrip_array($row);
		if ($row['activateForFooter']==='true') {
			$shortcode_id=$row['id'];
		}
	}
	if ($shortcode_id>0)
    	echo do_shortcode("[lbg_audio5_html5_shoutcast settings_id='".$shortcode_id."']");;
}
add_action( 'wp_footer', 'lbg_audio5_html5_footer_function', 100 );





/* ajax update playlist record */

add_action('admin_head', 'lbg_audio5_html5_shoutcast_update_playlist_record_javascript');

function lbg_audio5_html5_shoutcast_update_playlist_record_javascript() {
	global $wpdb;
	//Set Your Nonce
	$lbg_audio5_html5_shoutcast_update_playlist_record_ajax_nonce = wp_create_nonce("lbg_audio5_html5_shoutcast_update_playlist_record-special-string");
	$lbg_audio5_html5_shoutcast_update_category_record_ajax_nonce = wp_create_nonce("lbg_audio5_html5_shoutcast_update_category_record-special-string");
	$lbg_audio5_html5_shoutcast_preview_record_ajax_nonce = wp_create_nonce("lbg_audio5_html5_shoutcast_preview_record-special-string");

	if(strpos($_SERVER['PHP_SELF'], 'wp-admin') !== false) {
			$page = (isset($_GET['page'])) ? $_GET['page'] : '';
			if(preg_match('/LBG_AUDIO5_HTML5_SHOUTCAST/i', $page)) {
?>



<script type="text/javascript" >
//delete the entire record
function lbg_audio5_html5_shoutcast_delete_entire_record (delete_id) {
	if (confirm('Are you sure?')) {
		jQuery("#lbg_audio5_html5_shoutcast_sortable").sortable('disable');
		jQuery("#"+delete_id).css("display","none");
		//jQuery("#lbg_audio5_html5_shoutcast_sortable").sortable('refresh');
		jQuery("#lbg_audio5_html5_shoutcast_updating_witness").css("display","block");
		var data = "action=lbg_audio5_html5_shoutcast_update_playlist_record&security=<?php echo $lbg_audio5_html5_shoutcast_update_playlist_record_ajax_nonce; ?>&updateType=lbg_audio5_html5_shoutcast_delete_entire_record&delete_id="+delete_id;
		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post(ajaxurl, data, function(response) {
			jQuery("#lbg_audio5_html5_shoutcast_sortable").sortable('enable');
			jQuery("#lbg_audio5_html5_shoutcast_updating_witness").css("display","none");
			//alert('Got this from the server: ' + response);
		});
	}
}

function updateCategory(theCategoryID,theCategory) {
	var data ="action=lbg_audio5_html5_shoutcast_update_category_record&security=<?php echo $lbg_audio5_html5_shoutcast_update_category_record_ajax_nonce; ?>&theCategoryID="+theCategoryID+"&theCategory="+theCategory;

	// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
	jQuery.post(ajaxurl, data, function(response) {
		//alert('Got this from the server: ' + response);
	});
}


function showDialogPreview(theSliderID) {  //load content and open dialog
	var data ="action=lbg_audio5_html5_shoutcast_preview_record&security=<?php echo $lbg_audio5_html5_shoutcast_preview_record_ajax_nonce; ?>&theSliderID="+theSliderID;

	// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
	jQuery.post(ajaxurl, data, function(response) {
		//jQuery("#previewDialog").html(response);
		jQuery('#previewDialogIframe').attr('src','<?php echo plugins_url("tpl/preview.html?d=".time(), __FILE__)?>');
		jQuery("#previewDialog").dialog("open");
	});
}


jQuery(document).ready(function($) {
	/*PREVIEW DIALOG BOX*/
	jQuery( "#previewDialog" ).dialog({
	  minWidth:1200,
	  minHeight:500,
	  title:"Plugin Preview",
	  modal: true,
	  autoOpen:false,
	  hide: "fade",
	  resizable: false,
	  open: function() {
		//jQuery( this ).html();
	  },
	  close: function() {
		//jQuery("#previewDialog").html('');
		jQuery('#previewDialogIframe').attr('src','');
	  }
	});	/*	*/

	if (jQuery('#lbg_audio5_html5_shoutcast_sortable').length) {
		jQuery( '#lbg_audio5_html5_shoutcast_sortable' ).sortable({
			placeholder: "ui-state-highlight",
			start: function(event, ui) {
	            ord_start = ui.item.prevAll().length + 1;
	        },
			update: function(event, ui) {
	        	jQuery("#lbg_audio5_html5_shoutcast_sortable").sortable('disable');
	        	jQuery("#lbg_audio5_html5_shoutcast_updating_witness").css("display","block");
				var ord_stop=ui.item.prevAll().length + 1;
				var elem_id=ui.item.attr("id");
				//alert (ui.item.attr("id"));
				//alert (ord_start+' --- '+ord_stop);
				var data = "action=lbg_audio5_html5_shoutcast_update_playlist_record&security=<?php echo $lbg_audio5_html5_shoutcast_update_playlist_record_ajax_nonce; ?>&updateType=change_ord&ord_start="+ord_start+"&ord_stop="+ord_stop+"&elem_id="+elem_id;
				// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
				jQuery.post(ajaxurl, data, function(response) {
					jQuery("#lbg_audio5_html5_shoutcast_sortable").sortable('enable');
					jQuery("#lbg_audio5_html5_shoutcast_updating_witness").css("display","none");
					//alert('Got this from the server: ' + response);
				});
			}
		});
	}

	<?php
		$rows_count = $wpdb->get_var("SELECT COUNT(*) FROM ". $wpdb->prefix . "lbg_audio5_html5_shoutcast_playlist;");
		for ($i=1;$i<=$rows_count;$i++) {
	?>




	jQuery("#form-playlist-html5-audio5-<?php echo $i?>").submit(function(event) {

		/* stop form from submitting normally */
		event.preventDefault();

		//show loading image
		jQuery('#ajax-message-<?php echo $i?>').html('<img src="<?php echo plugins_url('lbg-audio5-html5-shoutcast_sticky/images/ajax-loader.gif', dirname(__FILE__))?>" />');


		//var data = {
			//action: 'lbg_audio5_html5_shoutcast_update_playlist_record',
			//security: '<?php echo $lbg_audio5_html5_shoutcast_update_playlist_record_ajax_nonce; ?>',
			//whatever: 1234
		//};
		var data ="action=lbg_audio5_html5_shoutcast_update_playlist_record&security=<?php echo $lbg_audio5_html5_shoutcast_update_playlist_record_ajax_nonce; ?>&"+jQuery("#form-playlist-html5-audio5-<?php echo $i?>").serialize();

		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post(ajaxurl, data, function(response) {
			//alert('Got this from the server: ' + response);
			//alert(jQuery("#form-playlist-html5-audio5-<?php echo $i?>").serialize());
			var mov_title = '';
			if (document.forms["form-playlist-html5-audio5-<?php echo $i?>"].title.value!='')
				mov_title=document.forms["form-playlist-html5-audio5-<?php echo $i?>"].title.value;
			jQuery('#mov_title_'+document.forms["form-playlist-html5-audio5-<?php echo $i?>"].id.value).html(mov_title);
			jQuery('#ajax-message-<?php echo $i?>').html(response);
		});
	});
	<?php } ?>

});
</script>
<?php
		}
	}
}

//lbg_audio5_html5_shoutcast_update_playlist_record is the action=lbg_audio5_html5_shoutcast_update_playlist_record

add_action('wp_ajax_lbg_audio5_html5_shoutcast_update_playlist_record', 'lbg_audio5_html5_shoutcast_update_playlist_record_callback');

function lbg_audio5_html5_shoutcast_update_playlist_record_callback() {

	check_ajax_referer( 'lbg_audio5_html5_shoutcast_update_playlist_record-special-string', 'security' ); //security=<?php echo $lbg_audio5_html5_shoutcast_update_playlist_record_ajax_nonce;
	global $wpdb;
	global $lbg_audio5_html5_shoutcast_messages;
	$errors_arr=array();
	//$wpdb->show_errors();

	//delete entire record
	//if ($_POST['updateType']=='lbg_audio5_html5_shoutcast_delete_entire_record') {
	if (array_key_exists('updateType', $_POST) && $_POST['updateType']=='lbg_audio5_html5_shoutcast_delete_entire_record') {
		$delete_id=$_POST['delete_id'];
		$safe_sql=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."lbg_audio5_html5_shoutcast_playlist WHERE id = %d",$delete_id);
		$row = $wpdb->get_row($safe_sql, ARRAY_A);
		$row=lbg_audio5_html5_shoutcast_unstrip_array($row);


		//delete the entire record
		$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix."lbg_audio5_html5_shoutcast_playlist WHERE id = %d",$delete_id));
		//update the oreder for the rest ord=ord-1 for > ord
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."lbg_audio5_html5_shoutcast_playlist SET ord=ord-1 WHERE playerid = %d and  ord>".$row['ord'],$_SESSION['xid']));
	}

	//update elements order
	//if ($_POST['updateType']=='change_ord') {
	if (array_key_exists('updateType', $_POST) && $_POST['updateType']=='change_ord') {
		$sql_arr=array();
		$ord_start=$_POST['ord_start'];
		$ord_stop=$_POST['ord_stop'];
		$elem_id=(int)$_POST['elem_id'];
		$ord_direction='+1';
		if ($ord_start<$ord_stop)
			$sql_arr[]="UPDATE ".$wpdb->prefix."lbg_audio5_html5_shoutcast_playlist SET ord=ord-1  WHERE playerid = ".$_SESSION['xid']." and ord>".$ord_start." and ord<=".$ord_stop;
		else
			$sql_arr[]="UPDATE ".$wpdb->prefix."lbg_audio5_html5_shoutcast_playlist SET ord=ord+1  WHERE playerid = ".$_SESSION['xid']." and ord>=".$ord_stop." and ord<".$ord_start;
		$sql_arr[]="UPDATE ".$wpdb->prefix."lbg_audio5_html5_shoutcast_playlist SET ord=".$ord_stop." WHERE id=".$elem_id;

		//echo "elem_id: ".$elem_id."----ord_start: ".$ord_start."----ord_stop: ".$ord_stop;
		foreach ($sql_arr as $sql)
			$wpdb->query($sql);
	}



	//submit update
	if (!isset($_POST['updateType'])) {
		if (empty($_POST['xradiostream']))
			 $errors_arr[]=$lbg_audio5_html5_shoutcast_messages['empty_stream'];
	}

	$theid=isset($_POST['id'])?$_POST['id']:0;
	if($theid>0 && !count($errors_arr)) {
		$except_arr=array('Submit'.$theid,'id','ord','action','security','updateType','pll_ajax_backend','page_scroll_to_id_instances');
		if(array_key_exists('category', $_POST) && is_array($_POST['category'])) {
				$_POST['category']=implode(";", $_POST['category']);
		}
		foreach ($_POST as $key=>$val){
			if (in_array($key,$except_arr)) {
				unset($_POST[$key]);
			}
		}

		$wpdb->update(
			$wpdb->prefix .'lbg_audio5_html5_shoutcast_playlist',
			$_POST,
			array( 'id' => $theid )
		);
		?>
			<div id="message" class="updated"><p><?php echo $lbg_audio5_html5_shoutcast_messages['data_saved'];?></p></div>
	<?php
	} else if (!isset($_POST['updateType'])) {
		$errors_arr[]=$lbg_audio5_html5_shoutcast_messages['invalid_request'];
	}
    //echo $theid;

	if (count($errors_arr)) { ?>
		<div id="error" class="error"><p><?php echo implode("<br>", $errors_arr);?></p></div>
	<?php }

	wp_die(); // this is required to return a proper result
}


add_action('wp_ajax_lbg_audio5_html5_shoutcast_update_category_record', 'lbg_audio5_html5_shoutcast_update_category_record_callback');

function lbg_audio5_html5_shoutcast_update_category_record_callback() {
	check_ajax_referer( 'lbg_audio5_html5_shoutcast_update_category_record-special-string', 'security' );
	global $wpdb;
	//$wpdb->show_errors();


	if ($_POST['theCategory']!='') {
			$wpdb->update(
				$wpdb->prefix .'lbg_audio5_html5_shoutcast_categories',
				array(
				'categ' => strip_tags($_POST['theCategory'])
				),
				array( 'id' => $_POST['theCategoryID'] )
			);
	}

	wp_die(); // this is required to return a proper result
}


add_action('wp_ajax_lbg_audio5_html5_shoutcast_preview_record', 'lbg_audio5_html5_shoutcast_preview_record_callback');

function lbg_audio5_html5_shoutcast_preview_record_callback() {
	check_ajax_referer( 'lbg_audio5_html5_shoutcast_preview_record-special-string', 'security' );

	//echo lbg_audio5_html5_shoutcast_generate_preview_code($_POST['theSliderID']);
	$aux_val='<html>
					<head>
						<link href="'.plugins_url('audio5_html5/audio5_html5.css', __FILE__).'" rel="stylesheet" type="text/css">

						<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.1/jquery.min.js" type="text/javascript"></script>
						<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
						<script src="'.plugins_url('audio5_html5/js/jquery.mousewheel.min.js', __FILE__).'" type="text/javascript"></script>
						<script src="'.plugins_url('audio5_html5/js/jquery.touchSwipe.min.js', __FILE__).'" type="text/javascript"></script>
						<script src="'.plugins_url('audio5_html5/js/audio5_html5.js', __FILE__).'" type="text/javascript"></script>

					</head>
					<body style="padding:0px;margin:0px;">';

	$aux_val.=lbg_audio5_html5_shoutcast_generate_preview_code($_POST['theSliderID']);
	$aux_val.="</body>
				</html>";
	$filename=plugin_dir_path(__FILE__) . 'tpl/preview.html';
	$fp = fopen($filename, 'w+');
	$fwrite = fwrite($fp, $aux_val);

	echo $fwrite;

	wp_die(); // this is required to return a proper result
}



?>
