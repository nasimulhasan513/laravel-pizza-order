<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pizza;

class PizzaController extends Controller
{
    public function index()
    {
        // $pizzas = Pizza::all();
        // $pizzas = Pizza::orderBy('name','desc')->get();
        // $pizzas = Pizza::where('name','mario')->get();
        $pizzas= Pizza::latest()->get();

        return view('pizzas.index',[
            'pizzas'=>$pizzas
        ]);
    }
    public function show($id)
    {
        $pizza = Pizza::findOrFail($id);

        return view('pizzas.show', ['pizza' => $pizza]);
    }
    public function create(){
        return view('pizzas.create');
    }
    public function store(){

        $pizza = new Pizza();

        $pizza->name = request('name');
        $pizza->base= request('base');
        $pizza->type = request('type');
        $pizza->toppings = request('toppings');

        $pizza->save();

        return redirect('/')->with('msg','Thanks for your order');
    }
}
