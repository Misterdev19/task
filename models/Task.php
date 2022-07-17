<?php 
//required conexion DB 
require_once '../config/conexion.php';
class Task{
    //function to insert task
    public function insertTask($name_task, $description_task, $date_task){
        $sql="INSERT INTO task_list (name_task, description_task, date_task, status_id) VALUE('$name_task' , '$description_task', '$date_task', 1)";
        return ejecutarConsulta($sql);
    }
    //function to update task
    public function updateTask($id_task, $name_task, $description_task,  $date_task){
        $sql="UPDATE task_list SET name_task = '$name_task', description_task= '$description_task' , date_task='$date_task' WHERE id_task= '$id_task'";
        return ejecutarConsulta($sql);
    }
    //function to cosult task
    public function selectTask(){
        $sql="SELECT * FROM task_list";
        return ejecutarConsulta($sql);
    }
    //function to consult task by id
    public function selectTaskId($id_task){
        $sql="SELECT * FROM task_list WHERE id_task= '$id_task'";
        return ejecutarConsultaSimplementeFila($sql);
    }
    //function to update status task done 
    public function updateStatusDone($id_task){
        $sql ="UPDATE task_list SET status_id = 2 WHERE id_task='$id_task' ";
        return ejecutarConsulta($sql);
    }  
    //function to update status task cancelled 
    public function updateStatusCancelled($id_task){
        $sql ="UPDATE task_list SET status_id = 3 WHERE id_task='$id_task' ";
        return ejecutarConsulta($sql);
    }  
     //function to update status task pending 
    public function updateStatusPending($id_task){
        $sql ="UPDATE task_list SET status_id = 1 WHERE id_task='$id_task' ";
        return ejecutarConsulta($sql);
    }  
    //fucntion to delete task 
    public function deleteTask($id_task){
        $sql="DELETE FROM task_list WHERE id_task='$id_task'";
        return ejecutarConsulta($sql);
    }
}

?>