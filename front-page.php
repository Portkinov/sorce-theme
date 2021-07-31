<?php

#require_once \get_template_directory().'/template-parts/components/retirement-compass.php'; 

#use southportcapital\components\RetirementCompass as RetirementCompass;


/**
 * The main index file
 *
 */

get_header();
$backgroundimg = \get_the_post_thumbnail_url( get_the_ID(), 'full' );
$slug = get_post_field( 'post_name', get_the_ID() );
$video = \carbon_get_post_meta( get_the_ID(),'home_video' ); 
?>

<div class="home-page container-fluid clearfix p-0 mx-0" id="page-<?php echo $slug ?>">
    <div <?php post_class(); ?> >

        <div class="row clearfix page-header underlap" style="background-image:url(<?php echo $backgroundimg ?>);">
            <div class="col-12 p-0 header-center">
                <h1 class="page-title text-light"><?php echo get_the_title() ?></h1>
                <div class="entry-content text-light" id="entry-<?php echo $slug ?>">
                    <?php
                    the_content();
                    ?>
                </div><!-- .entry-content -->

                <?php
                                    
                $shorty = \get_theme_mod('hero_signup_shortcode');
                if($shorty && do_shortcode($shorty) !== $shorty){
                    echo do_shortcode($shorty);
                }
                            
                ?>
            </div><!-- col12 -->
        </div><!--row-->
        <a id="videolink"></a>
        <div class="row mx-0 px-0 clearfix home-modules">
            <div class="col-12 m-0 p-0">
                <?php if($video) { ?>
                <!-- modules start -->
                <div class="containerwrap video-module">
                    <div class="container-fluid component p-0 m-0">
                        <div class="row d-flex m-0 p-0">
                            <div class="col-12 m-0 p-0 vidrow">
                                
                                <div class="iframewrap pullup">
                                    <div id="video_control" class="aspect_ratio_enforcer">
                                    <?php
                                    $chrome = false;
                                    if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false ||
                                        strpos($_SERVER['HTTP_USER_AGENT'], 'CriOS') !== false) {
                                        
                                            $chrome = true;
                                    }
                                    $placeholder = $chrome ? 'video-placeholder.png' : 'vid-placeholder.png';



?>
                                        <video class="<?php echo ($chrome) ? "chromevid" : "nonchromevid" ?>"
                                        controls preload="none" poster="<?php echo get_template_directory_uri() . '/theme/assets/' . $placeholder ?> " style="object-fit:cover;">
                                        <source src="<?php echo $video ?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                        </video>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- video end -->
                <?php } ?>
                <!-- four cards begin -->
                <div class="containerwrap featured-services-cards" style="z-index:3; position: relative;">
                    <div class="container-fluid component p-0 m-0">
                        <div class="row m-0 px-0 d-flex justify-content-center">
                            <div class="cardholder marginbox grid-four">
                                <div class="card">
                                    <div class="card-background" style="background-image:url(<?php echo get_template_directory_uri() . '/theme/assets/card-left.jpeg'  ?>);">
                                    <div class="expander"></div>
                                        <div class="card-body"><h2 class="card-title text-light">represent</h2>
                                            <div class="card-text">
                                            Want to know what bills your representatives sponsored? Want to know who is donating to your representatives? With verified research eyepolitic connects all the dots for you to be informed when it comes to your government.
                                            </div>
                                            <div class="buttonwrap"><div class="button button-pill learnmore">Learn More</div></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-background" style="background-image:url(<?php echo get_template_directory_uri() . '/theme/assets/card-2.jpeg'  ?>);">
                                    <div class="expander"></div>
                                        <div class="card-body"><h2 class="card-title text-light">follow</h2>
                                            <div class="card-text">
                                            Is the tool that allows you to stay informed to any government official, for which you wish to stay informed. This will allow you to stay up to date with officials you want to keep your eye on.
                                            </div>
                                            <div class="buttonwrap"><div class="button button-pill learnmore">Learn More</div></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-background" style="background-image:url(<?php echo get_template_directory_uri() . '/theme/assets/card-3.jpeg'  ?>);">
                                    <div class="expander"></div>
                                        <div class="card-body"><h2 class="card-title text-light">assemble</h2>
                                            <div class="card-text">
                                            Is your platform to create change at all levels of the government. Want to start a national law? State law? This is the place. Due to the sensitive nature of this development, the specifics of this  platform will not be disclosed until release. You will be happy!
                                            </div>
                                            <div class="buttonwrap"><div class="button button-pill learnmore">Learn More</div></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">  
                                    <div class="card-background" style="background-image:url(<?php echo get_template_directory_uri() . '/theme/assets/card-4.jpeg'  ?>);">
                                    <div class="expander"></div>
                                        <div class="card-body"><h2 class="card-title text-light">gather</h2>
                                            <div class="card-text">Do you feel social media restricts you. We want to culture your first amendment right through freedom of speech. Finally, a social platform that encourages freedom of speech!
                                            </div>
                                            <div class="buttonwrap"><div class="button button-pill learnmore">Learn More</div></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <a id="visionlink"></a>
            <div class="containerwrap our-vision">
                <div class="container-fluid component p-0 m-0">
                    <div class="row d-flex m-0">
                        <div class="col-12 col-md-7 vision-col1">
                            <h2 class="module-title">Our Vision</h2>
                            <div class="module-text">
With the tools provided by eyepolitic, <strong>We The People</strong> can hold all government officials, elected or appointed, accountable in real-time.  The idea of eyepolitic connecting every constituent together to hold their elected officials accountable to their electorate is not only revolutionary, but absolutely vital for the success of a free Republic.</div>

<div><br>Eyepolitic will utilize all known public records, sponsored legislation, laws, public policies and procedures, political contributions, expenses and all things governmental, including public meetings from political activists, campaign contributors, lobbyists, and special interest
groups; placing them right in the hands of the induvidual to affect change born from facts.</div>

<div><br>
    Our tools will give you the information you need by connecting the dots from all public information, now easily accessible in one organized platform to take action at every level of governance. Never again will you have to depend on invalid news. With eyepolitic, you are no longer alone.
                            </div>
                        </div>
                        <div class="col-12 col-md-5 m-0 p-0">
                            <p>We envision culturing truth by expanding on Thomas Jefferson’s words…</p>
                            <h4 class="text-dark">
                                “Whether. Peace is Best preserved by giving energy to the government or information to the people. <br> <br>The last is the most certain and the most legitimate engine of government.”</h4>
                        </div>
                    </div><!--end row -->
                </div>
            </div>
            <!-- modules end -->
        </div>
    </div><!-- end content-->

     

<?php

get_footer();