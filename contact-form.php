<?php
/**
 *
 Plugin Name: Contact Form
 Plugin URI:  https://developer.wordpress.org/plugins/the-basics/
 Description: Wordpress Plugin for contact form.
 Version:     1.0.2
 Author:      Sushma Kure
 Author URI:  https://codepen.io/sushmak02
 Text Domain: contactform-textdomain
 Domain Path: /languages
 License:     GPL2
 */

add_action( 'admin_menu' , 'register_contact_form' );

//create Menu page

function register_contact_form() {
    
    //add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function );
    add_menu_page( 'Page Title', 'Contact Form', 'manage_options','top_menu_slug', 'form_options_page' );
     add_submenu_page( 'top_menu_slug','option Title', 'Update EMail-id', 'manage_options','sub_menu_slug', 'form_submenu_page' );
    add_action( 'admin_init' , 'register_form_settings' );

}


//register settings

function register_form_settings() {

    register_setting( 'form-options-group' , 'form_option_name' );
    register_setting( 'form-options-group' , 'form_option_email' );
    register_setting( 'form-options-group' , 'form_option_mobno' );
    register_setting( 'form-options-group' , 'form_option_sub' );
    register_setting( 'form-options-group' , 'form_option_msg' );

}



//Define Shortcode

function form_shortcode() {

    $form_name  = esc_attr( get_option( 'form_option_name' ) );
    $form_email = esc_attr( get_option( 'form_option_email' ) );
    $form_mobno = esc_attr( get_option( 'form_option_mobno' ) );
    $form_sub   = esc_attr( get_option( 'form_option_sub' ) );
    $form_msg   = esc_attr( get_option( 'form_option_msg' ) );


    ?>
    <table>
        <tr>
          <th><label for="option_name">Name: </label></th>
          <td><input type="text" id="option_name" name="option_name" value='<?php _e($form_name); ?>' /></td>
        </tr>

        <tr>
          <th><label for="option_email">Email: </label></th>
          <td><input type="email" id="option_email" name="option_email" value='<?php _e($form_email); ?>' /></td>
        </tr>

        <tr>
          <th><label for="option_sub">Subject: </label></th>
          <td><input type="text" id="option_sub" value='<?php _e($form_sub); ?>' /></td>
        </tr>

        <tr>
          <th><label for="option_mobno">Mob no: </label></th>
          <td><input type="number" id="option_mobno" value='<?php _e($form_mobno); ?>' /></td>
        </tr>
         <tr>
          <th><label for="option_msg">Message: </label></th>
          <td><textarea id="option_msg"><?php _e($form_msg); ?></textarea></td>
        </tr>

      </table>

    <?php

}

add_shortcode( 'form-data' , 'form_shortcode' );


//Contents of option page.

function form_options_page() {   
?>

 <div>
    <h2>GET IN TOUCH</h2>
     <form method="post" action="options.php">
    <?php settings_fields( 'form-options-group' ); ?>

      <?php do_settings_sections( 'form-options-group' ); ?>
       
      <table>
        <tr>
          <th><label for="form_option_name">Name : </label></th>
          <td><input type="text" id="form_option_name" name="form_option_name" value="<?php
          echo esc_attr( get_option( 'form_option_name' ) ); ?>" /></td>
          <th><label for="form_option_email">Email : </label></th>
          <td><input type="email" id="form_option_email" name="form_option_email" value="<?php
          echo esc_attr( get_option( 'form_option_email' ) ); ?>" /></td>
        </tr>

        <tr>
          <th><label for="form_option_sub">Subject : </label></th>
          <td><input type="text" id="form_option_sub" name="form_option_sub" value="<?php
          echo esc_attr( get_option( 'form_option_sub' ) ); ?>" /></td>
          <th><label for="form_option_mobno">Mob No. : </label></th>
          <td><input type="number" id="form_option_mobno" name="form_option_mobno" value="<?php
          echo esc_attr( get_option( 'form_option_mobno' ) ); ?>" /></td>
        </tr>
        <tr>
          <th><label for="form_option_msg">Message : </label></th>
          <td><textarea id="form_option_msg" name="form_option_msg"> <?php
          echo esc_attr( get_option( 'form_option_msg' ) ); ?></textarea></td>
        </tr>
      </table>

    <?php  submit_button(); ?>
    <?php _e('Use this shortcode in your page : [ form-data ]', 'form-textdomain' ); ?>
    </form>
  </div>
<?php
}

function form_submenu_page() {   
?>

 <div>
    <h2>Update Admin Email ID</h2>
     <form method="post" action="options.php">
    <?php settings_fields( 'form-options-group' ); ?>

      <?php do_settings_sections( 'form-options-group' ); ?>
       
      <table>
        <tr>
          <th><label for="form_option_email">Email : </label></th>
          <td><input type="email" id="form_option_email" name="form_option_email" value="<?php
          echo esc_attr( get_option( 'form_option_email' ) ); ?>" /></td>
        </tr>
      </table>

    <?php  submit_button(); ?>
    </form>
  </div>
<?php
}
?>