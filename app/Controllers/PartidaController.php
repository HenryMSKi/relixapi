<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PartidaModel;
use CodeIgniter\RESTful\ResourceController;

class PartidaController extends ResourceController{
    public function __construct() {
        $this->model = $this->setModel(new PartidaModel());
    }

    public function listarPartidas()
    {
        $partidas = $this->model->findAll();

        return $this->respond($partidas, 200);
    }

}