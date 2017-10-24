<?php 
/*
Template Name: Media Center
*/
get_header(); ?>
      <div class="container">
         <div class="layout layout-1-col">
            <div role="main">
               <div class="page-title" style="margin-top: 70px;">
                  <h1><?php the_title(); ?></h1>
               </div>
               <div class="std">
                  <div>&nbsp;</div>
               </div>
               
               <?php
               $categories = get_terms( 'video_type', array(
                   'hide_empty' => true
               ) );

               foreach( $categories as $category ) :

               ?>


               <h2><?php echo $category->name; ?></h2>
               <div class="divide-black"></div>
               <div class="row">
               <?php
               $args = array(
                  'post_type'     => 'video',
                  'tax_query' => array(
                     array(
                        'taxonomy' => 'video_type',
                        'field'    => 'slug',
                        'terms'    => $category->slug,
                     ),
                  ),
               );
               $query = new WP_Query($args);
               while($query->have_posts()) : $query->the_post();

               $div_id = get_field('youtube_video_id');
               ?>

                  <div class="col-sm-3 media-item" data-toggle="modal" data-target="#videoModal" data-src="<?php echo $div_id; ?>">
                     <img src="http://img.youtube.com/vi/<?php echo $div_id; ?>/0.jpg" class="adpt" style="max-width:480px;" alt="<?php the_title(); ?>">
                     <a href="#" class="media-label" data-toggle="modal" data-target="#videoModal" data-src="<?php echo $div_id; ?>"><?php the_title(); ?></a>
                  </div>

               <?php endwhile; ?>



                  <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                     <div class="modal-dialog">
                        <div class="modal-content">
                           <div class="video-wrap">
                              <iframe id="video-player" width="560" height="315" src="/blank.html" frameborder="0" allowfullscreen ></iframe>
                              <div class="align-c"><i class="fa fa-spinner fa-pulse"></i></div>
                           </div>
                        </div>
                        <!-- /.modal-content -->
                     </div>
                     <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->                    
               </div>


               <?php endforeach; ?>









