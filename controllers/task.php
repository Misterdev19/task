<?php 
//required model task
require_once '../models/Task.php';
//we declare object
$task = new Task();
//validate campos
$id_task = isset($_POST['id_task']) ? limpiarCadena($_POST['id_task']): "";
$name_task = isset($_POST['name_task']) ? limpiarCadena($_POST['name_task']): "";
$description_task = isset($_POST['description_task']) ? limpiarCadena($_POST['description_task']): "";
$date_task = isset($_POST['date_task']) ? limpiarCadena($_POST['date_task']): "";
//validate requests
switch($_GET['op']){
    //update end insert
    case 'updateInsertTask':
        if(empty($id_task)){
            $rps = $task->insertTask($name_task, $description_task, $date_task);
            echo $rps? "Tarea ".$name_task." creada": "Tarea no creada";
        }else{
            $rps = $task->updateTask($id_task, $name_task, $description_task, $date_task);
            echo $rps? "Tarea ".$name_task." actulizada": "Tarea no actulizada";
        }
    break;
    case'selectTask':
        $rps = $task->selectTask();
        $data = Array();
        while($key = $rps->fetch_object()){
            if($key->status_id == 1){ $status = "<span class='badge bg-warning text-dark'>Pendiente</span>";}
            if($key->status_id == 2){$status = "<span class='badge bg-success '>Realizada</span>";}
            if($key->status_id == 3){$status = "<span class='badge bg-danger '>Cancelada</span>";}
            $data[]= array(
                "0"=>'<select class="form-select" name="status_id" onchange="updateStatus(value , '.$key->id_task.')">
                <option value="">Selección estado</option>
                <option value="1">Pendiente</option>
                <option value="2">Realizada</option>
                <option value="3">Cancelada</option>
                </select>',
                "1"=>$key->name_task,
                "2"=>$key->description_task,
                "3"=>$key->date_task,
                "4"=>'<button class="btn btn-primary" onclick="selectTaskId('.$key->id_task.')"><i class="bi bi-pencil-square"></i></button>'." ".'<button class="btn btn-danger" onclick="deleteTask('.$key->id_task.')"><i class="bi bi-trash"></i></button>',
                "5"=>$status
            );
        }
        $results = array(
            "eEcho"=>1, //information to datatable
            "iTotalRecors"=>count($data),//we send all of records
            "iTotalDisplayRescors"=>count($data),//we senf el total of records to be viewed
            "aaData"=>$data //data 
        );
        echo json_encode($results);
        
    break;
    case'selectTaskId':
        $rps = $task->selectTaskId($id_task);
        echo json_encode($rps);
    break;
    case'updateStatusDone':
        $rps = $task->updateStatusDone($id_task);
        echo $rps? "Tarea realizada":"error ";
    break;
    case'updateStatusCancelled':
        $rps = $task->updateStatusCancelled($id_task);
        echo $rps? "Tarea cancelada":"error";
    break;
    case'updateStatusPending':
        $rps = $task->updateStatusPending($id_task);
        echo $rps? "Tarea Pendiente":"Tarea no eliminada";
    break;
    case'deleteTask':
        $rps = $task->deleteTask($id_task);
        echo $rps? "Tarea eliminada":"Tarea no eliminada";
    break;
}

?>