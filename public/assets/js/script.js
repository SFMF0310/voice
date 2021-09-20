$(document).ready(() => {
    let selectUser = $('#users');
    let inputs = $('.info-personnel') ;
    inputs.attr('hidden',true)
    $('#role').on('change',() =>{

        if ($('#role').val() == 4) {
                selectUser.attr('hidden',true);
                inputs.attr('hidden',false)


        }
        else{
            inputs.attr('hidden',true)
            selectUser.attr('hidden',false);
        }
    } )

});
