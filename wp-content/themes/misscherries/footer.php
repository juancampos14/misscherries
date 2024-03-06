
        <div id="wp-scripts">
            <?php wp_footer(); ?>
        </div>
        <footer>
            <section class="first-div-footer">
                <div class="container">
                    <?php text_email(); ?>
                    <div class="div-border-footer">
                        <input class="input-email" type="text" id="email" placeholder="Introduce tu email">
                        <div id="error-message" class="error-message"></div> <!--Aqui aparecera el texto cuando el email sea incorrecto-->
                        <button id="buttom-email" class="buttom-text-white" >ME APUNTO</button>
                    </div>
                    <div class="modal fade" id="myModal" aria-labelledby="exampleModalLabel" aria-hidden="true"> <!--Div que contiene al modal que usamos cuando el email es valido -->
                        <div class="modal-dialog modal-sm modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">EMAIL CORRECTO</h4>
                            </div>
                            <div class="modal-body">
                              <p>Gracias por suscribirte</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">ACEPTAR</button>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="footer-grey-info">
                <?php first_div_container(); ?>
            </section>
            <section class="div-img">
                <div class="container">
                    <img src="http://misscherries.loc/wp-content/uploads/2024/03/Layer-54-scaled.jpg" class="img-layer" alt="img_layer" >
                    <div>
                        <h3>SIGUENOS</h3>
                        <div class="row" >
                            <div class="col-5 col-sm-5 col-md-5 col-lg-5 col-xl-5 div-ig-icon">
                                <img src="http://misscherries.loc/wp-content/uploads/2024/02/Objeto-inteligente-vectorial.jpg" class="img-ig-icon" alt="img_ig-icon" >
                            </div>
                            <div class="col-5 col-sm-7 col-md-7 col-lg-7 col-xl-7 div-text-ig" >
                                <h2>@#MISSCHERRIES</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="div-menu-footer">
                <div class="container">
                    <?php wp_nav_menu( array( 'theme_location' => 'menu-footer' ) ); ?>
                </div>
            </section>
            <section class="footer-grey div-img div-img-red ">
                <div class="container">
                    <a href="https://www.instagram.com" target="_blank" title="Instagram">
                        <i class="fab fa-instagram ig-rrss"></i>
                    </a>
                    <a href="https://www.facebook.com" target="_blank" title="Facebook">
                        <i class="fab fa-facebook ig-rrss"></i>
                    </a>
                    <a href="https://www.pinterest.com" target="_blank" title="Pinterest">
                        <i class="fab fa-pinterest ig-rrss"></i>
                    </a>
                </div>
            </section>
        </footer>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    </body>
</html>
