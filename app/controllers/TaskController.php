<?php

class TaskController extends ApplicationController
{    
	public function indexAction()
	{
		$this->view->message = "hello from test::index";
	}
	
	public function checkAction()
	{
		echo "hello from test::check";
	}

    public function createTaskAction()
    {
        if (!empty($_POST['task']) || !empty($_POST['user'])) {

            // Recoger los valores de los campos
            $taskTitle = $_POST['task'];
            $description = $_POST['description'];
            $user = $_POST['user'];
            $dateStart = $_POST['dateStart'];
            $dateEnd = $_POST['dateEnd'];

            // Validar la información contra bd o js
            $task = new stdClass();
            $taskJsonModel = new TaskJsonModel(); 
            $task->idTareas = $taskJsonModel->generateUuid();
            $task->usuario = $user;
            $task->titulo = $taskTitle;
            $task->descripcion = $description;
            $task->estado = TaskJsonModel::ESTADO_PDTE;            
            $task->fec_creacion = $taskJsonModel->getDateFormat($dateStart);
            $task->fec_modif = "";
            $task->fec_fintarea = $taskJsonModel->getDateFormat($dateEnd);

            // Guardamos la task
            $taskJsonModel->saveTask($task);     

            // Refrescamos la lista
            $this->view->showtask = $taskJsonModel->listAllTask();
        }
    }
    
    public function deleteTaskAction($idTask)
    {
        // Obtenemos el objeto task
        $task = $this->getTask($idTask);
        
        // Eliminamos la task seleccionada
        $taskJsonModel = new TaskJsonModel();
        $taskJsonModel->deleteTask($task);
        
        // Refrescamos la lista
        $this->view->showtask = $taskJsonModel->listAllTask();
    }

    public function updatetaskAction(){
        $id = $_GET['id'];
        $user = $this->getTask($id);
        $this->view->updatetask = $user;
    }
    public function update($id)
    {
        $user = $this->getTask($id);
        $taskJsonModel = new TaskJsonModel(); 
        $allUsers = $taskJsonModel->listAllTask();
        $taskJsonModel->updateTask($allUsers, $user);  
    }

    public function changestatus()
    {
        $id = $_GET['id'];
        $status = $_GET['estado'];
        $user = $this->getTask($id);
        $taskJsonModel = new TaskJsonModel();     
        $allUsers = $taskJsonModel->listAllTask();  
        $taskJsonModel->changeStatusTask($allUsers, $user, $status);
    }

    public function showTaskAction()
    {
       //Declaramos un objeto de tipo Model  
       $taskJsonModel = new TaskJsonModel();

       //Chequeamos si es cambio de estado
       if (isset($_GET['op'])){ 
           
            $option = $_GET['op'];
            $id = $_GET['id'];

            switch ($option){
                case 'create':
                    $this->createTaskAction();
                    break;
                case "changestatus":
                    //Cambiamos el estado de la tarea
                    $this->changestatus();
                    break;
                case "update":
                    //Actualizamos registro según los datos obtenidos
                    $this->update($id);                  
                    break;
                case 'delete':
                      $this->deleteTaskAction($id);
                      break;
                default:
                    echo "Este valor no corresponde a ninguna acción";
                    break;
            }
        }
        // Pasamos los parametros del controller a la vista 
        $this->view->showtask = $taskJsonModel->listAllTask();
    }

    public function getTask($id)
    {
        $taskJsonModel = new TaskJsonModel();
        $users = $taskJsonModel->listAllTask();

        foreach ($users as $user) {
            if ($user['idTareas'] == $id) {
                return $user;
            }
        }
        return null;
    }
}

