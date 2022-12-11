<?php

namespace App\Models;

class Equipo extends DBAbstractModel
{
    private static $instancia;
    public static function getInstancia()
    {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }
    public function __clone()
    {
        trigger_error('La clonación no es permitida!.', E_USER_ERROR);
    }

    private $id;
    private $nombre;
    private $updated_at;

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getMensaje()
    {
        return $this->mensaje;
    }

    public function getUpdated()
    {
        return $this->updated_at;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function guardarenBD()
    {
        $this->query = "INSERT INTO equipos (nombre) VALUES (:nombre)";
        $this->parametros['nombre'] = $this->nombre;
        $this->get_results_from_query();
        $this->mensaje = 'Equipo creado';
    }

    public function get($id = '')
    {
        if ($id != '') {
            $this->query = "SELECT * FROM equipos WHERE id = :id";
            $this->parametros['id'] = $id;
            $this->get_results_from_query();
        }

        if (count($this->rows) == 1) {
            foreach ($this->rows[0] as $propiedad => $valor) {
                $this->$propiedad = $valor;
            }
            $this->mensaje = 'Equipo encontrado';
        } else {
            $this->mensaje = 'Equipo no encontrado';
        }
    }

    public function set($user_data=array())
    {

    }
    


    public function edit($user_data = array())
    {
        foreach ($user_data as $campo => $valor) {
            $$campo = $valor;
        }
        $this->query = "UPDATE equipos SET nombre = :nombre, updated_at = :updated_at WHERE id = :id";
        $this->parametros['nombre'] = $nombre;
        $this->updated_at = new \DateTime("now");
        $this->parametros['updated_at'] = $updated_at;
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        $this->mensaje = 'Equipo modificado';
    }

    public function delete($id = '')
    {
        $this->query = "DELETE FROM equipos WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        $this->mensaje = "Equipo borrado";
    }
    function __construct() {
        // Singleton no recomienda parámetros ya que
        // podría dificultar la lectura de las instancias.
        }
        
}
