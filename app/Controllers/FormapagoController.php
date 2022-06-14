<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\FormapagoModel;
use CodeIgniter\RESTful\ResourceController;

class FormapagoController extends ResourceController{
    public function __construct() {
        $this->model = $this->setModel(new FormapagoModel());
    }

    public function listarFormasPago()
    {
        $formaspago = $this->model->findAll();

        return $this->respond($formaspago, 200);
    }

}