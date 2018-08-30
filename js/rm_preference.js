$(document).ready(function () {

    $('#page-wrapper').css('width', ($(document).width() - 350).toString() + 'px');

    $('.selectAll').click(function () {
        var ruleSelectorType = $(this).data('ruleselectortype');
        if($(this).prop('checked')){
            $('input[name=\''+ruleSelectorType+'\']').prop('checked', true);
        }else {
            $('input[name=\''+ruleSelectorType+'\']').prop('checked', false);
        }
    })

})
