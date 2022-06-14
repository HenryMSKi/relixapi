<?php 
namespace App\Models;

use CodeIgniter\Model;

class DetraccionesModel extends Model{
    protected $table      = 'tblDetracciones';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'idDetracciones';

    protected $returnType = 'array';

    protected $allowedFields = ['nombreDetracciones'];
}