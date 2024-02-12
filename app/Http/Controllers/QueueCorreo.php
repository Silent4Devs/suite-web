<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Benchmark;
use Illuminate\Support\Facades\Mail;

class QueueCorreo extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Send welcome email
        for ($i = 0; $i < 1; $i++) {
            //Benchmark::dd(fn () => Mail::to('luis.vargas@silent4business.com')->queue(new TestMail()));
            Mail::to('luis.vargas@silent4business.com')->queue(new TestMail());
        }
        // Now, $data contains all the values from the Redis table
        dd('al ready sent');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
