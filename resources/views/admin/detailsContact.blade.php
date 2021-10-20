@extends('layouts.master')


@section('title')
  Details Contact
@endsection



@section('content')
    <div class="container-fluid">
        <div class="row">

          <div class="col-md-12">

            <!-- <form method="post" action="/admin/update-contact-saving/{{ $contact->id }}" autocomplete="off" class="form-horizontal"> -->
                @csrf
                @method('put')

                <div class="card ">
                  <div class="card-header card-header-primary">

                    <h4 class="card-title">Détails contact</h4>
                  </div>
            

                                <div class="card-body ">
                                  <div class="form-group row">
                                      <div class="col-md-6">
                                          <label for="" class="col-form-label ">Prénom</label>
                                          <input disabled class="form-control" type="text" name="prenom" value="{{$contact->prenom}}">
                                      </div>
                                      <div class="col-md-6">
                                          <label for="" class="col-form-label ">Nom</label>
                                          <input disabled class="form-control" type="text" name="nom" value="{{$contact->nom}}">
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <div class="col-md-6">
                                          <label for="" class="col-form-label ">Genre</label>
                                          <select disabled class="form-control " name="genre">
                                            <option value="" >Sélectionner le genre </option>
                                             <option value="H" {{ $contact->genre == 'H' ? 'selected' : '' }} >Homme</option>
                                             <option value="F" {{ $contact->genre == 'F' ? 'selected' : '' }} >Femme</option>
                                          </select>

                                      </div>
                                      <div class="col-md-6">
                                          <label for="" class="col-form-label ">Date de naissance</label>
                                          <input disabled class="form-control" type="date" name="date_naissance" value="{{$contact->date_naissance}}" >
                                      </div>
                                  </div>
                                  <div class="form-group row">

                                      <div class="col-md-6">
                                          <label for="" class="col-form-label ">lieu de naissance</label>
                                           <input disabled class="form-control" type="text" name="lieu_naissance" value="{{$contact->lieu_naissance}}">
                                      </div>

                                      <div class="col-md-6">
                                          <label for="" class="col-form-label ">Adresse</label>
                                          <input disabled type="text" class="form-control" name="adresse" value="{{$contact->adresse}}">

                                      </div>

                                     
                                  </div>

                                  <div class="form-group row">
                                    <div class="col-md-6">
                                      <label for="" class="col-form-label">Departement</label>
                                      <select disabled class="form-control " name="departement" id="departement" >
                                        <option  value="">--Sélectionnez le département</option>
                                        @foreach($departement as $dataDep)
                                          <option value="{{$dataDep->id}}" {{ $dataDep->id == $contact->departement ? 'selected' : '' }} >{{$dataDep->nom}}</option>
                                        @endforeach
                                      </select>
                                    </div>

                                    <div class="col-md-6">
                                      <label for="" class="col-form-label ">Commune</label>
                                      <select disabled class="form-control " name="commune" id="commune" >
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

                                          <select disabled class="form-control " name="localite">

                                              <option value="" >Sélectionner une localité </option>

                                              
                                              @foreach($localite as $dataLoc)
                                                <option value="{{$dataLoc->id}}" {{ $dataLoc->id == $contact->localite ? 'selected' : '' }} >{{$dataLoc->nom}}</option>
                                              @endforeach
                                          </select>
                                      </div>

                                      <div class="col-md-6">
                                          <label for="" class="col-form-label ">Téléphone</label>
                                          <input disabled class="form-control" type="text" name="tel" value="{{$contact->tel}}">
                                      </div>

                                  </div>

                                  <div class="form-group row">

                                          <div class="col-md-6">

                                              <label for="" class="col-form-label ">Langue de réception</label>

                                              <select disabled class="form-control " name="langue_reception">

                                                  <option value="" >Sélectionner une langue </option>

                                                  @foreach($langue as $dataLangue)
                                                    <option value="{{$dataLangue->id}}" {{ $dataLangue->id == $contact->langue_reception ? 'selected' : '' }} >{{$dataLangue->nom}}</option>
                                                  @endforeach
                                              </select>
                                          </div>

                                          @if ($_SESSION['profil']==1 || $_SESSION['profil'] == 2)
                                          <div class="col-md-6">
                                              <label for="" class="col-form-label ">Client</label>
                                             <!--  <input disabled class="form-control" type="text" name="intitule" > -->

                                             <select disabled class="form-control " name="client" >

                                              <option value="" >Sélectionner un Client </option>

                                              @foreach($client as $dataClient)
                                                <option value="{{$dataClient->id}}" {{ $dataClient->id == $contact->client ? 'selected' : '' }} >{{$dataClient->nom}}</option>
                                              @endforeach
                                             </select>
                                          </div>
                                          @endif
                                  </div>
                                  
                                </div>
                @if ($_SESSION['profil']==1 || $_SESSION['profil'] == 2)
                  <div class="card-footer ml-auto mr-auto">
                    <a class="btn btn-succes" data-dismiss="modal" href="/admin/contact">Retour</a>
                    <a class="btn btn-warning" data-dismiss="modal" href="/admin/modifContact/{{ $contact->id }}">Modifier</a>
                  </div>
                @elseif($_SESSION['profil']==3 || $_SESSION['profil'] == 4)
                  <div class="card-footer ml-auto mr-auto">
                    <a class="btn btn-succes" data-dismiss="modal" href="/client/contact">Retour</a>
                    <a class="btn btn-warning" data-dismiss="modal" href="/client/modifContact/{{ $contact->id }}">Modifier</a>
                  </div>
                @endif
                </div>
          <!-- </form> -->
          </div>

        </div>
    </div>



@endsection


@section('scripts')

@endsection
