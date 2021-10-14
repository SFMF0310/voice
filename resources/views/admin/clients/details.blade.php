@extends('layouts.master')


@section('title')
  Dashboard
@endsection
{{-- @section('top-menu') --}}
{{-- <li class="nav-item active">
    <a class="nav-link text-dark" href="#"><b>Creer une nouvelle campagne |</b> <span class="sr-only"></span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Features</a>
</li> --}}
{{-- @endsection --}}
@section('stats-header')
{{-- <div class="content">
    <div class="container-fluid"> --}}

@endsection
{{-- @section('sidebar2')
      @include('layouts.sidebar.sidebar2')
@endsection --}}

@section('content')


<div class="content">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-12">
                <div class="card-body col-md-12">
                    <div class="container">
                        <div class="container"> 
                            <div>
                                <div class="row col-md-12  d-flex justify-content-between">
                                    <div class="card row col-md-3 bg-light ">
                                            <div class="col-md-3 d-inline-flex  bg-success rounded text-light" style="margin-top: -1em;">
                                                <i class="material-icons" style="font-size: 2.5em">person</i>
                                            </div>
                                            <p class="d-inline-flex justify-content-end top-0 d-inline">Nombre d'utilisateurs</p>
                                            <div class="card-footer bg-light d-inline-flex justify-content-end">
                                                <h2><b>2000</b></h2>
                                            </div>
                                    </div>
                                    <div class="card row col-md-3 bg-light">
                                        <div class="col-md-3 d-inline-flex  bg-success rounded text-light" style="margin-top: -1em;">
                                            <i class="material-icons" style="font-size: 2.5em">campaign</i>
                                        </div>
                                        <div class="d-inline-flex justify-content-end top-0 d-inline">
                                            <p >Nombre campagnes</p>
                                        </div>
                                        <div class="card-footer bg-light d-inline-flex justify-content-end">
                                            <h2><b>2000</b></h2>
                                        </div>
                                    </div>
                                    <div class="card row col-md-3 bg-light">
                                        <div class="col-md-3 d-inline-flex  bg-success rounded text-light" style="margin-top: -1em;">
                                            <i class="material-icons" style="font-size: 2.5em">check</i>
                                        </div>
                                        <div class="d-inline-flex justify-content-end top-0 d-inline">
                                            <p >Nombre campagnes</p>
                                        </div>                                        
                                        <div class="card-footer bg-light d-inline-flex justify-content-end">
                                            <h2><b>2000</b></h2>
                                        </div>
                                    </div>
                                    <div class="card row col-md-3 bg-light">
                                        <div class="col-md-3 d-inline-flex  bg-success rounded text-light" style="margin-top: -1em;">
                                            <i class="material-icons" style="font-size: 2.5em">priority_high</i>
                                        </div>
                                        <div class="d-inline-flex justify-content-end top-0 d-inline">
                                            <p >Nombre campagnes</p>
                                        </div>                                        
                                        <div class="card-footer bg-light d-inline-flex justify-content-end">
                                            <h2><b>2000</b></h2>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    
                                                   
                                                      
                                  </div>
                            </div>
                            <div class="mt-5">

                            <table id="datatableid2" class="display table  col-md-12">
                                <thead class="border-top thead" >
                                    <tr class="border_bottom  align-items-center">
                                        <th class="">Nom</th>
                                        <th class="">Stats</th>
                                        <th class="">Supprimer</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ( $clientProfils as $profils )
                                        <tr>
                                            <td><a class="text-dark" href="/admin/client/{{$profils->id}}/infos" target="_blank" rel="noopener noreferrer">{{ $profils->nom}}</a></td>
                                            <td><a class="text-dark" href=""><i class="material-icons">bar_chart</i></a></td>
                                            <td><a href="/admin/client/{{$profils->vpid}}/delete" class="text-danger"><i class="material-icons">delete</i></a></td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <tr>
                                            <th class="">Nom</th>
                                            <th class="">Stats</th>
                                            <th class="">Supprimer</th>
                                        </tr>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

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
