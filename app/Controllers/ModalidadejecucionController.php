<?php 
namespace App\Controllers;

use App\Models\ModalidadejecucionModel;
use CodeIgniter\Controller;
use CodeIgniter\RESTful\ResourceController;

class ModalidadejecucionController extends ResourceController{
    public function __construct() {
        $this->model = $this->setModel(new ModalidadejecucionModel());
    }

    public function listarModalidadejecucion()
    {
        $modalidadejecucion = $this->model->findAll();

        return $this->respond($modalidadejecucion, 200);
    }
}