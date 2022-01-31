<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    // con $fillable gli dico che campi deve avere il mio model
    protected $fillable = [
        'title',
        'image',
        'price',
        'series',
        'sales_date',
        'type',
        'description',
        'slug'
    ];
}
