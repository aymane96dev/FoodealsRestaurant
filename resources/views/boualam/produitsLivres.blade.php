@extends('layouts.app') 
@section('content')
<!-- <button type="button" class="btn btn-secondary" data-dismiss="modal" onClick='notification()'>Notification</button> -->
     <section>
            <!-- <h1>Les commandes courantes</h1>-->
             
             <div class="tbl-header">
             
             <table class="col-12"cellpadding="0" cellspacing="0" border="0" width="100%">
                 <tr>
                     
                      <th>Produit</th>
                      <th>Qte demandé</th>
                      <th>Description</th>
                      <th>Date collecte</th>
                      <th>Heure collecte</th>
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
 

@endsection('content') 
<!-- @section('style')




@endsection('style')  -->
@section('javascript')
<script>





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





