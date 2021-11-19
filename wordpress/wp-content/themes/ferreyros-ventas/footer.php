        <footer class="ferreyros__footer--ventas">
            <div class="container">
                <?php $option_workplace = get_field('workplace', 'option'); ?>
                <?php $option_workplace_enlace = get_field('enlace_workplace', 'option'); ?>                
                <?php if($option_workplace): ?>
                <div class="footer__adsense"> 
                    <?php if($option_workplace_enlace): ?>
                        <a class="permalink" href="<?php echo $option_workplace_enlace ?>" target="_BLANK"> 
                            <img class="picture" src="<?php echo $option_workplace['url'] ?>" alt="<?php echo $option_workplace['alt'] ?>">
                        </a>
                    <?php else : ?>
                        <img class="picture" src="<?php echo $option_workplace['url'] ?>" alt="<?php echo $option_workplace['alt'] ?>">   
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                <?php $option_social = get_field('redes_sociales', 'option'); ?>                
                <div class="footer__social"> 
                    <?php if($option_social): ?>
                        <span class="text">Para conocer más sobre nosotros, visitanos en:</span>
                        <ul class="social__list"> 
                            <?php foreach( $option_social as $row ): ?>
                            <li class="social__item">
                                <a class="permalink" href="<?php echo $row['enlace']; ?>"> 
                                    <img src="<?php echo $row['icono']['url']; ?>" alt="<?php echo $row['nombre']; ?>">
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <div class="copyright"><span class="text">© <?php echo date("Y"); ?> <b>Ferreyros. </b>All Rights Reserved.    </span></div>
                </div>            
            </div>
        </footer>
<?php wp_footer(); ?>
    </body>
</html>