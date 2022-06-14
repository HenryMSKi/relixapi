<?php 
namespace App\Controllers\API;

use App\Models\FichatecnicaModel;
use App\Models\UsuarioModel;
use CodeIgniter\RESTful\ResourceController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class FichatecnicaController extends ResourceController{
    public function __construct() {
        $this->model = $this->setModel(new FichatecnicaModel());
    }

    public function listarFichatecnica($id = null)
    {
        $fichas = $this->model->obtenerFichas();

        return $this->respond($fichas, 200);
    }

    public function exportarExcelFichasTecnicas($id = null)
    {
        $hoy = date("Y-m-d H-i-s");
        $fichas = $this->model->obtenerFichas();

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()
        ->setCreator("Sistema Gestor de Proyectos Relix - SGPR")
        ->setLastModifiedBy('SGPR') // última vez modificado por
        ->setTitle('REPORTE PIPELINE RELIX SYL' . $hoy)
        ->setSubject('Pipeline Relix Syl')
        ->setDescription('Este documento presenta el reporte pipeline de la empresa Relix Syl');
        /* ->setKeywords('etiquetas o palabras clave separadas por espacios')
        ->setCategory('La categoría'); */

        $sheet = $spreadsheet->getActiveSheet();

        $highestColumn = $sheet->getHighestColumn();

        $styleArray = [
            // use PhpOffice \ PhpSpreadsheet \ Style \ Alignment; La constante en el archivo es el parámetro
            // Alineación :: HORIZONTAL_CENTER centrado horizontalmente
            // Alineación :: VERTICAL_CENTER vertical center
            'alignment' => [
                // 'horizontal' => Alineación :: HORIZONTAL_CENTER, // centro horizontal
                // 'vertical' => Alineación :: VERTICAL_CENTER, // Centro vertical
                'horizontal' => 'center', // Centro horizontal
                'vertical' => 'center', // Centro vertical
            ],
            // use PhpOffice \ PhpSpreadsheet \ Style \ Border; La constante en el archivo es el parámetro
            // Borde :: BORDER_THICK estilo de borde
            'borders' => [
                'outline' => [
                    // 'borderStyle' => '\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK',
                    'borderStyle' => 'thin',
                    //'color' => ['argb' => 'FFFF0000'],
                ],
            ],
            'font' => [
                //'name' => 'Cuerpo negro',
                'bold' => true,
                //'size' => 22
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'E7E6E6'
                    ]
            ]
        ];


        $sheet->mergeCells('A4:B4');
        $sheet->setCellValue('A4', $hoy);
        $sheet->getStyle('A4:B4')
            ->applyFromArray($styleArray);

        $sheet->mergeCells('C4:H4');
        $sheet->setCellValue('C4', 'PIPELINE RELIX PERU');
        $sheet->getStyle('C4:H4')
            ->applyFromArray($styleArray);

        $sheet->setCellValue('K4', 'Probabilidad');
        $sheet->getStyle('K4')
            ->applyFromArray($styleArray);

        $sheet->mergeCells('L4:L5');
        $sheet->setCellValue('L4', 'Status');
        $sheet->getStyle('L4:L5')
            ->applyFromArray($styleArray);
        $sheet->getStyle('L4:L5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');

        $sheet->setCellValue('M4', 'Preparación');
        $sheet->getStyle('M4')
            ->applyFromArray($styleArray);

        $sheet->setCellValue('N4', 'Diseño');
        $sheet->getStyle('N4')
            ->applyFromArray($styleArray);

        $sheet->setCellValue('O4', 'Negociación');
        $sheet->getStyle('O4')
            ->applyFromArray($styleArray);

        $sheet->setCellValue('P4', 'Ganado');
        $sheet->getStyle('P4')
            ->applyFromArray($styleArray);

        $sheet->setCellValue('Q4', 'Perdido');
        $sheet->getStyle('Q4')
            ->applyFromArray($styleArray);

        $sheet->mergeCells('R4:R5');
        $sheet->setCellValue('R4', 'Observaciones');
        $sheet->getStyle('R4:R5')
            ->applyFromArray($styleArray);

        $sheet->setCellValue('S4', 'Agua');
        $sheet->getStyle('S4')
            ->applyFromArray($styleArray);

        $sheet->setCellValue('T4', 'Riego');
        $sheet->getStyle('T4')
            ->applyFromArray($styleArray);

        $sheet->setCellValue('A5', 'Item');
        $sheet->getStyle('A5')
            ->applyFromArray($styleArray);

        $sheet->setCellValue('B5', 'DIVISIÓN');
        $sheet->getStyle('B5')
            ->applyFromArray($styleArray);

        $sheet->setCellValue('C5', 'Cliente');
        $sheet->getStyle('C5')
            ->applyFromArray($styleArray);

        $sheet->setCellValue('D5', 'Detalle del proyecto');
        $sheet->getStyle('D5')
            ->applyFromArray($styleArray);

        $sheet->setCellValue('E5', 'Departamento');
        $sheet->getStyle('E5')
            ->applyFromArray($styleArray);

        $sheet->setCellValue('F5', 'Fecha inicio probable');
        $sheet->getStyle('F5')
            ->applyFromArray($styleArray);

        $sheet->setCellValue('G5', 'Duración meses');
        $sheet->getStyle('G5')
            ->applyFromArray($styleArray);

        $sheet->setCellValue('H5', 'Cultivo');
        $sheet->getStyle('H5')
            ->applyFromArray($styleArray);

        $sheet->setCellValue('I5', 'ha');
        $sheet->getStyle('I5')
            ->applyFromArray($styleArray);

        $sheet->setCellValue('J5', 'Venta U$');
        $sheet->getStyle('J5')
            ->applyFromArray($styleArray);

        $sheet->setCellValue('K5', '%');
        $sheet->getStyle('K5')
            ->applyFromArray($styleArray);
        $sheet->getStyle('K5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(true);
        $sheet->getColumnDimension('L')->setAutoSize(true);
        $sheet->getColumnDimension('M')->setAutoSize(true);
        $sheet->getColumnDimension('N')->setAutoSize(true);
        $sheet->getColumnDimension('O')->setAutoSize(true);
        $sheet->getColumnDimension('P')->setAutoSize(true);
        $sheet->getColumnDimension('Q')->setAutoSize(true);
        $sheet->getColumnDimension('R')->setAutoSize(true);
        $sheet->getColumnDimension('S')->setAutoSize(true);
        $sheet->getColumnDimension('T')->setAutoSize(true);

        $item = 1;
        $rowCount = 6;
        $porcentajeProbabilidad = 0;

        foreach ($fichas as $key => $value){
            $sheet->setCellValue('A' . $rowCount, $item);
            $sheet->getStyle('A' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            $sheet->setCellValue('B' . $rowCount, $value->nombreDivision);
            $sheet->getStyle('B' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            $sheet->setCellValue('C' . $rowCount, $value->clienteFichatecnica);
            $sheet->getStyle('C' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            $sheet->setCellValue('D' . $rowCount, $value->tipoProyecto);
            $sheet->getStyle('D' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            $sheet->setCellValue('E' . $rowCount, $value->nombreDepartamento);
            $sheet->getStyle('E' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            $sheet->setCellValue('F' . $rowCount, $value->inicioproyectadoFichatecnica);
            $sheet->getStyle('F' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            $sheet->setCellValue('G' . $rowCount, $value->plazoFichatecnica);
            $sheet->getStyle('G' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            $sheet->setCellValue('H' . $rowCount, $value->cultivoFichatecnica);
            $sheet->getStyle('H' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            $sheet->setCellValue('I' . $rowCount, $value->areaFichatecnica);
            $sheet->getStyle('I' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->getStyle('I'. $rowCount)->getNumberFormat()->setFormatCode('#,##0');

            $sheet->setCellValue('J' . $rowCount, $value->valorventaFichatecnica);
            $sheet->getStyle('J' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->getStyle('J' . $rowCount)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

            if($value->estadoFichaproyecto === 'Perdido' ){
                $porcentajeProbabilidad = 0;
                $sheet->setCellValue('K' . $rowCount, 0);
                $sheet->getStyle('K' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $sheet->getStyle('K' . $rowCount)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE);
            }
            if ($value->estadoFichaproyecto === 'Preparación') {
                $porcentajeProbabilidad = 0.25;
                $sheet->setCellValue('K' . $rowCount, 0.25);
                $sheet->getStyle('K' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $sheet->getStyle('K' . $rowCount)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE);
            }
            if ($value->estadoFichaproyecto === 'Diseño') {
                $porcentajeProbabilidad = 0.50;
                $sheet->setCellValue('K' . $rowCount, 0.50);
                $sheet->getStyle('K' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $sheet->getStyle('K' . $rowCount)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE);
            }
            if ($value->estadoFichaproyecto === 'Negociación') {
                $porcentajeProbabilidad = 0.75;
                $sheet->setCellValue('K' . $rowCount, 0.75);
                $sheet->getStyle('K' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $sheet->getStyle('K' . $rowCount)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE);
            }
            if ($value->estadoFichaproyecto === 'Ganado') {
                $porcentajeProbabilidad = 1;
                $sheet->setCellValue('K' . $rowCount, 1);
                $sheet->getStyle('K' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $sheet->getStyle('K' . $rowCount)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE);
            }

            $sheet->setCellValue('L' . $rowCount, $value->estadoFichaproyecto);
            $sheet->getStyle('L' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            if($value->estadoFichaproyecto === 'Preparación'){
                $sheet->setCellValue('M' . $rowCount, ($value->valorventaFichatecnica * $porcentajeProbabilidad));
                $sheet->getStyle('M' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $sheet->getStyle('M' . $rowCount)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

            }else{
                $sheet->setCellValue('M' . $rowCount, '0');
                $sheet->getStyle('M' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $sheet->getStyle('M' . $rowCount)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            }

            if ($value->estadoFichaproyecto === 'Diseño') {
                $sheet->setCellValue('N' . $rowCount, ($value->valorventaFichatecnica * $porcentajeProbabilidad));
                $sheet->getStyle('N' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $sheet->getStyle('N' . $rowCount)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            } else {
                $sheet->setCellValue('N' . $rowCount, '0');
                $sheet->getStyle('N' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $sheet->getStyle('N' . $rowCount)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            }

            if ($value->estadoFichaproyecto === 'Negociación') {
                $sheet->setCellValue('O' . $rowCount, ($value->valorventaFichatecnica * $porcentajeProbabilidad));
                $sheet->getStyle('O' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $sheet->getStyle('O' . $rowCount)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            } else {
                $sheet->setCellValue('O' . $rowCount, '0');
                $sheet->getStyle('O' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $sheet->getStyle('O' . $rowCount)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            }

            if ($value->estadoFichaproyecto === 'Ganado') {
                $sheet->setCellValue('P' . $rowCount, ($value->valorventaFichatecnica * $porcentajeProbabilidad));
                $sheet->getStyle('P' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $sheet->getStyle('P' . $rowCount)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            } else {
                $sheet->setCellValue('P' . $rowCount, '0');
                $sheet->getStyle('P' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $sheet->getStyle('P' . $rowCount)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            }

            if ($value->estadoFichaproyecto === 'Perdido') {
                $sheet->setCellValue('Q' . $rowCount, ($value->valorventaFichatecnica * $porcentajeProbabilidad));
                $sheet->getStyle('Q' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $sheet->getStyle('Q' . $rowCount)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            } else {
                $sheet->setCellValue('Q' . $rowCount, '0');
                $sheet->getStyle('Q' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $sheet->getStyle('Q' . $rowCount)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            }

            $sheet->setCellValue('R' . $rowCount, '');
            $sheet->getStyle('R' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            if ($value->nombreDivision === 'Agua') {
                $sheet->setCellValue('S' . $rowCount, ($value->valorventaFichatecnica * $porcentajeProbabilidad));
                $sheet->getStyle('S' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $sheet->getStyle('S' . $rowCount)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            } else {
                $sheet->setCellValue('S' . $rowCount, '0');
                $sheet->getStyle('S' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $sheet->getStyle('S' . $rowCount)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            }

            if ($value->nombreDivision === 'Riego') {
                $sheet->setCellValue('T' . $rowCount, ($value->valorventaFichatecnica * $porcentajeProbabilidad));
                $sheet->getStyle('T' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $sheet->getStyle('T' . $rowCount)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            } else {
                $sheet->setCellValue('T' . $rowCount, '0');
                $sheet->getStyle('T' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $sheet->getStyle('T' . $rowCount)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            }
            
            $item++;
            $rowCount++;
        }

        $sheet->setCellValue('I4', '=SUM(I6:I'. $rowCount .')');
        $sheet->getStyle('I4')
            ->applyFromArray($styleArray);
        $sheet->getStyle('I4')->getNumberFormat()->setFormatCode('#,##0');

        $sheet->setCellValue('J4', '=SUM(J6:J' . $rowCount . ')');
        $sheet->getStyle('J4')
            ->applyFromArray($styleArray);
        $sheet->getStyle('J4')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        $sheet->setCellValue('M5', '=SUM(M6:M' . $rowCount . ')');
        $sheet->getStyle('M5')
            ->applyFromArray($styleArray);
        $sheet->getStyle('M5')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        $sheet->setCellValue('N5', '=SUM(N6:N' . $rowCount . ')');
        $sheet->getStyle('N5')
            ->applyFromArray($styleArray);
        $sheet->getStyle('N5')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        $sheet->setCellValue('O5', '=SUM(O6:O' . $rowCount . ')');
        $sheet->getStyle('O5')
            ->applyFromArray($styleArray);
        $sheet->getStyle('O5')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        $sheet->setCellValue('P5', '=SUM(P6:P' . $rowCount . ')');
        $sheet->getStyle('P5')
            ->applyFromArray($styleArray);
        $sheet->getStyle('P5')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        $sheet->setCellValue('Q5', '=SUM(Q6:Q' . $rowCount . ')');
        $sheet->getStyle('Q5')
            ->applyFromArray($styleArray);
        $sheet->getStyle('Q5')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        $sheet->setCellValue('S5', '=SUM(S6:S' . $rowCount . ')');
        $sheet->getStyle('S5')
            ->applyFromArray($styleArray);
        $sheet->getStyle('S5')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        $sheet->setCellValue('T5', '=SUM(T6:T' . $rowCount . ')');
        $sheet->getStyle('T5')
            ->applyFromArray($styleArray);
        $sheet->getStyle('T5')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="REPORTE PIPELINE RELIX SYL ' . $hoy . '.xlsx"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');

        exit;
    }

    public function listarFichatecnicaEnviada()
    {
        $fichas = $this->model->obtenerFichasCotizadas();

        return $this->respond($fichas, 200);
    }

    public function listarFichatecnicaBackOffice()
    {
        $fichas = $this->model->obtenerFichasAprobadas();

        return $this->respond($fichas, 200);
    }

    public function contadorFichas()
    {
        $cantidadFichas = $this->model->obtenercantidadFichas();

        $codigoFicha = [
            'codigoFicha' => $cantidadFichas + 1
        ];
        
        return $this->respond($codigoFicha, 200);
    }

    public function actualizarAprobacionGerenteGeneral($id = null)
    {
        $result = $this->request->getJSON();
        
        $fichaBD = $this->model->where('idFichatecnica', $id)->first();

        if($fichaBD['aprobaciongerenteFichatecnica'] != 1):
            if ($result == 1) :
                $dataUpdate = [
                    'aprobaciongerenteFichatecnica' => 1
                ];

                $this->model->update($id, $dataUpdate);

                return $this->respond(1);
            else :
                $dataUpdate = [
                    'aprobaciongerenteFichatecnica' => 2
                ];

                $this->model->update($id, $dataUpdate);

                return $this->respond(2);
            endif;
        else:
            return $this->failValidationErrors("La ficha ya fue aceptada anteriormente");
        endif;
    }

    public function actualizarAprobacionGerenteAdministracion($id = null)
    {
        $result = $this->request->getJSON();
        $usuarioModel = new UsuarioModel();

        $fichaBD = $this->model->where('idFichatecnica', $id)->first();

        $usuariosEnviar = $usuarioModel->whereIn('idRol', 4)->findAll(); // Revisar la lista de usuarios
        $usuario = [];

        if ($fichaBD['aprobaciongerenteadministracionFichatecnica'] != 1) :
            if ($result == 1) :
                if($fichaBD['aprobaciongerenteFichatecnica'] == 1):
                    $dataUpdate = [
                        'aprobaciongerenteadministracionFichatecnica' => 1
                    ];
                    $this->model->update($id, $dataUpdate);

                    foreach ($usuariosEnviar as $key => $value) {
                        $usuario = $value;

                        $this->sendEmail($usuario, $fichaBD);
                    }
                    return $this->respond(1);
                else:
                    $dataUpdate = [
                        'aprobaciongerenteadministracionFichatecnica' => 1
                    ];

                    $this->model->update($id, $dataUpdate);

                    return $this->respond(1);
                endif; 
            else :
                $dataUpdate = [
                    'aprobaciongerenteadministracionFichatecnica' => 0,
                    'cotizacionenviadaFichatecnica' => 0,
                    'aprobaciongerenteFichatecnica' => 0,
                ];

                $this->model->update($id, $dataUpdate);

                return $this->respond(2);
            endif;
        else :
            return $this->failValidationErrors("La ficha ya fue aceptada anteriormente");
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
                                                                <p style="font-size: 18px; font-weight: 400; margin: 0; color: #ffffff;"><a style="color: #ffffff; text-decoration: none;">Aprobación &nbsp;</a></p>
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
                                                    Ficha aprobada en el Sistema Gestor de Proyectos Relix (SGPR).
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

    public function agregarFichatecnica()
    {
        try {
            $ficha = $this->request->getJSON();

            $ficha->cotizacionenviadaFichatecnica = 0;
            $ficha->aprobaciongerenteFichatecnica = 0;
            $ficha->aprobaciongerenteadministracionFichatecnica = 0;
            $utilidad = ($ficha->costoproyectoFichatecnica / (1 - ($ficha->margenFichatecnica/100))) - $ficha->costoproyectoFichatecnica;
            $utilidadRedondeo = round($utilidad, 2);
            $ficha->utilidadFichatecnica = $utilidadRedondeo;
            $valorventa = round(($ficha->costoproyectoFichatecnica + $utilidad), 2);
            $ficha->valorventaFichatecnica = $valorventa;
            $ficha->valorventaigvFichatecnica = round($valorventa * 1.18, 2);

            $fichaExiste = $this->model->where('nombreFichatecnica', $ficha->nombreFichatecnica)->first();

            if(empty($fichaExiste)):
                if ($this->model->insert($ficha)) {
                    
                    $fichaRegistradaPOST = $this->model->obtenerFichasPOST($ficha->numFichatecnica);
                    $fichaRegistrada = [];
                    
                    foreach ($fichaRegistradaPOST as $key => $value) {
                        $fichaRegistrada = $value;
                    }
                    
                    return $this->respond($fichaRegistrada, 200);
                } else {
                    return $this->failValidationErrors($this->model->validation->listErrors());
                }
            else:
                return $this->failServerError('Existe una ficha registrada con ese nombre', 500, 'Existe una ficha registrada con ese nombre');
            endif;
            
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor', 500, 'Ha ocurrido un error en el servidor');
        }
    }

    public function actualizarFichatecnica($id = null)
    {
        try {
            if ($id == null) :
                return $this->failValidationErrors("No se ha pasado un ID valido");
            else :
                $fichatecnicaDB = $this->model->find($id);
                if ($fichatecnicaDB == null) :
                    return $this->failValidationErrors("No se ha encontrado una ficha con el id: " . $id);
                else :
                    $fichatecnica = $this->request->getJSON();

                    $dataActualizar = [
                        'fechaFichatecnica' => $fichatecnica->fechaFichatecnica,
                        'numFichatecnica' => $fichatecnica->numFichatecnica,
                        'idDivision' => $fichatecnica->idDivision,
                        'idTipoproyecto' => $fichatecnica->idTipoproyecto,
                        'nombreFichatecnica' => $fichatecnica->nombreFichatecnica,
                        'clienteFichatecnica' => $fichatecnica->clienteFichatecnica,
                        'rucclienteFichatecnica' => $fichatecnica->rucclienteFichatecnica,
                        'telefonoFichatecnica' => $fichatecnica->telefonoFichatecnica,
                        'direccionfiscalFichatecnica' => $fichatecnica->direccionfiscalFichatecnica,
                        'idVendedor' => $fichatecnica->idVendedor,
                        'codigoVendedorFichatecnica' => $fichatecnica->codigoVendedorFichatecnica,
                        'idDepartamento' => $fichatecnica->idDepartamento,
                        'idProvincia' => $fichatecnica->idProvincia,
                        'idDistrito' => $fichatecnica->idDistrito,
                        'direccionentregaFichatecnica' => $fichatecnica->direccionentregaFichatecnica,
                        'alcanceFichatecnica' => $fichatecnica->alcanceFichatecnica,
                        'areaFichatecnica' => $fichatecnica->areaFichatecnica,
                        'cultivoFichatecnica' => $fichatecnica->cultivoFichatecnica,
                        'idModalidadcontrato' => $fichatecnica->idModalidadcontrato,
                        'idModalidadejecucion' => $fichatecnica->idModalidadejecucion,
                        'detraccionesFichatecnica' => $fichatecnica->detraccionesFichatecnica,
                        'retencionFichatecnica' => $fichatecnica->retencionFichatecnica,
                        'cartafianzaFichatecnica' => $fichatecnica->cartafianzaFichatecnica,
                        'fielcumplimientoFichatecnica' => $fichatecnica->fielcumplimientoFichatecnica,
                        'plazoejecucionFichatecnica' => $fichatecnica->plazoejecucionFichatecnica,
                        'inicioproyectadoFichatecnica' => $fichatecnica->inicioproyectadoFichatecnica,
                        'finproyectadoFichatecnica' => $fichatecnica->finproyectadoFichatecnica,
                        'anticipoFichatecnica' => $fichatecnica->anticipoFichatecnica,
                        'porcentajeanticipoFichatecnica' => $fichatecnica->porcentajeanticipoFichatecnica,
                        'idFormapago' => $fichatecnica->idFormapago,
                        'financiamientoFichatecnica' => $fichatecnica->financiamientoFichatecnica,
                        'tasaFichatecnica' => $fichatecnica->tasaFichatecnica,
                        'periodograciaFichatecnica' => $fichatecnica->periodograciaFichatecnica,
                        'plazoFichatecnica' => $fichatecnica->plazoFichatecnica,
                        'periodocuotaFichatecnica' => $fichatecnica->periodocuotaFichatecnica,
                        'iniciofinanciamientoFichatecnica' => $fichatecnica->iniciofinanciamientoFichatecnica,
                        'facturanegociableFichatecnica' => $fichatecnica->facturanegociableFichatecnica,
                        'letraanticipadaFichatecnica' => $fichatecnica->letraanticipadaFichatecnica,
                        'anticipoocFichatecnica' => $fichatecnica->anticipoocFichatecnica,
                        'firmacontratoFichatecnica' => $fichatecnica->firmacontratoFichatecnica,
                        'idFacturacion' => $fichatecnica->idFacturacion,
                        'idEstadofichaproyecto' => $fichatecnica->idEstadofichaproyecto,
                        'instalacionFichatecnica' => $fichatecnica->instalacionFichatecnica,
                        'guardianiaFichatecnica' => $fichatecnica->guardianiaFichatecnica,
                        'contenedoroficinaFichatecnica' => $fichatecnica->contenedoroficinaFichatecnica,
                        'residenteobraFichatecnica' => $fichatecnica->residenteobraFichatecnica,
                        'vehiculoFichatecnica' => $fichatecnica->vehiculoFichatecnica,
                        'prevencionistaFichatecnica' => $fichatecnica->prevencionistaFichatecnica,
                        'costoproyectoFichatecnica' => $fichatecnica->costoproyectoFichatecnica,
                        'margenFichatecnica' => $fichatecnica->margenFichatecnica,
                        'utilidadFichatecnica' => $fichatecnica->utilidadFichatecnica,
                        'valorventaFichatecnica' => $fichatecnica->valorventaFichatecnica,
                        'valorventaigvFichatecnica' => $fichatecnica->valorventaigvFichatecnica,
                        'oportunidadesFichatecnica' => $fichatecnica->oportunidadesFichatecnica,
                        'riesgocontratoFichatecnica' => $fichatecnica->riesgocontratoFichatecnica,
                        'idUsuario' => $fichatecnica->idUsuario
                    ];

                    if ($this->model->update($id, $dataActualizar)) :

                        $fichaRegistradaPUT = $this->model->obtenerFichasPUT($id);
                        $fichaActualizada = [];

                        foreach ($fichaRegistradaPUT as $key => $value) {
                            $fichaActualizada = $value;
                        }

                        return $this->respond($fichaActualizada, 200);
                    else :
                        return $this->failValidationErrors($this->model->validation->listErrors());
                    endif;
                endif;
            endif;
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }
}