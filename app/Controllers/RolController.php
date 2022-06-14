<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\RolModel;
use CodeIgniter\RESTful\ResourceController;

class RolController extends ResourceController{

    public function __construct()
    {
        $this->model = $this->setModel(new RolModel());
        helper('secure_password_helper');
    }

    public function listarRoles()
    {
        $roles = $this->model->findAll();
        /* return $this->respond($usuarios, 200); */
        /*  echo json_encode($usuarios); */

        return $this->respond($roles, 200)/* ->setHeader('Access-Control-Allow-Origin', '*') */;
        /* echo 'hola mundo'; */
    }
}