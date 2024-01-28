@extends('plantinfo.layout')
@section('content')

<div class="card" style="margin:20px;">
  <div class="card-header">Plant Page</div>
  <div class="card-body">
    <div class="card-body">
      <h5 class="card-title">Plant Name : {{ $plantinfo->plant_name }}</h5>
      <p class="card-text">Information : {{ $plantinfo->information }}</p>
      <p class="card-text">Companion : {{ $plantinfo->companion }}</p>
    </div>
    </hr>
  </div>
</div>