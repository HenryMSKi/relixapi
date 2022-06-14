<?php 
namespace App\Controllers;

use App\Models\FacturacionModel;
use CodeIgniter\Controller;
use App\Models\FacturanegociableModel;
use CodeIgniter\RESTful\ResourceController;

class FacturanegociableController extends ResourceController{
    public function __construct() {
        $this->model = $this->setModel(new FacturacionModel());
    }

    public function listarFacturacionnegociable()
    {
        $facturasnegociables = $this->model->findAll();

        return $this->respond($facturasnegociables, 200);
    }
}