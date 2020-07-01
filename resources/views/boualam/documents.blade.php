@extends('layouts.app') 
@section('content')
<button type="button" class="btn btn-info2 mb-2 btn-circle btn-xl"  data-toggle="modal" data-target="#ajouterDocument"><span style="font-size: 35px; text-align: center;">+</span></button>
<section >
        <h1>Liste des documents</h1>
        <div class="tbl-header">
          <table class="col-12"cellpadding="0" cellspacing="0">
            <thead>
              <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Fichier</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
        <div class="tbl-content">
          <table cellpadding="0" cellspacing="0">
            <tbody>
     @php $cnt=1;  @endphp 
        @foreach($list as $doc)
            <input type="hidden" id="Id{{$cnt}}" value="{{$doc->id}}">   
            <input type="hidden" id="titre{{$cnt}}" value="{{$doc->titre}}">
            <input type="hidden" id="description{{$cnt}}" value="{{$doc->description}}">
            <input type="hidden" id="fichier{{$cnt}}" value="{{$doc->fichier}}">
            <tr>
                <td>{{$doc->titre}}</td>
                <td>{{$doc->description}} </td>
                <td>
                <button class="btn btn-primary" >Parcourir</button>
                </td>
                <td>
               <!-- <form action="{{route('document.destroy',['id'=>$doc->id])}}" method="post">
                @csrf
                @method('delete')-->
                <button class="btn btn-primary" onClick='supprimer({{$doc->id}})'>Supprimer</button>
               <!-- </form>-->
                </td>
               
            </tr>
                @php $cnt++; @endphp 
                @endforeach
            </tbody>
          </table>
        </div>
    <div class="d-flex justify-content-center mt-5">
        {{$list->links()}}
    </div> 
</div>
</section>
      



<form action="{{route('addDocument.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="ajouterDocument" tabindex="-1" role="dialog" aria-labelledby="ajouterDocument" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ajouterDocument">Ajouter document</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Titre</label>

                            <input type="text" class="form-control @if($errors->get('titre')) is-invalid  @endif" name="titre" value="{{old('titre')}}"


                                placeholder="Titre"> @foreach ($errors->get('titre') as $error)
                            <div class="invalid-feedback">
                                {{$error}}
                            </div>
                            @endforeach
                        </div>
                        <div class="form-group col-md-12">

                        
            <label for="message-text" class="col-form-label">Description:</label>
            <textarea class="form-control @if($errors->get('description')) is-invalid @endif" id="adresseinput" name="description"  placeholder="Description">{{old('description')}}</textarea>
            @foreach ($errors->get('description') as $error)
            <div class="invalid-feedback">
            {{ $error }}
        </div>
             @endforeach
          </div>
                       <div class="form-group col-md-12">
                            <label for="recipient-name" class="col-form-label">Fichier:</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input  @if($errors->get('fichier')) is-invalid  @endif" id="validatedCustomFile" name="fichier">
                                <label class="custom-file-label" for="validatedCustomFile">Choose File...</label>
                                @foreach ($errors->get('fichier') as $error)
                           
                            <div class="invalid-feedback">{{$error}}</div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                          
                       
                 
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submit">Save</button>
                </div>
              



    </div>
</form>


@endsection('content') 
@section('style')
<style>
    .btn-circle.btn-xl {
        width: 70px;
        height: 70px;
        padding: 10px 16px;
        font-size: 24px;
        line-height: 1.33;
        border-radius: 35px;
        border:none;
        position: absolute;
        right: 15%;
        top: 54px;
    }
    .btn-circle.btn-xl:hover{
        background: #25ba7b;
    }
  
    .editBTN{
        padding: 10px 10px;
        cursor: pointer;
        outline:none;
    } 
h1{
  font-size: 30px;
  color: #fff;
  text-transform: uppercase;
  font-weight: 300;
  text-align: center;
  margin-bottom: 15px;
  margin-top: 25px;
}
table{
  width:100%;
  table-layout: fixed;
}
.tbl-header{
  background-color: rgba(255,255,255,0.3);
 }
.tbl-content{
  height:500px;
  overflow-x:auto;
  margin-top: 0px;
  border: 1px solid rgba(255,255,255,0.3);
}
th{
  padding: 18px 0px;
  text-align: left;
  font-weight: 700;
  font-size: 13px;
  color: #fff;
  text-transform: uppercase;
}
td{
  padding-left: 5px;
  padding-top: 8px;
  padding-right: 8px;

  text-align: left;
  vertical-align:middle;
  font-weight: 600;
  font-size: 14px;
  color: #fff;
  border-bottom: solid 1px rgba(255,255,255,0.1);
  /* display:flex */
}
tr td:nth-child(10){
    display: flex;
    align-items: baseline;

}

tr td:nth-child(10) button:nth-child(1){
    margin-right:2px ;
    background: #fff;
    color:#25c481;
    border:none;
    margin-left: -45px;
}
tr td:nth-child(10) button:nth-child(2){
    background:transparent;
    color:#fff;
    border:2px solid #fff
}

tr td:nth-child(9) button:nth-child(1){
    background:transparent;
    color:#fff;
    border:2px solid #fff;

}

@import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);

section{
  margin: 0 20px 50px 20px;
}


.modal-body, .modal-header, .modal-footer{
    background: -webkit-linear-gradient(left, #25c481, #25b7c4);
    background: linear-gradient(to right, #25c481, #25b7c4);

}

</style>
@endsection('style') 
@section('javascript')


<script>
/*function supprimer(cmp) {
  var id=$('#Id'+cmp).val();
        // alert(id);
        axios
          .post('DocumentDeleted/'+id)
          .then(response =>(response.data))
}*/
function supprimer(cmp) {
  //alert(cmp);
    Swal.fire({
  title: 'vous êtes sure?',
  text: "Voulez vous supprimer ce produit?",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Oui, Supprimez le!',
  cancelButtonText: 'Annuler'
}).then((result) => {
  if (result.value) {
    axios
          .get('/Document/'+cmp)
          .then(response =>(response.data))

          
  
    setTimeout(sleep, 1000);
    function sleep (){
        window.location.reload();
    }  
      
    
  }
})
}

 $(window).on("load resize", function() {
   var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
   $('.tbl-header').css({'padding-right':scrollWidth});
 }).resize();
</script>
@endsection('javascript')