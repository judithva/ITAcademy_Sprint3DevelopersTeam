# Rooster ToDo

Esta práctica tiene como base el proyecto de [PHP Initial Project](https://github.com/IT-Academy-BCN/phpInitialDemo) 
utilizando MVC haciendo CRUD contra una base de datos en MySql  [Todolist.sql](lib/db/mysql/Todolist.sql).

El proyecto cuenta con la siguiente estructura y ficheros implementados para esta entrega (Nivel2):

- **app**
    - **controllers**
        - **TaskController.php**
    - **models**
        - **TaskMySqlModel.php**
        - **UserMySqlModel.php**
        - **PdoModel.php**
    - **views**
        - **task**
            - **createtask.phtml**
            - **showtask.phtml**
            - **updatetask.phtml**
        - **footer.php**
        - **header.php**        
- **config**
    - **routes.php**
- **lib**
    - **db**
        - **mysql**
            - **Todolist.sql**    
- **web**
    - **images**
        - **galloList.png**
        - **roosterTodo.png**
    - **stylesheets**
        - **style.css**
    - **index.php**
