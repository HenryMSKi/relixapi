<?php namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\API\ResponseTrait;
use Config\Services;
use CodeIgniter\HTTP\Request;
use Firebase\JWT\JWT;

class Auth extends BaseController
{
    public function __construct() {
        helper('secure_password_helper');
        helper('jwt_helper');
    }

    use ResponseTrait;

    public function credentialsValidate()
    {
        try {
            /* helper("cookie"); */
            $usuario = $this->request->getJSON();
            /* $claveEncriptada = hashPassword($usuario->passwordUsuario);
            $usuario->passwordUsuario = $claveEncriptada; */
            
            /* $username = $this->request->getVar(); */

            $usuarioModel = new UsuarioModel();

            /* $validateUsuario = $usuarioModel->where('correoUsuario', $usuario->correo)->first(); */
            $validateUsuario = $usuarioModel->obtenerUsuarioSesion($usuario->correo);
            $usuariovalidado = [];
            foreach ($validateUsuario as $key => $value) {
                $usuariovalidado = $value;
            }

            /* return $this->respond($usuariovalidado, 200); */

            if($usuariovalidado == null || $usuariovalidado->idEstadousuario == 0):
                return $this->failNotFound("Usuario no existe o esta inhabilitado", 404, "Usuario no existe o esta inhabilitado");
            else:
                if(verifyPassword($usuario->clave, $usuariovalidado->passwordUsuario)):
                    
                    $jwt = getSignedJWTForUser($usuariovalidado);
                    
                    return $this->respond([
                        'Token' => $jwt,
                        'user' => $usuariovalidado
                    ], 200, "Ingreso exitosamente");

                else:
                    return $this->failServerError("Clave Incorrecta", 500, "Clave Incorrecta");
                endif;
            endif;

        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor', 500, 'Ha ocurrido un error en el servidor');
        }
    }

    public function validarUsuarioToken()
    {
        $authHeader = $this->request->getServer('HTTP_AUTHORIZATION');

        try {
            $token = getJWTFromRequest($authHeader);

            $decodeToken = dataJWTFromRequest($token);

            return $this->respond($decodeToken, 200);   
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error al validar el token del usuario', 500, 'Ha ocurrido un error al validar el token del usuario');
        }
    }
}
