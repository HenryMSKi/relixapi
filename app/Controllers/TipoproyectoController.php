<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\TipoproyectoModel;
use CodeIgniter\RESTful\ResourceController;

class TipoproyectoController extends ResourceController{
    public function __construct() {
        $this->model = $this->setModel(new TipoproyectoModel());
    }

    public function listarTipoproyecto()
    {
        $tiposproyecto = $this->model->findAll();

        return $this->respond($tiposproyecto, 200);
    }

}