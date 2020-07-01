@extends('layouts.app') 
@section('content')  
<h1>Listes Des Produits</h1>
    <div class="add_post_btn" id="add_post_btn">
        <svg width="20" height="20" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M7 2.91663V11.0833" stroke="#56D496" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M2.91663 7H11.0833" stroke="#56D496" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>        
        <span>AJOUTER PRODUIT</span>
    </div>
        <table id="ListDesProduitTable">
        <tr>
            <th>Nom produit</th>
            <th>Date Fin</th>
            <th>Heure Fin</th>
            <th>Qte Rester</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        @php $cnt=1;  @endphp 
        @foreach($list as $lPoduct)
                <input type="hidden" id="Id{{$cnt}}" value="{{$lPoduct->id}}">
                <input type="hidden" id="Name{{$cnt}}" value="{{$lPoduct->pname}}">
                <input type="hidden" id="HD{{$cnt}}" value="{{$lPoduct->hspr}}">
                <input type="hidden" id="HF{{$cnt}}" value="{{$lPoduct->hfpr}}">
                <input type="hidden" id="MF{{$cnt}}" value="{{$lPoduct->mspr}}">
                <input type="hidden" id="MD{{$cnt}}" value="{{$lPoduct->mfpr}}">
                <input type="hidden" id="DD{{$cnt}}" value="{{$lPoduct->started_at}}">
                <input type="hidden" id="DF{{$cnt}}" value="{{$lPoduct->finished_at}}">
                <input type="hidden" id="type{{$cnt}}" value="{{$lPoduct->typeproduits_id}}">   
                <input type="hidden" id="Qte{{$cnt}}" value="{{$lPoduct->pqte}}">
                <input type="hidden" id="Description{{$cnt}}" value="{{$lPoduct->pdescription}}">
                <input type="hidden" id="Prix{{$cnt}}" value="{{$lPoduct->pprix}}">
                <input type="hidden" id="Prixini{{$cnt}}" value="{{$lPoduct->pprixini}}">
                <input type="hidden" id="id1" value="{{$lPoduct->id}}" />
                <input type="hidden" id="qte_rester{{$cnt}}" value="{{$lPoduct->pqte - $lPoduct->compter}}">
                <input type="hidden" id="qte_commander{{$cnt}}" value="{{$lPoduct->compter}}">
                <input type="hidden" id="livraison{{$cnt}}" value="{{$lPoduct->livraison}}">
                <input type="hidden" id="plusl{{$cnt}}" value="{{$lPoduct->plusl}}">
                
                <input id="field1{{$cnt}}" type="hidden" value="{{$lPoduct->op1}}" />
                <input id="field2{{$cnt}}" type="hidden" value="{{$lPoduct->op2}}"/>
                <input id="field3{{$cnt}}" type="hidden" value="{{$lPoduct->op3}}"/>
                <input id="field4{{$cnt}}" type="hidden" value="{{$lPoduct->op4}}"/>
                <input id="field5{{$cnt}}" type="hidden" value="{{$lPoduct->op5}}"/>
                <input id="prixop1{{$cnt}}" type="hidden" value="{{$lPoduct->plus1}}"/>
                <input id="prixop2{{$cnt}}" type="hidden" value="{{$lPoduct->plus2}}"/>
                <input id="prixop3{{$cnt}}" type="hidden" value="{{$lPoduct->plus3}}"/>
                <input id="prixop4{{$cnt}}" type="hidden" value="{{$lPoduct->plus4}}"/>
                <input id="prixop5{{$cnt}}" type="hidden" value="{{$lPoduct->plus5}}"/>

                <input  id="radop0{{$cnt}}" type="hidden" value="{{$lPoduct->place}}"> 
                <input  id="radop1{{$cnt}}" type="hidden" value="{{$lPoduct->emporter}}"> 
                <input  id="radop2{{$cnt}}" type="hidden" value="{{$lPoduct->libre}}"> 

    @if($lPoduct->pcanceled_at == null)         
        <tr>
            <td>{{$lPoduct->pname}}</td>
            <td>{{$lPoduct->finished_at}}</td>
            @php
            $hf=$lPoduct->hfpr;
            $mf=$lPoduct->mfpr;
            if(strlen($hf)==1){
                $hf="0".$hf;
            }
            if(strlen($mf)==1){
                $mf="0".$mf;
            }
            echo '<td>'.$hf.':'.$mf.'</td>';
            @endphp
            <td>{{$lPoduct->pqte - $lPoduct->compter}}</td>
            <td><button class="details-btn-my-products" onclick="show({{$cnt}})">DETAILS</button></td>
            <td><p class="modifier-btn-my-products"  onclick="showEdit({{$cnt}})">Modifier</p></td>
        <td><img src="{{ asset('images/deleteicon.svg') }}" alt="delet icon" onclick="deleteProduct({{$cnt}})"></td>
        </tr>
        @else 
        <tr style="bqckground:transparent;filter: grayscale(100%)">
            <td>{{$lPoduct->pname}}</td>
            <td>{{$lPoduct->finished_at}}</td>
            @php
            $hf=$lPoduct->hfpr;
            $mf=$lPoduct->mfpr;
            if(strlen($hf)==1){
                $hf="0".$hf;
            }
            if(strlen($mf)==1){
                $mf="0".$mf;
            }
            echo '<td>'.$hf.':'.$mf.'</td>';
            @endphp
            <td>{{$lPoduct->pqte - $lPoduct->compter}}</td>
            <td><button class="details-btn-my-products" onclick="show({{$cnt}})">DETAILS</button></td>
            <td></td>
            <td></td>
        </tr>
        @endif

        {{-- <tr style="bqckground:transparent;filter: grayscale(100%)"> --}}
        @php $cnt++; @endphp 
        @endforeach 
    </table> 
