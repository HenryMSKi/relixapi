<?php 
namespace App\Controllers\API;

use App\Models\RolModel;
use App\Models\UsuarioModel;
use CodeIgniter\RESTful\ResourceController;

use function PHPUnit\Framework\returnSelf;

class UsuarioController extends ResourceController{

    public function __construct() {
        $this->model = $this->setModel(new UsuarioModel());
        helper('secure_password_helper');

    }

    public function listarUsuario($id = null){

        $usuarios = $this->model->obtenerUsuarios();
        /* return $this->respond($usuarios, 200); */
       /*  echo json_encode($usuarios); */

        return $this->respond($usuarios, 200);

    }

    public function agregarUsuario()
    {
        helper('secure_password_helper');

        try {
            $usuario = $this->request->getJSON();
            $claveDesencriptada = generateRandomString();
            $claveEncriptada = hashPassword($claveDesencriptada);
            $usuario->passwordUsuario = $claveEncriptada;
            $usuario->idEstadousuario = 1;
            
            $usuarioExiste = $this->model->where('correoUsuario', $usuario->correoUsuario)->first();

            if(empty($usuarioExiste)):
                /* $usuario = $this->request->getVar(); */
                /* $passwordHash = hashPassword($usuario['passwordUsuario']); */

                /* $usuario['passwordUsuario'] = $passwordHash; */

                if ($this->model->insert($usuario)) :
                    /* $usuario->idUsuario = $this->model->insertID(); */
                    $this->sendEmail($usuario, $claveDesencriptada);
                    return $this->respondCreated($usuario->nombreUsuario);
                else :
                    return $this->failValidationErrors($this->model->validation->listErrors());
                endif;
            else:
                return $this->failServerError('El usuario ya esta registrado', 500, 'El usuario ya esta registrado');
            endif;
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor', 500, 'Ha ocurrido un error en el servidor');
        }
    }

