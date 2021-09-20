@extends('layouts.master')
@section('content')
<div class="content">
    <div class="container-fluid bg-light">
        <div class="row">
            <div class="col-md-12">
                {{ $_SESSION['profil'] }}
            </div>
        </div>
    </div>
</div>
@endsection
