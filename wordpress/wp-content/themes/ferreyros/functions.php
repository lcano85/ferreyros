<?php

//Cuando el tema esta activo
function ferreyros_setup() {
	//Habilitar imagenes destacadas
	add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'ferreyros_setup');

//Menu de navegacion
function ferreyros_menus() {
    register_nav_menus(array(
        'menu-principal' => __( 'Menu Principal', 'ferreyros' ),
        'menu-footer' => __( 'Menu Footer', 'ferreyros' ),
		'menu-accesos' => __( 'Menu mis Accesos', 'ferreyros' )
    ));
}
add_action('init', 'ferreyros_menus');


//Archivos js y css
function ferreyros_scripts_styles(){

	//Estilos
    wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.0');

	//Functions
	wp_enqueue_script('function', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);

}
add_action('wp_enqueue_scripts','ferreyros_scripts_styles');

//Archivos css para modificar admin
function admin_style() {
    wp_enqueue_style('admin-styles', get_stylesheet_directory_uri().'/assets/css/admin.css');
}
add_action('admin_enqueue_scripts', 'admin_style');

/* Desactivar wptexturize */
add_filter( 'run_wptexturize', '__return_false' );

//Funcion para la pagina archivos, taxonomias(categorias, etiquetas, autor, etc)
function ferreyros_cptui_add_post_types_to_archives( $query ) {	
	if ( is_admin() || ! $query->is_main_query() ) {
		return;    
	}
	if ( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
		$cptui_post_types = cptui_get_post_type_slugs();
		$query->set(
			'post_type',
			array_merge(
                array( 'post' ),
				$cptui_post_types
            )
        );
        $query->set( 'orderby', 'date' );
		$query->set( 'order', 'DESC' );
		$query->set( 'posts_per_page', '12' );
	}
}
add_filter( 'pre_get_posts', 'ferreyros_cptui_add_post_types_to_archives' );

//Personalizar paginacion
function ferreyros_wp_custom_pagination( \WP_Query $wp_query = null, $echo = true, $params = [] ) {
    if ( null === $wp_query ) {
        global $wp_query;
    }
    $add_args = [];
    $pages = paginate_links( array_merge( [
            'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
            'format'       => '?paged=%#%',
            'current'      => max( 1, get_query_var( 'paged' ) ),
            'total'        => $wp_query->max_num_pages,
            'type'         => 'array',
            'show_all'     => false,
            'end_size'     => 3,
            'mid_size'     => 1,
            'prev_next'    => true,
            'prev_text'    => __( '« Prev' ),
            'next_text'    => __( 'Next »' ),
            'add_args'     => $add_args,
            'add_fragment' => ''
        ], $params )
    );
    if ( is_array( $pages ) ) {
        $pagination = '<div class="pagination justify-content-center mt-5"><ul class="pagination m-0">';
        foreach ( $pages as $page ) {
            $pagination .= '<li class="page-item' . (strpos($page, 'current') !== false ? ' active' : '') . '"> ' . str_replace('page-numbers', 'page-link', $page) . '</li>';
        }
        $pagination .= '</ul></div>';
        if ( $echo ) {
            echo $pagination;
        } else {
            return $pagination;
        }
    }
    return null;
}

//Limitar con la funcion get_the_excerpt
function excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...(leer más)';
    } else {
    $excerpt = implode(" ",$excerpt);
    }
    $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
    return $excerpt;
}

//Limitar con la funcion get_the_content
  function content($limit) {
    $content = explode(' ', get_the_content(), $limit);
    if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...(leer más)';
    } else {
    $content = implode(" ",$content);
    }
    $content = preg_replace('/[.+]/','', $content);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]>', $content);
    return $content;
}

// Definir zona de widgets
function ferreyros_widgets(){
    register_sidebar(array(
        'name' => 'Sidebar 1',
        'id' => 'sidebar_1',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="text-center texto-primario">',
        'after_title' => '</h3>'
    ));
    register_sidebar(array(
        'name' => 'Sidebar 2',
        'id' => 'sidebar_2',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="text-center texto-primario">',
        'after_title' => '</h3>'
    ));
    register_sidebar(array(
        'name' => 'Sidebar 3',
        'id' => 'sidebar_3',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="text-center texto-primario">',
        'after_title' => '</h3>'
    ));
    register_sidebar(array(
        'name' => 'Sidebar 4',
        'id' => 'sidebar_4',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="text-center texto-primario">',
        'after_title' => '</h3>'
    ));
}
add_action('widgets_init', 'ferreyros_widgets');


/*Rellenar acf select cuyo nombre es "seleccionar_roles" con los roles de los usuarios en ADMIN BACKEND*/
if ( !function_exists('populateUserRolesInAcfSelect') ):
 
    add_filter('acf/load_field/name=seleccionar_roles', 'populateUserRolesInAcfSelect');
    function populateUserRolesInAcfSelect( $field ){
 
        // reset choices
        $field['choices'] = array();
		$default['default_value'] = '';
         
        global $wp_roles;
        $roles = $wp_roles->get_names();
         
        foreach ($roles as $key => $role) :
            $field['choices'][ $key ] = $role;
        endforeach;

        return $field;
    }
 
endif;

//funcion permisos de contenido
function permissions_content($permisos_contenido){		
	$roles = isset($permisos_contenido['seleccionar_roles']) ? $permisos_contenido['seleccionar_roles'] : array();
	$allowed_roles = $roles;
	$user = wp_get_current_user();
	$user_actual = $user->roles;
	$permissions = 'false';
	switch ($permissions) {
		case (in_array("administrator", $user_actual) || in_array("editor", $user_actual)):
			$permissions = 'true';
			break;
		case (empty($allowed_roles)):
			$permissions = 'true';
			break;
		case (!empty($allowed_roles) && array_intersect($allowed_roles, $user_actual)):
			$permissions = 'true';
			break;
		default:
			return $permissions;
	}
	$value = $permissions;	
	return $value;
}

