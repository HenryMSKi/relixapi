<?php 
namespace App\Models;

use CodeIgniter\Model;

class ProvinciaModel extends Model{
    protected $table      = 'tblProvincia';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'idProvincia';

    protected $returnType = 'array';

    protected $allowedFields = ['nombreProvincia', 'idDepartamento'];
}