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
        var token = Utils.get_from_localstorage("user") ? Utils.get_from_localstorage("user").token : null;
        console.log(Utils.get_from_localstorage("user"));

        $.ajax({
            url: Constants.get_api_base_url() + "members/add",
            type: "POST",
            data: data,
            beforeSend: function (xhr) {
                if (token) {
                    xhr.setRequestHeader("Authentication", token);
                }
            },
            success: function(response) {
                users.push(data);
                if ($.fn.dataTable.isDataTable("#tutorial-table")) {
                    $("#tutorial-table").DataTable().destroy();
                }
                MemberService.reload_member_datatable();
                unblockUi(form);
                form.reset();
            },
            error: function(jqXHR) {
                unblockUi(form);
                console.error("Error adding member:", jqXHR.responseText);
            }
        });
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
      RestClient.get(
        "members/get/" + member_id, 
        function (data) { // Callback function to handle success response
          $("#add-patient-modal").modal("toggle");
          $("#id").val(data.id); 
          $("#firstName").val(data.firstName);
          $("#lastName").val(data.lastName);
          $("#email").val(data.email);
          $("#password").val(data.password);
        }, 
        function(jqXHR) { // Error callback function
          console.error("Error getting member:", jqXHR.responseText);
        }
      );
    },
    
    delete_member: function (member_id) {
      if(confirm("Do you want to delete member with the id "+ member_id + "?")){
        RestClient.delete(
          "members/delete/" + member_id, 
          {}, 
          function(data){
            MemberService.reload_member_datatable();
          }, 
          function(jqXHR) {
            console.error("Error deleting member:", jqXHR.responseText);
          }
        );
      }
    }
  };