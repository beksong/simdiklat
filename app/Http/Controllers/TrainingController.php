<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TrainingRequest;
use App\Training;
use App\Pic;
use DataTables;
use Carbon\Carbon;
use Grei\TanggalMerah;
use App\Participant;
use PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class TrainingController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        return view('training.index');
    }

    public function store(TrainingRequest $request)
    {
        $pic=\Auth::user()->pic()->get();
        if($pic->isEmpty()){
            return redirect()->back()->with('message','Anda Tidak Bukan PIC,tidak dapat menyimpan data');
        }
        $start_date=Carbon::parse($request->get('start_date'));
        //check weekend
        if($start_date->isWeekend()){
            return redirect()->back()->with('message','Hari Minggu tidak bisa dipilih sebagai hari pertama diklat');
        }
        
        $isHoliday = new TanggalMerah();
        //check tanggal merah nasional 
        $isHoliday->set_date($start_date);

        if($isHoliday->is_holiday()){
            return redirect()->back()->with('message','Hari Libur Nasional tidak bisa dipilih sebagai hari pertama diklat');
        }
        // loop mencari libur nasional dari period
        for ($i=0; $i < $request->get('period') ; $i++) {
            $end_date=$start_date->addDays(1);
            // check weekend
            if($end_date->isWeekend()){
                $end_date=$end_date->addDays(1);
            }
            // check hari libur nasional
            $isHoliday->set_date($end_date);
            if($isHoliday->is_holiday()){
                $end_date=$end_date->addDays(1);
            }
        }

        //return $request->all();
        $training = new Training(array(
            'name' => $request->get('name'),
            'slug' => str_slug($request->get('name')),
            'period' => $request->get('period'),
            'start_date' => $request->get('start_date'),
            'description' => $request->get('description'),
            'pic_id' => $pic[0]->id,
            'end_date' => $end_date
        ));
        
        $training->save();
        return redirect()->back()->with('message','Data telah disimpan');
    }

    public function edit(TrainingRequest $request)
    {
        $training = Training::find($request->get('training_id'));
        $start_date= Carbon::parse($request->get('start_date'));
        //check weekend
        if($start_date->isWeekend()){
            return redirect()->back()->with('message','Hari Minggu tidak bisa dipilih sebagai hari pertama diklat');
        }
        $isHoliday = new TanggalMerah();
        $isHoliday->set_date($start_date);
        if($isHoliday->is_holiday()){
            return redirect()->back()->with('message','Hari Libur Nasional tidak bisa dipilih sebagai hari pertama diklat');
        }
        // loop mencari libur nasional dari period
        for ($i=0; $i < $request->get('period') ; $i++) {
            $end_date=$start_date->addDays(1);
            // check weekend
            if($end_date->isWeekend()){
                $end_date=$end_date->addDays(1);
            }
            // check hari libur nasional
            $isHoliday->set_date($end_date);
            if($isHoliday->is_holiday()){
                $end_date=$end_date->addDays(1);
            }
        }
        $training->update([
            'name' => $request->get('name'),
            'slug' => str_slug($request->get('name')),
            'period' => $request->get('period'),
            'start_date' => $request->get('start_date'), //we are not going update this one
            'description' => $request->get('description'),
            // 'pic_id' => $pic[0]->id, we are not going update the pic on update
            'end_date' => $end_date
        ]);

        return redirect()->back()->with('message','Data telah dirubah');
    }

    public function destroy(Request $request)
    {
        $training = Training::find($request->get('training_id'));
        $training->delete();

        return redirect()->back()->with('message','Data telah dihapus');
    }

    public function getTrainings()
    {
        $trainings=Training::with(['Pic'=>function($query){
            $query->with('Institution')->get();
        }])->orderBy('start_date','asc')->get();

        return DataTables::of($trainings)
        ->addColumn('schedule',function($training){
            return view('training.tbschedule',compact('training'));
        })->addColumn('printschedules',function($training){
            if($training->masterschedules->isEmpty()){
                return 'Belum Ada Jadwal';
            }else{
                return '<a href="printschedules/'.$training->id.'" class="badge bg-green"><i class="fa fa-print"></i> Print Jadwal</a>';
            }
        })->addColumn('action',function($training){
            return view('training.tbbutton',compact('training'));
        })->addColumn('startingdate',function($training){
            return Carbon::parse($training->start_date)->format('d-m-Y');
        })->addColumn('enddate',function($training){
            return Carbon::parse($training->end_date)->format('d-m-Y');
        })->rawColumns(['printschedules','schedule','action','startingdate','enddate'])->toJson();
    }

    // here for admin to get data of participant and currently running trainings
    public function traininglist()
    {
        return view('training.opentraining.index');
    }

    public function getregisteredparticipants(Request $request)
    {
        $trainings = Training::with(['Pic'=>function($query){
            $query->with('Institution');
        }])->Where('end_date','>',Carbon::now(-7))->orderBy('start_date','asc')->get();
        
        return DataTables::of($trainings)
        ->addColumn('participant',function($training){
            return view('training.opentraining.tbbutton',compact('training'));
        })->addColumn('startingdate',function($training){
            return Carbon::parse($training->start_date)->format('d-m-Y');
        })->addColumn('enddate',function($training){
            return Carbon::parse($training->end_date)->format('d-m-Y');
        })->rawColumns(['participant','startingdate','enddate'])->toJson();
    }

    // here for admin to get last training and the participant that already closed
    public function closedtraininglist()
    {
        return view('training.opentraining.closedtraininglist');
    }

    public function getclosedtraininglist()
    {
        $trainings = Training::with(['Pic'=>function($query){
            $query->with('Institution');
        }])->Where('end_date','<',Carbon::now(-7))->orderBy('start_date','asc')->get();
        
        return DataTables::of($trainings)
        ->addColumn('participant',function($training){
            return view('training.opentraining.tbbutton',compact('training'));
        })->addColumn('startingdate',function($training){
            return Carbon::parse($training->start_date)->format('d-m-Y');
        })->addColumn('enddate',function($training){
            return Carbon::parse($training->end_date)->format('d-m-Y');
        })->rawColumns(['participant','startingdate','enddate'])->toJson();
    }

    // admin get registered participants
    public function showparticipants($training_id)
    {
        $training = Training::find($training_id);
        return view('training.opentraining.showparticipants',compact('training'));
    }

    // get allready registered participant for admin datatables
    public function getalreadyregisteredparticipants(Request $request)
    {
        $participants = Participant::with('user')->where('training_id',$request->get('q'))->get();
        return DataTables::of($participants)
        ->addColumn('requirementsdocs',function($participant){
            return '<a href="../../storage/requirement/'.$participant->requirements.'">'.$participant->requirements.'</a>';
        })->addColumn('abstractfile',function($participant){
            if($participant->properabstract=='belum ada data'){
                return 'belum ada data';
            }else{
                return '<a href="storage/proper/'.$participant->properabstract.'">'.$participant->properabstract.'</a>';
            }
        })->addColumn('docsfile',function($participant){
            if ($participant->properdocs=='belum ada data') {
                return 'belum ada data';
            } else {
                return '<a href="storage/proper/'.$participant->properdocs.'">'.$participant->properdocs.'</a>';
            }
        })
        ->addColumn('action',function($participant){
            return view('training.opentraining.tbbuttonparticipant',compact('participant'));
        })->rawColumns(['requirementsdocs','abstractfile','docsfile','action'])->toJson();
    }

    // get trainings list for admin select2
    public function gettraininglist(Request $request)
    {
        $data = trim($request->get('q'));
        $trainings = Training::where('name','like',"%{$data}%")->get();
        return json_decode($trainings);
    }

    /**
     * here is where admin wanna enrole or giving role a participant to custom training
     * update participant from one training to others
     */
    public function updateparticipantbyadmin(Request $request)
    {
        $p = Participant::find($request->get('participant_id'));

        $p->update([
            'training_id' => $request->get('training_id')
        ]);

        return redirect()->back()->with('message','Berhasil merubah data');
    }

    public function deleteparticipantbyadmin(Request $request)
    {
        $p=Participant::find($request->get('participant_id'));
        $p->delete();
        return redirect()->back()->with('message','Berhasil menghapus data');
    }

    /**
     * here is admin print participant and create absent
     */
    public function printparticipantsbyadmin($training_id)
    {
        $training=Training::find($training_id);
        $participants = Participant::where('training_id',$training_id)->orderBy('fullname','asc')->get();
        $pdf = PDF::loadView('report.training.participant-absen',compact('participants','training'));
        $pdf->setOrientation('portrait');
        return $pdf->download('absen_'.$training->name.'_'.Carbon::now().'_'.'.pdf');
        //return view('report.training.participant-absen',compact('participants','training'));
    }
    /**
     * here is admin export participant data into excel
     */
    public function exportparticipantsbyadmin($training_id)
    {
        $training=Training::find($training_id);
        $participants = Participant::where('training_id',$training_id)->get();
        if($participants->isEmpty()){
            return redirect()->back()->with('message','Belum Ada Peserta');
        }
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->setTitle('Data Peserta');
        $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A1', 'no')
        ->setCellValue('B1', 'nama lembaga diklat')
        ->setCellValue('C1', 'nama instansi')
        ->setCellValue('D1', 'jenis peserta')
        ->setCellValue('E1', 'jenis identitas')
        ->setCellValue('F1', 'nomor identitas')
        ->setCellValue('G1', 'nip')
        ->setCellValue('H1', 'nrp')
        ->setCellValue('I1', 'nama')
        ->setCellValue('J1', 'tempat lahir')
        ->setCellValue('K1', 'tanggal lahir')
        ->setCellValue('L1', 'jenis kelamin')
        ->setCellValue('M1', 'agama')
        ->setCellValue('N1', 'pangkat')
        ->setCellValue('O1', 'golongan')
        ->setCellValue('P1', 'alamat')
        ->setCellValue('Q1', 'alamat kantor')
        ->setCellValue('R1', 'no telp kantor');

        foreach ($participants as $key => $p) {
            $pangkat = explode(",",$p->rank);
            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A'.($key+2), $key+1)
            ->setCellValue('B'.($key+2), 'Badan Pengembangan Sumber Daya Manusia Provinsi Sulawesi Tengah')
            ->setCellValue('C'.($key+2), $p->institution)
            ->setCellValue('D'.($key+2), $p->participant_type)
            ->setCellValue('E'.($key+2), '')
            ->setCellValue('F'.($key+2), '')
            ->setCellValue('G'.($key+2), " ".$p->user->nip)
            ->setCellValue('H'.($key+2), '')
            ->setCellValue('I'.($key+2), $p->frontdegree.' '.$p->fullname.','.$p->backdegree)
            ->setCellValue('J'.($key+2), $p->user->place_birth)
            ->setCellValue('K'.($key+2), $p->user->date_birth)
            ->setCellValue('L'.($key+2), $p->user->gender=='Laki-laki' ? 'L' : 'P')
            ->setCellValue('M'.($key+2), $p->religion)
            ->setCellValue('N'.($key+2), $pangkat[0])
            ->setCellValue('O'.($key+2), strtoupper($pangkat[1]))
            ->setCellValue('P'.($key+2), $p->user->address)
            ->setCellValue('Q'.($key+2), $p->institution_address)
            ->setCellValue('R'.($key+2), $p->institution_phone);
        }


        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$training->slug.'.xls"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xls');
        $writer->save('php://output');
    }

    public function printmasterschedules($id)
    {
        $training = Training::find($id);
        $pdf = PDF::loadView('report.schedules.masterschedule',compact('training'));
        $pdf->setOrientation('landscape');
        return $pdf->download('Jadwal'.$training->name.'_'.Carbon::now().'_'.'.pdf');
    }
}
