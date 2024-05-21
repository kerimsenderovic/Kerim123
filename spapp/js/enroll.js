var users = [];
var idCounter = 1;

$(document).ready(function() {
    // Fetch trainers data from backend and populate the select dropdown
    $.get(Constants.get_api_base_url() + "get_trainers.php", function(response) {
        users = response;
        var select = $("#select");
        select.empty();
        select.append('<option selected>Select an option</option>');
        users.forEach(function(trainer) {
            select.append('<option value="' + trainer.id + '">' + trainer.firstName + ' ' + trainer.lastName + '</option>');
        });
    });

    $("#tutorial-form").validate({
        rules: {
            firstName: {
                required: true,
            }
        },
        submitHandler: function (form, event) {
            event.preventDefault();
            blockUi(form);
            var data = serializeForm(form);

            $.post(
                Constants.get_api_base_url() + "add_trainer.php",
                data,
                function (response) {
                    users.push(response);
                    if ($.fn.dataTable.isDataTable("#tutorial-table")) {
                        $("#tutorial-table").DataTable().destroy();
                    }
                    initializeDatatable("#tutorial-table", users);
                    unblockUi(form);
                    form.reset();
                }
            );
        }
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
    $(form).unblock();
}

function serializeForm(form) {
    let formData = {};
    $(form).find('input, select, textarea').each(function () {
        formData[this.name] = $(this).val();
    });
    return formData;
}

function initializeDatatable(tableId, data) {
    new DataTable(tableId, {
        columns: [
            { data: "id" },
            { data: "firstName" }, // Adjust column data fields as needed
            { data: "lastName" },
            { data: "email" },
            { data: "password" }
        ],
        data: data
    });
}