<?php

namespace App\Controllers;

use App\Models\PrecioproductoModel;
use App\Models\ProductoModel;
use CodeIgniter\RESTful\ResourceController;

class ProductoController extends ResourceController
{

    public function __construct()
    {
        $this->model = $this->setModel(new ProductoModel());
    }

    public function listarProducto($id  = null)
    {
        $productos = $this->model->findAll();

        if (empty($productos)) :
            return $this->respond("No existen productos registrados", 200, "No existen productos registrados");
        else :
            return $this->respond($productos);
        endif;
    }

    public function busquedamasivaProductos($id  = null)
    {
        $productobuscar = $this->request->getJSON();
        $var = [];

        foreach ($productobuscar as $key => $value) {
            $var = $value->pruebaHash;
        }

        return $this->respond($var);
    }

    public function mantenimientoProductos($id = null)
    {
        $listaExcelProductos = $this->request->getJSON();

        $precioProducto = new PrecioproductoModel();

        $productosUnidad = [];
        $messages = [];

        foreach ($listaExcelProductos as $key => $value) {

            $productosUnidad = $value;

            $productosBD = $this->model->where('codigosoftcomProducto', $value->Codigo)->first();

            if (empty($productosBD)) {
                $productoRegistrar = [
                    'codigosoftcomProducto' => rtrim($productosUnidad->Codigo),
                    'descripcionProducto' => rtrim($productosUnidad->Descripción),
                    'codigoreferenciaProducto' => isset($productosUnidad->Código_Referencia) ? rtrim($productosUnidad->Código_Referencia) : '',
                    'undProducto' => isset($productosUnidad->UND) ? rtrim($productosUnidad->UND) : '',
                    'marcaProducto' => isset($productosUnidad->Marca) ? rtrim($productosUnidad->Marca) : '',
                    'costodisenoProducto' => isset($productosUnidad->COSTO_DE_DISEÑO) ? $productosUnidad->COSTO_DE_DISEÑO : 0,
                    'familiaProducto' => isset($productosUnidad->Familia) ? rtrim($productosUnidad->Familia) : '',
                ];

                $this->model->insertarProductos($productoRegistrar);


                $precioRegistrar = [
                    'precioventaunoProducto' => isset($productosUnidad->Precio_Venta_01) ? $productosUnidad->Precio_Venta_01 : 0,
                    'precioventadosProducto' => isset($productosUnidad->Precio_Venta_02) ? $productosUnidad->Precio_Venta_02 : 0,
                    'precioventatresProducto' => isset($productosUnidad->Precio_Venta_03) ? $productosUnidad->Precio_Venta_03 : 0,
                    'precioventacuatroProducto' => isset($productosUnidad->Precio_Venta_04) ? $productosUnidad->Precio_Venta_04 : 0,
                    'codigosoftcomProducto' => rtrim($productosUnidad->Codigo)
                ];

                $precioProducto->insertarPrecios($precioRegistrar);

                array_push($messages, 'Registro exitoso producto ' . $key);
            } else {

                $productoActualizar = [
                    'descripcionProducto' => rtrim($productosUnidad->Descripción),
                    'codigoreferenciaProducto' => isset($productosUnidad->Código_Referencia) ? rtrim($productosUnidad->Código_Referencia) : '',
                    'undProducto' => isset($productosUnidad->UND) ? rtrim($productosUnidad->UND) : '',
                    'marcaProducto' => isset($productosUnidad->Marca) ? rtrim($productosUnidad->Marca) : '',
                    'costodisenoProducto' => isset($productosUnidad->COSTO_DE_DISEÑO) ? $productosUnidad->COSTO_DE_DISEÑO : 0,
                    'familiaProducto' => isset($productosUnidad->Familia) ? rtrim($productosUnidad->Familia) : '',
                ];

                $this->model->update(rtrim($productosUnidad->Codigo), $productoActualizar);


                $precioActualizar = [
                    'precioventaunoProducto' => isset($productosUnidad->Precio_Venta_01) ? $productosUnidad->Precio_Venta_01 : 0,
                    'precioventadosProducto' => isset($productosUnidad->Precio_Venta_02) ? $productosUnidad->Precio_Venta_02 : 0,
                    'precioventatresProducto' => isset($productosUnidad->Precio_Venta_03) ? $productosUnidad->Precio_Venta_03 : 0,
                    'precioventacuatroProducto' => isset($productosUnidad->Precio_Venta_04) ? $productosUnidad->Precio_Venta_04 : 0
                ];

                /* $precioProducto->actualizarPrecios($precioActualizar); */
                $precioProducto->where('codigosoftcomProducto', rtrim($productosUnidad->Codigo))
                    ->set($precioActualizar)
                    ->update();

                array_push($messages, 'Actualizar producto' . $key);
            }
        }

        return $this->respond($messages, 200);
    }

