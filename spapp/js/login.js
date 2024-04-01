var users=[];
var idCounter=1;
$("#tutorial-form").validate({
  rules: {
    email: {
      required: true,
      
    }
  },
  
  submitHandler: function(form, event) {
    event.preventDefault();
    blockUi(form);
    let data=serializeForm(form);
    data['id']=idCounter;
    data[
      "action"
    ] = `<button onClick="editUserDetails(${idCounter})">Edit</button>`;
    idCounter+=1;
    users.push(data);
    if ($.fn.dataTable.isDataTable("#tutorial-table")) {
      $("#tutorial-table").DataTable().destroy();
    }
    initializeDatatable("#tutorial-table",users);
    
    $("#tutorial-form")[0].reset();
    console.log(users);
   unblockUi("totorial-form")
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

function unblockUi(element) {
  $("#tutorial-form").unblock({});
}

serializeForm = (form) => {
  let jsonResult={};
  $.each($(form).serializeArray(),function(){
    jsonResult[this.name]=this.value;
  });
  return jsonResult;
};
initializeDatatable=(tableId,data) =>{
  new DataTable(tableId, {
    columns:[
      {data:"id"},
      {data:"email"},
      {data:"password"},
      
    ],
    data:data
  });

};