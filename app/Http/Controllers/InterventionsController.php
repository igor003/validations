<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreInterventionRequest;
use App\Interventions;
use App\TypeMentenance;
use App\DeviceTypes;
use App\Devices;
use App\User;
use App\InterventionsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Border;
use PHPExcel_Style_Fill;
use PHPExcel_Worksheet_Drawing;
use DateTime;
class InterventionsController extends Controller
{
    public function index()
    {
        $type_mentenance = TypeMentenance::all();
        $types_machines = DeviceTypes::all();
        $executors = User::where('status','=','user')->get();
        return view ('add_intervention',['types_mentenance'=>$type_mentenance,'device_types'=>$types_machines,'executors'=>$executors]);
    }

    public function store(StoreInterventionRequest $request)
    {
        if($request->report !=''){
            $file_decision = $request->file('report')->getClientOriginalName();
            $path = $request->file('report')->storeAs('public\\admin\\files\\reports', $file_decision);
        }
        $intervention = new Interventions;
        
        if($request->cycle == 'on'){

            $device = Devices::find($request->device);
            $device->cycles =  (int)$device->cycles + 1;
            $device->save();
        }
        $intervention->date = $request->date;
        $intervention->id_type_mentenance = $request->type_mentenance;
        $intervention->id_machine = $request->device;
        $intervention->id_type_machine = $request->type_machine;
        $intervention->id_type = $request->intervention; 
        $intervention->duration = $request->duration;
        // $intervention->id_user =  Auth::user()->id;
        $intervention->id_user =  $request->executor;
        if($request->report !=''){
            $intervention->report_path = $path ;
        }
        if($request->temper !=''){
            $intervention->temper = $request->temper;
        }else{
            $intervention->temper = NULL;
        }
        if($request->number_of_pices !=''){
            $intervention->nmb_of_pices = $request->number_of_pices;
        }else{
            $intervention->nmb_of_pices = NULL;
        }
        
        if($request->nmb_of_shuts !=''){
            $intervention->nmb_of_shuts = $request->nmb_of_shuts;
        }else{
            $intervention->nmb_of_shuts =NULL;
        }
        $intervention->note = $request->note;
        $intervention->save();

         return redirect(route('interv_list',['id'=>$request->type_machine]));
    }
    public function get_interventins($id_type_divice,$id_user,$id_mentenance,$id_device,$start_date,$end_date,$type_interv,$time,$json){

        $interventions = Interventions::where('id_type_machine','=',$id_type_divice);
        if($id_user != ''){
            $interventions->user($id_user);
        }
        if($id_mentenance != ''){
           $interventions->maintenance($id_mentenance);
        }
        if($id_device != ''){
            $interventions->machine($id_device);
        }
        if($start_date !='' && $end_date !=''){
            $interventions->date($start_date,$end_date);
        }
        if($type_interv != ''){
            $interventions->intervention($type_interv);        
        }
        if($time != '0'){
            $arr = array();
            foreach($interventions->get() as $intervention){
                $arr[] = $intervention->duration;
            }
            $temp_value = null;
            $seconds = 0;
            $minutes = 0;
            $hours = 0;
            foreach ($arr as $value) {
                $temp_value = explode(':', $value);
                $hours += $temp_value[0];
                $minutes += $temp_value[1];
                $seconds += $temp_value[2];
            }
                while ($minutes >= 60) {
                $hours++;
                $minutes -= 60;
            }
            $res_time = str_pad($hours, 2, 0, STR_PAD_LEFT) . ':' . str_pad($minutes, 2, 0, STR_PAD_LEFT). ':' . str_pad($seconds, 2, 0, STR_PAD_LEFT);
        }else{
            $res_time = null;
        }
        if($json){
            return Response::json([$res_time,$interventions->links()->orderBy('date','Desc')->offset(0)->limit(1000)->get()]);
        }else{
            return $interventions->links()->orderBy('date','Desc')->offset(0)->limit(1000)->get();
        }
        
    }

    public function get_by_machine_type_id( Request $request ){
        return $this->get_interventins($request->id,
                                       $request->user,
                                       $request->id_mentenance,
                                       $request->id_device,
                                       $request->start_date,
                                       $request->end_date,
                                       $request->type_interv,
                                       $request->time,
                                       true);
        
    }

