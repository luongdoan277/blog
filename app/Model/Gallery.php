<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Gallery extends Model
{
    use Notifiable;
    protected $table='gallery';
    protected $primaryKey='idGallery';
    protected $fillable=[
        'titleGallery',
        'descGallery',
        'imgFullNameGallery',
        'orderGallery',
    ];
}
