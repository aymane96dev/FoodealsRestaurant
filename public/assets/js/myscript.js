const drop = document.querySelectorAll(".dropdownclick");
const dropDown = document.querySelector(".drop-down");
const downArrow = document.querySelector(".down");


drop.forEach(one => {
    one.addEventListener('click', () => {
        dropDown.classList.toggle('visible');
        downArrow.classList.toggle('Flip');
    })
}); 

document.body.addEventListener('click',(event)=>{
    if(!event.target.classList.contains('dropdownclick')){
        dropDown.classList.remove('visible');
        downArrow.classList.remove('Flip');
    }
})


// // Popups script

const popupBG = document.querySelector('.popupContainer');
const myProdDetailsBtns = document.querySelectorAll('.details-btn-my-products');
const productDetails = document.querySelector('.product-details')
const productDetailsCom = document.querySelector('.product-details')
const close_btn_details = document.getElementById('close-btn-details-popup');
const close_X = document.querySelectorAll('.close_X');
const add_post_btn = document.getElementById('add_post_btn');
const mod_profile = document.getElementById('mod_profile');
const add_product_popup = document.querySelectorAll('.add_product_popup');

const cancel_button_delete = document.querySelectorAll('.cancel_button_delete')
const delete_post_popup = document.querySelector('#delete_product_form')
const delete_icon_img_btn= document.querySelectorAll('.delete_icon_img_btn')



popupBG.addEventListener('click',(e)=>{
    if(e.target.classList.contains('popupContainer')){
        document.body.style.overflowY = 'scroll';
        popupBG.classList.remove('popupContainerShow')
        productDetails.classList.remove('popup-show')
        productDetailsCom.classList.remove('popup-show')
        delete_post_popup.classList.remove('popup-show')
        add_product_popup[0].classList.remove('popup-show');
        add_product_popup[1].classList.remove('popup-show');
    }
    
})



close_btn_details.addEventListener('click',()=>{
    document.body.style.overflowY = 'scroll';
    popupBG.classList.remove('popupContainerShow');
    productDetails.classList.remove('popup-show');
    productDetailsCom.classList.remove('popup-show');
    delete_post_popup.classList.remove('popup-show')

})
close_X.forEach(item=>{
    item.addEventListener("click",()=>{
        document.body.style.overflowY = 'scroll';
        popupBG.classList.remove('popupContainerShow');
        add_product_popup[0].classList.remove('popup-show');
        add_product_popup[1].classList.remove('popup-show');
        delete_post_popup.classList.remove('popup-show')

    })
})

add_post_btn.addEventListener('click',()=>{
    window.scroll(0,0);
    document.body.style.overflowY = 'hidden';
    popupBG.classList.add('popupContainerShow');
    delete_product_form.style.display='none';
    add_product_popup[0].classList.add('popup-show');
  

})

function show(idDet){ 
    window.scroll(0,0);
    document.body.style.overflowY = 'hidden';
    document.getElementById('Ddescription').innerHTML = document.getElementById('Description'+idDet).value;
    document.getElementById('prix_details').innerHTML = document.getElementById('Prix'+idDet).value+" DH";
    document.getElementById('prix_initial').innerHTML = document.getElementById('Prixini'+idDet).value+" DH";
    document.getElementById('product_name').innerHTML = document.getElementById('Name'+idDet).value;
    document.getElementById('date_debut').innerHTML = document.getElementById('DD'+idDet).value;
    document.getElementById('date_fin').innerHTML = document.getElementById('DF'+idDet).value;
    document.getElementById('qte').innerHTML = document.getElementById('Qte'+idDet).value;
    document.getElementById('qte_Commande').innerHTML = document.getElementById('qte_commander'+idDet).value;
    document.getElementById('qte_rester').innerHTML = document.getElementById('qte_rester'+idDet).value;
    popupBG.classList.add('popupContainerShow');
    productDetails.classList.add('popup-show');

    
    add_product_popup[0].classList.remove('popup-show');
    add_product_popup[1].classList.remove('popup-show');
     delete_post_popup.classList.remove('popup-show')
     delete_product_form.style.display='none';
}

