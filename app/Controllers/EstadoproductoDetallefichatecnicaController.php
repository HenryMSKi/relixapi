<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\EstadoproductoDetallefichatecnicaModel;
use CodeIgniter\RESTful\ResourceController;

class EstadoproductoDetallefichatecnicaController extends ResourceController{
    public function __construct() {
        $this->model = $this->setModel(new EstadoproductoDetallefichatecnicaModel);
    }

    public function listarEstadosProdutos()
    {
        $estadosBD = $this->model->findAll();

        array_splice($estadosBD, 0, 4);

        array_splice($estadosBD, 1,2);

        return $this->respond($estadosBD);
    }

}