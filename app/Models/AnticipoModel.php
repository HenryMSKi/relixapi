<?php 
namespace App\Models;

use CodeIgniter\Model;

class AnticipoModel extends Model{
    protected $table      = 'tblAnticipo';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'idAnticipo';

    protected $returnType = 'array';

    protected $allowedFields = ['nombreAnticipo'];
}