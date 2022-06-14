<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\EstadofichaproyectoModel;
use CodeIgniter\RESTful\ResourceController;

class EstadofichaproyectoController extends ResourceController{
    public function __construct() {
        $this->model = $this->setModel(new EstadofichaproyectoModel());
    }

    public function listarEstadosfichaproyecto()
    {
        $estadosfichaproyecto = $this->model->findAll();

        return $this->respond($estadosfichaproyecto, 200);
    }
}