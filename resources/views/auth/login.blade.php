@extends('layouts.app')

@section('title','Login')

@push('css')

@endpush

@section('content')
    <div class="content" >
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-md-offset-1">
                    
                    <div class="card" style="background-color:rgba(0, 0, 0, 0.5);" >
                        <div class="card-header" data-background-color="purple">
                            <h4 class="title">Connexion</h4>
                        </div>
                        <div class="card-content" >
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="row" >
                                    <div class="col-md-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Email</label>
                                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Mot de passe</label>
                                            <input type="password" class="form-control" name="password" required>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Se connecter</button>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush