@extends('layouts.master')
@section('content')
    <div class="bg-light">
        {{-- {{$creditRestant[0]['credit_total']}} --}}
        {{-- @if(session('_SESSION')) --}}
            <div class="card">
                <div class="card-header ">
                    <h1 class="text-dark card-title">REF:{{$_SESSION['ref_command']}}</h1>
                </div>
                <div class="card-body row">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-dark"><b>Réference</b>:{{$_SESSION['ref_command']}}</li>
                        <li class="list-group-item text-dark"><b>Pack</b>:{{$_SESSION['forfait']}}</li>
                        <li class="list-group-item text-dark"><b>Minutes d'appel(mn)</b>:{{$_SESSION['nb_minute']}}</li>
                        <li class="list-group-item text-dark"><b>Total Minutes d'appel</b>:{{$_SESSION['nb_minute']}}</li>

                    </ul>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-dark"><b>Description</b>:{{$_SESSION['desc']}}</li>
                    
                    </ul>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <a href="/admin" class="btn btn-success">Retour à l'acceuil</a>
            </div>
        {{-- @endif --}}

    </div>
@endsection
@section('scripts')
<script>
    function disable_f5(e)
{
  if ((e.which || e.keyCode) == 116)
  {
      e.preventDefault();
  }
}

$(document).ready(function(){
    e.preventDefault();
    $(document).bind("keydown", disable_f5);    
});
</script>
@endsection