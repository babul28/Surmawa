<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    public const ACTIVE = 1;
    public const DEACTIVE = 0;

    protected $guarded = [];
}
