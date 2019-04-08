<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;

class ProductoController extends Controller
{
    public function index()
    {
        $productos=Producto::all();
        return view('admin.types.index')->with('productos',$productos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos=Producto::all();
        return view('admin.types.create')->with('productos',$productos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre' => 'required',
            'descripcion' => 'required',
            'categoria' => 'required',
            'stock' => 'required',
            'precio' => 'required',
        ]);

        $productos= new Producto;
        
        $productos->nombre=$request->input('nombre');
        $productos->descripcion=$request->input('descripcion');
        $productos->categoria=$request->input('categoria');
        $productos->stock=$request->input('stock');
        $productos->precio=$request->input('precio');
        
        $productos->save();
        
        return redirect('/productos')->with('message','El producto se guardó Satisfactoriamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productos=Producto::find($id);
        dd($productos);
        return view('/productos', ['productos'=>$productos]);
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
       $this->validate($request,[
            'nombre' => 'required',
            'descripcion' => 'required',
            'categoria' => 'required',
            'stock' => 'required',
            'precio' => 'required',
        ]);

        $productos=Producto::find($id);
        
        $productos->nombre=$request->input('nombre');
        $productos->descripcion=$request->input('descripcion');
        $productos->categoria=$request->input('categoria');
        $productos->stock=$request->input('stock');
        $productos->precio=$request->input('precio');
        
        $productos->save();
        
        return redirect('/productos')->with('message','El producto se actualizó Satisfactoriamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Producto::destroy($id);
        
        Session::flash('message', 'Eliminado Satisfactoriamente!');
        return Redirect::to('/productos');
    }
}