</div>
</div> 
<div class="popupContainer">

    <div class="product-details">
        <div>
            <div>
                <span id="prix_details"></span>
                <span id="prix_initial"></span>
            </div>
        </div>
        
        <h2 id="product_name"></h2>
        <p id="Ddescription"></p>
        <div>
            <table>
                <tr>
                    <th>date début</th>
                    <td id="date_debut"></td>
                </tr>
                <tr>
                    <th>date Fin</th>
                    <td id="date_fin"></td>
                </tr>
                <tr>
                    <th>Qte</th>
                    <td><span id="qte"></span></td>
                </tr>
                <tr>
                    <th>Qte Commandée</th>
                    <td><span id="qte_Commande"></span></td>
                </tr>
                <tr>
                    <th>Qte Restée</th>
                    <td><span id="qte_rester"></span></td>
                </tr>
            </table>
        </div>
        <div class="close_btn_contaienr">
            <button id="close-btn-details-popup">Fermer</button>
        </div>
    </div>
    



    <div class="add_product_popup">
            <h2>Ajouter Produit</h2>
    
            <svg class="close_X" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18 6L6 18" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M6 6L18 18" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
                
            <form action="{{url('/addProduits')}}" method="post">
             
                <div>
                @csrf
                    <div>
                        <label for="product-title">Titre</label>
                        <input id="product-title" type="text" name="name" required  value="{{old('name')}}" class="@if($errors->get('name')) is_invalid-feedback   @endif ">
                      
                        @foreach ($errors->get('name') as $error)
                                <div class="invalid-feedback-text">
                                    {{$error}}
                                </div>
                                @endforeach
                    </div>
                    <div>
                        <label for="product-qte" name="qte">Qte</label>
                        <input id="product-qte" type="number" name="qte" required value="{{old('qte')}}" class="@if($errors->get('qte')) is_invalid-feedback   @endif ">
                        @foreach ($errors->get('qte') as $error)
                                <div class="invalid-feedback-text">
                                    {{$error}}
                                </div>
                                @endforeach
                    </div>
                    <div>
                        <label for="product-prix-initial">Prix initial</label>
                        <input id="product-prix-initial" type="number" step="0.01" name="prixini" required value="{{old('prixini')}}" class="@if($errors->get('prixini')) is_invalid-feedback   @endif ">
                        @foreach ($errors->get('prixini') as $error)
                                <div class="invalid-feedback-text">
                                    {{$error}}
                                </div>
                                @endforeach
                                
                    </div>
                    <div>
                        <label for="product-prix-de-vent">prix de vente</label>
                        <input id="product-prix-de-vent" type="number" step="0.01" name="prix" required value="{{old('prix')}}" class="@if($errors->get('prix')) is_invalid-feedback   @endif ">
                        @foreach ($errors->get('prix') as $error)
                                <div class="invalid-feedback-text">
                                    {{$error}}
                                </div>
                                @endforeach
                                <span id="message"></span>
                    </div>
                    <div>
                        <label for="product-type">type de produit</label>
                        <select id="product-type" type="text" name="type1" required value="{{old('type1')}}" class="@if($errors->get('type1')) is_invalid-feedback   @endif ">
                            <option disabled selected value>Choose</option> 
                            @foreach($list1 as $lt)
                            <option value="{{$lt->id}}">{{$lt->name}}</option>
                            @endforeach
                        </select>
                        @foreach ($errors->get('type1') as $error)
                                <div class="invalid-feedback-text">
                                    {{$error}}
                                </div>
                                @endforeach
                    </div>

                    <div class="row" style="height: 20px;"></div>


                        <input type="checkbox" name="livraison" id="LivraisonCheck" onchange="livrer()" />&nbsp;Livraison&nbsp;&nbsp;&nbsp;
                        <input type="text" name="prix_livrai" id="livrai_text" placeholder="tapez votre prix de livraison" style="visibility: hidden;">

                    <script>
                        function  livrer() {
                            var text_livraison=document.getElementById("livrai_text");
                            if(document.getElementById("LivraisonCheck").checked == true){
                                text_livraison.style.visibility = 'visible';
                            }else{
                                text_livraison.style.visibility = 'hidden';
                            }
                        }
                    </script>



                </div>
                <div>
                    <div>
                        <label for="product-Date-debut">Date debut</label>
                        <input id="product-date-debut" type="date" name="dd" required value="{{old('dd')}}" class="@if($errors->get('dd')) is_invalid-feedback   @endif ">
                        @foreach ($errors->get('dd') as $error)
                                <div class="invalid-feedback-text">
                                    {{$error}}
                                </div>
                                @endforeach
                             
                    </div>
                    <div>
                        <label for="product-Date-fin" >Date fin</label>
                        <input id="product-Date-fin" type="date" name="df" required value="{{old('df')}}" class="@if($errors->get('df')) is_invalid-feedback   @endif ">
                        @foreach ($errors->get('df') as $error)
                                <div class="invalid-feedback-text">
                                    {{$error}}
                                </div>
                                @endforeach
                                <span id="messageDate"></span>
                    </div>
                    <div>
                        <label for="product-Heur-deput">Heure début</label>
                        <input id="product-Heur-deput" type="time" name="hd" required value="{{old('hd')}}" class="@if($errors->get('hd')) is_invalid-feedback   @endif ">
                        @foreach ($errors->get('hd') as $error)
                                <div class="invalid-feedback-text">
                                    {{$error}}
                                </div>
                                @endforeach
                    </div>
                    <div>
                        <label for="product-Heur-de-fin">Heure fin</label>
                        <input id="product-Heur-de-fin" type="time" name="hf" required value="{{old('hf')}}" class="@if($errors->get('hf')) is_invalid-feedback   @endif ">
                        @foreach ($errors->get('hf') as $error)
                                <div class="invalid-feedback-text">
                                    {{$error}}
                                </div>
                                @endforeach
                                <span id="messageHeure"></span>
                    </div>
                    <div>
                        <label for="product-description">Description</label>
                        <textarea id="product-description" name="description" required  class="@if($errors->get('description')) is_invalid-feedback   @endif ">{{old('description')}}</textarea>
                        @foreach ($errors->get('description') as $error)
                                <div class="invalid-feedback-text">
                                    {{$error}}
                                </div>
                                @endforeach
                    </div>
                    
                </div>
               <div>
               
                    <input type="radio" name="radiochoix" value="0"> Eemporter
                    <input type="radio" name="radiochoix" value="1" checked> Libre
                    <input type="radio" name="radiochoix" value="2"> Sur Place
               
                    <div class="fields_m ">
                            <br>
                            <br>
                            <div class="row">
                                    <input type="hidden" name="count" value="1" />
                                    <div class="control-group" id="fields">
                                        <label class="control-label" for="field1">Option </label>
                                        <div class="controls" id="profs"> 
                                           
                                                <div id="field">
                                                    <input class="input op_d "  id="field1" name="option1" type="text" data-items="5"/>
                                                    <input class="input op_p " id="prixop1" name="prixop1" type="number" step="0.01" placeholder="0.0" data-items="5"/>
                                                <button id="b1" class="btn add-more" type="button">+</button>
                                            </div>
                                        <br>
                                        </div>
                                    </div>
                                </div>   
                    </div>
                    <button class="add_post_btn add_post_btn2" id="add_post_btn">
                        <svg width="20" height="20" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 2.91663V11.0833" stroke="#56D496" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M2.91663 7H11.0833" stroke="#56D496" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>        
                    <span>Ajouter produit</span>
                    </button>
               </div>
            </form>
        </div>





    <div class="add_product_popup">
        <h2>Modifier Produits</h2>

        <svg class="close_X" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M18 6L6 18" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M6 6L18 18" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
            
        <form action="{{url('/modifierProduits')}}" method="post">
               
            <div>
                    @csrf
                    <input type="hidden" id="idr" name="Id" />
                <div>
                    <label for="product-title1">Titre</label>
                    <input class="@if($errors->get('Name')) is_invalid-feedback   @endif " id="product-title1" type="text" name="Name" >
                    @foreach ($errors->get('Name') as $error)
                            <div class="invalid-feedback-text">
                                {{$error}}
                            </div>
                            @endforeach
                </div>
                <div>
                    <label for="product-qte1">Qte</label>
                    <input class="@if($errors->get('Qte')) is_invalid-feedback @endif" id="product-qte1" type="number" name="Qte" >
                    @foreach ($errors->get('Qte') as $error)
                    <div class="invalid-feedback-text">
                        {{$error}}
                    </div>
                    @endforeach
                </div>
                <div>
                    <label for="product-prix-initial1">Prix initial</label>
                    <input class="@if($errors->get('Prixini')) is_invalid-feedback @endif" id="product-prix-initial1" type="number" step="0.01" name="Prixini" >
                    @foreach ($errors->get('Prixini') as $error)
                            <div class="invalid-feedback-text">
                                {{$error}}
                            </div>
                            @endforeach
                </div>
                <div>
                    <label for="product-prix-de-vent1">prix de vent</label>
                    <input class="@if($errors->get('Prix')) is_invalid-feedback @endif" id="product-prix-de-vent1"  type="number" step="0.01" name="Prix"  >
                    @foreach ($errors->get('Prix') as $error)
                            <div class="invalid-feedback-text">
                                {{$error}}
                            </div>
                            @endforeach
                            <span class="invalid-feedback-text" id="messageM"></span>
                </div>
                <div>
                    <label for="product-type1">type de produit</label>
                    <select id="product-type1"class="@if($errors->get('tyype')) is-invalid @endif" type="text" name="tyype"  >
                      {{--   <option disabled selected value>select an option</option> 
                        <option value="PIZZA">PIZZA</option>
                        <option value="TACOS">TACOS</option>
                        <option value="BURGER">BURGER</option> --}}

                        @foreach($list1 as $lt)
                        <option value="{{$lt->id}}">{{$lt->name}}</option> 
                        @endforeach
                    </select>
                    @foreach ($errors->get('tyype') as $error)
                    <div class="invalid-feedback-text">
                    {{ $error }}
                    </div>
                     
                    @endforeach
                </div>

                <div class="row" style="height: 20px;"></div>


                <input type="checkbox" name="livraison" id="LivraisonEdit1" onchange="livrerupdate()" />&nbsp;Livraison&nbsp;&nbsp;&nbsp;
                <input type="text" name="prix_livrai" id="produit_livraison1" placeholder="tapez votre prix de livraison" style="visibility: hidden;">

                <script>
                    function livrerupdate() {
                        var text_livraison=document.getElementById("produit_livraison1");
                        if(document.getElementById("LivraisonEdit1").checked == true){
                            text_livraison.style.visibility = 'visible';
                        }else{
                            text_livraison.style.visibility = 'hidden';
                            text_livraison.value = null;
                        }
                    }
                </script>
            </div>
            <div>
                <div>
                    <label for="product-Date-debut1">Date debut</label>
                    <input class="@if($errors->get('DD')) is_invalid-feedback @endif" id="product-Date-debut1" type="date" name="DD" >
                    @foreach ($errors->get('DD') as $error)
                                <div class="invalid-feedback-text">
                                    {{$error}}
                                </div>
                                @endforeach
                </div>
                <div>
                    <label for="product-Date-fin1">Date fin</label>
                    <input class="@if($errors->get('DF')) is_invalid-feedback @endif" id="product-Date-fin1" type="date" name="DF" >
                    @foreach ($errors->get('DF') as $error)
                                <div class="invalid-feedback-text" >
                                    {{$error}}
                                </div>
                                @endforeach
                                <span class="invalid-feedback-text" id="messageMDate"></span>
                </div>
                <div>
                    <label for="product-Heur-deput1">Heure debut</label>
                    <input class="@if($errors->get('HD')) is_invalid-feedback @endif" id="product-Heur-deput1" type="time" name="HD" >
                    @foreach ($errors->get('HD') as $error)
                                <div class="invalid-feedback-text" >
                                        {{-- min="06:00" max="00:00" --}}
                                    {{$error}}
                                </div>
                                @endforeach
                </div>
                <div>
                    <label for="product-Heur-de-fin1">Heure fin</label>
                    <input class="@if($errors->get('HF')) is_invalid-feedback @endif" id="product-Heur-de-fin1" type="time" name="HF" >
                    @foreach ($errors->get('HF') as $error)
                                <div class="invalid-feedback-text">
                                    {{$error}}
                                </div>
                                @endforeach
                                <span class="invalid-feedback-text" id="messageMHeure"></span>
                </div>
                <div>
                    <label for="product-description1">Description</label>
                    <textarea class="@if($errors->get('Description')) is_invalid-feedback @endif" id="product-description1" name="Description" >
                        @foreach ($errors->get('Description') as $error)
                            <div class="invalid-feedback-text">
                                {{$error}}
                            </div>
                            @endforeach
                    </textarea>
                </div>
            </div>
           <div>
                        <input type="radio" name="mradiochoix" id="memporter" value="0"> Eemporter
                        <input type="radio" name="mradiochoix" id="mlibre" value="1"> Libre
                        <input type="radio" name="mradiochoix" id="mplace" value="2"> Sur Place
                
                <div class="fields_m ">
                        <br>
                        <br>
                        <div class="row">
                                <input type="hidden" name="count" value="1" />
                                <div class="control-group" id="fields">
                                    <label class="control-label" for="field1">Option </label>
                                    <div class="controls" id="profs"> 
                                            <div id="field2">
                                                <input class="input op_d " id="mfield1" name="moption1" type="text" data-items="5"/>
                                                <input class="input op_p " id="mprixop1" name="mprixop1" type="number" step="0.01" placeholder="0.0" data-items="5"/>
                                                
                                                <input class="input op_d " id="mfield2" name="moption2" type="text" data-items="5"/>
                                                <input class="input op_p " id="mprixop2" name="mprixop2" type="number" step="0.01" placeholder="0.0" data-items="5"/>                                            
                                                
                                                <input class="input op_d " id="mfield3" name="moption3" type="text" data-items="5"/>
                                                <input class="input op_p " id="mprixop3" name="mprixop3" type="number" step="0.01" placeholder="0.0" data-items="5"/>  
                                                
                                                <input class="input op_d " id="mfield4" name="moption4" type="text" data-items="5"/>
                                                <input class="input op_p " id="mprixop4" name="mprixop4" type="number" step="0.01" placeholder="0.0" data-items="5"/>
                                               
                                                <input class="input op_d " id="mfield5" name="moption5" type="text" data-items="5"/>
                                                <input class="input op_p " id="mprixop5" name="mprixop5" type="number" step="0.01" placeholder="0.0" data-items="5"/>
                                                
                                                <button id="b2" class="btn add-moreM" type="button">+</button> 
                                        </div>
                                      
                                    <br>
                                    </div>
                                </div>
                            </div>   
                </div>
                <button class="add_post_btn add_post_btn2" id="add_post_btn">
                    <svg width="20" height="20" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 2.91663V11.0833" stroke="#56D496" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2.91663 7H11.0833" stroke="#56D496" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>        
                <span>Modifier</span>
                </button>
           </div>
        </form>
      
    </div>


    <form id='delete_product_form' class='delete_product_form' >
          
            <div class="delete_post_popup" id='tbody'>
            
            <input type="hidden" id='delete_id_popup' name='idInput'>
            
            </div>
        </form>
        
    <div class="add_product_popup">
        <h2>Info !!</h2>

        <svg class="close_X" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M18 6L6 18" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M6 6L18 18" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
            
        <form action="{{url('/annulerProd')}}" method="post">
               
           <div>
            @csrf
            <input type="hidden" id="idrA" name="IdA" />
            <div>
                <p> Vous ne pouvez pas odifiez le produit car il est déjà  vendu!!
                    <br>
                    Vous pouvez l'annulez
                </p>
            </div>
           </div>
           <div>
                <button class="add_post_btn add_post_btn2" id="add_post_btn">
                    <svg width="20" height="20" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 2.91663V11.0833" stroke="#56D496" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2.91663 7H11.0833" stroke="#56D496" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>        
                <span>Annuler le produit</span>
                </button>
           </div>
        </form>
      
    </div>








    {{-- <form action="{{url('/annulerProd')}}" method="post">
        @csrf
        <input type="hidden" id="idrA" name="IdA" />
    <div class="modal fade" id="idCancel" tabindex="-1" role="dialog" aria-labelledby="idCancel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="idCancel">Choix</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Vous ne pouvez pas odifiez le produit car il est déjà  vendu!!<br> Vous pouvez l'annulez 
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
              <button type="submit" class="btn btn-primary" id='btncan' >Annuler le produit</button>
            </div>
          </div>
        </div>
      </div>
    </form> --}}

