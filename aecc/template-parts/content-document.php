<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package aecc
 */

?>
    <link href="<?php echo get_template_directory_uri(); ?>/app-doc.css" rel="stylesheet">

        <?php

            $term_id = get_queried_object()->term_id;
            $term_parent_id = get_queried_object()->parent;
            $term_description = get_field('full_description','directory_'.$term_id);
            $term_layout = get_field('page_category_layout','directory_'.$term_id);
            if(!$term_layout)
                $term_layout = 'layout-0';
            
            $taxonomy = get_queried_object()->taxonomy;
            // print_r($taxonomy);

            $terms = get_terms( array( 
                'taxonomy' => 'directory',
                'parent'   => $term_id
            ) );

            // print_r($terms);

        ?>

        <!-- Normal Page -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="aecc-content">
                        <h1 class="mt-4"><?php print_r(get_queried_object()->name); ?></h1>
                        <?php print_r($term_description); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">

        <div class="row">

        <!-- <div class="<?php //print_r( $term_parent_id == 0 ? 'col-lg-12' : 'col-lg-8' ); ?> col-md-12 col-sm-12"> -->
        <div class="<?php print_r( ($term_layout == 'layout-2') || ($term_layout == 'layout-0') ? 'col-lg-9' : 'col-lg-12' ); ?> col-md-12 col-sm-12">
            
            <!-- IF: current category is top level then show this [top level to second level]-->
            <?php if($term_layout == 'layout-1'): ?>
            <?php //if($term_parent_id == 0): ?>
                
                <div class="row term-id-<?php print_r($term_id); ?>">
                    <div class="col-md-12">
                        <div class="aecc-main-menu">
                            <!-- <h4 class="aecc-title"><?php // print_r($term->name); ?></h4> -->
                            <div class="menu-homepage-menu-container">
                                <?php echo do_shortcode(aecc_get_subcategories_with_layout($term_id, 'directory')); ?>
                            </div>
                        </div>
                    </div>
                </div>

            <!-- ELSE: then show the documents [second level to third level]-->
            <?php elseif($term_layout == 'layout-2'): ?>
                
            <?php
                foreach($terms as $term):
                    $aecc_link = get_term_link( $term );
                    // aecc_get_posts_from_categories(TERM_ID, NUMBER OF POST LIMIT, ORDER_BY[ID,DATE,MODIFIED,TITLE], ORDER [ASC,DESC])
                    $aecc_documents = aecc_get_posts_from_categories($term->term_id, NULL, NULL, NULL);
            ?>

                <div class="row aecc-document-body">
                <h4 class="aecc-title"><?php print_r($term->name); ?> <a href="<?php print_r($aecc_link); ?>" class="aecc-view-more">View More</a></h4>
                    <?php
                        foreach($aecc_documents as $aecc_document):
                            echo do_shortcode(aecc_show_docs_content( $aecc_document->ID, 'document', $term_layout ));
                        endforeach; //$aecc_documents
                    ?>
                </div>
                
            <?php
                endforeach;
            ?>

            <?php elseif($term_layout == 'layout-3'): ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="aecc-main-menu">
                            <div class="menu-homepage-menu-container">
                                    <?php
                                        aecc_get_subcategories_with_layout_homepage('layout-2', $term_id);
                                    ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php else: ?>

            <?php
                $aecc_documents = aecc_get_posts_from_categories($term_id);
            ?>

                <div class="row aecc-document-body">
                <h4 class="aecc-title"><?php print_r($term->name); ?> </h4>
                    <?php
                        foreach($aecc_documents as $aecc_document):
                            echo do_shortcode(aecc_show_docs_content( $aecc_document->ID, 'document', $term_layout ));
                        endforeach; //$aecc_documents
                    ?>
                </div>
                

            <?php endif; ?>


        </div><!-- .col-md-8 -->
        
        <?php if( ($term_layout == 'layout-2') || ($term_layout == 'layout-0') ):?>
        <div class="col-lg-3 col-md-12 col-sm-12 aecc-sidebar-container">
            <?php require_once('content-sidebar.php'); ?>
        </div>
        <?php endif; ?>

        </div><!-- .row -->
        </div>

        <script>
        jQuery(document).ready(function($) {
            var width = $(window).width();
            var height = $(window).height();
            $('.lightbox .ead-iframe').css('cssText','height:100%!important;min-height:'+height+'px!important;');
        });
        </script>