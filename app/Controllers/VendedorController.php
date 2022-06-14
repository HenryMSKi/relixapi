<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\VendedorModel;
use CodeIgniter\RESTful\ResourceController;

class VendedorController extends ResourceController{
    public function __construct() {
        $this->model = $this->setModel(new VendedorModel());
    }

    public function listarVendedores(){
        $vendedores = $this->model->findAll();

        return $this->respond($vendedores, 200);
    }
}