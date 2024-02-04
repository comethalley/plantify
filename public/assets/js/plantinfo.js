
console.log("Hello Plantinfo is here")
$(document).ready(function() {


    function getPlant(supplierId){
        console.log("Button is clicked !")
        console.log("Supplier ID is " + supplierId )

        $.ajax({
            url: "/getSupplier/" + supplierId,
            method: "GET",
            success: function(data) {
                console.log("Supplier data is", data);

                $('.modal-title').text(data.name)
                $('#supplier_name').text("About " + data.name)
                $('#supplier_description').text(data.description)
                getSupplierSeeds(supplierId)
            },
            error: function(xhr, status, error) {
                console.error("Error:", status, error);
            }
        });
    }

    // $('.edit-item-btn').on('click', function() {
    //     event.preventDefault()
    //     var plantID = $(this).data('plantinfo-id');
    //     console.log(plantID)
    //     //$('#supplier-id').val(plantID)
    //     getPlant(supplierId);
    // });

    $(document).on('click', '.edit-item-btn', function(event){
        event.preventDefault()

        var plantID = $(this).data('plantinfo-id');
        console.log(plantID)
        //$('#supplier-id').val(plantID)
        //getPlant(supplierId);

        $.ajax({
            url: "/edit/" + plantID,
            method: "GET",
            success: function(data) {
                console.log(data)

                $('#plantID').val(data.plantinfo.id)
                $('#edit_plant_name').val(data.plantinfo.plant_name)
                $('#edit_plant_date').val(data.plantinfo.planting_date)
                $('#edit_information').val(data.plantinfo.information)
                $('#edit_companion').val(data.plantinfo.companion)

                $('#updateModal').modal('show')
            },
            error: function(xhr, status, error) {
                console.error("Error:", status, error);
            }
        });
    })

    $(document).on('click', '.remove-item-btn', function(event){
        event.preventDefault()

        var plantID = $(this).data('plantinfo-id');
        console.log(plantID)
        //$('#supplier-id').val(plantID)
        //getPlant(supplierId);
        $('#archiveID').val(plantID)

    })

    function updatePlantInfo(){
        var plantID = $('#plantID').val()
        var plant_name = $('#edit_plant_name').val()
        var plant_date = $("#edit_plant_date").val();
        var information = $("#edit_information").val();
        var companion = $("#edit_companion").val();

        $.ajax({
            url: "/update/"+plantID,
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'edit_plant_name': plant_name,
                'edit_planting_date' : plant_date,
                'edit_information'  : information,
                'edit_companion' : companion
             },
            success: function(data) {
                location.reload();

            },
            error: function(xhr, status, error) {
                console.error("Error:", status, error);
            }
        });
    }

    $('#plantinfo-update').on('click', function() {
        updatePlantInfo();
    });

    function archivePlantInfo(){
        var plantID = $('#archiveID').val()
        

        $.ajax({
            url: "/archive/"+plantID,
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function(data) {
                location.reload();

            },
            error: function(xhr, status, error) {
                console.error("Error:", status, error);
            }
        });
    }
    
    $(document).on('click', '.restore-item-btn', function(event){
        event.preventDefault()

        var plantID = $(this).data('plantinfo-id');
        console.log(plantID)
        //$('#supplier-id').val(plantID)
        //getPlant(supplierId);
        $('#unarchiveID').val(plantID)

    })

    $('#plantinfo-archive').on('click', function() {
        archivePlantInfo();
    });

    function unarchivePlantInfo(){
        var plantID = $('#unarchiveID').val()
        

        $.ajax({
            url: "/unarchive/"+plantID,
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function(data) {
                location.reload();

            },
            error: function(xhr, status, error) {
                console.error("Error:", status, error);
            }
        });
    }

    $('#plantinfo-unarchive').on('click', function() {
        unarchivePlantInfo();
    });

    
})