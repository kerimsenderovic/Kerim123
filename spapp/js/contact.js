var users = [];
var idCounter = 1;

$(document).ready(function() {
    $("#tutorial-form").validate({
        rules: {
            name: {
                required: true,
            }
        },
        submitHandler: function(form, event) {
            event.preventDefault();
            blockUi(form);
            let data = serializeForm(form);
            console.log("Submitted Data:", data); 
            $(form)[0].reset();
           
            $("#success-toast").toast({
                autohide: false,
                delay: 0,
                animation: true,
                position: 'absolute',
                bottom: '10px',
                right: '10px'
            }).toast('show');
            unblockUi(form);
        }
    });

    
    $("#success-toast .btn-close").on('click', function() {
        $("#success-toast").toast('hide');
    });
});

function blockUi(form) {
    $(form).block({
        message: '<div class="spinner-border text-primary" role="status"></div>',
        css: {
            backgroundColor: "transparent",
            border: "0",
        },
        overlayCSS: {
            backgroundColor: "#000",
            opacity: 0.25,
        },
    });
}

function unblockUi(form) {
    $(form).unblock({});
}

function serializeForm(form) {
    let jsonResult = {};
    $(form).find('input, select, textarea').each(function() {
        jsonResult[this.name] = $(this).val();
    });
    return jsonResult;
}

function initializeDatatable(tableId, data) {
    $(tableId).DataTable({
        columns: [
            { data: "id" },
            { data: "name" },
            { data: "email" },
            { data: "comment" },
        ],
        data: data
    });
}