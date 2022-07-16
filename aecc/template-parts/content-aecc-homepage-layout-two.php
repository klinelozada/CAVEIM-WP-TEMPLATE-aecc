<?php
/*
 * Template Name: AECC Homepage - Layout 2
 * Description: -
 */

 get_header();
?>
    <link href="<?php echo get_template_directory_uri(); ?>/app-doc.css" rel="stylesheet">

<?php if(is_front_page()): ?>

    <!-- Front Page -->
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="aecc-content">
                    <h1 class="mt-4"><?php the_title(); ?></h1>
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="aecc-main-menu">
                    <div class="menu-homepage-menu-container">
                            <?php
                                aecc_get_subcategories_with_layout_homepage('layout-2', NULL);
                            ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

<?php else: ?>    

    <!-- Normal Page -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="aecc-content">
                    <h1 class="mt-4"><?php the_title(); ?></h1>
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>

    <!--  -->
    <div class="container-fluid">

    <?php

        // Get the slug to identify
        global $post;
        $post_slug = $post->post_name;

        // Get the parent categories
        $terms = get_terms( array( 
            'taxonomy' => 'directory',
            'parent'   => 0
        ) );
    ?>
    <div class="row">
    <div class="col-lg-8 col-md-12 col-sm-12">

    <?php
        foreach($terms as $term):
            // print_r($term->term_id);
            $aecc_documents = aecc_get_children($term->term_id);
            print_r($aecc_documents);

    ?>
        <!-- If the page has some documents -->

            <div class="row aecc-document-body">
            <h4 class="aecc-title"><?php print_r($term_name); ?></h4>
                <?php
                    // Get all documents
                    
                    // foreach($aecc_documents as $aecc_document):
                    //     echo do_shortcode(aecc_show_docs_content( $term_slug, $aecc_document->ID));
                    // endforeach; //$aecc_documents
                ?>
            </div>


    <?php endforeach; // $terms ?>

    </div><!-- .col-md-8 -->

    <div class="col-lg-4 col-md-12 col-sm-12">
        Sidebar
    </div>

    </div><!-- .row -->
    </div>

    <script>
    jQuery(document).ready(function($) {
        var width = $(window).width();
        var height = $(window).height();
        $('.lightbox .ead-iframe').css('cssText','height:100%!important;min-height:'+height+'px!important;');
    });
    </script>

<?php endif;?>
<?php
get_footer();