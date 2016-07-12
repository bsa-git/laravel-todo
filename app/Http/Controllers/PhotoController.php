<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * ['HTTP-METOD'=>'GET', 'PATH'=>'/photo', 'ACTION'=>'index', 'ROUTE-NAME'=>'photo.index']
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('photo.index', [
            'photo_action' => 'Action-GET(photo.index)',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * ['HTTP-METOD'=>'GET', 'PATH'=>'/photo/create', 'ACTION'=>'create', 'ROUTE-NAME'=>'photo.create']
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('photo.index', [
            'photo_action' => 'Action-GET(photo.create)',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * ['HTTP-METOD'=>'POST', 'PATH'=>'/photo', 'ACTION'=>'store', 'ROUTE-NAME'=>'photo.store']
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return view('photo.index', [
            'photo_action' => 'Action-POST(photo.store)',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * ['HTTP-METOD'=>'GET', 'PATH'=>'/photo/{photo}', 'ACTION'=>'show', 'ROUTE-NAME'=>'photo.show']
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('photo.index', [
            'photo_action' => 'Action-GET(photo.show)',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * ['HTTP-METOD'=>'GET', 'PATH'=>'/photo/{photo}/edit', 'ACTION'=>'edit', 'ROUTE-NAME'=>'photo.edit']
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('photo.index', [
            'photo_action' => 'Action-GET(photo.edit)',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * ['HTTP-METOD'=>'PUT/PATCH', 'PATH'=>'/photo/{photo}', 'ACTION'=>'update', 'ROUTE-NAME'=>'photo.update']
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return view('photo.index', [
            'photo_action' => 'Action-PUT(photo.update)',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * ['HTTP-METOD'=>'DELETE', 'PATH'=>'/photo/{photo}', 'ACTION'=>'destroy', 'ROUTE-NAME'=>'photo.destroy']
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return view('photo.index', [
            'photo_action' => 'Action-DELETE(photo.destroy)',
        ]);
    }
}
