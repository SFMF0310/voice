@extends('layouts.master')


@section('title')
  	Message
@endsection


@section('sidebar2')
      
    <form style="background-color: rgba(245, 245, 245, 0);margin-top:50px;">
      <select class="form-control" style="background-color: rgba(245, 245, 245, 0);border-top: none;border-right: none;border-left: none;">
        <option value=""> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Choisir la langue </option>

        @foreach($campagne as $data)
        <option value="{{$data->id}}"> {{$data->intitule}} </option>
        @endforeach
      </select>


      <center style="margin-top: 120px;"><p><strong> Configuration d'envoie </strong></p></center>

      <!-- <input class="form-control" type="date" name="demarrage" placeholder="Date de démarrage"> -->
      <!-- <input class="form-control" placeholder="Date" class="textbox-n" type="text" onfocus="(this.type='date')" id="date"> -->
      <input placeholder="       Date de démarrage" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" style="background-color: rgba(245, 245, 245, 0);border-top: none;border-right: none;border-left: none;" />
      <br>
      <input placeholder="       Date de fin" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" style="background-color: rgba(245, 245, 245, 0);border-top: none;border-right: none;border-left: none;" />
      <br>
      <input placeholder="       Heure d'envoi" class="form-control" type="text" onfocus="(this.type='time')" onblur="(this.type='text')" id="date" style="background-color: rgba(245, 245, 245, 0);border-top: none;border-right: none;border-left: none;" />



      <!-- <hr> -->
    </form>

@endsection


@section('content')


<?php 
use App\Models\VoiceLocalite;
use App\Models\VoiceClient;



?>

<div class="content ">
  
  <div class="container-fluid">


    <div class="row">
      <div class="col-md-12">

        
          <div class="card border border-secondary" style="background-color: rgba(245, 245, 245, 0.4);margin-top:20px;" >
            
            <div class="card-body " >
             
                <div class="row " >
                  <div class="col-12 ">

                    <div class="row py-4">

                    <h4 class="col-9 text-right">Uploader vos fichiers de contact en format CSV,EXCEL, ..</h4>

                    <button class="btn btn-success col-2">bouton test</button>
                    </div>
                  </div>
                </div>
            </div>
          </div>
      </div>

      <div class="col-md-12 ">
        <div class="row py-4">
          <form style="background-color: rgba(245, 245, 245, 0);margin-top:20px;">
            <select class="form-control" style="background-color: rgba(245, 245, 245, 0);border-top: none;border-right: none;border-left: none;">
              <option value="">Selectionnez les destinataire de votre campagne </option>

              @foreach($campagne as $data)
              <option value="{{$data->id}}"> {{$data->intitule}} </option>
              @endforeach
            </select>

            <br>

            <select class="form-control" style="background-color: rgba(245, 245, 245, 0);border-top: none;border-right: none;border-left: none;">
              <option value="">Choisir la langue </option>

              @foreach($campagne as $data)
              <option value="{{$data->id}}"> {{$data->intitule}} </option>
              @endforeach
            </select>
<!-- 
            <br>

            <input placeholder="       Heure d'envoi" class="form-control" type="file" id="date" style="background-color: rgba(245, 245, 245, 0);border-top: none;border-right: none;border-left: none;" /> -->
            <br>
            <button class="btn btn-success col-2" style="margin-left:75%">Envoyer</button>
            <!-- <hr> -->
          </form>
        </div>
        <div class="card border border-secondary" style="background-color: rgba(245, 245, 245, 0.4);margin-top:20px;">
          
          <div class="card-body">
           
              <div class="row">
                <div class="col-12">

                  <div class="row py-4">

                  
                    <h4 class="col-5 text-right py-4">Enrdegistrez votre message vocal</h4>

                      <div class=" form-group col-5 ">
                              <select id="encodingTypeSelect">
                                <option value="wav" >Waveform Audio (.wav)</option>
                                <option value="mp3" selected>MP3 (MPEG-1 Audio Layer III) (.mp3)</option>
                                <option value="ogg">Ogg Vorbis (.ogg)</option>
                              </select>
                              
                              <div id="controls " style="margin-left:100px;">
                                  <br>
                                  <button id="recordButton"><img src="{{asset('assets/img/play.png') }}"></button>
                                  <button id="pausebtn" disabled ><img src="{{asset('assets/img/pause.png') }}"></button>
                                  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                                  <button id="stopButton" ><img src="{{asset('assets/img/stop.png') }}"></button>

                                 <!--  <div class="col-md-2">
                                      <button id=record2><img src="/images/play.png"></button>
                                      <button id="pausebtn2" ><img src="/images/pause.png"></button>
                                  </div>
                                  <div class="col-md-2">
                                      <button id=stopRecord2 disabled onclick="myFunction()"><img src="/images/stop.png"></button>
                                  </div> -->


                              </div>
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
      </div>

        <!-- <div class=" card-body col-12 ">
                   
          <br>
          
            <div class="d-flex "> <div><img class="" src="{{ asset('assets/img/xammbay.png') }}" class="shadow" width="50" height="50"></div> <div class="text-left"> <strong >Xamsa Mbay  </strong> <span class="miniDesc">Approche Chaîne de Valeur </span></div></div>
          
          
        </div> -->

        <div class="col-md-12">

        
            <div class="card border border-secondary" style="margin-top:40px;" >
              
              <div class="card-body " >
               
                  <div class="row " >
                    <div class="col-12 ">

                      <div class="row py-2">

                      <div class="d-flex "> <div><i class="material-icons">sms</i></div> <div class="text-left"> <strong >Vocal 32 |Campagne Covid 19 MEDA   </strong> </div></div>
                      </div>
                    </div>
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

