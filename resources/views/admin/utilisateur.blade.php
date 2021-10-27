@extends('layouts.master')


@section('title')
  Utilisateurs
@endsection
@section('top-menu')
    @if (in_array($_SESSION['profil'],array(1,2)))
        <li class="nav-item active">
            <a class="nav-link text-dark" href="/admin/utilisateur"><b>Utilisateurs |</b> <span class="sr-only"></span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/admin/packs">Tarifications |</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="">Mon compte</a>
        </li>
    @elseif (in_array($_SESSION['profil'],array(3)))
        <li class="nav-item active">
            <a class="nav-link text-dark" href="/client/utilisateur"><b>Utilisateurs |</b> <span class="sr-only"></span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/client/packs">Tarifications |</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="">Mon compte</a>
        </li>
    @endif

@endsection
@section('sidebar2')
      @include('layouts.sidebar.sidebar2')
@endsection


@section('content')

<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    @if (in_array($_SESSION['profil'],array(1,2)))
        <form method="post" action="/admin/ajoutUtilisateur" autocomplete="off" class="form-horizontal">
    @elseif ($_SESSION['profil'] == 3)
        <form method="post" action="/client/ajoutUtilisateur" autocomplete="off" class="form-horizontal">

    @endif
            @csrf

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">Ajout utilisateur</h4>
              </div>
              <div class="card-body ">
                <div class="form-group row">

                        <div class="col-md-12 role" >
                            <label for="" class="col-form-label">Rôle</label>

                            <select id="role" class="form-control select-live2" name="role" >
                              <option>--Sélectionner le rôle</option>

                              @foreach($role as $dataRole)
                                @if ($_SESSION['profil'] == 3 && ($dataRole->id != 2 && $dataRole->id != 3)){
                                    <option value="{{$dataRole->id}}"> {{$dataRole->intitule}}  </option>
                                }@elseif ($_SESSION['profil'] == 2 || $_SESSION['profil'] == 1 ){
                                    <option value="{{$dataRole->id}}"> {{$dataRole->intitule}}  </option>

                                }
                                @endif


                                {{-- @endif --}}

                              @endforeach
                            </select>

                        </div>

                        {{-- <div class="col-md-6" id="users">
                            <label for="" class="col-form-label">Utilisateur</label>

                            <select class="form-control select-live" name="utilisateur">
                              <option value="">--Sélectionner un utilisateur</option>

                              @foreach($mlUser as $dataUser)

                              <option value="{{$dataUser->id}}">{{$dataUser->prenom}} {{$dataUser->nom}} - {{$dataUser->login}} </option>

                              @endforeach
                            </select>
                        </div> --}}
                        <div class="col-md-6 info-personnel prenom ">
                            <label for="" class="col-form-label">Prénom </label>

                            <input class="form-control"name="prenom" >
                              {{-- <option>--Sélectionner un utilisateur</option>

                              @foreach($mlUser as $dataUser)

                              <option value="{{$dataUser->id}}">{{$dataUser->prenom}} {{$dataUser->nom}} - {{$dataUser->login}} </option>

                              @endforeach
                            </select> --}}
                        </div>
                        <div class="col-md-6 info-personnel  client" >
                            <label for="" class="col-form-label">Nom ou Intitulé</label>

                            <input class="form-control " name="nom">
                              {{-- <option>--Sélectionner un utilisateur</option>

                              @foreach($mlUser as $dataUser)

                              <option value="{{$dataUser->id}}">{{$dataUser->prenom}} {{$dataUser->nom}} - {{$dataUser->login}} </option>

                              @endforeach
                            </select> --}}
                        </div>
                        <div class="col-md-6 info-personnel client" >
                            <label for="" class="col-form-label">Email</label>

                            <input class="form-control" type="email" name="email">
                              {{-- <option>--Sélectionner un utilisateur</option>

                              @foreach($mlUser as $dataUser)

                              <option value="{{$dataUser->id}}">{{$dataUser->prenom}} {{$dataUser->nom}} - {{$dataUser->login}} </option>

                              @endforeach
                            </select> --}}
                        </div>
                        <div class="col-md-6 info-personnel client" >
                            <label for="" class="col-form-label">Téléphone</label>

                            <input class="form-control" type="tel" name="tel" pattern="^7[5-8]{1}\d{7}$">
                              {{-- <option>--Sélectionner un utilisateur</option>

                              @foreach($mlUser as $dataUser)

                              <option value="{{$dataUser->id}}">{{$dataUser->prenom}} {{$dataUser->nom}} - {{$dataUser->login}} </option>

                              @endforeach
                            </select> --}}
                        </div>
                        <div class="col-md-6 info-personnel client" >
                            <label for="" class="col-form-label">Login</label>

                            <input class="form-control" name="login">
                              {{-- <option>--Sélectionner un utilisateur</option>

                              @foreach($mlUser as $dataUser)

                              <option value="{{$dataUser->id}}">{{$dataUser->prenom}} {{$dataUser->nom}} - {{$dataUser->login}} </option>

                              @endforeach
                            </select> --}}
                        </div>
                        <div class="col-md-6 info-personnel client">
                            <label for="" class="col-form-label">Mot de passe</label>

                            <input class="form-control" type="password" name="mdp">
                              {{-- <option>--Sélectionner un utilisateur</option>

                              @foreach($mlUser as $dataUser)

                              <option value="{{$dataUser->id}}">{{$dataUser->prenom}} {{$dataUser->nom}} - {{$dataUser->login}} </option>

                              @endforeach --}}
                        </div>
                        <div class="col-md-6" id="structure" >
                            <label  for="" class="col-form-label ">Structure</label>

                            <select id="selectstructure" class="form-control select-live" name="client">
                              <option value="">--Sélectionner la structure</option>

                              @foreach($clients as $client)

                              <option value="{{$client->id}}">{{$client->nom}} </option>

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
     <div class="row ">
      {{-- <div class="col-md-12">
        <div class="card"> --}}

          @if($_SESSION['profil']=1 or $_SESSION['profil']=2  )
          {{-- <div class="card-header card-header-primary"> --}}
            {{-- <h4 class="card-title ">Liste des utilisateurs</h4> --}}
            <?php
            $user1 = cas()->getUser();
            $login = DB::table('ml_users')->where('login', $user1)->first();

            $if_profil_exist =DB::table('voice_uprofil')
            ->join('ml_users','ml_users.id','=','voice_uprofil.user')
            ->join('voice_profil','voice_uprofil.profil','=','voice_profil.id')
            ->where('voice_uprofil.user' ,'=' ,$login->id)->first();





            //var_dump($if_profil_exist[0]->designation);
            //echo "$if_profil_exist->designation";
            ?>
          {{-- </div> --}}
          {{-- <div class="card-body"> --}}

              @if (session('success'))
                {{-- <div class="alert alert-success" role="alert">
                  <strong>{{session('success')}}</strong>
                </div> --}}
              @endif
              <div class="row">
                  <div class="col-12 d-flex justify-content-end">
                    <a href="#addUser">
                      <button type="button" class="btn btn-success " data-toggle="modal" data-target="#exampleModal">
                        Ajouter un utilisateur
                      </button>
                    </a>
                  </div>
              </div>


            {{-- <div class="table-responsive"> --}}
             <?php //var_dump($financement); ?>
            <div>
              <table class="display table  " id="datatableid2">
                <thead class=" text-primary thead">

                  <th class="text-dark">
                    Prenom
                  </th>
                  <th class="text-dark">
                    Nom
                  </th>
                  <th class="text-dark">
                    Email
                  </th>


                  <th class="text-dark">
                    Login
                  </th>

                  <th class="text-dark">
                    Tel
                  </th>

                  <th class="text-dark">
                    Profil
                  </th>

                  <th class="text-dark">
                    Modifier
                  </th>
                  <th class="text-dark">
                    Supprimer
                  </th>


                </thead>
                <tbody>

               @foreach($user as $data)
                  <tr class="tr">

                    <td>
                     {{$data->prenom}}
                    </td>
                    <td>
                      {{$data->nom}}
                    </td>
                    <td>
                     {{$data->mail}}
                    </td>

                    <td>
                      {{$data->login }}
                    </td>

                    <td>
                      {{$data->tel}}
                    </td>

                    <td>
                      {{$data->intitule}}
                    </td>




                    <td >


                      <form action="{{ url('admin/modifUtilisateur/'.$data->id)}}" method="get">
                        <div class="form-group">
                          <button type="submit" class="btn btn-secondary btn-sm"><i class="material-icons">edit</i></button>
                        </div>
                      </form>
                    </td>

                    <td >
                      <form action="/admin/deleteUtilisateur/{{$data->id ?? ''}}" onsubmit="return confirm('Confirmez-vous la suppression');" method="post">
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

            {{-- </div> --}}
          {{-- </div> --}}
          @else
          <h2>Vous n'avez pas l'autorisation de consulter cette page</h2>
          @endif
        </div>
    </div>
</div>
  {{-- </div>
</div> --}}
@endsection


@section('scripts')

@endsection
