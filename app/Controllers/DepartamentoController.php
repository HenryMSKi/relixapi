<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\DepartamentoModel;
use CodeIgniter\RESTful\ResourceController;

class DepartamentoController extends ResourceController{
    public function __construct() {
        $this->model = $this->setModel(new DepartamentoModel());
    }

    public function listarDepartamentos()
    {
        $departamentos = $this->model->findAll();

        return $this->respond($departamentos, 200);
    }
}