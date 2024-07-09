<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistics extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'task_count'
    ];

    // statistic belong to user to be counted
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
