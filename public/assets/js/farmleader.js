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

        console.log(farmLeaderID);
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
            },
            success: function (data) {
                console.log(data);
                getFarmLeader();
                $("#editFLModal").modal("hide");
                Swal.fire({
                    title: "Successfully Updated",
                    // text: "Are you ready for the next level?",
                    icon: "success",
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

                    alert(errorMessage);
                } else {
                    console.error("Error:", error);
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

                    alert(errorMessage);
                } else {
                    console.error("Error:", error);
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

        console.log("Uom ID is " + farmLeaderID);

        $.ajax({
            url: "/getFL/" + farmLeaderID,
            method: "GET",
            success: function (data) {
                console.log(data);
                // $("#uom-table").html(data)
                //populateUomTable(data)
                $("#farmLeaderID").val(data.farmLeaders.id);
                $("#edit-firstname").val(data.farmLeaders.firstname);
                $("#edit-lastname").val(data.farmLeaders.lastname);
                $("#edit-email").val(data.farmLeaders.email);
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
});