//-------------------------------------------------
function showCom(idDet){ 
    //window.scroll(0,0);
    //document.body.style.overflowY = 'hidden';
    popupBG.classList.add('popupContainerShow');
    productDetailsCom.classList.add('popup-show');
    delete_product_form.style.display='none';
}

const showEdit = (id)=>{
    var found=0;
    window.scroll(0,0);
    document.body.style.overflowY = 'hidden';
    popupBG.classList.add('popupContainerShow');
    add_product_popup[1].classList.add("popup-show")
    delete_post_popup.classList.remove('popup-show')
    delete_product_form.style.display='none';
// --------------------------------
$('#mfield1').val("");
$('#mprixop1').val("");
$('#mfield2').val("");
$('#mprixop2').val("");
$('#mfield3').val("");
$('#mprixop3').val("");
$('#mfield4').val("");
$('#mprixop4').val("");
$('#mfield5').val("");
$('#mprixop5').val("");
//----------------------------------------
    var Name=$('#Name'+id).val();
    var Idr=$('#Id'+id).val();
    var HD=$('#HD'+id).val();
    var DD=$('#DD'+id).val();
    var DF=$('#DF'+id).val();
    var HF=$('#HF'+id).val();
    var MF=$('#MF'+id).val();
    var MD=$('#MD'+id).val();
    var Prix=$('#Prix'+id).val();
    var type=$('#type'+id).val();
    var Prixini=$('#Prixini'+id).val();
    var Qte=$('#Qte'+id).val();
    var Description=$('#Description'+id).val();
    var Livraison=$('#livraison'+id).val();
    var Plusl=$('#plusl'+id).val();

    var place=$('#radop0'+id).val();
    var emporter=$('#radop1'+id).val();
    var libre=$('#radop2'+id).val();
    //alert(place);
    if(place==1){
        $('#mplace').prop("checked", true);
    }
    else if(emporter==1){
        $('#memporter').prop("checked", true);
    }
    else if(libre==1){
        $('#mlibre').prop("checked", true);
    }
    var op1=$('#field1'+id).val();
    var prixop1=$('#prixop1'+id).val();

    var op2=$('#field2'+id).val();
    var prixop2=$('#prixop2'+id).val();

    var op3=$('#field3'+id).val();
    var prixop3=$('#prixop3'+id).val();

    var op4=$('#field4'+id).val();
    var prixop4=$('#prixop4'+id).val();

    var op5=$('#field5'+id).val();
    var prixop5=$('#prixop5'+id).val();


   
    if(HD.length==1){
        HD="0"+HD
    }
    if(MD.length==1){
        MD="0"+MD
    }
    if(HF.length==1){
        HF="0"+HF
    }
    if(MF.length==1){
        MF="0"+MF
    }
    $('#idr').val(Idr);
    $('#product-title1').val(Name);
    $('#product-Date-debut1').val(DD);
    $('#product-Heur-deput1').val(HD+":"+MD);
    $('#product-Date-fin1').val(DF);
    $('#product-Heur-de-fin1').val(HF+":"+MF);
    $('#product-type1').val(type);
    $('#product-prix-de-vent1').val(Prix);
    $('#product-prix-initial1').val( Prixini);
    $('#product-qte1').val(Qte);
    $('#product-description1').val(Description);
    if(Livraison === '1'){
        $('#produit_livraison1').css('visibility','visible');
        $('#LivraisonEdit1').prop('checked',true);
        $('#produit_livraison1').val(Plusl);
    }else{
        $('#produit_livraison1').css('visibility','hidden');
        $('#LivraisonEdit1').prop('checked',false);
        $('#produit_livraison1').val();
    }

if(op1.length==0)
{
    $('#mfield1').hide();
    $('#mprixop1').hide();
    found++;
}
else
{
    $('#mfield1').show();
    $('#mprixop1').show();
    $('#mfield1').val(op1);
    $('#mprixop1').val(prixop1);
}
if(op2.length==0)
{
    found++;
    $('#mfield2').hide();
    $('#mprixop2').hide();
}
else
{
    $('#mfield2').show();
    $('#mprixop2').show();
    $('#mfield2').val(op2);
    $('#mprixop2').val(prixop2);
}
if(op3.length==0)
{
    found++;
    $('#mfield3').hide();
    $('#mprixop3').hide();
}
else
{
    $('#mfield3').show();
    $('#mprixop3').show();
    $('#mfield3').val(op3);
    $('#mprixop3').val(prixop3);
}
if(op4.length==0)
{
    found++;
    $('#mfield4').hide();
    $('#mprixop4').hide();
}
else
{
    $('#mfield4').show();
    $('#mprixop4').show();
    $('#mfield4').val(op4);
    $('#mprixop4').val(prixop4);
}
if(op5.length==0)
{
    found++;
    $('#mfield5').hide();
    $('#mprixop5').hide();
}
else
{
    $('#mfield5').show();
    $('#mprixop5').show();
    $('#mfield5').val(op5);
    $('#mprixop5').val(prixop5);
}
$(document).ready(function(){
      $(".add-moreM").click(function(e){
            $('#mfield'+(6-found)).val("");
            $('#mprixop'+(6-found)).val("");
            $('#mfield'+(6-found)).show();
            $('#mprixop'+(6-found)).show();
          found--;
      });
    });
}
function showEditprofile(id){
    window.scroll(0,0);
    document.body.style.overflowY = 'hidden';
    popupBG.classList.add('popupContainerShow');
    mod_profile.classList.add("popup-show");

    var email=$('#email').val();
    var tele=$('#tele').val();
    var description=$('#Description').val();
   
    $('#memail').val(email);
    $('#mtele').val(tele);
    $('#mdescription').val(description);

}
//--------------------

