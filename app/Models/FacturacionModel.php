<?php 
namespace App\Models;

use CodeIgniter\Model;

class FacturacionModel extends Model{
    protected $table      = 'tblFacturacion';
    // Uncomment below if you want add primary key
     protected $primaryKey = 'idFacturacion';

    protected $returnType = 'array';

    protected $allowedFields = ['nombreFacturacion'];
}