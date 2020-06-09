@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">
                   Rikiuoti pagal: <br>
                   Sunkvežimius:
               <a href="{{route('vehicle.index', ['order' => 'asc', 'by' => 'make_id'])}}">
                   <svg xmlns="http://www.w3.org/2000/svg" height="22" viewBox="1 2 23 24" width="20"><path d="M15.75 5h-1.5L9.5 16h2.1l.9-2.2h5l.9 2.2h2.1L15.75 5zm-2.62 7L15 6.98 16.87 12h-3.74zM6 19.75l3-3H7V4.25H5v12.5H3l3 3z"/><path d="M0 0h24v24H0z" fill="none"/></svg>
                </a>
                <a href="{{route('vehicle.index', ['order' => 'desc', 'by' => 'make_id'])}}">
                    <svg xmlns="http://www.w3.org/2000/svg" height="22" viewBox="1 2 23 24" width="20"><path d="M3 12v1.5l11 4.75v-2.1l-2.2-.9v-5l2.2-.9v-2.1L3 12zm7 2.62l-5.02-1.87L10 10.88v3.74zm8-10.37l-3 3h2v12.5h2V7.25h2l-3-3z"/><path d="M0 0h24v24H0z" fill="none"/></svg>
                </a>
                &nbsp; Savininkus:
                <a href="{{route('vehicle.index', ['order' => 'asc', 'by' => 'owner'])}}">
                    <svg xmlns="http://www.w3.org/2000/svg" height="22" viewBox="1 2 23 24" width="20"><path d="M15.75 5h-1.5L9.5 16h2.1l.9-2.2h5l.9 2.2h2.1L15.75 5zm-2.62 7L15 6.98 16.87 12h-3.74zM6 19.75l3-3H7V4.25H5v12.5H3l3 3z"/><path d="M0 0h24v24H0z" fill="none"/></svg>
                </a>
                <a href="{{route('vehicle.index', ['order' => 'desc', 'by' => 'owner'])}}">
                    <svg xmlns="http://www.w3.org/2000/svg" height="22" viewBox="1 2 23 24" width="20"><path d="M3 12v1.5l11 4.75v-2.1l-2.2-.9v-5l2.2-.9v-2.1L3 12zm7 2.62l-5.02-1.87L10 10.88v3.74zm8-10.37l-3 3h2v12.5h2V7.25h2l-3-3z"/><path d="M0 0h24v24H0z" fill="none"/></svg>
                </a>
                Metus:
                <a href="{{route('vehicle.index', ['order' => 'asc', 'by' => 'year'])}}" style="text-decoration:none; color:black">0-9</a> |
                <a href="{{route('vehicle.index', ['order' => 'desc', 'by' => 'year'])}}" style="text-decoration:none; color:black">9-0</a>
                <br>Filtruoti pagal:
                <form action="{{route('vehicle.index')}}" method="get" >
                    <select name="show_make_id">
                      <option value="0">Pasirinkite markę</option>
                      @foreach ($makes as $make)
                          <option value="{{$make->id}}" >{{$make->make}}</option>
                      @endforeach
                    </select>
                <select name="show_owner">
                  <option value="0">Pasirinkite savininką</option>
                  @foreach ($vehicles_owner as $vehicle)
                      <option value="{{$vehicle->owner}}" >{{$vehicle->owner}}</option>
                  @endforeach
                </select>

                <select name="show_year">
                  <option value="0" >Pasirinkite metus</option>
                  @foreach ($vehicles_year as $vehicle)
                      <option value="{{$vehicle->year}}" @if($vehicle->year == $active) selected @endif>{{$vehicle->year}}</option>
                  @endforeach
                </select><br>
                    <div style="margin:3px">
                    Savininkų skaičių
                        <input type="number" name="show_prevOwners" placeholder="įveskite skaičių iki 20" >
                        <button type="submit">Filtruoti</button>
                        <a href="{{route('vehicle.index')}}">išvalyti</a>
                    </div>
                </form>
               </div>
                <div class="card-body">
                    @foreach($vehicles as  $vehicle)
                     Markė: {{$vehicle->vehicleMake->make}} Pagaminta: {{$vehicle->year}} Savininkas: {{$vehicle->owner}} Viso savininkų: {{$vehicle->prevOwners}}
                         <br>
                         Komentarai: <br>
                         {{$vehicle->comments}}
                         <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection