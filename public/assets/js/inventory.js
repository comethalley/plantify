console.log("Hello JS is here!")

$(document).ready(function() {

    function getSupplier(supplierId){
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

    function getSupplierSeeds(supplierId){

        $.ajax({
            url: "/getSupplierSeeds/" + supplierId,
            method: "GET",
            success: function(data) {
                // console.log("Supplier data is", data);

                // $('.modal-title').text(data.name)
                // $('#supplier_name').text("About " + data.name)
                // $('#supplier_description').text(data.description)
                $('#supplier-seed').html(data)
            },
            error: function(xhr, status, error) {
                console.error("Error:", status, error);
            }
        });
    }

    function addSeedSupplier(){
        var supplier_id = $('#supplier-id').val()
        var seedID = $("#seed").val();
        var uomID = $("#uom").val();
        var quantity = $("#qty").val();

        $.ajax({
            url: "/add-seed",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'supplier_id': supplier_id,
                'seed_id' : seedID,
                'uom_id'  : uomID,
                'quantity' : quantity
             },
            success: function(data) {
                console.log(data)
                $('#supplier-id').val('');
                $('#seed').val('');
                $('#uom').val('');
                $('#qty').val('');
                getSupplier(supplier_id);
            },
            error: function(xhr, status, error) {
                console.error("Error:", status, error);
            }
        });
    }

    $('.supplier_btn').on('click', function() {
        var supplierId = $(this).data('supplier-id');
        $('#supplier-id').val(supplierId)
        getSupplier(supplierId);
    });

    $('#seed-btn').on('click', function() {
        addSeedSupplier()
    });
    // var supplier = $('#supplier_description').text();
    // console.log("Supplier is " + supplier);

    let scanner;
    let modal = document.getElementById('receiveModal');

    function receiveItem(lastScannedContent) {
        if (lastScannedContent == "") {
            alert("QR code is empty!");
        } else {
            alert(lastScannedContent);
            stopScanner()
            $.ajax({
                url: "/add-stock",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'qrcode': lastScannedContent,
                 },
                success: function(data) {
                    console.log(data)
                    lastScannedContent = ""
                    startScanner()
                },
                error: function(xhr, status, error) {
                    console.error("Error:", status, error);
                }
            });

        }
    }
    
    function startScanner() {
        scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        
        var lastScannedContent = "";
    
        scanner.addListener('scan', function (content) {
            console.log(content);
            lastScannedContent = content;
        });
    
        $('#receive-scan').on('click', function () {
            receiveItem(lastScannedContent);
            lastScannedContent = "";
        });
    
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('No cameras found.');
            }
        });
    }
    
    function stopScanner() {
        if (scanner) {
            scanner.stop();
        }
    }

    modal.addEventListener('shown.bs.modal', function () {
        startScanner();
    });

    modal.addEventListener('hidden.bs.modal', function () {
        stopScanner();
        lastScannedContent = ""
    });
});

//for using scanner
$(document).ready(function() {

    let usingScanner;
    let usingModal = document.getElementById('usingModal');

    function usedItem(lastUsedScannedContent) {
        if (lastUsedScannedContent == "") {
            alert("QR code is empty!");
        } else {
            alert(lastUsedScannedContent);
            stopUsedScanner()
            $.ajax({
                url: "/remove-stock",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'qrcode': lastUsedScannedContent,
                 },
                success: function(data) {
                    console.log(data)
                    lastUsedScannedContent = ""
                    startUsedScanner()
                },
                error: function(xhr, status, error) {
                    console.error("Error:", status, error);
                }
            });

        }
    }
    
    function startUsedScanner() {
        usingScanner = new Instascan.Scanner({ video: document.getElementById('using-preview') });
        
        var lastUsedScannedContent = "";
    
        usingScanner.addListener('scan', function (content) {
            console.log(content);
            lastUsedScannedContent = content;
        });
    
        $('#using-scan').on('click', function () {
            usedItem(lastUsedScannedContent);
            lastUsedScannedContent = "";
        });
    
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                usingScanner.start(cameras[0]);
            } else {
                console.error('No cameras found.');
            }
        });
    }
    
    function stopUsedScanner() {
        if (usingScanner) {
            usingScanner.stop();
        }
    }

    usingModal.addEventListener('shown.bs.modal', function () {
        startUsedScanner();
    });

    usingModal.addEventListener('hidden.bs.modal', function () {
        stopUsedScanner();
        lastUsedScannedContent = ""
    });

});