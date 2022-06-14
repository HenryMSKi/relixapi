<?php 
namespace App\Models;

use CodeIgniter\Model;

class EstadoproductoDetallefichatecnicaModel extends Model{
    protected $table      = 'tblEstadoproductoDetallefichatecnica';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'idEstadoproductoDetallefichatecnica';

    protected $returnType = 'array';

    protected $allowedFields = [
        'nombreEstado'
    ];
    
}