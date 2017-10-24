<?php
/*
Template Name: Dealers
*/
?>

<?php get_header() ?>
      <div class="container sheet">
         <div class="layout layout-1-col">
            <div role="main">
               <div class="page-title" style="margin-top: 70px; margin-bottom: 0 !important;">
                  <h1><?php the_field('page_title'); ?></h1>
               </div>
               <div class="std">
                  <span style="font-size: 28px;letter-spacing: -1px;line-height: 48px !important;"><strong><span style="color: #eccb72;"><?php the_field('sub_title_text');?></span></strong></span>
                  <p>&nbsp;</p>
                  <h2><?php the_field('find_dealer');?><a href="<?php the_field('find_dealer_url');?>"><?php the_field('find_dealer_url_text');?></a></h2>
                  <dl>
                     <dt id="pagetop"></dt>
                     <dd></dd>
                     <dt></dt>
                  </dl>
                  <p><br /><br /></p>
                  <p>&nbsp;</p>
                    
                <div class="row" style="margin-bottom: 70px;">
                    <?php
                   $args = array(
                        'post_type'         => 'dealer',
                        'posts_per_page'    => -1,
                        'order'             => 'ASC'
                   );
                    $query = new WP_Query( $args );  
                    ?>
                    <?php while ( $query->have_posts() ) : $query->the_post(); 
                    $title_id = strtolower(get_the_title());
                    ?>   

                    <div class="col-md-3"><a href="#<?php echo $title_id; ?>"><?php the_title(); ?></a></div>

                    <?php 
                        endwhile; 
                        wp_reset_postdata(); 
                    ?>
                    </div>

                    <?php
                    $args = array(
                        'post_type'         => 'dealer',
                        'posts_per_page'    => -1,
                        'order'             => 'ASC'
                    );
                    $query = new WP_Query( $args );  
                    ?>
                    <?php while ( $query->have_posts() ) : $query->the_post(); 
                    $title_id = strtolower(get_the_title());

                    $address = get_field('address'); 

                    ?>   


                  <dl>
                     <dt id="<?php echo $title_id; ?>"></dt>
                     <dd>
                        <h1><?php the_title(); ?></h1>
                     </dd>
                     <dt></dt>
                  </dl>
                  <p><a href="#pagetop">Back to top</a></p>
                <?php
                foreach($address as $data) :
                ?>

                <p><?php echo $data['address']; ?><br /> <?php echo $data['road']; ?><br /> <strong><?php echo $data['state']; ?></strong> <?php echo $data['zip']; ?><br /> <?php echo $data['phone']; ?></p>
                <p>&nbsp;</p>

                <?php endforeach; ?>
                <?php 
                    endwhile; 
                    wp_reset_postdata(); 
                ?>


               </div>
            </div>
         </div>
      </div>
    <?php get_footer(); ?>