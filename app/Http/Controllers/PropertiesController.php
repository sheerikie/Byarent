<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;
use App\Picture;
use Validator;


class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::latest()->paginate(5);
  
        return view('crud.index',compact('properties'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crud.create');
    }
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'type' => 'required',
            'price' => 'required',
        ]);

  
        $property=Property::create([
         'name' => request('name'),
         'description' => request('detail'),
         'type' => request('type'),
         'price' => request('price'),
        ]);
        if($request->input('image')){
        $rules = [];


        foreach($request->input('image') as $key => $value) {
            $rules["image.{$key}"] = 'required';
        }


        $validator = Validator::make($request->all(), $rules);


        if ($validator->passes()) {


            foreach($request->input('image') as $key => $value) {
                Picture::create(['pictures'=>$value,'property_id'=>$property->id]);
            }
        }
      }
        return redirect()->route('properties.index')
                        ->with('success','Property created successfully.');
    }
   
    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
       $pictures=Picture::where('property_id',$property->id)->get();
        return view('crud.show',compact('property','pictures'));
    }
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        return view('crud.edit',compact('property'));
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
  
        $property->update($request->all());
  
        return redirect()->route('properties.index')
                        ->with('success','Property updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        $property->delete();
  
        return redirect()->route('properties.index')
                        ->with('success','Property deleted successfully');
    }
 
}
