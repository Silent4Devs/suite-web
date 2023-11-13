<?php

namespace App\Models\RH;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conducta extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'ev360_competencias_opciones';

    protected $appends = ['definicion_h'];

    protected $guarded = ['id'];

    public function getDefinicionHAttribute()
    {
        return strip_tags(html_entity_decode($this->definicion));
    }
}
