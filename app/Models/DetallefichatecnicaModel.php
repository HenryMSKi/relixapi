<?php 
namespace App\Models;

use CodeIgniter\Model;

class DetallefichatecnicaModel extends Model{
    protected $table      = 'tblDetallefichatecnica';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'idDetallefichatecnica';

    protected $returnType = 'array';

    protected $allowedFields = [
        'itemDetallefichatecnica',
        'partidaDetallefichatecnica',
        'subpartidaDetallefichatecnica',
	    'marcaDetallefichatecnica',
	    'codigoproveedorDetallefichatecnica',
	    'codigosoftcomProducto',
	    'descripcionDetallefichatecnica',
	    'observacionDetallefichatecnica',
	    'cantidadDetallefichatecnica',
	    'preciounitarioDetallefichatecnica',
	    'preciototalDetallefichatecnica',
        'preciodescuentoDetallefichatecnica',
	    'costoingDetallefichatecnica',
	    'costototalDetallefichatecnica',
	    'descuentounitarioDetallefichatecnica',
	    'descuentopartidaDetallefichatecnica',
	    'descuentototalDetallefichatecnica',
	    'aprobaciongerenteDetallefichatecnica',
	    'aprobacionotroDetallefichatecnica',
        'idEstadoproductoDetallefichatecnica',
        'idFichatecnica',
    ];


    public function obtenerDetalleregistrado($id = null)
    {
        
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->join('tblProducto', 'tblDetallefichatecnica.codigosoftcomProducto = tblProducto.codigosoftcomProducto');
        $builder->join('tblPrecioproducto', 'tblDetallefichatecnica.codigosoftcomProducto = tblPrecioproducto.codigosoftcomProducto');
        $builder->where('idFichatecnica', $id);

        $query = $builder->get();
        return $query->getResult();
    }

    public function obtenerDetallefichatecnica($id = null)
    {
        $builder = $this->db->table($this->table);

        $builder->select('*');
        $builder->join('tblProducto', 'tblDetallefichatecnica.codigosoftcomProducto = tblProducto.codigosoftcomProducto');
        $builder->join('tblEstadoproductoDetallefichatecnica', 'tblDetallefichatecnica.idEstadoproductoDetallefichatecnica = tblEstadoproductoDetallefichatecnica.idEstadoproductoDetallefichatecnica');
        $builder->where('idFichatecnica', $id);
        $builder->orderBy('tblDetallefichatecnica.itemDetallefichatecnica', 'ASC');
        $builder->orderBy('tblDetallefichatecnica.idDetallefichatecnica', 'ASC');

        $query = $builder->get();
        return $query->getResult();
    }

    public function obtenerFicha($idFichatecnica)
    {
        $builder = $this->db->table('tblFichatecnica');

        $builder->select('*');
        $builder->join('tblDivision', 'tblFichatecnica.idDivision = tblDivision.idDivision');
        $builder->join('tblTipoproyecto', 'tblFichatecnica.idTipoproyecto = tblTipoproyecto.idTipoproyecto');
        $builder->join('tblVendedor', 'tblFichatecnica.idVendedor = tblVendedor.idVendedor');
        $builder->join('tblDepartamento', 'tblFichatecnica.idDepartamento = tblDepartamento.idDepartamento');
        $builder->join('tblProvincia', 'tblFichatecnica.idProvincia = tblProvincia.idProvincia');
        $builder->join('tblDistrito', 'tblFichatecnica.idDistrito = tblDistrito.idDistrito');
        $builder->join('tblModalidadcontrato', 'tblFichatecnica.idModalidadcontrato = tblModalidadcontrato.idModalidadcontrato');
        $builder->join('tblModalidadejecucion', 'tblFichatecnica.idModalidadejecucion = tblModalidadejecucion.idModalidadejecucion');
        $builder->join('tblFormapago', 'tblFichatecnica.idFormapago = tblFormapago.idFormapago');
        $builder->join('tblFacturacion', 'tblFichatecnica.idFacturacion = tblFacturacion.idFacturacion');
        $builder->join('tblEstadofichaproyecto', 'tblFichatecnica.idEstadofichaproyecto = tblEstadofichaproyecto.idEstadofichaproyecto');
        $builder->where('idFichatecnica', $idFichatecnica);

        $query = $builder->get();
        return $query->getResult();
    }
}