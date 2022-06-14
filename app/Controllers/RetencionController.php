<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\RetencionModel;
use CodeIgniter\RESTful\ResourceController;

class RetencionController extends ResourceController{
    public function __construct() {
        $this->model = $this->setModel(new RetencionModel());
    }

    public function listarRetencion()
    {
        $retenciones = $this->model->findAll();

        return $this->respond($retenciones, 200);
    }
}