<?php
get_header();
/* Template Name: Página Misión Visión */
global $post; 

$permisos_contenido = get_field('permisos_contenido'); 

if( permissions_content($permisos_contenido) == 'true' ): ?>

    <?php $secciones = get_field('secciones'); ?>
    <div class="capacitacion__page--vision-mision">
        <div class="container">
            <?php $x=0; foreach( $secciones as $row ): $x++;?>
            <div class="row mision-vision__flex-row <?php if($x%2==0): ?>reverse<?php endif; ?>">
                <div class="col-md-6">
                    <h2 class="mision-vision__title"><?php echo $row['titulo_seccion']; ?></h2>
                </div>
                <div class="col-md-6">
                    <p class="mision-vision__paragraph"><?php echo $row['contenido']; ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

<?php else:

    require get_template_directory() . '/inc/content-not-permissions.php';

endif;?>

<?php get_footer(); ?>