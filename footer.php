 <?php
 use starter\Starter as Theme;
 ?>   
        

    

    <footer class="theme-footer mx-0 px-0 container-fluid">
        <section class="pre-footer-donate">
            <?php get_template_part( 'template-parts/footer/pre-footer-donate' ); ?>
        </section>
        <section class="pre-footer">
            <?php get_template_part( 'template-parts/footer/pre-footer' ); ?>
        </section>

        <div class="row mx-0 d-flex flex-row footer-row footer-bottom">
            <div class="copyright">Copyright <?php echo date('Y') . ' ' . Theme::nicename ?></div>
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
                
                $footerul = '<ul class="footer-social">';
                $footerli = '';
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
    </footer>
</div>
<?php wp_footer(); ?>