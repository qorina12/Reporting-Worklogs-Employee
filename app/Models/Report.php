<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = ['id_worklogs','nilai'];

    public function worklog(){
        return $this->belongsTo(Worklog::class,'id_worklogs');
    }

}
