@extends('layouts.master')


@section('title')
  Modifier Contact
@endsection



@section('content')
    <div class="container-fluid">
        <div class="row">

          <div class="col-md-12">

          @if ($_SESSION['profil']==1 || $_SESSION['profil'] == 2)
            <form method="post" action="/admin/update-contact-saving/{{ $contact->id }}" autocomplete="off" class="form-horizontal">
          @else ($_SESSION['profil']==3 || $_SESSION['profil'] == 4)
          <form method="post" action="/client/update-contact-saving/{{ $contact->id }}" autocomplete="off" class="form-horizontal">
          @endif
                @csrf
                @method('put')

                <div class="card ">
                  <div class="card-header card-header-primary card-header-color">

                    <h4 class="card-title">Modification d'un contact</h4>
                  </div>
            

                                <div class="card-body card-body-color">
                                  <div class="form-group row">
                                      <div class="col-md-6">
                                          <label for="" class="col-form-label ">Prénom</label>
                                          <input class="form-control input-color" type="text" name="prenom" value="{{$contact->prenom}}">
                                      </div>
                                      <div class="col-md-6">
                                          <label for="" class="col-form-label ">Nom</label>
                                          <input class="form-control input-color" type="text" name="nom" value="{{$contact->nom}}">
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <div class="col-md-6">
                                          <label for="" class="col-form-label ">Genre</label>
                                          <select class="form-control input-color " name="genre">
                                            <option value="" >Sélectionner le genre </option>
                                             <option value="H" {{ $contact->genre == 'H' ? 'selected' : '' }} >Homme</option>
                                             <option value="F" {{ $contact->genre == 'F' ? 'selected' : '' }} >Femme</option>
                                          </select>

                                      </div>
                                      <div class="col-md-6">
                                          <label for="" class="col-form-label ">Date de naissance</label>
                                          <input class="form-control input-color" type="date" name="date_naissance" value="{{$contact->date_naissance}}" >
                                      </div>
                                  </div>
                                  <div class="form-group row">

                                      <div class="col-md-6">
                                          <label for="" class="col-form-label ">lieu de naissance</label>
                                           <input class="form-control input-color" type="text" name="lieu_naissance" value="{{$contact->lieu_naissance}}">
                                      </div>

                                      <div class="col-md-6">
                                          <label for="" class="col-form-label ">Adresse</label>
                                          <input type="text" class="form-control input-color" name="adresse" value="{{$contact->adresse}}">

                                      </div>

                                     
                                  </div>

                                  <div class="form-group row">
                                    <div class="col-md-6">
                                      <label for="" class="col-form-label">Departement</label>
                                      <select class="form-control input-color" name="departement" id="departement" >
                                        <option value="">--Sélectionnez le département</option>
                                        @foreach($departement as $dataDep)
                                          <option value="{{$dataDep->id}}" {{ $dataDep->id == $contact->departement ? 'selected' : '' }} >{{$dataDep->nom}}</option>
                                        @endforeach
                                      </select>
                                    </div>

                                    <div class="col-md-6">
                                      <label for="" class="col-form-label ">Commune</label>
                                      <select class="form-control input-color" name="commune" id="commune" >
                                        <option value="">--Sélectionnez la commune</option>
                                        @foreach($commune as $dataCom)
                                          <option value="{{$dataCom->id}}" {{ $dataCom->id == $contact->commune ? 'selected' : '' }} >{{$dataCom->nom}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                     
                                      <div class="col-md-6">

                                          <label for="" class="col-form-label ">Localité</label>

                                          <select class="form-control input-color " name="localite"  id="localite">

                                              <option value="" >Sélectionner une localité </option>

                                              
                                              @foreach($localite as $dataLoc)
                                                <option value="{{$dataLoc->id}}" {{ $dataLoc->id == $contact->localite ? 'selected' : '' }} >{{$dataLoc->nom}}</option>
                                              @endforeach
                                          </select>
                                      </div>

                                      <div class="col-md-6">
                                          <label for="" class="col-form-label ">Téléphone</label>
                                          <input class="form-control input-color" type="text" name="tel" value="{{$contact->tel}}">
                                      </div>

                                  </div>

                                  <div class="form-group row">

                                          <div class="col-md-6">

                                              <label for="" class="col-form-label ">Langue de réception</label>

                                              <select class="form-control input-color " name="langue_reception">

                                                  <option value="" >Sélectionner une langue </option>

                                                  @foreach($langue as $dataLangue)
                                                    <option value="{{$dataLangue->id}}" {{ $dataLangue->id == $contact->langue_reception ? 'selected' : '' }} >{{$dataLangue->nom}}</option>
                                                  @endforeach
                                              </select>
                                          </div>
                                          @if ($_SESSION['profil']==1 || $_SESSION['profil'] == 2)
                                          <div class="col-md-6">
                                              <label for="" class="col-form-label ">Client</label>
                                             <!--  <input class="form-control" type="text" name="intitule" > -->

                                             <select class="form-control input-color " name="client" >

                                              <option value="" >Sélectionner un Client </option>

                                              @foreach($client as $dataClient)
                                                <option value="{{$dataClient->id}}" {{ $dataClient->id == $contact->client ? 'selected' : '' }} >{{$dataClient->nom}}</option>
                                              @endforeach
                                             </select>
                                          </div>
                                          @endif
                                  </div>
                                  
                                </div>
                  <div class="card-footer ml-auto mr-auto card-footer-color">
                    <a class="btn btn-danger" data-dismiss="modal" href="url()->previous()">Annuler</a>
                    <button type="submit" class="btn btn-success">Enregistrer</button>
                  </div>
                </div>
          </form>
          </div>

        </div>
    </div>



@endsection


@section('scripts')

@endsection
