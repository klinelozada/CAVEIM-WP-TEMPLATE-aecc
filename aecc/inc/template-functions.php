<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package aecc
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

function aecc_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'aecc_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function aecc_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'aecc_pingback_header' );

/**
 * Add widget on the left sidebar along with the menus. 
 */
function aecc_child_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Primary Menu - Widget', 'aecc' ),
		'id'            => 'primary-menu-widget',
		'description'   => __( 'Add widgets here to appear in your footer area.', 'aecc' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'aecc_child_widgets_init' );

/**
 * Create Menu Position "Homepage Menu"
 */
function aecc_homepage_menu() {
	register_nav_menu('aecc-homepage-menu',__( 'Homepage Menu' ));
}
add_action( 'init', 'aecc_homepage_menu' );

/**
 * Create Custom Post Type "
 */
function aecc_documents() {

    $labels = array(
        'name'                  => _x( 'Documents', 'Post Type General Name', 'aecc' ),
        'singular_name'         => _x( 'Document', 'Post Type Singular Name', 'aecc' ),
        'menu_name'             => __( 'Document', 'aecc' ),
        'name_admin_bar'        => __( 'Document', 'aecc' ),
        'archives'              => __( 'Documents Archives', 'aecc' ),
        'attributes'            => __( 'Documents Attributes', 'aecc' ),
        'parent_item_colon'     => __( 'Parent Documents:', 'aecc' ),
        'all_items'             => __( 'All Documents', 'aecc' ),
        'add_new_item'          => __( 'Add Document', 'aecc' ),
        'add_new'               => __( 'Add New Document', 'aecc' ),
        'new_item'              => __( 'New Document', 'aecc' ),
        'edit_item'             => __( 'Edit Document', 'aecc' ),
        'update_item'           => __( 'Update Document', 'aecc' ),
        'view_item'             => __( 'View Document', 'aecc' ),
        'view_items'            => __( 'View Documents', 'aecc' ),
        'search_items'          => __( 'Search Documents', 'aecc' ),
        'not_found'             => __( 'Not found', 'aecc' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'aecc' ),
        'items_list'            => __( 'Items list', 'aecc' ),
        'items_list_navigation' => __( 'Items list navigation', 'aecc' ),
        'filter_items_list'     => __( 'Filter items list', 'aecc' ),
    );
    $args = array(
        'label'                 => __( 'Document', 'aecc' ),
        'description'           => __( 'Add documents in here', 'aecc' ),
        'labels'                => $labels,
        'supports'              => array( 'title' ),
        'taxonomies'            => array( 'directory' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type( 'aecc-documents', $args );

}
add_action( 'init', 'aecc_documents', 0 );

// TAXONOMY : DOCUMENT [directory]
function aecc_document_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Document Categories', 'Taxonomy General Name', 'aecc_document_taxonomy' ),
        'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'aecc_document_taxonomy' ),
        'menu_name'                  => __( 'Categories', 'aecc_document_taxonomy' ),
        'all_items'                  => __( 'All Category', 'aecc_document_taxonomy' ),
        'parent_item'                => __( 'Parent Category', 'aecc_document_taxonomy' ),
        'parent_item_colon'          => __( 'Parent Category:', 'aecc_document_taxonomy' ),
        'new_item_name'              => __( 'New Category', 'aecc_document_taxonomy' ),
        'add_new_item'               => __( 'Add Category', 'aecc_document_taxonomy' ),
        'edit_item'                  => __( 'Edit Category', 'aecc_document_taxonomy' ),
        'update_item'                => __( 'Update Category', 'aecc_document_taxonomy' ),
        'view_item'                  => __( 'View Category', 'aecc_document_taxonomy' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'aecc_document_taxonomy' ),
        'add_or_remove_items'        => __( 'Add or remove items', 'aecc_document_taxonomy' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'aecc_document_taxonomy' ),
        'popular_items'              => __( 'Popular Items', 'aecc_document_taxonomy' ),
        'search_items'               => __( 'Search Category', 'aecc_document_taxonomy' ),
        'not_found'                  => __( 'Not Found', 'aecc_document_taxonomy' ),
        'no_terms'                   => __( 'No items', 'aecc_document_taxonomy' ),
        'items_list'                 => __( 'Items list', 'aecc_document_taxonomy' ),
        'items_list_navigation'      => __( 'Items list navigation', 'aecc_document_taxonomy' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
    );
    register_taxonomy( 'directory', array( 'aecc-documents' ), $args );

}
add_action( 'init', 'aecc_document_taxonomy', 0 );

// TAGS : PAGE [page_tag]
function aecc_document_tag() {
    register_taxonomy( 
        'document_tag', 
        'aecc-documents', 
        array( 
            'hierarchical'  => false, 
            'label'         => __( 'Tags','taxonomy general name'), 
            'singular_name' => __( 'Tag', 'taxonomy general name' ), 
            'rewrite'       => true, 
            'query_var'     => true ,
            'show_in_rest'  => true,
        ));
}
add_action('init', 'aecc_document_tag');

// ----------------- Page Taxonomies -----------------

// TAXONOMY : PAGE [page_category]
function aecc_pages_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Categories', 'Taxonomy General Name', 'aecc_pages_taxonomy' ),
        'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'aecc_pages_taxonomy' ),
        'menu_name'                  => __( 'Categories', 'aecc_pages_taxonomy' ),
        'all_items'                  => __( 'All Categories', 'aecc_pages_taxonomy' ),
        'parent_item'                => __( 'Parent Category', 'aecc_pages_taxonomy' ),
        'parent_item_colon'          => __( 'Parent Category:', 'aecc_pages_taxonomy' ),
        'new_item_name'              => __( 'New Category', 'aecc_pages_taxonomy' ),
        'add_new_item'               => __( 'Add Category', 'aecc_pages_taxonomy' ),
        'edit_item'                  => __( 'Edit Category', 'aecc_pages_taxonomy' ),
        'update_item'                => __( 'Update Category', 'aecc_pages_taxonomy' ),
        'view_item'                  => __( 'View Category', 'aecc_pages_taxonomy' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'aecc_pages_taxonomy' ),
        'add_or_remove_items'        => __( 'Add or remove items', 'aecc_pages_taxonomy' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'aecc_pages_taxonomy' ),
        'popular_items'              => __( 'Popular Items', 'aecc_pages_taxonomy' ),
        'search_items'               => __( 'Search Category', 'aecc_pages_taxonomy' ),
        'not_found'                  => __( 'Not Found', 'aecc_pages_taxonomy' ),
        'no_terms'                   => __( 'No items', 'aecc_pages_taxonomy' ),
        'items_list'                 => __( 'Items list', 'aecc_pages_taxonomy' ),
        'items_list_navigation'      => __( 'Items list navigation', 'aecc_pages_taxonomy' ),
    );
    $args = array(
        'labels'                     => $labels,
        'show_in_rest'               => true,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => false,
        'show_tagcloud'              => false,
    );
    register_taxonomy( 'page_category', array( 'page' ), $args );

}
add_action( 'init', 'aecc_pages_taxonomy', 0 );

