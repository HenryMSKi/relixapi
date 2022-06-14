<?php 
namespace App\Models;

use CodeIgniter\Model;

class ModalidadejecucionModel extends Model{
    protected $table      = 'tblModalidadejecucion';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'idModalidadejecucion';

    protected $returnType = 'array';

    protected $allowedFields = ['modalidadejecucion'];
}