<table class="table table-hover mb-0">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Category</th>
            <th scope="col">Quantity</th>
            <th scope="col">Date</th>
            <th scope="col">User</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    @if (count($logs) == 0)
    <tbody>
        <tr>
            <td colspan="6" style='text-align:center; vertical-align:middle'>There is no data</td>
        </tr>
    </tbody>
    @else
    <tbody>
        @foreach ($logs as $per_logs)
        <tr>
            <td>{{$per_logs->logsID}}</td>
            <td>{{$per_logs->category}}</td>
            <td>{{$per_logs->quantity}}</td>
            <td>{{$per_logs->date}}</td>
            <td>{{$per_logs->userID}}-{{$per_logs->lastname}}, &nbsp;{{$per_logs->firstname}}</td>
            <td>
                <button type="button" class="btn btn-danger waves-effect waves-light">Void</button>
            </td>
        </tr>
        @endforeach
    </tbody>
    @endif
</table>