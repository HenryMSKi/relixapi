<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\DetraccionesModel;
use CodeIgniter\RESTful\ResourceController;

class DetraccionesController extends ResourceController{
    public function __construct() {
        $this->model = $this->setModel(new DetraccionesModel());
    }

    public function listarDetracciones()
    {
        $detracciones = $this->model->findAll();

        return $this->respond($detracciones, 200);
    }
}