<!--                <div class="gap-v-30"></div>
<h2>Other Videos</h2>
<div class="divide-black"></div>
<div class="row">
   <div class="col-sm-3 media-item" data-toggle="modal" data-target="#videoModal" data-src="f8VoaJPN3K8">
      <img src="http://img.youtube.com/vi/f8VoaJPN3K8/0.jpg" class="adpt" style="max-width:480px;" alt="Lock Down Commercial Teaser">
      <a href="#" class="media-label" data-toggle="modal" data-target="#videoModal" data-src="f8VoaJPN3K8">Lock Down Commercial Teaser</a>
   </div>
   <div class="col-sm-3 media-item" data-toggle="modal" data-target="#videoModal" data-src="D3bfpoK3OlA">
      <img src="http://img.youtube.com/vi/D3bfpoK3OlA/0.jpg" class="adpt" style="max-width:480px;" alt="Ground Grunt'r Don't Get Busted Commercial">
      <a href="#" class="media-label" data-toggle="modal" data-target="#videoModal" data-src="D3bfpoK3OlA">Ground Grunt'r Don't Get Busted Commercial</a>
   </div>
   <div class="col-sm-3 media-item" data-toggle="modal" data-target="#videoModal" data-src="RDPuqsN9q1s">
      <img src="http://img.youtube.com/vi/RDPuqsN9q1s/0.jpg" class="adpt" style="max-width:480px;" alt="Ground Grunt'r News Flash Commercial">
      <a href="#" class="media-label" data-toggle="modal" data-target="#videoModal" data-src="RDPuqsN9q1s">Ground Grunt'r News Flash Commercial</a>
   </div>
   <div class="col-sm-3 media-item" data-toggle="modal" data-target="#videoModal" data-src="dF5tLEscXMY">
      <img src="http://img.youtube.com/vi/dF5tLEscXMY/0.jpg" class="adpt" style="max-width:480px;" alt="Beat the Street Thunder Hybrid Turkey Calls Commercial">
      <a href="#" class="media-label" data-toggle="modal" data-target="#videoModal" data-src="dF5tLEscXMY">Beat the Street Thunder Hybrid Turkey Calls Commercial</a>
   </div>
   <div class="col-sm-3 media-item" data-toggle="modal" data-target="#videoModal" data-src="iPL5ut6qadY">
      <img src="http://img.youtube.com/vi/iPL5ut6qadY/0.jpg" class="adpt" style="max-width:480px;" alt="Beat the Street with the Thunder Hybrids">
      <a href="#" class="media-label" data-toggle="modal" data-target="#videoModal" data-src="iPL5ut6qadY">Beat the Street with the Thunder Hybrids</a>
   </div>
   <div class="col-sm-3 media-item" data-toggle="modal" data-target="#videoModal" data-src="uNhJTrRXRJ8">
      <img src="http://img.youtube.com/vi/uNhJTrRXRJ8/0.jpg" class="adpt" style="max-width:480px;" alt="Beat the Street">
      <a href="#" class="media-label" data-toggle="modal" data-target="#videoModal" data-src="uNhJTrRXRJ8">Beat the Street</a>
   </div>
   <div class="col-sm-3 media-item" data-toggle="modal" data-target="#videoModal" data-src="NaU6hzowGC8">
      <img src="http://img.youtube.com/vi/NaU6hzowGC8/0.jpg" class="adpt" style="max-width:480px;" alt="2013 Flextone Sizzle Reel">
      <a href="#" class="media-label" data-toggle="modal" data-target="#videoModal" data-src="NaU6hzowGC8">2013 Flextone Sizzle Reel</a>
   </div>
   <div class="col-sm-3 media-item" data-toggle="modal" data-target="#videoModal" data-src="515EHOntqeE">
      <img src="http://img.youtube.com/vi/515EHOntqeE/0.jpg" class="adpt" style="max-width:480px;" alt="2013 Nosler's Magnum TV Black Rack, Buck Crusher and Last Resort 90 Second Promo">
      <a href="#" class="media-label" data-toggle="modal" data-target="#videoModal" data-src="515EHOntqeE">2013 Nosler's Magnum TV Black Rack, Buck Crusher and Last Resort 90 Second Promo</a>
   </div>
   <div class="col-sm-3 media-item" data-toggle="modal" data-target="#videoModal" data-src="gQNk65ApeXc">
      <img src="http://img.youtube.com/vi/gQNk65ApeXc/0.jpg" class="adpt" style="max-width:480px;" alt="Savage Outdoors Thunder Chicken Promo">
      <a href="#" class="media-label" data-toggle="modal" data-target="#videoModal" data-src="gQNk65ApeXc">Savage Outdoors Thunder Chicken Promo</a>
   </div>
   <div class="col-sm-3 media-item" data-toggle="modal" data-target="#videoModal" data-src="uQAZQFiUPpQ">
      <img src="http://img.youtube.com/vi/uQAZQFiUPpQ/0.jpg" class="adpt" style="max-width:480px;" alt="Flextone Last Resort">
      <a href="#" class="media-label" data-toggle="modal" data-target="#videoModal" data-src="uQAZQFiUPpQ">Flextone Last Resort</a>
   </div>
   <div class="col-sm-3 media-item" data-toggle="modal" data-target="#videoModal" data-src="YxPZC-WgGV4">
      <img src="http://img.youtube.com/vi/YxPZC-WgGV4/0.jpg" class="adpt" style="max-width:480px;" alt="Flextone Deer Calls">
      <a href="#" class="media-label" data-toggle="modal" data-target="#videoModal" data-src="YxPZC-WgGV4">Flextone Deer Calls</a>
   </div>
   <div class="col-sm-3 media-item" data-toggle="modal" data-target="#videoModal" data-src="6egW__fD1qU">
      <img src="http://img.youtube.com/vi/6egW__fD1qU/0.jpg" class="adpt" style="max-width:480px;" alt="Harlem Shake Turkey Video">
      <a href="#" class="media-label" data-toggle="modal" data-target="#videoModal" data-src="6egW__fD1qU">Harlem Shake Turkey Video</a>
   </div>
   <div class="col-sm-3 media-item" data-toggle="modal" data-target="#videoModal" data-src="OGDlXskv-3E">
      <img src="http://img.youtube.com/vi/OGDlXskv-3E/0.jpg" class="adpt" style="max-width:480px;" alt="2013 Whitetail Freaks Thunder Cut'n Promo">
      <a href="#" class="media-label" data-toggle="modal" data-target="#videoModal" data-src="OGDlXskv-3E">2013 Whitetail Freaks Thunder Cut'n Promo</a>
   </div>
   <div class="col-sm-3 media-item" data-toggle="modal" data-target="#videoModal" data-src="UiZsZxXKpSQ">
      <img src="http://img.youtube.com/vi/UiZsZxXKpSQ/0.jpg" class="adpt" style="max-width:480px;" alt="2013 Intrepid Outdoors Funky Chicken and Thunder Series 90 Sec Promo">
      <a href="#" class="media-label" data-toggle="modal" data-target="#videoModal" data-src="UiZsZxXKpSQ">2013 Intrepid Outdoors Funky Chicken and Thunder Series 90 Sec Promo</a>
   </div>
   <div class="col-sm-3 media-item" data-toggle="modal" data-target="#videoModal" data-src="FCO9GR-WUSg">
      <img src="http://img.youtube.com/vi/FCO9GR-WUSg/0.jpg" class="adpt" style="max-width:480px;" alt="2013 Antler Insanity Thunder Series Run and Gun and Gun Slater Calls Miniskit">
      <a href="#" class="media-label" data-toggle="modal" data-target="#videoModal" data-src="FCO9GR-WUSg">2013 Antler Insanity Thunder Series Run and Gun and Gun Slater Calls Miniskit</a>
   </div>
   <div class="col-sm-3 media-item" data-toggle="modal" data-target="#videoModal" data-src="7ueNqqBWeWk">
      <img src="http://img.youtube.com/vi/7ueNqqBWeWk/0.jpg" class="adpt" style="max-width:480px;" alt="2013 Antler Insanity Thunder Series and Run n Gun 90 sec Spot">
      <a href="#" class="media-label" data-toggle="modal" data-target="#videoModal" data-src="7ueNqqBWeWk">2013 Antler Insanity Thunder Series and Run n Gun 90 sec Spot</a>
   </div>
   <div class="col-sm-3 media-item" data-toggle="modal" data-target="#videoModal" data-src="VlmPPKfr1gA">
      <img src="http://img.youtube.com/vi/VlmPPKfr1gA/0.jpg" class="adpt" style="max-width:480px;" alt="Flextone Presents: Turkeys Charge The Thunder Chicken">
      <a href="#" class="media-label" data-toggle="modal" data-target="#videoModal" data-src="VlmPPKfr1gA">Flextone Presents: Turkeys Charge The Thunder Chicken</a>
   </div>
   <div class="col-sm-3 media-item" data-toggle="modal" data-target="#videoModal" data-src="FI9ZXaHPsao">
      <img src="http://img.youtube.com/vi/FI9ZXaHPsao/0.jpg" class="adpt" style="max-width:480px;" alt="Flextone Thunder Series Promo">
      <a href="#" class="media-label" data-toggle="modal" data-target="#videoModal" data-src="FI9ZXaHPsao">Flextone Thunder Series Promo</a>
   </div>
   <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="video-wrap">
               <iframe id="video-player" width="560" height="315" src="/blank.html" frameborder="0" allowfullscreen ></iframe>
               <div class="align-c"><i class="fa fa-spinner fa-pulse"></i></div>
            </div>
         </div>
         /.modal-content
      </div>
      /.modal-dialog
   </div>
   /.modal                    
</div> -->
               <script type="text/javascript">
                  jQuery('.media-item').click(function() {
                      ga('send', 'event', 'Media Center', 'play', 'https://www.youtube.com/watch?v=' + jQuery(this).attr('data-src'));
                  });
               </script>
            </div>
         </div>
      </div>
<?php get_footer(); ?>