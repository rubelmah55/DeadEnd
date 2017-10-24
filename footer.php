 <div class="section-newsletter" style="background-image: url(<?php the_field( 'newslatter_background_img', 'options') ?>)">
         <div class="container">
            <div class="block block-subscribe" style="overflow:hidden;">
               <div class="col-md-9 col-md-offset-1">
                  <span class="join-newsletter"><?php the_field( 'newslatter_title', 'options' )?></span>
               </div>
               <form action="http://www.flextonegamecalls.com/newsletter/subscriber/new/" method="post" id="newsletter-validate-detail" _lpchecked="1">
                  <div class="col-md-7 col-md-offset-1">
                     <div class="bn-nl-input input-box inlined">
                        <input placeholder="Email" type="text" name="email" id="newsletter" title="Sign up for our newsletter" class="input-text required-entry validate-email">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <button type="submit" class="subscribe-button" title="Subscribe"><span><span><?php the_field( 'newslatter_button', 'options' )?></span></span></button>
                  </div>
               </form>
               <script type="text/javascript">
                  //<![CDATA[
                      var newsletterSubscriberFormDetail = new VarienForm('newsletter-validate-detail');
                  //]]>
                      // Gets a reference to the form element, assuming
                  // it contains the id attribute "signup-form".
                  var form = document.getElementById('newsletter-validate-detail');
                  
                  // Adds a listener for the "submit" event.
                  form.addEventListener('submit', function(event) {
                  
                      // Prevents the browser from submiting the form
                      // and thus unloading the current page.
                      event.preventDefault();
                  
                      // Creates a timeout to call `submitForm` after one second.
                      setTimeout(submitForm, 1000);
                  
                      // Keeps track of whether or not the form has been submitted.
                      // This prevents the form from being submitted twice in cases
                      // where `hitCallback` fires normally.
                      var formSubmitted = false;
                  
                      function submitForm() {
                          if (!formSubmitted) {
                              formSubmitted = true;
                              form.submit();
                          }
                      }
                  
                      // Sends the event to Google Analytics and
                      // resubmits the form once the hit is done.
                      ga('send', 'event', 'Newsletter Subscription', 'submit', {
                          hitCallback: submitForm
                      });
                  });
               </script>
            </div>
         </div>
      </div>
      <footer role="contentinfo">
         <div class="footer-slide" style="margin-bottom: -350px;">
            <div class="bn-ankle">
               <div class="container">
                  <div class="row eq-md-height">
                     <div class="col-md-4 a-left quick-links">
                       <?php $footer_left = get_field('footer_left', 'options'); if ($footer_left): foreach ($footer_left as $menu) : ; ?>
                          <div>
                            <a class="legal" href="<?php echo $menu['footer_menu']['url']; ?>"><?php echo $menu['footer_menu']['title']; ?></a>
                          </div>

                          <?php endforeach; endif; ?>
                        
                        <div class="gap-v-10"></div>
                     </div>
                     <div class="col-md-4">
                        <a href="<?php get_home_url(); ?>" target="_blank"><img src="<?php echo get_template_directory_uri();?>/img/logo-parent.png" alt="Plano Synergy"></a>
                        <div class="gap-v-10"></div>
                     </div>
                     <div class="col-md-4 bn-ft-info-block">
                        <div><?php the_field('follow_us', 'options'); ?></div>
                        <div class="gap-v-10"></div>
                        <div class="bn-social">
                        <?php $social_media = get_field('social_media', 'options'); if ($social_media): foreach ($social_media as $social) : ; ?>

                          <li><a class="" href="<?php echo $social['url'] ?>" target="_blank"><i class="fa <?php echo $social['icon']; ?> fa-lg"></i></a></li>

                          <?php endforeach; endif; ?>
                           
                        </div>
                        <div class="gap-v-10"></div>
                        <div class="legal"><a href="/privacy-policy-cookie-restriction-mode">PRIVACY POLICY</a></div>
                        <address class="legal">&copy; <?php the_field( 'copyright', 'options')?></address>
                     </div>
                  </div>
               </div>
            </div>

              <div class="toe">
                 <div class="container">
                    <div class="row">
                       <div class="justify">
                        <?php $brands = get_field('brands', 'options'); if ($brands): foreach ($brands as $brand) : ?>
                          <div class="col-md-3 col-sm-4 col-xs-6">
                             <a target="_blank" href="<?php echo $brand['url'] ?>"><img src="<?php echo $brand['logo']['url']; ?>" alt="<?php echo $brand['logo']['alt']; ?>" class="img-loaded img-resposive"></a>
                          </div>
                          <?php endforeach; endif; ?>
                       </div>
                    </div>
                 </div>
              </div>
         </div>
      </footer>
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <![endif]-->    
   </div>
   <?php wp_footer(); ?>
</body>
</html>