@extends('layouts.master')


@section('title')
  Modifier Utilisateur
@endsection



@section('content')

  <div class="container-fluid">
    <div class="row">

      @foreach($liste as $data)

      <div class="col-md-12">
        <form method="post" action="/admin/update-liste-saving/{{ $data->id }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">Modification liste </h4>
              </div>
              <div class="card-body ">

                <div class="form-group row">
                        <div class="col-md-12">
                            <label for="" class="col-form-label">Nom liste</label>
                            
                            <input class="form-control" type="text" name="nom" value="{{$data->nomliste}}" >
                        </div>
                        <div class="col-md-12">
                            <label for="" class="col-form-label">Client</label>
                            
                            <select class="form-control" name="client">
                              @foreach($client as $dataClient)
                                  <option value="{{$dataClient->id}}" {{ $dataClient->id == $data->client ? 'selected' : '' }} >{{$dataClient->nom}}</option>
                              @endforeach
                              
                            </select>
                        </div>
                </div>
                
              </div>
              <div class="card-footer ml-auto mr-auto">
                <a href="/admin/utilisateur" class="btn btn-danger" data-dismiss="modal">retour à la liste</a>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
              </div>
            </div>
      </form>
      </div>

      @endforeach

    </div>
  </div>

@endsection


@section('scripts')

@endsection
