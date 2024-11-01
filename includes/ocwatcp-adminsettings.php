<?php 

if (!defined('ABSPATH'))
  exit;

if (!class_exists('OCWATCP_admin_settings')) {

  class OCWATCP_admin_settings {

    protected static $OCWATCP_instance;

        // For multiple value
    function recursive_sanitize_text_field($array) {
        foreach ( $array as $key => &$value ) {
            if ( is_array( $value ) ) {
                $value = $this->recursive_sanitize_text_field($value);
            }else{
                $value = sanitize_text_field( $value );
            }
        }
            return $array;
    }

    function ocwatcp_register_my_custom_submenu_page() { 
    	add_menu_page('Cart Popup', 'Cart Popup', 'manage_options', 'oc-cart-popup', array($this, 'ocwatcp_submenu_page_callback'), ' dashicons-cart',61);
    }

    function ocwatcp_submenu_page_callback() { ?>
       <div class="ocwatcp-container">
            <div class="wrap">
                <h2><?php echo __( 'Cart Popup', OCWATCP_DOMAIN );?></h2>
                <?php if($_REQUEST['message'] == 'success'){ ?>
                    <div class="notice notice-success is-dismissible"> 
                        <p><strong>Record updated successfully.</strong></p>
                    </div>
                <?php } ?>
                <div class="ocwatcp-inner-block">
                    <form method="post" >
                        <?php wp_nonce_field( 'ocwatcp_nonce_action', 'ocwatcp_nonce_field' ); ?>
                        <ul class="tabs">
                            <li class="tab-link current" data-tab="ocwatcp-tab-all"><?php echo __( 'All Settings', OCWATCP_DOMAIN );?></li>
                            <li class="tab-link" data-tab="ocwatcp-tab-design"><?php echo __( 'Design Settings', OCWATCP_DOMAIN );?></li>
                            <li class="tab-link" data-tab="ocwatcp-tab-advanced"><?php echo __( 'Advanced Settings', OCWATCP_DOMAIN );?></li>
                        </ul>
                        <div id="ocwatcp-tab-all" class="tab-content current">
                            <fieldset>
                            	<div class="ocwatcp-heading"><?php echo __( 'General', OCWATCP_DOMAIN );?></div>
                            	<table class="form-table">
                                    <tbody>
                                        <tr class="form-field">
                                            <th scope="row">
                                                  <label><?php echo __( 'Enable Popup', OCWATCP_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <label>
                                                    <?php
                                                        $ocwatcp_enablepopup = empty(get_option( 'ocwatcp_enablepopup' )) ? 'no' : get_option( 'ocwatcp_enablepopup' );
                                                    ?>
                                                   <input type="checkbox" name="ocwatcp_enablepopup" value="yes" <?php if ($ocwatcp_enablepopup == "yes") {echo 'checked="checked"';} ?>><?php echo __( 'Enable popup on devices.', OCWATCP_DOMAIN ); ?>
                                                </label>
                                            </td>
                                        </tr>
                                        <tr class="form-field">
                                            <th scope="row">
                                                  <label><?php echo __( 'Popup message', OCWATCP_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <?php
                                                    $ocwatcp_popupmessage = empty(get_option( 'ocwatcp_popupmessage' )) ? 'Product successfully added to your cart.' : get_option( 'ocwatcp_popupmessage' );
                                                ?>
                                                <div id="ocwatcp-space"></div>
                                                <input type="text" name="ocwatcp_popupmessage" value="<?php echo $ocwatcp_popupmessage; ?>" id="ocwatcp_popupmessage" class="ocwatcp_msg">
                                            </td>
                                        </tr>
                                        <tr class="form-field">
                                            <th scope="row">
                                                  <label><?php echo __( 'Show product inforamtion', OCWATCP_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                    <label>
                                                        <input type="checkbox" name="ocwatcp_showinfo" value="yes" <?php if (get_option( 'ocwatcp_showinfo' ) == "yes" || empty(get_option( 'ocwatcp_showinfo' ))) {echo 'checked="checked"';} ?>><?php echo __( 'Show product inforamtion in the popup.', OCWATCP_DOMAIN ); ?>
                                                    </label>
                                                    <p class="ocwatcp-tips">
                                                        <?php _e('Here product inforamtion like product title,price and cart total',OCWATCP_DOMAIN); ?>
                                                    </p>
                                            </td>
                                        </tr>
                                        <tr class="form-field">
                                            <th scope="row">
                                                  <label><?php echo __( 'Show product features images', OCWATCP_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <label>
                                                   <input type="checkbox" name="ocwatcp_showffeatures_img" value="yes" <?php if (get_option( 'ocwatcp_showffeatures_img' ) == "yes" || empty(get_option( 'ocwatcp_showffeatures_img' ))) {echo 'checked="checked"';} ?>><?php echo __( 'Show the product features images in the popup', OCWATCP_DOMAIN ); ?>
                                                </label>
                                            </td>
                                        </tr>
                                        <tr class="form-field">
                                            <th scope="row">
                                                  <label><?php echo __( 'Show View Cart Button', OCWATCP_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <label>
                                                   <input type="checkbox" name="ocwatcp_showviewcart" value="yes" <?php if (get_option( 'ocwatcp_showviewcart' ) == "yes" || empty(get_option( 'ocwatcp_showviewcart' ))) {echo 'checked="checked"';} ?>><?php echo __( 'Show <strong>View Cart</strong> button in the popup and change button text.', OCWATCP_DOMAIN ); ?>

                                                </label>
                                                <?php
                                                    $ocwatcp_showviewcarttxt = empty(get_option( 'ocwatcp_showviewcarttxt' )) ? 'View Cart' : get_option( 'ocwatcp_showviewcarttxt' );
                                                ?>
                                                <div id="ocwatcp-space"></div>
                                                <input type="text" name="ocwatcp_showviewcarttxt" value="<?php echo $ocwatcp_showviewcarttxt; ?>" id="ocwatcp_showviewcarttxt" class="ocwatcp_msg">
                                                <p class="ocwatcp-tips">
                                                    <?php _e('Text for "View Cart" button',OCWATCP_DOMAIN); ?>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr class="form-field">
                                            <th scope="row">
                                                  <label><?php echo __( 'Show Continue Shopping Button', OCWATCP_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <label>
                                                   <input type="checkbox" name="ocwatcp_showcontshop" value="yes" <?php if (get_option( 'ocwatcp_showcontshop' ) == "yes" || empty(get_option( 'ocwatcp_showcontshop' ))) {echo 'checked="checked"';} ?>><?php echo __( 'Show <strong>Continue Shopping</strong> button in the popup and change button text.', OCWATCP_DOMAIN ); ?>

                                                </label>
                                                <?php
                                                    $ocwatcp_showcontshoptxt = empty(get_option( 'ocwatcp_showcontshoptxt' )) ? 'Continue Shopping' : get_option( 'ocwatcp_showcontshoptxt' );
                                                ?>
                                                <div id="ocwatcp-space"></div>
                                                <input type="text" name="ocwatcp_showcontshoptxt" value="<?php echo $ocwatcp_showcontshoptxt; ?>" id="ocwatcp_showcontshoptxt" class="ocwatcp_msg">
                                                <p class="ocwatcp-tips">
                                                    <?php _e('Text for "Continue Shopping" button',OCWATCP_DOMAIN); ?>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr class="form-field">
                                            <th scope="row">
                                                  <label><?php echo __( 'Show Checkout Button', OCWATCP_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <label>
                                                   <input type="checkbox" name="ocwatcp_showcheckout" value="yes" <?php if (get_option( 'ocwatcp_showcheckout' ) == "yes" || empty(get_option( 'ocwatcp_showcheckout' ))) {echo 'checked="checked"';} ?>><?php echo __( 'Show <strong>Checkout</strong> button in the popup and change button text.', OCWATCP_DOMAIN ); ?>

                                                </label>
                                                <?php
                                                    $ocwatcp_showcheckouttxt = empty(get_option( 'ocwatcp_showcheckouttxt' )) ? 'Checkout' : get_option( 'ocwatcp_showcheckouttxt' );
                                                ?>
                                                <div id="ocwatcp-space"></div>
                                                <input type="text" name="ocwatcp_showcheckouttxt" value="<?php echo $ocwatcp_showcheckouttxt; ?>" id="ocwatcp_showcheckouttxt" class="ocwatcp_msg">
                                                <p class="ocwatcp-tips">
                                                    <?php _e('Text for "Checkout" button',OCWATCP_DOMAIN); ?>
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="ocwatcp-heading"><?php echo __( 'Mini Cart', OCWATCP_DOMAIN );?></div>
                                <table class="form-table">
                                    <tbody>
                                        <tr class="form-field">
                                            <th scope="row">
                                                  <label><?php echo __( 'Enable Mini Cart', OCWATCP_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <p>
                                                   <input type="checkbox" name="ocwatcp_enableminicart_desktop" value="yes" <?php if (get_option( 'ocwatcp_enableminicart_desktop' ) == "yes" || empty(get_option( 'ocwatcp_enableminicart_desktop' ))) {echo 'checked="checked"';} ?>><?php echo __( 'Desktop devices.', OCWATCP_DOMAIN ); ?>
                                                </p>
                                                <div id="ocwatcp-space"></div>
                                                <p>
                                                   <input type="checkbox" name="ocwatcp_enableminicart_mobile" value="yes" <?php if (get_option( 'ocwatcp_enableminicart_mobile' ) == "yes" || empty(get_option( 'ocwatcp_enableminicart_mobile' ))) {echo 'checked="checked"';} ?>><?php echo __( 'Mobile devices.', OCWATCP_DOMAIN ); ?>
                                                </p>
                                            </td>
                                        </tr>
                                         <tr class="form-field">
                                            <th scope="row">
                                                  <label><?php echo __( 'Mini Cart Title', OCWATCP_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <?php
                                                    $ocwatcp_minicart_title = empty(get_option( 'ocwatcp_minicart_title' )) ? 'Your Cart' : get_option( 'ocwatcp_minicart_title' );
                                                ?>
                                                <div id="ocwatcp-space"></div>
                                                <input type="text" name="ocwatcp_minicart_title" value="<?php echo $ocwatcp_minicart_title; ?>" id="ocwatcp_minicart_title" class="ocwatcp_msg">
                                                 <p class="ocwatcp-tips">
                                                    <?php _e('Text for Minicart Title',OCWATCP_DOMAIN); ?>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr class="form-field">
                                            <th scope="row">
                                                  <label><?php echo __( 'Show counter', OCWATCP_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <label>
                                                    <input type="checkbox" name="ocwatcp_showcounter" value="yes" <?php if (get_option( 'ocwatcp_showcounter' ) == "yes" || empty(get_option( 'ocwatcp_showcounter' ))) {echo 'checked="checked"';} ?>><?php echo __( 'Show a counter with the number of items in cart.', OCWATCP_DOMAIN ); ?>
                                                </label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </fieldset>
                        </div>
                        <div id="ocwatcp-tab-design" class="tab-content">
                            <fieldset>
                                <div class="ocwatcp-heading"><?php echo __( 'Suggested products style', OCWATCP_DOMAIN );?></div>
                                <table class="form-table">
                                    <tbody>
                                        <tr class="form-field">
                                            <th scope="row">
                                                  <label><?php echo __( 'Title color', OCWATCP_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <?php
                                                    $ocwatcp_spt_color = empty(get_option( 'ocwatcp_spt_color' )) ? '#000000' : get_option( 'ocwatcp_spt_color' );
                                                ?>
                                                <input type="color" name="ocwatcp_spt_color" value="<?php echo $ocwatcp_spt_color; ?>" id="ocwatcp_spt_color">

                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                  <label><?php echo __( 'Title size', OCWATCP_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <?php
                                                    $ocwatcp_spt_size = empty(get_option( 'ocwatcp_spt_size' )) ? 17 : get_option( 'ocwatcp_spt_size' );
                                                ?>
                                                <input type="number" name="ocwatcp_spt_size" value="<?php echo $ocwatcp_spt_size; ?>" id="ocwatcp_spt_size"  min="1" class="small-text ltr">

                                            </td>
                                        </tr>
                                        <tr class="form-field">
                                            <th scope="row">
                                                <label><?php echo __( 'Title position', OCWATCP_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <?php
                                                    $ocwatcp_spt_position = empty(get_option( 'ocwatcp_spt_position' )) ? 'center' : get_option( 'ocwatcp_spt_position' );
                                                ?>
                                                <select name="ocwatcp_spt_position">
                                                    <option value="left" <?php if($ocwatcp_spt_position == 'left'){ echo "selected";}?>>Left</option>
                                                    <option value="right" <?php if($ocwatcp_spt_position == 'right'){ echo "selected";}?>>Right</option>
                                                    <option value="center" <?php if($ocwatcp_spt_position == 'center'){ echo "selected";}?>>Center</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="form-field">
                                            <th scope="row">
                                                <label><?php echo __( 'Title style', OCWATCP_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <?php
                                                    $ocwatcp_spt_style = empty(get_option( 'ocwatcp_spt_style' )) ? 700 : get_option( 'ocwatcp_spt_style' );
                                                ?>
                                                <select name="ocwatcp_spt_style">
                                                    <?php 
                                                       $boldval_f = 100;
                                                       while($boldval_f <= 900) { ?>
                                                        <option value="<?php echo $boldval_f; ?>" <?php if($ocwatcp_spt_style == $boldval_f){ echo "selected";}?>><?php echo $boldval_f; ?></option>
                                                        <?php
                                                        $boldval_f = $boldval_f + 100;
                                                       }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="ocwatcp-heading"><?php echo __( 'Success message style', OCWATCP_DOMAIN );?></div>
                                <table class="form-table">
                                    <tbody>
                                        <tr class="form-field">
                                            <th scope="row">
                                                  <label><?php echo __( 'Text color', OCWATCP_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <?php
                                                    $ocwatcp_sms_color = empty(get_option( 'ocwatcp_sms_color' )) ? '#000000' : get_option( 'ocwatcp_sms_color' );
                                                ?>
                                                <input type="color" name="ocwatcp_sms_color" value="<?php echo $ocwatcp_sms_color; ?>" id="ocwatcp_sms_color">

                                            </td>
                                        </tr>
                                        <tr class="form-field">
                                            <th scope="row">
                                                  <label><?php echo __( 'Message background color', OCWATCP_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <?php
                                                    $ocwatcp_sms_bgcolor = empty(get_option( 'ocwatcp_sms_bgcolor' )) ? '#e6ffc5' : get_option( 'ocwatcp_sms_bgcolor' );
                                                ?>
                                                <input type="color" name="ocwatcp_sms_bgcolor" value="<?php echo $ocwatcp_sms_bgcolor; ?>" id="ocwatcp_sms_bgcolor">

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="ocwatcp-heading"><?php echo __( 'Button style', OCWATCP_DOMAIN );?></div>
                                <table class="form-table">
                                    <tbody>
                                        <tr class="form-field">
                                            <th scope="row">
                                                  <label><?php echo __( 'Button color', OCWATCP_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <?php
                                                    $ocwatcp_bs_color = empty(get_option( 'ocwatcp_bs_color' )) ? '#515151' : get_option( 'ocwatcp_bs_color' );
                                                ?>
                                                <input type="color" name="ocwatcp_bs_color" value="<?php echo $ocwatcp_bs_color; ?>" id="ocwatcp_bs_color">

                                            </td>
                                        </tr>
                                        <tr class="form-field">
                                            <th scope="row">
                                                  <label><?php echo __( 'Button background color', OCWATCP_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <?php
                                                    $ocwatcp_bs_bgcolor = empty(get_option( 'ocwatcp_bs_bgcolor' )) ? '#ebe9eb' : get_option( 'ocwatcp_bs_bgcolor' );
                                                ?>
                                                <input type="color" name="ocwatcp_bs_bgcolor" value="<?php echo $ocwatcp_bs_bgcolor; ?>" id="ocwatcp_bs_bgcolor">

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="ocwatcp-heading"><?php echo __( 'Product inforamtion style', OCWATCP_DOMAIN );?></div>
                                <table class="form-table">
                                    <tbody>
                                        <tr class="form-field">
                                            <th scope="row">
                                                  <label><?php echo __( 'Title color', OCWATCP_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <?php
                                                    $ocwatcp_pis_color = empty(get_option( 'ocwatcp_pis_color' )) ? '#000000' : get_option( 'ocwatcp_pis_color' );
                                                ?>
                                                <input type="color" name="ocwatcp_pis_color" value="<?php echo $ocwatcp_pis_color; ?>" id="ocwatcp_pis_color">

                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                  <label><?php echo __( 'Title size', OCWATCP_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <?php
                                                    $ocwatcp_pis_size = empty(get_option( 'ocwatcp_pis_size' )) ? 20 : get_option( 'ocwatcp_pis_size' );
                                                ?>
                                                <input type="number" name="ocwatcp_pis_size" value="<?php echo $ocwatcp_pis_size; ?>" id="ocwatcp_pis_size"  min="1" class="small-text ltr">

                                            </td>
                                        </tr>
                                        <tr class="form-field">
                                            <th scope="row">
                                                <label><?php echo __( 'Title position', OCWATCP_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <?php
                                                    $ocwatcp_pis_position = empty(get_option( 'ocwatcp_pis_position' )) ? 'center' : get_option( 'ocwatcp_pis_position' );
                                                ?>
                                                <select name="ocwatcp_pis_position">
                                                    <option value="left" <?php if($ocwatcp_pis_position == 'left'){ echo "selected";}?>>Left</option>
                                                    <option value="right" <?php if($ocwatcp_pis_position == 'right'){ echo "selected";}?>>Right</option>
                                                    <option value="center" <?php if($ocwatcp_pis_position == 'center'){ echo "selected";}?>>Center</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="form-field">
                                            <th scope="row">
                                                <label><?php echo __( 'Title style', OCWATCP_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <?php
                                                    $ocwatcp_pis_style = empty(get_option( 'ocwatcp_pis_style' )) ? 700 : get_option( 'ocwatcp_pis_style' );
                                                ?>
                                                <select name="ocwatcp_pis_style">
                                                    <?php 
                                                       $boldval_f = 100;
                                                       while($boldval_f <= 900) { ?>
                                                        <option value="<?php echo $boldval_f; ?>" <?php if($ocwatcp_pis_style == $boldval_f){ echo "selected";}?>><?php echo $boldval_f; ?></option>
                                                        <?php
                                                        $boldval_f = $boldval_f + 100;
                                                       }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="form-field">
                                            <th scope="row">
                                                  <label><?php echo __( 'Price color', OCWATCP_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <?php
                                                    $ocwatcp_pis_pricecolor = empty(get_option( 'ocwatcp_pis_pricecolor' )) ? '#000000' : get_option( 'ocwatcp_pis_pricecolor' );
                                                ?>
                                                <input type="color" name="ocwatcp_pis_pricecolor" value="<?php echo $ocwatcp_pis_pricecolor; ?>" id="ocwatcp_pis_pricecolor">

                                            </td>
                                        </tr>
                                        <tr class="form-field">
                                            <th scope="row">
                                                  <label><?php echo __( 'Total Label and Total price color', OCWATCP_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <?php
                                                    $ocwatcp_pis_totalcolor = empty(get_option( 'ocwatcp_pis_totalcolor' )) ? '#000000' : get_option( 'ocwatcp_pis_totalcolor' );
                                                ?>
                                                <input type="color" name="ocwatcp_pis_totalcolor" value="<?php echo $ocwatcp_pis_totalcolor; ?>" id="ocwatcp_pis_totalcolor">

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="ocwatcp-heading"><?php echo __( 'Mini Cart style', OCWATCP_DOMAIN );?></div>
                                <table class="form-table">
                                    <tbody>
                                        <tr class="form-field">
                                            <th scope="row">
                                                  <label><?php echo __( 'Title color', OCWATCP_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <?php
                                                    $ocwatcp_mcs_color = empty(get_option( 'ocwatcp_mcs_color' )) ? '#000000' : get_option( 'ocwatcp_mcs_color' );
                                                ?>
                                                <input type="color" name="ocwatcp_mcs_color" value="<?php echo $ocwatcp_mcs_color; ?>" id="ocwatcp_mcs_color">

                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                  <label><?php echo __( 'Title size', OCWATCP_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <?php
                                                    $ocwatcp_mcs_size = empty(get_option( 'ocwatcp_mcs_size' )) ? 17 : get_option( 'ocwatcp_mcs_size' );
                                                ?>
                                                <input type="number" name="ocwatcp_mcs_size" value="<?php echo $ocwatcp_mcs_size; ?>" id="ocwatcp_mcs_size"  min="1" class="small-text ltr">

                                            </td>
                                        </tr>
                                        <tr class="form-field">
                                            <th scope="row">
                                                <label><?php echo __( 'Title position', OCWATCP_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <?php
                                                    $ocwatcp_mcs_position = empty(get_option( 'ocwatcp_mcs_position' )) ? 'center' : get_option( 'ocwatcp_mcs_position' );
                                                ?>
                                                <select name="ocwatcp_mcs_position">
                                                    <option value="left" <?php if($ocwatcp_mcs_position == 'left'){ echo "selected";}?>>Left</option>
                                                    <option value="right" <?php if($ocwatcp_mcs_position == 'right'){ echo "selected";}?>>Right</option>
                                                    <option value="center" <?php if($ocwatcp_mcs_position == 'center'){ echo "selected";}?>>Center</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="form-field">
                                            <th scope="row">
                                                <label><?php echo __( 'Title style', OCWATCP_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <?php
                                                    $ocwatcp_mcs_style = empty(get_option( 'ocwatcp_mcs_style' )) ? 700 : get_option( 'ocwatcp_mcs_style' );
                                                ?>
                                                <select name="ocwatcp_mcs_style">
                                                    <?php 
                                                       $boldval_f = 100;
                                                       while($boldval_f <= 900) { ?>
                                                        <option value="<?php echo $boldval_f; ?>" <?php if($ocwatcp_mcs_style == $boldval_f){ echo "selected";}?>><?php echo $boldval_f; ?></option>
                                                        <?php
                                                        $boldval_f = $boldval_f + 100;
                                                       }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </fieldset>
                        </div>
                        <div id="ocwatcp-tab-advanced" class="tab-content">
                            <fieldset>
                                <div class="ocwatcp-heading"><?php echo __( 'Suggested Products', OCWATCP_DOMAIN );?></div>
                                <table class="form-table">
                                    <tbody>
                                        <tr class="form-field">
                                            <th scope="row">
                                                  <label><?php echo __( 'Enable suggested products', OCWATCP_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <label>
                                                    <input type="checkbox" name="ocwatcp_enablesuggestedpro" value="yes" <?php if (get_option( 'ocwatcp_enablesuggestedpro' ) == "yes" || empty(get_option( 'ocwatcp_enablesuggestedpro' ))) {echo 'checked="checked"';} ?>><?php echo __( 'Show suggested products in the popup.', OCWATCP_DOMAIN ); ?>
                                                </label>
                                                <?php
                                                    $ocwatcp_suggestedprotitle = empty(get_option( 'ocwatcp_suggestedprotitle' )) ? 'Related Products' : get_option( 'ocwatcp_suggestedprotitle' );
                                                ?>
                                                <div id="ocwatcp-space"></div>
                                                <input type="text" name="ocwatcp_suggestedprotitle" value="<?php echo $ocwatcp_suggestedprotitle; ?>" id="ocwatcp_suggestedprotitle" class="ocwatcp_msg">
                                                <p class="ocwatcp-tips">
                                                    <?php _e('Suggested Products title',OCWATCP_DOMAIN); ?>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr class="form-field">
                                            <th scope="row">
                                                  <label><?php echo __( 'Suggested products type', OCWATCP_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <?php
                                                    $ocwatcp_protype = empty(get_option( 'ocwatcp_protype' )) ? 'related' : get_option( 'ocwatcp_protype' );
                                                ?>
                                                <select name="ocwatcp_protype">
                                                    <option value="related" <?php if($ocwatcp_protype == 'related'){echo "selected";} ?>> <?php echo __( 'Related Products', OCWATCP_DOMAIN );?> </option>
                                                    <option value="upsell" <?php if($ocwatcp_protype == 'upsell'){echo "selected";} ?>> <?php echo __( 'Up-sell Products', OCWATCP_DOMAIN );?> </option>
                                                    <option value="crossell" <?php if($ocwatcp_protype == 'crossell'){echo "selected";} ?>> <?php echo __( 'Cross-sell Products', OCWATCP_DOMAIN );?></option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="form-field">
                                            <th scope="row">
                                                  <label><?php echo __( 'Number of suggested products', OCWATCP_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <?php
                                                    $ocwatcp_suggestedprono = empty(get_option( 'ocwatcp_suggestedprono' )) ? 3 : get_option( 'ocwatcp_suggestedprono' );
                                                ?>
                                                <input type="number" name="ocwatcp_suggestedprono" value="<?php echo $ocwatcp_suggestedprono; ?>" min="1" id="ocwatcp_suggestedprono" class="ocwatcp_msg">
                                                <p class="ocwatcp-tips">
                                                    <?php _e('Here set how many suggested products to show in popup.',OCWATCP_DOMAIN); ?>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr class="form-field">
                                            <th scope="row">
                                                  <label><?php echo __( 'Columns of suggested products', OCWATCP_DOMAIN );?></label>
                                            </th>
                                            <td>
                                                <?php
                                                    $ocwatcp_suggestedprocolumns = empty(get_option( 'ocwatcp_suggestedprocolumns' )) ? 3 : get_option( 'ocwatcp_suggestedprocolumns' );
                                                ?>
                                                <input type="number" name="ocwatcp_suggestedprocolumns" value="<?php echo $ocwatcp_suggestedprocolumns; ?>" min="1" id="ocwatcp_suggestedprocolumns" class="ocwatcp_msg">
                                                <p class="ocwatcp-tips">
                                                    <?php _e('Here set how many suggested products to show in popup.',OCWATCP_DOMAIN); ?>
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </fieldset>
                        </div>
                        <input type="hidden" name="ocwatcp_action" value="ocwatcp_save_option_data"/>
                        <input type="submit" value="Save changes" name="submit" class="button-primary" id="ocwatcp-btn-space">
                    </form> 
                </div>
            </div>
        </div>
    <?php 
    }

    // Save Setting Option
    function ocwatcp_save_options(){
        if( current_user_can('administrator') ) { 
            if($_REQUEST['ocwatcp_action'] == 'ocwatcp_save_option_data'){
                if(!isset( $_POST['ocwatcp_nonce_field'] ) || !wp_verify_nonce( $_POST['ocwatcp_nonce_field'], 'ocwatcp_nonce_action' ) ){
                    print 'Sorry, your nonce did not verify.';
                    exit;
                }else{
                    $ocwatcp_enablepopup = (!empty(sanitize_text_field( $_REQUEST['ocwatcp_enablepopup'] )))? sanitize_text_field( $_REQUEST['ocwatcp_enablepopup'] ) : 'no';
                    update_option('ocwatcp_enablepopup',$ocwatcp_enablepopup, 'yes');

                    update_option('ocwatcp_popupmessage',sanitize_text_field( $_REQUEST['ocwatcp_popupmessage'] ), 'yes');

                    $ocwatcp_showinfo = (!empty(sanitize_text_field( $_REQUEST['ocwatcp_showinfo'] )))? sanitize_text_field( $_REQUEST['ocwatcp_showinfo'] ) : 'no';
                    update_option('ocwatcp_showinfo', $ocwatcp_showinfo, 'yes');

                    $ocwatcp_showffeatures_img = (!empty(sanitize_text_field( $_REQUEST['ocwatcp_showffeatures_img'] )))? sanitize_text_field( $_REQUEST['ocwatcp_showffeatures_img'] ) : 'no';
                    update_option('ocwatcp_showffeatures_img', $ocwatcp_showffeatures_img, 'yes');

                    $ocwatcp_showviewcart = (!empty(sanitize_text_field( $_REQUEST['ocwatcp_showviewcart'] )))? sanitize_text_field( $_REQUEST['ocwatcp_showviewcart'] ) : 'no';
                    update_option('ocwatcp_showviewcart', $ocwatcp_showviewcart, 'yes');
                    update_option('ocwatcp_showviewcarttxt', sanitize_text_field( $_REQUEST['ocwatcp_showviewcarttxt'] ), 'yes');

                    $ocwatcp_showcontshop = (!empty(sanitize_text_field( $_REQUEST['ocwatcp_showcontshop'] )))? sanitize_text_field( $_REQUEST['ocwatcp_showcontshop'] ) : 'no';
                    update_option('ocwatcp_showcontshop', $ocwatcp_showcontshop, 'yes');
                    update_option('ocwatcp_showcontshoptxt', sanitize_text_field( $_REQUEST['ocwatcp_showcontshoptxt'] ), 'yes');

                    $ocwatcp_showcheckout = (!empty(sanitize_text_field( $_REQUEST['ocwatcp_showcheckout'] )))? sanitize_text_field( $_REQUEST['ocwatcp_showcheckout'] ) : 'no';
                    update_option('ocwatcp_showcheckout', $ocwatcp_showcheckout, 'yes');
                    update_option('ocwatcp_showcheckouttxt', sanitize_text_field( $_REQUEST['ocwatcp_showcheckouttxt'] ), 'yes');

                    $ocwatcp_enableminicart_desktop = (!empty(sanitize_text_field( $_REQUEST['ocwatcp_enableminicart_desktop'] )))? sanitize_text_field( $_REQUEST['ocwatcp_enableminicart_desktop'] ) : 'no';
                    update_option('ocwatcp_enableminicart_desktop', $ocwatcp_enableminicart_desktop, 'yes');


                    $ocwatcp_enableminicart_mobile = (!empty(sanitize_text_field( $_REQUEST['ocwatcp_enableminicart_mobile'] )))? sanitize_text_field( $_REQUEST['ocwatcp_enableminicart_mobile'] ) : 'no';
                    update_option('ocwatcp_enableminicart_mobile', $ocwatcp_enableminicart_mobile, 'yes');

                    $ocwatcp_minicart_title = (!empty(sanitize_text_field( $_REQUEST['ocwatcp_minicart_title'] )))? sanitize_text_field( $_REQUEST['ocwatcp_minicart_title'] ) : 'Your Cart';
                    update_option('ocwatcp_minicart_title', $ocwatcp_minicart_title, 'yes');

                    $ocwatcp_showcounter = (!empty(sanitize_text_field( $_REQUEST['ocwatcp_showcounter'] )))? sanitize_text_field( $_REQUEST['ocwatcp_showcounter'] ) : 'no';
                    update_option('ocwatcp_showcounter', $ocwatcp_showcounter, 'yes');

                    $ocwatcp_enablesuggestedpro = (!empty(sanitize_text_field( $_REQUEST['ocwatcp_enablesuggestedpro'] )))? sanitize_text_field( $_REQUEST['ocwatcp_enablesuggestedpro'] ) : 'no';
                    update_option('ocwatcp_enablesuggestedpro', $ocwatcp_enablesuggestedpro, 'yes');

                    $ocwatcp_protype = (!empty(sanitize_text_field( $_REQUEST['ocwatcp_protype'] )))? sanitize_text_field( $_REQUEST['ocwatcp_protype'] ) : 'related';
                    update_option('ocwatcp_protype', $ocwatcp_protype, 'yes');
                    update_option('ocwatcp_suggestedprotitle', sanitize_text_field( $_REQUEST['ocwatcp_suggestedprotitle'] ), 'yes');

                    $ocwatcp_suggestedprono = (!empty(sanitize_text_field( $_REQUEST['ocwatcp_suggestedprono'] )))? sanitize_text_field( $_REQUEST['ocwatcp_suggestedprono'] ) : 3;
                    update_option('ocwatcp_suggestedprono', $ocwatcp_suggestedprono, 'yes');

                    $ocwatcp_suggestedprocolumns = (!empty(sanitize_text_field( $_REQUEST['ocwatcp_suggestedprocolumns'] )))? sanitize_text_field( $_REQUEST['ocwatcp_suggestedprocolumns'] ) : 3;
                    update_option('ocwatcp_suggestedprocolumns', $ocwatcp_suggestedprocolumns, 'yes');

                    $ocwatcp_spt_color = (!empty(sanitize_text_field( $_REQUEST['ocwatcp_spt_color'] )))? sanitize_text_field( $_REQUEST['ocwatcp_spt_color'] ) : '#000000';
                    update_option('ocwatcp_spt_color',$ocwatcp_spt_color, 'yes');

                    $ocwatcp_spt_size = (!empty(sanitize_text_field( $_REQUEST['ocwatcp_spt_size'] )))? sanitize_text_field( $_REQUEST['ocwatcp_spt_size'] ) : 17;
                    update_option('ocwatcp_spt_size',$ocwatcp_spt_size, 'yes');

                    $ocwatcp_spt_position = (!empty(sanitize_text_field( $_REQUEST['ocwatcp_spt_position'] )))? sanitize_text_field( $_REQUEST['ocwatcp_spt_position'] ) : 'center';
                    update_option('ocwatcp_spt_position',$ocwatcp_spt_position, 'yes');

                    $ocwatcp_spt_style = (!empty(sanitize_text_field( $_REQUEST['ocwatcp_spt_style'] )))? sanitize_text_field( $_REQUEST['ocwatcp_spt_style'] ) : 700;
                    update_option('ocwatcp_spt_style',$ocwatcp_spt_style, 'yes');

                    $ocwatcp_sms_color = (!empty(sanitize_text_field( $_REQUEST['ocwatcp_sms_color'] )))? sanitize_text_field( $_REQUEST['ocwatcp_sms_color'] ) : '#000000';
                    update_option('ocwatcp_sms_color',$ocwatcp_sms_color, 'yes');

                    $ocwatcp_sms_bgcolor = (!empty(sanitize_text_field( $_REQUEST['ocwatcp_sms_bgcolor'] )))? sanitize_text_field( $_REQUEST['ocwatcp_sms_bgcolor'] ) : '#e6ffc5';
                    update_option('ocwatcp_sms_bgcolor',$ocwatcp_sms_bgcolor, 'yes');

                    $ocwatcp_bs_color = (!empty(sanitize_text_field( $_REQUEST['ocwatcp_bs_color'] )))? sanitize_text_field( $_REQUEST['ocwatcp_bs_color'] ) : '#515151';
                    update_option('ocwatcp_bs_color',$ocwatcp_bs_color, 'yes');

                    $ocwatcp_bs_bgcolor = (!empty(sanitize_text_field( $_REQUEST['ocwatcp_bs_bgcolor'] )))? sanitize_text_field( $_REQUEST['ocwatcp_bs_bgcolor'] ) : '#ebe9eb';
                    update_option('ocwatcp_bs_bgcolor',$ocwatcp_bs_bgcolor, 'yes');

                    $ocwatcp_pis_color = (!empty(sanitize_text_field( $_REQUEST['ocwatcp_pis_color'] )))? sanitize_text_field( $_REQUEST['ocwatcp_pis_color'] ) : '#000000';
                    update_option('ocwatcp_pis_color',$ocwatcp_pis_color, 'yes');

                    $ocwatcp_pis_size = (!empty(sanitize_text_field( $_REQUEST['ocwatcp_pis_size'] )))? sanitize_text_field( $_REQUEST['ocwatcp_pis_size'] ) : 20;
                    update_option('ocwatcp_pis_size',$ocwatcp_pis_size, 'yes');

                    $ocwatcp_pis_position = (!empty(sanitize_text_field( $_REQUEST['ocwatcp_pis_position'] )))? sanitize_text_field( $_REQUEST['ocwatcp_pis_position'] ) : 'center';
                    update_option('ocwatcp_pis_position',$ocwatcp_pis_position, 'yes');

                    $ocwatcp_pis_style = (!empty(sanitize_text_field( $_REQUEST['ocwatcp_pis_style'] )))? sanitize_text_field( $_REQUEST['ocwatcp_pis_style'] ) : 700;
                    update_option('ocwatcp_pis_style',$ocwatcp_pis_style, 'yes');

                    $ocwatcp_pis_pricecolor = (!empty(sanitize_text_field( $_REQUEST['ocwatcp_pis_pricecolor'] )))? sanitize_text_field( $_REQUEST['ocwatcp_pis_pricecolor'] ) : '#000000';
                    update_option('ocwatcp_pis_pricecolor',$ocwatcp_pis_pricecolor, 'yes');

                    $ocwatcp_pis_totalcolor = (!empty(sanitize_text_field( $_REQUEST['ocwatcp_pis_totalcolor'] )))? sanitize_text_field( $_REQUEST['ocwatcp_pis_totalcolor'] ) : '#000000';
                    update_option('ocwatcp_pis_totalcolor',$ocwatcp_pis_totalcolor, 'yes');

                    $ocwatcp_mcs_color = (!empty(sanitize_text_field( $_REQUEST['ocwatcp_mcs_color'] )))? sanitize_text_field( $_REQUEST['ocwatcp_mcs_color'] ) : '#000000';
                    update_option('ocwatcp_mcs_color',$ocwatcp_mcs_color, 'yes');

                    $ocwatcp_mcs_size = (!empty(sanitize_text_field( $_REQUEST['ocwatcp_mcs_size'] )))? sanitize_text_field( $_REQUEST['ocwatcp_mcs_size'] ) : 17;
                    update_option('ocwatcp_mcs_size',$ocwatcp_mcs_size, 'yes');

                    $ocwatcp_mcs_position = (!empty(sanitize_text_field( $_REQUEST['ocwatcp_mcs_position'] )))? sanitize_text_field( $_REQUEST['ocwatcp_mcs_position'] ) : 'center';
                    update_option('ocwatcp_mcs_position',$ocwatcp_mcs_position, 'yes');

                    $ocwatcp_mcs_style = (!empty(sanitize_text_field( $_REQUEST['ocwatcp_mcs_style'] )))? sanitize_text_field( $_REQUEST['ocwatcp_mcs_style'] ) : 700;
                    update_option('ocwatcp_mcs_style',$ocwatcp_mcs_style, 'yes');

                    wp_redirect( admin_url( 'admin.php?page=oc-cart-popup&message=success') ); exit;

                }
            }
        }
    }


    function init() {

    /* Total QTY Field */
    add_action('admin_menu', array($this, 'ocwatcp_register_my_custom_submenu_page'));

    //Save all admin options
    add_action( 'admin_init',  array($this, 'ocwatcp_save_options'));

    }

    public static function OCWATCP_instance() {
      if (!isset(self::$OCWATCP_instance)) {
        self::$OCWATCP_instance = new self();
        self::$OCWATCP_instance->init();
      }
      return self::$OCWATCP_instance;
    }

  }

  OCWATCP_admin_settings::OCWATCP_instance();
}







