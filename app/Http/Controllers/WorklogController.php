<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorklogController extends Controller
{
    //
    public function workLog(){
        
        $request->validate([
            'id_employees' => 'required|exists:employees,id',
            'id_projects' => 'required|exists:projects,id',
            'tanggal' => 'required|date',
            'jam_masuk' => 'required|integer|min:1|max:8',
            'ketidakhadiran' => 'required',
        ]);

        Worklog::create([
            'id_employees' => $request->input('id_employees'),
            'id_projects' => $request->input('id_projects'),
            'tanggal' => $request->input('tanggal'),
            'jam_kerja' => $request->input('jam_kerja'),
            'ketidakhadiran' => $request->input('ketidakhadiran'),
        ]);
        return redirect()->back()->with('success','Work logged successfully');
    
    }

    // public function calculateTotalWork(){
    //     $totalWork = Worklog::where('id_employees',$request->id)
    //     ->sum('jam_kerja');

    //     $totalMonthOfWork = 


    // }
}
