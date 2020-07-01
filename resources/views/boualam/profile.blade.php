@extends('layouts.app') 
@section('content')
<div class="profile">

    <input type="hidden" id="email" value="{{$info[0]->email}}">
    <input type="hidden" id="tele" value="{{$info[0]->tele}}">
    <input type="hidden" id="Description" value="{{$info[0]->description}}">
    <input type="hidden" id="password" value="{{$info[0]->password}}">

    <h1>Mon Profile</h1>
    <div class="profile-wrapper">
        <div class="profile-infos">
            <div class="first-part fraction">
                <div class="profile-pic">
                    {{-- <img src="{{asset('storage/'.$info[0]->logo)}}" alt="profile picture"> --}}
                    <img src="{{asset('storage/coff.jpg')}}"  alt="profile picture">
                  <!--<img src="http://restaurant.foodeals.ma/storage/{{Auth::user()->logo }}"  alt="profile picture">-->

                </div>
                <div class="nameNtype">
                    <h1 class="profil-name">{{$info[0]->name}}</h1>
                    <p class='profile-type'>{{$info[0]->typename}}</p>
                </div>            
            </div>
            <div class="second-part fraction">
                <ul>
                    <li>{{$info[0]->gerant}}</li>
                    <li>{{$info[0]->description}} </li>
                </ul>
            </div>


            <div class="third-part fraction">

                <ul>
                    <li>{{$info[0]->tele}}</li>
                    <li>{{$info[0]->email}}</li>
                    <li>{{$info[0]->adresse}}</li>
                </ul>

            </div>
            {{-- <div class="modify-profile"><img src="images/edit-profile.svg" onclick="showEditprofile({{$info[0]->id}})" alt="edit"></div> --}}
             <div class="modify-profile"><img src="{{ asset('images/edit.png') }}" onclick="showEditprofile({{$info[0]->id}})" alt="edit"></div>

        </div>


        
        <div class="profile-statistics">
            <div class="myposts">
                <span class="statistics-nbr">{{$countP[0]->total_p}}</span>
                <p>Mes postes</p>
            </div>
            <div class="sold">
                <span class="statistics-nbr">{{$countP[0]->total_v}}</span>
                <p>Vendu</p>
            </div>
            <div class="left">
                <span class="statistics-nbr">{{$countP[0]->total_p - $countP[0]->total_v}}</span>
                <p>Reste</p>
            </div>
        </div>
    
    </div>
</div>

<div class="popupContainer">
      
        <div class="add_product_popup" style="width:500px; height:100dp" id="mod_profile">
                <h2>Modifier votre profile</h2>
                <svg class="close_X" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 6L6 18" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6 6L18 18" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                    
                <form action="{{url('/modifierRestoC')}}" method="post">
                    
                    <div>
                            @csrf
                            <input type="hidden" id="id" name="id" value="{{Auth::user()->id}}"/>
                        <div>
                            <label for="product-title">Email</label>
                            <input id="memail" name="Email" type="text" claas="@if($errors->get('email')) is-invalid  @endif" name="Email" required value="{{old('email')}}">
                            @foreach ($errors->get('email') as $error)
                            <div class="invalid-feedback-text">
                                {{$error}}
                            </div>
                            @endforeach
                        </div>
                        <div>
                                <label for="product-Date-debut">Telephone</label>
                                <input name="Tele" required value="{{old('qte')}}"
                                placeholder="06 ...." id="mtele" type="text"  min="0" class="form-control @if($errors->get('tele')) is-invalid  @endif" name="Tele" required value="{{old('qte')}}">
                                @foreach ($errors->get('tele') as $error)
                                <div class="invalid-feedback-text">
                                    {{$error}}
                                </div>
                                @endforeach
                            </div>
                 
                    </div>
                    <div>
                   
                        <div>
                            <label for="product-Date-fin">Password</label>
                            <input name="password"
                            placeholder="********" id="password1" type="password" class="form-control @if($errors->get('password')) is-invalid  @endif" name="password">
                            @foreach ($errors->get('password') as $error)
                            <div class="invalid-feedback-text">
                                {{$error}}
                            </div>
                            @endforeach
                        </div>
                
                        <div>
                            <label for="product-description">Description</label>
                            <textarea name="Description" required value="{{old('description')}}"
                            placeholder="Description" id="mdescription" class="form-control @if($errors->get('description')) is-invalid  @endif" name="Description" required value="{{old('description')}}"></textarea>
                            @foreach ($errors->get('description') as $error)
                            <div class="invalid-feedback-text">
                                {{$error}}
                            </div>
                            @endforeach
                        </div>
                    </div>
                   <div>
                        <button class="add_post_btn add_post_btn2" id="add_post_btn" >
                            <svg width="20" height="20" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7 2.91663V11.0833" stroke="#56D496" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M2.91663 7H11.0833" stroke="#56D496" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>        
                        <span>Modifier</span>
                        </button>
                   </div>
                </form>
                <!-- <div class="add_post_btn add_post_btn2" id="add_post_btn">
                    <svg width="20" height="20" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 2.91663V11.0833" stroke="#56D496" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2.91663 7H11.0833" stroke="#56D496" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>        
                    <span>ADD POST</span>
                </div> -->
            </div>


