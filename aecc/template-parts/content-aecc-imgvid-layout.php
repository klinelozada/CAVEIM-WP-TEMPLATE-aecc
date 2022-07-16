<?php
/*
 * Template Name: AECC Image/Video - Layout
 * Description: -
 */

 get_header();
?>
    <link href="<?php echo get_template_directory_uri(); ?>/app-doc.css" rel="stylesheet">

    <style>
    .aecc-box {
        margin:5px 5px!important;
        background:#fff;
        border-radius:0px;
    }
    .aecc-logo-container .plyr--video {
        height:180px;
    }
    .aecc-logo-container .plyr--video .plyr__controls {
        display:none!important;
    }
    .aecc-doc-cover {
        width:100%!important;
        height:180px!important;
        position:absolute;
        z-index:9;
    }
    .aecc-doc-cover-vid {
        width:100%!important;
        height:180px!important;
        position:absolute;
        z-index:9;
    }
    .aecc-logo-container, .aecc-pp-container {
        max-height:250px!important;
        height:180px!important;
    }
    .aecc-docs-link h5,
    .aecc-docs-link p.aecc-doc-date {
        word-wrap: break-word;
        display:none;
    }
    .aecc-logo-container,
    .aecc-pp-container,
    .aecc-doc-container {
        background:none;
    }
    .aecc-doc-content {
        padding:0!important;
    }
    .aecc-logo-container,
    .aecc-doc-container {
        position: relative;
        overflow: hidden;
        border-radius:0;
    }
    .aecc-document-logo {
        position: absolute;
        top: -9999px;
        left: -9999px;
        right: -9999px;
        bottom: -9999px;
        margin: auto;
        border-radius:0!important;
    }
    .aecc-maps-container .pdfemb-viewer {
        height:180px!important;
        border-radius:0;
    }
    .aecc-maps-container iframe {
        max-height:180px!important;
        border-radius:0px;
    }
    .aecc-main-menu ul {
        padding:0 0 0 38px;
    }
    .aecc-main-menu ul li {
        width: 100%;
        padding: 0 15px ;
    }
    .aecc-main-menu ul li a {
        font-size:14px; 
    }
    .aecc-document-body {
        margin:15px 10px 0 0;
        border:solid 1px #f7f7f9;
        border-radius:10px;
        background:#f7f7f9;
        padding:1rem 1rem 1rem;
    }
    .aecc-search {
        margin:15px 10px 0 0;
    }
    .aecc-search .form-group {
        margin-bottom:0;
    }
    .row.aecc-search {
    padding: 15px;
    background: #f7f7f9;
    border-radius: 10px;
    }
    .row.aecc-search .form-group {
        width:30%;
    }
    .row.aecc-search input[type=text] {
        border:0;
        padding:5px 15px;
    }
    .row.aecc-search input[type=text]::placeholder {
        color:#a9a9a9;
        font-weight:500;
        letter-spacing:0.4px;
    }
    .aecc-search {
        display:none;
    }
    @media (min-width:992px) {
        .col-lg-3 {
            max-width:24%;
            padding:0;
        }
    }
    @media only screen and (min-width:481px) and (max-width:768px) {
        .aecc-img-file-row ul{
            margin:0 1.6rem !important;
        }
        .aecc-main-container {
            margin:0 1.6rem !important;
            flex:1 1 auto;
        }
    }
    @media only screen and (min-width:350px) and (max-width:480px) {
        .aecc-img-file-row ul{
            margin:0 1.6rem !important;
        }
        .aecc-main-container {
            margin:0 1.6rem !important;
            flex:1 1 auto;
        }
        .row.aecc-search .form-group {
            width:100%;
        }
    }
    </style>

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
            'id'       => 55,
            'taxonomy' => 'happyfiles_category',
            'parent'   => 0
        ) );

    ?>
    
    <div class="row">

    <div class="col-lg-3 col-md-12 col-sm-12 aecc-sidebar-container">
        <?php print_r(aecc_get_folders_with_layout($terms)); ?>
    </div>

    <div class="col-lg-9 col-md-12 col-sm-12 aecc-main-container">
    
    <div class="row aecc-search">
        <div class="form-group">
            <input type="text" class="form-control" id="media-search" placeholder="Type file name">
        </div>
    </div>

    <div class="row aecc-document-body" id="aecc-document-body">
        <h5 style="color: #949494;">Select a folder from the left sidebar</h5>
    </div>

    <div class="lightbox short-animate" id="aecc-"></div>
    <div id="lightbox-controls" class="short-animate"><a id="close-lightbox" class="long-animate" href="#!">Close Lightbox</a></div>

    </div><!-- .col-md-8 -->


    </div><!-- .row -->
    </div>

    <?php // echo do_shortcode('[pdf-embedder url="http://aio.codemeplz.com/wp-content/uploads/2020/09/2015-Generation-Map.pdf"]'); ?>

    <script>
    jQuery(document).ready(function($) {
        var width = $(window).width();
        var height = $(window).height();
        $('.lightbox .ead-iframe').css('cssText','height:100%!important;min-height:'+height+'px!important;');
    });
    </script>
<?php
get_footer();