// TAGS : PAGE [page_tag]
function aecc_pages_tag() {
    register_taxonomy( 
        'page_tag', 
        'page', 
        array( 
            'hierarchical'  => false, 
            'label'         => __( 'Tags','taxonomy general name'), 
            'singular_name' => __( 'Tag', 'taxonomy general name' ), 
            'rewrite'       => true, 
            'query_var'     => true ,
            'show_in_rest'  => true,
        ));
}
add_action('init', 'aecc_pages_tag');

// SUPPORT : Add support of both custom tag and taxonomy in the page
function aecc_taxonomies_to_pages() {
    // 'show_in_rest' must be set to true on register_taxonomy $args
    register_taxonomy_for_object_type( 'page_tag', 'page' );
    register_taxonomy_for_object_type( 'page_category', 'page' );
} 

add_action( 'init', 'aecc_taxonomies_to_pages' );

// ----------------- Page Taxonomies -----------------

function aecc_get_posts_from_categories($term_id, $limit, $order_by, $order) {
    if(!$limit){
        $limit = -1;
    }
    if(!$order_by){
        $order_by = 'ID';
        // ID, title, date, modified
    }
    if(!$order){
        $order = 'DESC';
    }
	$posts_array = get_posts(
		array(
            'posts_per_page' => $limit,
            'order_by'  => $order_by,
            'order'  => $order,
            'post_type' => 'aecc-documents',
            'post_status' => 'publish',
			'tax_query' => array(
				array(
					'taxonomy' => 'directory',
					'field' => 'term_id',
					'terms' => $term_id,
				)
			)
		)
	);
	return $posts_array;
}

