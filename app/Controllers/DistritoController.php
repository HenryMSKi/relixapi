<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\DistritoModel;
use CodeIgniter\RESTful\ResourceController;

class DistritoController extends ResourceController{
    public function __construct() {
        $this->model = $this->setModel(new DistritoModel());

    }

    public function listarDistritos($id = null)
    {
        $codProv = [
            'idProvincia' => $id
        ];

        /* $codProv = $this->request->getJSON(); */

        if(empty($codProv)):
            return $this->failServerError('No paso codigo de provincia', 200, 'No paso codigo de provincia');
        else:
            $distritos = $this->model->whereIn('idProvincia', [1, $codProv['idProvincia']])->findAll();

            return $this->respond($distritos, 200);
        endif;
    }

}