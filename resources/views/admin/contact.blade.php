@extends('layouts.master')


@section('title')
  	Contact
@endsection



@section('content')


<?php
use App\Models\VoiceLocalite;
use App\Models\VoiceClient;



?>

<div class="modal fade bd-example-modal-lg" id="listeModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" action="/admin/import_contact" enctype="multipart/form-data" autocomplete="off" class="form-horizontal">
            @csrf

            <div class="card ">
              <div class="card-header card-header-primary">

                <h4 class="card-title">Ajout un contact</h4>
              </div>
              <div class="card-body ">
                <div class="form-group row">
                  <div class="col-md-6">
                      <label for="" class="col-form-label ">Client</label>
                     <select class="form-control" name="client">

                        <option value="" >Sélectionner un Client </option>

                        @foreach($client as $dataClient)

                        <option value="{{$dataClient->id}}">
                          {{$dataClient->nom}}
                        </option>

                        @endforeach
                       </select>
                  </div>
                    <div class="col-md-6">
                        <label for="" class="col-form-label ">Fichier</label>

                          <div class="form-group form-file-upload form-file-multiple">
                            <input type="file" multiple="" class="inputFileHidden" name="csv_file">
                            <div class="input-group">
                                <input type="text" class="form-control inputFileVisible" placeholder="Importer le fichier" name="csv_file">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-fab btn-round btn-primary">
                                        <i class="material-icons">attach_file</i>
                                    </button>
                                </span>
                            </div>
                          </div>

                    </div>

                </div>

              </div>
              <span style="margin-left: 30px;">Télécharger le modèle <a target="__blanc" href=" {{asset('assets/modeleContact/modeleliste.csv') }}">ICI</a></span>
              <div class="card-footer ml-auto mr-auto">
                <a class="btn btn-danger" data-dismiss="modal">Annuler</a>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
              </div>
            </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" action="/admin/ajoutContact" autocomplete="off" class="form-horizontal">
            @csrf

            <div class="card ">
              <div class="card-header card-header-primary">

                <h4 class="card-title">Ajout d'un contact</h4>
              </div>
              <div class="card-body ">
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="" class="col-form-label ">Prénom</label>
                        <input class="form-control" type="text" name="prenom" >

                    </div>
                    <div class="col-md-6">
                        <label for="" class="col-form-label ">Nom</label>
                        <input class="form-control" type="text" name="nom" >
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="" class="col-form-label ">Genre</label>
                        <select class="form-control 2" name="genre">
                          <option value="" >Sélectionner le genre </option>
                           <option value="H">Homme</option>
                           <option value="F">Femme</option>
                        </select>

                    </div>
                    <div class="col-md-6">
                        <label for="" class="col-form-label ">Date de naissance</label>
                        <input class="form-control" type="date" name="date_naissance" >
                    </div>
                </div>
                <div class="form-group row">

                    <div class="col-md-6">
                        <label for="" class="col-form-label ">lieu de naissance</label>
                         <input class="form-control" type="text" name="lieu_naissance" >
                    </div>

                    <div class="col-md-6">
                        <label for="" class="col-form-label ">Adresse</label>
                        <input type="text" class="form-control" name="adresse">

                    </div>


                </div>

                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="" class="col-form-label">Departement</label>
                    <select class="form-control " name="departement" id="departement" >
                      <option value="">--Sélectionnez le département</option>
                      @foreach($departement as $dataDep)

                        <option value="{{$dataDep->id}}">
                          {{$dataDep->nom}}
                        </option>

                      @endforeach
                  </select>
                  </div>

                  <div class="col-md-6">
                    <label for="" class="col-form-label ">Commune</label>
                    <select class="form-control " name="commune" id="commune" >
                      <option value="">--Sélectionnez la commune</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">

                    <div class="col-md-6">

                        <label for="" class="col-form-label ">Localité</label>

                        <select class="form-control " name="localite" id="localite" >

                            <option value="" >Sélectionner une localité </option>


                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="" class="col-form-label ">Téléphone</label>
                        <input class="form-control" type="text" name="tel" >
                    </div>

                </div>

                <div class="form-group row">

                        <div class="col-md-6">

                            <label for="" class="col-form-label ">Langue de réception</label>

                            <select class="form-control " name="langue_reception">

                                <option value="" >Sélectionner une langue </option>

                                @foreach($langue as $dataLangue)

                                <option value="{{$dataLangue->id}}">
                                  {{$dataLangue->nom}}
                                </option>

                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="col-form-label ">Client</label>
                           <!--  <input class="form-control" type="text" name="intitule" > -->

                           <select class="form-control 2" name="client">

                            <option value="" >Sélectionner un Client </option>

                            @foreach($client as $dataClient)

                            <option value="{{$dataClient->id}}">
                              {{$dataClient->nom}}
                            </option>

                            @endforeach
                           </select>
                        </div>
                </div>

              </div>
              <div class="card-footer ml-auto mr-auto">
                <a class="btn btn-danger" data-dismiss="modal">Annuler</a>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
              </div>
            </div>
      </form>
    </div>
  </div>
</div>


