<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Desembolso\StoreDesembolsoRequest;
use App\Models\Desembolso;
use Illuminate\Http\Request;

class DesembolsoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDesembolsoRequest $request)
    {
        $request->validate();
    }

    /**
     * Display the specified resource.
     */
    public function show(Desembolso $desembolso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Desembolso $desembolso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Desembolso $desembolso)
    {
        //
    }
}