    public function registrarProducto()
    {
        $productoPOST = $this->request->getJSON();

        if (isset($productoPOST)) {
            $precioProducto = new PrecioproductoModel();

            $productosBD = $this->model->where('codigosoftcomProducto', $productoPOST->codigosoftcomProducto)->first();

            if (empty($productosBD)) {

                $productoRegistrar = [
                    'codigosoftcomProducto' => rtrim($productoPOST->codigosoftcomProducto),
                    'descripcionProducto' => rtrim($productoPOST->descripcionProducto),
                    'codigoreferenciaProducto' => isset($productoPOST->codigoreferenciaProducto) ? rtrim($productoPOST->codigoreferenciaProducto) : '',
                    'undProducto' => isset($productoPOST->undProducto) ? rtrim($productoPOST->undProducto) : '',
                    'marcaProducto' => isset($productoPOST->marcaProducto) ? rtrim($productoPOST->marcaProducto) : '',
                    'costodisenoProducto' => isset($productoPOST->costodisenoProducto) ? $productoPOST->costodisenoProducto : 0,
                    'familiaProducto' => isset($productoPOST->familiaProducto) ? rtrim($productoPOST->familiaProducto) : '',
                ];

                $this->model->insertarProductos($productoRegistrar);


                $precioRegistrar = [
                    'precioventaunoProducto' => isset($productoPOST->precioventaunoProducto) ? $productoPOST->precioventaunoProducto : 0,
                    'precioventadosProducto' => isset($productoPOST->precioventadosProducto) ? $productoPOST->precioventadosProducto : 0,
                    'precioventatresProducto' => isset($productoPOST->precioventatresProducto) ? $productoPOST->precioventatresProducto : 0,
                    'precioventacuatroProducto' => isset($productoPOST->precioventacuatroProducto) ? $productoPOST->precioventacuatroProducto : 0,
                    'codigosoftcomProducto' => rtrim($productoPOST->codigosoftcomProducto)
                ];

                $precioProducto->insertarPrecios($precioRegistrar);

                return $this->respond('Producto registrado exitosamente', 200);
            } else {
                return $this->failValidationErrors('Existe un producto registrado con dicho codigo');
            }
        } else {
            return $this->failValidationErrors('No se ha enviado dato para registrar');
        }
    }

    public function buscarProducto($id = null)
    {

        try {
            $precios = new PrecioproductoModel();

            if(isset($id)):
                $productoBD = $this->model->where('codigosoftcomProducto', $id)->first();

                if(isset($productoBD)):
                    $preciosBD = $precios->where('codigosoftcomProducto', $id)->first();

                    if(isset($preciosBD)):
                        unset($preciosBD['idPrecioproducto']);
                        unset($preciosBD['codigosoftcomProducto']);

                        $productoBD['precios'] = $preciosBD;

                        return $this->respond($productoBD);
                    else:
                        return $this->failvalidationErrors('No existe precios en ese producto', 400);
                    endif;
                else:
                    return $this->failvalidationErrors('No existe producto con ese codigo', 400);
                endif;
                
            else:
                return $this->failvalidationErrors('No se envio ningun ID', 400);
            endif;
            
        } catch (\Throwable $th) {
            return $this->failServerError("Ingreso al catch", 500);
        } 
    }
}
