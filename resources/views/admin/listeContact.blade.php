@extends('layouts.master')


@section('title')
  	Liste contacts
@endsection



@section('content')


<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" action="/admin/ajoutListe" autocomplete="off" class="form-horizontal">
            @csrf

            <div class="card ">
              <div class="card-header card-header-primary">

                <h4 class="card-title">Ajout d'une liste</h4>
              </div>
              <div class="card-body ">

                <div class="form-group row">

                        <div class="col-md-6">
                            <label for="" class="col-form-label ">Nom de la liste</label>
                            <input class="form-control" type="text" name="nom" >
                        </div>

                        <div class="col-md-6">
                            <label for="" class="col-form-label ">Client</label>
                           <!--  <input class="form-control" type="text" name="intitule" > -->

                           <select class="form-control" name="client">

                            <option>Sélectionner un Client </option>

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
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title "> Listes  </h4>

          </div>

          <?php //var_dump($liste); ?>

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
             <div class="row">
                <div class="col-12 text-right">

                    <a href="#addCampagne">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                      Créer une liste 
                    </button>
                    </a>
                  
                </div>
              </div>
            <div class="table-responsive">
             
              <table class="table" id="datatableid2">
                <thead class=" text-primary">
                  <th>
                    Nom liste
                  </th>
                  
                  <th>
                    client
                  </th>

                  <th>
                    Date de création 
                  </th>
               
                  <th>
                    Modifier
                  </th>

                  <th>
                    Supprimer
                  </th>
                  
                </thead>
                <tbody>

                  @foreach ($liste as $data)

                  <tr>

                    <td>{{ $data->nomliste }}</td>
                    <td>{{ $data->nomclient }}</td>
                    <td>{{ $data->created_at }}</td>

                    <td >
                      

                      <form action="{{ url('admin/modifListe/'.$data->id)}}" method="get">
                        <div class="form-group">
                          <button type="submit" class="btn btn-warning btn-sm"><i class="material-icons">edit</i></button>
                        </div>
                      </form>
                    </td>

                    <td >
                      <form action="/admin/deleteListe/{{$data->id ?? ''}}" onsubmit="return confirm('Confirmez-vous la suppression');" method="post">
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

          <?php //var_dump($data); ?>
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