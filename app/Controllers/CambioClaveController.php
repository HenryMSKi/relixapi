<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\API\ResponseTrait;

class CambioClaveController extends BaseController
{
    use ResponseTrait;

    public function enviarcodigoClave()
    {
        try {

            $email = $this->request->getJSON();

            $usuarioModel = new UsuarioModel();

            $usuario = $usuarioModel->where('correoUsuario', $email->correoUsuario)->first();

            if(empty($usuario)):
                return $this->failServerError('El usuario ingresado no existe');
            else:
                $num = mt_rand(1000, 9999);

                $usuarioModel->where('idUsuario', $usuario['idUsuario'])
                            ->set('codigocambioClave', $num)
                            ->update();

                $to = $email->correoUsuario;
                $subject = 'Codigo para cambio de clave';
                $message = 'Hola '. $usuario['nombreUsuario'] .',
                <br>
                <br>
                Su codigo para cambiar la clave es:
                <br>
                <br>'. $num .'
                <br>
                <br>
                Gracias
                <br>
                <br>
                Relix Syl';

                $email = \Config\Services::email();

                /* $email->setFrom('informaciones@relixapi.mskdevmusic.com', 'Sistema Gestor de Proyectos'); */
                $email->setTo($to);

                $email->setSubject($subject);
                $email->setMessage($message);

                if ($email->send()) {
                    return $this->respond("Correo enviado exitosamente");
                } else {
                    return $this->failServerError('No pudo enviarse el correo');
                }
            endif;    
        } catch (\Exception $th) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }

    public function actualizarClave()
    {
        helper('secure_password_helper');
        
        $datosFront = $this->request->getJSON();

        $usuarioModel = new UsuarioModel();

        $usuario = $usuarioModel->where('correoUsuario', $datosFront->correoUsuario)->first();

        if (empty($usuario)) :
            return $this->failServerError('El usuario ingresado no existe');
        else :
            if($datosFront->codigo == $usuario['codigocambioClave']):
                $num = mt_rand(1000, 9999);

                $usuarioModel->where('idUsuario', $usuario['idUsuario'])
                ->set('passwordUsuario', hashPassword($datosFront->passwordUsuario))
                ->set('codigocambioClave', $num)
                ->update();

                return $this->respond("Clave actualizada exitosamente");
            else:
                return $this->failServerError('El codigo es incorrecto');
            endif;
        endif; 
    }

    public function actualizarClaveDefault()
    {
        helper('secure_password_helper');

        $datosFront = $this->request->getJSON();

        $usuarioModel = new UsuarioModel();

        $usuario = $usuarioModel->where('correoUsuario', $datosFront->correoUsuario)->first();


        if ($usuario == null) :
            return $this->failServerError("Usuario no existe", 500, "Usuario no existe");
        else :
            if (verifyPassword($datosFront->codigo, $usuario['passwordUsuario'])) :
                $num = mt_rand(1000, 9999);

                $usuarioModel->where('idUsuario', $usuario['idUsuario'])
                ->set('passwordUsuario', hashPassword($datosFront->passwordUsuario))
                    ->set('codigocambioClave', $num)
                    ->update();

                return $this->respond("Clave actualizada exitosamente");
            else :
                return $this->failServerError('El codigo es incorrecto');
            endif;
        endif;
    }

    public function recuperarClave()
    {
        helper('secure_password_helper');

        $datosFront = $this->request->getJSON();

        $usuarioModel = new UsuarioModel();

        $usuario = $usuarioModel->where('correoUsuario', $datosFront->correoUsuario)->first();


        if ($usuario == null) :
            return $this->failServerError("Usuario no existe", 500, "Usuario no existe");
        else :
            $claveDesencriptada = generateRandomString();
            $claveEncriptada = hashPassword($claveDesencriptada);

            $usuarioModel->where('idUsuario', $usuario['idUsuario'])
                ->set('passwordUsuario', $claveEncriptada)
                ->update();

            $this->sendEmail($datosFront, $claveDesencriptada);

            return $this->respond('Clave nueva enviada a su correo', 200);
        endif;
    }

    public function sendEmail($user, $clave)
    {
        $to = $user->correoUsuario;
        $subject = 'Información de Registro';
        $message = ',
                <br>
                Contraseña generada por Sistema Gestor de Proyectos Relix(SGPR).
                <br>
                Estas son tus nuevas credenciales de ingreso:
                <br>
                <br>
                Correo:
                <br>
                ' . $user->correoUsuario . '
                <br>
                Clave:
                <br>
                ' . $clave . '
                <br>
                <br>
                Por favor te pedimos gestionar el cambio de tu clave, seleccionando la opción de Cambiar Contraseña
                <br>
                <br>
                Gracias
                <br>
                <br>
                Relix Syl';
        /* $filepath = 'https://www.dogalize.com/wp-content/uploads/2017/06/La-sverminazione-e-la-pulizia-del-cucciolo-del-cane-2-800x400-800x400.jpg'; */

        $email = \Config\Services::email();

        /* $email->setFrom('informaciones@relixapi.mskdevmusic.com', 'Sistema Gestor de Proyectos'); */
        $email->setTo($to);
        /* $email->setCC('henrym.nagata@gmail.com'); */
        /* $email->setBCC('them@their-example.com'); */

        $email->setSubject($subject);
        $email->setMessage($message);
        /* $email->attach($filepath); */

        if ($email->send()) {
            echo 'Correo enviado exitosamente al usuario ';
        } else {
            echo 'No se pudo enviar el mensaje al usuario ';
        }
    }
    
}
