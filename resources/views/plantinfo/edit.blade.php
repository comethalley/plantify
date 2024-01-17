@extends('plantinfo.layout')
@section('content')
  
<div class="card" style="margin:20px;">
  <div class="card-header">Edit Plant</div>
  <div class="card-body">
       
      <form action="{{ url('plantinfo/' .$plantinfo->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
        <input type="hidden" name="id" id="id" value="{{$plantinfo->id}}" id="id" />
        <label>Plant Name</label></br>
        <input type="text" name="plant_name" id="plant_name" value="{{$plantinfo->name}}" class="form-control"></br>
        <label>Information</label></br>
        <input type="text" name="information" id="information" value="{{$plantinfo->information}}" class="form-control"></br>
        <label>Companion</label></br>
        <input type="text" name="companion" id="companion" value="{{$plantinfo->companion}}" class="form-control"></br>
        <input type="submit" value="Update" class="btn btn-success"></br>
    </form>
    
  </div>
</div>
  
@stop