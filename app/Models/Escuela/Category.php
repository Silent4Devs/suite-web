<?php

namespace App\Models\Escuela;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class Category extends Model implements Auditable
{
    use ClearsResponseCache, HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $guarded = ['id'];

    public static function getAll()
    {
        return Cache::remember('Category:category_all', 3600 * 4, function () {
            return self::get();
        });
    }

    // Relacion uno a muchos
    public function courses()
    {
        return $this->hasMany('App\Models\Course');
    }
}
