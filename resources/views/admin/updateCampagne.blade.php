@extends('layouts.master')


@section('title')
  Modifier Campagne
@endsection



@section('content')
    <div class="container-fluid">
        <div class="row">

          <div class="col-md-12">

            <form method="post" action="/admin/update-campagne-saving/{{ $campagne[0]->id }}" autocomplete="off" class="form-horizontal">
                @csrf
                @method('put')

                <div class="card ">
                  <div class="card-header card-header-primary">

                    <h4 class="card-title">Modification d'une campagne</h4>
                  </div>
                  <div class="card-body ">
                    <div class="form-group row">
                            <div class="col-md-12">
                                <label for="" class="col-form-label ">Intitulé</label>
                                <input class="form-control" type="text" name="intitule" value="{{ $campagne[0]->intitule }}">
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

@endsection


@section('scripts')

@endsection
