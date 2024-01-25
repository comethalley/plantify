@foreach ($uoms as $peruoms)
<tr>
    <th scope='row'>
        <div class='form-check'><input class='form-check-input' type='checkbox' name='checkAll' value='option1'></div>
    </th>
    <td class='id'># {{$peruoms->id}}</td>
    <td class='customer_name'> {{$peruoms->description}}</td>
    <td>
        <ul class='list-inline gap-2 mb-0'>
            <li class='list-inline-item edit' data-bs-toggle='tooltip' data-bs-trigger='hover' data-bs-placement='top' title='Edit'>
                <a href='' class='edit_uom_btn'>
                    <i class='ri-pencil-fill fs-16'></i>
                </a>
            </li>
            <li class='list-inline-item' data-bs-toggle='tooltip' data-bs-trigger='hover' data-bs-placement='top' title='Remove'><a class='text-danger d-inline-block archive_btn' href=''><i class='ri-delete-bin-5-fill fs-16'></i></a></li>
        </ul>
    </td>
</tr>
@endforeach