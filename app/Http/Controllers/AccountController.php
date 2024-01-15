<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
   //
   public function index()
   {
    return view("pages.accounts.admin");
   }

   public function farmleaders()
   {
      return view("pages.accounts.farmleaders");
   }
   public function farmers()
   {
      return view("pages.accounts.farmers");
   }
}



