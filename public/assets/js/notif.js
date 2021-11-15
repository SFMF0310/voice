$('.btnmarkAsRead').click(() => {
    var btn = $('.btnmarkAsRead:focus')
    let id = btn.attr('data-id')
    $.ajax({
        url : "/admin/markAsRead/"+id,
        method: 'GET',
        // data:{
        //     token,
        //     id
        // },
        dataType:'JSON',
        success :  (res) => {
            // alert(res.message)

            if(res.message === 'success'){
                var alertdiv = $('#'+res.id);
                btn.attr({hidden:true});
                alertdiv.attr({class : 'alert alert-secondary'});
                


            }
                // alert(res.message);


        }
    })
    // alert(id);
})
