<?php
//must check that the user has the required capability 
if (!current_user_can('manage_options')) {
    wp_die(__('You do not have sufficient permissions to access this page.'));
}


//Submit form
if (isset($_POST['send_form']) && $_POST['send_form'] == 'Y') {

    $do_not_save = array('send_form', 'submit', 'wmc_restore_default');
    foreach ($_POST as $option_name => $option_value) {
        if (in_array($option_name, $do_not_save))
            continue;

        // Save the posted value in the database
        update_option($option_name, $option_value);
    }

    if (isset($_POST['wmc_scroll_to_error']) && $_POST['wmc_scroll_to_error'] != 'yes') {
        update_option('wmc_scroll_to_error', 'no');
    }

    // If restore to default
    if (isset($_POST['wmc_restore_default']) && $_POST['wmc_restore_default']) {
        $do_not_save = array('wmc_merge_order_payment_tabs', 'wmc_zipcode_validation', 'wmc_email_error', 'wmc_phone_error', 'wmc_empty_error', 'wmc_add_coupon_form', 'wmc_add_register_form');
        foreach ($_POST as $option_name => $option_value) {
            if (in_array($option_name, $do_not_save))
                continue;
            delete_option($option_name);
        }
    }
    ?>
    <div class="updated"><p><strong><?php _e('settings saved.', 'woocommerce-multistep-checkout'); ?></strong></p></div>
    <?php
}
?>
<div class="wrapper wrap woocommerce">
    <div id="icon-edit" class="icon32"></div><h2><?php _e('WooCommerce MultiStep-Checkout', 'woocommerce-multistep-checkout') ?></h2>
    <form name="wccheckout_options" method="post" action="">
        <input type="hidden" name="send_form" value="Y">
        <table class="form-table">

            <tr valign="top">
                <th scope="row" class="titledesc">
                    <label for="wmc_wizard_type"><?php _e('Wizard Type', 'woocommerce-multistep-checkout');
                    echo wc_help_tip("Select the type of Wizard"); ?>
                    </label>
                </th>
                <td class="forminp"><select name="wmc_wizard_type" id="wmc_wizard_type">
                        <option value="elegant" <?php selected(get_option('wmc_wizard_type'), 'elegant', true); ?>><?php _e('Elegant', 'woocommerce-multistep-checkout') ?></option>
                        <option value="classic" <?php selected(get_option('wmc_wizard_type'), 'classic', true); ?>><?php _e('Classic', 'woocommerce-multistep-checkout') ?></option>
                        <option value="modern" <?php selected(get_option('wmc_wizard_type'), 'modern', true); ?>><?php _e('Modern', 'woocommerce-multistep-checkout') ?></option>
                        <option value="progressbar" <?php selected(get_option('wmc_wizard_type'), 'progressbar', true); ?>><?php _e('Progress Bar', 'woocommerce-multistep-checkout') ?></option>
                    </select>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row" class="titledesc"><label for="wmc_add_login_form"><?php _e('Add Login to Wizard', 'woocommerce-multistep-checkout');?><?php echo wc_help_tip("Add Login form to wizard"); ?></label></th>
                <td class="forminp"><select name="wmc_add_login_form" id="wmc_add_login_form">
                        <option value="true" <?php selected(get_option('wmc_add_login_form'), 'true', true); ?>><?php _e('Yes', 'woocommerce-multistep-checkout') ?></option>
                        <option value="false" <?php selected(get_option('wmc_add_login_form'), 'false', true); ?>><?php _e('No', 'woocommerce-multistep-checkout') ?></option>
                    </select>
                </td>
            </tr>

           <tr valign="top">
               <th scope="row" class="titledesc"><label for="wmc_add_register_form"><?php _e('Add Registration to Wizard', 'woocommerce-multistep-checkout'); echo wc_help_tip("Registration form will be shown only if Login form is part of wizard")?></label></th>
                <td class="forminp"><select name="wmc_add_register_form" id="wmc_add_register_form">                            
                        <option value="false" <?php selected(get_option('wmc_add_register_form'), 'false', true); ?>><?php _e('No', 'woocommerce-multistep-checkout') ?></option>
                        <option value="true" <?php selected(get_option('wmc_add_register_form'), 'true', true); ?>><?php _e('Yes', 'woocommerce-multistep-checkout') ?></option>
                    </select>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row" class="titledesc"><label for="wmc_add_coupon_form"><?php _e('Add Coupon to Wizard', 'woocommerce-multistep-checkout') ?> <?php echo wc_help_tip('Add Coupon form to wizard') ?></label></th>
                <td class="forminp"><select name="wmc_add_coupon_form" id="wmc_add_coupon_form">
                        <option value="true" <?php selected(get_option('wmc_add_coupon_form'), 'true', true); ?>><?php _e('Yes', 'woocommerce-multistep-checkout') ?></option>                                                        
                        <option value="false" <?php selected(get_option('wmc_add_coupon_form'), 'false', true); ?>><?php _e('No', 'woocommerce-multistep-checkout') ?></option>
                    </select>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row" class="titledesc">
                    <label for="wmc_merge_billing_shipping_tabs"><?php _e('Combine Billing & shipping', 'woocommerce-multistep-checkout') ?> <?php echo wc_help_tip('If you want to combine Billing and Shipping steps then set this to Yes') ?></label>
                </th>
                <td class="forminp"><select name="wmc_merge_billing_shipping_tabs" id="wmc_merge_billing_shipping_tabs">
                        <option value="true" <?php selected(get_option('wmc_merge_billing_shipping_tabs'), 'true', true); ?>><?php _e('Yes', 'woocommerce-multistep-checkout') ?></option>
                        <option value="false" <?php selected(get_option('wmc_merge_billing_shipping_tabs'), 'false', true); ?>><?php _e('No', 'woocommerce-multistep-checkout') ?></option>
                    </select>
                </td>
            </tr>            


            <tr valign="top">
                <th scope="row" class="titledesc">
                    <label for="wmc_merge_order_payment_tabs"><?php _e('Combine order Infomation and Payment Steps', 'woocommerce-multistep-checkout') ?> <?php echo wc_help_tip('If you want to combine Order information and Payment steps then set this to Yes') ?></label>
                    </th>
                <td class="forminp"><select name="wmc_merge_order_payment_tabs" id="wmc_merge_order_payment_tabs">
                        <option value="true" <?php selected(get_option('wmc_merge_order_payment_tabs'), 'true', true); ?>><?php _e('Yes', 'woocommerce-multistep-checkout') ?></option>
                        <option value="false" <?php selected(get_option('wmc_merge_order_payment_tabs'), 'false', true); ?>><?php _e('No', 'woocommerce-multistep-checkout') ?></option>
                    </select>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row" class="titledesc">
                    <label for="wmc_add_order_review"><?php _e('Add Order Review step', 'woocommerce-multistep-checkout') ?> <?php echo wc_help_tip('Set this option to Yes if you want to show order review step') ?></label>
                </th>
                <td class="forminp"><select name="wmc_add_order_review" id="wmc_add_order_review">                        
                        <option value="false" <?php selected(get_option('wmc_add_order_review'), 'false', true); ?>><?php _e('No', 'woocommerce-multistep-checkout') ?></option>
                        <option value="true" <?php selected(get_option('wmc_add_order_review'), 'true', true); ?>><?php _e('Yes', 'woocommerce-multistep-checkout') ?></option>
                    </select>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row" class="titledesc"><label for="wmc_show_product_thumbnail"><?php _e('Product Thumbnail', 'woocommerce-multistep-checkout') ?> <?php echo wc_help_tip('Show product thumbnail in the order information table'); ?></label></th>
                <td><select name="wmc_show_product_thumbnail" id="wmc_show_product_thumbnail">
                        <option value="false" <?php selected(get_option('wmc_show_product_thumbnail'), 'false', true); ?>><?php _e('No', 'woocommerce-multistep-checkout') ?></option>
                        <option value="true" <?php selected(get_option('wmc_show_product_thumbnail'), 'true', true); ?>><?php _e('Yes', 'woocommerce-multistep-checkout') ?></option>
                    </select>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row" class="titledesc"><label for="wmc_animation"><?php _e('Animation', 'woocommerce-multistep-checkout') ?> <?php echo wc_help_tip('Select the type of animation') ?></label></th>
                <td><select name="wmc_animation" id="wmc_animation">
                        <option value="fade" <?php selected(get_option('wmc_animation'), 'fade', true); ?>><?php _e('Fade', 'woocommerce-multistep-checkout') ?></option>
                        <option value="slide" <?php selected(get_option('wmc_animation'), 'slide', true); ?>><?php _e('Slide', 'woocommerce-multistep-checkout') ?></option>
                    </select>
                </td>
            </tr>


            <tr valign="top">
                <th scope="row" class="titledesc"><label for="wmc_orientation"><?php _e('Orientation', 'woocommerce-multistep-checkout') ?> <?php echo wc_help_tip("Vertical orientation is not applicable to Modernwizard type") ?></label></th>
                <td><select name="wmc_orientation" id="wmc_orientation">
                        <option value="horizontal" <?php selected(get_option('wmc_orientation'), 'horizontal', true); ?>><?php _e('Horizontal', 'woocommerce-multistep-checkout') ?></option>
                        <option value="vertical" <?php selected(get_option('wmc_orientation'), 'vertical', true); ?>><?php _e('Vertical', 'woocommerce-multistep-checkout') ?></option>
                    </select>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row" class="titledesc"><label for=""></label><?php _e('Remove Numbers', 'woocommerce-multistep-checkout') ?> <?php echo wc_help_tip("Remove Numbers From Steps") ?></th>
                <td><select name="wmc_remove_numbers">
                        <option value="false" <?php selected(get_option('wmc_remove_numbers'), 'false', true); ?>><?php _e('No', 'woocommerce-multistep-checkout') ?></option>
                        <option value="true" <?php selected(get_option('wmc_remove_numbers'), 'true', true); ?>><?php _e('Yes', 'woocommerce-multistep-checkout') ?></option>
                    </select>
                </td>
            </tr>

           <tr valign="top">
               <th scope="row" class="titledesc"><label for="wmc_spinner_color"><?php _e('Spinner Color', 'woocommerce-multistep-checkout'); ?> <?php echo wc_help_tip("Spinner is shown while the checkout wizard is preparing") ?></label></th>
                <td>
                    <input name="wmc_spinner_color" id="wmc_spinner_color" type="text" value="<?php echo get_option('wmc_spinner_color') ?>" class="regular-text" />
                </td>
            </tr>

           <tr valign="top">
               <th scope="row" class="titledesc">
                   <label for="wmc_scroll_to_error"><?php _e('Scroll to error Fields', 'woocommerce-multistep-checkout') ?> <?php echo wc_help_tip("Enable this option if you want to scroll to error fields") ?></label>
                   </th>
                <td>
                    <input type="checkbox" id="wmc_scroll_to_error" name="wmc_scroll_to_error" value="yes" <?php checked(get_option('wmc_scroll_to_error'), 'yes'); ?> />
                </td>
                </td>
            </tr>

           <tr valign="top">
               <th scope="row" class="titledesc"><label for="wmc_scroll_offset"><?php _e('Scroll Top Offset', 'woocommerce-multistep-checkout') ?> <?php echo wc_help_tip("Set the top offset scroll position") ?></label></th>
                <td>
                    <input type="number" name="wmc_scroll_offset" id="wmc_scroll_offset" value="<?php echo get_option('wmc_scroll_offset'); ?>" />
                </td>
                </td>
            </tr>

            <tr>
                <td colspan="2"><h3 style="margin: 0;padding: 0"><?php _e('Steps Customization', 'woocommerce-multistep-checkout') ?></h3></td>
            </tr>

          <tr valign="top">
              <th scope="row" class="titledesc"><label for="tabs_color"><?php _e('Active step background color', 'woocommerce-multistep-checkout') ?> <?php echo wc_help_tip("Select background color for active step") ?></label></th>
                <td><input name="wmc_tabs_color" id="tabs_color" type="text" value="<?php echo get_option('wmc_tabs_color') ?>" class="regular-text" /><span class="description">
                        
                </td>
            </tr>

           <tr valign="top">
               <th scope="row" class="titledesc"><label for="inactive_tabs_color"><?php _e('Background for inactive steps', 'woocommerce-multistep-checkout'); echo wc_help_tip("Select background color for inactive steps") ?></label></th>
                <td><input name="wmc_inactive_tabs_color" id="inactive_tabs_color" type="text" value="<?php echo get_option('wmc_inactive_tabs_color') ?>" class="regular-text" />
                </td>
            </tr>

           <tr valign="top">
               <th scope="row" class="titledesc"><label for="font_color"><?php _e('Steps font color', 'woocommerce-multistep-checkout') ?> <?php echo wc_help_tip("Select steps font color");?></label></th>
                <td><input name="wmc_font_color" id="font_color" type="text" value="<?php echo get_option('wmc_font_color') ?>" class="regular-text" />
                    

                </td>
            </tr>

            <tr>
                <th scope="row" class="titledesc"><label for="completed_tabs_color"><?php _e('Completed steps background color', 'woocommerce-multistep-checkout'); echo wc_help_tip('Select background color for completed steps') ?></label></th>
                <td><input name="wmc_completed_tabs_color" id="completed_tabs_color" type="text" value="<?php echo get_option('wmc_completed_tabs_color') ?>" class="regular-text" />
                    
                </td>
            </tr>

            <tr>
                <th scope="row" class="titledesc"><label for="wmc_completed_font_color"><?php _e('Completed Steps font color', 'woocommerce-multistep-checkout') ?><?php echo wc_help_tip("Select Font color for completed steps") ?></label>
                <td><input name="wmc_completed_font_color" id="wmc_completed_font_color" type="text" value="<?php echo get_option('wmc_completed_font_color') ?>" class="regular-text" />
                  
                </td>
            </tr>

            <tr>
                <th scope="row" class="titledesc"><label for="buttons_bg_color"><?php _e('Buttons background color', 'woocommerce-multistep-checkout') ?><?php echo wc_help_tip("Next/Previous/Login buttons background color") ?></label>
                <td><input name="wmc_buttons_bg_color" id="buttons_bg_color" type="text" value="<?php echo get_option('wmc_buttons_bg_color') ?>" class="regular-text" />
                </td>
            </tr>

            <tr>
                <th scope="row" class="titledesc"><label for="buttons_font_color"><?php _e('Buttons Font color', 'woocommerce-multistep-checkout') ?> <?php echo wc_help_tip("Next/Previous/Login/Coupon buttons font color") ?></label></th>
                <td>
                    <input name="wmc_buttons_font_color" id="buttons_font_color" type="text" value="<?php echo get_option('wmc_buttons_font_color') ?>" class="regular-text" />
                </td>
            </tr>


            <tr>
                <th scope="row" class="titledesc"><label for=""><?php _e('Checkout form Labels', 'woocommerce-multistep-checkout') ?> <?php echo wc_help_tip("Set Form Labels color") ?></label></th>
                <td><input name="wmc_form_labels_color" id="form_labels_color" type="text" value="<?php echo get_option('wmc_form_labels_color') ?>" class="regular-text" />
                </td>
            </tr>


            <tr>
                <td colspan="2"><h3 style="margin: 0;padding: 0"><?php _e('Buttons Text', 'woocommerce-multistep-checkout') ?></h3></td>
            </tr>

            <tr>
                <th scope="row" class="titledesc"><label for="wmc_btn_next"><?php _e('Next Button', 'woocommerce-multistep-checkout') ?><?php echo wc_help_tip("Enter text for Next button")?></label></th>
                <td>
                    <input type="text" name="wmc_btn_next" id="wmc_btn_next" value="<?php echo get_option('wmc_btn_next') ? get_option('wmc_btn_next') : "Next" ?>" />
                </td>
            </tr>

            <tr>
                <th scope="row" class="titledesc"><label for="wmc_btn_prev"><?php _e('Previous Button', 'woocommerce-multistep-checkout') ?><?php echo wc_help_tip("Enter text for Previous button")?></label></th>
                <td>
                    <input type="text" name="wmc_btn_prev" id="wmc_btn_prev" value="<?php echo get_option('wmc_btn_prev') ? get_option('wmc_btn_prev') : "Previous" ?>" />                    
                    
                </td>
            </tr>

            <tr>
                <th scope="row" class="titledesc"><label for="wmc_btn_finish"><?php _e('Place Order Button', 'woocommerce-multistep-checkout') ?><?php echo wc_help_tip("Enter text for Place Order button")?></label></th>
                <td>
                    <input type="text" name="wmc_btn_finish" id="wmc_btn_finish" value="<?php echo get_option('wmc_btn_finish') ? get_option('wmc_btn_finish') : "Place Order" ?>" />
                </td>
            </tr>

            <tr>
                <th scope="row" class="titledesc"><label for="wmc_no_account_btn"><?php _e('No Account Button', 'woocommerce-multistep-checkout') ?><?php echo wc_help_tip("Enter text for No Account Button")?></label></th>
                <td>
                    <input type="text" name="wmc_no_account_btn" id="wmc_no_account_btn" value="<?php echo get_option('wmc_no_account_btn') ? stripslashes(get_option('wmc_no_account_btn')) : "I don't have an account" ?>" />
                    
                </td>
            </tr>

            <tr>
                <td colspan="2"><h3 style="margin: 0;padding: 0"><?php _e('Step Titles', 'woocommerce-multistep-checkout') ?></h3></td>
            </tr>

            <tr>
                <th scope="row" class="titledesc"><label for="wmc_coupon_label"><?php _e('Coupon', 'woocommerce-multistep-checkout') ?><?php echo wc_help_tip("Enter title for coupon step")?></label></th>
                <td>
                    <input type="text" name="wmc_coupon_label" id="wmc_coupon_label" value="<?php echo get_option('wmc_coupon_label') ? get_option('wmc_coupon_label') : "Coupon" ?>" />
                </td>
            </tr>

            <tr>
                <th scope="row" class="titledesc"><label for="wmc_billing_label"><?php _e('Billing', 'woocommerce-multistep-checkout') ?><?php echo wc_help_tip("Enter title for Billing step")?></label></th>
                <td>
                    <input type="text" name="wmc_billing_label" id="wmc_billing_label" value="<?php echo get_option('wmc_billing_label') ? get_option('wmc_billing_label') : "Billing" ?>" />
                </td>
            </tr>

            <tr>
                <th scope="row" class="titledesc"><label for="wmc_shipping_label"><?php _e('Shipping', 'woocommerce-multistep-checkout') ?><?php echo wc_help_tip("Enter title for Shipping step")?></label></th>
                <td>
                    <input type="text" name="wmc_shipping_label" id="wmc_shipping_label" value="<?php echo get_option('wmc_shipping_label') ? get_option('wmc_shipping_label') : "Shipping" ?>" />
            </tr>

            <tr>
                <th scope="row" class="titledesc"><label for="wmc_billing_shipping_label"><?php _e('Billing & Shipping', 'woocommerce-multistep-checkout') ?><?php echo wc_help_tip("Step title for combined Billing & Shipping")?></label></th>
                <td>
                    <input type="text" name="wmc_billing_shipping_label" id="wmc_billing_shipping_label" value="<?php echo get_option('wmc_billing_shipping_label') ? get_option('wmc_billing_shipping_label') : "Billing & Shipping" ?>" />
                </td>
            </tr>

            <tr>
                <th scope="row" class="titledesc"><label for="wmc_orderinfo_label"><?php _e('Order Information', 'woocommerce-multistep-checkout') ?><?php echo wc_help_tip("Step title for Order Information")?></label></th>
                <td>
                    <input type="text" name="wmc_orderinfo_label" id="wmc_orderinfo_label" value="<?php echo get_option('wmc_orderinfo_label') ? get_option('wmc_orderinfo_label') : "Order Information" ?>" />
                 </td>
            </tr>

            <tr>
                <th scope="row" class="titledesc"><label for="wmc_paymentinfo_label"><?php _e('Payment Info', 'woocommerce-multistep-checkout') ?><?php echo wc_help_tip("Step title for Payment")?></label></th>
                <td>
                    <input type="text" name="wmc_paymentinfo_label" id="wmc_paymentinfo_label" value="<?php echo get_option('wmc_paymentinfo_label') ? get_option('wmc_paymentinfo_label') : "Payment Info" ?>" />
                    
                </td>
            </tr>

            <tr>
                <th scope="row" class="titledesc"><label for="wmc_order_review_label"><?php _e('Order Review', 'woocommerce-multistep-checkout') ?><?php echo wc_help_tip("Step title for Order Review")?></label></th>
                <td>
                    <input type="text" name="wmc_order_review_label" id="wmc_order_review_label" value="<?php echo get_option('wmc_order_review_label') ? get_option('wmc_order_review_label') : "Order Review" ?>" />
                    
                </td>
            </tr>

            <tr>
                <td colspan="2"><h3 style="margin: 0;padding: 0"><?php _e('Error Messages', 'woocommerce-multistep-checkout') ?></h3></td>
            </tr>
            <tr>
                <th scope="row" class="titledesc"><label for="wmc_empty_error"><?php _e('Empty Fields', 'woocommerce-multistep-checkout') ?><?php echo wc_help_tip("Enter text for empty field error")?></label></th>
                <td>
                    <input type="text" name="wmc_empty_error" id="wmc_empty_error" value="<?php echo get_option('wmc_empty_error') ?>" />
                </td>
            </tr>

            <tr>
                <th scope="row" class="titledesc"><label for="wmc_empty_error"><?php _e('Invalid E-mail', 'woocommerce-multistep-checkout') ?><?php echo wc_help_tip("Enter text for invalid email error")?></label></th>
                <td>
                    <input type="text" name="wmc_email_error" value="<?php echo get_option('wmc_email_error'); ?>" />
                </td>
            </tr>

            <tr>
                <th scope="row" class="titledesc"><label for="wmc_phone_error"><?php _e('Invalid Phone', 'woocommerce-multistep-checkout') ?><?php echo wc_help_tip("Enter text for invalid phone number error")?></label></th>
                <td>
                    <input type="text" name="wmc_phone_error" id="wmc_phone_error" value="<?php echo get_option('wmc_phone_error') ?>" />
                </td>
            </tr>

            <tr>
                <th scope="row" class="titledesc"><label for="wmc_terms_error"><?php _e('Terms and condition', 'woocommerce-multistep-checkout') ?><?php echo wc_help_tip("Enter text for Terms & Conditions error")?></label></th>
                <td>
                    <input type="text" name="wmc_terms_error" id="wmc_terms_error" value="<?php echo get_option('wmc_terms_error') ?>" />
                </td>
            </tr>

            <tr>
                <td colspan="2"><h3 style="margin: 0;padding: 0"><?php _e('Code Location', 'woocommerce-multistep-checkout') ?></h3></td>
            </tr>

            <tr>
                <th scope="row" class="titledesc"><label for="wmc_terms_error"><?php _e('Add JS/CSS files to theme', 'woocommerce-multistep-checkout') ?><?php echo wc_help_tip("Location of JS/CSS files")?></label></th>
                <td><select name="wmc_add_code_footer">
                        <option value="false" <?php selected(get_option('wmc_add_code_footer'), 'false', true); ?>><?php _e('Header', 'woocommerce-multistep-checkout') ?></option>
                        <option value="true" <?php selected(get_option('wmc_add_code_footer'), 'true', true); ?>><?php _e('Footer', 'woocommerce-multistep-checkout') ?></option>                            
                    </select>
                </td>
            </tr>

            <tr>
                <th scope="row" class="titledesc"><label for="wmc_restore_default"><?php _e('Restore Plugin Defaults', 'woocommerce-multistep-checkout') ?></label> <?php echo wc_help_tip("Restore plugin default setting") ?></th>
                <td><input type="checkbox" name="wmc_restore_default" id="wmc_restore_default" value="yes" /></td>
            </tr>

        </table>


        <p class="submit">
            <input type="submit" name="submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
        </p>

    </form>

</div>
<style>  
    .wp-picker-container{display: inline-block}
</style>   
<script>