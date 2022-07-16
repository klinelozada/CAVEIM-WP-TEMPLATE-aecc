jQuery( document ).ready(function($) {
    // 
    //  Lightbox
    // 
    $('#close-lightbox').on('click',function(){
        $(".lightbox.short-animate").attr('id','aecc-');
        $(".lightbox.short-animate").empty();
    });

    $('.aecc-docs-link').on('click', function(){

        var did = $(this).data('id');
        var dtype = $(this).data('type');
        // console.log(dtype + ' - ' + did);

        $.ajax({
            type: "POST",
            url: ajax_object.ajax_url,
            data : {
                action: 'lightbox_request',
                id : did,
                type : dtype
            },
            success: function(response) {
                
                if(response !== 'noshow') {
                    $(".lightbox.short-animate").attr('id','aecc-'+dtype+'-'+did);
                    $('.lightbox.short-animate').empty();
                    $('.lightbox.short-animate').append(response);
                }

            }
        });
    });



});

jQuery(function ($) {

    $( "body" ).on( "click", ".iv-parent.inactive a", function(e) {
        e.preventDefault();
        $('.aecc-search').fadeIn('slow');
        $(this).parent().parent().find('li').removeClass('active');
        $(this).parent().parent().find('li').addClass('inactive');
        $(this).parent().parent().find('i').removeClass('fa-folder-open').addClass('fa-folder');
        $(this).parent().parent().find('ul.iv-child').slideUp('slow');
        
        $(this).parent().removeClass('inactive');
        $(this).parent().addClass('active');

        $(this).find('i').removeClass('fa-folder').addClass('fa-folder-open');
        $(this).siblings('ul.iv-child').slideDown('slow');
        var did = $(this).data('id');
        getAllFiles(did);
    });

    $( "body" ).on( "click", ".iv-child li.inactive a", function(e) {
        e.preventDefault();
        $('.aecc-search').fadeIn('slow');
        $(this).parent().removeClass('inactive');
        $(this).parent().addClass('active');
        $(this).parent().find('i').removeClass('fa-folder').addClass('fa-folder-open');
        $(this).siblings('ul.iv-child').slideDown('slow');
        var did = $(this).data('id');
        getAllFiles(did);
    });

    $( "body" ).on( "click", ".iv-parent.active a", function(e) {
        e.preventDefault();
        $('#aecc-document-body').empty();
        $('#aecc-document-body').append('<h5 style="color: #949494;">Select a folder from the left sidebar</h5>');
        $(this).parent().removeClass('active');
        $(this).parent().addClass('inactive');
        $(this).find('i').removeClass('fa-folder-open').addClass('fa-folder');
        $(this).siblings('ul.iv-child').slideUp('slow');
    });

    $( "body" ).on( "click", ".iv-child li.active a", function(e) {
        e.preventDefault();
        $('#aecc-document-body').empty();
        $(this).parent().removeClass('active');
        $(this).parent().addClass('inactive');
        $(this).find('i').removeClass('fa-folder-open').addClass('fa-folder');
        $(this).siblings('ul.iv-child').slideUp('slow');
    });

    function getAllFiles(did) {
        
        $.ajax({
            type: "POST",
            url: ajax_object.ajax_url,
            data : {
                action: 'aecc_files_request',
                id : did,
            },
            success: function(response) {
                // console.log(response);
                $('#aecc-document-body').empty();
                $('#aecc-document-body').append(response).hide().fadeIn(1000);
            }
        });

    }

});