function aecc_get_file_extension($url) {

    $re = '/^.*\.(jpg|jpeg|png|pdf|csv|xslx|ppt|pptx|mp4|ogg)$/i';

    preg_match($re, $url, $match, PREG_OFFSET_CAPTURE, 0);

    return $match[1][0];
}

function aecc_show_docs_content($doc_id, $taxonomy, $layout) {
	
    global $post;
    if($taxonomy == 'document'):
        $file = get_field('file_upload',$doc_id);
        $f_ext = aecc_get_file_extension($file);
        $tags = get_the_terms( $doc_id, 'document_tag' );

        $tag_n = array();
        $tag_tax_id = array();
        foreach($tags as $tag_names):
            $tag_n[] = array('id'=>$doc_id,'name'=>$tag_names->name,'tag_id'=>$tag_names->term_taxonomy_id);
            $tag_tax_id[] = array('tagclass_'.$tag_names->term_taxonomy_id);
        endforeach;

        $tag_tax_id = call_user_func_array('array_merge', $tag_tax_id);

        $t_m = array_merge($tag_n);
        $t_id = array_merge($tag_tax_id);
    else: 
        $file = get_the_guid($doc_id);
        $f_ext = aecc_get_file_extension($file);
    endif;
	
    $post_slug = get_post($doc_id);
    $post_slug = $post_slug->post_name;
    
    if( ($layout == 'layout-0') || ($layout == 'layout-1') || ($layout == 'layout-2') || ($layout == 'layout-3') ):
        $html = "<div class='col-lg-3 col-md-6 col-sm-12 aecc-box ".implode(" ", $tag_tax_id)."' data-date='".get_the_date( 'm/d/Y', $doc_id )."' data-name='".$post_slug."'>";
    elseif($layout == 'layout-4'):
        $html = "<div class='col-lg-2 col-md-6 col-sm-12 aecc-box ".implode(" ", $tag_tax_id)."' data-date='".get_the_date( 'm/d/Y', $doc_id )."' data-name='".$post_slug."'>";
    endif;
	
    $html .='<div class="aecc-doc-container">';

	switch ($f_ext) {

        case "jpg":
        case "jpeg":
        case "png":

            if($taxonomy == 'document'):

                $html .='<a href="#aecc-img-'.$doc_id.'" class="aecc-docs-link">';
                $html .='<div class="aecc-logo-container"><img class="aecc-document-logo" src="'.get_field('file_upload',$doc_id).'"/></div>';
                $html .='</a>';

                $html .= '<div class="lightbox short-animate" id="aecc-img-'.$doc_id.'"><img class="long-animate" src="'.get_field('file_upload',$doc_id).'"/></div>';
                $html .= '<div id="lightbox-controls" class="short-animate"><a id="close-lightbox" class="long-animate" href="#!">Close Lightbox</a></div>';

                $html .='<a href="#aecc-img-'.$doc_id.'" class="aecc-docs-link">';
                $html .='<div class="aecc-doc-content">';
                $html .='<h5>'.get_the_title($doc_id).'</h5>';
                $html .='<p class="aecc-doc-date">'.get_the_date('F j, Y',$doc_id).'</p>';
                $html .='</a>';

                $html .='<p class="aecc-download"><a href="'.get_field('file_upload',$doc_id).'" download="'.get_the_title($doc_id).'"><i class="fad fa-download"></i></a></p>';
                
                $html .='</div>';

            else:

                $html .='<a href="#aecc-img-'.$doc_id.'" class="aecc-docs-link" data-type="img" data-id="'.$doc_id.'">';
                $html .='<div class="aecc-logo-container"><img class="aecc-document-logo" src="'.get_the_guid($doc_id).'"/></div>';
                $html .='</a>';

                $html .='<a href="#aecc-img-'.$doc_id.'" class="aecc-docs-link">';
                $html .='<div class="aecc-doc-content">';
                $html .='<h5>'.get_the_title($doc_id).'</h5>';
                $html .='<p class="aecc-doc-date">'.get_the_date('F j, Y',$doc_id).'</p>';
                $html .='</a>';

                $html .='<p class="aecc-download"><a href="'.get_the_guid($doc_id).'" download="'.get_the_title($doc_id).'"><i class="fad fa-download"></i></a></p>';
                
                $html .='</div>';

            endif;
            
        break;

        case "ppt":
        case "pptx":
        
            // Shortcode
            // [embeddoc url="http://aio.codemeplz.com/wp-content/uploads/2020/09/Title-Lorem-Ipsum.pptx" width="250px" height="250px" download="all" viewer="microsoft" text="Downloads"]
            // $html .= '<div class="aecc-pp-container">[embeddoc url="'.$ppt_file.'" width="250px" height="250px" download="all" viewer="microsoft" text="Downloads"]</div>';
            if($taxonomy == 'document'):

                $html .='<a href="#aecc-pt-'.$doc_id.'" class="aecc-docs-link">';
                $html .='<div class="aecc-doc-cover"></div><div class="aecc-maps-container" id="aecc-maps-container">[embeddoc url="'.get_field('file_upload',$doc_id).'" width="250px" height="250px" viewer="microsoft"]</div>';
                $html .='</a>';

                $html .= '<div class="lightbox short-animate" id="aecc-pt-'.$doc_id.'">[embeddoc url="'.get_field('file_upload',$doc_id).'" width="100%" height="90%" viewer="microsoft"]</div>';
                $html .= '<div id="lightbox-controls" class="short-animate"><a id="close-lightbox" class="long-animate" href="#!">Close Lightbox</a></div>';

                $html .='<a href="#aecc-pt-'.$doc_id.'" class="aecc-docs-link">';
                $html .='<div class="aecc-doc-content">';
                $html .='<h5>'.get_the_title($doc_id).'</h5>';
                $html .='<p class="aecc-doc-date">'.get_the_date('F j, Y',$doc_id).'</p>';
                $html .='</a>';

                $html .='<p class="aecc-download"><a href="'.get_field('file_upload',$doc_id).'" download="'.get_the_title($doc_id).'"><i class="fad fa-download"></i></a></p>';
                $html .='</div>';
                
            else:
                $html .='<a href="'.get_the_guid($doc_id).'" target="_blank" class="aecc-docs-link" data-type="pdf" data-id="'.$doc_id.'">';
                $html .='<div class="aecc-doc-cover"></div><div class="aecc-maps-container" id="aecc-maps-container">[embeddoc url="'.get_the_guid($doc_id).'" width="250px" height="250px" viewer="microsoft"]</div>';
                $html .='</a>';

                $html .='<a href="#aecc-pt-'.$doc_id.'" class="aecc-docs-link">';
                $html .='<div class="aecc-doc-content">';
                $html .='<h5>'.get_the_title($doc_id).'</h5>';
                $html .='<p class="aecc-doc-date">'.get_the_date('F j, Y',$doc_id).'</p>';
                $html .='</a>';

                $html .='<p class="aecc-download"><a href="'.get_the_guid($doc_id).'" download="'.get_the_title($doc_id).'"><i class="fad fa-download"></i></a></p>';
                $html .='</div>';
            endif;
        break;
        
        case "pdf":
            if($taxonomy == 'document'):

                $html .='<a href="#aecc-pt-'.$doc_id.'" class="aecc-docs-link">';
                $html .='<div class="aecc-doc-cover"></div><div class="aecc-maps-container" id="aecc-maps-container">[pdf-embedder url="'.get_field('file_upload',$doc_id).'"]</div>';
                $html .='</a>';

                $html .= '<div class="lightbox short-animate" id="aecc-pt-'.$doc_id.'">[embeddoc url="'.get_field('file_upload',$doc_id).'" width="100%" height="90%" viewer="google"]</div>';
                $html .= '<div id="lightbox-controls" class="short-animate"><a id="close-lightbox" class="long-animate" href="#!">Close Lightbox</a></div>';

                $html .='<a href="#aecc-pt-'.$doc_id.'" class="aecc-docs-link">';
                $html .='<div class="aecc-doc-content">';
                $html .='<h5>'.get_the_title($doc_id).'</h5>';
                $html .='<p class="aecc-doc-date">'.get_the_date('F j, Y',$doc_id).'</p>';
                $html .='</a>';
                $html .='<p class="aecc-download"><a href="'.get_field('file_upload',$doc_id).'" download="'.get_the_title($doc_id).'"><i class="fad fa-download"></i></a></p>';
                $html .='</div>';

            else:

                $html .='<a href="'.get_the_guid($doc_id).'" target="_blank" class="aecc-docs-link" data-type="pdf" data-id="'.$doc_id.'">';
                $html .='<div class="aecc-doc-cover" style="display:none;"></div><div class="aecc-maps-container" id="aecc-maps-container">[wonderplugin_pdf src="'.get_the_guid($doc_id).'" width="280px" height="180px" style="border:0;overflow:hidden!important;scrolling:no;"]</div>';
                $html .='</a>';

                $html .='<a href="#aecc-pt-'.$doc_id.'" class="aecc-docs-link">';
                $html .='<div class="aecc-doc-content">';
                $html .='<h5>'.get_the_title($doc_id).'</h5>';
                $html .='<p class="aecc-doc-date">'.get_the_date('F j, Y',$doc_id).'</p>';
                $html .='</a>';
                $html .='<p class="aecc-download"><a href="'.get_the_guid($doc_id).'" download="'.get_the_title($doc_id).'"><i class="fad fa-download" s></i></a></p>';
                $html .='</div>';

            endif;
        break;
        
        default:

            if($taxonomy !== 'document'):
                $html .='<a href="'.get_the_guid($doc_id).'" target="_blank" class="aecc-docs-link" data-type="img" data-id="'.$doc_id.'">';
                $html .='<div class="aecc-doc-cover"></div><div class="aecc-logo-container">[evp_embed_video url="'.get_the_guid($doc_id).'"]</div>';
                $html .='</a>';

                $html .='<a href="#aecc-img-'.$doc_id.'" class="aecc-docs-link">';
                $html .='<div class="aecc-doc-content">';
                $html .='<h5>'.get_the_title($doc_id).'</h5>';
                $html .='<p class="aecc-doc-date">'.get_the_date('F j, Y',$doc_id).'</p>';
                $html .='</a>';

                $html .='<p class="aecc-download"><a href="'.get_the_guid($doc_id).'" download="'.get_the_title($doc_id).'"><i class="fad fa-download"></i></a></p>';
                
                $html .='</div>';

            endif;


        // default:
        //     $html .='<a href="#aecc-maps-'.$doc_id.'" class="aecc-docs-link">';
        //     $html .='<div class="aecc-doc-cover"></div><div class="aecc-maps-container">'.get_field('maps',$doc_id).'</div>';
        //     $html .='</a>';

        //     $html .= '<div class="lightbox short-animate" id="aecc-maps-'.$doc_id.'">'.get_field('maps',$doc_id).'</div>';
        //     $html .= '<div id="lightbox-controls" class="short-animate"><a id="close-lightbox" class="long-animate" href="#!">Close Lightbox</a></div>';

        //     $html .='<a href="#aecc-maps-'.$doc_id.'" class="aecc-docs-link">';
        //     $html .='<div class="aecc-doc-content">';
        //     $html .='<h5>'.get_the_title($doc_id).'</h5>';
        //     $html .='<p class="aecc-doc-date">'.get_the_date('F j, Y',$doc_id).'</p>';
        //     $html .='</div>';
        //     $html .='</a>';
            
	}

	$html .='</div>';
    $html .='</div>';

	return $html;
}

