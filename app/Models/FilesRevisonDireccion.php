<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FilesRevisonDireccion extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'files_revison_direccions';

    protected $fillable = [
        'name',
        'revision_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function revision()
    {
        return $this->belongTo('App\Models\Minutasaltadireccion');
    }
}
