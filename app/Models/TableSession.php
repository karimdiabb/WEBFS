<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableSession extends Model
{
    use HasFactory;

    protected $table = 'table_sessions';

    protected $fillable = [
        'TableID',
        'person_birthdates',
        'Deluxe_menu'
    ];

    public $timestamps = false;
}
