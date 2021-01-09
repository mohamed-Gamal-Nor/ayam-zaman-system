<?php

namespace App\Http\Controllers;

use App\Models\closingSalary;
use Illuminate\Http\Request;

class ClosingSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('salary.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\closingSalary  $closingSalary
     * @return \Illuminate\Http\Response
     */
    public function show(closingSalary $closingSalary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\closingSalary  $closingSalary
     * @return \Illuminate\Http\Response
     */
    public function edit(closingSalary $closingSalary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\closingSalary  $closingSalary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, closingSalary $closingSalary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\closingSalary  $closingSalary
     * @return \Illuminate\Http\Response
     */
    public function destroy(closingSalary $closingSalary)
    {
        //
    }
}