function aecc_get_folders_with_layout($data){
    
    $html .= '<div class="aecc-img-file-container">';
    $html .= '<div class="aecc-img-file-row">';
    $html .= '<ul id="primary-menu">';

    foreach ($data as $sc) {
        $link = get_term_link( $sc->slug, $sc->taxonomy );
        $class_slug = preg_replace('/[^A-Za-z \?!]/', '', $sc->slug );
        
        $termchildren = get_term_children( $sc->term_id, $sc->taxonomy );
        $html .= '<li class="'.$class_slug.'-menu-parent iv-parent inactive" id="iv-parent"><a href="'. $link .'" data-id="'.$sc->term_id.'"><i class="fad fa-folder"></i> '.$sc->name.'</a>';

        if(!empty($termchildren)):
            $html .= '<ul id="iv-child" class="iv-child">';
            foreach ( $termchildren as $child ) {
                $html .= '<li class="inactive"><a href="' . get_term_link( $child, $sc->taxonomy ) . '" data-id="'.$child.'"><i class="fad fa-folder"></i> ' . get_term($child)->name . '</a></li>';
            }
            $html .= '</ul>';
        endif;

        $html .= '</li>';

    }
    $html .= '</ul>';
    $html .= '</div>';
    $html .= '</div>';

    return $html;

}

