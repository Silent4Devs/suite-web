<?php

namespace App\Models;

use DateTimeInterface;
use App\Traits\ClearsResponseCache;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model implements Auditable
{
    use SoftDeletes, HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    public $table = 'permissions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static function getAll()
    {
        return Cache::remember('Permissions:permissions_all', 3600 * 13, function () {
            return self::get();
        });
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
