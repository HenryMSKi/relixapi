<?php 
namespace App\Models;

use CodeIgniter\Model;

class TipoproyectoModel extends Model{
    protected $table      = 'tblTipoproyecto';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'idTipoproyecto';

    protected $returnType = 'array';

    protected $allowedFields = ['tipoProyecto'];
}