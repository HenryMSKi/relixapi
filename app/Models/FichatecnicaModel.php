<?php 
namespace App\Models;

use CodeIgniter\Model;

class FichatecnicaModel extends Model{
    protected $table      = 'tblFichatecnica';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'idFichatecnica';

    protected $returnType = 'array';
    
    protected $useSoftDeletes = true;
    
    protected $allowedFields = [
	    'fechaFichatecnica',
	    'numFichatecnica',
	    'idDivision',
	    'idTipoproyecto',
	    'nombreFichatecnica',
	    'clienteFichatecnica',
	    'rucclienteFichatecnica',
	    'telefonoFichatecnica',
	    'direccionfiscalFichatecnica',
	    'idVendedor',
        'codigoVendedorFichatecnica',
	    'idDepartamento',
	    'idProvincia',
	    'idDistrito',
	    'direccionentregaFichatecnica',
	    'alcanceFichatecnica',
	    'areaFichatecnica',
	    'cultivoFichatecnica',
	    'idModalidadcontrato',
	    'idModalidadejecucion',
        'detraccionesFichatecnica',
        'retencionFichatecnica',
        'cartafianzaFichatecnica',
        'fielcumplimientoFichatecnica',
	    'plazoejecucionFichatecnica',
	    'inicioproyectadoFichatecnica',
	    'finproyectadoFichatecnica',
        'anticipoFichatecnica',
	    'porcentajeanticipoFichatecnica',
	    'idFormapago',
        'financiamientoFichatecnica',
	    'tasaFichatecnica',
	    'periodograciaFichatecnica',
	    'plazoFichatecnica',
	    'periodocuotaFichatecnica',
	    'iniciofinanciamientoFichatecnica',
        'facturanegociableFichatecnica',
        'letraanticipadaFichatecnica',
        'anticipoocFichatecnica',
        'firmacontratoFichatecnica',
	    'idFacturacion',
	    'idEstadofichaproyecto',
        'instalacionFichatecnica',
	    'guardianiaFichatecnica',
	    'contenedoroficinaFichatecnica',
	    'residenteobraFichatecnica',
	    'vehiculoFichatecnica',
	    'prevencionistaFichatecnica',
	    'costoproyectoFichatecnica',
	    'margenFichatecnica',
	    'utilidadFichatecnica',
	    'valorventaFichatecnica',
	    'valorventaigvFichatecnica',
	    'oportunidadesFichatecnica',
	    'riesgocontratoFichatecnica',
        'cotizacionenviadaFichatecnica',
        'aprobaciongerenteFichatecnica',
        'aprobaciongerenteadministracionFichatecnica',
	    'idUsuario',
    ];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';

    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'fechaFichatecnica' => 'required',
        'numFichatecnica' => 'required',
        'idDivision' => 'required',
        'idTipoproyecto' => 'required',
        'nombreFichatecnica' => 'required',
        'clienteFichatecnica' => 'required',
        'rucclienteFichatecnica' => 'required',
        'telefonoFichatecnica' => 'required',
        'direccionfiscalFichatecnica' => 'required',
        'idVendedor' => 'required',
        'codigoVendedorFichatecnica' => 'required',
        'idDepartamento' => 'required',
        'idProvincia' => 'required',
        'idDistrito' => 'required',
        'direccionentregaFichatecnica' => 'required',
        'alcanceFichatecnica' => 'required',
        'areaFichatecnica' => 'required',
        'cultivoFichatecnica' => 'required',
        'idModalidadcontrato' => 'required',
        'idModalidadejecucion' => 'required',
        'detraccionesFichatecnica' => 'required',
        'retencionFichatecnica' => 'required',
        'cartafianzaFichatecnica' => 'required',
        'fielcumplimientoFichatecnica' => 'required',
        'plazoejecucionFichatecnica' => 'required',
        'inicioproyectadoFichatecnica' => 'required',
        'finproyectadoFichatecnica' => 'required',
        'anticipoFichatecnica' => 'required',
        'porcentajeanticipoFichatecnica' => 'required',
        'idFormapago' => 'required',
        'financiamientoFichatecnica' => 'required',
        'tasaFichatecnica' => 'required',
        'periodograciaFichatecnica' => 'required',
        'plazoFichatecnica' => 'required',
        'periodocuotaFichatecnica' => 'required',
        'iniciofinanciamientoFichatecnica' => 'required',
        'facturanegociableFichatecnica' => 'required',
        'letraanticipadaFichatecnica' => 'required',
        'anticipoocFichatecnica' => 'required',
        'firmacontratoFichatecnica' => 'required',
        'idFacturacion' => 'required',
        'idEstadofichaproyecto' => 'required',
        'instalacionFichatecnica' => 'required',
        'guardianiaFichatecnica' => 'required',
        'contenedoroficinaFichatecnica' => 'required',
        'residenteobraFichatecnica' => 'required',
        'vehiculoFichatecnica' => 'required',
        'prevencionistaFichatecnica' => 'required',
        'costoproyectoFichatecnica' => 'required',
        'margenFichatecnica' => 'required',
        'utilidadFichatecnica' => 'required',
        'valorventaFichatecnica' => 'required',
        'valorventaigvFichatecnica' => 'required',
        'oportunidadesFichatecnica' => 'required',
        'riesgocontratoFichatecnica' => 'required',
        'cotizacionenviadaFichatecnica' => 'required',
        'aprobaciongerenteFichatecnica' => 'required',
        'aprobaciongerenteadministracionFichatecnica' => 'required',
        'idUsuario' => 'required',
    ];

    protected $validationMessages = [
    ];

    protected $skipValidation = false;

    public function obtenercantidadFichas()
    {
        $builder = $this->db->table($this->table);

        $result = $builder->select('*')
                        ->countAllResults();
         
        /* $builder->where('tblUsuario.correoUsuario', $id); */

        /* $query = $builder->get(); */
        return $result;
    }

    public function obtenerFichas()
    {
        $builder = $this->db->table($this->table);

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
        $builder->orderBy('tblFichatecnica.created_at', 'DESC');
        
        $query = $builder->get();
        return $query->getResult();
    }

    public function obtenerFicha($id)
    {
        $builder = $this->db->table($this->table);

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
        $builder->where('idFichatecnica', $id);

        $query = $builder->get();
        return $query->getResult();
    }


    public function obtenerFichasCotizadas()
    {
        $builder = $this->db->table($this->table);

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
        $builder->where('cotizacionenviadaFichatecnica', 1);
        $builder->orderBy('idFichatecnica', 'DESC');

        $query = $builder->get();
        return $query->getResult();
    }

    public function obtenerFichasAprobadas()
    {
        $builder = $this->db->table($this->table);

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
        $builder->where('cotizacionenviadaFichatecnica', 1);
        $builder->where('aprobaciongerenteFichatecnica', 1);
        $builder->where('aprobaciongerenteadministracionFichatecnica', 1);
        $builder->orderBy('idFichatecnica', 'DESC');

        $query = $builder->get();
        return $query->getResult();
    }

    public function obtenerFichasPOST($id = null)
    {
        $builder = $this->db->table($this->table);

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
        $builder->where('numFichatecnica', $id);

        $query = $builder->get();
        return $query->getResult();
    }

    public function obtenerFichasPUT($id = null)
    {
        $builder = $this->db->table($this->table);

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
        $builder->where('idFichatecnica', $id);

        $query = $builder->get();
        return $query->getResult();
    }
}