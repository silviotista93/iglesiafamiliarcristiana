<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Base;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */

class SR_Audio_Player extends Widget_Base {

	public function get_name() {
		return 'music-player';
	}

	public function get_title() {
		return __( 'MP3 Music Player', 'sonaar-music' );
	}

	public function get_icon() {
		return 'fa fa-music sonaar-badge';
	}

	public function get_help_url() {
		return 'https://support.sonaar.io';
	}

	public function get_categories() {
		return [ 'elementor-sonaar' ];
	}

	public function get_keywords() {
		return [ 'mp3', 'player', 'audio', 'sonaar', 'podcast', 'music', 'beat', 'sermon', 'episode', 'radio' ,'stream', 'sonar', 'sonnar', 'sonnaar'];
	}

	public function get_script_depends() {
		return [ 'elementor-sonaar' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' 							=> __( 'Music Player Settings', 'sonaar-music' ),
				'tab'   							=> Controls_Manager::TAB_CONTENT,
			]
		);
			
		$this->add_control(
			'playlist_list',
				[
					'label'                 		=> esc_html__( 'Select Playlist(s)', 'sonaar-music' ),
					'label_block'					=> true,
					'description'					=> 'Leave blank if you want to display your latest published playlist',
					'type' 							=> \Elementor\Controls_Manager::SELECT2,
					'multiple' 						=> true,
					'options'               		=> sr_plugin_elementor_select_playlist(),   
					'condition' 					=> [
						'play_current_id' 			=> '',
					]         	
				]
		);
		/*$this->add_control(
			'playlist_autoplay',
			[
				'label' 							=> __( 'Popup player in the footer when page loads', 'sonaar-music' ),
				'type' 								=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 							=> __( 'Yes', 'sonaar-music' ),
				'label_off' 						=> __( 'No', 'sonaar-music' ),
				'return_value' 						=> '1',
				'default' 							=> '0',
			]
		);
		$this->add_control(
			'playlist_shuffle',
			[
				'label' 							=> __( 'Shuffle Track', 'sonaar-music' ),
				'type' 								=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 							=> __( 'Yes', 'sonaar-music' ),
				'label_off' 						=> __( 'No', 'sonaar-music' ),
				'return_value'						=> '1',
				'default' 							=> 'yes',
			]
		);*/
		if ( function_exists( 'run_sonaar_music_pro' ) ){
			$this->add_control(
				'enable_sticky_player',
				[
					'label' 						=> __( 'Enable Sticky Audio Player', 'sonaar-music' ),
					'type' 							=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 						=> __( 'Yes', 'sonaar-music' ),
					'label_off' 					=> __( 'No', 'sonaar-music' ),
					'return_value' 					=> '1',
					'default' 						=> '1', 
				]
			);
		}
		$this->add_control(
			'playlist_show_playlist',
			[
				'label' 							=> __( 'Show Playlist', 'sonaar-music' ),
				'type' 								=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 							=> __( 'Show', 'sonaar-music' ),
				'label_off' 						=> __( 'Hide', 'sonaar-music' ),
				'return_value' 						=> 'yes',
				'default' 							=> 'yes',
			]
		);
		$this->add_control(
			'playlist_show_album_market',
			[
				'label' 							=> __( 'Album Stores', 'sonaar-music' ),
				'type' 								=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 							=> __( 'Show', 'sonaar-music' ),
				'label_off' 						=> __( 'Hide', 'sonaar-music' ),
				'return_value' 						=> 'yes',
				'default' 							=> 'yes',
			]
		);
		$this->add_control(
			'playlist_hide_artwork',
			[
				'label' 							=> __( 'Hide Album Cover', 'sonaar-music' ),
				'type' 								=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 							=> __( 'Hide', 'sonaar-music' ),
				'label_off' 						=> __( 'Show', 'sonaar-music' ),
				'return_value' 						=> 'yes',
				'default' 							=> '',
			]
		);
		$this->add_control(
			'playlist_show_soundwave',
			[
				'label' 							=> __( 'Hide Mini Player / Soundwave', 'sonaar-music' ),
				'type' 								=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 							=> __( 'Hide', 'sonaar-music' ),
				'label_off' 						=> __( 'Show', 'sonaar-music' ),
				'return_value' 						=> 'yes',
				'default' 							=> '',
			]
		);
		$this->add_control(
			'play_current_id',
			[
				'label'							 	=> __( 'Play its own Post ID track', 'sonaar-music' ),
				'description' 						=> __( 'Check this case if this player is intended to be displayed on its own single post', 'sonaar-music' ),
				'type' 								=> \Elementor\Controls_Manager::SWITCHER,
				'yes' 								=> __( 'Yes', 'sonaar-music' ),
				'no' 								=> __( 'No', 'sonaar-music' ),
				'return_value' 						=> 'yes',
				'default' 							=> '',

			]

		);
		/*}*/
	$this->end_controls_section();

