<table class="table table-hover table-nowrap mb-0">
    <thead>
        <tr>
            <th scope="col">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="checkAll" value="option1">
                </div>
            </th>
            <th scope="col">ID</th>
            <th scope="col">Code</th>
            <th scope="col">Seed Name</th>
            <th scope="col">Uom</th>
            <th scope="col">Qty</th>
            <th scope="col">QR Code</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    @if (count($supplierSeeds) == 0)
    <tbody>
        <tr>
            <td colspan="8" style='text-align:center; vertical-align:middle'>There is no data</td>
        </tr>
    </tbody>
    @else
    <tbody>
        @foreach ($supplierSeeds as $per_Seeds)
        <tr>
            <th scope="row">
                <!-- <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option1" checked>
                </div> -->
            </th>
            <td>{{$per_Seeds->suppliers_seedsID}}</td>
            <td>{{$per_Seeds->qr_code}}</td>
            <td>{{$per_Seeds->seedName}}</td>
            <td>{{$per_Seeds->umoName}}</td>
            <td><input class="form-control form-control-sm update-qty" type="text" name="quantity" data-supplierseed-id="{{$per_Seeds->suppliers_seedsID}}" id="quantity_{{$per_Seeds->suppliers_seedsID}}" value="{{$per_Seeds->qty}}"> </td>
            <td><a href="{{ route('download.image', ['filename' => $per_Seeds->qr_code . '.png']) }}"><i class="ri-download-2-line"></i>&nbsp;Download</a></td>
            <td>
                <ul class="list-inline hstack gap-2 mb-0">
                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                        <a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal" href="#deleteOrder">
                            <i class="ri-delete-bin-5-fill fs-16"></i>
                        </a>
                    </li>
                </ul>
            </td>
        </tr>
        @endforeach
    </tbody>
    @endif
</table>

<script>
    $(document).ready(function() {

        $('.update-qty').on('change', function() {
            var supplierSeedID = $(this).data('supplierseed-id');
            var qty = $("#quantity_" + supplierSeedID).val();

            console.log("The supplierSeedID is " + supplierSeedID)
            console.log("The quantity is " + qty)

            $.ajax({
                url: "/edit-qty/" + supplierSeedID,
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'qty': qty
                },
                success: function(data) {
                    console.log(data)
                },
                error: function(xhr, status, error) {
                    if (xhr.status === 422) {
                        var errors = JSON.parse(xhr.responseText);
                        console.error("Validation Error:", errors);
                    } else {
                        console.error("Error:", error);
                    }
                }
            });
            //getLogs(stockID);
        });
    })
</script>