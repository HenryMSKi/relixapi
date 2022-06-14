<?php 
namespace App\Models;

use CodeIgniter\Model;

class VendedorModel extends Model{
    protected $table      = 'tblVendedor';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'idVendedor';

    protected $returnType = 'array';

    protected $allowedFields = ['codigoVendedor', 'nombreVendedor'];

    
}