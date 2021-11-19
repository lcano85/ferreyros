</main>    
    <footer class="ferreyros__footer"> 
        <?php if ( is_front_page() ) : ?>
        <div class="container">
            <div class="footer__navigation">
                <?php
                    $args = array(
                        'theme_location' => 'menu-footer',
                        'container' => 'nav',
                        'container_class' => 'menu-footer',
                    );
                    wp_nav_menu($args);
                ?>
            </div>
            <?php $option_contacto = get_field('contacto', 'option'); ?>
            <?php if($option_contacto): ?>
            <div class="footer__adsense">
                <a class="permalink" href="<?php echo $option_contacto['enlace_contacto']; ?>"> 
                    <picture> 
                        <source srcset="<?php echo $option_contacto['imagen_contacto']['url']; ?>" media="(min-width: 992px)" alt="<?php echo $option_contacto['imagen_contacto']['alt']; ?>">
                        <img class="picture" src="<?php echo $option_contacto['imagen_contacto_mobile']['url']; ?>" alt="<?php echo $option_contacto['imagen_contacto']['alt']; ?>">
                    </picture>
                </a>
            </div>
            <?php endif; ?>
            <?php $option_social = get_field('redes_sociales', 'option'); ?>
            <?php if($option_social): ?>
            <div class="footer__social">
                <span class="text">Visita nuestras redes sociales<br>externas:</span>
                <ul class="social__list">
                    <?php foreach( $option_social as $row ): ?>
                    <li class="social__item">
                        <a class="permalink" href="<?php echo $row['enlace']; ?>">
                            <span class="icon">
                                <img src="<?php echo $row['icono']['url']; ?>" alt="<?php echo $row['nombre']; ?>">
                            </span>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>  
        <div class="footer__copy">
            <span class="text">© <?php echo date("Y"); ?> <b>Ferreyros. </b>All Rights Reserved.</span>
        </div>
    </footer>
        <?php wp_footer(); ?>
    </body>
</html>