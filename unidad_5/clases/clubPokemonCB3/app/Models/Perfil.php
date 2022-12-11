<?php
namespace App\Models;

class Perfil extends DBAbstractModel{
    
    private static $instancia;
    public static function getInstancia(){
        if(!isset(self::$instancia)){
            $miClase = __CLASS__;
            self::$instancia = new $miClase;
        }
        return self::$instancia;
    }

    public function __clone(){
        trigger_error("La clonación no es permitida!", E_USER_ERROR);
    }

    private $perfil;

    public function getPerfil(){
        return $this->perfil;
    }

    public function setPerfil($perfil){
        $this->perfil = $perfil;
    }

    public function getMensaje(){
        return $this->mensaje;
    }

    function set(){
        $this->query = "INSERT INTO perfiles(perfil) VALUES(:perfil)";
        $this->parametros["perfil"] = $this->perfil;
        $this->mensaje = $this->get_results_from_query() ? "Perfil añadido" : "No se pudo añadir";
    }
    function add()
    {
        $this->query = "INSERT INTO perfiles(perfil) values(:perfil) ";
        $this->parametros["perfil"] = $this->perfil;
        print_r($this->parametros);
        echo "hola";
        $this->mensaje = $this->get_results_from_query() ? "Perfil añadido" : "No se pudo añadir";
    }

    function get($perfil = ""){
        if($perfil != '') {
            $this->query = "SELECT *
            FROM perfiles
            WHERE perfil LIKE :perfil";
            //Cargamos los parámetros.
            $this->parametros['perfil']= "%$perfil%";
            //Ejecutamos consulta que devuelve registros.
            $this->get_results_from_query();
            echo "holaaaa";
        }
        if(count($this->rows) == 1) {
            foreach ($this->rows[0] as $propiedad=>$valor) {
                $this->$propiedad = $valor;
            }
            $this->mensaje = 'Perfil encontrado';
        }
        else {
            $this->mensaje = 'Perfil no encontrado';
        }

        return $this->rows;

    }



    function getPerfilU($data)
    {
        print_r($data);
        $this->query = "SELECT perfil FROM usuarios where user = :user and password = :password";
        $this->parametros["user"] = $data["user"];
        $this->parametros["password"] = $data["password"];
        $this->get_results_from_query();
        if(count($this->rows) == 1) {
            foreach ($this->rows[0] as $propiedad=>$valor) {
                $this->$propiedad = $valor;
            }
            $this->mensaje = 'sh encontrado';
        }
        else {
            $this->mensaje = 'sh no encontrado';
        }
        return $this->rows;   
    }

    function getPerfiles(){
        $this->query = "SELECT * FROM perfiles";
        $this->get_results_from_query();
        return $this->rows;
    }

    function edit($data = array()){
        foreach ($data as $campo=>$valor) {
            $$campo = $valor;
        }
        $this->query = "UPDATE perfiles SET perfil = :perfil WHERE id = :id";
        $this->parametros["perfil"] = $perfil;
        $this->parametros["id"] = $id;
        $this->mensaje = $this->get_results_from_query() ? "Perfil modificado" : "No se pudo modificar";
    }

    function delete($perfil = ""){
        $this->query = "DELETE FROM perfiles WHERE perfil = :perfil";
        $this->parametros["perfil"] = $perfil;
        $this->mensaje = $this->get_results_from_query() ? "Perfil eliminado" : "No se pudo eliminar";
    }
}
