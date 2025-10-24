<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // index view
    public function index() {
        return view('pages.payments.index');
    }


    // create view
    public function create(){
        return view('pages.payments.create');
    }
    // create view
    public function show(){
        return view('pages.payments.show');
    }
    // create view
    public function payment(){
        return view('pages.payments.payment');
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
