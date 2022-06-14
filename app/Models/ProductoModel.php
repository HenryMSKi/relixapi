<?php 
namespace App\Models;

use CodeIgniter\Model;

class ProductoModel extends Model{
    protected $table      = 'tblProducto';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'codigosoftcomProducto';

    protected $returnType = 'array';

    protected $allowedFields = [
        'descripcionProducto',
        'codigoreferenciaProducto',
        'undProducto',
        'marcaProducto',
	    'proveedorProducto',
	    'costopromedioProducto',
	    'costodisenoProducto',
        'familiaProducto',
    ];

    public function insertarProductos($Productos)
    {
        $builder = $this->db->table($this->table);

        $builder->insert($Productos);
    }
}