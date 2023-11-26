<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
class WorklogController extends Controller
{
    public function genereteDummyData()
    {
        $project = DB::table('projects')->get();
        $projectArr = [];
        foreach ($project as $key => $value) 
        {
            array_push($projectArr, $value->id);
        }

        $employee = DB::table('employees')->get();
        $employeeArr = [];
        foreach ($employee as $key => $value) 
        {
            array_push($employeeArr, $value->id);
        }

        $dateStart = '2023-11-26';
        for ($i = 1; $i < 121; $i++) {
            $projectId = array_rand($projectArr);
            $projectId = $projectArr[$projectId];
            //dd($projectArr[$projectId]);
            $employeeId = array_rand($employeeArr);
            $employeeId = $employeeArr[$employeeId];

            $tanggal = Carbon::parse($dateStart)->addDays($i);

            $startMorning = strtotime('07:00:00');
            $endMorning = strtotime('11:00:00');
            $morning = rand($startMorning, $endMorning);
            $morning = date('H:i:s', $morning);

            $startAfternoon = strtotime('12:00:00');
            $endAfternoon = strtotime('17:00:00');
            $afterNoon = rand($startAfternoon, $endAfternoon);
            $afterNoon = date('H:i:s', $afterNoon);

            $jam_awal = $morning;
            $jam_akhir = $afterNoon;

            DB::table('worklogs')->insert([
                'id_employees' => $employeeId,
                'id_projects' => $projectId,
                'tanggal' => $tanggal,
                'jam_awal' => $jam_awal,
                'jam_akhir' => $jam_akhir,
                'created_at' => null,
                'updated_at' => null,
            ]);
        }

        $data = DB::table('worklogs')->get();
       // dd($data);
    }

    public function index()
    {
        $project = DB::table('projects')->get();
        $employee = DB::table('employees')->get();
        return view('welcome',compact('project','employee'));
    }

    public function report(Request $request)
    {
        $period = CarbonPeriod::create($request->start_date, $request->end_date);
        $tgl = [];
        $tglArr = [];
        // Iterate over the period
        foreach ($period as $key => $date) {
            $tgl[$date->format('Y-m-d')] = [];
            array_push($tglArr, $date->format('Y-m-d'));
        }
        
        $loop = [];
        $data = [];
        foreach ($request->id_employee as $key => $value) 
        {
            $emp = DB::table('employees')->where('id',$value)->first();
            $loop[$value]['karyawan'] = $emp->nama_karyawan;
            $loop[$value]['tanggal'] = $tglArr;
            $loop[$value]['project'] = [];
            foreach ($request->id_project as $pKey => $pValue) 
            {
               $data[$value][$pValue] = [];
               $project = DB::table('projects')->where('id',$pValue)->first();
               $loop[$value]['project'][$pValue] = $project->nama_project;
            }
        }

        foreach ($data as $dataKey => $dataValue) 
        {
            foreach ($request->id_project as $pKey => $pValue) 
            {
                $data[$dataKey][$pValue] = $tgl;
            }
        }
        
        //dd($loop);
        foreach ($data as $key => $value) 
        {
            foreach ($value as $i => $v) 
            {
                foreach ($v as $k => $j) 
                {
                    //$key => id_karyawan
                    //$i => id_project
                    //$k => tanggal
                    $w = DB::table('worklogs')
                        ->where('id_employees',$key)
                        ->where('id_projects',$i)
                        ->where('tanggal',$k)
                        ->first();
                    if($w)
                    {
                        $time1 = strtotime($w->jam_awal);
                        $time2 = strtotime($w->jam_akhir);
                        $difference = round(abs($time2 - $time1) / 3600,2);
                        $data[$key][$i][$k] = round($difference);
                        if(round($difference) >= 8)
                        {
                            $data[$key][$i][$k] = ['value'=>1,'jam'=>round($difference),'awal'=>$w->jam_awal,'akhir'=>$w->jam_akhir];
                        }else{
                            $data[$key][$i][$k] = ['value'=>0.5,'jam'=>round($difference),'awal'=>$w->jam_awal,'akhir'=>$w->jam_akhir];
                        }
                    }else
                    {
                        $data[$key][$i][$k] = ['value'=>0,'jam'=>0,'awal'=>0,'akhir'=>0];
                    }
                }
                $data[$key][$i]['value'] = 0;
                $data[$key][$i]['jam'] = 0;
            }
        }

        foreach ($data as $key => $value) 
        {
            foreach ($value as $i => $v) 
            {
                $total = 0;
                $jam = 0;
                foreach ($v as $k => $j) 
                {
                    if(isset($data[$key][$i][$k]['value']))
                    {
                        $total += $data[$key][$i][$k]['value'];
                        $jam += $data[$key][$i][$k]['jam'];
                    }
                }
                $data[$key][$i]['value'] = $total;
                $data[$key][$i]['jam'] = $jam;   
            }
        }

        //  dd($data);
        return view('result',compact('data','loop','request'));
    }
}
