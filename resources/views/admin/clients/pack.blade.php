@extends('layouts.master')

@section('top-menu')
<li class="nav-item active">
    <a class="nav-link text-dark" href="/admin/utilisateur"><b>Utilisateurs |</b> <span class="sr-only"></span></a>
</li>

<li class="nav-item">
    <a class="nav-link" href="/admin/packs">Tarifications |</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="">Mon compte</a>
</li>


@endsection
@section('header2')


@endsection
@section('content')
{{-- <header class="header2" id="header2"> --}}

    <div class="row mt-5 ml-3" style="background-color:#ccc5c5;width:100">
        <p ><b class="text-success">Tarification</b><br/>Détails de tarification de nos packs</p>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            @foreach ( $packs as $pack )
                    <li class="nav-item">
                        <a class="nav-link text-decoration-none text-dark" id="{{ $pack->id.'-tab' }}" data-toggle="tab" href="{{'#'.$pack->forfait }}" role="tab" aria-controls="{{ $pack->forfait }}" aria-selected="false">{{$pack->forfait}}</a>
                    </li>
                
                
            @endforeach
           
        </ul>
        <div class="tab-content bg-light left-0" id="myTabContent">
            @foreach ( $packs as $pack )
                    <div class="tab-pane fade " id="{{$pack->forfait}}" role="tabpanel" aria-labelledby="{{ $pack->id.'-tab'}}">
                        <div class=" bg-light">
                            <div class="text-dark"> 
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                
                            </div>
                            <div class="d-flex justify-content-end bottom-2">
                                {{-- <a class="btn btn-success " href="#">Souscrire</a> --}}
                                <button class="btn btn-success buy" onclick="buy(this)" client="3" item-price="{{ $pack->prix}}" item-name="{{$pack->forfait}}" data-item-id="{{$pack->id}}" >Souscrire</button>
                             </div>
                        </div> 
                    </div>
                

            {{-- <div class="tab-pane fade show active " id="home" role="tabpanel" aria-labelledby="home-tab">
                {{-- <div class="card bg-light">
                    <div class="text-dark"> 
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        
                    </div>
                    <div class="d-flex justify-content-end bottom-2">
                        <a class="btn btn-success " href="#">Souscrire</a>
                     </div>
                {{--</div> 
        
            </div> --}}
            @endforeach

            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
          </div>
    </div>





  {{-- <div  class="bg-light col-md-12">
      <h2>Content</h2>
  </div> --}}


@endsection

