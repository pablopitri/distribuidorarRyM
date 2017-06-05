<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Sale;

class SalesController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
        $this->middleware("admin")->except('create');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::orderBy('id', 'desc')->simplePaginate(15);
        return view('sales.index', ['sales' => $sales]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sale = new Sale;
        $num = Sale::count() ? Sale::all()->last()->id + 1 : 1;
        return view('sales.create', ['sale' => $sale, 'num' => $num, 'n' => 0]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store = new Sale;
        $store->id = Sale::count() ? Sale::all()->last()->id + 1 : 1;
        $store->user_id = Auth::user()->id;
        $total = 0;
        for ($i=$request->products; $i >=0 ; $i--) { 
            $total += $request->input("total-$i");
        }
        $store->total = $total;
        if($store->save())
        {
            for ($i=$request->products; $i >=0 ; $i--) { 
                $product_id = $request->input("id-$i");
                $store->products()->attach($product_id, ['quantity' => $request->input("cant-$i"), 'total' => $request->input("total-$i")]);
            }
            return redirect('/');
        }
        return view('sales.create', ['sale' => $sale, 'num' => $store->id, 'notice' => 'Error, no se puedo realizar la accion']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sale = Sale::find($id);
        return view('sales.show', ['sale' => $sale]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale = Sale::find($id);
        $sale->products()->detach();
        if($sale->delete())
        {
            return redirect('/sales');
        }
    }

    public function search($cod, $fecha, $vendedor)
    {
        $sales = Sale::with('user')
                        ->orderBy('id', 'desc')
                        ->codigo($cod)
                        ->fecha($fecha)
                        ->vendedor($vendedor)
                        ->get();
        return response()->json($sales);
    }

    public function boleta($cod){
        $sale = Sale::find($cod);
        return view('sales.boleta', ['sale' => $sale]);
    }
}
