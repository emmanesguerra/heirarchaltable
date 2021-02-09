/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if($('#hidebtn').length > 0) {
    $('#hidebtn').on('click', function () {
        var value = $(this).data('val');
        if(value) {
            $(this).data('val', 0);
            $(this).html('Show');
            $('#origdata').css('display', 'none');
        } else {
            $(this).data('val', 1);
            $(this).html('Hide');
            $('#origdata').css('display', '');
        }
    });
}

if($('.expand').length > 0) {
    $('.expand').each(function(index, element) {
        $(element).on('click', function () {
            var value = $(this).data('val');
            var parent = $(this).parent();
            if(value) {
                $(this).data('val', 0);
                parent.children('ul').css('display', 'none');
            } else {
                $(this).data('val', 1);
                parent.children('ul').css('display', 'block');
            }
        });
        
    });
}