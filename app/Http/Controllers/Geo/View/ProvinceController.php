<?php

namespace App\Http\Controllers\Geo\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Geo\Nation;
use App\Models\Geo\Province;

class ProvinceController extends Controller
{

    public function __construct(){
        $this->middleware('permission:geo_provinces_r')->only('index');
        $this->middleware('permission:geo_provinces_c')->only('create');
        $this->middleware('permission:geo_provinces_c')->only('store');
        $this->middleware('permission:geo_provinces_r')->only('show');
        $this->middleware('permission:geo_provinces_u')->only('edit');
        $this->middleware('permission:geo_provinces_u')->only('update');
        $this->middleware('permission:geo_provinces_d')->only('delete');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = Province::get();
        return view('geo.provinces.index', compact('provinces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nations= Nation::get();
        return view('geo.provinces.create', compact('nations'));
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
            'nation_id' => 'required|exists:nations,id',
            'name' => 'required|string',
            'province_abbreviation' => 'required|string|max:10',
            'region' => 'nullable|string|max:100',
        ]);

        $province = Province::create([
            'nation_id' => $request->nation_id,
            'name' => $request->name,
            'province_abbreviation' => $request->province_abbreviation,
            'region' => $request->region,
        ]);

        if($province) {
            return redirect()->route('provinces.index')->with('success',__('general.success'));
        } else {
            return redirect()->route('provinces.index')->with('error',__('general.error'));
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
        $province = Province::find($id);
        return view('geo.provinces.show', compact('province'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $province = Province::find($id);
        $nations= Nation::get();
        return view('geo.provinces.edit', compact('province','nations'));
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
            'nation_id' => 'required|exists:nations,id',
            'name' => 'required|string',
            'province_abbreviation' => 'required|string|max:10',
            'region' => 'nullable|string|max:100',
        ]);
        $province = Province::find($id);
        $province->update([
            'nation_id' => $request->nation_id,
            'name' => $request->name,
            'province_abbreviation' => $request->province_abbreviation,
            'region' => $request->region,
        ]);

        if($province) {
            return redirect()->route('provinces.index')->with('success',__('general.success'));
        } else {
            return redirect()->route('provinces.index')->with('error',__('general.error'));
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
        $delete = Province::find($id)->delete();

        if($delete) {
            return redirect()->route('provinces.index')->with('success',__('general.success'));
        } else {
            return redirect()->route('provinces.index')->with('error',__('general.error'));
        }
    }

    /**
    *
    *get province by nation id
    */
    public function getProvincesByNation($nation_id){
        $provinces = Province::where('nation_id',$nation_id)->get();
        return response()->json([
            'status' => true,
            'data' => $provinces
        ]);
    }
}
