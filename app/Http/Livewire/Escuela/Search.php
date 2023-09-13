<?php

namespace App\Http\Livewire\Escuela;

use Livewire\Component;

use App\Models\Escuela\Course;

class Search extends Component
{
    public $search;

    public function render()
    {
        return view('livewire.escuela.search');
    }


    public function getResultsProperty()
    {

        // Concatenar los % le indico que puede haber texto antes o despues
        return Course::where('title', 'LIKE', '%' . $this->search . '%')->where('status', 3)->take(8)->get();
    }
}
