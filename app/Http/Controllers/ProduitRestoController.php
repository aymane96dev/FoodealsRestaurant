<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Appduit;
use App\Restaurant;
use Session;
use Carbon\Carbon;
use Auth;
use App\Detailcommande;
use App\Produit;
use PDF;
use App\Client;
use App\Notification;
use App\Commande;
use App\Signature;
use App\Localisation;
use App\Http\Requests\RequestProduit;
use App\Http\Requests\ConfirmRequest;
use Illuminate\Database\QueryException;
use App\GererErreur;

use Illuminate\Http\Request;

class ProduitRestoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            if(Auth::User()->verified_at==null)
        return redirect("verify");
        else{
    $listProduit=DB::table('produits')
    ->join('typeproduits', 'typeproduits.id', '=','produits.typeproduits_id')
        ->join('restaurants', 'produits.restaurants_id', '=','restaurants.id')
        
        ->LEFTJOIN('detailcommandes', 'detailcommandes.produits_id', '=', 'produits.id')
        ->select('produits.id', 'produits.name as pname',
        'produits.qte as pqte','produits.prix as pprix',
        'produits.prixini as pprixini',
        'produits.description as pdescription',
        'produits.canceled_at as pcanceled_at','typeproduits.name as typename','produits.typeproduits_id',
        DB::raw('IFNULL(SUM(detailcommandes.qte),0) as compter'),
        DB::raw('hour(produits.started_at) as hspr'),DB::raw('Minute(produits.started_at) as mspr'),
        DB::raw('Minute(produits.finished_at) as mfpr'),DB::raw('hour(produits.finished_at) as hfpr'),
        DB::raw('Date(produits.started_at) as started_at'),DB::raw('Date(produits.finished_at) as finished_at'),
        "produits.op1","produits.op2","produits.op3","produits.op4","produits.op5",
        "produits.plus1","produits.plus2","produits.plus3","produits.plus4","produits.plus5",
        "produits.place","produits.emporter","produits.libre","produits.livraison")
        ->groupBy('produits.id',
        'produits.name',
        'produits.started_at',
        'produits.finished_at',
        'produits.qte',
        'produits.prix',
        'produits.prixini',
        'produits.description',
        'produits.canceled_at','typeproduits.name','produits.typeproduits_id',
        "produits.op1","produits.op2","produits.op3","produits.op4","produits.op5",
        "produits.plus1","produits.plus2","produits.plus3","produits.plus4","produits.plus5",
        "produits.place","produits.emporter","produits.libre","produits.livraison","produits.plusl")
        ->where('restaurants_id',Auth::User()->id)
        ->where('deleted_at', null)
        ->orderby('produits.created_at','DESC')
        ->paginate(5);
    //    dd($listProduit);
       
       $Listtype = DB::table('typeproduits')
       ->select('typeproduits.*', 'typeproduits.name as typename')
       ->get();  

       return view("boualam.produit",["list" => $listProduit],["list1" => $Listtype]);

    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function store(Request $request)
    {    
    
    try{
        $dd=$request->dd;
        $hd=$request->hd;
        $df=$request->df;
        $hf=$request->hf;
       DB::beginTransaction();
       if($request->prix > $request->prixini || $request->dd > $request->df || ($request->dd == $request->df  && $request->hd > $request->hf)){
            Session::flash('warning', 'le prix ou les date ou les heures sont incorrectes');
            return redirect('Mesproduits');
        }
        else{
        $prod=new Produit();
        $prod->name=$request->name;
        $array = array($dd,$hd.':00');
        $started= implode(" ", $array);
        $array1 = array($df,$hf.':00');
        $finished= implode(" ", $array1);
        $prod->qte=$request->qte;
        $prod->description=$request->description;
        $prod->prix=$request->prix;
        $prod->prixini=$request->prixini;
        $prod->typeproduits_id=$request->type1;
        $prod->started_at=$started;
        $prod->finished_at=$finished;

            if($request->prix_livrai !=null){
                $prod->livraison = 1;
                $prod->plusl = $request->prix_livrai;
            }else{
                $prod->livraison = 0;
            }

        $prod->op1=$request->option1;
        $prod->op2=$request->option2;
        $prod->op3=$request->option3;
        $prod->op4=$request->option4;
        $prod->op5=$request->option5;

        $prod->plus1=$request->prixop1;
        $prod->plus2=$request->prixop2;
        $prod->plus3=$request->prixop3;
        $prod->plus4=$request->prixop4;
        $prod->plus5=$request->prixop5;

        if($request->radiochoix==0){
            $prod->place=0;
            $prod->emporter=1;
            $prod->libre=0;
        }
        if($request->radiochoix==1){
            $prod->place=0;
            $prod->emporter=0;
            $prod->libre=1;
        }
        if($request->radiochoix==2){
            $prod->place=1;
            $prod->emporter=0;
            $prod->libre=0;
        }

    /* if($request->hasFile('photo'))
        {
            $prod->photo=$request->photo->store('images','public');
        }*/
        $prod->restaurants_id=Auth::User()->id;
        $prod->save();
        DB::commit();        
        Session::flash('success','Bien enregistrer');
        return redirect('Mesproduits');
        }
  }
    
catch(QueryException $ex){ 
    Session::flash('warning', GererErreur::verifier($ex->errorInfo[1])); 
     return  GererErreur::verifier($ex->errorInfo[1]);
} }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
     public function update(RequestProduit $request)
    {
        try{

        $dd=$request->DD;
        $hd=$request->HD;
        $df=$request->DF;
        $hf=$request->HF;
        if($this->checking($request->Id)==1)
        {
            Session::flash('warning','Vous ne pouvez pas modifier ce produit');
            return redirect('/Mesproduits');
        }
        else
        {
            if($request->prix > $request->prixini || $request->dd > $request->df || ($request->dd == $request->df  && $request->hd > $request->hf)){
                Session::flash('warning', 'le prix ou les date ou les heures incorrecte');
                return redirect('/Mesproduits');
            }
            else{
        $prod = Produit::find($request->Id);
        $array = array($dd,$hd);
        $started= implode(" ", $array);
        $array1 = array($df,$hf);
        $finished= implode(" ", $array1);
        $prod->typeproduits_id=$request->tyype;       
        $prod->name=$request->Name;
        $prod->qte=$request->Qte;
        $prod->description=$request->Description;
        $prod->prix=$request->Prix;
        $prod->prixini=$request->Prixini;

        $prod->started_at=$started;
        $prod->finished_at=$finished;

        if($request->prix_livrai !=null){
           $prod->livraison = 1;
           $prod->plusl = $request->prix_livrai;
        }else{
            $prod->livraison = 0;
            $prod->plusl = null;
         }

        $prod->op1=$request->moption1;
        $prod->op2=$request->moption2;
        $prod->op3=$request->moption3;
        $prod->op4=$request->moption4;
        $prod->op5=$request->moption5;

        $prod->plus1=$request->mprixop1;
        $prod->plus2=$request->mprixop2;
        $prod->plus3=$request->mprixop3;
        $prod->plus4=$request->mprixop4;
        $prod->plus5=$request->mprixop5;

        if($request->mradiochoix==0){
            $prod->place=0;
            $prod->emporter=1;
            $prod->libre=0;
        }
        if($request->mradiochoix==1){
            $prod->place=0;
            $prod->emporter=0;
            $prod->libre=1;
        }
        if($request->mradiochoix==2){
            $prod->place=1;
            $prod->emporter=0;
            $prod->libre=0;
        }
     /*   if($request->hasFile('photo'))
        {
            $prod->photo=$request->photo->store('images','public');
        }*/
        $prod->restaurants_id=Auth::User()->id;
      //  $prod->deleted_at=null;
       // dd($request);
        $prod->save();
        Session::forget('warning');
        Session::flash('success','Bien modifier');
        return redirect('/Mesproduits');
    }}
}
    
catch(QueryException $ex){ 
    Session::flash('warning', GererErreur::verifier($ex->errorInfo[1])); 
     return  GererErreur::verifier($ex->errorInfo[1]);

}
    
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function bloquer($id)
    { 
        try{
        

            $proudInDCom=DB::table('detailcommandes')
            ->select('detailcommandes.produits_id')
            ->where('detailcommandes.produits_id',$id)
            ->get();

    
         if(sizeof($proudInDCom)!=0){
            echo ' 
            <div>
            <img src="./images/deleteicon.svg" alt="delete icon">
            <div>
                <h2>Annuler produit</h2>
                <p>Vous ne pouvez pas supprimer le produit car il est déjà vendu!!<br>Vous pouvez l\'annuler</p>
                
            </div>
        </div>
        
        <div>
        
            <button class="cancel_button_delete">Ignorer</button>
            
            <button class="cancel_button_delete" onclick="annulerProd('.$id.')">Annuler</button>
        </div>';
         }
           
            else {
                
       
       
       echo ' 
       <div>
       <img src="./images/deleteicon.svg" alt="delete icon">
       <div>
           <h2>Supprimer produit</h2>
           <p>Voulez-vous vraiment supprimer ce produit!!</p>
           
       </div>
   </div>
   
   <div>
   
       <button class="cancel_button_delete">Annuler</button>
       
       <button class="cancel_button_delete" onclick="supprimerProd('.$id.')">Confirmer</button>
   </div>';
            }
    }
    
    catch(QueryException $ex){ 
        Session::flash('warning', GererErreur::verifier($ex->errorInfo[1])); 
         return  GererErreur::verifier($ex->errorInfo[1]);
    
    }

    }




 /*   public function bloquer(Request $req)
    { 
        try{
        

            $proudInDCom=DB::table('detailcommandes')
            ->select('detailcommandes.produits_id')
            ->where('detailcommandes.produits_id',$req->idInput)
            ->get();

    
         if(sizeof($proudInDCom)!=0){
            Session::flash('warning','Vous ne pouvez pas supprimer ce produit car il est déjà vendu!!');
            return redirect('/Mesproduits');
         }
           
            else {
                
       
        $proud=Produit::find($req->idInput);
        $proud->deleted_at=Carbon::now();
       $proud->save();
        Session::flash('success','Produit Supprimer');
        return redirect('/Mesproduits');
            }
    }
    
    catch(QueryException $ex){ 
        Session::flash('warning', GererErreur::verifier($ex->errorInfo[1])); 
         return  GererErreur::verifier($ex->errorInfo[1]);
    
    }

    }

*/
    public function cancel($id)
    {
        try{

        $proud = Produit::find($id);   
        //dd($prod);
        $proud->canceled_at=Carbon::now();
       $proud->save();
        Session::flash('success','Produit annulé');
        return redirect('/Mesproduits');
    }
    
    catch(QueryException $ex){ 
        Session::flash('warning', GererErreur::verifier($ex->errorInfo[1])); 
        return view("boualam.produit");
    
    }
    }


    public function supprimer($id)
    {
        try{

            $proud=Produit::find($id);
            $proud->deleted_at=Carbon::now();
           $proud->save();
            Session::flash('success','Produit Supprimer');
            return view("boualam.produit");
    }
    
    catch(QueryException $ex){ 
        Session::flash('warning', GererErreur::verifier($ex->errorInfo[1])); 
        return redirect('/Mesproduits');
    
    }
    }
    public function checking($id)
    { 
        try{

        $proudInDCom=DB::table('detailcommandes')
        ->select('detailcommandes.produits_id')
        //->where('restaurants_id',Auth::User()->id)
        ->where('detailcommandes.produits_id',$id)
        ->get();

        //dd($proudInDCom);
         if(sizeof($proudInDCom)!=0)
                return 1;
            else 
                return 0;
       
    }
    catch(QueryException $ex){ 
        Session::flash('warning', GererErreur::verifier($ex->errorInfo[1])); 
        return redirect('/Mesproduits');
    }
}



public function profile()
{
   
    $infoR=DB::table('restaurants')
    ->join('types', 'types.id', '=', 'restaurants.types_id')
    ->select('restaurants.*', 'types.name as typename')
    ->where('restaurants.id',Auth::User()->id)
    ->get();

    $countP=DB::table('produits')
    ->join('detailcommandes', 'detailcommandes.produits_id', '=', 'produits.id')
    ->select(DB::raw('SUM(produits.qte) as total_p'),DB::raw('SUM(detailcommandes.qte) as total_v'))
    ->where('produits.restaurants_id',Auth::user()->id)
    ->get();
 
   return view("boualam.profile",["info" => $infoR],["countP" => $countP]);
}


public function modifierResto(Request $request){
    try
    { $mresto=Restaurant::find($request->id);
    //dd($mresto);
    $mresto->email=$request->Email;
    $mresto->tele=$request->Tele;
    if($request->password != null)
    {
        $mresto->password=Hash::make($request->password);
    }
    $mresto->description=$request->Description;
    $mresto->save();
    Session::flash('success','Info mise à jour');
    return redirect('/profile');
}
    catch(QueryException $ex){ 
        Session::flash('warning', GererErreur::verifier($ex->errorInfo[1])); 
        return redirect('/profile');
    
    }
}





public function historique()
{  if(Auth::User()->verified_at==null)
    return redirect("verify");
    else{
try{   
    $ListDetailCommande1 = DB::table('commandes')
    ->join('detailcommandes','detailcommandes.commandes_id','=','commandes.id')
    ->join('signatures','detailcommandes.signatures_id','=','signatures.id')
    ->join('produits','detailcommandes.produits_id','=','produits.id')
    ->join('restaurants','produits.restaurants_id','=','restaurants.id')
    ->select('commandes.id as id_com',
    'commandes.created_at as created_at_com',
    'signatures.id as id_s',
    'signatures.updated_at as updated_at_s',
    'signatures.etat as etat_s',
    'restaurants.name as nameRes',
    'restaurants.gerant as nameGerant',
    'restaurants.email as emailRes',
    'restaurants.logo as logoRes',
    'restaurants.adresse as adresseRes',
    'restaurants.tele as teleRes',
    'detailcommandes.id as id_dcom', 
    'detailcommandes.qte as qte_dcom', 
    'detailcommandes.date_collecte as dateCollecte',
    'produits.id as id_pro',
    'produits.name as name_pro',
    'produits.qte as qte_pro',
    'produits.photo as photo_pro',
    'produits.prix as prix_pro',
    DB::raw('DATE(commandes.created_at) as date'),
    DB::raw('COUNT(detailcommandes.produits_id) as compter'))
    ->where('restaurants.id',Auth::User()->id)
    ->groupBy(  'produits_id',
                'commandes.id',
                'detailcommandes.date_collecte',
                'commandes.created_at',
                'signatures.id',
                'signatures.updated_at',
                'signatures.etat',
                'restaurants.name',
                'restaurants.gerant',
                'restaurants.email',
                'restaurants.tele',
                'restaurants.adresse',
                'restaurants.logo',
                'detailcommandes.id', 
                'detailcommandes.Qte', 
                'produits.id',
                'produits.name',
                'produits.qte',
                'produits.photo',
                'produits.prix',
                 DB::raw('DATE(commandes.created_at)')
    )
    ->orderby('commandes_id')
    ->get();
   //dd($ListDetailCommande1);

   $pdf = PDF::loadView("boualam.historique",["listClientCommandeProduit" => $ListDetailCommande1 ]);
   return $pdf->stream('invoice.pdf');
  //  return view("boualam.clientCommandePDF",["listClientCommande" => $ListClientCommande ]);
}
  catch(QueryException $ex){ 
    Session::flash('warning', GererErreur::verifier($ex->errorInfo[1])); 
     return  GererErreur::verifier($ex->errorInfo[1]);
  }
}



}


 public function find(Request $req)
{
   // dd($req->input());
    
                      $typeproduit= DB::table('types')                          
                      ->join('produits', 'produits.typeproduits_id', '=', 'types.id')
                      ->select('restaurants.*', 'types.name as typename')
                      ->where('restaurants.name','Like', '%'.$req->input('find').'%')
                      ->orderBy('created_at','desc')
                      ->paginate(8);
                      //dd($Restaurantfavoris);
                      $ListType =  Type::all();
                      return view("insaf.Restaurant" ,["list" => $Restaurantfavoris],["listT" => $ListType]); 
                      $validated = $req->validated();                
}

public function commandeCourante()
 { if(Auth::User()->verified_at==null)
    return redirect("verify");
    else{
         try{ 
            $listCommandes=DB::table('detailcommandes')
            ->join('commandes','detailcommandes.commandes_id','=','commandes.id')
            ->join('clients','clients.id','=','commandes.clients_id')
            ->join('produits','detailcommandes.produits_id','=','produits.id')
            ->join('restaurants','produits.restaurants_id','=','restaurants.id')
            ->join('signatures', 'signatures.id', '=', 'detailcommandes.signatures_id')
            ->select('commandes.created_at',DB::raw('Date(commandes.created_at)as datecom'),
            DB::raw('Time(commandes.created_at)as heurecom'),
            'clients.name as client','restaurants.id as idRes','commandes.id as idCom',
            DB::raw('COUNT(detailcommandes.produits_id) as nbr'))->distinct()
            ->where('restaurants.id',Auth::user()->id)
            ->where('signatures.etat',0)
            ->groupby('commandes.id','restaurants.id','clients.name','commandes.created_at')
            ->orderby('commandes.created_at','DESC')
            ->paginate(5);
           // dd($listCommandes);
           return view("boualam.commandeCourante",["list" => $listCommandes]);
         }
         catch(QueryException $ex){ 
           Session::flash('warning', GererErreur::verifier($ex->errorInfo[1])); 
            return  GererErreur::verifier($ex->errorInfo[1]);
        
      
        
        }
    }
}
    public function ProduitsCourants(Request $req)
    { 
       try{ 
       
       $listProduits = DB::table('detailcommandes')
       ->join('commandes', 'commandes.id', '=', 'commandes_id')
       ->join('produits', 'produits.id', '=', 'detailcommandes.produits_id')
       ->join('clients','clients.id', '=', 'commandes.clients_id')
       ->join('signatures', 'signatures.id', '=', 'detailcommandes.signatures_id')
       ->select( 'commandes.id',
       DB::raw('Time(detailcommandes.date_collecte)as heurecom'),
       'produits.name as namepr','produits.description as descpr','produits.qte as qtepr'
       ,'produits.prixini as prixini','produits.prix as prixpr'
       ,'detailcommandes.qte as qtedet',DB::raw('Date(detailcommandes.date_collecte)as datecollecte'),
       DB::raw('Time(detailcommandes.date_collecte)as hcollecte'),
       DB::raw('Date(produits.started_at) as ddp'),
       DB::raw('Time(produits.started_at)as hdp'),
       DB::raw('Date(produits.finished_at) as dfp'),
       DB::raw('Time(produits.finished_at)as hfp'),
      'clients.name as namecl','produits.started_at as hd','produits.finished_at as hf','detailcommandes.place as surplace',
       'detailcommandes.emporter as emportée','detailcommandes.livraison as livrée','detailcommandes.plusl as plusl',
       'detailcommandes.adressel as adressel','detailcommandes.telephonel as telephonel','detailcommandes.plus1 as prix1',
       'detailcommandes.plus2 as prix2','detailcommandes.plus3 as prix3','detailcommandes.plus4 as prix4','detailcommandes.plus5 as prix5',
       'produits.op1 as option1','produits.op2 as option2','produits.op3 as option3','produits.op4 as option4','produits.op5 as option5')
       ->where('produits.restaurants_id',Auth::User()->id)
       ->where('commandes.id',$req->idCom)
       ->where('signatures.etat',0)
       ->orderby('detailcommandes.date_collecte','ASC')
      // ->orderby('commandes.created_at')
      ->paginate(5);
   //dd($listProduits);
 /*      foreach($listProduits as $lsP) 
       {
      return ' <tr>
        <td>'.$lsP->namepr.'</td>
        <td>'.$lsP->qtedet.'</td>
        <td><span class="tool" title1="'.$lsP->descpr.'">'.str_limit($lsP->descpr,10).'</td>
        
        
        <td>'.$lsP->datecollecte.'</td>
        <td>'.$lsP->hcollecte.'</td>
            </tr>';
       }
    
        */ 
       
           
           //dd($listCommandes);
         return view("boualam.ProduitsCourants",["listP"=>$listProduits ]);
       }
       catch(QueryException $ex){ 
         Session::flash('warning', GererErreur::verifier($ex->errorInfo[1])); 
          return  GererErreur::verifier($ex->errorInfo[1]);
       
     
       
       }}
    
       public function commandeLivree()
       {
        if(Auth::User()->verified_at==null)
        return redirect("verify");
        else{
          try{ 
              $listCommandes=DB::table('detailcommandes')
              ->join('commandes','detailcommandes.commandes_id','=','commandes.id')
              ->join('clients','clients.id','=','commandes.clients_id')
              ->join('produits','detailcommandes.produits_id','=','produits.id')
              ->join('restaurants','produits.restaurants_id','=','restaurants.id')
              ->join('signatures', 'signatures.id', '=', 'detailcommandes.signatures_id')
              ->select(DB::raw('Date(commandes.created_at)as datecom'),
              DB::raw('Time(commandes.created_at)as heurecom'),
              'clients.name as client','commandes.id as idCom',
              DB::raw('COUNT(detailcommandes.produits_id) as nbr'))->distinct()
              ->where('restaurants.id',Auth::user()->id)
              ->where('signatures.etat',1)
              ->groupby('commandes.id','clients.name','commandes.created_at')
              ->orderby('commandes.created_at','DESC')
              ->paginate(5);
             // dd($listCommandes);
             return view("boualam.commandeLivree",["list" => $listCommandes]);
          }
          catch(QueryException $ex){ 
            Session::flash('warning', GererErreur::verifier($ex->errorInfo[1])); 
             return  GererErreur::verifier($ex->errorInfo[1]);
          }
        
          
          }}
          public function produitsLivrees(Request $req)
          {
             try{ 
              
             $listProduits = DB::table('detailcommandes')
             ->join('commandes', 'commandes.id', '=', 'commandes_id')
             ->join('produits', 'produits.id', '=', 'detailcommandes.produits_id')
             ->join('clients','clients.id', '=', 'commandes.clients_id')
             ->join('signatures', 'signatures.id', '=', 'detailcommandes.signatures_id')
             ->select( 'commandes.id',
             DB::raw('Time(detailcommandes.date_collecte)as heurecom'),
             'produits.name as namepr','produits.description as descpr','produits.qte as qtepr'
             ,'produits.prixini as prixini','produits.prix as prixpr'
             ,'detailcommandes.qte as qtedet',DB::raw('Date(detailcommandes.date_collecte)as datecollecte'),
             DB::raw('Time(detailcommandes.date_collecte)as hcollecte'),
             DB::raw('Date(produits.started_at) as ddp'),
             DB::raw('Time(produits.started_at)as hdp'),
             DB::raw('Date(produits.finished_at) as dfp'),
             DB::raw('Time(produits.finished_at)as hfp'),
            'clients.name as namecl','produits.started_at as hd','produits.finished_at as hf')
             ->where('produits.restaurants_id',Auth::User()->id)
             ->where('commandes.id',$req->idCom)
             ->where('signatures.etat',1)
             ->orderby('detailcommandes.date_collecte','DESC')
            // ->orderby('commandes.created_at')
            ->paginate(5);
         //dd($listProduits);
          /*   foreach($listProduits as $lsP) 
             {
            return ' <tr>
              <td>'.$lsP->namepr.'</td>
              <td>'.$lsP->qtedet.'</td>
              <td><span class="tool" title1="'.$lsP->descpr.'">'.str_limit($lsP->descpr,10).'</td>
              
              
              <td>'.$lsP->datecollecte.'</td>
              <td>'.$lsP->hcollecte.'</td>
                  </tr>';
             }
          */
               
             
                 
                 //dd($listCommandes);
                return view("boualam.produitsLivres",["listP"=>$listProduits ]);
             }
             catch(QueryException $ex){ 
               Session::flash('warning', GererErreur::verifier($ex->errorInfo[1])); 
                return  GererErreur::verifier($ex->errorInfo[1]);
             
           
             
             }}
    public function print()
{
  //  $ListRestaurant = DB::table('restaurants')
  try{
    if(Auth::User()->verified_at==null)
    return view("ilyasse.Verificate",["list" => Auth::User()->gerant]); 
    else
    return redirect('home');  
     }catch(QueryException  $ex)
     {
         Session::flash('warning', GererErreur::verifier($ex->errorInfo[1])); 
         return redirect('home');
     }
  
}

    public function confirm(confirmRequest $rq)
    {
      
    if($rq->password==$rq->Confirmation){
       
        DB::beginTransaction();
        //dd($rq1->input());
        try{
        // $lct = new Localisation();
        // $lct->latitude=$rq->Latitude;
        // $lct->longitude=$rq->Longitude;
       
        //dd($restau->gerant);
        // $lct->save();
        $restau=Restaurant::find(Auth::User()->id);
        // $restau->localisations_id=$lct->id;
        $restau->password=hash::make($rq->password);   
        $restau->verified_at=Carbon::now();
        // dd($restau->input(''));
        $restau->save();
        DB::commit();        
        //dd($lct->id);
        return $this->index();
        }catch(QueryException  $ex)
        {
           
            Session::flash('warning', GererErreur::verifier($ex->errorInfo[1]));
            DB::rollBack(); 
            return redirect('home');
        }              
    }
}
public function check(ConfirmRequest $rq)
{
    if($this->confirm($rq))
    return redirect('/home');
    else{
        return redirect('/verify') ; 
    }     
          
}
 

    

public function ListeCommande()
{
     $listProduits = DB::table('produits')
    ->join('restaurants', 'restaurants.id', '=', 'produits.restaurants_id')
    ->join('detailcommandes', 'detailcommandes.produits_id', '=', 'produits.id')
    ->join('commandes', 'commandes.id', '=', 'detailcommandes.commandes_id')
    ->join('signatures', 'signatures.id', '=', 'detailcommandes.signatures_id')
    ->join('clients', 'clients.id', '=', 'commandes.clients_id')
    ->select( 'commandes.id as idcom',DB::raw('hour(commandes.created_at) as hccom'),
     DB::raw('Minute(commandes.created_at) as mccom'),'commandes.created_at as comcreated_at','commandes.created_at as datecom',
    'produits.id as idpr','produits.name as namepr','produits.description as descpr','produits.qte as qtepr',DB::raw('hour(produits.started_at) as hdpr')
    ,DB::raw('hour(produits.finished_at) as hfpr'),DB::raw('Minute(produits.started_at) as mdpr'),'produits.prixini as prixini','produits.prix as prixpr'
    ,'detailcommandes.qte as qtedet','clients.name as namecl','clients.tel as telcl'
    ,DB::raw('Minute(produits.finished_at) as mfpr'),DB::raw('Date(produits.started_at) as started_at'),'signatures.id as idsg','signatures.code as codesg','signatures.etat as etatsg',
    'signatures.created_at as created_atsg')
    ->where('restaurants.id',Auth::User()->id)
    ->orderBy('commandes.created_at','desc')
    ->get();
    dd($listProduits);

}
public function commandeCouranteA()
    {
   
       try{ 
           $listCommandes=DB::table('detailcommandes')
           ->join('commandes','detailcommandes.commandes_id','=','commandes.id')
           ->join('clients','clients.id','=','commandes.clients_id')
           ->join('produits','detailcommandes.produits_id','=','produits.id')
           ->join('restaurants','produits.restaurants_id','=','restaurants.id')
           ->select(DB::raw('Date(commandes.created_at)as datecom'),
           DB::raw('Time(commandes.created_at)as heurecom'),
           'clients.name as client','restaurants.id as idRes','commandes.id as idCom',
           DB::raw('COUNT(detailcommandes.produits_id) as nbr'))->distinct()
           ->where('restaurants.id',Auth::user()->id)
           ->groupby('commandes.id','restaurants.id','clients.name','commandes.created_at')
           ->orderby('commandes.created_at','DESC')
           ->paginate(10);
          // dd($listCommandes);
       
   
          foreach($listCommandes as $lsC) 
          {
         echo ' 
           <tr>
           <td>'.$lsC->client.'</td>
           <td>'.$lsC->datecom.'</td>
           <td>'.$lsC->heurecom.'</td>
           <td>'.$lsC->nbr.'</td>
           <td><button type="button" class="btn btn-info" onclick="detail('.$lsC->idCom.')">Plus_Details</button> </td> </tr>';
          }
       
       }
       catch(QueryException $ex){ 
         Session::flash('warning', GererErreur::verifier($ex->errorInfo[1])); 
          return  GererErreur::verifier($ex->errorInfo[1]);
       
     
       
       }}

public function addNoti($titre,$msg)
       {
        
          try{
            $not = new Notification();
            $not->restaurants_id=Auth::user()->id;
            $not->titre=$titre;
            $not->msg=$msg;
            $not->save();
            return 'Bien envoyé';
          }
          catch(QueryException $ex){ 
             return  GererErreur::verifier($ex->errorInfo[1]);
          }
        }
public function commandeCouranteTimer()
        {
        //    try{ 
            $resto = DB::table('restaurants')
            ->select('restaurants.cpt_com')->distinct()
            ->where('restaurants.id',Auth::user()->id)
            ->get();
               
            $comm=DB::table('detailcommandes')
            ->join('commandes','detailcommandes.commandes_id','=','commandes.id')
            ->join('clients','commandes.clients_id','=','clients.id')
            ->join('produits','detailcommandes.produits_id','=','produits.id')
            ->join('restaurants','produits.restaurants_id','=','restaurants.id')
            ->select('commandes.id','detailcommandes.date_collecte','clients.name')
            ->where('restaurants.id',Auth::user()->id)
            ->orderby('commandes.created_at','DESC')
            ->get();
            //dd($comm->count());
            if($comm->count()==$resto[0]->cpt_com){
                return [0,$comm];
            }
            else
                $nbr_com=$comm->count()-$resto[0]->cpt_com;
                return [$nbr_com,$comm];
        //    }
        //    catch(QueryException $ex){ 
        //        return "Erreur";
        //    }
       }
public function cpt_com(){
    try{ 
        $listCommandes=DB::table('detailcommandes')
        ->join('commandes','detailcommandes.commandes_id','=','commandes.id')
        ->join('produits','detailcommandes.produits_id','=','produits.id')
        ->join('restaurants','produits.restaurants_id','=','restaurants.id')
        ->select('commandes.*')
        ->where('restaurants.id',Auth::user()->id)
        ->get();
        //dd($listCommandes);
        $resto = Restaurant::find(Auth::User()->id);
        $resto->cpt_com=$listCommandes->count();
        $resto->save();
       return $resto;
    }
    catch(QueryException $ex){ 
            return  GererErreur::verifier($ex->errorInfo[1]);
         }
}

}

