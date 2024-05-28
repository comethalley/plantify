console.log("Hello admin js is here");
$(document).ready(function () {
    getFarmLeader();

    function getFarmLeader() {
        $.ajax({
            url: "/getAllFarmLeaders",
            method: "GET",
            success: function (data) {
                console.log(data);
                // $("#uom-table").html(data)
                populateFarmLeaderTbl(data);
            },
            error: function (xhr, status, error) {
                console.error("Error:", status, error);
            },
        });
    }

    function populateFarmLeaderTbl(data) {
        var tableBody = $("#farmerLeader-tbl tbody");
        tableBody.empty();

        $.each(data.farmLeaders, function (index, farmLeader) {
            var row =
                "<tr>" +
                "<td class='id'># " +
                (index + 1) +
                "</td>" +
                "<td class='customer_name'>" +
                farmLeader.firstname +
                "</td>" +
                "<td class='customer_name'>" +
                farmLeader.lastname +
                "</td>" +
                "<td class='customer_name'>" +
                farmLeader.email +
                "</td>" +
                "<td><ul class='list-inline gap-2 mb-0'><li class='list-inline-item edit' data-bs-toggle='tooltip' data-bs-trigger='hover' data-bs-placement='top' title='Edit'><a href='' class='text-primary d-inline-block edit_farmleader_btn' data-farmLeader-id='" +
                farmLeader.id +
                "'><i class='ri-pencil-fill fs-16'></i></a></li><li class='list-inline-item' data-bs-toggle='tooltip' data-bs-trigger='hover' data-bs-placement='top' title='Remove'><a class='text-danger d-inline-block archive_farmleader_btn' href='' data-farmLeader-id='" +
                farmLeader.id +
                "'><i class='ri-delete-bin-5-fill fs-16'></i></a></li></ul></td>" +
                "</tr>";

            tableBody.append(row);
        });
    }

    function updateFarmLeader() {
        var farmLeaderID = $("#farmLeaderID").val();
        var firstname = $("#edit-firstname").val();
        var lastname = $("#edit-lastname").val();
        var email = $("#edit-email").val();
        var farm_name = $("#farm").val();
    
        $.ajax({
            url: "/editFarmLeader/" + farmLeaderID,
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                firstname: firstname,
                lastname: lastname,
                email: email,
                farm_name: farm_name,
            },
            success: function (data) {
                console.log(data);
                getFarmLeader();
                $("#editFLModal").modal("hide");
                Swal.fire({
                    title: "Successfully Updated",
                    // text: "Are you ready for the next level?",
                    icon: "success",
                    showConfirmButton: false, // Remove the OK button
                    timer: 2000,
                });
            },
            error: function (xhr, status, error) {
                console.log(farmerLeaderID)
                if (xhr.status === 422) {
                    var errorsResponse = JSON.parse(xhr.responseText);
                    console.error("Validation Error:", errorsResponse);
    
                    var errorMessage = "";
    
                    if (errorsResponse.errors) {
                        for (var key in errorsResponse.errors) {
                            if (errorsResponse.errors.hasOwnProperty(key)) {
                                errorMessage +=
                                    errorsResponse.errors[key][0] + "\n";
                            }
                        }
                    } else {
                        errorMessage = "Validation error occurred.";
                    }
    
                    Swal.fire({
                        title: "Validation Error",
                        text: errorMessage,
                        icon: "error",
                    });
                } else {
                    console.error("Error:", error);
                    Swal.fire({
                        title: "Error",
                        text: "An error occurred while processing your request. Please try again later.",
                        icon: "error",
                    });
                }
            },
        });
    }
    

    function archiveFarmLeader() {
        var farmLeaderID = $("#archive-adminID").val();
        // var unitName =  $('#edit-unit-name').val()

        $.ajax({
            url: "/archiveFL/" + farmLeaderID,
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (data) {
                console.log(data);
                getFarmLeader();
                $("#adminArchiveShowModal").modal("hide");
                Swal.fire({
                    title: "Successfully Archived",
                    // text: "Are you ready for the next level?",
                    icon: "success",
                    showConfirmButton: false, // Remove the OK button
                    timer: 2000,
                });
            },
            error: function (xhr, status, error) {
                if (xhr.status === 422) {
                    var errors = JSON.parse(xhr.responseText);
                    console.error("Validation Error:", errors);
                } else {
                    console.error("Error:", error);
                }
            },
        });
    }

    $("#add-farmleader-btn").on("click", function () {
        console.log("add-btn is clicked");
        var firstname = $("#firstname").val();
        var lastname = $("#lastname").val();
        var email = $("#email").val();
        var barangay_name = $("#barangay_name").val();
        var area = $("#area").val();
        var farm_name = $("#farm_name").val();
        var address = $("#address").val();
        var latitude = $('#latitude').val();
        var longitude = $('#longitude').val();


        $.ajax({
            url: "/addFarmLeader",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                firstname: firstname,
                lastname: lastname,
                email: email,
                barangay_name: barangay_name,
                area: area,
                farm_name: farm_name,
                address: address,
                latitude: latitude,
                longitude: longitude,
            },
            success: function (data) {
                console.log(data);
                getFarmLeader();
                $("#farmLeadershowModal").modal("hide");
                Swal.fire({
                    title: "Successfully Invited",
                    // text: "Are you ready for the next level?",
                    icon: "success",
                    timer: 3000,
                });
            },
            error: function (xhr, status, error) {
                if (xhr.status === 422) {
                    var errorsResponse = JSON.parse(xhr.responseText);
                    console.error("Validation Error:", errorsResponse);

                    var errorMessage = "";

                    if (errorsResponse.errors) {
                        for (var key in errorsResponse.errors) {
                            if (errorsResponse.errors.hasOwnProperty(key)) {
                                errorMessage +=
                                    errorsResponse.errors[key][0] + "\n";
                            }
                        }
                    } else {
                        errorMessage = "Validation error occurred.";
                    }

                    Swal.fire({
                        title: "Validation Error",
                        text: errorMessage,
                        icon: "error",
                    });
                } else {
                    console.error("Error:", error);
                    Swal.fire({
                        title: "Error",
                        text: "An error occurred while processing your request. Please try again later.",
                        icon: "error",
                    });
                }
            },
        });
    });

    $("#updateFarmLeader").on("click", function () {
        updateFarmLeader();
    });

    $("#archive-farmleader-btn").on("click", function () {
        archiveFarmLeader();
    });

    $(document).on("click", ".edit_farmleader_btn", function (event) {
        event.preventDefault();
    
        var farmLeaderID = $(this).data("farmleader-id");
    
        console.log("Farm Leader ID is " + farmLeaderID);
    
        $.ajax({
            url: "/getFL/" + farmLeaderID,
            method: "GET",
            success: function (data) {
                console.log(data);
    
                // Populate the farm name and location fields
                $("#farm").val(data.farm ? data.farm.farm_name : "");
                // $("#location").val(data.farmLocation ? data.farmLocation.address : "");
    
                // Populate other fields
                $("#farmLeaderID").val(data.farmLeaders.id);
                $("#edit-firstname").val(data.farmLeaders.firstname);
                $("#edit-lastname").val(data.farmLeaders.lastname);
                $("#edit-email").val(data.farmLeaders.email);
    
                // Show the modal
                $("#editFLModal").modal("show");
            },
            error: function (xhr, status, error) {
                console.error("Error:", status, error);
            },
        });
    });
    
    

    

    $(document).on("click", ".archive_farmleader_btn", function (event) {
        event.preventDefault();

        var farmLeaderID = $(this).data("farmleader-id");

        console.log("Uom ID is " + farmLeaderID);

        $.ajax({
            url: "/getFL/" + farmLeaderID,
            method: "GET",
            success: function (data) {
                console.log(data);
                // $("#uom-table").html(data)
                //populateUomTable(data)
                $("#archive-admin-name").text(data.farmLeaders.firstname);
                $("#archive-adminID").val(data.farmLeaders.id);
            },
            error: function (xhr, status, error) {
                console.error("Error:", status, error);
            },
        });

        $("#adminArchiveShowModal").modal("show");
    });

    $('#importBtn').click(function(e) {
        e.preventDefault();

        var formData = new FormData($('#importForm')[0]);

        $.ajax({
            url: '/import-farmleader',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Handle success response
                console.log(response);
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
            }
        });
    });

    // Initialize mini map
    var miniMap = L.map('mini-map').setView([14.717499241909843, 121.04829782475622], 14);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(miniMap);

    var marker;

    // Add click event to mini map
    miniMap.on('click', function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;
    
        // Using OpenStreetMap Nominatim API for reverse geocoding
        var apiUrl = 'https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=' + lat + '&lon=' + lng;
    
        // Making a GET request to fetch the address
        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                var address = data.display_name;
    
                if (marker) {
                    marker.setLatLng(e.latlng);
                } else {
                    marker = L.marker(e.latlng).addTo(miniMap);
                }
    
                // Save location coordinates and address in input fields
                $('#latitude').val(lat);
                $('#longitude').val(lng);
                $('#address').val(address);
            })
            .catch(error => {
                console.error('Error fetching address:', error);
            });
    });
    

    // Initialize geocoder control
    var geocoder = L.Control.geocoder({
        collapsed: true,  // Collapsed by default
        defaultMarkGeocode: false,
        placeholder: "Search for an address...",  // Custom placeholder text
        position: 'topright'  // Position control at top-right
    }).addTo(miniMap);

    // Handle geocode event
    geocoder.on('markgeocode', function(e) {
        var latlng = e.geocode.center;
        var address = e.geocode.name;

        // Set marker and center map
        if (marker) {
            marker.setLatLng(latlng);
        } else {
            marker = L.marker(latlng).addTo(miniMap);
        }
        miniMap.setView(latlng);

        // Save location coordinates in input fields
        $('#latitude').val(latlng.lat);
        $('#longitude').val(latlng.lng);

        // Display address
        $('#address').val(address);
    });

    $('#address').on('change', function() {
        var address = $(this).val();
        if (address) {
            geocoder.geocode(address, function(results) {
                var latlng = results[0].center;
                if (marker) {
                    marker.setLatLng(latlng);
                } else {
                    marker = L.marker(latlng).addTo(miniMap);
                }
                miniMap.setView(latlng);
    
                // Save location coordinates in input fields
                $('#latitude').val(latlng.lat);
                $('#longitude').val(latlng.lng);
            });
        }
    });

    // Refresh mini map on modal shown
    $('#farmLeadershowModal').on('shown.bs.modal', function () {
        setTimeout(function() {
            miniMap.invalidateSize();
        }, 10);
    });
});
