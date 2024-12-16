<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleModel extends Model
{
    use HasFactory;
    protected $table = 'schedules';

    protected $fillable = [
        'study',
        'day',
        'entry_time',
        'out_time',
        'user_id',
        'class_id'
    ];
    public $timestamps = false;

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }
}
