console.log("Hello admin js is here");
$(document).ready(function () {
    getAdmins();

    function getAdmins() {
        $.ajax({
            url: "/getAllArchiveUsers",
            method: "GET",
            success: function (data) {
                console.log(data);
                // $("#uom-table").html(data)
                populateArchiveTable(data);
            },
            error: function (xhr, status, error) {
                console.error("Error:", status, error);
            },
        });
    }

    function populateArchiveTable(data) {
        var tableBody = $("#archived-table tbody");
        tableBody.empty();

        $.each(data.restore, function (index, restores) {
            var row =
                "<tr>" +
                "<td class='id'># " +
                (index + 1) +
                "</td>" +
                "<td class='customer_name'>" +
                restores.firstname +
                "</td>" +
                "<td class='customer_name'>" +
                restores.lastname +
                "</td>" +
                "<td class='customer_name'>" +
                restores.email +
                "</td>" +
                "</td>" +
                "<td class='customer_name'>" +
                restores.description +
                "</td>" +
                "<td><a class='text-success d-inline-block restore_btn' href='' data-restore-id='" +
                restores.id +
                "'><i class=' ri-arrow-go-back-line fs-16'></i></a></li></ul></td>" +
                "</tr>";

            tableBody.append(row);
        });
    }

    function restoreAdmin() {
        var adminID = $("#restore-userID").val();
        // var unitName =  $('#edit-unit-name').val()

        $.ajax({
            url: "/restoreUser/" + adminID,
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (data) {
                console.log(data);
                getAdmins();
                $("#adminArchiveShowModal").modal("hide");
                Swal.fire({
                    title: "Successfully Restore",
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

    $("#restore-user-btn").on("click", function () {
        restoreAdmin();
    });

    $(document).on("click", ".restore_btn", function (event) {
        event.preventDefault();

        var userID = $(this).data("restore-id");

        console.log("Uom ID is " + userID);

        $.ajax({
            url: "/getUsers/" + userID,
            method: "GET",
            success: function (data) {
                console.log(data.restore.firstname);
                // $("#uom-table").html(data)
                //populateUomTable(data)
                $("#restore-user-name").text(data.restore.firstname);
                $("#restore-userID").val(data.restore.id);
            },
            error: function (xhr, status, error) {
                console.error("Error:", status, error);
            },
        });

        $("#adminArchiveShowModal").modal("show");
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
