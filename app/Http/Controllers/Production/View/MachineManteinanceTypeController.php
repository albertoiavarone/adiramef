<?php

namespace App\Http\Controllers\Production\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Production\MachineManteinanceType;

class MachineManteinanceTypeController extends Controller
{
  public function __construct(){
      $this->middleware('permission:manteinance_types_r')->only('index');
      $this->middleware('permission:manteinance_types_c')->only('create');
      $this->middleware('permission:manteinance_types_c')->only('store');
      $this->middleware('permission:manteinance_types_u')->only('edit');
      $this->middleware('permission:manteinance_types_u')->only('update');
      $this->middleware('permission:manteinance_types_d')->only('delete');
  }
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $types = MachineManteinanceType::orderBy('name')->get();
      return view('production.manteinance_types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('production.manteinance_types.create');
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
          'name' => 'required|string',
          'active' => 'nullable|boolean',
      ]);

      $type = MachineManteinanceType::create([
              'name' => $request->name,
              'active' => $request->has('active') && $request->active ? 1 : 0,
      ]);
      if($type){
          return redirect()->route('manteinance-types.edit', $type->id)->with('success',__('general.success'));
      } else {
          return redirect()->route('manteinance-types.create')->with('error',__('general.error'));
      }
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
      $type = MachineManteinanceType::find($id);
      return view('production.manteinance_types.edit', compact('type'));
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
      $request->validate([
          'name' => 'required|string',
          'active' => 'nullable|boolean',
      ]);
      $type = MachineManteinanceType::find($id);
      $update = $type->update([
              'name' => $request->name,
              'active' => $request->has('active') && $request->active ? 1 : 0,
      ]);
      if($update){
          return redirect()->route('manteinance-types.edit', $type->id)->with('success',__('general.success'));
      } else {
          return redirect()->route('manteinance-types.create')->with('error',__('general.error'));
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $type = MachineManteinanceType::find($id);

      if($type->delete()){
          return redirect()->route('manteinance-types.index')->with('success',__('general.success'));
      } else {
          return redirect()->route('manteinance-types.index')->with('error',__('general.error'));
      }
    }
}
