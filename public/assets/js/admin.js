console.log("Hello admin js is here");
$(document).ready(function () {
    getAdmins();

    function getAdmins() {
        $.ajax({
            url: "/getAllAdmin",
            method: "GET",
            success: function (data) {
                console.log(data);
                // $("#uom-table").html(data)
                populateUomTable(data);
            },
            error: function (xhr, status, error) {
                console.error("Error:", status, error);
            },
        });
    }

    function populateUomTable(data) {
        var tableBody = $("#admin-table tbody");
        tableBody.empty();

        $.each(data.admins, function (index, admin) {
            var row =
                "<tr>" +
                "<td class='id'># " +
                (index + 1) +
                "</td>" +
                "<td class='customer_name'>" +
                admin.firstname +
                "</td>" +
                "<td class='customer_name'>" +
                admin.lastname +
                "</td>" +
                "<td class='customer_name'>" +
                admin.email +
                "</td>" +
                "<td><ul class='list-inline gap-2 mb-0'><li class='list-inline-item edit' data-bs-toggle='tooltip' data-bs-trigger='hover' data-bs-placement='top' title='Edit'><a href='' class='text-primary d-inline-block edit_admin_btn' data-admin-id='" +
                admin.id +
                "'><i class='ri-pencil-fill fs-16'></i></a></li><li class='list-inline-item' data-bs-toggle='tooltip' data-bs-trigger='hover' data-bs-placement='top' title='Remove'><a class='text-danger d-inline-block archive_admin_btn' href='' data-admin-id='" +
                admin.id +
                "'><i class='ri-delete-bin-5-fill fs-16'></i></a></li></ul></td>" +
                "</tr>";

            tableBody.append(row);
        });
    }

    function updateAdmin() {
        var adminID = $("#adminID").val();
        var firstname = $("#edit-firstname").val();
        var lastname = $("#edit-lastname").val();
        var email = $("#edit-email").val();

        console.log(adminID);
        $.ajax({
            url: "/editAdmin/" + adminID,
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
                getAdmins();
                $("#editAdminModal").modal("hide");
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

    function archiveAdmin() {
        var adminID = $("#archive-adminID").val();
        // var unitName =  $('#edit-unit-name').val()

        $.ajax({
            url: "/archiveAdmin/" + adminID,
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (data) {
                console.log(data);
                getAdmins();
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

    $("#add-admin-btn").on("click", function () {
        console.log("add-btn is clicked");
        var firstname = $("#firstname").val();
        var lastname = $("#lastname").val();
        var email = $("#email").val();

        $.ajax({
            url: "/addAdmin",
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
                getAdmins();
                $("#showModal").modal("hide");
                Swal.fire({
                    title: "Successfully Invited",
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

    $("#updateAdmin").on("click", function () {
        updateAdmin();
    });

    $("#archive-admin-btn").on("click", function () {
        archiveAdmin();
    });

    $(document).on("click", ".edit_admin_btn", function (event) {
        event.preventDefault();

        var adminID = $(this).data("admin-id");

        console.log("Uom ID is " + adminID);

        $.ajax({
            url: "/getAdmin/" + adminID,
            method: "GET",
            success: function (data) {
                console.log(data);
                // $("#uom-table").html(data)
                //populateUomTable(data)
                $("#adminID").val(data.admin.id);
                $("#edit-firstname").val(data.admin.firstname);
                $("#edit-lastname").val(data.admin.lastname);
                $("#edit-email").val(data.admin.email);
            },
            error: function (xhr, status, error) {
                console.error("Error:", status, error);
            },
        });

        $("#editAdminModal").modal("show");
    });

    $(document).on("click", ".archive_admin_btn", function (event) {
        event.preventDefault();

        var adminID = $(this).data("admin-id");

        console.log("Uom ID is " + adminID);

        $.ajax({
            url: "/getAdmin/" + adminID,
            method: "GET",
            success: function (data) {
                console.log(data);
                // $("#uom-table").html(data)
                //populateUomTable(data)
                $("#archive-admin-name").text(data.admin.firstname);
                $("#archive-adminID").val(data.admin.id);
            },
            error: function (xhr, status, error) {
                console.error("Error:", status, error);
            },
        });

        $("#adminArchiveShowModal").modal("show");
    });
});
