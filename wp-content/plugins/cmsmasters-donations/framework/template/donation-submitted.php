<?php
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Donations
 * @version		1.0.0
 *
 * CMSMasters Donation Form Submission Notices Template
 * Created by CMSMasters
 *
 */


switch ($donation->post_status) {
case 'publish':
	echo '<div class="cmsmasters_notice cmsmasters_notice_success cmsmasters_donation_notice cmsmasters_donation_notice_success cmsmasters-icon-check">' .
		'<a class="notice_close cmsmasters_theme_icon_cancel" href="#"></a>' .
		'<div class="notice_icon"></div>' .
		'<div class="notice_content">' .
			wpautop(esc_html__('Donación validada con éxito.', 'cmsmasters_donations')) . 
		'</div>' .
	'</div>';


	break;
case 'pending_payment':
	echo '<div class="cmsmasters_notice cmsmasters_notice_success cmsmasters_donation_notice cmsmasters_donation_notice_success cmsmasters-icon-check">' .
		'<a class="notice_close cmsmasters_theme_icon_cancel" href="#"></a>' .
		'<div class="notice_icon"></div>' .
		'<div class="notice_content">' .
			wpautop(esc_html__("Donación enviada exitosamente.\nSu donación será registrada tan pronto como recibamos la validación de la pasarela de pago (puede tomar varios minutos).", 'cmsmasters_donations')) .
		'</div>' .
	'</div>';


	break;
case 'pending_offline' :
	echo '<div class="cmsmasters_notice cmsmasters_notice_success cmsmasters_donation_notice cmsmasters_donation_notice_success cmsmasters-icon-check">' .
		'<a class="notice_close cmsmasters_theme_icon_cancel" href="#"></a>' .
		'<div class="notice_icon"></div>' .
		'<div class="notice_content">' .
			wpautop(esc_html__("Donación enviada exitosamente.\nSu donación se publicará una vez que se reciba el pago.\nUsted elige un método de pago fuera de línea, así que siga la guía a continuación para enviarnos su pago.", 'cmsmasters_donations')) .
		'</div>' .
	'</div>';


	if (get_option('cmsmasters_donations_offline_payment_text')) {
		echo '<div class="cmsmasters_notice cmsmasters_notice_info cmsmasters_donation_notice cmsmasters_donation_notice_info cmsmasters-icon-info">' .
			'<a class="notice_close cmsmasters_theme_icon_cancel" href="#"></a>' .
			'<div class="notice_icon"></div>' .
			'<div class="notice_content">' .
				wpautop(esc_html(get_option('cmsmasters_donations_offline_payment_text'))) .
			'</div>' .
		'</div>';
	}


	break;
}


echo '<a href="' . get_page_link(get_option('cmsmasters_donations_form_page')) . '" class="button">' . esc_html__('Hacer otra donación', 'cmsmasters_donations') . '</a>';


do_action('cmsmasters_donations_donation_submitted_content_' . str_replace('-', '_', sanitize_title($donation->post_status)), $donation);
