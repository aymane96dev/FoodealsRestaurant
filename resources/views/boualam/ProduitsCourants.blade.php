@extends('layouts.app') 
@section('content')
<!-- <button type="button" class="btn btn-secondary" data-dismiss="modal" onClick='notification()'>Notification</button> -->
     <section>
            <!-- <h1>Les commandes courantes</h1>-->
             
             <div class="tbl-header">
             <table class="col-12"cellpadding="0" cellspacing="0" border="0" width="100%">
                 <div class="row justify-content-end">
                     <div class="col-6">

                     </div>
                 </div>
                 <tr>
                      <th>Produit</th>
                      <th>Qte demandé</th>
                      <th>Description</th>
                      <th>Date collecte</th>
                      <th>Heure collecte</th>
                     <th>état</th>
                     <th>prix de livraison</th>
                     <th>adresse de livraison</th>
                     <th>telephone de livraison</th>
                     <th>détails d'option</th>
                  </tr>

                  @foreach($listP as $ls)       
                  <tr>
                    <td>{{$ls->namepr}}</td>
                    <td> {{$ls->qtedet}} </td>
                    <td>{{$ls->descpr}}</td>
                    <td>{{$ls->datecollecte}}</td>
                    @php
                    $h=$ls->hcollecte;
                    $heure=explode(":",$h);
                       echo '<td>'.$heure[0].':'.$heure[1].'</td>';
                    @endphp
                    <td>@if($ls->surplace === '1') sur place @elseif($ls->emportée === '1') emportée @elseif($ls->livrée === '1') livrée @endif</td>
                    <td>{{ $ls->plusl }}</td>
                    <td>{{ $ls->adressel }}</td>
                    <td>{{ $ls->telephonel }}</td>
                    <td><button type="button" class="details-btn-my-products" onclick="showoptions('{{$ls->namepr}}','{{$ls->descpr}}','{{ $ls->prix1 }}','{{ $ls->prix2 }}','{{ $ls->prix3 }}'
                                ,'{{ $ls->prix4 }}','{{ $ls->prix5 }}','{{ $ls->option1 }}','{{ $ls->option2 }}','{{ $ls->option3 }}','{{ $ls->option4 }}','{{ $ls->option5 }}')">
                            les options
                        </button></td>
                  </tr>
                        
                @endforeach 
     </table>

     </div>
           </section>

           <div id="pagination_container">
                 {{ $listP->links() }}
           </div>      
     </div>
           </section>
                 </div>
                
               </div>
             </div>
           </div>
     </div>
  

      <!-- Modal content -->
<div class="popupContainer">

    <div class="product-details">
        <div>
        <!-- <div>
                <span id="prix_details"></span>
                <span id="prix_initial"></span>
            </div> -->
        </div>

        <h2 id="product_name"></h2>
        <p id="Ddescription"></p>
        <div>
            <table >
                <tr>
                    <th id="des_option1"></th>
                    <td id="option1"></td>
                </tr>
                <tr>
                    <th id="des_option2"></th>
                    <td id="option2"></td>
                </tr>
                <tr>
                    <th id="des_option3"></th>
                    <td id="option3" ></td>
                </tr>
                <tr>
                    <th id="des_option4"></th>
                    <td id="option4" ></td>
                </tr>
                <tr>
                    <th id="des_option5"></th>
                    <td id="option5" ></td>
                </tr>
            </table>
        </div>
        <div class="close_btn_contaienr">
            <button id="close-btn-details-popup">Fermer</button>
        </div>
    </div>
</div>

@endsection('content') 
<!-- @section('style')




@endsection('style')  -->
@section('javascript')
<script>

    const popupBG = document.querySelector('.popupContainer');
    const productDetails = document.querySelector('.product-details');

    function showoptions(name,des,prix1,prix2,prix3,prix4,prix5,options1,options2,options3,options4,options5){
        window.scroll(0,0);
        document.body.style.overflowY = 'hidden';
      //  document.getElementById('Ddescription').innerHTML = document.getElementById('Description'+idDet).value;
      popupBG.classList.add('popupContainerShow');
        productDetails.classList.add('popup-show');
        $("#product_name").html(name);
        $("#Ddescription").html(des);
        if(options1 !== ""){
            $("#des_option1").html(options1);
            $("#option1").html(prix1);
        }
        if(options2 !== ""){
            $("#des_option2").html(options2);
            $("#option2").html(prix2);
        }
        if(options3 !== ""){
            $("#des_option3").html(options3);
            $("#option3").html(prix3);
        }
        if(options4 !== ""){
            $("#des_option4").html(options4);
            $("#option4").html(prix4);
        }
        if(options4 !== "") {
            $("#des_option5").html(options5);
            $("#option5").html(prix5);
        }
    }

    const close_btn_details = document.getElementById('close-btn-details-popup');

    close_btn_details.addEventListener('click',()=>{
        document.body.style.overflowY = 'scroll';
        popupBG.classList.remove('popupContainerShow');
        productDetails.classList.remove('popup-show');
        productDetailsCom.classList.remove('popup-show');
        delete_post_popup.classList.remove('popup-show')

    });



// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}




$(window).on("load resize ", function() {
  var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
  $('.tbl-header').css({'padding-right':scrollWidth});
}).resize();
</script>
@endsection('javascript')





