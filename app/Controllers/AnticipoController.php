<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AnticipoModel;
use CodeIgniter\RESTful\ResourceController;

class AnticipoController extends ResourceController{
    public function __construct() {
        $this->model = $this->setModel(new AnticipoModel());
    }

    public function listarAnticipo()
    {
        $anticipos = $this->model->findAll();

        return $this->respond($anticipos, 200);
    }
}