@extends('layouts.master')


@section('title')
  Dashboard
@endsection

@section('stats-header')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">person</i>
              </div>
              <p class="card-category">Nombre d'utilisateurs</p>
              {{-- <h3 class="card-title">49/50 --}}
                <small>GB</small>
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                {{-- <i class="material-icons text-danger">warning</i> --}}
                {{-- <a href="javascript:;">Get More Space...</a> --}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">campaign</i>
              </div>
              <p class="card-category">Nombre de campagne</p>
              {{-- <h3 class="card-title">{{ $nbProfils->id }}</h3> --}}
            </div>
            <div class="card-footer">
              <div class="stats">
                {{-- <i class="material-icons">date_range</i> Last 24 Hours --}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">check</i>
              </div>
              <p class="card-category">Taux de messages délivrés</p>
              {{-- <h3 class="card-title">75</h3> --}}
            </div>
            <div class="card-footer">
              <div class="stats">
                {{-- <i class="material-icons">local_offer</i> Tracked from Github --}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">error</i>
              </div>
              <p class="card-category">Taux de messages échoués</p>
              {{-- <h3 class="card-title">+245</h3> --}}
            </div>
            <div class="card-footer">
              <div class="stats">
                {{-- <i class="material-icons">update</i> Just Updated --}}
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection
@section('sidebar2')
      @include('layouts.sidebar.sidebar2')
@endsection

@section('content')


{{-- <div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">                
                <div class="card-body col-md-12">
                    <div class="container"> --}}
                        <table id="datatableid2" class="table table-stripped bg-light ">
                            <thead class="bg-secondary">
                                <th><b>Nom</b> </th>
                                <th><b>Stats</b></th>
                                <th><b>Supprimer</b> </th>
                                {{-- <th><b>Stats</b> </th>
                                <th><b>Supprimer</b> </th> --}}
                            </thead>
                            <tbody>
                                @foreach ( $clients as $client )
                                    <tr>
                                        <td><a href="/admin/client/{{$client->id}}/infos" target="_blank" rel="noopener noreferrer">{{ $client->nom}}</a></td>
                                        <td><a href=""><i class="material-icons">bar_chart</i></a></td>
                                        <td><a href="" class="text-danger"><i class="material-icons">delete</i></a></td>                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    {{-- </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}


@endsection


@section('scripts')

@endsection
