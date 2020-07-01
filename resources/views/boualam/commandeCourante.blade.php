@extends('layouts.app') 
@section('content')
<!-- <button type="button" class="btn btn-secondary" data-dismiss="modal" onClick='notification()'>Notification</button> -->
     <section >
             <h1>Les commandes courantes</h1>
             
             <div class="tbl-header">
             
             <table class="col-12"cellpadding="0" cellspacing="0" border="0" width="100%">
                 <tr>
                      <th></th>
                      <th>CLIENT </th>
                      <th>Date_commande</th>
                      <th>Heure_commande</th>
                      <th></th>
                  </tr>
                  @foreach($list as $ls)       
                  <tr>
                    <td><span>{{$ls->nbr}}</span></td>
                    <td> {{$ls->client}} </td>
                    <td>{{$ls->datecom}}</td>
                     <form action="{{url('/produitsCourants')}}" method="post">
                    @csrf
                    <input type="hidden"  name="idCom" value='{{$ls->idCom}}' />
                    @php
                    $h=$ls->heurecom;
                    $heure=explode(":",$h);
                       echo '<td>'.$heure[0].':'.$heure[1].'</td>';
                    @endphp
                    <td><button id="myBtn" type='submit'>DETAILS</button></td>
                 </form> 
                 </tr>
                        
                @endforeach 
     </table>    
     </div>
           </section>

           <div id="pagination_container">
                 {{ $list->links() }}
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
function detail(idcom){
     
     //alert(7);
         
     
         axios
               .get('produitsCourants/'+idcom)
               .then(response =>$('#tbody').html(response.data))
         $('#details').modal();
     }




// When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
//   if (event.target == modal) {
//     modal.style.display = "none";
//   }
// }




$(window).on("load resize ", function() {
  var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
  $('.tbl-header').css({'padding-right':scrollWidth});
}).resize();
</script>
@endsection('javascript')





