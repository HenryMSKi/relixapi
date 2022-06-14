<?php 
namespace App\Models;

use CodeIgniter\Model;

class EstadofichaproyectoModel extends Model{
    protected $table      = 'tblEstadofichaproyecto';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'idEstadofichaproyecto';

    protected $returnType = 'array';

    protected $allowedFields = ['estadoFichaproyecto'];
}