$(document).ready(function () {
    Quill.register("modules/imageUploader", ImageUploader);
    const quill4 = new Quill("#edit_fer_information", {
        theme: "snow",
        modules: {
            toolbar: [
                ["bold", "italic", "underline"],
                [{ header: 1 }, { header: 2 }],
                [{ list: "ordered" }, { list: "bullet" }],
                ["image"],
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
                                body: formData,
                            }
                        )
                            .then((response) => response.json())
                            .then((result) => {
                                console.log(result);
                                if (result.data && result.data.url) {
                                    resolve(result.data.url);
                                } else {
                                    reject(
                                        "Invalid response from image uploader"
                                    );
                                }
                            })
                            .catch((error) => {
                                reject("Upload failed");
                                console.error("Error:", error);
                            });
                    });
                },
            },
        },
    });




function updateFertInfo() {
    var ferID = $('#ferID').val(); // Ensure this ID is correct and consistent
    var fer_name = $('#edit_fer_name').val();
    var fer_information = quill4.root.innerHTML;
    var fer_image = $('#edit_fer_image').prop('files')[0]; // Retrieve the file object from the input field
    if (!ferID || !fer_name || !fer_information) {
        console.error("Missing required fields");
        return;
    }

    var formData = new FormData();
    formData.append('fer_name', fer_name); // Ensure these keys match your backend expectations
    if (fer_image) {
        formData.append('fer_image', fer_image); // File object needs to be appended only if it exists
    }
    formData.append('fer_information', fer_information);

    $.ajax({
        url: "/fupdate/" + ferID, // Ensure the URL is correct
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token for Laravel
        },
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
            location.reload(); // Reload the page after a successful update
        },
        error: function(xhr, status, error) {
            console.error("Error:", xhr.responseText);
        }
    });
}

$(document).on('click', '#ferinfo-update', function() {
    updateFertInfo();
});

$(document).on('click', '.edit-fer-btn', function(event) {
    event.preventDefault();

    var ferID = $(this).data('fertilizers-id'); // Ensure this attribute is set in your HTML

    if (!ferID) {
        console.error("Invalid fertilizer ID");
        return;
    }

    $.ajax({
        url: "/fedit/" + ferID,
        method: "GET",
        success: function(data) {
            if (data && data.fertilizer) { // Typo correction: 'fertilzer' to 'fertilizer'
                quill4.root.innerHTML = data.fertilizer.information;

                $('#ferID').val(data.fertilizer.id);
                $('#edit_fer_name').val(data.fertilizer.fer_name);
                // $('#edit_fer_information').val(data.fertilizer.information);
                // Assuming there's an image tag for displaying the image, not the file input itself
                $('#edit_fer_image_display').attr('src', "/images/" + data.fertilizer.image);
                $('#fer_updateModal').modal('show');
            } else {
                console.error("Invalid data format:", data);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error:", xhr.responseText);
        }
    });
});


})

// Check for error