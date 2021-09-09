$('#test44').ready(function(){
    $("#test44").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            console.log(optionValue);
            if(optionValue){
                $(".box").not("." + optionValue).hide();
                $("." + optionValue).show();
            } else{
               // $(".box").hide();
            }
        });
    }).change();
});



$(document).ready(function() {

          // var valeur =$("#cacheur").val();
          // if ( valeur !='Commercant')
          // {
          //   $("#numero_compte").hide();
          //   //console.log('fdgggd');
          // }
          // else
          // {
          //   $("#numero_compte").show();
          //   //console.log('bakhoul');
          // }
       

});

$(document).ready(function(){
        var valeur =$("#cacheur").val();

        if ( valeur !='Commercant')
          {
            $("#numero_compte").hide();
            //console.log('fdgggd');
          }
          else
          {
            $("#numero_compte").show();
            //console.log('bakhoul');
          }

        $('#profilselector').on('change', function() {
          if ( this.value == 'Commercant')
          {
            $("#numero_compte").show();
          }
          else
          {
            $("#numero_compte").hide();
          }
        });
    });



