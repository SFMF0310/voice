$(document).ready(function(){
    
//     $("#region").on("change", function(){
//         var reg = $(this).val();
// //alert(reg);
        
//         $.ajax({
//             type: "GET",
//             url: "/admin/choixreg/"+reg,
//             dataType: "json",
//             success: function(resultat){
//                 $("#departement").empty();
//                 $("#departement").append("<option value=''>Choisissez un département </option>");

//                 if(resultat.length != 0){
//                     $.each(resultat, function(i, val){
//                         $("#departement").append("<option value='"+val.id+"'> "+val.nom+" </option>");
//                     });
//                 } else{
//                     $("#departement").empty();
//                     $("#departement").append("<option value=''> Pas de département pour ce département </option>");
//                 }
//             },
//             error: function(){
//                 alert("Erreur, merci de contacter l'administrateur .");
//             }
//         });
//     });
    
    $("#departement").on("change", function(){
        var dept = $(this).val();
//        alert(dept);
        
        $.ajax({
            type: "GET",
            url: "/choixdept/"+dept,
            dataType: "json",
            success: function(resultat){
                $("#commune").empty();
                $("#commune").append("<option value=''> Choisissez une commune </option>");

                if(resultat.length != 0){
                    $.each(resultat, function(i, val){
                        $("#commune").append("<option value='"+val.id+"'> "+val.nom+" </option>");
                    });
                } else{
                    $("#commune").empty();
                    $("#commune").append("<option value=''> Pas de commune pour ce département </option>");
                }
            },
            error: function(){
                alert("Erreur, merci de contacter l'administrateur .");
            }
        });
    });

    //input aavec enter


    
    
    
    
    
    $("#commune").on("change", function(){
        var comm = $(this).val();
//        alert(comm);
        $.ajax({
            type: "GET",
            url: "/choixcomm/"+comm,
            dataType: "json",
            success: function(resultat){
                $("#localite").empty();
                $("#localite").append("<option value=''> Choisissez une localité </option>");
               
                if(resultat.length != 0){
                    $.each(resultat, function(i, val){
                        $("#localite").append("<option value='"+val.id+"'> "+val.nom+" </option>");
                        
                    });
                } else{
                    $("#localite").empty();
                    $("#localite").append("<option value=''> Pas de localité pour cette commune </option>");

                }
            },
            error: function(){
                alert("Erreur, merci de contacter l'administrateur d.");
            }
        });
    });

    
    return false;
});