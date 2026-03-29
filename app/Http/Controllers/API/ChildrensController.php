<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Children;
class ChildrensController extends Controller
{
   public function index()
   {
        $childrens = Children::all();
        return $childrens;
   }
}
