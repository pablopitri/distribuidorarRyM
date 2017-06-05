<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;

class MainController extends Controller
{
	public function __construct()
  {
      $this->middleware("auth");
  }

  public function home()
  {
  	$sale = new Sale;
  	$num = Sale::count() ? Sale::all()->last()->id + 1 : 1;
  	return view('sales.create', ['sale' => $sale, 'num' => $num, 'n' => 0]);
  }
}