function deleteProduct(cmp){
   
    document.getElementById('delete_id_popup').value=$('#Id'+cmp).val()
    add_product_popup[0].classList.remove('popup-show');
    add_product_popup[1].classList.remove('popup-show');
    popupBG.classList.add('popupContainerShow')
    axios
    .get('poduitDeleted/'+$('#Id'+cmp).val())
    .then(response =>$('#tbody').html(response.data))

    delete_post_popup.classList.add('popup-show')
}


function annulerProd(id){
    axios
    .get('annulerProd/'+id)
    .then(response =>(response.data))
}

function supprimerProd(id){
    axios
    .get('supprimerProd/'+id)
    .then(response =>(response.data))
}

cancel_button_delete.forEach(item =>{
    item.addEventListener("click",()=>{
        popupBG.classList.remove('popupContainerShow')
        delete_post_popup.classList.remove('popup-show')
    })
})



//-----------------------------

 
$('#product-Date-debut1, #product-Date-fin1, #product-Heur-deput1, #product-Heur-de-fin1').on("change",function () {
    var dateMDe=$('#product-Date-debut1').val();
    var dateMFi=$('#product-Date-fin1').val();
    var dateMHD=$('#product-Heur-deput1').val();
    var dateMHF=$('#product-Heur-de-fin1').val();
    var prixM=$('#product-prix-initial1').val();
    var prixiniM=$('#product-prix-de-vent1').val();
   
    
    //alert(dateDe+" "+dateHD);
   
    if(prixM>=prixiniM)
    {
        $('#messageM').html('Prix incorrecte').css('color', 'red');
        $('#add_post_btn').hide();
    }
    if(prixM<prixiniM){
        $('#messageM').html('').css('color', 'red');
        $('#add_post_btn').hide();
    }
    if(Date.parse(dateMDe)>Date.parse(dateMFi))
    {
        $('#messageMDate').html('Date incorrecte').css('color', 'red');
        $('#add_post_btn').hide();
    }
    if(Date.parse(dateMHD)>Date.parse(dateMHF))
    {
        $('#messageMHeure').html('Heure incorrecte').css('color', 'red');
        $('#add_post_btn').hide();
    }
    if(Date.parse(dateMDe)<Date.parse(dateMFi)){
        $('#add_post_btn').show();
        $('#messageMDate').html('');
    }
    if(Date.parse(dateMHD)<Date.parse(dateMHF))
    {
        $('#add_post_btn').show();
        $('#messageMHeure').html('');
    }
    });
   
   
    //------------------------------------
   
   
    $('#product-date-debut,#product-Date-fin,#product-Heur-deput,#product-Heur-de-fin,#product-prix-initial,#product-prix-de-vent,#field1,#field2,#field3,#field4,#field5,#prixop1,#prixop2,#prixop3,#prixop4,#prixop5').on("change",function () {
       var dateADe=$('#product-date-debut').val();
       var dateAFi=$('#product-Date-fin').val();
       var dateAHD=$('#product-Heur-deput').val();
       var dateAHF=$('#product-Heur-de-fin').val();
       var prix=$('#product-prix-initial').val();
       var prixini=$('#product-prix-de-vent').val();
       var op1=$('#mfield1').val();
       var op2=$('#mfield2').val();
       var op3=$('#mfield3').val();
       var op4=$('#mfield4').val();
       var op5=$('#mfield5').val();
       var prixop1=$('#mprixop1').val();
       var prixop2=$('#mprixop2').val();
       var prixop3=$('#mprixop3').val();
       var prixop4=$('#mprixop4').val();
       var prixop5=$('#mprixop5').val();
      
    
       //alert(dateDe+" "+dateHD);
       if(prix<prixini){
           $('#message').html('').css('color', 'red');
           $('#add_post_btn').hide();
       }  
       
       if(prix>=prixini)
       {
           $('#message').html('Prix incorrecte').css('color', 'red');
           $('#add_post_btn').hide();
       }
      
       if(Date.parse(dateADe)>Date.parse(dateAFi))
       {
           $('#messageDate').html('Date incorrecte').css('color', 'red');
           $('#add_post_btn').hide();
       }
       
       if(Date.parse(dateADe)<Date.parse(dateAFi)){
        $('#add_post_btn').show();
        $('messageDate').html('');
    }
       if(Date.parse(dateADe)==Date.parse(dateAFi)){
       if(Date.parse(dateAHD)>Date.parse(dateAHF))
       {
           $('#messageHeure').html('Heure incorrecte').css('color', 'red');
           $('#add_post_btn').hide();
       }}
       if(Date.parse(dateADe)<Date.parse(dateAFi)){
           $('#add_post_btn').show();
           $('messageDate').html('');
       }
   
       if(Date.parse(dateADe)==Date.parse(dateAFi)){
       if(Date.parse(dateAHD)<Date.parse(dateAHF))
       {
           $('#add_post_btn').show();
           $('#messageHeure').html('');
       }}
       });
 //------------------------------------

