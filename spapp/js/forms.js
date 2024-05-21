var users = [];
var idCounter = 1;

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
            _BAConstants.get_api_base_url() + "members/add",
            data,
            function(response) {
                users.push(data);
                if ($.fn.dataTable.isDataTable("#tutorial-table")) {
                    $("#tutorial-table").DataTable().destroy();
                }
                MemberService.reload_member_datatable();
                unblockUi(form);
                form.reset();
            }
        );
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
    $(form).unblock();
}

function serializeForm(form) {
    let formData = {};
    $(form).find('input, select, textarea').each(function () {
        formData[this.name] = $(this).val();
    });
    return formData;
}

var MemberService = {
    reload_member_datatable: function () {
        Utils.get_datatable(
            "#tutorial-table",
            Constants.get_api_base_url() + "members",
            [
                { data: "action" },
                { data: "id" },
                { data: "firstName" },
                { data: "lastName" },
                { data: "email" },
                { data: "password" }
            ]
        );
    },
    open_edit_member_modal: function (member_id) {
        RestClient.get("members/" + member_id, function (data) {
            $("#add-patient-modal").modal("toggle");
            $("#id").val(data.id); 
            $("#firstName").val(data.firstName);
            $("#lastName").val(data.lastName);
            $("#email").val(data.email);
            $("#password").val(data.password);
        });
    },
    delete_member: function (member_id) {
        if(confirm("Do you want to delete member with the id "+ member_id + "?")){
            RestClient.delete(
                "members/delete/"+ member_id,
                {},
                function(data){
                    MemberService.reload_member_datatable();
                }
            );
        }
    }
};