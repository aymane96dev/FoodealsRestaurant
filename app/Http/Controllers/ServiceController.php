<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Client;
use App\Produit;
use App\Restaurant;
use App\Signature;
use App\Commande;
use App\Detailcommande;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\GererErreur;
use Carbon\Carbon;


class ServiceController extends Controller
{
    public function loginClient(Request $rq){
        try
            { 
                $client=DB::table('clients')
            
                ->select('clients.*')
                ->where('clients.email',$rq->input('email'))
               // ->where('clients.email',$rq->input('email'))
                ->get();
            
        
    return Response()->json($client);
    }

catch(QueryException $ex){ 
    return Response()->json(["Erreur"=>"Error"]);
}



}


public function InsererClient(Request $rq){
    try
        { 
    $cli=new Client();
    $cli->name=$rq->name;
    $cli->tel=$rq->tel;
    $cli->sexe=$rq->sexe;
    $cli->email=$rq->email;
    $cli->password=Hash::make($rq->password);
    $cli->save();
    
    return Response()->json(["erreur"=>"300","msg"=>"enregistre"]);
}

catch(QueryException $ex){ 
return Response()->json(["erreur"=>"304","msg"=>"error"]);
}  
}



public function listPro(Request $rq)
 {
    
    try{ 
        
        $listProduit=DB::table('produits')
        ->select('produits.*')
        ->where('restaurants_id',$rq->id)
        ->get();
        
        return Response()->json($listProduit);
        }
    catch(QueryException $ex){ 
        return Response()->json(["erreur"=>"304","msg"=>"error"]);
    
  
    }
    }

    public function login(Request $request){
        try {
            
                 $resto = DB::table('restaurants')
                 ->select('restaurants.*')
                 ->where('restaurants.email',$request->input('Email'))
                 ->where('restaurants.password',Hash::make($request->input('Password')))
                 ->get();
                // dd($request->email);
                return response()->json($resto);
            
        } catch (QueryException  $ex) {
            return response()->json(['Error'=>'404']);        
        }} 

        public function SupprimerPro(Request $request){
            try {
              ////  dd($request->input());
            $proudInDCom=DB::table('detailcommandes')
            ->join('produits', 'produits.id', '=','detailcommandes.produits_id')
            ->select('detailcommandes.produits_id')
            ->where('detailcommandes.produits_id',$request->id)
            ->where('produits.restaurants_id',$request->restaurants_id)
            ->get();
    //dd($proudInDCom);
            
             if(sizeof($proudInDCom)==0){
                $Pro = Produit::find($request->id);
                $Pro->deleted_at= Carbon::now();
                $Pro->save();
                return Response()->json(["erreur"=>"300","msg"=>"Bien Supprimé"]);
    
             }
             else if(sizeof($proudInDCom)!=0){
                $Pro = Produit::find($request->id);
                $Pro->canceled_at= Carbon::now();
                $Pro->save();
                return Response()->json(["erreur"=>"301","msg"=>"Bien annulé"]);
    
             }
             
                    
                else 
                return Response()->json(["erreur"=>"304","msg"=>"erreur: déjà commandé"]); 
            
        } catch (QueryException  $ex) {
             return Response()->json(["erreur"=>"304","msg"=>"error"]);        
        } 
            
        }







public function AjouterPanier(Request $request){
    try {
        
        //return response()->json(json_decode($request->input('array'))); 
        DB:: beginTransaction();
    $req=json_decode($request->input('array'));
    
     
   
        $sortedData = array();
        $i=0;
       
        foreach ($req as $element) {
           
            $timestamp = strtotime($element->dateCollete."".$element->hCollete);
           
            $date = date("Y-m-d H:i", $timestamp); 
            //return response()->json(['message'=> sizeof($sortedData)]);
            if ( ! isSet($sortedData[$date]) ) { 
                $sortedData[$i] = $element;
            } else { 
                $sortedData[$i] = $element;
            }
            $i++;
        }
        //return response()->json(['message'=> sizeof($sortedData)]);
        
    
    $tab=array(array($sortedData[0]));
      
       $k=0;
        for($i=1;$i<sizeof($sortedData);$i++){
            
             $hc1=strtotime($sortedData[$i-1]->hCollete);
            // 
             $dc1=strtotime($sortedData[$i-1]->dateCollete);
             $hc2=strtotime($sortedData[$i]->hCollete);
             $dc2=strtotime($sortedData[$i]->dateCollete);
             $total1=$dc1+$hc1;
             $total2=$dc2+$hc2;
             if($total1==$total2){
                array_push($tab[$k],$req[$i]);
             }
             else {
                $k++;
                array_push($tab,array($req[$i]));  
              }}
              
             // dd($tab);
              
              $cmd = new Commande();
              $cmd->clients_id=$tab[0][0]->idClient;
              $cmd->save();
              for($i=0;$i<sizeof($tab);$i++){
                $signature=new Signature();
                $signature->etat=0;
                $signature->code=md5(microtime());
                $signature->save();
         
                for($k=0;$k<sizeof($tab[$i]);$k++){
               $date= $tab[$i][$k]->dateCollete;
               $heure= $tab[$i][$k]->hCollete;
               $date_collecte= $date." ".$heure.":00";
    
              
              
                     $detail_cmd=new Detailcommande();
                     $detail_cmd->commandes_id=$cmd->id;
                     $detail_cmd->produits_id=$tab[$i][$k]->idProduct;
                     $detail_cmd->qte=$tab[$i][$k]->qtePro;
                     $detail_cmd->date_collecte=$date_collecte;
                     $detail_cmd->signatures_id=$signature->id;
                     $detail_cmd->save();
    
                  }
              }
    
              DB::commit();
              return response()->json(["erreur"=>"300","message"=>"Bien ajoutee"]); 
              //return response()->json($request);
      } catch (QueryException  $ex) {
              DB::rollback();  
                  return Response()->json(["erreur"=>"304","msg"=>"error"]);  
                    } 
    }
}
