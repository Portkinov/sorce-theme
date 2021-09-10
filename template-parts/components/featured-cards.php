<?php 
#Featured Cards Module
?>
<div class="containerwrap featuredcards">
    <div class="container component">
        <div class="row">
            <div class="col-12 col-md-6">
                <img class="missionleft" src="<?php echo \get_the_post_thumbnail_url( $post->ID ) ?>" />
            </div>
    
            <div class="col-12 col-md-6">
                <h2 class="missionright"><?php echo \get_the_title( $post->ID ); ?></h2>
                <div class="missionright"><?php \the_content(); ?></div>
            </div>
        </div>
    </div>
</div>