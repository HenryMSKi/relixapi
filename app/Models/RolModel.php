<?php 
namespace App\Models;

use CodeIgniter\Model;

class RolModel extends Model{
    protected $table      = 'tblRolUsuario';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'idRol';

    protected $returnType = 'array';

    protected $allowedFields = ['nombreRol'];

    
}