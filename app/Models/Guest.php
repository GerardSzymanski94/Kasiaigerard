<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = ['name', 'childrens', 'person', 'confirm', 'parents', 'side'];



}