<div class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-md-12">
        {{-- <div class="card"> --}}
          {{-- <div class="card-header card-header-primary">
            <h4 class="card-title "> Liste des contacts   </h4>

          </div> --}}
          <div class="card-body">
            @if (session('success'))
              <div class="alert alert-success" role="alert">
                <strong>{{session('success')}}</strong>
              </div>
            @endif
            @if (session('status'))
              <div class="alert alert-danger" role="alert">
                <strong>{{session('status')}}</strong>
              </div>
            @endif
             {{-- <div class="row"> --}}
                <div class="d-flex justify-content-between">
                    <div class="">
                        <a href="#addCampagne" class="">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                              Ajouter un contact
                            </button>
                            </a>

                    </div>

                    <div class="ml-3 ">
                        <a href="#addListe">
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#listeModal">
                            Ajouter par lot
                            </button>
                        </a>
                    </div>

                </div>
              {{-- </div> --}}
            <div class="mt-5 table-responsive">
            
              @if ($_SESSION['user']==1 || $_SESSION['user'] == 2)
              <table class="table display" id="datatableid2">
                <thead class=" text-primary thead">
                  <th class="text-dark">
                    Prénom
                  </th>
                  <th class="text-dark">
                    Nom
                  </th>
                  <th class="text-dark">
                    Genre
                  </th>

                  <th class="text-dark">
                    Tel
                  </th>

                  <th class="text-dark">
                    Localite
                  </th>

                  <th class="text-dark">
                    Client
                  </th>

                  <th class="text-dark">
                    Détails
                  </th>

                  <th class="text-dark">
                    Modifier
                  </th>

                  <th class="text-dark">
                    Supprimer
                  </th>

                </thead>
                <tbody>

                
                  @foreach($contact as $dataCon)
                    <tr class="tr">
                      <td>{{$dataCon->prenom ?? '--'}} </td>
                      <td>{{$dataCon->nom ?? '--'}}</td>
                      <td>{{$dataCon->genre ?? '--'}}</td>
                      <td>{{$dataCon->tel ?? '--'}}</td>
                      <td>

                        <?php //use App\Models\VoiceLocalite;
                        //use App\Models\VoiceLocalite;
                        if (!empty($dataCon->localite)) {

                          $locCon= VoiceLocalite::findOrFail($dataCon->localite);

                          echo $locCon->nom;
                        }else{
                          echo "--";
                        }


                        ?>


                      </td>
                      <td>

                        <?php //use App\Models\VoiceLocalite;
                        //use App\Models\VoiceLocalite;
                        if (!empty($dataCon->client)) {

                          $clCon= VoiceClient::findOrFail($dataCon->client);

                          echo $clCon->nom;
                        }else{
                          echo "--";
                        }


                        ?>
                      </td>
                      <td><a href="/admin/detailsContact/{{$dataCon->id}}" class="btn btn-success btn-sm"><i class="material-icons">assignment</i></a></td>
                      <td>
                        <form action="{{ url('admin/modifContact/'.$dataCon->id)}}" method="get">
                          <div class="form-group">
                            <button type="submit" class="btn btn-secondary btn-sm"><i class="material-icons">edit</i></button>
                          </div>
                        </form>
                    </td>
                      <td>
                       <form action="/admin/deleteContact/{{$dataCon->id ?? ''}}" onsubmit="return confirm('Confirmez-vous la suppression');" method="post">
                        @csrf

                        <div class="form-group">

                            <button type="submit" class="btn btn-danger btn-sm"><i class="material-icons">delete</i></button>
                        </div>

                      </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              @elseif ($_SESSION['user']==3 || $_SESSION['user'] == 4)
                    
                <table class="table display" id="datatableid2">
                  <thead class=" text-primary thead">
                    <th class="text-dark">
                      Prénom
                    </th>
                    <th class="text-dark">
                      Nom
                    </th>
                    <th class="text-dark">
                      Genre
                    </th>

                    <th class="text-dark">
                      Tel
                    </th>

                    <th class="text-dark">
                      Localite
                    </th>
                    
                    <th class="text-dark">
                      Détails
                    </th>

                    <th class="text-dark">
                      Modifier
                    </th>

                    <th class="text-dark">
                      Supprimer
                    </th>

                  </thead>
                  <tbody>

                  
                    @foreach($contact as $dataCon)
                      <tr class="tr">
                        <td>{{$dataCon->prenom ?? '--'}} </td>
                        <td>{{$dataCon->nom ?? '--'}}</td>
                        <td>{{$dataCon->genre ?? '--'}}</td>
                        <td>{{$dataCon->tel ?? '--'}}</td>
                        <td>

                          <?php //use App\Models\VoiceLocalite;
                          //use App\Models\VoiceLocalite;
                          if (!empty($dataCon->localite)) {

                            $locCon= VoiceLocalite::findOrFail($dataCon->localite);

                            echo $locCon->nom;
                          }else{
                            echo "--";
                          }


                          ?>


                        </td>
                       
                        <td><a href="/admin/detailsContact/{{$dataCon->id}}" class="btn btn-success btn-sm"><i class="material-icons">assignment</i></a></td>
                        <td>
                          <form action="{{ url('admin/modifContact/'.$dataCon->id)}}" method="get">
                            <div class="form-group">
                              <button type="submit" class="btn btn-secondary btn-sm"><i class="material-icons">edit</i></button>
                            </div>
                          </form>
                      </td>
                        <td>
                        <form action="/admin/deleteContact/{{$dataCon->id ?? ''}}" onsubmit="return confirm('Confirmez-vous la suppression');" method="post">
                          @csrf

                          <div class="form-group">

                              <button type="submit" class="btn btn-danger btn-sm"><i class="material-icons">delete</i></button>
                          </div>

                        </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>

              @endif
              <div class="col-12 text-left">
                  <!-- <a href="#addListe">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#listeModal">
                    Ajouter par lot
                  </button>
                  </a> -->
              </div>

            </div>
          </div>
        {{-- </div> --}}
      </div>

    </div>
  </div>
</div>
@endsection


@section('scripts')

@endsection
