<?php

namespace App\Controllers;

use App\Models\DetallefichatecnicaModel;
use App\Models\FichatecnicaModel;
use App\Models\PartidaModel;
use App\Models\PrecioproductoModel;
use App\Models\ProductoModel;
use App\Models\UsuarioModel;
use CodeIgniter\RESTful\ResourceController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\IOFactory;

use function PHPUnit\Framework\isEmpty;

class DetallefichatecnicaController extends ResourceController
{
    public function __construct()
    {
        $this->model = $this->setModel(new DetallefichatecnicaModel());
    }

    public function listarDetalleFichaGerenteGeneral($id = null) //Tabla BackOffice, Gerente General y Administrador de negocio
    {
        $detalleFichaBD = $this->model->obtenerDetallefichatecnica($id);

        return $this->respond($detalleFichaBD);
    }

    public function exportarExcelReporteDos($id = null)
    {
        $variables = explode('&', $id);

        $ficha = new FichatecnicaModel();
        $fichaProcesada =  $ficha->obtenerFicha($id);

        $detalleFichaBD = $this->model->obtenerDetallefichatecnica($variables[0]);

        foreach ($fichaProcesada as $key => $value) {
            $fichaDB = $value;
        }

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()
            ->setCreator("Sistema Gestor de Proyectos Relix - SGPR")
            ->setLastModifiedBy('SGPR') // última vez modificado por
            ->setTitle('COTIZACIÓN N° ' . $fichaDB->numFichatecnica)
            ->setSubject('Cotizaciones Relix Syl')
            ->setDescription('Este documento presenta la COTIZACIÓN N° ' . $fichaDB->numFichatecnica);
        /* ->setKeywords('etiquetas o palabras clave separadas por espacios')
        ->setCategory('La categoría'); */
        $drawing = new Drawing();

        $sheet = $spreadsheet->getActiveSheet();

        $highestColumn = $sheet->getHighestColumn();

        $sheet->setCellValue('B13', 'ITEM')
            ->getStyle('B13')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('B13:' . $highestColumn . 'B13')->getFont()->setBold(true);
        $sheet->getStyle('B13')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        $sheet->setCellValue('C13', 'PARTIDA')
            ->getStyle('C13')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('C13:' . $highestColumn . 'C13')->getFont()->setBold(true);
        $sheet->getStyle('C13')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        $sheet->setCellValue('D13', 'SUB-PARTIDA')
            ->getStyle('D13')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('D13:' . $highestColumn . 'D13')->getFont()->setBold(true);
        $sheet->getStyle('D13')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        $sheet->setCellValue('E13', 'MARCA')
            ->getStyle('E13')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('E13:' . $highestColumn . 'E13')->getFont()->setBold(true);
        $sheet->getStyle('E13')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        $sheet->setCellValue('F13', 'CODIGO ERP')
            ->getStyle('F13')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('F13:' . $highestColumn . 'F13')->getFont()->setBold(true);
        $sheet->getStyle('F13')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        $sheet->mergeCells('G13:H13');
        $sheet->setCellValue('G13', 'CODIGO PROVEEDOR')
            ->getStyle('G13')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('G13:' . $highestColumn . 'G13')->getFont()->setBold(true);
        $sheet->getStyle('G13')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle('H13')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        $sheet->setCellValue('I13', 'DESCRIPCIÓN')
            ->getStyle('I13')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('I13:' . $highestColumn . 'I13')->getFont()->setBold(true);
        $sheet->getStyle('I13')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        $sheet->mergeCells('J13:K13');
        $sheet->setCellValue('J13', 'UND')
            ->getStyle('J13')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('J13:' . $highestColumn . 'J13')->getFont()->setBold(true);
        $sheet->getStyle('J13')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle('K13')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        $sheet->mergeCells('L13:M13');
        $sheet->setCellValue('L13', 'CANTIDAD')
            ->getStyle('L13')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('L13:' . $highestColumn . 'L13')->getFont()->setBold(true);
        $sheet->getStyle('L13')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle('M13')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        $sheet->mergeCells('N13:O13');
        $sheet->setCellValue('N13', 'P. UNIT')
            ->getStyle('N13')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('N13:' . $highestColumn . 'N13')->getFont()->setBold(true);
        $sheet->getStyle('N13')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle('O13')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        $sheet->setCellValue('P13', 'SUB TOTAL ')
            ->getStyle('P13')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('P13:' . $highestColumn . 'P13')->getFont()->setBold(true);
        $sheet->getStyle('P13')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        $item = 1;
        $rowCount = 14;

        foreach ($detalleFichaBD as $key => $value) {
            $sheet->setCellValue('B' . $rowCount, $item);
            $sheet->getStyle('B' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->setCellValue('C' . $rowCount, $value->partidaDetallefichatecnica);
            $sheet->getStyle('C' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->setCellValue('D' . $rowCount, $value->subpartidaDetallefichatecnica);
            $sheet->getStyle('D' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->setCellValue('E' . $rowCount, $value->marcaDetallefichatecnica);
            $sheet->getStyle('E' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->setCellValue('F' . $rowCount, $value->codigosoftcomProducto);
            $sheet->getStyle('F' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->mergeCells('G' . $rowCount . ':H' . $rowCount);
            $sheet->setCellValue('G' . $rowCount, $value->codigoproveedorDetallefichatecnica);
            $sheet->getStyle('G' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->getStyle('H' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->setCellValue('I' . $rowCount, $value->descripcionDetallefichatecnica);
            $sheet->getStyle('I' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->mergeCells('J' . $rowCount . ':K' . $rowCount);
            $sheet->setCellValue('J' . $rowCount, $value->undProducto);
            $sheet->getStyle('J' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->getStyle('K' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->mergeCells('L' . $rowCount . ':M' . $rowCount);
            $sheet->setCellValue('L' . $rowCount, $value->cantidadDetallefichatecnica);
            $sheet->getStyle('L' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->getStyle('M' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->mergeCells('N' . $rowCount . ':O' . $rowCount);
            $sheet->setCellValue('N' . $rowCount, $value->preciounitarioDetallefichatecnica);
            $sheet->getStyle('N' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->getStyle('O' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            $sheet->setCellValue('P' . $rowCount, $value->preciodescuentoDetallefichatecnica);
            $sheet->getStyle('P' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            $item++;
            $rowCount++;
        }

        //partida: false, subPartida: false, precioUnitario: false, subTotal: false,

        if ($variables[4] == "false") {
            $sheet->removeColumn('P');
        }

        if ($variables[3] == "false") {
            $sheet->removeColumn('O');
            $sheet->removeColumn('N');
        }

        if ($variables[2] == "false") {
            $sheet->removeColumn('D');
        }

        if ($variables[1] == "false") {
            $sheet->removeColumn('C');
        }

        /* $sheet->removeColumn('P', 1);
        $sheet->removeColumn('O', 1);
        $sheet->removeColumn('N', 1);
        $sheet->removeColumn('D', 1);
        $sheet->removeColumn('C', 1); */

        $sheet->getColumnDimension('A')->setWidth(14, 'px');
        $sheet->getColumnDimension('G')->setWidth(14, 'px');
        $sheet->getColumnDimension('K')->setWidth(6, 'px');
        $sheet->getColumnDimension('L')->setWidth(23, 'px');
        $sheet->getColumnDimension('N')->setWidth(12, 'px');

        $sheet->mergeCells('M1:P1');

        $sheet->setCellValue('M1', 'COTIZACIÓN N° ' . $fichaDB->numFichatecnica)
            ->getStyle('M1')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('M1:' . $highestColumn . 'M1')->getFont()->setBold(true)->setSize(14);

        $sheet->setCellValue('B2', 'RELIX PERU SAC   ');
        $sheet->getStyle('B2:' . $highestColumn . 'B2')->getFont()->setBold(true);

        $sheet->setCellValue('B3', 'AVENIDA FELIPE PARDO Y ALIAGA N° 699 – OFICINA 202, SAN ISIDRO ');
        $sheet->getStyle('B3:' . $highestColumn . 'B3')->getFont()->setBold(true);

        $sheet->setCellValue('B4', 'RUC N° 20555962984 Tel (+51 1) 243 2429    ');
        $sheet->getStyle('B4:' . $highestColumn . 'B4')->getFont()->setBold(true);


        $sheet->setCellValue('F4', 'www.relixwater.com ');
        $spreadsheet->getActiveSheet()->getCell('F4')->getHyperlink()->setUrl("https://www.relixwater.com");
        $spreadsheet->getActiveSheet()->getStyle('F4')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);
        $sheet->getStyle('B4:' . $highestColumn . 'F4')->getFont()->setBold(true);

        $sheet->setCellValue('B6', 'FECHA');
        $sheet->setCellValue('B7', 'RAZON SOCIAL');
        $sheet->setCellValue('B8', 'RUC');
        $sheet->setCellValue('B9', 'DIRECCION FISCAL');
        $sheet->setCellValue('B10', 'ATENCION');
        $sheet->setCellValue('B11', 'VENDEDOR');
        $sheet->setCellValue('D6', ':');
        $sheet->setCellValue('D7', ':');
        $sheet->setCellValue('D8', ':');
        $sheet->setCellValue('D9', ':');
        $sheet->setCellValue('D10', ':');
        $sheet->setCellValue('D11', ':');
        $sheet->setCellValue('E6', $fichaDB->fechaFichatecnica);
        $sheet->setCellValue('E7', $fichaDB->clienteFichatecnica);
        $sheet->setCellValue('E8', $fichaDB->rucclienteFichatecnica)
            ->getStyle('E8')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_LEFT);

        $sheet->setCellValue('E9', $fichaDB->direccionfiscalFichatecnica);
        $sheet->setCellValue('E10', '');
        $sheet->setCellValue('E11', $fichaDB->nombreVendedor);
        $sheet->setCellValue('J7', 'TELÉFONO');
        $sheet->setCellValue('J8', 'REFERENCIA');
        $sheet->setCellValue('J9', 'VALIDEZ DE OFERTA');
        $sheet->setCellValue('L7', ':');
        $sheet->setCellValue('L8', ':');
        $sheet->setCellValue('L9', ':');
        $sheet->setCellValue('M7', $fichaDB->telefonoFichatecnica)
            ->getStyle('M7')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_LEFT);

        $sheet->setCellValue('M8', '');
        $sheet->setCellValue('M9', '');

        $sheet->setCellValue('M' . $rowCount + 2, 'SUB-TOTAL');
        $sheet->getStyle('M' . $rowCount + 2 . ':' . $highestColumn . 'M' . $rowCount + 2)->getFont()->setBold(true);
        $sheet->setCellValue('O' . $rowCount + 2, 'US$');
        $sheet->setCellValue('P' . $rowCount + 2, '=SUM(P14:P' . $rowCount - 1 . ')');
        $sheet->getStyle('P' . $rowCount + 2)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        $sheet->getStyle('P' . $rowCount + 2)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        $sheet->setCellValue('M' . $rowCount + 3, 'IGV 18%');
        $sheet->getStyle('M' . $rowCount + 3 . ':' . $highestColumn . 'M' . $rowCount + 3)->getFont()->setBold(true);
        $sheet->getStyle('N13:' . $highestColumn . 'N13')->getFont()->setBold(true);
        $sheet->setCellValue('O' . $rowCount + 3, 'US$');
        $sheet->setCellValue('P' . $rowCount + 3, '=SUM(P14:P' . $rowCount - 1 . ') * 0.18');
        $sheet->getStyle('P' . $rowCount + 3)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        $sheet->getStyle('P' . $rowCount + 3)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        $sheet->setCellValue('M' . $rowCount + 4, 'TOTAL');
        $sheet->getStyle('M' . $rowCount + 4 . ':' . $highestColumn . 'M' . $rowCount + 4)->getFont()->setBold(true);
        $sheet->setCellValue('O' . $rowCount + 4, 'US$');
        $sheet->setCellValue('P' . $rowCount + 4, '=SUM(P' . $rowCount + 2 . ':P' . $rowCount + 3 . ')');
        $sheet->getStyle('P' . $rowCount + 4)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        $sheet->getStyle('P' . $rowCount + 4)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        $sheet->setCellValue('B' . $rowCount + 5, 'CONDICIONES COMERCIALES:');
        $sheet->getStyle('B' . $rowCount + 5 . ':' . $highestColumn . 'B' . $rowCount + 5)->getFont()->setBold(true);
        $sheet->setCellValue('B' . $rowCount + 7, 'FORMA DE PAGO');
        $sheet->setCellValue('B' . $rowCount + 8, 'TRANSFERENCIA');
        $sheet->setCellValue('D' . $rowCount + 7, ':');
        $sheet->setCellValue('D' . $rowCount + 8, ':');
        $sheet->setCellValue('E' . $rowCount + 7, 'Anticipo : ' . $fichaDB->anticipoFichatecnica . ' % : ' . $fichaDB->porcentajeanticipoFichatecnica . ' Saldo: ' . $fichaDB->formaPago);
        $sheet->setCellValue('E' . $rowCount + 8, 'BCP Dólares CTA 193-2081107-1-91 / CCI 002-193-002081107-1-91-17');
        $sheet->setCellValue('E' . $rowCount + 9, 'SCOTIABANK Dólares CTA 0004886823 / CCI 009-243-000004886823-76 ');
        $sheet->setCellValue('E' . $rowCount + 10, 'BBVA Dólares CTA 0011-0307-0100021675-62 CCI 011-307-000100021675-62');
        $sheet->setCellValue('E' . $rowCount + 11, 'DETRACCIÓN: BANCO DE LA NACIÓN CTA 00-003-120368');
        $sheet->setCellValue('B' . $rowCount + 12, 'FECHA DE ENTREGA');
        $sheet->setCellValue('B' . $rowCount + 13, 'LUGAR DE ENTREGA');
        $sheet->setCellValue('B' . $rowCount + 14, 'NOTAS');
        $sheet->setCellValue('D' . $rowCount + 12, ':');
        $sheet->setCellValue('D' . $rowCount + 13, ':');
        $sheet->setCellValue('D' . $rowCount + 14, ':');
        $sheet->setCellValue('E' . $rowCount + 12, $fichaDB->finproyectadoFichatecnica);
        $sheet->setCellValue('E' . $rowCount + 13, $fichaDB->direccionentregaFichatecnica);
        $sheet->setCellValue('E' . $rowCount + 14, 'EL COBRO DE LOS INTERES MORATORIOS, SE INICIA AUTOMATICAMENTE A PARTIR DEL');
        $sheet->setCellValue('E' . $rowCount + 15, 'VENCIMIENTO EN EL PAGO DE LA FACTURA, APLICANDO LA TASA DE INTERES MAXIMA.');
        $sheet->setCellValue('B' . $rowCount + 16, 'OBSERVACIONES');
        $sheet->setCellValue('D' . $rowCount + 16, ':');
        $sheet->setCellValue('H' . $rowCount + 20, 'GENERADO POR: ' . $fichaDB->nombreVendedor);
        $sheet->setCellValue('M' . $rowCount + 20, 'APROBADO POR: Diego Szeinberg / Gerente General');

        /* $sheet->removeColumn('N');
        $sheet->removeColumn('O'); */

        $drawing->setName('Logo Relix');
        $drawing->setDescription('Logo Relix');
        $drawing->setPath('../images/relixlogo.png');
        $drawing->setCoordinates('B1');
        $drawing->setOffsetX(0);
        $drawing->setRotation(0);
        $drawing->setResizeProportional(true);

        /* $drawing->setHeight(80); */
        /* $drawing->getShadow()->setVisible(true);
        $drawing->getShadow()->setDirection(45); */

        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('N')->setAutoSize(true);
        $sheet->getColumnDimension('P')->setAutoSize(true);

        $drawing->setWorksheet($sheet);
        $sheet->getRowDimension('1')->setRowHeight(50, 'pt');

        /* $writer = new Xlsx($spreadsheet); */

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="COTIZACIÓN N° ' . $fichaDB->numFichatecnica . '.xlsx"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        /* header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1'); */
        /* header('Content-Length:' . filesize('Reporte Dos.xlsx'));
        flush();
        readfile('Reporte Dos.xlsx'); */
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');


        exit;
    }

    public function listarDetallefichatecnica($id = null)
    {
        $precioProducto = new PrecioproductoModel();
        //$producto = new ProductoModel();

        if (empty($id)) :
            return $this->failValidationErrors("No se ha pasado un ID valido");
        else :
            $listaDetalle = $this->model->obtenerDetallefichatecnica($id);
            $detalleEnviar = [];
            $listaEnviar = [];
            $precioRemplazar = 0;

            foreach ($listaDetalle as $key => $value) {
                $detalleEnviar = $value;

                $precioRemplazar = $detalleEnviar->preciounitarioDetallefichatecnica;

                unset($detalleEnviar->preciounitarioDetallefichatecnica);
                $listaPrecio = $precioProducto->where('codigosoftcomProducto', $detalleEnviar->codigosoftcomProducto)->findAll();

                unset($listaPrecio[0]['idPrecioproducto']);
                unset($listaPrecio[0]['codigosoftcomProducto']);

                if ($detalleEnviar->codigosoftcomProducto === '9999999999') {
                    $listaPrecio[0]['optionSelected'] = $precioRemplazar;
                    $listaPrecio[0]['precioventaunoProducto'] = $precioRemplazar;
                    $listaPrecio[0]['precioventadosProducto'] = $precioRemplazar;
                    $listaPrecio[0]['precioventatresProducto'] = $precioRemplazar;
                    $listaPrecio[0]['precioventacuatroProducto'] = $precioRemplazar;
                    $detalleEnviar->costodisenoProducto = $detalleEnviar->costoingDetallefichatecnica;
                } else {
                    $listaPrecio[0]['optionSelected'] = isset($precioRemplazar) ? $precioRemplazar : $listaPrecio[0]['precioventatresProducto'];
                }
                $preciosArray['isManual'] = false;
                $preciosArray['options'] = $listaPrecio[0];
                $detalleEnviar->preciounitarioDetallefichatecnica = $preciosArray;
                array_push($listaEnviar, $detalleEnviar);
            }

            return $this->respond($listaEnviar, 200);
        endif;
    }

    public function agregarDetalleficha()
    {
        try {
            $producto = new ProductoModel();

            $detallefichatecnica = $this->request->getJSON();
            $detalleunitario = [];

            $message = [];
            $detalleregistrado = [];
            $detalleeliminar = [];
            $cont = 1;
            $numItem = 1;

            foreach ($detallefichatecnica as $key => $value) {
                $detalleunitario = $value;
                $cont = $cont + 1;

                if (rtrim($detalleunitario->CODIGO_ERP) === '9999999999') {

                    $dataRegistrar = [
                        'partidaDetallefichatecnica' => isset($detalleunitario->Partida) ? $detalleunitario->Partida : "",
                        'subpartidaDetallefichatecnica' => isset($detalleunitario->SubPartida) ? $detalleunitario->SubPartida : "",
                        'marcaDetallefichatecnica' => isset($detalleunitario->MARCA) ? $detalleunitario->MARCA : "",
                        'codigoproveedorDetallefichatecnica' => isset($detalleunitario->CÓDIGO_DE_PROVEEDOR) ? $detalleunitario->CÓDIGO_DE_PROVEEDOR : "",
                        'codigosoftcomProducto' => isset($detalleunitario->CODIGO_ERP) ? rtrim($detalleunitario->CODIGO_ERP) : "",
                        'descripcionDetallefichatecnica' => isset($detalleunitario->DESCRIPCIÓN) ? rtrim($detalleunitario->DESCRIPCIÓN) : "",
                        'cantidadDetallefichatecnica' => isset($detalleunitario->CANTIDAD_TOTAL) ? $detalleunitario->CANTIDAD_TOTAL : "",
                        'idFichatecnica' => $detalleunitario->idFichatecnica,
                        'aprobaciongerenteDetallefichatecnica' => 0,
                        'aprobacionotroDetallefichatecnica' => 0,
                        'costototalDetallefichatecnica' => $detalleunitario->COSTO_DISEÑO * $detalleunitario->CANTIDAD_TOTAL,
                        'idEstadoproductoDetallefichatecnica' => 2,
                        'itemDetallefichatecnica' => $numItem,
                    ];

                    $this->model->insert($dataRegistrar);
                } else {

                    $productoBD = $producto->where('codigosoftcomProducto', $detalleunitario->CODIGO_ERP)->first();

                    if ($productoBD) {
                        $dataRegistrar = [
                            'partidaDetallefichatecnica' => isset($detalleunitario->Partida) ? $detalleunitario->Partida : "",
                            'subpartidaDetallefichatecnica' => isset($detalleunitario->SubPartida) ? $detalleunitario->SubPartida : "",
                            'marcaDetallefichatecnica' => $productoBD['marcaProducto'],
                            'codigoproveedorDetallefichatecnica' => isset($productoBD['codigoreferenciaProducto']) ? $productoBD['codigoreferenciaProducto'] : "",
                            'codigosoftcomProducto' => isset($detalleunitario->CODIGO_ERP) ? rtrim($detalleunitario->CODIGO_ERP) : "",
                            'descripcionDetallefichatecnica' => isset($productoBD['descripcionProducto']) ? $productoBD['descripcionProducto'] : "",
                            'cantidadDetallefichatecnica' => isset($detalleunitario->CANTIDAD_TOTAL) ? $detalleunitario->CANTIDAD_TOTAL : "",
                            'idFichatecnica' => $detalleunitario->idFichatecnica,
                            'aprobaciongerenteDetallefichatecnica' => 0,
                            'aprobacionotroDetallefichatecnica' => 0,
                            'costototalDetallefichatecnica' => $productoBD['costodisenoProducto'] * $detalleunitario->CANTIDAD_TOTAL,
                            'idEstadoproductoDetallefichatecnica' => 2,
                            'itemDetallefichatecnica' => $numItem,
                        ];

                        $this->model->insert($dataRegistrar);
                    } else {
                        /* $message  .= 'El item de la fila N°'. $cont . ' tuvo errores al registrarse'."\n"; */
                        array_push($message, 'El item de la fila N°' . $cont . ' tuvo errores al registrarse.');

                        array_push($detalleeliminar, $key);
                    }
                }

                $numItem = $numItem + 1;
            };

            $contEliminar = 0;
            foreach ($detalleeliminar as $key => $value) {

                array_splice($detallefichatecnica, $value - $contEliminar, 1);

                $contEliminar = $contEliminar + 1;
            }

            $detallesregistrados = $this->model->obtenerDetalleregistrado($detalleunitario->idFichatecnica);

            foreach ($detallesregistrados as $key => $value) {
                if ($value->codigosoftcomProducto === '9999999999') {
                    $value->precioventaunoProducto = '' . $detallefichatecnica[$key]->PRECIO_UNITARIO . '';
                    $value->precioventadosProducto = '' . $detallefichatecnica[$key]->PRECIO_UNITARIO  . '';
                    $value->precioventatresProducto = '' . $detallefichatecnica[$key]->PRECIO_UNITARIO  . '';
                    $value->precioventacuatroProducto = '' . $detallefichatecnica[$key]->PRECIO_UNITARIO  . '';
                    $value->costodisenoProducto  = '' . $detallefichatecnica[$key]->COSTO_DISEÑO . '';
                    array_push($detalleregistrado, $value);
                } else {
                    array_push($detalleregistrado, $value);
                }
            }

            $listaEnviar['Detalle'] = $detalleregistrado;
            $listaEnviar['Errores'] = $message;

            return $this->respond($listaEnviar, 200);
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor', 500, 'Ha ocurrido un error en el servidor');
        }
    }

    public function actualizarDetallefichatecnica()
    {
        $FichaTecnicaModel = new FichatecnicaModel();
        $usuarioModel = new UsuarioModel();
        $detallefichatecnica = $this->request->getJSON();

        $dataActualizar = [
            'cotizacionenviadaFichatecnica' => 1
        ];

        $usuariosEnviar = $usuarioModel->whereIn('idRol', [2, 5])->findAll();
        $usuario = [];

        $detalleFichaBD = $this->model->where('idFichatecnica', $detallefichatecnica)->first();
        $fichatecnicaBD = $FichaTecnicaModel->where('idFichatecnica', $detallefichatecnica)->first();

        if (empty($detalleFichaBD)) :
            return $this->failValidationErrors("No hay cotización para enviar");
        else :
            if ($fichatecnicaBD['cotizacionenviadaFichatecnica'] == 0) :
                foreach ($usuariosEnviar as $key => $value) {
                    $usuario = $value;

                    $this->sendEmail($usuario, $fichatecnicaBD);
                }

                $FichaTecnicaModel->update($detallefichatecnica, $dataActualizar);

                $DataRespond = $this->model->obtenerFicha($detallefichatecnica);

                return $this->respond($DataRespond[0], 200);
            else :
                return $this->failValidationErrors("La ficha ya fue enviada");
            endif;
        endif;
    }

    public function sendEmail($user, $fichatecnica)
    {
        $to = $user['correoUsuario'];
        $subject = 'APROBACION N° ' . $fichatecnica['numFichatecnica'] . ' - ' . $fichatecnica['nombreFichatecnica'];
        $message = '<!DOCTYPE html>
                    <html>
                    <head>
                    <title></title>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                    <style type="text/css">
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

                    /* MEDIA QUERIES */
                    @media screen and (max-width: 480px) {
                        .mobile-hide {
                            display: none !important;
                        }
                        .mobile-center {
                            text-align: center !important;
                        }
                    }

                    /* ANDROID CENTER FIX */
                    div[style*="margin: 16px 0;"] { margin: 0 !important; }
                    </style>
                    </head>
                    <body style="margin: 0 !important; padding: 0 !important; background-color: #eeeeee;" bgcolor="#eeeeee">

                    <!-- HIDDEN PREHEADER TEXT -->
                    <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Open Sans, Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
                    </div>

                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td align="center" style="background-color: #eeeeee;" bgcolor="#eeeeee">
                            <!--[if (gte mso 9)|(IE)]>
                            <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
                            <tr>
                            <td align="center" valign="top" width="600">
                            <![endif]-->
                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                                <tr>
                                    <td align="center" valign="top" style="font-size:0; padding: 35px;" bgcolor="#1379AA">
                                    <!--[if (gte mso 9)|(IE)]>
                                    <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
                                    <tr>
                                    <td align="left" valign="top" width="300">
                                    <![endif]-->
                                    <div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;">
                                        <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                                            <tr>
                                                <td align="left" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 36px; font-weight: 800; line-height: 48px;" class="mobile-center">
                                                    <h1 style="font-size: 36px; font-weight: 800; margin: 0; color: #ffffff;">Relix Syl</h1>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <!--[if (gte mso 9)|(IE)]>
                                    </td>
                                    <td align="right" width="300">
                                    <![endif]-->
                                    <div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;" class="mobile-hide">
                                        <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                                            <tr>
                                                <td align="right" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; line-height: 48px;">
                                                    <table cellspacing="0" cellpadding="0" border="0" align="right">
                                                        <tr>
                                                            <td style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400;">
                                                                <p style="font-size: 18px; font-weight: 400; margin: 0; color: #ffffff;"><a style="color: #ffffff; text-decoration: none;">Cotización &nbsp;</a></p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <!--[if (gte mso 9)|(IE)]>
                                    </td>
                                    </tr>
                                    </table>
                                    <![endif]-->
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="padding: 35px 35px 20px 35px; background-color: #ffffff;" bgcolor="#ffffff">
                                    <!--[if (gte mso 9)|(IE)]>
                                    <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
                                    <tr>
                                    <td align="center" valign="top" width="600">
                                    <![endif]-->
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                                        <tr>
                                            <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;">
                                                <img src="https://relixwater.com/wp-content/uploads/2020/06/Logo-Relix-150px-slogan.png" width="125" height="120" style="display: block; border: 0px;" /><br>
                                                <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;">
                                                    Hola ' . $user['nombreUsuario'] . '!
                                                </h2>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;">
                                                <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;">
                                                    Se agregaron nuevas cotizaciones para validar en el Sistema Gestor de Proyectos Relix (SGPR).
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" style="padding-top: 20px;">
                                                <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                    <tr>
                                                        <td width="75%" align="left" bgcolor="#eeeeee" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;">
                                                            Aprobación N°
                                                        </td>
                                                        <td width="25%" align="left" bgcolor="#eeeeee" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;">
                                                            ' . $fichatecnica['numFichatecnica'] . ' - ' . $fichatecnica['nombreFichatecnica'] . '
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="75%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;">
                                                            Costo del proyecto
                                                        </td>
                                                        <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;">
                                                            $' . number_format($fichatecnica['costoproyectoFichatecnica'], 2, '.', ',') . '
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="75%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
                                                            Margen del proyecto
                                                        </td>
                                                        <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
                                                            ' . $fichatecnica['margenFichatecnica'] . '%
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="75%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
                                                            Utilidad del proyecto
                                                        </td>
                                                        <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
                                                            $' . number_format($fichatecnica['utilidadFichatecnica'], 2, '.', ',') . '
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" style="padding-top: 20px;">
                                                <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                    <tr>
                                                        <td width="75%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;">
                                                            Monto del proyecto
                                                        </td>
                                                        <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;">
                                                            $' . number_format($fichatecnica['valorventaigvFichatecnica'], 2, '.', ',') . '
                                                        </td>
                                                    </tr>
                                                </table>
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
                                <tr>
                                    <td align="center" height="100%" valign="top" width="100%" style="padding: 0 35px 35px 35px; background-color: #ffffff;" bgcolor="#ffffff">
                                    <!--[if (gte mso 9)|(IE)]>
                                    <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
                                    <tr>
                                    <td align="center" valign="top" width="600">
                                    <![endif]-->
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:660px;">
                                        <tr>
                                            <td align="center" valign="top" style="font-size:0;">
                                                <!--[if (gte mso 9)|(IE)]>
                                                <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
                                                <tr>
                                                <td align="left" valign="top" width="300">
                                                <![endif]-->
                                                <div style="display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;">

                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                                                        <tr>
                                                            <td align="left" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;">
                                                                <p style="font-weight: 800;">Dirección de Entrega</p>
                                                                <p>' . $fichatecnica['direccionentregaFichatecnica'] . '</p>

                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <!--[if (gte mso 9)|(IE)]>
                                                </td>
                                                <td align="left" valign="top" width="300">
                                                <![endif]-->
                                                <div style="display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;">
                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                                                        <tr>
                                                            <td align="left" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;">
                                                                <p style="font-weight: 800;">Fecha estimada de finalización del proyecto</p>
                                                                <p>' . $fichatecnica['finproyectadoFichatecnica'] . '</p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <!--[if (gte mso 9)|(IE)]>
                                                </td>
                                                </tr>
                                                </table>
                                                <![endif]-->
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
                                <tr>
                                    <td align="center" style=" padding: 35px; background-color: #FFA73B;" bgcolor="#FFA73B">
                                    <!--[if (gte mso 9)|(IE)]>
                                    <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
                                    <tr>
                                    <td align="center" valign="top" width="600">
                                    <![endif]-->
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                                        <tr>
                                            <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;">
                                                <h2 style="font-size: 24px; font-weight: 800; line-height: 30px; color: #ffffff; margin: 0;">
                                                    Inicie sesión para validar la aprobación del proyecto.
                                                </h2>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="padding: 25px 0 15px 0;">
                                                <table border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td align="center" style="border-radius: 5px;" bgcolor="#ffc74f">
                                                        <a href="http://sistemaproyectos.relix.pe" target="_blank" style="font-size: 18px; font-family: Open Sans, Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; border-radius: 5px; background-color: #ffc74f; padding: 15px 30px; border: 1px solid #ffc74f; display: block;">Intranet Relix</a>
                                                        </td>
                                                    </tr>
                                                </table>
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
                            <!--[if (gte mso 9)|(IE)]>
                            </td>
                            </tr>
                            </table>
                            <![endif]-->
                            </td>
                        </tr>
                    </table>
                    </body>
                    </html>';
        /* $filepath = 'https://www.dogalize.com/wp-content/uploads/2017/06/La-sverminazione-e-la-pulizia-del-cucciolo-del-cane-2-800x400-800x400.jpg'; */

        $email = \Config\Services::email();

        /* $email->setFrom('informaciones@relixapi.mskdevmusic.com', 'Sistema Gestor de Proyectos'); */
        $email->setTo($to);
        /* $email->setCC('henrym.nagata@gmail.com'); */
        /* $email->setBCC('them@their-example.com'); */

        $email->setSubject($subject);
        $email->setMessage($message);
        /* $email->attach($filepath); */

        $email->send();
    }

    public function guardarDatadetallefichatecnica()
    {
        try {
            $producto = new ProductoModel();

            $detallefichatecnica = $this->request->getJSON();
            $detalleunitario = [];


            foreach ($detallefichatecnica as $key => $value) {
                $detalleunitario = $value;

                $productoBD = $producto->where('codigosoftcomProducto', $detalleunitario->codigosoftcomProducto)->first();
                $preciodescuento = str_replace('.', '', $detalleunitario->preciocondescuento);
                $preciodescuentodecimal = str_replace(',', '.', $preciodescuento);

                if ($detalleunitario->codigosoftcomProducto === '9999999999') :
                    $dataUpdate = [
                        'preciounitarioDetallefichatecnica' => isset($detalleunitario->preciounitarioDetallefichatecnica->options->optionSelected) ? $detalleunitario->preciounitarioDetallefichatecnica->options->optionSelected : 0,
                        'preciototalDetallefichatecnica' => isset($detalleunitario->preciototalDetallefichatecnica) ? $detalleunitario->preciototalDetallefichatecnica : 0,
                        'descuentototalDetallefichatecnica' => $detalleunitario->descuentototalDetallefichatecnica,
                        'descuentounitarioDetallefichatecnica' => $detalleunitario->descuentounitarioDetallefichatecnica,
                        'costoingDetallefichatecnica' => $detalleunitario->costodisenoProducto,
                        'preciodescuentoDetallefichatecnica' => $preciodescuentodecimal,
                    ];
                else :
                    $dataUpdate = [
                        'preciounitarioDetallefichatecnica' => isset($detalleunitario->preciounitarioDetallefichatecnica->options->optionSelected) ? $detalleunitario->preciounitarioDetallefichatecnica->options->optionSelected : 0,
                        'preciototalDetallefichatecnica' => isset($detalleunitario->preciototalDetallefichatecnica) ? $detalleunitario->preciototalDetallefichatecnica : 0,
                        'descuentototalDetallefichatecnica' => $detalleunitario->descuentototalDetallefichatecnica,
                        'descuentounitarioDetallefichatecnica' => $detalleunitario->descuentounitarioDetallefichatecnica,
                        'costoingDetallefichatecnica' => isset($productoBD['costodisenoProducto']) ? $productoBD['costodisenoProducto'] : 0,
                        'preciodescuentoDetallefichatecnica' => $preciodescuentodecimal,
                    ];
                endif;

                $this->model->update($detalleunitario->idDetallefichatecnica, $dataUpdate);
            };

            $precioProducto = new PrecioproductoModel();

            if (empty($detalleunitario->idFichatecnica)) :
                return $this->failValidationErrors("No se ha pasado un ID valido");
            else :
                $listaDetalle = $this->model->obtenerDetallefichatecnica($detalleunitario->idFichatecnica);
                $detalleEnviar = [];
                $listaEnviar = [];
                $precioRemplazar = 0;

                foreach ($listaDetalle as $key => $value) {
                    $detalleEnviar = $value;

                    $precioRemplazar = $detalleEnviar->preciounitarioDetallefichatecnica;

                    unset($detalleEnviar->preciounitarioDetallefichatecnica);
                    $listaPrecio = $precioProducto->where('codigosoftcomProducto', $detalleEnviar->codigosoftcomProducto)->findAll();

                    unset($listaPrecio[0]['idPrecioproducto']);
                    unset($listaPrecio[0]['codigosoftcomProducto']);

                    if ($detalleEnviar->codigosoftcomProducto === '9999999999') {
                        $listaPrecio[0]['optionSelected'] = $precioRemplazar;
                        $listaPrecio[0]['precioventaunoProducto'] = $precioRemplazar;
                        $listaPrecio[0]['precioventadosProducto'] = $precioRemplazar;
                        $listaPrecio[0]['precioventatresProducto'] = $precioRemplazar;
                        $listaPrecio[0]['precioventacuatroProducto'] = $precioRemplazar;
                        $detalleEnviar->costodisenoProducto = $detalleEnviar->costoingDetallefichatecnica;
                    } else {
                        $listaPrecio[0]['optionSelected'] = isset($precioRemplazar) ? $precioRemplazar : $listaPrecio[0]['precioventatresProducto'];
                    }
                    $preciosArray['isManual'] = false;
                    $preciosArray['options'] = $listaPrecio[0];
                    $detalleEnviar->preciounitarioDetallefichatecnica = $preciosArray;
                    array_push($listaEnviar, $detalleEnviar);
                }

                return $this->respond($listaEnviar, 200);
            endif;
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor', 500, 'Ha ocurrido un error en el servidor');
        }
    }

    public function eliminarDetalleFichaTecnica($id = null)
    {
        $detalleEnviar = [];
        if ($this->model->where('idFichatecnica', $id)->delete()) {
            return $this->respond($detalleEnviar, 200);
        } else {
            return $this->failValidationErrors("No se elimino el detalle");
        }
    }

    public function cambiarEstadoProductoDetalleFichaTecnica()
    {
        $productosPOST = $this->request->getJSON();

        $dataActualizar = [
            '	idEstadoproductoDetallefichatecnica' => 4
        ];

        $this->model->update($productosPOST, $dataActualizar);
    }

    public function anularProducto()
    {
        try {
            $dataPost = $this->request->getJSON();

            if (isset($dataPost->id)) {

                $productoDetalleBD = $this->model->find($dataPost->id);

                if (isset($productoDetalleBD)) :
                    $dataActualizar = [
                        "observacionDetallefichatecnica" => $dataPost->observacion,
                        "idEstadoproductoDetallefichatecnica" => 4,
                    ];

                    $result = $this->model->update($dataPost->id, $dataActualizar);

                    if ($result) {
                        return $this->respond("Anulación exitosa", 200);
                    } else {
                        return $this->failValidationErrors("Error al anular el producto", 400);
                    } 
                else:
                    return $this->failValidationErrors("No se encontro un producto con el id", 400);
                endif;
            } else {
                return $this->failValidationErrors("No se paso un id valido", 400);
            }
        } catch (\Throwable $th) {
            return $this->failServerError("Ingreso al catch", 500);
        }
    }

    public function standByProductor()
    {
        try {
            $dataPost = $this->request->getJSON();

            if (isset($dataPost->id)) {

                $productoDetalleBD = $this->model->find($dataPost->id);

                if (isset($productoDetalleBD)) :
                    if ($productoDetalleBD['']) {
                        # code...
                    }
                    $dataActualizar = [
                        "observacionDetallefichatecnica" => $dataPost->observacion,
                        "idEstadoproductoDetallefichatecnica" => 4,
                    ];

                    $result = $this->model->update($dataPost->id, $dataActualizar);

                    if ($result) {
                        return $this->respond("Anulación exitosa", 200);
                    } else {
                        return $this->failValidationErrors("Error al anular el producto", 400);
                    }
                else :
                    return $this->failValidationErrors("No se encontro un producto con el id", 400);
                endif;
            } else {
                return $this->failValidationErrors("No se paso un id valido", 400);
            }
        } catch (\Throwable $th) {
            return $this->failServerError("Ingreso al catch", 500);
        }
        
    }

    public function agregarProductoDetalleFichaTecnica()
    {
        try {
            $producto = new ProductoModel();
            $partida = new PartidaModel();

            $detalleproductoPOST =  $this->request->getJSON();

            if (isset($detalleproductoPOST)){
                $precioTotal = $detalleproductoPOST->precioUnitario * $detalleproductoPOST->cantTotal;

                $partidaBD = $partida->where("idPartida", $detalleproductoPOST->idPartida)->first();

                if ($detalleproductoPOST->codErp === '9999999999') :

                    $dataRegistrar = [
                        'itemDetallefichatecnica' => $detalleproductoPOST->numPartida,
                        'partidaDetallefichatecnica' => $partidaBD['nombrePartida'],
                        'subpartidaDetallefichatecnica' => isset($detalleproductoPOST->subPartida) ? $detalleproductoPOST->subPartida : '',
                        'marcaDetallefichatecnica' => isset($detalleproductoPOST->marca) ? $detalleproductoPOST->marca : '',
                        'codigoproveedorDetallefichatecnica' => isset($detalleproductoPOST->codProveedor) ? $detalleproductoPOST->codProveedor : '',
                        'codigosoftcomProducto' => '9999999999',
                        'descripcionDetallefichatecnica' => isset($detalleproductoPOST->descripcion) ? $detalleproductoPOST->descripcion : '',
                        'observacionDetallefichatecnica' => isset($detalleproductoPOST->observacion) ? $detalleproductoPOST->observacion : '',
                        'cantidadDetallefichatecnica' => $detalleproductoPOST->cantTotal,
                        'preciounitarioDetallefichatecnica' => isset($detalleproductoPOST->precioUnitario) ? $detalleproductoPOST->precioUnitario : 0,
                        'preciototalDetallefichatecnica' => isset($detalleproductoPOST->precioUnitario) ? $precioTotal : 0,
                        'preciodescuentoDetallefichatecnica' => ($precioTotal - ($precioTotal * ($detalleproductoPOST->descuento / 100))),
                        'costoingDetallefichatecnica' => $detalleproductoPOST->costoDiseno,
                        'costototalDetallefichatecnica' => $detalleproductoPOST->costoDiseno * $detalleproductoPOST->cantTotal,
                        'descuentopartidaDetallefichatecnica' => 0.00,
                        'descuentototalDetallefichatecnica' => $detalleproductoPOST->descuento,
                        'aprobaciongerenteDetallefichatecnica' => 0,
                        'aprobacionotroDetallefichatecnica' => 0,
                        'idEstadoproductoDetallefichatecnica' => 5,
                        'idFichatecnica' => $detalleproductoPOST->idFichatecnica,
                    ];

                else :
                    $productoBD = $producto->where('codigosoftcomProducto', $detalleproductoPOST->codErp)->first();

                    $dataRegistrar = [
                        'itemDetallefichatecnica' => $detalleproductoPOST->numPartida,
                        'partidaDetallefichatecnica' => $partidaBD['nombrePartida'],
                        'subpartidaDetallefichatecnica' => isset($detalleproductoPOST->subPartida) ? $detalleproductoPOST->subPartida : '',
                        'marcaDetallefichatecnica' => isset($productoBD['marcaProducto']) ? $productoBD['marcaProducto'] : $detalleproductoPOST->marca,
                        'codigoproveedorDetallefichatecnica' => isset($productoBD['codigoreferenciaProducto']) ? $productoBD['codigoreferenciaProducto'] : $detalleproductoPOST->codProveedor,
                        'codigosoftcomProducto' => $detalleproductoPOST->codErp,
                        'descripcionDetallefichatecnica' => isset($productoBD['descripcionProducto']) ? $productoBD['descripcionProducto'] : $detalleproductoPOST->descripcion,
                        'observacionDetallefichatecnica' => isset($detalleproductoPOST->observacion) ? $detalleproductoPOST->observacion : '',
                        'cantidadDetallefichatecnica' => $detalleproductoPOST->cantTotal,
                        'preciounitarioDetallefichatecnica' => isset($detalleproductoPOST->precioUnitario) ? $detalleproductoPOST->precioUnitario : 0,
                        'preciototalDetallefichatecnica' => isset($detalleproductoPOST->precioUnitario) ? $precioTotal : 0,
                        'preciodescuentoDetallefichatecnica' => ($precioTotal - ($precioTotal * ($detalleproductoPOST->descuento / 100))),
                        'costoingDetallefichatecnica' => $productoBD['costodisenoProducto'],
                        'costototalDetallefichatecnica' => $productoBD['costodisenoProducto'] * $detalleproductoPOST->cantTotal,
                        'descuentopartidaDetallefichatecnica' => 0.00,
                        'descuentototalDetallefichatecnica' => $detalleproductoPOST->descuento,
                        'aprobaciongerenteDetallefichatecnica' => 0,
                        'aprobacionotroDetallefichatecnica' => 0,
                        'idEstadoproductoDetallefichatecnica' => 5,
                        'idFichatecnica' => $detalleproductoPOST->idFichatecnica,
                    ];

                endif;
                
                if ($this->model->insert($dataRegistrar)) {
                    return $this->respond("Se registro exitosamente", 200);    
                }else {
                    return $this->failValidationErrors("No se pudo realizar el registro", 400);
                }
                
            }
            else {
                return $this->failValidationErrors("No se enviaron datos para registrar", 400);
            }
        } catch (\Throwable $th) {
            return $this->failServerError("Ingreso al catch", 500);
        }
    }
}

