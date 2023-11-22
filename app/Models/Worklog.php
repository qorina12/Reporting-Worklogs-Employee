<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worklog extends Model
{
    use HasFactory;

    public $fillable = ['id_employees','id_projects','tanggal','jam_kerja','ketidakhadiran'];

    public function employee(){
        return $this->belongsTo(Employee::class,'id_employees');
    }

    public function project(){
        return $this->belongsTo(Project::class,'id_projects');
    }

    public function report(){
        return $this->hasMany(Report::class,'id_worklogs');
    }
}
