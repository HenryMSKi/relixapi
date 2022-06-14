<?php 
namespace App\Models;

use CodeIgniter\Model;

class FacturanegociableModel extends Model{
    protected $table      = 'tblFacturanegociable';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'idFacturanegociable';

    protected $returnType = 'array';

    protected $allowedFields = ['facturaNegociable'];
}