    public function excell_generate($interventions,$date_start,$date_end){

         $xls = new PHPExcel();
        // Устанавливаем индекс активного листа
        try {
            $xls->setActiveSheetIndex(0);
        } catch (\PHPExcel_Exception $e) {
        }
        // Получаем активный лист
        $sheet = $xls->getActiveSheet();
        // Подписываем лист
        $sheet->setTitle('Interventions list');
        // Вставляем текст в ячейку A1
        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('test_img');
        $objDrawing->setResizeProportional(false);  
        $objDrawing->setDescription('test_img');
        $objDrawing->setPath('img/KabLem_logo.jpg');
        $objDrawing->setCoordinates('A1');                      
        //setOffsetX works properly
        $objDrawing->setOffsetX(4); 
        $objDrawing->setOffsetY(6);                
        //set width, height
        //$objDrawing->setWidth(163); 
        $objDrawing->setWidth(90); 
        $objDrawing->setHeight(45); 
        $objDrawing->setWorksheet($sheet);


        $sheet->setCellValue("A1", 'LIST OF INTERVENTIONS ' );
        $sheet->setCellValue("A2", 'Maked by:'.Auth::user()->name.'    Date:'.date('Y-m-d').'        Report period:'.$date_start.' : '.$date_end );
        $sheet->setCellValue("A4", 'Date');
        $sheet->setCellValue("B4", 'Type mentenance ');
        $sheet->setCellValue("C4", 'Intervention description');
        $sheet->setCellValue("D4", 'Inventory number machine');
        $sheet->setCellValue("E4", 'Type machine');
        $sheet->setCellValue("F4", 'Duration intervention (min)');
        $sheet->setCellValue("G4", 'Note');
        $sheet->setCellValue("H4", 'User');
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('A1')->getFont()->setBold( true );
       
        $bg = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '39B5FA'),
            )
        );
        $bg2 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'font' => [
                        'size' => 26
                        ]
            ),
            'borders'=>array(
                'style' => PHPExcel_Style_Border::BORDER_THICK,
                'color' => array('rgb' => '000000')
            ),
        );
       
        $sheet->getStyle("A4:H4")->getFont()->setSize(12);
        $sheet->getStyle("A4:H4")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $sheet->getStyle("A4:H4")->getFont()->setBold( true );
        $sheet->getStyle("A4:H4")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle("A4:H4")->applyFromArray($bg);
        $sheet->getStyle("A4:H4")->getAlignment()->setWrapText(true);
        $sheet->getColumnDimension('A')->setAutoSize(false);
        $sheet->getColumnDimension('A')->setWidth('12');
        $sheet->getColumnDimension('B')->setAutoSize(false);
        $sheet->getColumnDimension('B')->setWidth('18');
        $sheet->getColumnDimension('C')->setAutoSize(false);
        $sheet->getColumnDimension('C')->setWidth('15');
        $sheet->getColumnDimension('D')->setAutoSize(false);
        $sheet->getColumnDimension('D')->setWidth('15');
        $sheet->getColumnDimension('E')->setAutoSize(false);
        $sheet->getColumnDimension('E')->setWidth('18');
        $sheet->getColumnDimension('F')->setAutoSize(false);
        $sheet->getColumnDimension('F')->setWidth('13');
        
        
        $sheet->getStyle("A1")->applyFromArray($bg2);
        $sheet->getRowDimension(1)->setRowHeight(42);
        $sheet->getRowDimension(2)->setRowHeight(15);
        $sheet->getRowDimension(4)->setRowHeight(48);
        $rows = 5;
        $cnt = 0;
        $count_interv = count($interventions);
       
        while($rows< $count_interv+4){
              $cur_date = new DateTime($interventions[$cnt]->date); 
              $cur_hour = new DateTime($interventions[$cnt]->duration);
              $hours = $cur_hour->format('H');
              $minutes;
              if($hours !== '00'){
                $minutes = ($hours*60)+(int)$cur_hour->format('i');
              }else{
                $minutes = (int)$cur_hour->format('i');
              }

                 $sheet->setCellValue('A'.$rows,$cur_date->format('Y-m-d') );
              
            // $sheet->setCellValue('A'.$rows, substr($interventions[$cnt]->date, 0, 10));
            $sheet->setCellValue("B".$rows, $interventions[$cnt]->type_mentenance->name);
            $sheet->setCellValue("C".$rows, $interventions[$cnt]->intervention->name);
            $sheet->setCellValue("D".$rows, $interventions[$cnt]->device->inventory_number);
            $sheet->setCellValue("E".$rows, $interventions[$cnt]->device_type->name);
            $sheet->setCellValue("F".$rows, $minutes);
            $sheet->setCellValue("G".$rows, $interventions[$cnt]->note);
            $sheet->setCellValue("H".$rows, $interventions[$cnt]->user->name);
            $sheet->getRowDimension($rows)->setRowHeight(25);

            $sheet->getStyle('A4:H4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('A'.$rows)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('B'.$rows)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('C'.$rows)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('D'.$rows)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('E'.$rows)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('F'.$rows)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('G'.$rows)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('H'.$rows)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $rows++;
            $cnt++;
        }
            $sheet->getStyle('E'.$rows)->getFont()->setBold( true );
            $sheet->getStyle('E'.$rows)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
           
            $sheet->getStyle('F'.$rows)->getFont()->setBold( true );
            $sheet->getStyle('F'.$rows)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $sheet->getStyle('F'.($rows + (int)1))->getFont()->setBold( true );
            $sheet->getStyle('F'.($rows + (int)1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $sheet->getStyle('E'.($rows + (int)1))->getFont()->setBold( true );
            $sheet->getStyle('E'.($rows + (int)1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);




            $sheet->setCellValue('E'.$rows, "Total:");
            $sheet->setCellValue('E'.($rows + (int)1), "Count:");
          
            $sheet->setCellValue('F'.$rows, "=SUM(F5:E".($rows - (int)1).")");
            $sheet->setCellValue('F'.($rows + (int)1), ($rows-(int)5));
          ;
// Объединяем ячейки
        $sheet->mergeCells('A1:H1');
        $sheet->mergeCells('A2:H2');
        // Шрифт Times New Roman
        $sheet->getStyle('A1')->getFont()->setName('Arial');
        $sheet->getStyle('A2')->getFont()->setName('Arial');
         
        // Размер шрифта 18
        $sheet->getStyle("A1")->getFont()->setSize(24);
        $sheet->getStyle("A2")->getFont()->setSize(8);

        // По центру
        $sheet->getStyle("A1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A1")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $sheet->getStyle("A2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A2")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        // Выравнивание текста
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('G2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('H2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

       
        $xls->getActiveSheet()->getStyle(
            'A1:' .$xls->getActiveSheet()->getHighestColumn().$xls->getActiveSheet()->getHighestRow()
        )->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        ));
       
        // заголовки
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Interventions list.xls"');
        header('Cache-Control: max-age=0');

// Do your stuff here

        $writer = PHPExcel_IOFactory::createWriter($xls, 'Excel5');

// This line will force the file to download
        $writer->save('php://output');
    }
    public function filter_excell_report( Request $request){

        $interventions = $this->get_interventins($request->id_type_machine,
                                                 $request->user,
                                                 $request->type_mentenance_filter,
                                                 $request->device_filter,
                                                 $request->date_timepicker_start,
                                                 $request->date_timepicker_end,
                                                 $request->intervention_filter,
                                                 '',
                                                 false);
        
        $this->excell_generate($interventions,$request->date_timepicker_start,$request->date_timepicker_end);

    }

    public function show($id)
    {
        $type_mentenance = TypeMentenance::all();
        
        $type_machine = DeviceTypes::find($id);
        $diveces = Devices::where('id_type','=',$id)->get();
        $route = \Route::current();

        if($route->parameter('id_machine')){
           $machine = Devices::find($route->parameter('id_machine')); 
        }else{
            $machine = false;
        }
        
        $users = User::all();
        return view('interventions_list',['machine'=>$machine,'users'=>$users,'types_mentenance'=>$type_mentenance,'devices'=>$diveces,'id'=>$id,'type_machine'=>$type_machine]);
    }
    public function download_report (Request $request){

        $file = 'storage/admin/files/reports/'.basename($request->report_path);
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-disposition' => 'attachment; filename=result',
        ];
        return response()->download($file,basename($request->report_path), $headers);
    }
    public function report_generate_view (){
        $type_machine = DeviceTypes::all();
        return view('report_generate',['machines'=>$type_machine]);
    }
    public function generate_report(Request $request){
        $interventions = Interventions::where('id','>','0');
        if($request->date_interv_report_start !='' && $request->date_interv_report_end !=''){
            $interventions->date($request->date_interv_report_start,$request->date_interv_report_end);
        }
        if($request->type_machine_report != ''){
            $interventions->machinetype($request->type_machine_report);
        }
        $interventions_report = $interventions->orderBy('date','Desc')->get();
       

            $this->excell_generate($interventions_report,$request->date_interv_report_start,$request->date_interv_report_end);
    }

    public static function convert_from_latin1_to_utf8_recursively($dat)
    {
      if (is_string($dat)) {
         return utf8_encode($dat);
      } elseif (is_array($dat)) {
         $ret = [];
         foreach ($dat as $i => $d) $ret[ $i ] = self::convert_from_latin1_to_utf8_recursively($d);

         return $ret;
      } elseif (is_object($dat)) {
         foreach ($dat as $i => $d) $dat->$i = self::convert_from_latin1_to_utf8_recursively($d);

         return $dat;
      } else {
         return $dat;
      }
   }
    public function get_shuts(Request $request)
    {
        $info_interv = Interventions::where('id_machine','=',$request->machine)->orderBy('date','Desc')->first();
        $res = $this->convert_from_latin1_to_utf8_recursively($info_interv);

        return Response::json($res);
    }
}
