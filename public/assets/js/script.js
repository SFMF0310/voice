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
// $(document).ready(function(){
//           $('[data-toggle="tooltip"]').tooltip({delay: { "show": 500, "hide": 100 },
//           template:"<div class='tooltip' role='tooltip'><div class='arrow'></div><div class='tooltip-inner'></div></div>"});
//         });

document.addEventListener("DOMContentLoaded", function(event) {

    const showNavbar = (toggleId, navId, bodyId, headerId) =>{
    const toggle = document.getElementById(toggleId),
    nav = document.getElementById(navId),
    bodypd = document.getElementById(bodyId),
    headerpd = document.getElementById(headerId)
    // header2pd = document.getElementById(headerId2)


    // Validate that all variables exist
    if(toggle && nav && bodypd && headerpd){
    toggle.addEventListener('click', ()=>{
    // show navbar
    nav.classList.toggle('show')
    nav.classList.toggle('lnav')
    // change icon
    toggle.classList.toggle('bx-x')
    // add padding to body
    bodypd.classList.toggle('body-pd')
    // add padding to header
    headerpd.classList.toggle('body-pd')
    // header2pd.classList.toggle('body-pd')
    })
    }
    }

    showNavbar('header-toggle','nav-bar','body-pd','header')

    /*===== LINK ACTIVE =====*/
    const linkColor = document.querySelectorAll('.nav_link')

    function colorLink(){
    if(linkColor){
    linkColor.forEach(l=> l.classList.remove('active'))
    this.classList.add('active')
    }
    }
    linkColor.forEach(l=> l.addEventListener('click', colorLink))

    // Your code to run since DOM is loaded and ready
    });

    
                            function buy(btn) {
                                let idTransaction = pQuery(btn).attr('data-item-id');
                                let commandName = pQuery(btn).attr('item-name');
                                let commandPrice = pQuery(btn).attr('item-price');
                                let client = pQuery(btn).attr('client');
                                


                                // alert(itemname); 
                                (new PayTech({
                                     //will be sent to paiement.php page
                                    // idPack          : idTransaction,
                                    pack            : commandName,
                                    price           : commandPrice ,
                                    client          : client,
                                    

                                })).withOption({
                                    requestTokenUrl           :   'http://127.0.0.1:8000/admin/packs/paiement',
                                    method              :   'GET',
                                    headers             :   {
                                        // "Accept"          :    "text/html"
                                    },
                                    prensentationMode   :   PayTech.OPEN_IN_POPUP,
                                    willGetToken        :   function () {
                                       
                                    },
                                    didGetToken         : function (token, redirectUrl) {
                                       
                                    },
                                    didReceiveError: function (error) {
                                        // console.log(error);
                                    },
                                    didReceiveNonSuccessResponse: function (jsonResponse) {
                                        //console.log(jsonResponse);
                                    }
                                }).send();
                        
                                // .send params are optional
                            }

