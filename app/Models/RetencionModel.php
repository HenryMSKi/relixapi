<?php 
namespace App\Models;

use CodeIgniter\Model;

class RetencionModel extends Model{
    protected $table      = 'tblRetencion';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'idRetencion';

    protected $returnType = 'array';

    protected $allowedFields = ['nombreRetencion'];
}