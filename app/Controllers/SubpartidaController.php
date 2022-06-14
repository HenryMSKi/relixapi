<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\SubpartidaModel;
use CodeIgniter\RESTful\ResourceController;

class SubpartidaController extends ResourceController{
    public function __construct() {
        $this->model = $this->setModel(new SubpartidaModel());
    }

    public function listarSubPartida($idPartida = null)
    {
        if(empty($idPartida)):
            return $this->failServerError('No paso codigo de partida', 500, 'No paso codigo de partida');
        else :
            $SubPartidas = $this->model->where('idPartida', $idPartida)->findAll();
            return $this->respond($SubPartidas);
        endif; 
    }
}