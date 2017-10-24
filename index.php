
      <?php get_header(); ?>
      <div class="slider">
         <div class="headline-wrap">

            <?php 
                global $post;
                $args = array ( 'post_type' => 'slider', 'posts_per_page' => '5' );
                $myposts = get_posts( $args );
                foreach( $myposts as $post ) : setup_postdata( $post );?>


            <?php 
                $slide_bg = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID), 'silder-bg');

             ?>



            
            <div class="slide tine-teaser" style="background-image: url(<?php echo $slide_bg[0]; ?>">
               <p class="slide-copy">
                  <?php the_title(); ?>
                  <a href="/products/deer/battle-bones.html">Deer Calls</a>
               </p>
            </div>

    
            <?php endforeach; ?>
<!-- 
            <div class="slide battle-bones"  style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/slide-battle-bones-bg.jpg));">
               <p class="slide-copy">
                  Upgrade<br />
                  your arsenal<br />
                  <a href="/products/deer.html">Battle Bones</a>
               </p>
            </div> -->
         </div>
         <div class="slider-nav">
            <span class="pagination-prev"></span>
            <span class="pagination-slides"></span>
            <span class="pagination-next"></span>
         </div>
         <span class="big-arrows pagination-prev"></span>
         <span class="big-arrows pagination-next"></span>
         <div class="slider-overlay-bottom"></div>
      </div>
      <div class="motto-categories-cta">
         <div class="motto">
            <h2>Changing the tone of game call development</h2>
            <p>There are people who talk about getting things done. And then there are people who see opportunity, roll up their sleeves, and do it. The Flextone brand has been developed and improved over the years by a long line of doers who are never fully satisfied with available game call options. Whether it's due to unnatural and ineffective performance, highly adaptive animals, or out-of-reach price points, Flextone was created to continually put performance-driven calls into the hands (and mouths) of hunters.</p>
         </div>
         <div class="container categories">
            <div class="row">
               <div class="col-xs-12 col-sm-6 col-md-4 category">
                  <a href="/products/turkey.html"><img src="<?php echo get_template_directory_uri();?>/img/category-turkey.jpg" alt="Turkey Calls" /></a>
               </div>
               <div class="col-xs-12 col-sm-6 col-md-4 category">
                  <a href="/products/deer.html"><img src="<?php echo get_template_directory_uri();?>/img/category-deer.jpg" alt="Deer Calls" /></a>
               </div>
               <div class="col-xs-12 col-sm-6 col-md-4 category">
                  <a href="/products/elk-calls-50.html"><img src="<?php echo get_template_directory_uri();?>/img/category-elk.jpg" alt="Elk Calls" /></a>
               </div>
               <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2 category">
                  <a href="/products/waterfowl.html"><img src="<?php echo get_template_directory_uri();?>/img/category-waterfowl.jpg" alt="Waterfowl Calls" /></a>
               </div>
               <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-0 category">
                  <a href="/products/predator.html"><img src="<?php echo get_template_directory_uri();?>/img/category-predator.jpg" alt="Predator Calls" /></a>
               </div>
            </div>
         </div>
         <div class="cta">
            <h2>Learn from the experts and watch the latest how-to videos for Flextone<sup>&reg;</sup> game calls.</h2>
            <a href="/media-center">Watch Videos</a>
         </div>
      </div>
      <noscript>
         <div class="global-site-notice noscript">
            <div class="notice-inner">
               <p>
                  <strong>JavaScript seems to be disabled in your browser.</strong><br />
                  You must have JavaScript enabled in your browser to utilize the functionality of this website.                
               </p>
            </div>
         </div>
      </noscript>
     <?php get_footer(); ?>