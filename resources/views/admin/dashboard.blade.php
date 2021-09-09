@extends('layouts.master')


@section('title')
  Dashboard
@endsection



@section('content')


<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <!-- <div class="card"> -->
          <!-- <div class="card-header card-header-primary">
            <h4 class="card-title ">Dashboard</h4>
            <?php //var_dump($financement); ?>
          </div> -->
          <div class="card-body">
           
             <!--  @if (session('success')) -->
                <div class="alert alert-success" role="alert">

                  <strong><!-- {{session('success')}} --></strong>

                </div>
              <!-- @endif -->
            
              <div class="card col-md-12 " >
               
                <div class="card-header card-header-primary">
                  <h4 class="card-title "> Dashboard</h4>
                  <?php //var_dump($financement); ?>
                </div>
                <div class="card-body">

                  
                  
                </div>
              </div>


            
          </div>
        <!-- </div> -->
      </div>
      
    </div>
  </div>
</div>

@endsection


@section('scripts')

@endsection