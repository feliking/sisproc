<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Colorant;

class ColorantController extends Controller
{
    public function main(){
        return view('colorant.main');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Colorant::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Colorant::create($request->all());
        return Colorant::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Colorant::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $colorant = Colorant::findOrFail($id);
        $colorant->fill($request->all());
        $colorant->save();
        return Colorant::all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $colorant = Colorant::findOrFail($id);
        $colorant->recipes()->detach();
        $colorant->delete();
    }
}