function aecc_get_subcategories_with_layout($category_id, $taxonomy) {

    if(!$taxonomy){
        $taxonomy = 'directory';
    }

    if($taxonomy == 'directory') : 

        $args = array(
            'hierarchical' => 0,
            'show_option_none' => '',
            'hide_empty' => 0,
            'parent' => $category_id,
            'orderby' => 'id',
            'order' => 'ASC',
            'suppress_filters' => true,
            'taxonomy' => $taxonomy
         );
    
        $subcats = get_categories($args);
    
        echo '<ul id="primary-menu">';
        
        $styles = array();
        $font_icon = get_field('font_awesome_-_icon', $sc->taxonomy.'_'.$sc->term_id);

        foreach ($subcats as $sc) {
            $link = get_term_link( $sc->slug, $sc->taxonomy );
            $icon = get_field('font_awesome_-_icon', $sc->taxonomy.'_'.$sc->term_id);
            $class_slug = preg_replace('/[^A-Za-z \?!]/', '', $sc->slug );

            echo '<li class="'.$class_slug.'-dbmenu-item"><a href="'. $link .'">'.$sc->name.'</a><i class="'.$icon.'" style="'.( !$icon ? 'display:none;' : '').'"></i></li>';
            $styles[] = array($class_slug.'-dbmenu-item' => get_field('font_awesome_-_background_color', $sc->taxonomy.'_'.$sc->term_id));
        }
        echo '</ul>';

        //echo '<style>'.json_encode($styles).'</style>';
        
        $css  = '<style>';

        foreach($styles as $style):
            $css_combine = array();
            foreach($style as $s_key => $s_val){
                $css .= '.'. $s_key . ' i {background:' .$s_val. '} ';
                $css_combine[] = array($s_key);
            }
        endforeach;

        $css .= '[class*="-dbmenu-item"]:hover > i { background:#fff; color:rgb(255,138,0); } ';
        $css .= '</style>';

        print_r($css);
    
        // print_r(get_field('font_awesome_-_icon', 7));
    
    elseif($taxonomy == 'happyfiles_category') : 

        $args = array(
            'post_status'    => 'any',
            'post_type'      => array('attachment'),
            'tax_query'      => array(
                array(
                    'taxonomy'         => 'happyfiles_category',
                    'terms'            => $category_id,
                    'include_children' => false
                )
            )
        );

        $query = new WP_Query($args);
        $attachments = $query->get_posts();

        return($attachments);

        // echo '<ul id="primary-menu">';
        // echo '</ul>';

    endif;

}