		if ( !function_exists( 'run_sonaar_music_pro' ) ){
			$this->start_controls_section(
				'go_pro_content',
				[
					'label' 						=> __( 'Go Pro', 'sonaar-music' ),
					'tab'   						=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'sonaar_go_pro',
				[
					'type' 							=> \Elementor\Controls_Manager::RAW_HTML,
					'raw' 							=> 	'<div class="sr_gopro elementor-nerd-box sonaar-gopro">' .
														'<i class="elementor-nerd-box-icon fa fas fa-bolt" aria-hidden="true"></i>
															<div class="elementor-nerd-box-title">' .
																__( 'Meet the MP3 Player PRO', 'sonaar-music' ) .
															'</div>
															<div class="elementor-nerd-box-message">' .
																__( 'Our PRO version lets you use Elementor\'s Style Editor to customize the look and feel of the player in real-time! Over 70+ options available!', 'sonaar-music' ) .
															'</div>
															<ul>
																<li>Sticky Player with Soundwave</li>
																<li>Elementor Real-Time Style Editor</li>
																<li>Volume Control</li>
																<li>Shuffle Tracks</li>
																<li>Tracklist View</li>
																<li>Statistic Reports</li>
																<li>1 year of support via live chat</li>
																<li>1 year of plugin updates</li>
															</ul>
															<div class="elementor-nerd-box-message">' .
																__( 'All those features are available with the MP3 Player\'s Pro Version.', 'sonaar-music' ) .
															'</div>
															<a class="elementor-nerd-box-link elementor-button elementor-button-default elementor-go-pro" href="https://sonaar.io/free-mp3-music-player-plugin-for-wordpress/?utm_source=Sonaar+Music+Free+Plugin&utm_medium=plugin" target="_blank">' .
															__( 'Go Pro', 'elementor' ) .
															'</a>
														</div>',
				]
			);
		}

		$this->end_controls_section();
		/**
         * STYLE: ARTWORK
         * -------------------------------------------------
         */
		if ( function_exists( 'run_sonaar_music_pro' ) ){
			$this->start_controls_section(
	            'artwork_style',
	            [
	                'label'                 		=> __( 'Album Cover', 'sonaar-music' ),
					'tab'                   		=> Controls_Manager::TAB_STYLE,
					'condition' 					=> [
						'playlist_hide_artwork!' 	=> 'yes',
					],
	            ]
			);
			$this->add_responsive_control(
				'artwork_width',
				[
					'label' 						=> __( 'Image Width', 'sonaar-music' ) . ' (px)',
					'type' 							=> Controls_Manager::SLIDER,
					'range' 						=> [
						'px' 						=> [
							'min' 					=> 1,
							'max' 					=> 450,
						],
					],
					'selectors' 					=> [
													'{{WRAPPER}} .iron-audioplayer .album .album-art' => 'max-width: {{SIZE}}px;',
					],
				]
			);
			$this->add_responsive_control(
				'artwork_padding',
				[
					'label' 						=> __( 'Image Padding', 'sonaar-music' ),
					'type' 							=> Controls_Manager::DIMENSIONS,
					'size_units' 					=> [ 'px', 'em', '%' ],
					'selectors' 					=> [
													'{{WRAPPER}} .iron-audioplayer .sonaar-grid .album' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'artwork_align',
				[
					'label' 						=> __( 'Image Alignment', 'sonaar-music' ),
					'type' 							=> Controls_Manager::CHOOSE,
					'options' 						=> [
						'left'    					=> [
							'title' 				=> __( 'Left', 'elementor' ),
							'icon' 					=> 'eicon-h-align-left',
						],
						'center' 					=> [
							'title' 				=> __( 'Center', 'elementor' ),
							'icon' 					=> 'eicon-h-align-center',
						],
						'right' 					=> [
							'title' 				=> __( 'Right', 'elementor' ),
							'icon' 					=> 'eicon-h-align-right',
						],
					],
					'default' 						=> '',
					'selectors' 					=> [
													'{{WRAPPER}} .iron-audioplayer .sonaar-Artwort-box' => 'justify-self: {{VALUE}}!important; text-align: {{VALUE}};',
					],
				]
			);

			$this->end_controls_section();

	        /**
	         * STYLE: PLAYLIST
	         * -------------------------------------------------
	         */
				
			$this->start_controls_section(
	            'playlist_style',
	            [
	                'label'                			=> __( 'Playlist', 'sonaar-music' ),
					'tab'                   		=> Controls_Manager::TAB_STYLE,
					'condition' 					=> [
						'playlist_show_playlist!' 	=> '',
					],
				]
			);
			$this->add_control(
					'move_playlist_below_artwork',
					[
						'label' 					=> __( 'Move Playlist Below Artwork', 'sonaar-music' ),
						'type' 						=> \Elementor\Controls_Manager::SWITCHER,
						'label_on' 					=> __( 'Yes', 'sonaar-music' ),
						'label_off' 				=> __( 'No', 'sonaar-music' ),
						'return_value' 				=> 'auto',
						'default' 					=> '',
						'condition' 				=> [
							'playlist_hide_artwork!' => 'yes',
						],
						'selectors' 				=> [
													'{{WRAPPER}} .sonaar-Artwort-box' => 'justify-self:center;',
													'{{WRAPPER}} .sonaar-grid' => 'justify-content:center!important;grid-template-columns:{{VALUE}}!important;',
							 
					 ],
					]
			);
			$this->add_control(
				'title_options',
				[
					'label' 						=> __( 'Title Options', 'elementor' ),
					'type' 							=> Controls_Manager::HEADING,
					'separator' 					=> 'before',
				]
			);
			$this->add_control(
				'title_html_tag_playlist',
				[
					'label' => __( 'HTML Title Tag', 'elementor-sonaar' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'h1' => 'H1',
						'h2' => 'H2',
						'h3' => 'H3',
						'h4' => 'H4',
						'h5' => 'H5',
						'h6' => 'H6',
						'div' => 'div',
						'span' => 'span',
						'p' => 'p',
					],
					'default' => 'h3',
				]
			);
			$this->add_control(
				'title_btshow',
				[
					'label' 						=> esc_html__( 'Hide Title', 'sonaar-music' ),
					'type' 							=> Controls_Manager::SWITCHER,
					'default' 						=> '',
					'return_value' 					=> 'none',
					'selectors' 					=> [
						 							'{{WRAPPER}} .playlist .sr_it-playlist-title' => 'display:{{VALUE}};',
					 ],
				]
			);
			$this->add_control(
				'title_color',
				[
					'label'                			=> __( 'Title Color', 'sonaar-music' ),
					'type'                 			=> Controls_Manager::COLOR,
					'default'               		=> '',
					'condition' 					=> [
						'title_btshow'				=> '',
					],
					'selectors'             		=> [
													'{{WRAPPER}} .playlist .sr_it-playlist-title' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 							=> 'title_typography',
					'label' 						=> __( 'Title Typography', 'sonaar-music' ),
					'scheme' 						=> Scheme_Typography::TYPOGRAPHY_1,
					'condition' 					=> [
						'title_btshow' 				=> '',
					],
					'selector' 						=> '{{WRAPPER}} .iron-audioplayer .sr_it-playlist-title',
				]
			);
			$this->add_responsive_control(
				'title_indent',
				[
					
					'label' 						=> __( 'Title Indent', 'sonaar-music' ) . ' (px)',
					'type' 							=> Controls_Manager::SLIDER,
					'range' 						=> [
						'px' 						=> [
							'min' 					=> -500,
						],
					],
					'condition' 					=> [
						'title_btshow' 				=> '',
					],
					'selectors' 					=> [
													'{{WRAPPER}} .sr_it-playlist-title' => 'margin-left: {{SIZE}}px;',
													'{{WRAPPER}} .sr_it-playlist-artists' => 'margin-left: {{SIZE}}px;',
													'{{WRAPPER}} .sr_it-playlist-release-date' => 'margin-left: {{SIZE}}px;',
					],
				]
			);
			$this->add_responsive_control(
				'playlist_justify',
				[
					'label' 						=> __( 'Playlist Alignment', 'sonaar-music' ),
					'type' 							=> Controls_Manager::CHOOSE,
					'options' 						=> [
						'left'    					=> [
							'title' 				=> __( 'Left', 'elementor' ),
							'icon' 					=> 'eicon-h-align-left',
						],
						'center' 					=> [
							'title' 				=> __( 'Center', 'elementor' ),
							'icon' 					=> 'eicon-h-align-center',
						],
						'right' 					=> [
							'title' 				=> __( 'Right', 'elementor' ),
							'icon' 					=> 'eicon-h-align-right',
						],
					],
					'default' 						=> '',
					'selectors' 					=> [
													'{{WRAPPER}} .sonaar-grid .sonaar-Artwort-box' => 'justify-self: {{VALUE}};',
													'{{WRAPPER}} .sonaar-grid' => 'justify-content: {{VALUE}}!important; text-align: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'title_align',
				[
					'label' 						=> __( 'Title Alignment', 'sonaar-music' ),
					'type' 							=> Controls_Manager::CHOOSE,
					'options' 						=> [
						'left'    					=> [
							'title' 				=> __( 'Left', 'elementor' ),
							'icon' 					=> 'eicon-h-align-left',
						],
						'center' 					=> [
							'title' 				=> __( 'Center', 'elementor' ),
							'icon' 					=> 'eicon-h-align-center',
						],
						'right' 					=> [
							'title' 				=> __( 'Right', 'elementor' ),
							'icon' 					=> 'eicon-h-align-right',
						],
					],
					'default' 						=> '',
					'selectors' 					=> [
													'{{WRAPPER}} .sr_it-playlist-title, {{WRAPPER}} .sr_it-playlist-artists, {{WRAPPER}} .sr_it-playlist-release-date' => 'text-align: {{VALUE}}!important;',
					],
				]
			);
			$this->add_responsive_control(
				'tracklist_align',
				[
					'label' 						=> __( 'Tracklist Alignment', 'sonaar-music' ),
					'type' 							=> Controls_Manager::CHOOSE,
					'options' 						=> [
						'left'    					=> [
							'title' 				=> __( 'Left', 'elementor' ),
							'icon' 					=> 'eicon-h-align-left',
						],
						'center' 					=> [
							'title' 				=> __( 'Center', 'elementor' ),
							'icon' 					=> 'eicon-h-align-center',
						],
						'right' 					=> [
							'title' 				=> __( 'Right', 'elementor' ),
							'icon' 					=> 'eicon-h-align-right',
						],
					],
					'default' 						=> '',
					'selectors' 					=> [
													'{{WRAPPER}} .sonaar-grid>div:last-of-type' => 'text-align: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'subtitle_options',
				[
					'label' 						=> __( 'Subtitle Options', 'elementor' ),
					'type' 							=> Controls_Manager::HEADING,
					'separator' 					=> 'before',
				]
			);
			$this->add_control(
				'subtitle_btshow',
				[
					'label' 						=> esc_html__( 'Hide Subtitle', 'sonaar-music' ),
					'type' 							=> Controls_Manager::SWITCHER,
					'default' 						=> '',
					'return_value' 					=> 'none',
					'selectors' 					=> [
							 						'{{WRAPPER}} .sr_it-playlist-release-date' => 'display:{{VALUE}}!important;',
					 ],
				]
			);
			$this->add_control(
				'subtitle-color',
				[
					'label'                		 	=> __( 'Subtitle Color', 'sonaar-music' ),
					'type'                		 	=> Controls_Manager::COLOR,
					'default'            		    => '',
					'condition' 					=> [
						'subtitle_btshow' 			=> '',
					],
					'selectors'             		=> [
													'{{WRAPPER}} .sr_it-playlist-release-date' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 							=> 'subtitle_typography',
					'label' 						=> __( 'Subtitle Typography', 'sonaar-music' ),
					'scheme' 						=> Scheme_Typography::TYPOGRAPHY_1,
					'condition' 					=> [
						'subtitle_btshow' 			=> '',
					],
					'selector' 						=> '{{WRAPPER}} .sr_it-playlist-release-date',
				]
			);
			
			$this->add_control(
				'track_options',
				[
					'label' 						=> __( 'Track Options', 'elementor' ),
					'type' 							=> Controls_Manager::HEADING,
					'separator' 					=> 'before',
				]
			);
			$this->add_control(
				'track_title_color',
				[
					'label'                			=> __( 'Track Title Color', 'sonaar-music' ),
					'type'                 		 	=> Controls_Manager::COLOR,
					'default'               		=> '',
					'selectors'            		 	=> [
													'{{WRAPPER}} .iron-audioplayer .playlist .audio-track, {{WRAPPER}} .iron-audioplayer .playlist .track-number,  {{WRAPPER}} .iron-audioplayer .track-title, {{WRAPPER}} .iron-audioplayer .player' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'tracklist_hover_color',
				[
					'label'                 		=> __( 'Track Title Hover Color', 'sonaar-music' ),
					'type'                  		=> Controls_Manager::COLOR,
					'default'               		=> '',
					'selectors'             		=> [
													'{{WRAPPER}} .iron-audioplayer .playlist .audio-track:hover, {{WRAPPER}} .iron-audioplayer .playlist .audio-track:hover .track-number, {{WRAPPER}} .iron-audioplayer .playlist a.song-store:hover, {{WRAPPER}} .iron-audioplayer .playlist .current a.song-store:hover' => 'color: {{VALUE}}',
													'{{WRAPPER}} .iron-audioplayer .playlist .audio-track:hover path, {{WRAPPER}} .iron-audioplayer .playlist .audio-track:hover rect' => 'fill: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'tracklist_active_color',
				[
					'label'                			=> __( 'Track Title Active Color', 'sonaar-music' ),
					'type'                 			=> Controls_Manager::COLOR,
					'default'              			=> '',
					'selectors'             		=> [
													'{{WRAPPER}} .iron-audioplayer .playlist .current .audio-track, {{WRAPPER}} .iron-audioplayer .playlist .current .audio-track .track-number, {{WRAPPER}} .iron-audioplayer .playlist .current a.song-store' => 'color: {{VALUE}}',
													'{{WRAPPER}} .iron-audioplayer .playlist .current .audio-track path, {{WRAPPER}} .iron-audioplayer .playlist .current .audio-track rect' => 'fill: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 							=> 'track_title_typography',
					'label' 						=> __( 'Track Title Typography', 'sonaar-music' ),
					'scheme' 						=> Scheme_Typography::TYPOGRAPHY_1,
					'selector' 						=> '{{WRAPPER}} .iron-audioplayer .playlist .audio-track, {{WRAPPER}} .iron-audioplayer .playlist .track-number, {{WRAPPER}} .iron-audioplayer .track-title',
				]
			);
			$this->add_control(
				'track_separator_color',
				[
					'label' 						=> __( 'Track Separator Color', 'sonaar-music' ),
					'type' 							=> Controls_Manager::COLOR,
					'default' 						=> '',
					'selectors' 					=> [
													'{{WRAPPER}} .iron-audioplayer .playlist li' => 'border-bottom: solid 1px {{VALUE}}!important;',
					],
				]
			);
			$this->add_control(
				'hide_number_btshow',
				[
					'label' 						=> esc_html__( 'Hide Track Number', 'sonaar-music' ),
					'type' 							=> Controls_Manager::SWITCHER,
					'default' 						=> '',
					'return_value' 					=> 'none',
					'selectors' 					=> [
							 						'{{WRAPPER}} .iron-audioplayer .track-number .number' => 'display:{{VALUE}};',
							 						'{{WRAPPER}} .iron-audioplayer .track-number' => 'padding-right:0;',
					 ],
				]
			);
			$this->add_control(
					'hide_time_duration',
					[
						'label' 					=> __( 'Hide Track Duration', 'sonaar-music' ),
						'type' 						=> \Elementor\Controls_Manager::SWITCHER,
						'label_on' 					=> __( 'Yes', 'sonaar-music' ),
						'label_off' 				=> __( 'No', 'sonaar-music' ),
						'return_value' 				=> 'none',
						'default'					=> '',
						'selectors' 				=> [
							 							'{{WRAPPER}} .iron-audioplayer .tracklist-item-time' => 'display:{{VALUE}};'
					 ],
					]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 							=> 'duration_typography',
					'label' 						=> __( 'Time Duration Typography', 'sonaar-music' ),
					'scheme' 						=> Scheme_Typography::TYPOGRAPHY_1,
					'condition' 					=> [
						'hide_time_duration' 		=> '',
					],
					'selector' 						=> '{{WRAPPER}} .iron-audioplayer .tracklist-item-time',
				]
			);
			$this->add_control(
				'duration_color',
				[
					'label'                			=> __( 'Time Duration Color', 'sonaar-music' ),
					'type'                 			=> Controls_Manager::COLOR,
					'default'               		=> '',
					'condition' 					=> [
						'hide_time_duration' 		=> '',
					],
					'selectors'             		=> [
													'{{WRAPPER}} .tracklist-item-time' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'hr4',
				[
					'type' 							=> \Elementor\Controls_Manager::DIVIDER,
					'style' 						=> 'thick',
				]
			);
			$this->add_control(
				'tracklist_controls_color',
				[
					'label'                			=> __( 'Play/Pause Button Color', 'sonaar-music' ),
					'type'                  		=> Controls_Manager::COLOR,
					'default'              		 	=> '',
					'selectors'             		=> [
													'{{WRAPPER}} .iron-audioplayer .playlist .audio-track path, {{WRAPPER}} .iron-audioplayer .playlist .audio-track rect' => 'fill: {{VALUE}}',
					],
				]
			);
			$this->add_responsive_control(
				'tracklist_controls_size',
				[
					'label' => __( 'Play/Pause Button Size', 'elementor-sonaar' ) . ' (px)',
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' => 50,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .iron-audioplayer .track-number svg' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
						'{{WRAPPER}} .iron-audioplayer .track-number' => 'padding-left: calc({{SIZE}}px + 12px);',
					],
				]
			);
			$this->add_control(
				'cta_icon_options',
				[
					'label' 						=> __( 'Track Icon Buttons', 'elementor' ),
					'type' 							=> Controls_Manager::HEADING,
					'separator' 					=> 'before',
				]
			);
			$this->add_control(
				'hide_track_market',
				[
					'label' 						=> __( 'Hide Track\'s Call-to-Action(s)', 'sonaar-music' ),
					'type' 							=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 						=> __( 'Yes', 'sonaar-music' ),
					'label_off' 					=> __( 'No', 'sonaar-music' ),
					'return_value'					=> 'yes',
					'default' 						=> '',
				]
			);
			$this->add_control(
				'view_icons_alltime',
				[
					'label' 						=> __( 'Display Icons without Popover', 'sonaar-music' ),
					'description' 					=> 'Turn off if you have a lot of icons',
					'type' 							=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 						=> __( 'Yes', 'sonaar-music' ),
					'label_off' 					=> __( 'No', 'sonaar-music' ),
					'return_value' 					=> 'yes',
					'default' 						=> 'yes',
					'condition' 					=> [
													'hide_track_market' => '',
					],
					'selectors'             		=> [
													'{{WRAPPER}} .iron-audioplayer .playlist .store-list .song-store-list-menu .song-store-list-container' => 'opacity: 1;margin-right:-15px;background:none',
													'{{WRAPPER}} .iron-audioplayer .playlist .store-list .song-store-list-menu .fa-ellipsis-v' => 'opacity: 0',
					],
				]
			);
			$this->add_control(
				'popover_icons_store',
				[
					'label' 						=> __( 'Popover Icon Color', 'sonaar-music' ),
					'type'							=> Controls_Manager::COLOR,
					'default' 						=> '',
					'condition' 					=> [
						'view_icons_alltime' 		=> '',
					],
					'selectors'             		=> [
													'{{WRAPPER}} .iron-audioplayer .playlist .song-store-list-menu .fa-ellipsis-v' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'tracklist_icons_color',
				[
					'label'                 		=> __( 'Icons Color', 'sonaar-music' ),
					'type'                  		=> Controls_Manager::COLOR,
					'default'               		=> '',
					'condition' 					=> [
						'hide_track_market' 		=> '',
					],
					'selectors'             		=> [
													'{{WRAPPER}} .iron-audioplayer .playlist a.song-store' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_responsive_control(
				'tracklist_icons_spacing',
				[
					'label' 						=> __( 'Icon Spacing', 'elementor' ) . ' (px)',
					'type' 							=> Controls_Manager::SLIDER,
					'range' 						=> [
						'px' 						=> [
							'max' 					=> 50,
						],
					],
					'condition' 					=> [
						'hide_track_market' 		=> '',
					],
					'selectors' 					=> [
													'{{WRAPPER}} .iron-audioplayer .playlist .store-list .song-store' => 'margin-right: {{SIZE}}px;',
					],

				]
			);
			$this->add_responsive_control(
				'tracklist_icons_size',
				[
					'label' 						=> __( 'Icons Size', 'sonaar-music' ) . ' (px)', 
					'type' 							=> Controls_Manager::SLIDER,
					'range' 						=> [
						'px' 						=> [
							'max' 					=> 50,
						],
					],
					'condition' 					=> [
						'hide_track_market' 		=> '',
					],
					'selectors' 					=> [
													'{{WRAPPER}} .iron-audioplayer .playlist .store-list .song-store .fab, {{WRAPPER}} .iron-audioplayer .playlist .store-list .song-store .fas' => 'font-size: {{SIZE}}px;',
					],
				]
			);
			$this->add_control(
				'hr8',
				[
					'type' 							=> \Elementor\Controls_Manager::DIVIDER,
					'style' 						=> 'thick',
				]
			);

			$this->add_responsive_control(
				'playlist_margin',
				[
					'label' 						=> __( 'Playlist Margin', 'sonaar-music' ) . ' (px)', 
					'type' 							=> Controls_Manager::DIMENSIONS,
					'size_units' 					=> [ 'px', 'em', '%' ],
					'selectors' 					=> [
													'{{WRAPPER}} .playlist' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'tracklist_margin',
				[
					'label' 						=> __( 'Tracks Margin', 'sonaar-music' ) . ' (px)', 
					'type' 							=> Controls_Manager::DIMENSIONS,
					'size_units' 					=> [ 'px', 'em', '%' ],
					'selectors' 					=> [
													'{{WRAPPER}} .iron-audioplayer .playlist ul' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'playlist_width',
				[
					'label' 						=> __( 'Playlist Width', 'sonaar-music' ) . ' (px)',
					'type'							=> Controls_Manager::SLIDER,
					'range' 						=> [
						'px' 						=> [
							'max' 					=> 1000,
						],
					],
					'selectors' 					=> [
													'{{WRAPPER}} .iron-audioplayer .playlist' => 'width: {{SIZE}}px;',
					],
				]
			);	
			$this->end_controls_section();

			/**
	         * STYLE: Album Stores
	         * -------------------------------------------------
	         */
			
			$this->start_controls_section(
	            'album_stores',
	            [
	                'label'                			=> __( 'Album Stores', 'sonaar-music' ),
					'tab'                   		=> Controls_Manager::TAB_STYLE,
					'condition' 					=> [
						'playlist_show_album_market' => 'yes',
					],
					
	            ]
			);
			$this->add_control(
				'store_heading_options',
				[
					'label' 						=> __( 'Heading Option', 'elementor' ),
					'type' 							=> Controls_Manager::HEADING,
					'separator' 					=> 'before',
				]
			);
			$this->add_control(
				'store_title_btshow',
				[
					'label' 						=> esc_html__( 'Hide Stores Heading', 'sonaar-music' ),
					'type' 							=> Controls_Manager::SWITCHER,
					'default' 						=> '',
					'return_value' 					=> 'none',
					'selectors' 					=> [
							 						'{{WRAPPER}} .available-now' => 'display:{{VALUE}};',
					 ],
				]
			);
			$this->add_control(
				'store_title_text',
				[
					'label' 						=> __( 'Stores Heading', 'sonaar-music' ),
					'type' 							=> Controls_Manager::TEXT,
					'dynamic' 						=> [
						'active' 					=> true,
					],
					'default' 						=> '',
					'condition' 					=> [
						'store_title_btshow' 		=> '',
					],
					'label_block' 					=> false,
				]
			);
			$this->add_control(
				'store_title_color',
				[
					'label'                 		=> __( 'Store Title Color', 'sonaar-music' ),
					'type'                  		=> Controls_Manager::COLOR,
					'default'               		=> '',
					'condition' 					=> [
						'store_title_btshow' 		=> '',
					],
					'selectors'             		=> [
						'{{WRAPPER}} .available-now' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 							=> 'store_title_typography',
					'label' 						=> __( 'Store Title Typography', 'sonaar-music' ),
					'scheme' 						=> Scheme_Typography::TYPOGRAPHY_1,
					'condition' 					=> [
						'store_title_btshow' 		=> '',
					],
					'selector' 						=> '{{WRAPPER}} .available-now',
				]
			);
			$this->add_responsive_control(
				'store_title_align',
				[
					'label' 						=> __( 'Store Title Alignment', 'sonaar-music' ),
					'type' 							=> Controls_Manager::CHOOSE,
					'options' 						=> [
						'left'    					=> [
							'title' 				=> __( 'Left', 'elementor' ),
							'icon' 					=> 'eicon-h-align-left',
						],
						'center' 					=> [
							'title' 				=> __( 'Center', 'elementor' ),
							'icon' 					=> 'eicon-h-align-center',
						],
						'right' 					=> [
							'title' 				=> __( 'Right', 'elementor' ),
							'icon' 					=> 'eicon-h-align-right',
						],
					],
					'default' 						=> '',
					'condition' 					=> [
						'store_title_btshow' 		=> '',
					],
					'selectors' 					=> [
													'{{WRAPPER}} .available-now' => 'text-align: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'album_stores_align',
				[
					'label'						 	=> __( 'Album Store Alignment', 'sonaar-music' ),
					'type' 							=> Controls_Manager::CHOOSE,
					'options' 						=> [
						'left'    					=> [
							'title' 				=> __( 'Left', 'elementor' ),
							'icon' 					=> 'eicon-h-align-left',
						],
						'center' 					=> [
							'title' 				=> __( 'Center', 'elementor' ),
							'icon' 					=> 'eicon-h-align-center',
						],
						'right' 					=> [
							'title' 				=> __( 'Right', 'elementor' ),
							'icon' 					=> 'eicon-h-align-right',
						],
					],
					'default' 						=> '',
					'selectors' 					=> [
													'{{WRAPPER}} .buttons-block .store-list, {{WRAPPER}} .buttons-block' => 'text-align: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'hr5',
				[
					'type' 							=> \Elementor\Controls_Manager::DIVIDER,
					'style' 						=> 'thick',
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 							=> 'store_button_typography',
					'label'						 	=> __( 'Store Button Typography', 'sonaar-music' ),
					'scheme' 						=> Scheme_Typography::TYPOGRAPHY_1,
					'selector' 						=> '{{WRAPPER}} a.button',
				]
			);

			$this->start_controls_tabs( 'tabs_button_style' );

			$this->start_controls_tab(
				'tab_button_normal',
				[
					'label' 						=> __( 'Normal', 'elementor' ),
				]
			);

			$this->add_control(
				'button_text_color',
				[
					'label' 						=> __( 'Button Text Color', 'sonaar-music' ),
					'type' 							=> Controls_Manager::COLOR,
					'default' 						=> '',
					'selectors' 					=> [
													'{{WRAPPER}} a.button' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'background_color',
				[
					'label' 						=> __( 'Button Background Color', 'sonaar-music' ),
					'type' 							=> Controls_Manager::COLOR,
					'scheme' 						=> [
						'type' 						=> Scheme_Color::get_type(),
						'value' 					=> Scheme_Color::COLOR_4,
					],
					'selectors' 					=> [
													'{{WRAPPER}} a.button' => 'background: {{VALUE}}',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_button_hover',
				[
					'label' 						=> __( 'Hover', 'elementor' ),
				]
			);

			$this->add_control(
				'button_hover_color',
				[
					'label' 						=> __( 'Button Text Color', 'sonaar-music' ),
					'type' 							=> Controls_Manager::COLOR,
					'selectors' 					=> [
													'{{WRAPPER}} a.button:hover' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'button_background_hover_color',
				[
					'label' 						=> __( 'Button Background Color', 'sonaar-music' ),
					'type' 							=> Controls_Manager::COLOR,
					'selectors'					 	=> [
													'{{WRAPPER}} a.button:hover' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'button_hover_border_color',
				[
					'label' 						=> __( 'Button Border Color', 'sonaar-music' ),
					'type' 							=> Controls_Manager::COLOR,
					'condition' 					=> [
						'border_border!' 			=> '',
					],
					'selectors' 					=> [
													'{{WRAPPER}} a.button:hover' => 'border-color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 							=> 'border',
					'selector' 						=> '{{WRAPPER}} .buttons-block .store-list li .button',
					'separator' 					=> 'before',
				]
			);
			$this->add_control(
				'button_border_radius',
				[
					'label' 						=> __( 'Button Radius', 'elementor' ),
					'type' 							=> Controls_Manager::SLIDER,
					'range' 						=> [
						'px' 						=> [
							'max' 					=> 20,
						],
					],
					'selectors' 					=> [
													'{{WRAPPER}} .store-list .button' => 'border-radius: {{SIZE}}px;',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 							=> 'button_box_shadow',
					'selector' 						=> '{{WRAPPER}} .store-list .button',
				]
			);
			$this->add_responsive_control(
				'button_text_padding',
				[
					'label' 						=> __( 'Button Padding', 'sonaar-music' ),
					'type' 							=> Controls_Manager::DIMENSIONS,
					'size_units' 					=> [ 'px', 'em', '%' ],
					'selectors' 					=> [
													'{{WRAPPER}} .iron_widget_radio .store-list .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' 					=> 'before',
				]
			);
			$this->add_responsive_control(
				'space_between_store_button',
				[
					'label' 						=> __( 'Buttons Space', 'sonaar-music' ) . ' (px)',
					'type' 							=> Controls_Manager::SLIDER,
					'range' 						=> [
						'px' 						=> [
							'max' 					=> 50,
						],
					],
					'selectors' 					=> [
													'{{WRAPPER}} .buttons-block li' => 'padding-right: {{SIZE}}px; padding-bottom: {{SIZE}}px;', 
					],
				]
			);
			$this->add_control(
				'hr6',
				[
					'type' 							=> \Elementor\Controls_Manager::DIVIDER,
					'style' 						=> 'thick',
				]
			);
			$this->add_control(
				'store_icon_show',
				[
					'label' 						=> esc_html__( 'Hide Icon', 'sonaar-music' ),
					'type' 							=> Controls_Manager::SWITCHER,
					'default' 						=> '',
					'return_value' 					=> 'none',
					'selectors' 					=> [
							 						'{{WRAPPER}} .store-list .button i' => 'display:{{VALUE}};',
					 ],
				]
			);
			$this->add_responsive_control(
				'icon-font-size',
				[
					'label'							=> __( 'Icon Font Size', 'sonaar-music' ) . ' (px)',
					'type' 							=> Controls_Manager::SLIDER,
					'condition' 					=> [
						'store_icon_show'			=> '',
					],
					'range' 						=> [
						'px' 						=> [
						'max' 						=> 100,
						],
					],
					'selectors'						=> [
													'{{WRAPPER}} .buttons-block .store-list i' => 'font-size: {{SIZE}}px;', 
					],
				]
			);
			$this->add_responsive_control(
				'icon_indent',
				[
					'label' 						=> __( 'Icon Spacing', 'elementor' ) . ' (px)',
					'type' 							=> Controls_Manager::SLIDER,
					'condition' 					=> [
						'store_icon_show' 			=> '',
					],
					'range' 						=> [
						'px' 						=> [
						'max' 						=> 50,
						],
					],
					'selectors' 					=> [
													'{{WRAPPER}} .buttons-block .store-list i' => 'margin-right: {{SIZE}}px;',
					],
				]
			);

			$this->add_control(
				'hr11',
				[
					'type' 							=> \Elementor\Controls_Manager::DIVIDER,
					'style' 						=> 'thick',
				]
			);
			$this->add_responsive_control(
				'album_stores_padding',
				[
					'label' 						=> __( 'Album Stores Padding', 'sonaar-music' ),
					'type' 							=> Controls_Manager::DIMENSIONS,
					'size_units' 					=> [ 'px', 'em', '%' ],
					'selectors' 					=> [
													'{{WRAPPER}} .iron-audioplayer.show-playlist .buttons-block' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_section();

			/**
	         * STYLE: SOUNDWAVE 
	         * -------------------------------------------------
	         */
			
			$this->start_controls_section(
	            'player',
	            [
	                'label'							=> __( 'Mini Player & Soundwave', 'sonaar-music' ),
					'tab'							=> Controls_Manager::TAB_STYLE,
					'condition' 					=> [
						'playlist_show_soundwave!'	=> 'yes',
					],
	            ]
			);
			$this->add_control(
				'title_soundwave_show',
				[
					'label' 						=> esc_html__( 'Hide Title', 'sonaar-music' ),
					'type' 							=> Controls_Manager::SWITCHER,
					'default'						=> '',
					'return_value' 					=> 'none',
					'selectors' 					=> [
							 						'{{WRAPPER}} .iron-audioplayer .track-title' => 'display:{{VALUE}};',
					 ],
				]
			);
			$this->add_control(
				'title_html_tag_soundwave',
				[
					'label' => __( 'HTML Title Tag', 'elementor-sonaar' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'h1' => 'H1',
						'h2' => 'H2',
						'h3' => 'H3',
						'h4' => 'H4',
						'h5' => 'H5',
						'h6' => 'H6',
						'div' => 'div',
						'span' => 'span',
						'p' => 'p',
					],
					'default' => 'div',
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 							=> 'title_soundwave_typography',
					'label' 						=> __( 'Title Typography', 'sonaar-music' ),
					'scheme' 						=> Scheme_Typography::TYPOGRAPHY_1,
					'condition' 					=> [
						'title_soundwave_show' 		=> '',
					],
					'selector' 						=> '{{WRAPPER}} .iron-audioplayer .track-title',
				]
			);
			$this->add_control(
				'title_soundwave_color',
				[
					'label'                			=> __( 'Title Color', 'sonaar-music' ),
					'type'                  		=> Controls_Manager::COLOR,
					'default'               		=> '',
					'condition' 					=> [
						'title_soundwave_show' 		=> '',
					],
					'selectors'             		=> [
													'{{WRAPPER}} .iron-audioplayer .track-title, {{WRAPPER}} .iron-audioplayer .player' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'hr',
				[
					'type' 							=> \Elementor\Controls_Manager::DIVIDER,
					'style' 						=> 'thick',
					'condition' 					=> [
						'title_soundwave_show' 		=> '',
					],
				]
			);
			$this->add_control(
				'soundwave_show',
				[
					'label' 						=> esc_html__( 'Hide SoundWave', 'sonaar-music' ),
					'type' 							=> Controls_Manager::SWITCHER,
					'default' 						=> '',
					'return_value' 					=> 'none',
					'selectors' 					=> [
							 						'{{WRAPPER}} .iron-audioplayer .player .wave, {{WRAPPER}} .iron-audioplayer .currentTime, {{WRAPPER}} .iron-audioplayer .totalTime' => 'display:{{VALUE}};',
					 ],
				]
			);
			$this->add_control(
				'soundWave_progress_bar_color',
				[
					'label'                 		=> __( 'SoundWave Progress Bar Color', 'sonaar-music' ),
					'type'                  		=> Controls_Manager::COLOR,
					'default'               		=> '',
					'condition' 					=> [
						'soundwave_show' 			=> '',
					],
					
				]
			);
			$this->add_control(
				'soundWave_bg_bar_color',
				[
					'label'                 		=> __( 'SoundWave Background Color', 'sonaar-music' ),
					'type'                  		=> Controls_Manager::COLOR,
					'default'               		=> '',
					'condition' 					=> [
						'soundwave_show' 			=> '',
					],

				]
			);
			$this->add_control(
				'hr_sw1',
				[
					'type' 							=> \Elementor\Controls_Manager::DIVIDER,
					'style' 						=> 'thick',
				]
			);
			$this->add_control(
				'audio_player_controls_color',
				[
					'label'                 		=> __( 'Audio Player Controls Color', 'sonaar-music' ),
					'type'                  		=> Controls_Manager::COLOR,
					'default'               		=> '',
					'selectors'             		=> [
													'{{WRAPPER}} .iron-audioplayer .player .control path, {{WRAPPER}} .iron-audioplayer .player .control rect, {{WRAPPER}} .iron-audioplayer .player .control polygon' => 'fill: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'hr_sw',
				[
					'type' 							=> \Elementor\Controls_Manager::DIVIDER,
					'style' 						=> 'thick',
				]
			);
			$this->add_control(
				'duration_soundwave_show',
				[
					'label' 						=> esc_html__( 'Hide Time Durations', 'sonaar-music' ),
					'type' 							=> Controls_Manager::SWITCHER,
					'default' 						=> '',
					'return_value' 					=> 'none',
					'condition' 					=> [
						'soundwave_show' 			=> '',
					],
					'selectors' 					=> [
							 						'{{WRAPPER}} .iron-audioplayer .currentTime, {{WRAPPER}} .iron-audioplayer .totalTime' => 'display:{{VALUE}};',
					 ],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 							=> 'duration_soundwave_typography',
					'label' 						=> __( 'Time Typography', 'sonaar-music' ),
					'scheme' 						=> Scheme_Typography::TYPOGRAPHY_1,
					'condition' 					=> [
						'duration_soundwave_show' 	=> '',
						'soundwave_show' 			=> '',
					],
					'selector' 						=> '{{WRAPPER}} .iron-audioplayer .player',
				]
			);
			$this->add_control(
				'duration_soundwave_color',
				[
					'label'                 		=> __( 'Time Color', 'sonaar-music' ),
					'type'                  		=> Controls_Manager::COLOR,
					'default'               		=> '',
					'condition' 					=> [
						'duration_soundwave_show' 	=> '',
						'soundwave_show' 			=> '',
					],
					'selectors'            			=> [
													'{{WRAPPER}} .iron-audioplayer .player' => 'color: {{VALUE}}',
					],
				]
			);
			$this->end_controls_section();
		// end if function exist
		}
		//
		
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$playlist_show_album_market = (($settings['playlist_show_album_market']=="yes") ? 'true' : 'false');
		$playlist_show_playlist = (($settings['playlist_show_playlist']=="yes") ? 'true' : 'false');
		$playlist_show_soundwave = (($settings['playlist_show_soundwave']=="yes") ? 'true' : 'false');
		$playlist_playlist_hide_artwork = (($settings['playlist_hide_artwork']=="yes") ? 'true' : 'false');

		if ( function_exists( 'run_sonaar_music_pro' ) ){
			$sticky_player = $settings['enable_sticky_player'];
			$wave_color = $settings['soundWave_bg_bar_color'];
			$wave_progress_color = $settings['soundWave_progress_bar_color'];
		}else{
			$sticky_player = false;
			$wave_color = false;
			$wave_progress_color = false;
			$settings['title_html_tag_soundwave'] = 'div';
			$settings['title_html_tag_playlist'] = 'h3';
		}

		$shortcode = '[sonaar_audioplayer titletag_soundwave="'. $settings['title_html_tag_soundwave'] .'" titletag_playlist="'. $settings['title_html_tag_playlist'] .'" hide_artwork="' . $playlist_playlist_hide_artwork .'" show_playlist="' . $playlist_show_playlist .'" show_album_market="' . $playlist_show_album_market .'" remove_player="' . $playlist_show_soundwave .'" sticky_player="' . $sticky_player .'" wave_color="' . $wave_color .'" wave_progress_color="' . $wave_progress_color .'" ';
		
		if (isset($settings['hide_track_market']) && function_exists( 'run_sonaar_music_pro' )){
			$playlist_hide_track_market = (($settings['hide_track_market']=="yes") ? 'false' : 'true');
			$shortcode .= 'show_track_market="' . $playlist_hide_track_market . '" ';
		}else{
			$shortcode .= 'show_track_market="true" ';
		}

		if (isset($settings['store_title_text']) && function_exists( 'run_sonaar_music_pro' )){
			$shortcode .= 'store_title_text="' . $settings['store_title_text'] . '" ';
		}

		if ($settings['play_current_id']=='yes' ){ //If "Play its own Post ID track" option is enable
			$postid = get_the_ID();
			$shortcode .= 'albums="' . $postid . '" ';
		}else{

			$display_playlist_ar = $settings['playlist_list'];

			if(is_array($display_playlist_ar)){
				$display_playlist_ar = implode(", ", $display_playlist_ar); 
			}

			// WIP
			if (!$display_playlist_ar) { //If no playlist is selected, play the latest playlist
				$shortcode .= 'play-latest="yes" ';
			}else{
				$shortcode .= 'albums="' . $display_playlist_ar . '" ';
			}
		
		}
		$shortcode .= ']';
		//Attention: double brackets are required if using var_dump to display a shortcode otherwise it will render it!
		//print_r("Shortcode = [" . $shortcode . "]");
		echo do_shortcode( $shortcode );
	}
	public function render_plain_content() {
		$settings = $this->get_settings_for_display();
		
		if ( function_exists( 'run_sonaar_music_pro' ) ){
			$sticky_player = $settings['enable_sticky_player'];
			$wave_color = $settings['soundWave_bg_bar_color'];
			$wave_progress_color = $settings['soundWave_progress_bar_color'];
		}else{
			$sticky_player = false;
			$wave_color = false;
			$wave_progress_color = false;
		}
		
		$shortcode = '[sonaar_audioplayer titletag_soundwave="'. $settings['title_html_tag_soundwave'] .'" titletag_playlist="'. $settings['title_html_tag_playlist'] .'" store_title_text="' . $settings['store_title_text'] .'" hide_artwork="' . $playlist_playlist_hide_artwork .'" show_playlist="' . $playlist_show_playlist .'" show_track_market="' . $playlist_hide_track_market .'" show_album_market="' . $playlist_show_album_market .'" remove_player="' . $playlist_show_soundwave .'" sticky_player="' . $sticky_player .'" wave_color="' . $wave_color .'" wave_progress_color="' . $wave_progress_color .'" ';
		if ($settings['play_current_id']=='yes'){
			$postid = get_the_ID();
			$shortcode .= 'albums="' . $postid . '" ';
		}else{
			$display_playlist_ar = $settings['playlist_list'];

			if(is_array($display_playlist_ar)){
				$display_playlist_ar = implode(", ", $display_playlist_ar); 
			}
			if (!$display_playlist_ar) {
				$shortcode .= 'play-latest="yes" ';
			}else{
				$shortcode .= 'albums="' . $display_playlist_ar . '" ';
			}
		
		}
		$shortcode .= ']';
		echo $shortcode;
	}

	protected function _content_template() {
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new SR_Audio_Player() );