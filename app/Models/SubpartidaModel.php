<?php 
namespace App\Models;

use CodeIgniter\Model;

class SubpartidaModel extends Model{
    protected $table      = 'tblSubPartida';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'idSubPartida';

    /* protected $useAutoIncrement = true; */

    protected $returnType     = 'array';
    /* protected $useSoftDeletes = true; */

    protected $allowedFields = ['codSubPartida', 'nombreSubPartida', 'idPartida'];

    /* protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at'; */

    /* protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false; */
}