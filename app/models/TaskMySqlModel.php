<?php

class TaskMySqlModel extends Model
{
    private $pdoConect;

    public function __construct()
    {
        $this->pdoConect = new PdoModel();
        $this->init();
    }

    public function init()
    {
        $this->_setTable('tareas');
    }

    public function fetchOne($id)
    {
        // Preparamos la sentencia contra la tabla que se ha inicializado
        $sql = 'select * from ' . $this->_table;
        $sql .= ' where idTareas = ?';
        // Ejecutamos la sentencia
        $statement = $this->pdoConect->_dbh->prepare($sql);
        $statement->execute(array($id));
        // Devolvemos el registro encontrado
        return $statement->fetch(PDO::FETCH_OBJ);
    }

    public function save($data = array())
    {
        $sql = '';
        $values = array();

        if (array_key_exists('id', $data)) {
            $sql = 'update ' . $this->_table . ' set ';

            $first = true;
            foreach($data as $key => $value) {
                if ($key != 'id') {
                    $sql .= ($first == false ? ',' : '') . ' ' . $key . ' = ?';

                    $values[] = $value;

                    $first = false;
                }
            }

            // adds the id as well
            $values[] = $data['id'];

            $sql .= ' where id = ?';// . $data['id'];

            $statement = $this->pdoConect->_dbh->prepare($sql);
            return $statement->execute($values);
        }
        else {
            $keys = array_keys($data);

            $sql = 'insert into ' . $this->_table . '(';
            $sql .= implode(',', $keys);
            $sql .= ')';
            $sql .= ' values (';

            $dataValues = array_values($data);
            $first = true;
            foreach($dataValues as $value) {
                $sql .= ($first == false ? ',?' : '?');

                $values[] = $value;

                $first = false;
            }

            $sql .= ')';
            $statement = $this->pdoConect->_dbh->prepare($sql);

            if ($statement->execute($values)) {
                return $this->pdoConect->_dbh->lastInsertId();
            }
        }

        return false;
    }

    public function delete($id)
    {
        $statement = $this->pdoConect->_dbh->prepare("delete from " . $this->_table . " where idTareas = ?");
        return $statement->execute(array($id));
    }

    public function fetchAll()
    {
        // Preparamos la sentencia contra la tabla que se ha inicializado
        //$sql = 'select * from ' . $this->_table;
        $sql = 'SELECT  t.idTareas, t.titulo, t.descripcion, 
                        t.estado, t.fec_creacion, t.fec_modif, 
                        t.fec_fintarea, t.idUsuario, u.Nombre 
                FROM '. $this->_table .' as t
                INNER JOIN `usuarios` as u on t.idUsuario = u.idUsuario';
        // Ejecutamos la sentencia
        $statement = $this->pdoConect->_dbh->prepare($sql);
        $statement->execute();
        // Devolvemos los registros encontrados
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}