<?php

namespace App\Models\RH;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Conducta extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table = 'ev360_competencias_opciones';

    protected $appends = ['definicion_h'];

    protected $guarded = ['id'];

    public function getDefinicionHAttribute()
    {
        return strip_tags(html_entity_decode($this->definicion));
    }
}
