<?php 
namespace App\Models;

use CodeIgniter\Model;

class FormapagoModel extends Model{
    protected $table      = 'tblFormapago';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'idFormapago';

    protected $returnType = 'array';

    protected $allowedFields = ['formaPago'];
}