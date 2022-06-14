<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ModalidadcontratoModel;
use CodeIgniter\RESTful\ResourceController;

class ModalidadcontratoController extends ResourceController{
    public function __construct() {
        $this->model = $this->setModel(new ModalidadcontratoModel());
    }

    public function listarModalidadcontrato()
    {
        $modalidades = $this->model->findAll();

        return $this->respond($modalidades, 200);
    }
}