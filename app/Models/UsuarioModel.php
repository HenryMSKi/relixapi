<?php 
namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model{
    protected $table      = 'tblUsuario';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'idUsuario';

    protected $returnType = 'array';

    protected $useSoftDeletes = true;

    protected $allowedFields = ['nombreUsuario', 'correoUsuario', 'apellidoUsuario', 'passwordUsuario', 'idRol', 'codigocambioClave', 'idEstadousuario'];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';

    protected $deletedField = 'deleted_at';


    protected $validationRules = [
        'nombreUsuario' => 'required|min_length[1]',
        'correoUsuario' => 'required|valid_email',
        'apellidoUsuario' => 'required|min_length[1]',
        'passwordUsuario' => 'required',
        'idRol' => 'existeRol',
    ];


    protected $validationMessages = [
        'correoUsuario' => [
            'valid_email' => 'Ingrese un correo valido',
            'required' => 'El correo es obligatorio'
        ],
        'nombreUsuario' => [
            'required' => 'El nombre es obligatorio',
            'min_length' => 'El nombre debe tener minimo 3 caracteres'
        ],

        'idRol' => [
            'existeRol' => 'El Rol no existe',
        ]
    ];

    protected $skipValidation = false;

    public function obtenerUsuariosporRol($idRol = null)
    {
        $builder = $this->db->table($this->table);

        $builder->select('*');
        $builder->join('tblRolUsuario', 'tblUsuario.idRol = tblRolUsuario.idRol');
        $builder->where('tblRolUsuario.idRol', $idRol);

        $query = $builder->get();
        return $query->getResult();
    }

    public function obtenerUsuarioSesion($id = null)
    {
        $builder = $this->db->table('tblUsuario');

        $builder->select('*');
        $builder->join('tblRolUsuario', 'tblUsuario.idRol = tblRolUsuario.idRol');
        $builder->where('tblUsuario.correoUsuario', $id);

        $query = $builder->get();
        return $query->getResult();
    }

    public function obtenerUsuarios()
    {
        $builder = $this->db->table('tblUsuario');

        $builder->select('*');
        $builder->join('tblRolUsuario', 'tblUsuario.idRol = tblRolUsuario.idRol');
        $builder->join('tblEstadousuario', 'tblUsuario.idEstadousuario = tblEstadousuario.idEstadousuario');
        $builder->orderBy('tblUsuario.idEstadousuario', 'DESC');
        /* $builder->where('tblUsuario.correoUsuario', $id); */

        $query = $builder->get();
        return $query->getResult();
    }
}