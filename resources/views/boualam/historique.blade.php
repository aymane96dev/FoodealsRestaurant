<!DOCTYPE html>
<html>

<head>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }

    th,
    td {
      text-align: left;
      border-bottom: 1px solid #ddd;
      text-align: center;
      font-family: monospace;
    }

    .info {
      font-family: monospace;
      margin-left: 65%;
    }

    .commande {
      font-size: 19px;
    }

    #header {
      position: fixed;
      border-bottom: 1px solid gray;
    }
  </style>
</head>

<body>
  <div id="header">
    <img src="{{ public_path('storage/logo.png') }}" width="100px" height="100px" />
  </div>
@if(sizeof($listClientCommandeProduit)>0)
  <div class="info">
  <img src="{{ public_path('storage/pdp.png') }}" style="border-radius:100%;" width="50px" height="50px" />
 <!-- <centre><img src="{{public_path('storage/'.$listClientCommandeProduit[0]->logoRes)}}" style="border-radius:100%;" width="50px" height="50px"></centre>-->
    <p><centre><b>{{$listClientCommandeProduit[0]->nameRes}}</b></centre></p>
    <p> Nom gérant : {{$listClientCommandeProduit[0]->nameGerant}}</p>
    <p>Téléphone : {{$listClientCommandeProduit[0]->teleRes}}</p>
    <p> Email : {{$listClientCommandeProduit[0]->emailRes}}</p>
    <p> Adresse : {{$listClientCommandeProduit[0]->adresseRes}}</p>
  </div>
    @php $v1=0; @endphp
    @foreach ($listClientCommandeProduit as $com)
    @if($v1==0)
  <table class="table">
    <thead>
      <tr>
        <th colspan="4" class="commande"> {{ date('M', strtotime( $com->date)) }}/{{ date('Y', strtotime( $com->date)) }}</th>
      </tr>
      <tr>
        <th>Date Collecte</th>
        <th>Etat</th>
        <th colspan="2">Dernière modification</th>
      </tr>
    </thead>
   
        @elseif($listClientCommandeProduit[$v1-1]->id_com!=$com->id_com)
  </table>
  <table class="table">
  <thead>
    <tr>
      <th colspan="4" class="commande"> {{ date('M', strtotime( $com->date)) }}/{{ date('Y', strtotime( $com->date)) }}</th>
    </tr>
    <tr>
      <th>Date Collecte</th>
      <th>Etat</th>
      <th colspan="2">Dernière modification</th>
    </tr>
  </thead>
     
  </tbody>
    @endif    
    <tr>

        <td>{{$com->dateCollecte}}</td>
        @if($com->etat_s == 0) <td>Pas encore</td> @else <td>Livrée</td> @endif
        <td colspan="2"> {{$com->updated_at_s}}</td>
      <td> 
          <tr>
              <td><i>Name :</i>  {{$com->name_pro}}</td>
              <td><i>Prix :</i> {{$com->prix_pro}}</td>
              <td><i>Qte :</i> {{$com->qte_dcom}}</td>
              
            
          </tr>
      </td>
    </tr>
    @php $v1++; @endphp

    @endforeach

 @else
  <!--<h2 class="text-danger font-weight-bold">Pas de Produit</h2>-->
  <br><br>
  <h3>Il n'y a aucune commande dans votre historique</h3>
  <div id="footer">

  </div>

  @endif

</body>

</html>