function aecc_get_subcategories_with_layout_homepage($layout, $cat_id) {

    if(!$category_id)
        $category_id = $cat_id;
    $args = array(
        'hierarchical' => 0,
        'show_option_none' => '',
        'hide_empty' => 0,
        'parent' => $category_id,
        'orderby' => 'id',
        'order' => 'ASC',
        'suppress_filters' => true,
        'taxonomy' => 'directory'
     );

    $subcats = get_categories($args);

    echo '<ul id="primary-menu">';

    $styles = array();

    if($layout == 'layout-1'):

        foreach ($subcats as $sc) {
            $link = get_term_link( $sc->slug, $sc->taxonomy );
            $icon = get_field('font_awesome_-_icon', $sc->taxonomy.'_'.$sc->term_id);
            $f_image = get_field('featured_image', $sc->taxonomy.'_'.$sc->term_id);
            
            echo '<li class="'.str_replace('-','_',$sc->slug).'_dbmenu_item"><a href="'. $link .'">'.$sc->name.'</a><i class="'.$icon.'" style="'.( !$icon ? 'display:none;' : '').'"></i></li>';
            $styles[] = array($sc->slug.'_dbmenu_item' => get_field('font_awesome_-_background_color', $sc->taxonomy.'_'.$sc->term_id));
        }

    else:

        foreach ($subcats as $sc) {
            $link = get_term_link( $sc->slug, $sc->taxonomy );
            $icon = get_field('font_awesome_-_icon', $sc->taxonomy.'_'.$sc->term_id);
            $f_image = get_field('featured_image', $sc->taxonomy.'_'.$sc->term_id);
            
            echo '<li class="'.str_replace('-','_',$sc->slug).'_dbmenu_item"><a href="'. $link .'"><img src="'.$f_image.'">'.$sc->name.'</a></li>';
            $styles[] = array($sc->slug.'_dbmenu_item' => get_field('font_awesome_-_background_color', $sc->taxonomy.'_'.$sc->term_id));
        }

    endif;
    echo '</ul>';

    //echo '<style>'.json_encode($styles).'</style>';
    
    $css  = '<style>';

    foreach($styles as $style):
        $css_combine = array();
        foreach($style as $s_key => $s_val){
            $css .= '.'. str_replace('-','_',$s_key) . ' i {background:' .$s_val. '} ';
            $css_combine[] = array($s_key);
        }
    endforeach;


    if($layout == 'layout-1'):

        $css .= '[class*="_dbmenu_item"]:hover > i { background:#fff; color:rgb(255,138,0); } ';

    else:
        $css .= '[class*="_dbmenu_item"] { text-align:center; } ';
        $css .= '[class*="_dbmenu_item"]:hover > i { background:#fff; color:rgb(255,138,0); } ';

        $css .= 'ul#primary-menu li img { width:100%; border-radius:20px; } .aecc-main-menu ul li { padding:20px 20px 0; border-radius: 20px; margin: 8px 6px; }';
    endif;

    $css .= '</style>';

    print_r($css);
    
    // print_r(get_field('font_awesome_-_icon', 7));

}

