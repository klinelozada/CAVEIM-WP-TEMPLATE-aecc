<?php

class AECC_GUTENBERG_FUNCTIONS {

    public function __construct()
	{
        add_action( 'init', array( &$this, 'aeccRegisterMetaKeys') );
        add_action( 'enqueue_block_editor_assets', array( &$this, 'aeccBlockEditorAssets') );
    }

    // Register Meta Keys
    public function aeccRegisterMetaKeys()
    {
        register_meta( 'post', 'misha_plugin_seo_title', array(
            'type'		=> 'string',
            'single'	=> true,
            'show_in_rest'	=> true,
        ) );
    
       register_meta( 'post', 'misha_plugin_seo_description', array(
            'type'		=> 'string',
            'single'	=> true,
            'show_in_rest'	=> true,
        ) );
    
       register_meta( 'post', 'misha_plugin_seo_robots', array(
            'type'		=> 'boolean', 
            'single'	=> true,
            'show_in_rest'	=> true,
        ) );
    }

    public function aeccBlockEditorAssets()
    {
        wp_enqueue_script(
            'misha-sidebar',
            get_stylesheet_directory_uri() . '/js/gutenberg-sidebar.js',
            array( 'wp-i18n', 'wp-blocks', 'wp-edit-post', 'wp-element', 'wp-editor', 'wp-components', 'wp-data', 'wp-plugins', 'wp-edit-post' ),
            filemtime( dirname( __FILE__ ) . '/js/gutenberg-sidebar.js' )
        );
    }


}
new AECC_GUTENBERG_FUNCTIONS();