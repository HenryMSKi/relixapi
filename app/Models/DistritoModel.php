<?php 
namespace App\Models;

use CodeIgniter\Model;

class DistritoModel extends Model{
    protected $table      = 'tblDistrito';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'idDistrito';

    protected $returnType = 'array';

    protected $allowedFields = ['nombreDistrito', 'idProvincia'];
}