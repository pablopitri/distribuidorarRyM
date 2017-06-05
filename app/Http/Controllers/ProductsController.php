<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->simplePaginate(15);
        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product;
        return view('products.create', ['product' => $product]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product;
        $product->code = $request->codigo;
        $product->name = $request->titulo;
        $product->price = $request->precio;
        $product->category = $request->categoria;
        $product->type = $request->tipo;
        $prod = Product::where('code', $request->codigo)->first();
        if (count($prod) < 1) {
            $hasFile = $request->hasFile('image') && $request->image->isValid();
            $image = 'images/no-image.jpg';

            if ($hasFile) {
                $image = "images/products/".uniqid().".".$request->image->extension();
                $url = public_path($image);
                $img = \Image::make($request->file('image'))->resize(200, 200);
                $product->image = $image;
            }
            if($product->save()){
                if ($hasFile)
                    $img->save($url);
                return redirect('/products');
            }
        }
        return view('products/create', ['product' => $product, 'notice' => "ERROR, EL CODIGO YA ESTÁ SIENDO UTILIZADO POR EL PRODUCTO $prod->name"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit', ['product' => $product]);
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
        $product = Product::find($id);
        $code = $product->code;
        $product->code = $request->codigo;
        $product->name = $request->titulo;
        $product->price = $request->precio;
        $product->category = $request->categoria;
        $product->type = $request->tipo;
        $prod = Product::where('code', $request->codigo)->first();
        if (count($prod) < 1 || $prod->code == $code) {
            $hasFile = $request->hasFile('image') && $request->image->isValid();
            $image = 'images/no-image.jpg';

            if ($hasFile) {
                $image = "images/products/".uniqid().".".$request->image->extension();
                $url = public_path($image);
                $img = \Image::make($request->file('image'))->resize(200, 200);
                $product->image = $image;
            }
            if($product->save()){
                if ($hasFile)
                    $img->save($url);
                return redirect('/products');
            }
        }
        return view('products/edit', ['product' => $product, 'notice' => "ERROR, EL CODIGO YA ESTÁ SIENDO UTILIZADO POR EL PRODUCTO $prod->name"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if($product->delete())
        {
            return redirect('/products');
        }
    }

    public function search($cod, $nombre, $categoria){
        $products = Product::orderBy('id', 'desc')
                            ->codigo($cod)
                            ->nombre($nombre)
                            ->categoria($categoria)
                            ->get();
        return response()->json($products);
    }
}
