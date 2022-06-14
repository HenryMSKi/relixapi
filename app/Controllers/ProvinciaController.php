<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProvinciaModel;
use CodeIgniter\RESTful\ResourceController;

class ProvinciaController extends ResourceController{
    public function __construct() {
        $this->model = $this->setModel(new ProvinciaModel());
    }

    public function listarProvincias($id = null)
    {
        $codDep = [
            'idDepartamento' => $id
        ];

        /* $codDep = $this->request->getJSON(); */

        if(empty($codDep)):
            return $this->failServerError('No paso codigo de departamento', 500, 'No paso codigo de departamento');
        else:
            $provincias = $this->model->whereIn('idDepartamento', [1, $codDep['idDepartamento']])->findAll();
            return $this->respond($provincias, 200);
        endif;
    }
}