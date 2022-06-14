<?php   namespace App\Models\ReglasPersonalizadas;

use App\Models\RolModel;

class MisReglas{

    public function existeRol(int $id): bool
    {
        $model = new RolModel();
        $usuario = $model->find($id);

        return $usuario == null ? false : true;
    }

    /* public function valid_email_empresarial(string $correo): bool
    {
        
    } */
}