function aecc_get_tag_buttons() {

    ?>

        <script src="<?php echo get_template_directory_uri(); ?>/assets/js/gijgo.min.js" type="text/javascript"></script>
        <link href="<?php echo get_template_directory_uri(); ?>/assets/css/gijgo.min.css" rel="stylesheet" type="text/css" />

            <style>
                a.tag-links {
                    border-radius:30px;
                    color:#4c4c4c;
                    background:#fff;
                    margin: 2px 2px;
                    padding: 10px 10px;
                    font-size: 14px;
                    font-weight: 600;
                    text-decoration:none;
                    border:solid 1px #f5f5f5;
                    transition:all .5s ease-in-out;
                    -webkit-transition:all .5s ease-in-out;
                    -moz-transition:all .5s ease-in-out;        
                    -o-transition:all .5s ease-in-out;
                }
                a.tag-links:hover {
                    background:#e2faea;
                }
                a.tag-links.active {
                    background:#dbf2e2;
                }
                h5.aecc-title {
                    color:#598468;
                    margin:25px 0;
                    font-weight:500;
                }
            </style>

            <h4 class="aecc-title">Filter by</h4>
            <h5 class="aecc-title">TAGS</h4>

                        <?php
                            $tags = get_terms( array(
                                    'taxonomy'  => 'document_tag',
                                    'format'    => 'array'
                            ) );
                    
                            foreach($tags as $tag):
                                $link = get_term_link( $tag->slug, $tag->taxonomy );
                                print_r('<a href="#" class="tag-links" id="tag-links" data-tagid="'.$tag->term_id.'" data-filter="tag">'.$tag->name.'</a>');
                            endforeach;
                    
                        ?>


            <h5 class="aecc-title">DATE</h4>

            <div class="form-group date-group">
                <div class='input-group date' id='datetimepicker6'>
                    <input type='text' class="form-control" id="start-date" placeholder="Start Date"/>
                </div>
            </div>

            <div class="form-group date-group">
                <div class='input-group date' id='datetimepicker7'>
                    <input type='text' class="form-control" id="end-date" placeholder="End Date"/>
                </div>
            </div>
            
            <div class="container date-search-container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">

                        <button type="button" name="date-submit" id="date-search" class="btn btn-primary float-right"><i class="fad fa-calendar-alt"></i> Filter Date</button>

                    </div>
                </div>
            </div>

            <script>
                jQuery(document).ready(function($) {

                    $( ".tag-links" ).click(function(e) {
                        
                        e.preventDefault();
                        var tag_id = $( this ).data("tagid");
                        console.log(tag_id);

                        // Action Scripts
                        $( this ).toggleClass( "active" );

                        if($(this).hasClass('active')) {
                            $(".aecc-box:not(.tagclass_"+tag_id+")").fadeOut('slow');
                        } else {
                            $(".aecc-box").fadeIn('slow');
                        }

                    });

                    
                    $( "#date-search" ).on("click", function() {
                        
                        $(".aecc-box").each(function( index ) {

                            var D1 = $("#start-date").val(); 
                            var D2 = $("#end-date").val(); 
                            var D3 = $(this).data('date');

                            D1N = new Date(D1); 
                            D2N = new Date(D2); 
                            D3N = new Date(D3); 

                            if (D3N.getTime() <= D2N.getTime() && D3N.getTime() >= D1N.getTime()) {
                                $(this).fadeIn('slow');
                                // console.log("Date is in between" + D3 + " the Date 1 and Date 2");
                            } else { 
                                $(this).fadeOut('slow');
                                // console.log("Date is not in" + D3 + " between the Date 1 and Date 2");
                            }

                            if(D1.length == '' && D2.length == '') {
                                $(this).fadeIn('slow');
                            }

                        });
                        
                    });

                    $('#datetimepicker6 input').datepicker({
                        uiLibrary: 'bootstrap4'
                    });
                    $('#datetimepicker7 input').datepicker({
                        uiLibrary: 'bootstrap4'
                    });
                });
            </script>
    
        <?php
    }
    
    // Restrict only on this page
    add_action( 'wp_enqueue_scripts', 'aecc_lightbox_js');
    function aecc_lightbox_js()
    {
        if(is_page('image-video-archive')){

            wp_enqueue_script( 'ajax-script', get_template_directory_uri(). '/js/app.js', array('jquery') );
            wp_localize_script(
                'ajax-script',
                'ajax_object',
                array(
                    'ajax_url'  => admin_url( 'admin-ajax.php' )
                )
            );

        }
    }

    add_action("wp_ajax_lightbox_request", "lightbox_request");
    add_action("wp_ajax_nopriv_lightbox_request", "lightbox_request");

    function lightbox_request() {
        
        global $wpdb;
        $doc_id = $_POST['id'];
        
        $file = get_the_guid($doc_id);
        $f_ext = aecc_get_file_extension($file);

        $html = '';

        switch ($f_ext) {

            case "jpg":
            case "jpeg":
            case "png":
                $html .= '<img class="long-animate" src="'.get_the_guid($doc_id).'"/>';
            break;

            case "ppt":
            case "pptx":
                // $html .= do_shortcode('[embeddoc url="'.get_the_guid($doc_id).'" width="100%" height="90%" viewer="microsoft" cache="off"]');
                $html .= 'noshow';
            break;
            
            case "pdf":
                // $html .= do_shortcode('[embeddoc url="'.get_the_guid($doc_id).'" width="100%" height="90%" viewer="google" cache="off"]]');
                $html .= 'noshow';
            break;

            case "mp4":
            case "ogg":
                $html .= '[evp_embed_video url="'.get_the_guid($doc_id).'"]';
            break;
            
            default:
                $html .= 'noshow';

        }
        
        print_r($html);

        wp_die();

    }

    add_action("wp_ajax_aecc_files_request", "aecc_files_request");
    add_action("wp_ajax_nopriv_aecc_files_request", "aecc_files_request");

    function aecc_files_request() {

        // $files = lightbox_request();

        // return $files;
        
        global $wpdb;
        $doc_id = $_POST['id'];


        $aecc_documents = aecc_get_subcategories_with_layout($doc_id, 'happyfiles_category', 'layout-0');
        foreach($aecc_documents as $aecc_document):
            echo do_shortcode(aecc_show_docs_content($aecc_document->ID, 'happyfiles_category', 'layout-0'));
        endforeach; 



        // print_r($doc_id);
        
        // $file = get_the_guid($doc_id);
        // $f_ext = aecc_get_file_extension($file);

        // $html = '';

        // switch ($f_ext) {

        //     case "jpg":
        //     case "jpeg":
        //     case "png":
        //         $html .= '<img class="long-animate" src="'.get_the_guid($doc_id).'"/>';
        //     break;

        //     case "ppt":
        //     case "pptx":
        //         // $html .= do_shortcode('[embeddoc url="'.get_the_guid($doc_id).'" width="100%" height="90%" viewer="microsoft" cache="off"]');
        //         $html .= 'noshow';
        //     break;
            
        //     case "pdf":
        //         // $html .= do_shortcode('[embeddoc url="'.get_the_guid($doc_id).'" width="100%" height="90%" viewer="google" cache="off"]]');
        //         $html .= 'noshow';
        //     break;

        //     case "mp4":
        //     case "ogg":
        //         $html .= '[evp_embed_video url="'.get_the_guid($doc_id).'"]';
        //     break;
            
        //     default:
        //         $html .= 'noshow';

        // }
        
        // print_r($html);

        wp_die();

    }