<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // index view
    public function index() {
        return view('pages.services.index');
    }



    // create view
    public function create(){
        return view('pages.services.create');
    }
    // create view
    public function show(){
        return view('pages.services.show');
    }
    // create view
    public function payment(){
        return view('pages.services.payment');
    }



    // store process
    public function store(Request $request){
        
    }
    


    // edit view
    public function edit($id){
        
    }


    
    // update process
    public function update(Request $request, $id){
        
    }
}
