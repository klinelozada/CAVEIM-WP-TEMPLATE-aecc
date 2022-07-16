jQuery(document).ready(function($) {
    
    // Search Bulk Reupload
    $( "body" ).on( "click", "#aecc-submit-ajax", function() {

        var layout_val = $('#homepage-layout').val();

        $.ajax({
            type: "POST",
            url: aecc_ajax_object.aecc_ajax_url,
            data : {
                action: 'aeccThemeOptionSave',
                layout : layout_val
            },
            success: function(response) {
                
                console.log(response);
                $('.result').append('<div class="alert alert-success" role="alert">Settings has been saved!</div>').fadeIn('slow');                
                setTimeout(function(){
                    $('.result').fadeOut(500, function() {
                        $(this).empty().show();
                     });
                }, 2000);
                
            }
        });

    });
    
});