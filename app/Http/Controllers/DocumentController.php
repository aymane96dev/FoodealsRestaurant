<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Document;
use App\Restaurant;
use App\Client;
use Illuminate\Http\Request;
use App\Http\Requests\MyRequest;
use Auth;
use Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use App\GererErreur;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {        
        if ($id != Auth::User()->id)
        {
            return view("boualam.erreur");
        }
        else
        {
            try
            { 
                $listDocument=DB::table('documents')
                ->join('restaurants', 'documents.restaurants_id', '=','restaurants.id')
                ->select('documents.*')
                ->where('restaurants_id',$id)
                ->orderby('created_at','DESC')
                ->paginate(8);
               // dd($listProduit);

                 return view("boualam.documents",["list" => $listDocument]);
            }
            catch(QueryException $ex){ 
            Session::flash('warning', GererErreur::verifier($ex->errorInfo[1])); 
            return  GererErreur::verifier($ex->errorInfo[1]);
            }
        } 
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MyRequest $request)
    {
        //dd($request->input());
            try
            { 
            $doc=new Document();
            $doc->titre=$request->titre;
            if($request->hasFile('fichier'))
            {
                $doc->fichier=$request->fichier->store('images','public');
            }
            $doc->description=$request->description;
            $doc->restaurants_id=Auth::User()->id;
            $doc->save();

            Session::forget('warning');

            Session::flash('success','Bien enregistrer');
            return redirect('documents/'.Auth::User()->id);
        }
        catch(QueryException $ex){ 
        Session::forget('warning');
        Session::flash('warning', GererErreur::verifier($ex->errorInfo[1])); 
        return redirect('documents/'.Auth::User()->id);
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { try
        { //dd($id);
        $doc=Document ::find($id);
        $doc->delete();  
        Session::flash('success','Bien enregistrer');
        return redirect('documents/'.Auth::User()->id);
        }
        catch(QueryException $ex){ 
        Session::flash('warning', GererErreur::verifier($ex->errorInfo[1])); 
        return redirect('documents/'.Auth::User()->id);
        }      
    }


    public function test(Request $rq){
        $doc=Restaurant ::find($rq->id);
        return Response()->json($doc);
    }



    
}    


 



