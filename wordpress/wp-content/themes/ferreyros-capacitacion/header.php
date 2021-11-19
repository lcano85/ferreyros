<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php wp_title(''); echo ' | ';  bloginfo( 'name' ); ?></title>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head(); ?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo GA_ID_CAPA; ?>"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', '<?php echo GA_ID_CAPA; ?>');
	</script>
</head>

<body <?php body_class(); ?> id="capacitacion">

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
            <?php $option_logo = get_field('logo_empresa', 'option'); ?>
            <div class="ferreyros__brand">
                <?php if($option_logo): ?>
                <a class="brand" href="<?php echo get_home_url(); ?>" title="<?php echo $option_logo['alt']; ?>">
                    <img src="<?php echo $option_logo['url']; ?>" alt="<?php echo $option_logo['alt']; ?>">
                </a>
                <?php endif; ?>
            </div>
            <?php
                $args = array(
                    'theme_location' => 'menu-principal',
                    'container' => 'nav',
                    'container_class' => 'menu-principal',
                );
                wp_nav_menu($args);
                get_search_form();
            ?>
        </div>
    </header>