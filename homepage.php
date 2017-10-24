<?php
/*
Template Name: Homepage
*/
?>
      <?php get_header(); 
      $page_id = get_queried_object_id();
      ?>
      <div class="slider">
         <div class="headline-wrap"> 
            <?php   
               $slider_item = get_field('slider_item', $page_id); 
               foreach ($slider_item as $slider ):
            ?>
            <div class="slide tine-teaser" style="background-image: url(<?php echo $slider['slider_img']; ?>">
               <p class="slide-copy title"><?php echo $slider['slider_title']; ?>
               <a class="slide-copy button" href="<?php echo $slider['slider_button_url']; ?>"><?php echo $slider['slider_button_text']; ?></a>
               </p>
               
            </div>
             <?php endforeach; ?>
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

      <!---///////// slider-end -->

      <div class="motto-categories-cta" style="background-image: url(<?php the_field('feature_background_top', $page_id) ?>), url(<?php the_field('feature_background_bottom', $page_id) ?>);">
         <div class="motto">
            <h2><?php echo get_field('feature_title', $page_id) ?></h2>
            <p><?php echo get_field('feature_content', $page_id) ?></p>
         </div>
         <div class="container categories">
            <div class="row">
               <?php   

               $feature_images = get_field('feature_images', $page_id); 
               foreach ($feature_images as $img ):
                  
               ?>
               <div class="col-xs-12 col-sm-6 col-md-4 category">
                  <a href="<?php echo $img['f-img-url']; ?>"><img src="<?php echo $img['single-feature']; ?>" alt="<?php echo $img['alt']; ?>" /></a>
               </div>
               <?php endforeach; ?>
            </div>
         </div>
         <div class="cta">
            <h2><?php echo get_field('feature_bottom_title', $page_id) ?></h2>
            <a href="<?php echo get_field('button_url', $page_id) ?>"><?php echo get_field('button_text', $page_id) ?></a>
         </div>
      </div>

     <?php get_footer(); ?>