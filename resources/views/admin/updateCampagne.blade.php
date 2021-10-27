@extends('layouts.master')


@section('title')
  Modifier Campagne
@endsection



@section('content')
    <div class="container-fluid">
        <div class="row">

          <div class="col-md-12">

          @if ($_SESSION['profil']==1 || $_SESSION['profil'] == 2)
          <form method="post" action="/admin/update-campagne-saving/{{ $campagne[0]->id }}" autocomplete="off" class="form-horizontal">
          @elseif($_SESSION['profil']==3 || $_SESSION['profil'] == 4)
          <form method="post" action="/client/update-campagne-saving/{{ $campagne[0]->id }}" autocomplete="off" class="form-horizontal">
          @endif

            <!-- <form method="post" action="/admin/update-campagne-saving/{{ $campagne[0]->id }}" autocomplete="off" class="form-horizontal"> -->
                @csrf
                @method('put')

                <div class="card card-header-color">
                  <div class="card-header card-header-primary">

                    <h4 class="card-title">Modification d'une campagne</h4>
                  </div>
                  <div class="card-body card-body-color">
                    <div class="form-group row">
                        @if ($_SESSION['profil']==1 || $_SESSION['profil'] == 2)
                        <div class="col-md-6">
                            <label for="" class="col-form-label ">Intitulé</label>

                            <input class="form-control input-color" type="text" name="intitule" value="{{ $campagne[0]->intitule }}">
                        </div>
                        <div class="col-md-6">
                          <label for="" class="col-form-label ">Client</label>
                          <select class="form-control select-live2 input-color" name="client">
                            <option>Sélectionner un client</option>
                            @foreach($client as $dataClient)
                              <option value="{{$dataClient->id}}" {{ $dataClient->id == $campagne[0]->client ? 'selected' : '' }} >{{$dataClient->nom}}</option>
                            @endforeach
                          </select>
                        </div>
                        @elseif ($_SESSION['profil']==3 || $_SESSION['profil'] == 4)
                        <div class="col-md-12">
                            <label for="" class="col-form-label ">Intitulé</label>

                            <input class="form-control input-color" type="text" name="intitule" value="{{ $campagne[0]->intitule }}">
                        </div>
                        
                        @endif
                    </div>
                    
                  </div>
                  <div class="card-footer ml-auto mr-auto card-footer-color">
                    <a class="btn btn-danger" data-dismiss="modal">Annuler</a>
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
