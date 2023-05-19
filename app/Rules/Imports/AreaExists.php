<?php

namespace App\Rules\Imports;

use App\Models\Area;
use Illuminate\Contracts\Validation\Rule;

class AreaExists implements Rule
{
    public string $nombre;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Area::where('area', $this->nombre)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El área ' . $this->nombre . ' no existe';
    }
}
