$(document).ready(function() {

    loadArrangements();

    let editorInstances = {};

    ClassicEditor
        .create(document.querySelector('#description'), {
            toolbar: [
                'heading', '|',
                'bold', 'italic', 'underline', '|',
                'bulletedList', 'numberedList', '|',
                'link', '|',
                'insertTable', '|',
                'undo', 'redo'
            ],
            table: {
                contentToolbar: [ 'tableColumn', 'tableRow', 'mergeTableCells' ]
            }
        })
        .then(editor => {
            editorInstances.description = editor;
        })
        .catch(error => {
            console.error(error);
        });

    $('.save-arrangment').on('click', async function () {
        const form = $('#arrdetailsform')[0];
        const formData = new FormData(form);
        const url = config.routes.apps.save;

        formData.append('description', editorInstances.description.getData());

        $.ajax({
            url: url,
            type: "POST",
            processData: false,
            contentType: false,
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                Swal.fire({
                    title: "Success!",
                    text: "Successfully Saved!",
                    icon: "success",
                    buttonsStyling: false,
                    showConfirmButton: false,
                    timer: 3000
                });

                setTimeout(function () {
                    location.reload();
                }, 3000);
            },
            error: function (xhr, status, error) {
                console.error("Save error:", xhr.responseText);
                toastr.error('Error saving: ' + error, { timeOut: 5000 });
            }
        });
    });
});


function loadArrangements() {
    $.ajax({
        url: config.routes.apps.getarrangementlist,
        type: "GET",
        success: function (response) {
            if (response.status === "success") {
                renderArrangements(response.data);
            }
        },
        error: function (xhr) {
            console.error("Error loading data:", xhr.responseText);
        }
    });
}

function renderArrangements(data) {
    // clear old content first
    $(".accordion-body").each(function () {
        $(this).empty();
    });

    data.forEach(item => {
        const categoryMap = {
            "Engagement": "eng",
            "Pre-Wedding": "pre",
            "Wedding": "wed",
            "Post-Wedding": "pos"
        };

        const prefix = categoryMap[item.category];
        if (!prefix) return;

        // safer type slug
        const typeSlug = item.type.toLowerCase().replace(/\s+/g, '_');
        const target = $(`#acc_${typeSlug}_${prefix} .accordion-body`);
        if (!target.length) return;

        // Generate images grid
        let imagesHtml = "";
        if (item.images && item.images.length) {
            imagesHtml = `<div class="row g-3 mb-3">` +
                item.images.map(img => `
                    <div class="col-4">
                        <img src="/storage/${img.path}"
                             class="img-fluid rounded border" alt="${img.name || ''}">
                    </div>
                `).join('') +
            `</div>`;
        }

        // Status text
        const statusLabel = (item.status_id === 1) ? "Plan" : "Confirmed";

        // Build details card
        const html = `
            <div class="p-3 border rounded mb-3" style="background-color:#fff;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0 text-dark">${item.title} (Cost: RM${parseFloat(item.costing).toFixed(2)})</h5>
                    <span class="badge bg-light-primary">Status: ${statusLabel}</span>
                </div>
                ${imagesHtml}
                <div>
                    <p class="fw-bold mb-1">Description:</p>
                    <div>${item.description}</div>
                </div>
            </div>
        `;

        target.append(html);
    });
}