    public function cambioEstado($id = null)
    {
        try {
            if ($id == null) :
                return $this->failValidationErrors("No se ha pasado un ID valido");
            else :
                $usuarioDB = $this->model->find($id);
                if ($usuarioDB == null) :
                    return $this->failValidationErrors("No se ha encontrado un cliente con el id: " . $id);
                else :
                    $usuario = $this->request->getJSON();

                    $dataActualizar = [
                        'idEstadousuario' => $usuario->idEstadousuario
                    ];

                    if ($this->model->update($id, $dataActualizar)) :
                        $usuarios = $this->model->findAll();

                        return $this->respond($usuarios, 200);
                    else :
                        return $this->failValidationErrors($this->model->validation->listErrors());
                    endif;
                endif;
            endif;
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }

    public function generarClave($id = null)
    {
        try {
            if ($id == null) :
                return $this->failValidationErrors("No se ha pasado un ID valido");
            else :
                $usuarioDB = $this->model->find($id);
                if ($usuarioDB == null) :
                    return $this->failValidationErrors("No se ha encontrado un cliente con el id: " . $id);
                else :
                    $claveDesencriptada = generateRandomString();
                    $claveEncriptada = hashPassword($claveDesencriptada);

                    $data = [
                        'passwordUsuario' => $claveEncriptada
                    ];

                    if ($this->model->update($id, $data)) :
                        $usuarioActualizado = $this->model->find($id);
                        $this->enviarClavegenerada($usuarioActualizado, $claveDesencriptada);
                        return $this->respond('Actualizado exitosamente', 200);
                    else :
                        return $this->failValidationErrors($this->model->validation->listErrors());
                    endif;
                endif;
            endif;
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }

    public function updateUser($id = null)
    {
        try {
            if($id == null):
                return $this->failValidationErrors("No se ha pasado un ID valido");
            else:
                $usuarioDB = $this->model->find($id);
                if($usuarioDB == null):
                    return $this->failValidationErrors("No se ha encontrado un cliente con el id: " . $id);
                else:
                    $usuario = $this->request->getVar();
                    if ($this->model->update($id, $usuario)) :
                        /* $usuario->idUsuario = $this->model->insertID(); */
                        /* $this->sendEmail($usuario); */
                        return $this->respondUpdated($usuario['nombreUsuario'], 'Actualizado exitosamente');
                    else :
                        return $this->failValidationErrors($this->model->validation->listErrors());
                    endif;

                endif;
            endif;    
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }

    public function deleteUser($id = null)
    {
        try {
            if ($id == null) :
                return $this->failValidationErrors("No se ha pasado un ID valido");
            else :
                $usuarioDB = $this->model->find($id);
                if ($usuarioDB == null) :
                    return $this->failValidationErrors("No se ha encontrado un cliente con el id: " . $id);
                else :
                    if ($this->model->delete($id)) :
                        /* $usuario->idUsuario = $this->model->insertID(); */
                        /* $this->sendEmail($usuario); */
                        return $this->respondDeleted($usuarioDB['nombreUsuario'], 'Eliminado exitosamente');
                    else :
                        return $this->failValidationErrors("No se ha podido eliminar al cliente " . $usuarioDB['nombreUsuario']. " con el id: " . $id);
                    endif;
                endif;
            endif;
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }

    public function sendEmail($user, $clave)
    {
        $to = $user->correoUsuario;
        $subject = 'Información de Registro';
        /* $message = 'Hola ' . $user->nombreUsuario . ',
                <br>
                Fuiste registrado en el Sistema Gestor de Proyectos Relix(SGPR).
                <br>
                Estas son tus credenciales de ingreso:
                <br>
                <br>
                Correo:
                <br>
                '. $user->correoUsuario .'
                <br>
                Clave:
                <br>
                '. $clave . '
                <br>
                <br>
                Por favor te pedimos gestionar el cambio de tu clave, seleccionando la opción de ¿Olvidaste tu clave?
                <br>
                <br>
                Gracias
                <br>
                <br>
                Relix Syl'; */
        /* $filepath = 'https://www.dogalize.com/wp-content/uploads/2017/06/La-sverminazione-e-la-pulizia-del-cucciolo-del-cane-2-800x400-800x400.jpg'; */

        $message = '<!DOCTYPE html>
                    <html>
                    <head>
                    <title></title>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                    <style type="text/css">
                        /* FONTS */
                        @media screen {
                            @font-face {
                            font-family: "Lato";
                            font-style: normal;
                            font-weight: 400;
                            src: local("Lato Regular"), local("Lato-Regular"), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format("woff");
                            }
                            
                            @font-face {
                            font-family: "Lato";
                            font-style: normal;
                            font-weight: 700;
                            src: local("Lato Bold"), local("Lato-Bold"), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format("woff");
                            }
                            
                            @font-face {
                            font-family: "Lato";
                            font-style: italic;
                            font-weight: 400;
                            src: local("Lato Italic"), local("Lato-Italic"), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format("woff");
                            }
                            
                            @font-face {
                            font-family: "Lato";
                            font-style: italic;
                            font-weight: 700;
                            src: local("Lato Bold Italic"), local("Lato-BoldItalic"), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format("woff");
                            }
                        }
                        
                        /* CLIENT-SPECIFIC STYLES */
                        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
                        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
                        img { -ms-interpolation-mode: bicubic; }

                        /* RESET STYLES */
                        img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
                        table { border-collapse: collapse !important; }
                        body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }

                        /* iOS BLUE LINKS */
                        a[x-apple-data-detectors] {
                            color: inherit !important;
                            text-decoration: none !important;
                            font-size: inherit !important;
                            font-family: inherit !important;
                            font-weight: inherit !important;
                            line-height: inherit !important;
                        }
                        
                        /* MOBILE STYLES */
                        @media screen and (max-width:600px){
                            h1 {
                                font-size: 32px !important;
                                line-height: 32px !important;
                            }
                        }

                        /* ANDROID CENTER FIX */
                        div[style*="margin: 16px 0;"] { margin: 0 !important; }
                    </style>
                    </head>
                    <body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">

                    <!-- HIDDEN PREHEADER TEXT -->
                    <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: "Lato", Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
                        
                    </div>

                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <!-- LOGO -->
                        <tr>
                            <td bgcolor="#FFA73B" align="center">
                                <!--[if (gte mso 9)|(IE)]>
                                <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
                                <tr>
                                <td align="center" valign="top" width="600">
                                <![endif]-->
                                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;" >
                                    <tr>
                                        <td align="center" valign="top" style="padding: 40px 10px 40px 10px;">
                                        
                                        </td>
                                    </tr>
                                </table>
                                <!--[if (gte mso 9)|(IE)]>
                                </td>
                                </tr>
                                </table>
                                <![endif]-->
                            </td>
                        </tr>
                        <!-- HERO -->
                        <tr>
                            <td bgcolor="#FFA73B" align="center" style="padding: 0px 10px 0px 10px;">
                                <!--[if (gte mso 9)|(IE)]>
                                <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
                                <tr>
                                <td align="center" valign="top" width="600">
                                <![endif]-->
                                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;" >
                                    <tr>
                                        <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
                                        <h1 style="font-size: 48px; font-weight: 400; margin: 0;">¡Bienvenido(a) ' . $user->nombreUsuario . '!</h1>
                                        </td>
                                    </tr>
                                </table>
                                <!--[if (gte mso 9)|(IE)]>
                                </td>
                                </tr>
                                </table>
                                <![endif]-->
                            </td>
                        </tr>
                        <!-- COPY BLOCK -->
                        <tr>
                            <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                                <!--[if (gte mso 9)|(IE)]>
                                <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
                                <tr>
                                <td align="center" valign="top" width="600">
                                <![endif]-->
                                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;" >
                                <!-- COPY -->
                                <tr>
                                    <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" >
                                    <p style="margin: 0;">Fuiste registrado en el Sistema Gestor de Proyectos Relix (SGPR).</p>
                                    <br>
                                        Estas son tus credenciales de ingreso:
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
                                    </td>
                                </tr>
                                <!-- BULLETPROOF BUTTON -->
                                <tr>
                                    <td bgcolor="#ffffff" align="left">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                        <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
                                            <table border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td align="center" style="border-radius: 3px;" bgcolor="#000000"><a href="http://sistemaproyectos.relix.pe/cambiar-password" target="_blank" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #000000; display: inline-block;">Cambiar Clave</a></td>
                                            </tr>
                                            </table>
                                        </td>
                                        </tr>
                                    </table>
                                    </td>
                                </tr>
                                <!-- COPY -->
                                <tr>
                                    <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" >
                                    <p style="margin: 0;">Por favor te pedimos gestionar el cambio de tu clave, seleccionando la opción de ¿Cambiar clave?, o copiando el siguiente enlace en tu navegador:</p>
                                    </td>
                                </tr>
                                <!-- COPY -->
                                    <tr>
                                    <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 20px 30px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" >
                                        <p style="margin: 0;"><a href="http://sistemaproyectos.relix.pe/cambiar-password" target="_blank" style="color: #FFA73B;">http://sistemaproyectos.relix.pe/cambiar-password</a></p>
                                    </td>
                                    </tr>
                                <!-- COPY -->
                                <tr>
                                    <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" >
                                    <p style="margin: 0;">Si tienes alguna consulta comunicarte con los administradores del sistema</p>
                                    </td>
                                </tr>
                                <!-- COPY -->
                                <tr>
                                    <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" >
                                    <p style="margin: 0;">Saludos Cordiales,<br>Relix Syl Team</p>
                                    </td>
                                </tr>
                                    <tr>
                                        <td bgcolor="#ffffff" align="left" valign="top" style="padding: 0px 30px 20px 30px;">
                                            <a href="http://relix.pe" target="_blank">
                                                <img alt="Logo" src="https://relixwater.com/wp-content/uploads/2020/06/Logo-Relix-150px-slogan.png" style="display: block; width: 150px; max-width: 150px; min-width: 150px; font-family: "Lato", Helvetica, Arial, sans-serif; color: #ffffff; font-size: 18px;" border="0">
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                                <!--[if (gte mso 9)|(IE)]>
                                </td>
                                </tr>
                                </table>
                                <![endif]-->
                            </td>
                        </tr>
                        <!-- SUPPORT CALLOUT -->
                        <tr>
                            <td bgcolor="#f4f4f4" align="center" style="padding: 30px 10px 30px 10px;">
                                <!--[if (gte mso 9)|(IE)]>
                                <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
                                <tr>
                                <td align="center" valign="top" width="600">
                                <![endif]-->
                                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;" >
                                    <!-- HEADLINE -->
                                    <tr>
                                    <td bgcolor="#FFF0D1" align="center" style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" >
                                        <h2 style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;"></h2>
                                        <p style="margin: 0;"><a href="http://litmus.com" target="_blank" style="color: #9B4503;"></a></p>
                                    </td>
                                    </tr>
                                </table>
                                <!--[if (gte mso 9)|(IE)]>
                                </td>
                                </tr>
                                </table>
                                <![endif]-->
                            </td>
                        </tr>
                    </table>
                        
                    </body>
                    </html>
                    ';


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

    public function enviarClavegenerada($user, $clave)
    {
        $to = $user['correoUsuario'];
        $subject = 'Información de generación de nueva clave';
        $message = 'Hola ' . $user['nombreUsuario'] . ',
                <br>
                Se le ha generado una nueva contraseña en el Sistema Gestor de Proyectos Relix(SGPR).
                <br>
                Estas son tus credenciales de ingreso:
                <br>
                <br>
                Correo:
                <br>
                ' . $user['correoUsuario'] . '
                <br>
                Clave:
                <br>
                ' . $clave . '
                <br>
                <br>
                Por favor te pedimos gestionar el cambio de tu clave, seleccionando la opción de ¿Olvidaste tu clave?
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

    public function obtenerUsuariosporRol($id = null)
    {
        try {
            $rolModel = new RolModel();

            if ($id == null) :
                return $this->failValidationErrors("No se ha pasado un ID valido");
            else :
                $rolDB = $rolModel->find($id);
                if ($rolDB == null) :
                    return $this->failValidationErrors("No se ha encontrado un rol con el id: " . $id);
                else :
                    $usuarios = $this->model->obtenerUsuariosporRol($id);
                    return $this->respond($usuarios);
                endif;
            endif;    
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }

    
}