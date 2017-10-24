<?php
/*
Template Name: Contact
*/
?>
<?php get_header() ?>
    
    <div class="page-wrapper" style="background: url(<?php echo get_template_directory_uri();?>/img/body-bg-top.jpg);background-color: #fcfbf9;
    background-repeat: repeat-x;
    background-position: center 0px;
    padding: 70px 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php while(have_posts()) : the_post(); ?>
                    <div class="content-wrapper contact-bg">
                        <?php the_content(); ?>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>