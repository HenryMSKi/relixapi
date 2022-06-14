<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\FinanciamientoModel;
use CodeIgniter\RESTful\ResourceController;

class FinanciamientoController extends ResourceController{
    public function __construct() {
        $this->model = $this->setModel(new FinanciamientoModel());
    }

    public function listarFinanciamiento()
    {
        $financiamientos = $this->model->findAll();

        return $this->respond($financiamientos, 200);
    }
}