<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head(); ?>
</head>

<header class="ferreyros__header">
    <div class="container">
        <div class="ferreyros__hamburger">
            <ul class="hamburger__list">
                <li class="hamburger__item"></li>
                <li class="hamburger__item"></li>
                <li class="hamburger__item"></li>
                <li class="hamburger__item"></li>
            </ul>
        </div>
        <div class="ferreyros__brand"><a class="brand" href="http://" title="Mundo ferreyros"><img src="<?php bloginfo( 'template_url' ); ?>/assets/images/pngs/logo-fred.png" alt="Mundo ferreyros"></a></div>
        <?php
            $args = array(
                'theme_location' => 'menu-principal',
                'container' => 'nav',
                'container_class' => 'menu-principal',
            );
            wp_nav_menu($args);
            get_search_form();
        ?>
        <div class="ferreyros__access">
            <a class="button" href="http://">
                <span class="icon icon-key">
                    <svg>
                        <use xlink:href="<?php bloginfo( 'template_url' ); ?>/assets/images/icons/icons.svg#fi-rr-key-1"></use>
                    </svg>
                </span>
                Mis accesos                                                                                                      
            </a>
        </div>
    </div>
</header>
<body <?php body_class(); ?>>
