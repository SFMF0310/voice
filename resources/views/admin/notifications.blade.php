@extends('layouts.master')


@section('title')
  Utilisateurs
@endsection
@section('top-menu')
    {{-- @if (in_array($_SESSION['profil'],array(1,2)))
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
    @endif --}}

@endsection
@section('sidebar2')
      @include('layouts.sidebar.sidebar2')
@endsection


@section('content')




<div class="content">
  <div class="container-fluid">
     <div class="row ">
        @foreach ($user->notifications as $notif )
            @if(is_null($notif->read_at))
                    <div class="alert alert-success alert-dismissible fade show" id="{{$notif->id}}"   role="alert">
                        <div class="row">
                            <div class="d-inline col-md-6">
                                <em>{{ $notif->data['body'].":" }}</em>
                            </div>
                            <div class=" col-md-6 d-inline-flex justify-content-end">
                                <em>{{ $notif->created_at }}</em>
                                {{-- <button type="button" class="btn-close close" data-dismiss="alert" aria-label="Close"></button> --}}
                            </div>
                        </div>

                        <div>
                            {{-- <ul class="list">
                                <li class="list-item">Nom: {{ $notif->data['nom'] }}</li>
                                <li class="list-item">Prénom: {{ $notif->data['prenom'] }}</li>
                                <li class="list-item">Login: {{ $notif->data['login'] }}</li>
                                    {{-- <h2>{{ $notif->id}}</h2> --}}
                            </ul> 
                        </div>

                        <div class="col-md-12 d-flex justify-content-end">
                            {{-- <div class="col-md-6 d-inline-flex justify-content-start">
                                <em>{{ $notif->created_at }}</em>
                            </div> --}}
                            <div class="  ">
                                {{-- <form class='markAsRead' data-id="{{$notif->id}}" action="#">
                                    @csrf --}}
                                    <button class="btn btn-success btnmarkAsRead" id="{{ $notif->id  }}" data-id="{{ $notif->id }} "   >Marquer comme lu</button>
                                {{-- </form> --}}
                            </div>
                        </div>

                    </div>
            @else
                <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                    <div class="row">
                        <div class="d-inline col-md-6">
                            <p>{{ $notif->data['body']}}</p>
                        </div>
                        <div class=" col-md-6 d-inline-flex justify-content-end">
                            {{-- <button type="button" class="btn-close close" data-dismiss="alert" aria-label="Close"></button> --}}
                        </div>
                    </div>

                    {{-- <div>
                        <ul class="list">
                            <li class="list-item">Nom: {{ $notif->data['nom'] }}</li>
                            <li class="list-item">Prénom: {{ $notif->data['prenom'] }}</li>
                            <li class="list-item">Login: {{ $notif->data['login'] }}</li>

                        </ul>
                    </div> --}}
                    <div class="col-md-12 d-flex  justify-content-end">
                        <em>{{ $notif->created_at }}</em>
                    </div>
                </div>
            @endif

      @endforeach
      {{-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> --}}
        </div>
    </div>
</div>
  {{-- </div>
</div> --}}
@endsection


@section('scripts')

@endsection
