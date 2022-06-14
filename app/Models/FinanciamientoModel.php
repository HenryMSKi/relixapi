<?php 
namespace App\Models;

use CodeIgniter\Model;

class FinanciamientoModel extends Model{
    protected $table      = 'tblFinanciamiento';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'idFinanciamiento';

    protected $returnType = 'array';

    protected $allowedFields = ['nombreFinanciamiento'];
}