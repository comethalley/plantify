console.log("Hello JS is here!");
// alert("Inventroy JS is HERE!")

$(document).ready(function () {
    getAllSupplier();
    getStocksList();

    function getAllSupplier() {
        $.ajax({
            url: "/all-supplier",
            method: "GET",
            success: function (data) {
                $("#supplier-tbl").html(data);
            },
            error: function (xhr, status, error) {
                console.error("Error:", status, error);
            },
        });
    }

    function getSupplier(supplierId) {
        console.log("Button is clicked !");
        console.log("Supplier ID is " + supplierId);

        $.ajax({
            url: "/getSupplier/" + supplierId,
            method: "GET",
            success: function (data) {
                console.log("Supplier data is", data);

                $(".farm-name").text(data.name);
                $("#supplier_name").text("About " + data.name);
                $("#supplier_description").text(data.description);

                //for edit modal

                $("#edit-supplier-name").val(data.name);
                $("#edit-supplier-description").val(data.description);
                $("#edit-supplier-address").val(data.address);
                $("#edit-supplier-contact").val(data.contact);
                $("#edit-supplier-email").val(data.email);

                //$('#archive-supplierID').val(data.id)
                $("#archive-supplier-name").text(data.name);
                getSupplierSeeds(supplierId);
            },
            error: function (xhr, status, error) {
                console.error("Error:", status, error);
            },
        });
    }

    function getSupplierSeeds(supplierId) {
        $.ajax({
            url: "/getSupplierSeeds/" + supplierId,
            method: "GET",
            success: function (data) {
                // console.log("Supplier data is", data);

                // $('.modal-title').text(data.name)
                // $('#supplier_name').text("About " + data.name)
                // $('#supplier_description').text(data.description)
                $("#supplier-seed").html(data);
            },
            error: function (xhr, status, error) {
                console.error("Error:", status, error);
            },
        });
    }

    function getStocksList() {
        $.ajax({
            url: "/getAllStock",
            method: "GET",
            success: function (data) {
                console.log(data);
                // $("#uom-table").html(data)
                populateStocksTable(data);
            },
            error: function (xhr, status, error) {
                console.error("Error:", status, error);
            },
        });
    }

    function populateStocksTable(data) {
        var tableBody = $("#stocksTable tbody");
        tableBody.empty();

        $.each(data.stocks, function (index, uom) {
            console.log(uom);
            var row =
                "<tr>" +
                "<td class='id'># " +
                uom.stocksID +
                "</td>" +
                "<td class='customer_name'>" +
                uom.qr_code +
                "</td>" +
                "<td class='customer_name'>" +
                uom.seedName +
                "</td>" +
                "<td class='customer_name'>" +
                uom.supplier_name +
                "</td>" +
                "<td class='customer_name text-success'>" +
                uom.available +
                "</td>" +
                "<td class='customer_name text-danger'>-" +
                uom.used +
                "</td>" +
                "<td class='customer_name'>" +
                uom.total +
                "</td>" +
                "<td class='customer_name'><button type='button' class='btn btn-info waves-effect waves-light w-xs logs-btn' id='logs-btn' data-bs-toggle='modal' data-bs-target='#logModal' data-logs-id=" +
                uom.stocksID +
                ">Logs</button></td>" +
                "</tr>";

            tableBody.append(row);
        });
    }

    function addSupplier() {
        var supplierName = $("#supplier-name").val();
        var supplierDescription = $("#supplier-description").val();
        var supplierAddress = $("#supplier-address").val();
        var supplierContact = $("#supplier-contact").val();
        var supplierEmail = $("#supplier-email").val();

        $.ajax({
            url: "/add-supplier",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                "supplier-name": supplierName,
                description: supplierDescription,
                address: supplierAddress,
                contact: supplierContact,
                email: supplierEmail,
            },
            success: function (data) {
                $("#showModal").modal("hide");
                Swal.fire({
                    title: "Successfully Supplier Added",
                    text: "Are you ready for the next level?",
                    icon: "success",
                });
                console.log(data);
                getAllSupplier();
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

    function editSupplier() {
        var supplierID = $("#edit-supplier-id").val();
        var supplierName = $("#edit-supplier-name").val();
        var supplierDescription = $("#edit-supplier-description").val();
        var supplierAddress = $("#edit-supplier-address").val();
        var supplierContact = $("#edit-supplier-contact").val();
        var supplierEmail = $("#edit-supplier-email").val();

        $.ajax({
            url: "/edit-supplier/" + supplierID,
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                "supplier-name": supplierName,
                description: supplierDescription,
                address: supplierAddress,
                contact: supplierContact,
                email: supplierEmail,
            },
            success: function (data) {
                $("#editModal").modal("hide");
                Swal.fire({
                    title: "Successfully Updated",
                    text: "Are you ready for the next level?",
                    icon: "success",
                });

                console.log(data);
                getAllSupplier();
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

    function archiveSupplier() {
        var supplierID = $("#archive-supplierID").val();

        $.ajax({
            url: "/archive-supplier/" + supplierID,
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (data) {
                $("#archiveModal").modal("hide");
                Swal.fire({
                    title: "Successfully Archive",
                    text: "Are you ready for the next level?",
                    icon: "success",
                });
                console.log(data);
                getAllSupplier();
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

    function addSeedSupplier() {
        var supplier_id = $("#supplier-id").val();
        var seedID = $("#seed").val();
        var uomID = $("#uom").val();
        var quantity = $("#qty").val();
    
        // Create a FormData object to handle file uploads
        var formData = new FormData();
        formData.append('image', $('#image')[0].files[0]); // Append the image file
        formData.append('supplier_id', supplier_id);
        formData.append('seed_id', seedID);
        formData.append('uom_id', uomID);
        formData.append('quantity', quantity);
    
        $.ajax({
            url: "/add-seed",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            // Use the FormData object instead of plain data
            data: formData,
            // Set processData and contentType to false when using FormData
            processData: false,
            contentType: false,
            success: function (data, textStatus, xhr) {
                console.log(data);
                $("#seed").val(0);
                $("#uom").val(0);
                $("#qty").val(0);
    
                if (xhr.status === 200) {
                    getSupplier(supplier_id);
                } else if (xhr.status === 404) {
                    console.error("Seed not found");
                }
            },
            error: function (xhr, status, error) {
                console.error("Error:", status, error);
            },
        });
    }

    // $('.supplier_btn').on('click', function() {

    //     var supplierId = $(this).data('supplier-id');
    //     console.log(supplierId);
    //     $('#supplier-id').val(supplierId)
    //     getSupplier(supplierId);
    // });

    $("#seed-btn").on("click", function () {
        addSeedSupplier();
    });

    $("#add-supplier").on("click", function () {
        addSupplier();
    });

    $("#edit-supplier").on("click", function () {
        console.log("Edit Supplier Btn is clicked");
        editSupplier();
    });

    $("#delete-record").on("click", function () {
        archiveSupplier();
    });

    // var supplier = $('#supplier_description').text();
    // console.log("Supplier is " + supplier);

    let scanner;
    let modal = document.getElementById("receiveModal");

    function receiveItem(lastScannedContent, parsedMultipleReceive) {
        if (lastScannedContent == "") {
            // alert("QR code is empty!");
            Swal.fire({
                title: "QR code is empty !",
                text: "Please show appropriate QR Code",
                icon: "error",
                showConfirmButton: false,
                timer: 2000,
            });
        } else {
            // alert(lastScannedContent);
            stopScanner();
            $.ajax({
                url: "/add-stock",
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                data: {
                    qrcode: lastScannedContent,
                    multiplier: parsedMultipleReceive,
                },
                success: function (data) {
                    getStocksList();
                    console.log(data);
                    console.log("multiplier is " + parsedMultipleReceive);
                    lastScannedContent = "";
                    $("#multiple-receive").val("1");
                    $("#received-qr").text(" ");
                    Swal.fire({
                        title: "Successfully Added",
                        text: "Item has been added to inventory",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                    startScanner();
                },
                error: function (xhr, status, error) {
                    console.error("Error:", status, error);
                },
            });
        }
    }

    function startScanner() {
        scanner = new Instascan.Scanner({
            video: document.getElementById("preview"),
        });

        var lastScannedContent = "";

        scanner.addListener("scan", function (content) {
            console.log(content);
            lastScannedContent = content;
            $("#received-qr").text(lastScannedContent);
            var multipleReceive = $("#multiple-receive").val();
            var parsedMultipleReceive = parseInt(multipleReceive);
            receiveItem(lastScannedContent, parsedMultipleReceive);
        });

        // $('#receive-scan').on('click', function () {
        //     var multipleReceive = $("#multiple-receive").val();
        //     var parsedMultipleReceive = parseInt(multipleReceive);
        //     receiveItem(lastScannedContent, parsedMultipleReceive);
        //     lastScannedContent = "";
        // });

        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error("No cameras found.");
            }
        });
    }

    function stopScanner() {
        if (scanner) {
            scanner.stop();
        }
    }

    modal.addEventListener("shown.bs.modal", function () {
        startScanner();
    });

    modal.addEventListener("hidden.bs.modal", function () {
        stopScanner();
        lastScannedContent = "";
    });

    function getLogs(stockID) {
        $.ajax({
            url: "/getLogs/" + stockID,
            method: "GET",
            success: function (data) {
                $("#log-table").html(data);
            },
            error: function (xhr, status, error) {
                console.error("Error:", status, error);
            },
        });
    }

    function voidItem() {
        var logID = $("#logs-id").val();
        var email = $("#logs-email").val();
        var password = $("#logs-password").val();
        $.ajax({
            url: "/void-item",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                logID: logID,
                email: email,
                password: password,
            },
            success: function (data, textStatus, xhr) {
                console.log(data);
                if (xhr.status === 200) {
                    //alert("Success:" + data.success);
                    Swal.fire({
                        title: "Success",
                        text: data.success,
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000,
                    }).then((result) => {
                        location.reload();
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error("Error:", status, error);

                var statusCode = xhr.status;

                if (statusCode === 401) {
                    alert(error);
                } else if (statusCode === 404) {
                    alert(error);
                } else {
                    alert("Internal Server Error", error);
                }
            },
        });
    }

    $(document).on("click", "#logs-btn", function () {
        var stockID = $(this).data("logs-id");
        getLogs(stockID);
    });

    $("#void-btn").on("click", function () {
        console.log("void-btn is clicked");
        voidItem();
    });

  
});
