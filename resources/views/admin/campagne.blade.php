@extends('layouts.master')


@section('title')
  	Campagne
@endsection



@section('content')

<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    @if ($_SESSION['profil']==1 || $_SESSION['profil'] == 2)
      <form method="post" action="/admin/ajoutCampagne" autocomplete="off" class="form-horizontal">
    @elseif($_SESSION['profil']==3 || $_SESSION['profil'] == 4)
    <form method="post" action="/client/ajoutCampagne" autocomplete="off" class="form-horizontal">
    @endif
            @csrf

            <div class="card ">
              <div class="card-header card-header-color" >

                <h4 class="card-title">Ajout d'une campagne</h4>
              </div>
              <div class="card-body card-body-color " >

              @if ($_SESSION['profil']==1 || $_SESSION['profil'] == 2)
                <div class="form-group row">
                        <div class="col-md-6">
                            <label for="" class="col-form-label ">Intitulé</label>
                            <input class="form-control input-color" type="text" name="intitule" >
                        </div>

                        <div class="col-md-6">
                            <label for="" class="col-form-label ">Client</label>
                            <select class="form-control select-live2 input-color" name="client">
                              <option>Sélectionner un client</option>
                              @foreach($client as $dataClient )
                                <option value="{{$dataClient->id}}">{{$dataClient->nom }}</option>
                              @endforeach
                            </select>
                        </div>

                </div>

              @elseif($_SESSION['profil']==3 || $_SESSION['profil'] == 4)
                <div class="form-group row">
                        <div class="col-md-12">
                            <label for="" class="col-form-label ">Intitulé</label>
                            <input class="form-control input-color" type="text" name="intitule" >
                        </div>

                </div>
              @endif

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


<div class="content">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-12">
                <div class="card-body col-md-12">
                    <div class="container">
                        <div class="container">
                            <div>
      <!-- <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title "> Liste des campagnes   </h4>

          </div>
          <div class="card-body"> -->
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
            <div class="row ">
                <div class="col-12 d-flex justify-content-end ">


                    <a href="#addCampagne" class="">
                    <button type="button" class="btn btn-success " data-toggle="modal" data-target="#exampleModal">
                      Ajouter une campagne
                    </button>
                    </a>


                </div>
            </div>
            <!--  <div class="table-responsive"> -->

              <table class="table display" id="datatableid2">
                <thead class=" text-primary thead">
                  <th class="text-dark">
                    Intitulé
                  </th>
                  <th class="text-dark">
                    Client
                  </th>
                  <th class="text-dark">
                    Créé par
                  </th>
                  <th class="text-dark">
                    Date de création
                  </th>

                  <th class="text-dark">
                    Modifier
                  </th>

                  <th class="text-dark">
                    Supprimer
                  </th>

                </thead>
                <tbody>

                  @foreach($campagne as $data )

                  <tr class="tr">
                    <td>
                    @if ($_SESSION['profil']==1 || $_SESSION['profil'] == 2)
                    <a href="/admin/detailsCampagne/{{$data->id}}"> {{ $data->intitule }} </a>
                    @elseif($_SESSION['profil']==3 || $_SESSION['profil'] == 4)
                    <a href="/client/detailsCampagne/{{$data->id}}"> {{ $data->intitule }} </a>
                    @endif
                    </td>

                    <td>
                     {{$data->nomclient}}
                    </td>

                    <td>
                     {{ $data->prenom }} {{ $data->nom }}
                    </td>

                    <td>
                     {{ $data->created_at }}
                    </td>

                    <td >
                    @if ($_SESSION['profil']==1 || $_SESSION['profil'] == 2)
                     {{-- <form action="{{ url('admin/modifCampagne/'.$data->id)}}" method="get">
                        <div class="form-group">
                          <button type="submit" class="btn btn-warning btn-sm"><i class="material-icons">edit</i></button>
                        </div>
                      </form> --}}
                        <a href="{{ url('admin/modifCampagne/'.$data->id)}}" target="_blank"><i class="material-icons text-secondary">edit</i></a>
                    @elseif($_SESSION['profil']==3 || $_SESSION['profil'] == 4)
                     {{-- <form action="{{ url('client/modifCampagne/'.$data->id)}}" method="get">
                        <div class="form-group">
                          <button type="submit" class="btn btn-warning btn-sm"><i class="material-icons">edit</i></button>
                        </div>
                      </form> --}}
                        <a href="{{ url('client/modifCampagne/'.$data->id)}}" target="_blank"><i class="material-icons text-secondary">edit</i></a>
                    @endif

                    </td>

                    <td>
                    @if ($_SESSION['profil']==1 || $_SESSION['profil'] == 2)
                      {{-- <form action="/admin/deleteCampagne/{{$data->id ?? ''}}" onsubmit="return confirm('Confirmez-vous la suppression');" method="post">
                        @csrf

                        <div class="form-group">

                            <button type="submit" class="btn btn-danger btn-sm"><i class="material-icons">delete</i></button>
                        </div>

                      </form> --}}
                       <a href="{{ url('admin/deleteCampagne/'.$data->id)}}" onclick="return confirm('Confirmez-vous la suppression')" target="_blank"><i class="material-icons text-dark">delete</i></a>

                    @elseif($_SESSION['profil']==3 || $_SESSION['profil'] == 4)
                      {{-- <form action="/client/deleteCampagne/{{$data->id ?? ''}}" onsubmit="return confirm('Confirmez-vous la suppression');" method="post">
                        @csrf

                        <div class="form-group">

                            <button type="submit" class="btn btn-danger btn-sm"><i class="material-icons">delete</i></button>
                        </div>

                      </form> --}}
                      <a href="/client/deleteCampagne/{{$data->id ?? ''}}" onclick="return confirm('Confirmez-vous la suppression')"><i class="material-icons text-dark">delete</i></a>
                    @endif

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
