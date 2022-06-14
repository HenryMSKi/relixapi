<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\FacturacionModel;
use CodeIgniter\RESTful\ResourceController;

class FacturacionController extends ResourceController{
    public function __construct() {
        $this->model = $this->setModel(new FacturacionModel());
    }

    public function listarFacturacion()
    {
        $facturaciones = $this->model->findAll();

        return $this->respond($facturaciones, 200);
    }
}