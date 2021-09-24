$(document).ready(() => {
    let role = $('#role');
    let selectUser = $('#users');
    let structure = $('#structure').attr('hidden',true);
    let infosPersonnel = $('.info-personnel') ;
    let infoClient = $('.client');
    let inputsP = $('.info-personnel > input,select');
    let inputsC = $('.client > input');
    let selectstructure  = $('#selectstructure');


    selectUser.attr('hidden',true);
    infosPersonnel.attr('hidden',true);

    role.on('change',() =>{

        if (role.val() == 4) {
            selectUser.attr('hidden',true);
            infoClient.attr('hidden',true);
            structure.attr({hidden:false,required:true});
            infosPersonnel.attr({hidden:false});
            inputsP.attr({required:true});
            $('.role').attr({class:'col-md-6 role'});
        }else if(role.val() == 3){
            selectstructure.attr({hidden:true,required:false});
            selectUser.attr('hidden',true);
            infosPersonnel.attr('hidden',true);
            $('.prenom').attr({hidden:true,value:null,require:false});
            infoClient.attr({hidden:false,required:true});
            $('.role').attr({class:'col-md-6 role'});
            inputsC.attr({required:true})
        }
        else{
            structure.attr({hidden:true,required:false});
            inputsP.attr({required:true});
            infosPersonnel.attr({hidden:false,required:true});
            selectUser.attr('hidden',true);
            selectstructure.attr({hidden:true,required:false});
            $('.role').attr({class:'col-md-12 role'});
        }
    } )

});
