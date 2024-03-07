console.log("Hello uom js is here")
$(document).ready(function() {
    getUoms()

    function getUoms() {
        $.ajax({
            url: "/getAllUom",
            method: "GET",
            success: function(data) {
                console.log(data)
                // $("#uom-table").html(data)
                populateUomTable(data)
            },
            error: function(xhr, status, error) {
                console.error("Error:", status, error);
            }
        });
    }

    function populateUomTable(data) {
        var tableBody = $("#uomTable tbody");
        tableBody.empty();

        $.each(data.uoms, function(index, uom) {
            console.log("Description before appending to HTML: " + uom.description);
            var row = "<tr> <th scope='row'><div class='form-check'><input class='form-check-input' type='checkbox' name='checkAll' value='option1'></div></th>" +
                "<td class='id'># " + uom.id + "</td>" +
                "<td class='customer_name'>" + uom.description + "</td>" +
                "<td><ul class='list-inline gap-2 mb-0'><li class='list-inline-item edit' data-bs-toggle='tooltip' data-bs-trigger='hover' data-bs-placement='top' title='Edit'><a href='' class='text-primary d-inline-block edit_uom_btn' data-uom-id='" + uom.id + "' data-uom-name='" + uom.description + "'><i class='ri-pencil-fill fs-16'></i></a></li><li class='list-inline-item' data-bs-toggle='tooltip' data-bs-trigger='hover' data-bs-placement='top' title='Remove'><a class='text-danger d-inline-block archive_uom_btn' href='' data-uom-id='" + uom.id + "' data-uom-name='" + uom.description + "'><i class='ri-delete-bin-5-fill fs-16'></i></a></li></ul></td>" +
                "</tr>";

            tableBody.append(row);
        });
    }

    function updateUOM(){

        var unitID =  $('#edit-unit-id').val()
        var unitName =  $('#edit-unit-name').val()

        console.log(unitID + unitName)

        $.ajax({
            url: "/edit-uom/" + unitID,
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'unitName': unitName,
            },
            success: function(data) {
                console.log(data)
                getUoms();
                $("#uomEditShowModal").modal('hide');
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
    }

    function archiveUOM(){

        var unitID =  $('#archive-uomID').val()
        // var unitName =  $('#edit-unit-name').val()

        $.ajax({
            url: "/archive-uom/" + unitID,
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                console.log(data)
                getUoms();
                $("#uomArchiveShowModal").modal('hide');
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
    }

    $('#add-uom-btn').on('click', function() {
        console.log("uom-btn is clicked")
        var unitName = $("#unit-name").val()

        $.ajax({
            url: "/add-uom",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'unitName': unitName,
            },
            success: function(data) {
                console.log(data)
                getUoms();
                $('#uomShowModal').modal('hide');
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
    });

    $('#edit-uom-btn').on('click', function() {
        updateUOM();
    });

    $('#archive-uom-btn').on('click', function() {
        archiveUOM();
    });


    $(document).on('click', '.edit_uom_btn', function(event) {
        event.preventDefault();
        
        var uomID = $(this).data('uom-id');
        var uomName = $(this).data('uom-name');
        
        console.log("Uom ID is " + uomID);
        $('#edit-unit-id').val(uomID)
        $('#edit-unit-name').val(uomName)

        $("#uomEditShowModal").modal("show")
    });

    $(document).on('click', '.archive_uom_btn', function(event) {
        event.preventDefault();
        
        var uomID = $(this).data('uom-id');
        var uomName = $(this).data('uom-name');
        
        console.log("Uom ID is " + uomID);
        $('#archive-uomID').val(uomID)
        $('#archive-uom-name').text(uomName)

        $("#uomArchiveShowModal").modal("show")
    });
    

})