</div>
    <!-- </div> -->
    
    
        <div id="pagination_container">
                {{ $list->links() }}
        </div>

    </div>
      </section>
     
   



     





@endsection('content') 

@section('javascript')

<script>
// Popups script

// const popupBG = document.querySelector('.popupContainer');
// const myProdDetailsBtns = document.querySelectorAll('.details-btn-my-products');
// const productDetails = document.querySelector('.product-details')
// const close_btn_details = document.getElementById('close-btn-details-popup');
// const close_X = document.getElementsByClassName('close_X')[0];
// const add_post_btn = document.getElementById('add_post_btn');
// const add_product_popup = document.querySelector('.add_product_popup')

// popupBG.addEventListener('click',(e)=>{
//     if(e.target.classList.contains('popupContainer')){
//         popupBG.classList.remove('popupContainerShow')
//         productDetails.classList.remove('popup-show')
//         add_product_popup.classList.remove('popup-show');
//     }
    
// })

// myProdDetailsBtns.forEach(prodDetailsBTN =>{
//     prodDetailsBTN.addEventListener('click',()=>{
//         popupBG.classList.add('popupContainerShow')
//         productDetails.classList.add('popup-show')
//     })
// });

// close_btn_details.addEventListener('click',()=>{
//     popupBG.classList.remove('popupContainerShow')
//     productDetails.classList.remove('popup-show')
// })
// function show(idDet){ 
//     let Description_details = document.getElementById('Ddescription')
//     let Description = document.getElementById('Description'+idDet).value;
//     Description_details.innerHTML = Description;
//     popupBG.classList.add('popupContainerShow');
//     productDetails.classList.add('popup-show');
// }

// close_X.addEventListener('click', ()=>{
//     popupBG.classList.remove('popupContainerShow')
//     add_product_popup.classList.remove('popup-show')
// })
// add_post_btn.addEventListener('click',()=>{

//     popupBG.classList.add('popupContainerShow');
//     add_product_popup.classList.add('popup-show');
// })

</script>
@endsection('javascript')