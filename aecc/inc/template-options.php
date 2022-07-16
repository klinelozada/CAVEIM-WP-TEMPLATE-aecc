<?php

class AECC_THEME_OPTIONS {

    public function __construct()
	{
        add_action( 'admin_menu', array( &$this, 'aeccThemeOptionMenu') );
        add_action( 'admin_enqueue_scripts', array( &$this, 'aeccEnqueue') );
        add_action( 'wp_ajax_aeccThemeOptionSave', array( &$this, 'aeccThemeOptionSave') );
    }

    public function aeccEnqueue()
    {
        wp_enqueue_script( 'aecc-ajax', get_template_directory_uri() . '/js/theme-option.js', array('jquery') );
        wp_localize_script(
            'aecc-ajax',
            'aecc_ajax_object',
            array(
                'aecc_ajax_url'  => admin_url( 'admin-ajax.php' )
            )
        );
    }

	public function aeccThemeOptionMenu()
	{
        add_submenu_page(
            'themes.php',
            'AECC Theme Options',
            'AECC Theme Options',
            'manage_options',
            'aecc-theme-options',
            array(&$this,'aeccThemeOptionPage'),
            '',
            3
        );
	}

	public function aeccThemeOptionPage()
	{
		?>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">
        <style>
            .aecc-form small {
                display:block;
                margin-bottom:5px;
            }
            .aecc-form hr {
                margin:10px 0;
            }
            .aecc-submit {
                width:auto;
            }
        </style>

        <?php
            // Get Option Value
            $aeccOption = get_option('aecc_layout');
            $homepageLayout = $aeccOption['aecc_options']['homepage_layout'];
        ?>
        
        <div class="container-fluid">
            <div class="row">
                
                <div class="col-md-12">
                    <h1>AECC Theme Options</h1>
                </div>
                <!-- .col-md-12 -->

                <div class="col-md-6">

                    <!-- General Settings -->
                    <label for="urls"><i class="fas fa-route"></i> General Settings</label><hr>

                    <!-- Settings: Homepage Layout -->
                    <div class="form-group">
                        <small>Homepage Layout</small>
                        <select name="" id="homepage-layout" class="form-control">
                            <option value="">Select Layout</option>
                            <option value="icon-only" <?php echo ($homepageLayout == 'icon-only' ? 'selected="selected"' : '' ); ?> >Icon Only</option>
                            <option value="featured-image-only" <?php echo ($homepageLayout == 'featured-image-only' ? 'selected="selected"' : '' ); ?> >Featured Image Only</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary form-control aecc-submit" id="aecc-submit-ajax">Submit</button>
                    </div>

                    <div class="result"></div>
                </div>
                <!-- .col-md-6 -->

            </div>
            <!-- .row -->
        </div>
        <!-- .container-fluid -->
        
		<!-- Font Awesome Pro Kit -->
		<script src="https://kit.fontawesome.com/f4bc91b179.js" crossorigin="anonymous"></script>
        
        <!-- Bootstrap JS -->
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		<?php
    }

    public function aeccThemeOptionSave() {

        $data_options = array(
            'aecc_options'=>array(
                'homepage_layout'    => $_POST['layout'],
            ),
        );

        update_option('aecc_layout', $data_options);

        $aeccOption = get_option('aecc_layout');

        $option = json_decode($aeccOption, true);

        return $data_options;

        // print_r($aeccOption);

        die();
    }

}
new AECC_THEME_OPTIONS();