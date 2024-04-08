var users = [];
    var idCounter = 1;

    $("#tutorial-form").validate({
        rules: {
            text: {
                required: true,
            }
        },
        submitHandler: function (form, event) {
            event.preventDefault();
            blockUi(form);
            let data = serializeForm(form);
            data['id'] = idCounter;
            data["action"] = `<button onClick="editUserDetails(${idCounter})">Edit</button>`;
            idCounter += 1;
            users.push(data);
            if ($.fn.dataTable.isDataTable("#tutorial-table")) {
                $("#tutorial-table").DataTable().destroy();
            }
            initializeDatatable("#tutorial-table", users);
            $(form)[0].reset();
            console.log(users);
            unblockUi(form);
        }
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
        $(form).find('input, select, textarea').each(function () {
            jsonResult[this.name] = $(this).val();
        });
        return jsonResult;
    }

    function initializeDatatable(tableId, data) {
        $(tableId).DataTable({
            columns: [
                {data: "id"},
                {data: "firstName"},
                {data: "lastName"},
                {data: "email"},
                {data: "password"}
            ],
            data: data
        });
    }
