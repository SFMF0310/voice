@extends('layouts.master')


@section('title')
  Modifier Utilisateur
@endsection



@section('content')

  <div class="container-fluid">
    <div class="row">

      @foreach($user as $data)

      <div class="col-md-12">
        <form method="post" action="/admin/update-utilisateur-saving/{{ $data->id }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">Modification utilisateurs </h4>
              </div>
              <div class="card-body ">

                <div class="form-group row">
                        <div class="col-md-12">
                            <label for="" class="col-form-label">Utilisateur</label>
                            
                            <input class="form-control" type="text" name="prenom" value="{{$data->prenom}} {{$data->nom}} ({{$data->prenom}})" disabled>
                        </div>
                        <div class="col-md-12">
                            <label for="" class="col-form-label">Role</label>
                            
                            <select class="form-control" name="profil">
                              @foreach($role as $dataRole)
                                  <option value="{{$dataRole->id}}" {{ $dataRole->id == $data->profil ? 'selected' : '' }} >{{$dataRole->intitule}}</option>
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
