<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilesRevisonDireccion extends Model
{
    use HasFactory;


    protected $table = 'files_revison_direccions';

    protected $fillable = [
        'name',
        'revision_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function revision(){
        return $this->belongTo('App\Models\Minutasaltadireccion');
    }

    

}
