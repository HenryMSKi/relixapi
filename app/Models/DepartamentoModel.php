<?php 
namespace App\Models;

use CodeIgniter\Model;

class DepartamentoModel extends Model{
    protected $table      = 'tblDepartamento';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'idDepartamento';

    protected $returnType = 'array';

    protected $allowedFields = ['nombreDepartamento'];
}