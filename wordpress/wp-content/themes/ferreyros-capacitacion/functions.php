<?php

//Llamar archivos del tema padre
function enqueue_styles_child_theme() {

	$parent_style = 'parent-style';
	$child_style  = 'child-style';

	wp_enqueue_style( $parent_style,
				get_template_directory_uri() . '/assets/css/main.css' );

	wp_enqueue_style( $child_style,
				get_stylesheet_directory_uri() . '/assets/css/main.css',
				array( $parent_style ),
				wp_get_theme()->get('Version')
				);
}
add_action( 'wp_enqueue_scripts', 'enqueue_styles_child_theme' );

// function my_scripts_method() {
// 	wp_enqueue_script('fredJs',get_stylesheet_directory_uri() . '/assets/js/main.js',array( 'jquery', 'function' ), '1.0.0', true);
// }
// add_action( 'wp_enqueue_scripts', 'my_scripts_method' );

//Archivos css para modificar login
function login_style_fred() {        
        wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/assets/css/login.css' );
    }
add_action('login_enqueue_scripts', 'login_style_fred');

// anular el filtro de los roles de administrador y editor para permitirles incluir etiquetas HTML en el contenido al activar el tema
add_action( 'init', 'basurama_kses_init', 11 );
add_action( 'set_current_user', 'basurama_kses_init', 11 );
add_action( 'after_switch_theme', 'basurama_unfilter_roles', 10 );
        
// Vuelva a filtrar los roles de administrador y editor al desactivar el tema
add_action( 'switch_theme', 'basurama_refilter_roles', 10 );
 
// Eliminar filtros KSES para administradoras y editoras
function basurama_kses_init() {
        if ( current_user_can( 'edit_others_posts' ) )
                kses_remove_filters();
}       
// agregar capacidad unfiltered_html para administradores y editores
function basurama_unfilter_roles() {
        // Se asegura de que $wp_roles esté inicializado
        get_role( 'administrator' );
        
        global $wp_roles;
        // No utilice el contenedor get_role(), no funciona como único.
        // (get_role no regresa correctamente como referencia)
        $wp_roles->role_objects['administrator']->add_cap( 'unfiltered_html' );
        $wp_roles->role_objects['editor']->add_cap( 'unfiltered_html' );
}
// eliminar la capacidad unfiltered_html para administradores y editores
function basurama_refilter_roles() {
        get_role( 'administrator' );
        global $wp_roles;
        // Podría usar el contenedor get_role() aquí ya que esta función nunca es
        // llamado como único. Siempre está llamado a alterar el rol como
        // almacenado en la base de datos.
        $wp_roles->role_objects['administrator']->remove_cap( 'unfiltered_html' );
        $wp_roles->role_objects['editor']->remove_cap( 'unfiltered_html' );
}

// priorizar la paginación sobre la visualización del contenido del tipo de post personalizado
add_action('init', function() {
    add_rewrite_rule('(.?.+?)/page/?([0-9]{1,})/?$', 'index.php?pagename=$matches[1]&paged=$matches[2]', 'top');
});

// Evitar colisiones categoría - post slug
// Restringir los slugs seleccionados para los posts
add_filter( 'wp_unique_post_slug', function( $slug, $post_ID, $post_status, $post_type ) {
    if ( 'post' == $post_type ) {
      $categories = get_categories();
      $categories = array_map(function($c) { return $c->slug; }, $categories);
  
      if ( in_array($slug, $categories) ) {
        return $slug . '-' . $post_ID;
      }
    }
    return $slug;
  }, 10, 4 );

//* Añadir un mensaje personalizado a la página de inicio de sesión de WordPress
function smallenvelop_login_message( $message ) {
        if ( empty($message) ){
            return '<h2 class="title">¡Bienvenido a Ferreyros Capacitación!</h2><p class="text">Accede a tu nueva intranet
            </p>';
        } else {
            return $message;
        }
    }    
add_filter( 'login_message', 'smallenvelop_login_message' );

// elige un hook del archivo wp-login.php que mejor se adapte a nuestras necesidades. Yo elegí el filtro: wp_login_errors
add_filter( 'wp_login_errors', 'my_login_form_lock_down', 90, 2 );
/**
 * Bloquear completamente el formulario de inicio de sesión de WordPress secuestrando la página 
 * y sólo ejecutando el encabezado de inicio de sesión, el pie de página y las 
 * etiquetas de cierre.
 * 
 * Proporcionar una forma secreta de mostrar el formulario de inicio de sesión como una variable url en 
 * caso de emergencias.
 */
function my_login_form_lock_down( $errors, $redirect_to ){
  // acceder al formulario de inicio de sesión así:  http://example.com/wp-login.php?superadminform=true
  $secret_key = "superadminform";
  $secret_password = "true";
  
  if ( !isset( $_GET[ $secret_key ] ) || $_GET[ $secret_key ] != $secret_password ) {
    login_header(__('Log In'), '', $errors);
    echo "</div>";
    do_action( 'login_footer' );
    echo "</body></html>";
    exit;
  }  
  return $errors;
}