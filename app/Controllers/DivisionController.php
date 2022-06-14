<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\DivisionModel;
use CodeIgniter\RESTful\ResourceController;

class DivisionController extends ResourceController{
    public function __construct() {
        $this->model = $this->setModel(new DivisionModel());
    }

    public function listarDivision()
    {
        $divisiones = $this->model->findAll();

        return $this->respond($divisiones, 200);
    }
}