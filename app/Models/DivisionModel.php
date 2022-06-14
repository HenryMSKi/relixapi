<?php 
namespace App\Models;

use CodeIgniter\Model;

class DivisionModel extends Model{
    protected $table      = 'tblDivision';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'idDivision';

    protected $returnType = 'array';

    protected $allowedFields = ['nombreDivision'];
}