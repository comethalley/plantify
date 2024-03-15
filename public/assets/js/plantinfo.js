
console.log("Hello Plantinfo is here")

$(document).ready(function() {
    Quill.register("modules/imageUploader", ImageUploader);
    const quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline'],
                [{ 'header': 1 }, { 'header': 2 }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['image']
            ],
            imageUploader: {
                upload: (file) => {
                    return new Promise((resolve, reject) => {
                        const formData = new FormData();
                        formData.append("image", file);
    
                        fetch(
                            "https://api.imgbb.com/1/upload?key=cfcbefca16c54d2521b89d1537f0017e",
                            {
                                method: "POST",
                                body: formData
                            }
                        )
                        .then((response) => response.json())
                        .then((result) => {
                            console.log(result);
                            if (result.data && result.data.url) {
                                resolve(result.data.url);
                            } else {
                                reject("Invalid response from image uploader");
                            }
                        })
                        .catch((error) => {
                            reject("Upload failed");
                            console.error("Error:", error);
                        });
                    });
                }
            }
        }
    });
    

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

    $(document).on('click', '.add-plant', function(event){
        event.preventDefault();
    
        console.log("Add Plant button clicked");
        var plant_name = $('#plant_name').val();
        var seasons = $('#seasons').val();
        var information = quill.root.innerHTML;
        var companion = $('#companion').val();
        var day_harvest = $('#day_harvest').val();
        var image = $('#image')[0].files[0];
    
        var formData = new FormData();
        formData.append('plant_name', plant_name);
        formData.append('seasons', seasons);
        formData.append('information', information);
        formData.append('companion', companion);
        formData.append('days_harvest', day_harvest);
        formData.append('image', image);
    
        $.ajax({
            url: "/plantinfo",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            contentType: false, // important when sending FormData
            processData: false, // important when sending FormData
            success: function(data) {
                console.log(data);
                location.reload(); 
                // getFarmLeader();
                // $('#farmLeadershowModal').modal('hide');
            },
            error: function(xhr, status, error) {
                if (xhr.status === 422) {
                    var errorsResponse = JSON.parse(xhr.responseText);
                    console.error("Validation Error:", errorsResponse);
            
                    var errorMessage = "";
            
                    if (errorsResponse.errors) {
                        for (var key in errorsResponse.errors) {
                            if (errorsResponse.errors.hasOwnProperty(key)) {
                                errorMessage += errorsResponse.errors[key][0] + "\n";
                            }
                        }
                    } else {
                        errorMessage = "Validation error occurred.";
                    }
            
                    alert(errorMessage);
                } else {
                    console.error("Error:", error);
                }
            }
        });
    });

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
                console.log("plant info is"+data)

                $('#plantID').val(data.plantinfo.id)
                $('#edit_plant_name').val(data.plantinfo.plant_name)
                $('#edit_image').attr('src', "/images/"+data.plantinfo.image);
                $('#edit_seasons').val(data.plantinfo.seasons)
                $('#edit_information').val(data.plantinfo.information)
                $('#edit_companion').val(data.plantinfo.companion)
                $('#edit_days_harvest').val(data.plantinfo.days_harvest)

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

    function updatePlantInfo() {
        var plantID = $('#plantID').val();
        var plant_name = $('#edit_plant_name').val();
        var image = $('#myImage').attr('src', 'new_image.jpg'); // Retrieve the file object from the input field
        var seasons = $("#edit_seasons").val();
        var information = $("#edit_information").val();
        var companion = $("#edit_companion").val();
        var days_harvest = $('#edit_days_harvest').val();
    
        var formData = new FormData();
        formData.append('edit_plant_name', plant_name);
        formData.append('edit_image', image); // Append the file object to the FormData object
        formData.append('edit_seasons', seasons);
        formData.append('edit_information', information);
        formData.append('edit_companion', companion);
        formData.append('edit_days_harvest', days_harvest);
    
        $.ajax({
            url: "/update/" + plantID,
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            contentType: false,
            processData: false,
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