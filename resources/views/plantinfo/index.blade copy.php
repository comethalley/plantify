@include('templates.header')
@section('content')
@extends('plantinfo.layout')

<div class="main-content">
    <div class="row" style="margin:100px;">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>Plant Info</h2>
                </div>
                <div class="card-body">
                    <a href="{{ url('/plantinfo/create') }}" class="btn btn-success btn-sm" title="Add New Student">
                        Add New
                    </a>
                    <br />
                    <br />
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Plant Name</th>
                                    <th>Info</th>
                                    <th>Companion</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($plantinfo as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->plant_name }}</td>
                                    <td>{{ $item->information }}</td>
                                    <td>{{ $item->companion }}</td>

                                    <td>
                                        <a href="{{ url('/plantinfo/' . $item->id) }}" title="View Plant"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                        <a href="{{ url('/plantinfo/' . $item->id . '/edit') }}" title="Edit Plant"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                        <form method="POST" action="{{ url('/plantinfo' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Plant" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection