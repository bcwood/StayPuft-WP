<?php
// setup admin menu
add_action( 'admin_menu', 'staypuft_admin_menu' );

if ( ! function_exists( 'staypuft_admin_menu' ) ) :
/**
 * 
 */
function staypuft_admin_menu() {
    // add page for theme options
    add_submenu_page( 'themes.php',
                      'StayPuft Theme Options', 
                      'StayPuft Options', 
                      'manage_options',
                      'staypuft-theme-options', 
                      'staypuft_theme_options' ); 
}
endif; // staypuft_admin_menu

if ( ! function_exists( 'staypuft_theme_options' ) ) :
/**
 * 
 */
function staypuft_theme_options() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'You do not have sufficient permissions to access this page.' );
    }
    
    $social_icon_options = array(
		"rss" =>        array( "name" => "Subscribe", "prefix" => "", "placeholder" => get_bloginfo( 'rss2_url' ), "icon_class" => "fa fa-rss" ),
        "github" =>     array( "name" => "GitHub", "prefix" => "https://github.com/", "placeholder" => "username", "icon_class" => "fa fa-github" ),
        "twitter" =>    array( "name" => "Twitter", "prefix" => "https://twitter.com/", "placeholder" => "username", "icon_class" => "fa fa-twitter" ),
        "instagram" =>  array( "name" => "Instagram", "prefix" => "https://instagram.com/", "placeholder" => "username", "icon_class" => "fa fa-instagram" ),
        "facebook" =>   array( "name" => "Facebook", "prefix" => "https://facebook.com/", "placeholder" => "username", "icon_class" => "fa fa-facebook" ),
		"youtube" =>    array( "name" => "YouTube", "prefix" => "https://youtube.com/user/", "placeholder" => "username", "icon_class" => "fa fa-youtube-play" ),
		"linkedin" =>   array( "name" => "LinkedIn", "prefix" => "https://linedin.com/in/", "placeholder" => "username", "icon_class" => "fa fa-linkedin" ),
		"googleplus" => array( "name" => "Google+", "prefix" => "https://plus.google.com/", "placeholder" => "username", "icon_class" => "fa fa-google-plus" ),
		"contact" =>    array( "name" => "Contact", "prefix" => "mailto:", "placeholder" => "email", "icon_class" => "fa fa-envelope" ),
    );        
    
    if ( isset( $_POST['update_settings'] ) ) {
        $social_icons = array();
        
        foreach ($social_icon_options as $key => $icon) {
            if ( !empty( $_POST[$key] ) )
            {
                $icon["value"] = esc_attr( $_POST[$key] );
                $social_icons[$key] = $icon;
            }
        }
        
        update_option( 'staypuft_options_social_icons', $social_icons );
?>
        <div id="message" class="updated">Theme options saved.</div>  
<?php
    }
    else {
        $social_icons = get_option( 'staypuft_options_social_icons' );
    }
?>
    <div class="wrap">
        <?php screen_icon( 'themes' ); ?> 
        <h2>StayPuft Theme Options</h2>
 
        <form method="POST" action="">            
            <h3>Social Icons</h3>
            
            <p>
                <em>Enter the usernames/URLs for your social media sites that you would like to appear in the sidebar.</em>
            </p>
            
            <ul id="social-icon-list">
                <?php foreach ($social_icon_options as $key => $icon) :?>
                    <li>
                        <i class="<?php echo $icon["icon_class"]; ?>"></i>
                        <label for="<?php echo $key; ?>">
                            <?php echo $icon["name"]; ?>
                        </label>
                        <input type="text" name="<?php echo $key; ?>" size="25" value="<?php echo $social_icons[$key]["value"]; ?>" placeholder="<?php echo $icon["placeholder"]; ?>" />
                    </li>
                <?php endforeach; ?>
            </ul>
            
            <br/>
            <p>
                <input type="hidden" name="update_settings" value="Y" />
                <input type="submit" value="Save Options" class="button-primary"/>
            </p>
        </form>
    </div>
<?php
}
endif; // staypuft_theme_options

add_action( 'admin_enqueue_scripts', 'staypuft_admin_enqueue_scripts' );

if ( ! function_exists( 'staypuft_admin_enqueue_scripts' ) ) :
/**
 * 
 */
function staypuft_admin_enqueue_scripts($hook) {
    if( 'appearance_page_staypuft-theme-options' != $hook )
        return;
    
    wp_register_style( 'font_awesome', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'font_awesome' );
    
    wp_register_style( 'staypuft_admin_styles', get_template_directory_uri() . '/admin-style.css' );
	wp_enqueue_style( 'staypuft_admin_styles' );
}
endif; // staypuft_admin_enqueue_scripts
