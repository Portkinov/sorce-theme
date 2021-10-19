 <?php
 use sorce\Theme as Theme;
 ?>   

    <footer class="theme-footer mx-0 px-0 container-fluid">

        
        <?php get_template_part( 'template-parts/footer/pre-footer' ); ?>
        <div class="row">
            <div class="leftcol">

                <?php
                $logo = \get_theme_mod( 'custom_logo');
		
                if( $logo ){			        
                    $image = \wp_get_attachment_image_src( $logo , 'full' );
                    $image_url = $image[0];
                    echo '<img class="footer-logo" src="'.$image_url.'" />';
                }

                \wp_nav_menu( array(
                    'theme_location'  => Theme::textdomain . '_footer_left_nav',
                    'depth'           =>  1, // 1 = no dropdowns, 2 = with dropdowns.
                    'menu_class' => 'leftnav',
                    'container_id'    => 'leftnav',
                    
                ) );

                $address = \carbon_get_theme_option('crb_address');
                if($address) echo '<span class="address">' . $address . '</span>';

                echo '<span class="copyright">Copyright ' . Date('Y') . ' ' . Theme::nicename . '</span>';

                ?>
            </div>
            <div class="rightcol">
                <div class="top">
                <?php
                \wp_nav_menu( array(
                    'theme_location'  => Theme::textdomain . '_footer_right_nav',
                    'depth'           =>  1, // 1 = no dropdowns, 2 = with dropdowns.
                    'menu_class' => 'rightnav',
                    'container_id'    => 'rightnav',
                    
                ) );
                ?>
                </div>
                <div class="bottom social-menu">
                    <?php
                        /* get social menu */
                        $fblink = \carbon_get_theme_option('crb_facebook_link');
                        $fblogo = \carbon_get_theme_option('crb_facebook_logo') ? \carbon_get_theme_option('crb_facebook_logo') : get_template_directory_uri().'/theme/assets/social-fb.svg';

                        $twlink = \carbon_get_theme_option('crb_twitter_link');
                        $twlogo = \carbon_get_theme_option('crb_twitter_logo') ? \carbon_get_theme_option('crb_twitter_logo') : get_template_directory_uri().'/theme/assets/social-ig.svg';

                        $iglink = \carbon_get_theme_option('crb_instagram_link');
                        $iglogo = \carbon_get_theme_option('crb_instagram_logo') ? \carbon_get_theme_option('crb_instagram_logo') : get_template_directory_uri().'/theme/assets/social-tw.svg';
                        
                        $youtubelink = \carbon_get_theme_option('crb_youtube_link');
                        $youtubelogo = \carbon_get_theme_option('crb_youtube_logo') ? \carbon_get_theme_option('crb_youtube_logo') : get_template_directory_uri().'/theme/assets/social-yt.svg';

                        $linkedinlink = \carbon_get_theme_option('crb_linkedin_link');
                        $linkeinlogo = \carbon_get_theme_option('crb_linkedin_logo') ? \carbon_get_theme_option('crb_youtube_logo') : get_template_directory_uri().'/theme/assets/social-li.svg';

                        #Render It
                        $footerul = '<ul class="footer-social">';
                        $footerli = '';

                        if($linkedinlink && $linkedinlogo) {
                            $footerli.= '<li><a target="_blank" href="'.$linkedinlink.'">';
                            $footerli.='<span class="social-li" style="background-image:url(';
                            $footerli.= $linkedinlogo.');"></span></a></li>';
                        }

                        if($fblink && $fblogo) {
                            $footerli.= '<li><a target="_blank" href="'.$fblink.'">';
                            $footerli.='<span class="social-fb" style="background-image:url(';
                            $footerli.= $fblogo.');"></span></a></li>';
                        }

                        if($twlink && $twlogo) {
                            $footerli.= '<li><a target="_blank" href="'.$twlink.'">';
                            $footerli.='<span class="social-tw" style="background-image:url(';
                            $footerli.= $twlogo.');"></span></a></li>';
                        }

                        if($iglink && $iglogo) {
                            $footerli.= '<li><a target="_blank" href="'.$iglink.'">';
                            $footerli.='<span class="social-ig" style="background-image:url(';
                            $footerli.= $iglogo.');"></span></a></li>';
                        }

                        if($youtubelink && $youtubelogo) {
                            $footerli.= '<li><a target="_blank" href="'.$youtubelink.'">';
                            $footerli.='<span class="social-yt" style="background-image:url(';
                            $footerli.= $youtubelogo.');"></span></a></li>';
                        }
                        if( strlen($footerli) ){
                            echo $footerul . $footerli . '</ul>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </footer>
</div>
<?php wp_footer(); ?>