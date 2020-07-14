<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use Notifiable;
    protected $table='products';
    protected $primaryKey='id';
    protected $fillable=[
        'name',
        'price',
        'imgFull',
    ];
}
