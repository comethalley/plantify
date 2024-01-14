@extends('plantinfo.layout')
@section('content')
  
<div class="card" style="margin:20px;">
  <div class="card-header">Add New Plant</div>
  <div class="card-body">
       
      <form action="{{ url('plantinfo') }}" method="post">
        {!! csrf_field() !!}
        <label>Plant Name</label></br>
        <input type="text" name="plant_name" id="plant_name" class="form-control"></br>
        <label>Plant Date</label></br>
        <input type="date" name="planting_date" id="planting_date" class="form-control"></br>
        <label>Information</label></br>
        <input type="text" name="information" id="information" class="form-control"></br>
        <label>Companion</label></br>
        <input type="text" name="companion" id="companion" class="form-control"></br>
        <label>Status</label></br>
        <input type="text" name="status" id="status" class="form-control"></br>
        <input type="submit" value="Save" class="btn btn-success"></br>
    </form>
    
  </div>
</div>
  
@stop