</div>
@endsection('content') 









{{-- @extends('layouts.app') 
@section('content')

                            <input type="hidden" id="email" value="{{$info[0]->email}}">
                            <input type="hidden" id="tele" value="{{$info[0]->tele}}">
                            <input type="hidden" id="Description" value="{{$info[0]->description}}">
                            <input type="hidden" id="password" value="{{$info[0]->password}}">

                            <div class="container">
                              <!-- change change change !!!!! -->
                                <div class="avatar-flip">
                                  <!-- <img src="{{asset('storage/'.$info[0]->logo)}}" height="150" width="150"> -->
                                  <img src="https://www.thesun.co.uk/wp-content/uploads/2017/02/nintchdbpict000177708607.jpg" height="150" width="150">
                                  <!-- <img src="{{ asset('storage/logo.jpg') }}" height="150" width="150"> -->
                                  <img src="https://yt3.ggpht.com/a/AGF-l78qxiTh28XUj0Eeo8UPAj_0xDOEf2fLpgRjZQ=s900-mo-c-c0xffffffff-rj-k-no" height="150" width="150">
                                </div>
                                <h2>{{$info[0]->name}}</h2>
                                <section>
                                <div class="item">
                                <p>Telephone :</p>
                                <h4>Email :</h4>
                                <p>Adresse :</p>
                                <p>Description :</p>
                                <p>Gérant :</p>
                                <p>Type :</p>
                            </div>
                            <div class="divider"></div>
                            <div class="item">
                                <p>{{$info[0]->tele}}</p>
                                <h4>{{$info[0]->email}}</h4>
                                <p>{{$info[0]->adresse}}</p>
                                <p>{{$info[0]->description}}</p>
                                <p>{{$info[0]->gerant}}</p>
                                <p>{{$info[0]->typename}}</p>
                            </div>
                        </section>
                                <button type="button" class="editBTN float-right" onclick='modifierResto({{Auth::user()->id}})' >Modifier</button>
                                <br><br>
                            </div>
  <form action="{{url('/modifierRestoC')}}" method="post">
    @csrf
    <input type="hidden" id="id" name="id" value="{{Auth::user()->id}}"/>
    <div class="modal fade" id="modifierResto" tabindex="-1" role="dialog" aria-labelledby="modifierResto" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modifierProduits">Modifier Restaurant</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Email</label>
                            <input type="text" class="form-control @if($errors->get('email')) is-invalid  @endif" name="Email" required value="{{old('email')}}"
                                placeholder="Example@example.com" id="memail"> @foreach ($errors->get('email') as $error)
                            <div class="invalid-feedback">
                                {{$error}}
                            </div>
                            @endforeach
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Téléphone :</label>
                            <input type="text" min="0" class="form-control @if($errors->get('tele')) is-invalid  @endif" name="Tele" required value="{{old('qte')}}"
                                placeholder="06 ...." id="mtele"> @foreach ($errors->get('tele') as $error)
                            <div class="invalid-feedback">
                                {{$error}}
                            </div>
                            @endforeach
                        </div>
                     
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Mot de pass :</label>
                            <input type="password" class="form-control @if($errors->get('password')) is-invalid  @endif" name="password"
                                placeholder="********" id="password1"> @foreach ($errors->get('password') as $error)
                            <div class="invalid-feedback">
                                {{$error}}
                            </div>
                            @endforeach
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Comfermation Mot de pass :</label>
                            <input type="password" class="form-control @if($errors->get('password')) is-invalid  @endif" name="password2"  
                                placeholder="********" id="password2">
                                <span id='message'></span>
                                @foreach ($errors->get('password') as $error)
                            <div class="invalid-feedback">
                                {{$error}}
                            </div>
                            @endforeach
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Description</label>
                            <textarea class="form-control @if($errors->get('description')) is-invalid  @endif" name="Description" required value="{{old('description')}}"
                                placeholder="Description" id="mdescription"></textarea> @foreach ($errors->get('description') as $error)
                            <div class="invalid-feedback">
                                {{$error}}
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submit">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>




@endsection('content') 
@section('style')
<style>
section {
  display: flex;
  flex-direction: row;
  flex: 1;
  margin: 0 -8px;
}

section > * {
  margin: 0 8px;
}

.divider {
  width: 3px;
  margin: 6px 0;
  background: #d4cece;
  margin: 0px 15px 0px 15px;
}

.item {
  flex: 0 1 auto;
}



.editBTN{
        padding: 10px 10px;
        cursor: pointer;
        outline:none;
        background: linear-gradient(to right, #25b7c4,#25c481 );
    color:#fff;
    border:2px solid #fff;
    }


    @import url(https://fonts.googleapis.com/css?family=Roboto:900,300);
body {
  background-color: #f0f0f0;
  font-family: roboto;
}
.container {
  width: 700px;
  margin: 120px auto 120px;
  background-color: #fff;
  padding: 0 20px 20px;
  border-radius: 6px;
  -webkit-border-radius: 6px;
  -moz-border-radius: 6px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.075);
  -webkit-box-shadow: 0 2px 5px rgba(0,0,0,0.075);
  -moz-box-shadow: 0 2px 5px rgba(0,0,0,0.075);
  text-align: left;
}
.container:hover .avatar-flip {
  transform: rotateY(180deg);
  -webkit-transform: rotateY(180deg);
}
.container:hover .avatar-flip img:first-child {
  opacity: 0;
}
.container:hover .avatar-flip img:last-child {
  opacity: 1;
}
.avatar-flip {
  border-radius: 100px;
  overflow: hidden;
  height: 150px;
  width: 150px;
  position: relative;
  margin: auto;
  top: -60px;
  transition: all 0.3s ease-in-out;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  box-shadow: 0 0 0 13px #f0f0f0;
  -webkit-box-shadow: 0 0 0 13px #f0f0f0;
  -moz-box-shadow: 0 0 0 13px #f0f0f0;
}
.avatar-flip img {
  position: absolute;
  left: 0;
  top: 0;
  border-radius: 100px;
  transition: all 0.3s ease-in-out;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
}
.avatar-flip img:first-child {
  z-index: 1;
}
.avatar-flip img:last-child {
  z-index: 0;
  transform: rotateY(180deg);
  -webkit-transform: rotateY(180deg);
  opacity: 0;
}
h2 {
  font-size: 32px;
  font-weight: 600;
  margin-bottom: 15px;
  color: #333;
  text-align: center;
}
h4 {
  font-size: 20px;
  color: #00baff;
  letter-spacing: 1px;
  margin-bottom: 25px
}
p {
  font-size: 20px;
  line-height: 26px;
  margin-bottom: 20px;
  color: #666;
}
</style>
@endsection('style') 

@section('javascript')
<script>
function modifierResto(id){
            var email=$('#email').val();
            var tele=$('#tele').val();
            var description=$('#Description').val();
           
            $('#memail').val(email);
            $('#mtele').val(tele);
            $('#mdescription').val(description);
            $('#modifierResto').modal();
}
$('#password1, #password2').on('keyup', function () {
    var password1=$('#password1').val();
    var password2=$('#password2').val();
   // alert(password1);
  if (password1 == password2) {
    $('#message').html('ok').css('color', 'green');
    $('#submit').show();
  } 
  if (password1 != password2) {
    $('#message').html('n\'est pas compatible').css('color', 'red');
    $('#submit').hide();
}
});
</script>
@endsection('javascript') --}}