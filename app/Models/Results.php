<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Results extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "results";
    protected $primaryKey = "id";

    protected $fillable = [
        'beverage_id', 'can_consume_beverage_id'
    ];
}