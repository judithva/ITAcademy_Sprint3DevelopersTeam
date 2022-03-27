<?php

class TaskController extends ApplicationController
{
    public function __construct()
    {
    }
    public function indexAction()
    {
        $this->view->message = "hello from task::index";
    }

    public function createTaskAction() {
        $userModel = new UserMySqlModel();
        $this->view->createtask = $userModel->fetchAll();

        if (!empty($_POST['task']) || !empty($_POST['user'])) {
            // Recogemos los valores y lo guardamos en un array;
            $task = [];
            $task['titulo'] = $_POST['task'];
            $task['descripcion']  = $_POST['description'];
            $task['estado'] = 'Pendiente';
            $task['fec_creacion'] = date('Y-m-d H:i:s', strtotime($_POST['dateStart']));
            $task['fec_modif']    = date('Y-m-d H:i:s');
            $task['fec_fintarea'] = date('Y-m-d H:i:s', strtotime($_POST['dateEnd']));
            $task['idUsuario'] = intval($_POST['user']);

            // Guardamos la task
            $taskModel  = new TaskMySqlModel();
            $taskModel->save($task);

            // Refrescamos la lista
            $this->view->showtask = $taskModel->fetchAll();
        }
    }

    public function deleteTaskAction($idTask) {
        $taskModel  = new TaskMySqlModel();
        $taskToDeleted = $taskModel->fetchOne($idTask);
        // Comprobar si el ID existe para eliminarlo
        if (!empty($taskToDeleted)) {
            // Eliminamos la task seleccionada
            $taskModel->delete($idTask);
        }
        // Refrescamos la lista
        $this->view->showtask = $taskModel->fetchAll();
    }

    public function showTaskAction() {
        //Declaramos un objeto de tipo Model
        $taskModel  = new TaskMySqlModel();

        // Chequeamos si es cambio de estado
        if (isset($_GET['op'])){

            $option = $_GET['op'];
            $id = $_GET['idTarea'];

            switch ($option){
                case 'create':
                    $this->createTaskAction();
                    break;
                case 'delete':
                    $this->deleteTaskAction(intval($id));
                    break;
                default:
                    echo "Este valor no corresponde a ninguna acción";
            }
        }
        // Pasamos los parametros del controller a la vista
        $this->view->showtask = $taskModel->fetchAll();
    }

}
