//function init 
let table;
const init = ()=>{
    showHide(true);
    selectTask();
    $('#btnSave').on("click" , (e)=>{
        validateData();
        clearData();
    });
    $('#btnCancel').on("click" , ()=>{
        showHide(true);
        clearData();
        removeValidate();
    });
    
}
//function to show end hide element
const showHide =flang=>{
    if(flang){
        $("#formTask").hide();
        $("#tableTask").show();
    }else{
        $("#formTask").show();
        $("#tableTask").hide();
    }
}
//function to clear data
const clearData =()=>{
    $("#id_task").val("");
    $("#name_task").val("");
    $("#description_task").val("");
    $("#date_task").val("");
}
const removeValidate=()=>{
    let validation = $('#tableTaskData').validate();
    validation.destroy();
    $('#name_task').removeClass('is-invalid');
    $('#description_task').removeClass('is-invalid');
    $('#date_task').removeClass('is-invalid');
}
//function to create task
const createTask =()=>{
    $("#btnSave").prop("disable", true);
    var formData = new FormData($("#fromTaskData")[0]);

    $.ajax({
        url: "../controllers/task.php?op=updateInsertTask",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(datos){
            tabla.api().ajax.reload();
            alertify.success(datos);
            showHide(true);
        }

    });
   // limpiar();
}
//fucntion to bring information 
const selectTask=()=>{
    tabla= $('#tableTaskData').dataTable(
        {
            "aProcessing":true,
            "aServerSide":true,
            dom: 'Bfrtip',
            buttons:[
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdf'
            ],
            "ajax":
                    {
                        url: '../controllers/task.php?op=selectTask',
                        type: "get",
                        dataType: "json",
                        error: function(e){
                            console.log(e.responseText);
                        }
                    },
               "bDestroy": true,
               "iDisplayLength": 5,//paginacion
               "order": [[0, "desc"]] //ordenar (columna , orden) 
        }).dataTable();
}
//function to consult by ID
const selectTaskId=id_task=>{
    $.post("../controllers/task.php?op=selectTaskId",{id_task : id_task} , function(data , status ){
        data = JSON.parse(data);
        showHide(false);
        const {id_task , name_task , description_task , date_task} = data;
        $("#id_task").val(id_task);
        $("#name_task").val(name_task);
        $("#description_task").val(description_task);
        $("#date_task").val(date_task);
    });
    clearData();
}
///function to update status task  
const updateStatus=(status , id_task)=>{
         if(status == 1 ){
             $.post("../controllers/task.php?op=updateStatusPending",{id_task:id_task}, (data , status)=>{
                tabla.api().ajax.reload();
             });
         }else if(status == 2){
            $.post("../controllers/task.php?op=updateStatusDone",{id_task:id_task}, (data , status)=>{
                tabla.api().ajax.reload();
            });
         }else if(status == 3 ){
            $.post("../controllers/task.php?op=updateStatusCancelled",{id_task:id_task}, (data , status)=>{
                tabla.api().ajax.reload();
            });
         }
}
//function to delete task
const deleteTask=id_task=>{
    alertify.confirm('¿Esta seguro que quiere eliminar la tarea?', function(){ 
        $.post("../controllers/task.php?op=deleteTask",{id_task:id_task}, (data , status)=>{
            tabla.api().ajax.reload();
            alertify.success(data)
        });
     }, function(){ alertify.error('Cancel')

    });
}
//function to validate data 
const validateData = (e) =>{
    $('#fromTaskData').validate({
        rules:{
            name_task:{
                required:true,
                maxlength:50
            },
            description_task:{
                required:true,
                maxlength:500
            },
            date_task:{
                required:true
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
        },
        submitHandler:function(form,e){
            e.preventDefault();
         }
    });
    if( $('#fromTaskData').valid() === true){
        createTask();
    }
}
init();