// $('#password1, #password2').on('keyup', function () {
// var password1=$('#password1').val();
// var password2=$('#password2').val();
// // alert(password1);
// if (password1 == password2) {
// $('#message').html('ok').css('color', 'green');
// $('#submit').show();
// } 
// if (password1 != password2) {
// $('#message').html('n\'est pas compatible').css('color', 'red');
// $('#submit').hide();
// }
//  });



 //------------------------------------
 function checking(id) {
    //alert('555');
    let timerInterval
Swal.fire({
title: 'loading ...',
html: '',
timer: 1000,
onBeforeOpen: () => {
Swal.showLoading()
timerInterval = setInterval(() => {
}, 100)
},
onClose: () => {
clearInterval(timerInterval)
}
}).then((result) => {
if (
result.dismiss === Swal.DismissReason.timer
) 
{
console.log('I was closed by the timer')
}
})
var idp=$('#Id'+id).val();
  axios.get('/afficheModel/'+idp)
    .then(response =>{ let message = response.data;
       if (message == 1){
        var Idr=$('#Id'+id).val();
            $('#idrA').val(Idr);
          //  alert(id);
            $('#idCancel').modal();
}
    else
    modifier(id)
    }) 
}



//-----------------------------
function myFunction() {
    axios.get('/cpt_com')
        $('.dropdown').toggle( 40 );
}

// ---------------------------------








/*----------------------------------*/

// jQuery & Velocity.js

function slideUpIn() {
    $("#login").velocity("transition.slideUpIn", 1250)
  };
  
  function slideLeftIn() {
    $(".row").delay(500).velocity("transition.slideLeftIn", {stagger: 500})    
  }
  
  function shake() {
    $(".password-row").velocity("callout.shake");
  }
  
  slideUpIn();
  slideLeftIn();
  $("button").on("click", function () {
    shake();
  });
  