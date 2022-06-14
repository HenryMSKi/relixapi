<?php 
namespace App\Models;

use CodeIgniter\Model;

class ModalidadcontratoModel extends Model{
    protected $table      = 'tblModalidadcontrato';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'idModalidadcontrato';

    protected $returnType = 'array';

    protected $allowedFields = ['modalidadContrato'];
}