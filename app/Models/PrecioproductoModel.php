<?php 
namespace App\Models;

use CodeIgniter\Model;

class PrecioproductoModel extends Model{
    protected $table      = 'tblPrecioproducto';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'idPrecioproducto';

    protected $returnType = 'array';

    protected $allowedFields = [
        'precioventaunoProducto',
        'precioventadosProducto',
        'precioventatresProducto',
        'precioventacuatroProducto',
        'codigosoftcomProducto'
    ];

    public function insertarPrecios($Precios)
    {
        $builder = $this->db->table($this->table);

        $builder->insert($Precios);
    }
}