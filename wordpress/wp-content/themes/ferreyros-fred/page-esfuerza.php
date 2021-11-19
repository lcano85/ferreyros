<?php

/* Template Name: Página Esfuerza */

get_header();

global $post; 

$permisos_contenido = get_field('permisos_contenido'); 

if( permissions_content($permisos_contenido) == 'true' ): ?>

    <?php $hero = get_field('banner'); ?>
    <section class="ferreyros__banner--internal">
        <div class="container-fluid g-0">
            <div class="banner__picture">
                <?php if( !empty( $hero['imagen'] )){ ?>
                    <img class="picture" src="<?php echo esc_url( $hero['imagen']['url'] ); ?>" alt="<?php echo esc_attr( $hero['imagen']['alt'] ); ?>">
                <?php }else{ ?>
                    <img class="picture" src="<?php bloginfo( 'template_url' ); ?>/assets/images/jpgs/banner-2.jpg" alt="">
                <?php } ?>
            </div>
            <div class="banner__content">
                <?php if ( $post->post_parent ) { ?>
                    <div class="back-to-page">
                        <a class="permalink" href="<?php echo get_permalink( $post->post_parent ); ?>"> 
                            <span class="icon">
                                <svg>
                                    <use xlink:href="<?php bloginfo( 'template_url' ); ?>/assets/images/icons/icons.svg#fi-rr-arrow-left"></use>
                                </svg>
                            </span>
                            Volver
                        </a>
                    </div>
                <?php } ?>
                <?php  if( $hero['tipo_contenido'] == 'textos' ) { ?>
                    <div class="content">
                        <?php if($hero['titulo']){ ?>
                            <h1 class="title"><?php echo esc_html( $hero['titulo'] ); ?></h1>
                        <?php } ?>
                        <?php if($hero['contenido']){ ?>
                            <p class="text"><?php echo esc_html( $hero['contenido'] ); ?></p>
                        <?php } ?>
                    </div>
                <?php } elseif( $hero['tipo_contenido'] == 'icono' ){ ?>
                    <div class="content">
                        <?php if( !empty( $hero['icono'] )){ ?>
                            <img class="picture" src="<?php echo esc_url( $hero['icono']['url'] ); ?>" alt="<?php echo esc_attr( $hero['icono']['alt'] ); ?>">
                        <?php } ?>
                    </div>
                <?php } ?>
                
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <?php if(function_exists('bcn_display'))
                            {
                                bcn_display();
                            }
                        ?>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <?php $section_principal = get_field('seccion_principal'); 
    if($section_principal): ?>
        <section class="ferreyros__page--content fred__page--esfuerza-principal">
            <div class="container">
                <div class="row esfuerza-principal__list"> 
                    <?php foreach( $section_principal as $row ):?>
                    <div class="col-md-6 esfuerza-principal__item">
                        <div class="item">
                            <?php if($row['contenido']['titulo']): ?>
                                <h2 class="title"> <span><?php echo $row['contenido']['titulo']; ?></span></h2>
                            <?php endif; ?>
                            <?php if($row['contenido']['texto']): 
                                echo $row['contenido']['texto'];
                            endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <div class="col-md-6 esfuerza-principal__item">
                        <?php 
                            $rows = get_field('accesos_directos'); 
                            if( $rows ) :
                        ?>
                        <div class="list">
                            <?php foreach( $rows as $row ): ?>
                            <div class="item py-2">
                                <div class="ferreyros__card --mod6" style="background:<?php echo $row['color_boton']; ?>;border-color:<?php echo $row['color_boton']; ?>;">
                                    <div class="card__image">
                                        <?php if( !empty( $row['icono'] )): ?>
                                            <img class="image" src="<?php echo $row['icono']['url']; ?>" alt="<?php echo $row['icono']['alt']; ?>">
                                        <?php endif;?>
                                    </div>
                                    <div class="card__content">
                                        <h3 class="title"> 
                                            <a class="permalink" href="<?php echo $row['enlace']; ?>" target="_blank"><?php echo $row['nombre']; ?></a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php $seccion_categorias = get_field('seccion_categorias'); 
    if($seccion_categorias): ?>
        <section class="ferreyros__page--content fred__page--esfuerza-categorias">
            <div class="container g-0">
                <div class="esfuerza-categorias__header">
                    <h2 class="title"><?php echo $seccion_categorias['titulo'] ?></h2>
                </div>
                <div class="esfuerza-categorias__content">
                    <?php $cat_tabs = $seccion_categorias['categorias']; ?>
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <?php $x = 0; foreach( $cat_tabs as $tab ): $x++; ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php if($x == 1): ?>active<?php endif; ?>" id="pills-<?php echo $x; ?>-tab" data-bs-toggle="pill" data-bs-target="#pills-<?php echo $x; ?>" type="button" role="tab" aria-controls="pills-<?php echo $x; ?>" aria-selected="true">
                                <?php echo $tab['titulo_tab'] ?>
                                <span style="background:<?php echo $tab['color'] ?>;"></span>
                            </button>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php $cat_content = $seccion_categorias['categorias']; ?>
                    <div class="tab-content" id="pills-tabContent">
                        <?php $n = 0; foreach( $cat_content as $content ): $n++; ?>
                        <div class="tab-pane fade show <?php if($n == 1): ?>active<?php endif; ?>" id="pills-<?php echo $n; ?>" role="tabpanel" aria-labelledby="pills-<?php echo $n; ?>-tab">
                            <div class="tab-content__head">
                                <div class="title-image">
                                    <?php $imagen = $content['titulo_imagen'] ?>
                                    <img src="<?php echo $imagen['url'] ?>" alt="<?php echo $imagen['alt'] ?>">
                                </div>
                                <p class="text"><?php echo $content['texto']; ?></p>
                            </div>
                            <div class="tab-content__information">
                                <?php echo $content['contenido_categorias']; ?>
                            </div>
                            <div class="tab-footer">
                                <?php                        
                                    $link = $content['enlace'];
                                    if( $link ): 
                                        $link_url = $link['url'];
                                        $link_title = $link['title'];
                                        $link_target = $link['target'] ? $link['target'] : '_self';                        
                                ?>
                                <a class="permalink" href="<?php echo $link_url; ?>" target="<?php echo $link_target; ?>" style="background:<?php echo $content['color'] ?>;<?php if($n == 1): ?>color: #494949;<?php endif; ?>">
                                    <?php echo $link_title; ?>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php $seccion_reconocimiento = get_field('seccion_reconocimiento'); 
    if($seccion_reconocimiento): ?>
        <section class="ferreyros__page--content fred__page--esfuerza-reconocimiento">
            <div class="container-fluid g-0">
                <?php if($seccion_reconocimiento['titulo_seccion']): ?>
                <div class="esfuerza-reconocimiento__head"> 
                    <h2 class="title"><?php echo $seccion_reconocimiento['titulo_seccion']; ?></h2>
                </div>
                <?php endif; ?>
                <?php if($seccion_reconocimiento['contenido']): ?>
                <div class="esfuerza-reconocimiento__content text-center">
                    <?php echo $seccion_reconocimiento['contenido']; ?>
                </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    <?php $seccion_contacto = get_field('seccion_contacto'); 
    if($seccion_contacto): ?>
        <section class="ferreyros__page--content fred__page--esfuerza-contactos">
            <div class="container">
                <?php if($seccion_contacto['titulo_seccion']): ?>
                <div class="esfuerza-contactos__head">
                    <h2 class="title"><?php echo $seccion_contacto['titulo_seccion']; ?></h2>
                </div>
                <?php endif; ?>
                <?php if($seccion_contacto['lista_contactos']): ?>
                <div class="esfuerza-contactos__content">
                    <div class="row esfuerza-contactos__list">
                        <?php $rows = $seccion_contacto['lista_contactos'];
                            foreach( $rows as $row):
                        ?>
                        <div class="col-md-6 py-2 esfuerza-contactos__item"> 
                            <div class="ferreyros__card --mod4">
                                <div class="card__image">
                                    <img class="image" src="<?php echo $row['imagen']['url']; ?>" alt="<?php echo $row['imagen']['alt']; ?>">
                                </div>
                                <div class="card__content">
                                    <?php echo $row['contenido']; ?>      
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    <?php $seccion_preguntas = get_field('seccion_preguntas'); 
        if($seccion_preguntas): ?>
        <section class="ferreyros__page--content fred__page--esfuerza-preguntas">
            <div class="container"> 
                <div class="esfuerza-preguntas__head">
                    <h2 class="title"><?php echo $seccion_preguntas['titulo_seccion']; ?></h2>
                </div>
                <div class="esfuerza-preguntas__content"> 
                    <h3 class="title"><?php echo $seccion_preguntas['titulo_preguntas_1']; ?></h3>
                    <div class="accordion" id="accordionPreguntas_1">
                        <?php $rows = $seccion_preguntas['preguntas_1']; 
                        $x=0; foreach( $rows as $row): $x++;
                        ?>
                        <div class="accordion-item">
                            <h4 class="accordion-header" id="heading_<?php echo $x; ?>">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_<?php echo $x; ?>" aria-expanded="false" aria-controls="collapse_<?php echo $x; ?>"><?php echo $row['titulo']; ?></button>
                            </h4>
                            <div class="accordion-collapse collapse" id="collapse_<?php echo $x; ?>" aria-labelledby="heading_<?php echo $x; ?>" data-bs-parent="#accordionPreguntas_1">
                                <div class="accordion-body">
                                    <?php echo $row['texto']; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="esfuerza-preguntas__content"> 
                    <h3 class="title"><?php echo $seccion_preguntas['titulo_preguntas_2']; ?></h3>
                    <div class="accordion" id="accordionPreguntas_2">
                        <?php $rows = $seccion_preguntas['preguntas_2']; 
                        $n=0; foreach( $rows as $row): $n++;
                        ?>
                        <div class="accordion-item">
                            <h4 class="accordion-header" id="heading_n<?php echo $n; ?>">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_n<?php echo $n; ?>" aria-expanded="false" aria-controls="collapse_n<?php echo $n; ?>"><?php echo $row['titulo']; ?></button>
                            </h4>
                            <div class="accordion-collapse collapse" id="collapse_n<?php echo $n; ?>" aria-labelledby="heading_n<?php echo $n; ?>" data-bs-parent="#accordionPreguntas_2">
                                <div class="accordion-body"><?php echo $row['texto']; ?></div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

<?php else: 

    require get_template_directory() . '/inc/content-not-permissions.php';

endif;?>

<?php get_footer(); ?>