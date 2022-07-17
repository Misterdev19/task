<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../node_modules/alertifyjs/build/css/alertify.min.css">
    <title>Tareas</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center" id="formTask">
            <div class="form col-4">
            <div class="title">
                <h4>Crea la tarea</h4>
            </div>
            <form name="fromTaskData" id="fromTaskData" method="POST">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nombre</label>
                    <input type="hidden" id="id_task" name="id_task">
                    <input type="text" class="form-control" id="name_task" name="name_task" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Descripción</label>
                    <textarea  class="form-control" name="description_task" id="description_task" ></textarea>
                </div>
                <div class="mb-3 ">
                     <label for="exampleInputPassword1" class="form-label">Fecha</label>
                    <input type="date" class="form-control" name="date_task" id="date_task">
                </div>
                <button type="button" class="btn btn-success" id="btnSave"><i class="bi bi-save2"></i></button>
                <button type="button" class="btn btn-danger" id="btnCancel">Cancelar</i></button>
            </form>
            </div>
        </div>
        <div class="row justify-content-center" id="tableTask">
            <div class="tableTask col-8">
                <div class="titleTable">
                    <h4>Listado de tareas <button class="btn btn-success" onclick="showHide(false)"> <i class="bi bi-file-earmark-plus"></i></button></h4>
                </div>
            <table class="table" id="tableTaskData">
            <thead>
                <tr>
                <th scope="col"><i class="bi bi-pen"></i></th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Fecha</th>
                <th scope="col"><i class="bi bi-sliders"></i></th>
                <th scope="col">Estado</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            </table>
            </div>
        </div>
    </div>
<script src="../node_modules/jquery/dist/jquery.min.js"></script>
<script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../node_modules/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="../node_modules/alertifyjs/build/alertify.min.js"></script>
<script src="../node_modules/alertifyjs/build/alertify.min.js"></script>
<script src="../node_modules/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="requests/task.js"></script>
</body>
</html>