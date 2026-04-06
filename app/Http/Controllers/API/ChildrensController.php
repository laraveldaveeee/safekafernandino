<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Children;

class ChildrensController extends Controller
{
   public function index()
   {
        $childrens = Children::with('guardian')->get();
        return $childrens;
   }

   public function store(Request $request)
   {

      $this->validate(request(), [
         'name'   => 'required',
         'email'   => 'required',
         'gender'   => 'required',
         'birthdate'   => 'required',
         'current_latitude'   => 'required',
         'current_longitude'   => 'required',
      ]);
       $children = Children::create([
         'name'   => request('name'),
         'email'   => request('email'),
         'gender'   => request('gender'),
         'birthdate'   => request('birthdate'),
         'current_latitude'   => request('current_latitude'),
         'current_longitude'   => request('current_longitude'),
         'last_reported_at'   => request('last_reported_at'),
      ]);


       return $children;
   }
}
