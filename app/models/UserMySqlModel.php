<?php

class UserMySqlModel extends Model
{
    private $pdoConect;

    public function __construct()
    {
        $this->pdoConect = new PdoModel();
        $this->init();
    }

    public function init()
    {
        $this->_setTable('usuarios');
    }

    public function fetchOne($id)
    {
    }

    public function save($data = array()) : int
    {
        return false;
    }

    public function delete($id) : bool
    {
        return false;
    }

    public function fetchAll()
    {
        // Preparamos la sentencia contra la tabla que se ha inicializado
        $sql = 'select * from ' . $this->_table;
        // Ejecutamos la sentencia
        $statement = $this->pdoConect->_dbh->prepare($sql);
        $statement->execute();
        // Devolvemos los registros encontrados
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}