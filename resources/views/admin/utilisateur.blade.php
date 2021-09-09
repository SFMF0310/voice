@extends('layouts.master')


@section('title')
  Utilisateurs
@endsection



@section('content')

<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" action="/admin/ajoutUtilisateur" autocomplete="off" class="form-horizontal">
            @csrf

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">Ajout utilisateur</h4>
              </div>
              <div class="card-body ">
                <div class="form-group row">
                        <div class="col-md-6">
                            <label for="" class="col-form-label">Utilisateur</label>
                            
                            <select class="form-control select-live" name="utilisateur">
                              <option>--Sélectionner un utilisateur</option>

                              @foreach($mlUser as $dataUser)

                              <option value="{{$dataUser->id}}">{{$dataUser->prenom}} {{$dataUser->nom}} - {{$dataUser->login}} </option>

                              @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="col-form-label">Rôle</label>
                            
                            <select class="form-control select-live2" name="role">
                              <option>--Sélectionner le rôle</option>

                              @foreach($role as $dataRole)

                              <option value="{{$dataRole->id_role}}"> {{$dataRole->designation}}  </option>

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

          @if($_SESSION['role']=='Admin')
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Liste des utilisateurs</h4>
            <?php 
            $user1 = cas()->getUser();
            $login = DB::table('ml_users')->where('login', $user1)->first();

            $if_profil_exist =DB::table('dash_profil')
            ->join('ml_users','ml_users.id','=','dash_profil.id_user') 
            ->join('dash_roles','dash_profil.id_role','=','dash_roles.id_role')
            ->where('dash_profil.id_user' ,'=' ,$login->id)->first();





            //var_dump($if_profil_exist[0]->designation);
            //echo "$if_profil_exist->designation";
            ?>
          </div>
          <div class="card-body">
           
              @if (session('success'))
                <div class="alert alert-success" role="alert">
                  <strong>{{session('success')}}</strong>
                </div>
              @endif
              <div class="row">
                  <div class="col-12 text-right">
                    <a href="#addUser">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Ajouter un utilisateur
                      </button>
                    </a>
                  </div>
              </div>


            <div class="table-responsive">
             <?php //var_dump($financement); ?>
              <table class="table" id="datatableid2">
                <thead class=" text-primary">

                  <th>
                    Prenom 
                  </th>
                  <th>
                    Nom 
                  </th>
                  <th>
                    Email 
                  </th>


                  <th>
                    Login 
                  </th>

                  <th>
                    Tel 
                  </th>
                 
                  <th>
                    Modifier
                  </th>
                  <th>
                    Supprimer
                  </th>
                  
                  
                </thead>
                <tbody>
               
               @foreach($user as $data)
                  <tr>
                   
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

                    
                   

                    <td >
                      

                      <form action="{{ url('admin/modifUtilisateur/'.$data->id)}}" method="get">
                        <div class="form-group">
                          <button type="submit" class="btn btn-warning btn-sm"><i class="material-icons">edit</i></button>
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
          </div>
          @else
          <h2>Vous n'avez pas l'autorisation de consulter cette page</h2>
          @endif
        </div>
      </div>
      
    </div>
  </div>
</div>
@endsection


@section('scripts')

@endsection