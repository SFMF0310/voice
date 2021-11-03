@extends('layouts.master')


@section('title')
  	Message
@endsection


@section('sidebar2')

    <!-- <form style="background-color: rgba(245, 245, 245, 0);margin-top:50px;">
      <select class="form-control" style="background-color: rgba(245, 245, 245, 0);border-top: none;border-right: none;border-left: none;">
        <option value=""> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Choisir la langue </option>

        @foreach($campagne as $data)
        <option value="{{$data->id}}"> {{$data->intitule}} </option>
        @endforeach
      </select>


      <center style="margin-top: 120px;"><p><strong> Configuration d'envoie </strong></p></center>


      <input placeholder="       Date de démarrage" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" style="background-color: rgba(245, 245, 245, 0);border-top: none;border-right: none;border-left: none;" />
      <br>
      <input placeholder="       Date de fin" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" style="background-color: rgba(245, 245, 245, 0);border-top: none;border-right: none;border-left: none;" />
      <br>
      <input placeholder="       Heure d'envoi" class="form-control" type="text" onfocus="(this.type='time')" onblur="(this.type='text')" id="date" style="background-color: rgba(245, 245, 245, 0);border-top: none;border-right: none;border-left: none;" />




    </form> -->

@endsection


@section('content')


<?php
use App\Models\VoiceLocalite;
use App\Models\VoiceClient;



?>

<div class="content ">

  <div class="container-fluid">


    <div class="row">
      <!-- <div class="col-md-12">


          <div class="card border border-secondary" style="background-color: rgba(245, 245, 245, 0.4);margin-top:20px;" >

            <div class="card-body " >

                <div class="row " >
                  <div class="col-12 ">

                    <div class="row py-4">

                    <h4 class="col-9 text-right">Uploader vos fichiers de contact en format CSV,EXCEL, ..</h4>

                    <button class="btn btn-success col-2">Importer les contacts</button>
                    </div>
                  </div>
                </div>
            </div>
          </div>
      </div> -->

      <div class="col-md-12 ">

        <div class="card border border-secondary" style="background-color: rgba(245, 245, 245, 0.4);margin-top:20px;">

          <div class="card-body">

              <div class="row">
                <div class="col-12">

                  <div class="row py-2">


                    <h4 class="col-5 text-right py-3">Enregistrez votre message vocal</h4>

                      <div class=" form-group col-3 ">
                              <select id="encodingTypeSelect">
                                <option value="wav" >Waveform Audio (.wav)</option>
                                <option value="mp3" selected>MP3 (MPEG-1 Audio Layer III) (.mp3)</option>
                                <option value="ogg">Ogg Vorbis (.ogg)</option>
                              </select>

                              <div id="controls " style="margin-left:20px;">
                                  <br>
                                  <button id="recordButton"><img src="{{asset('assets/img/play.png') }}"></button>
                                  <button id="pausebtn" disabled ><img src="{{asset('assets/img/pause.png') }}"></button>
                                  &nbsp; &nbsp; &nbsp; &nbsp;
                                  <button id="stopButton" ><img src="{{asset('assets/img/stop.png') }}"></button>

                                 <!--  <div class="col-md-2">
                                      <button id=record2><img src="/images/play.png"></button>
                                      <button id="pausebtn2" ><img src="/images/pause.png"></button>
                                  </div>
                                  <div class="col-md-2">
                                      <button id=stopRecord2 disabled onclick="myFunction()"><img src="/images/stop.png"></button>
                                  </div> -->


                              </div>
                      </div>
                      <div class="col-2 ">
                        <div id="formats"></div>
                                <!-- <pre>Log</pre> -->
                        <pre id="log"></pre>

                        <pre id="prerecordings" >Recordings</pre>
                          <br>
                        <ol id="recordingsList"></ol>
                      </div>

                  </div>
                </div>
              </div>
          </div>
        </div>

        <div class="row py-4">
        @if ($_SESSION['profil']==1 || $_SESSION['profil'] == 2)
        <form method="POST" action="/admin/envoi-message" style="background-color: rgba(245, 245, 245, 0);margin-top:20px;"  enctype="multipart/form-data">
        @elseif($_SESSION['profil']==3 || $_SESSION['profil'] == 4)
        <form method="POST" action="/client/envoi-message" style="background-color: rgba(245, 245, 245, 0);margin-top:20px;"  enctype="multipart/form-data">
        @endif

             @csrf
            <select class="form-control" name="campagne" style="background-color: rgba(245, 245, 245, 0);border-top: none;border-right: none;border-left: none;" required>
              <option value="">Selectionnez les destinataire de votre campagne </option>

              @foreach($campagne as $data)
              <option value="{{$data->id}}"> {{$data->intitule}} </option>
              @endforeach
            </select>

            <br>

            <select class="form-control" name="langue" style="background-color: rgba(245, 245, 245, 0);border-top: none;border-right: none;border-left: none;" required >
              <option value="">Choisir la langue </option>

              @foreach($langue as $datalangue)
              <option value="{{$datalangue->id}}"> {{$datalangue->nom}} </option>
              @endforeach
            </select>

            <br>

            <input required placeholder="       Heure d'envoi" class="form-control" type="file" id="date" name="audio[]" style="background-color: rgba(245, 245, 245, 0);border-top: none;border-right: none;border-left: none;" />
            <br>
            <button class="btn btn-success col-2" style="margin-left:75%">Envoyer</button>
            <!-- <hr> -->
          </form>
        </div>

      </div>

        <!-- <div class=" card-body col-12 ">

          <br>

            <div class="d-flex "> <div><img class="" src="{{ asset('assets/img/xammbay.png') }}" class="shadow" width="50" height="50"></div> <div class="text-left"> <strong >Xamsa Mbay  </strong> <span class="miniDesc">Approche Chaîne de Valeur </span></div></div>


        </div> -->

        <div class="col-md-12">

        @foreach($campagne as $dataCampagne)
            <div class="card border border-secondary" style="margin-top:20px;" >
              
              <div class="card-body " >

                  <div class="row " >



                    <div class="col-12 ">
                      <div class="row py-1">
                        <div class="d-flex col-3 ">  <div><i class="material-icons">sms</i></div> <div class="text-left"> <p >Vocal 32 |Campagne Covid 19   </p> </div></div>
                        <div class="col-3" > <p >8 585 appels réussis    </p> </div>
                        <div class="col-3" > <p >252 appels échoués    </p> </div>
                        <div class="col-3" > <p >Analyses  97 %    </p> </div>
                      </div>
                    </div>

                  </div>
              </div>
            </div>
        @endforeach
        </div>


      </div>

    </div>
  </div>
</div>




@endsection

@section('scripts')

@endsection

