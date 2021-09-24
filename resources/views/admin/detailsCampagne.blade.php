@extends('layouts.master')


@section('title')
  Détails  Campagne
@endsection



@section('content')

<?php use App\Models\VoiceContact;
  use Illuminate\Support\Facades\DB;

 ?>

<div class="modal fade bd-example-modal-lg" id="listeModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" action="/admin/import_contactCampagne" enctype="multipart/form-data" autocomplete="off" class="form-horizontal">
            @csrf

            <div class="card ">
              <div class="card-header card-header-primary">

                <h4 class="card-title">Ajout un contact</h4>
              </div>
              <div class="card-body ">
                <div class="form-group row">
                  
                    <div class="col-md-12">
                        <input class="form-control" type="hidden"  value="{{ $campagne[0]->id }}" name="campagne">
                        <input class="form-control" type="hidden"  value="{{ $campagne[0]->idclient }}" name="client">
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

<div class="content">

  <div class="container-fluid">


    <div class="row">
      <div class="col-md-12">
        
        <form method="post" action="/admin/ajoutCampagneContact" autocomplete="off" class="form-horizontal">
            @csrf

            <div class="card ">
              <div class="card-header card-header-primary">

                <h4 class="card-title">Gestion de la campagne</h4>
              </div>
              <div class="card-body ">
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
                <div class="form-group row">
                        <div class="col-md-4">
                            <label for="" class="col-form-label ">Intitulé</label>
                            <input class="form-control" type="text"  value="{{ $campagne[0]->intitule }}" disabled>
                        </div>

                        <div class="col-md-4">
                            <label for="" class="col-form-label ">Client</label>
                            <input class="form-control" type="text"  value="{{ $campagne[0]->nomclient }}" disabled >
                        </div>
                        <div class="col-md-4">
                            <label for="" class="col-form-label ">Date de création</label>
                            <input class="form-control" type="text" value="{{ date('d-m-Y', strtotime($campagne[0]->created_at)) }} " disabled  > 
                        </div>

                        <input type="hidden" name="campagne" value="{{$campagne[0]->id}}">
                        
                </div>

                <div class="form-group row">
                        <div class="col-md-12">
                            <label for="" class="col-form-label ">Contact</label>
                            <select class="form-control select-live" multiple="multiple"  name="contact[]">

                                <option value="" >Sélectionner un contact </option>

                                @foreach($contact as $dataCon)

                                <option value="{{$dataCon->id}}" <?php

                                $existe=DB::select('select * from voice_campagne_contact where contact = "'.$dataCon->id.'"');

                                 if (!empty($existe)) {
                                  echo "selected";
                                }   ?>  >
                                  {{$dataCon->prenom}} {{$dataCon->nom}}
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

  <div class="container-fluid">


    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title "> Liste des contacts de la campagne  </h4>

          </div>
          <div class="card-body">
           
             <div class="row">
                <div class="col-12 text-right">

             
                    <a href="#addListe">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#listeModal">
                      Ajouter par lot
                    </button>
                  </a>
                  
                  
                </div>

              </div>
            <div class="table-responsive">
             
              <table class="table" id="datatableid2">
                <thead class=" text-primary">
                  <th>
                    Prénom
                  </th>
                   <th>
                    Nom
                  </th>
                  <th>
                    Téléphone
                  </th>

                  <th>
                    Détails
                  </th>
               
                  <th>
                    Modifier
                  </th>

                  <th>
                    Supprimer
                  </th>
                  
                </thead>
                <tbody>

                @foreach($contactCampagne as $dataContactCampagne)

                  <tr>
                    <td>
                     {{$dataContactCampagne->prenom ?? '--'}}
                    </td>

                    <td>
                     {{$dataContactCampagne->nom ?? '--'}}
                    </td>

                    <td>
                     {{$dataContactCampagne->tel ?? '--'}}
                    </td>
                      
                    <td>
                     <a href="/admin/detailsContact/{{$dataContactCampagne->id}}" class="btn btn-info btn-sm"><i class="material-icons">assignment</i></a>
                    </td>
                    
                    <td >
                      <form action="{{ url('admin/modifContact/'.$dataContactCampagne->id)}}" method="get">
                        <div class="form-group">
                          <button type="submit" class="btn btn-warning btn-sm"><i class="material-icons">edit</i></button>
                        </div>
                      </form>
                    </td>

                    <td>
                     <form action="/admin/deleteContactCampagne/{{$dataContactCampagne->idcam}}" onsubmit="return confirm('Confirmez-vous la suppression');" method="post">
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

              
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>
@endsection


@section('scripts')

@endsection