<?php

class TaskJsonModel{
    public const ESTADO_PDTE = 'pendiente';

    public function __construct()
    {  
    }
   
    private function openFile(): string
    {
        return file_get_contents(ROOT_PATH . "/lib/json/todoTask.json", true);
    }

    private function saveFile($data): void
    {
        file_put_contents(ROOT_PATH . "/lib/json/todoTask.json", json_encode($data));
    }
    
    public function generateUuid()
    {
        return rand(1,50);
    }

    public function getDateFormat($date)
    {
        $date = new DateTime($date);
        return $date->format('Y-m-d');
    }

    public function saveTask($task): void
    {
        // Obtenemos la lista de tareas
        $allTask = $this->listAllTask();

        // Añadimos la nueva task
        array_push($allTask, get_object_vars($task));

        // Guardamos datos en fichero json        
        $this->saveFile($allTask);
    }

    public function listAllTask()
    {
        // Abrimos nuestro fichero json        
        $tareas_json = $this->openfile();
        // Decodificamos el json
        return  json_decode($tareas_json, true);
    }

    public function deleteTask($task)
    {
        // Obtenemos la lista de tareas
        $allTask = $this->listAllTask();

        // Buscamos task
        foreach($allTask as $key=>$value) {
            if($value['idTareas'] == $task['idTareas']) {
                unset($allTask[$key]);
            }
        }

        // Reorganizamos los indices del array
        $allTaskAux=array_values($allTask);

        // Guardamos datos en fichero json
        $this->saveFile($allTaskAux);
    }

    public function updateTask($allUsers, $user)
    {
        $key  = array_search($user['idTareas'], array_column($allUsers, 'idTareas'));
        $allUsers[$key]['titulo']       = $_GET['titulo'];
        $allUsers[$key]['descripcion']  = $_GET['descripcion'];
        $allUsers[$key]['estado']       = $_GET['estado'];
        $allUsers[$key]['fec_fintarea'] = $_GET['fec_fintarea'];

        $this->saveFile($allUsers);
    }

    public function changeStatusTask($allUsers, $user, $status)
    {
        $key  = array_search($user['idTareas'], array_column($allUsers, 'idTareas'));
        $allUsers[$key]['estado'] = $status;

        $this->saveFile($allUsers);
    }

}
