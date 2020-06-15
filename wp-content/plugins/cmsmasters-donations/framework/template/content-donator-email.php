<?php
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Donations
 * @version		1.0.0
 *
 * CMSMasters Donations Donator Email Template
 * Created by CMSMasters
 *
 */


?>
<?php the_title(); ?>: <?php echo get_permalink(); ?>


** <?php _e( 'Motivo:', 'cmsmasters_donations' ); ?> <?php echo get_the_donation_campaign(); ?>

** <?php _e( 'Monto:', 'cmsmasters_donations' ); ?> <?php echo get_the_donation_amount_currency(); ?>

** <?php _e( 'Donación recurrente:', 'cmsmasters_donations' ); ?> <?php is_recurring_donation(); ?>


----
