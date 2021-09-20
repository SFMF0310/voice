@extends('layouts.master')


@section('title')
  	Campagne
@endsection



@section('content')

<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" action="/admin/ajoutCampagne" autocomplete="off" class="form-horizontal">
            @csrf

            <div class="card ">
              <div class="card-header card-header-primary">

                <h4 class="card-title">Ajout d'une campagne</h4>
              </div>
              <div class="card-body ">
                <div class="form-group row">
                        <div class="col-md-12">
                            <label for="" class="col-form-label ">Intitulé</label>
                            <input class="form-control" type="text" name="intitule" >
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
            <h4 class="card-title "> Liste des campagnes   </h4>

          </div>
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
                      Ajouter une camapagne 
                    </button>
                    </a>
                  
                  
                </div>
              </div>
            <div class="table-responsive">
             
              <table class="table" id="datatableid2">
                <thead class=" text-primary">
                  <th>
                    Intitulé
                  </th>
                  <th>
                    Créé par
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

                  <tr>
                    <td>
                     
                    </td>

                    <td>
                     
                    </td>
                      
                    <td>
                     
                    </td>
                    
                    <td >
                      
                    </td>
                   

                    <td>
                     
                    </td>
                   
                  </tr>
                  
               
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