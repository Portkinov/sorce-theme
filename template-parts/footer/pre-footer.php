<?php
use \eyepolitic\Eyepolitic as Theme;

?>
<!--
<div class="containerwrap pre-footer">
    <div class="container-fluid component p-0 m-0">
        <div class="row d-flex m-0 footer-row">
            <div class="col-12 col-md-7 m-0 p-0">
                
                    <?php
                    #Get Logo
                    ?>
                <div class="footerlogo"><img class="footer-logo" src="<?php echo get_template_directory_uri() ?>/theme/assets/Logo.svg" /></div>
                <div class="footerform">
                    <small class="footerform form-text text-light">Stay informed with EyePolitic updates.</small>
                    <?php 
                        $shorty = \get_theme_mod('footer_signup_shortcode');
                        if($shorty && do_shortcode($shorty) !== $shorty){
                            echo do_shortcode($shorty);
                        }
                
                    ?>
                </div>
            </div>
            <div class="col-12 col-md-5 m-0 p-0">
            <?php
                            wp_nav_menu( array(
                                'theme_location'  => Theme::textdomain . '_footer_nav',
                                'depth'           =>  1, // 1 = no dropdowns, 2 = with dropdowns.
                                'menu_class' => 'footerlist',
                                'container_id'    => 'footermenu',                    
                            ) );
            ?>
            </div>
        </div>
    </div>
</div>
-->