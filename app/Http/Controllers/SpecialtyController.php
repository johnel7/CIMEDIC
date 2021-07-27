<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Specialty;


class SpecialtyController extends Controller
{

     public function __construct()
     {
         $this->middleware('auth');
     }

    public function index()
    {
         $specialties = Specialty::all();
         return view('specialties.index', compact('specialties'));
    }

    public function create()
    {
         return view('specialties.create');
    }

    public function store(Request $request)
    {
         //dd($request->all());

         //VALIDACIONES DEL SERVIDOR
         $rules = [
              'name'=> 'required|min:5',
               //'description' => 'required'
         ];  
         $messages=[
                'name.required' => 'Es necesario ingresar el nombre',
                'name.min' => 'Como minimo el nombre debe tener 5 caracteres',
         ];
         $this->validate($request, $rules,$messages);

         $specialty = new Specialty();
         $specialty->name = $request->input('name');
         $specialty->description= $request->input('description');
         $specialty->save(); //INSERT
        
         return redirect('/specialties');
    }

    public function edit(Specialty $specialty)
    {
       return view('specialties.edit', compact('specialty'));
    }

    public function update(Request $request, Specialty $specialty)
    {
         //VALIDACIONES DEL SERVIDOR
         $rules = [
              'name'=> 'required|min:5',
               //'description' => 'required'
         ];  
         $messages=[
                'name.required' => 'Es necesario ingresar el nombre',
                'name.min' => 'Como minimo el nombre debe tener 5 caracteres',
         ];
         $this->validate($request, $rules,$messages);

         $specialty->name = $request->input('name');
         $specialty->description= $request->input('description');
         $specialty->save(); // UPDATE
        
         return redirect('/specialties');
    }
    
    public function destroy(Specialty $specialty)
    {
       $specialty->delete();
       return redirect('/specialties');
    }


}
