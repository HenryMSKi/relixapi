<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PrecioproductoModel;
use CodeIgniter\RESTful\ResourceController;

class PrecioproductoController extends ResourceController{
    public function __construct() {
        $this->model = $this->setModel(new PrecioproductoModel());
    }

    public function listarPrecioproducto()
    {
        $precio = $this->model->findAll();

        return $this->respond($precio, 200);
    }
}