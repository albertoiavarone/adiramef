<?php

namespace App\Http\Controllers\Geo\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Geo\Nation;

class NationController extends Controller
{
    public function __construct(){
        $this->middleware('permission:geo_nations_r')->only('index');
        $this->middleware('permission:geo_nations_c')->only('create');
        $this->middleware('permission:geo_nations_c')->only('store');
        $this->middleware('permission:geo_nations_r')->only('show');
        $this->middleware('permission:geo_nations_u')->only('edit');
        $this->middleware('permission:geo_nations_u')->only('update');
        $this->middleware('permission:geo_nations_d')->only('delete');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nations = Nation::get();
        return view('geo.nations.index',compact('nations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('geo.nations.create');
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
            'countryName' => 'required|string',
            'countryCode' => 'required|string|size:2',
            'currencyCode' => 'required|string|between:1,3',
            'continentName' => 'required|string|max:100',
            'continent' => 'required|string|size:2',
            'extra_ue' => 'boolean',
            'viesCode' => 'nullable|string|size:2',
            'isoAlpha3' => 'nullable|string|max:3',
            'isoNumeric' => 'nullable|string|max:3',
        ]);
        $extra_ue = 0;
        if($request->has('extra_ue') && $request->extra_ue == 1){
            $extra_ue = 1;
        }
        $nation = Nation::create([
            'countryName' => $request->countryName,
            'countryCode' => $request->countryCode,
            'currencyCode' => $request->currencyCode,
            'continentName' => $request->continentName,
            'continent' => $request->continent,
            'extraue' => $extra_ue,
            'viesCode' => $request->viesCode,
            'isoAlpha3' => $request->isoAlpha3,
            'isoNumeric' => $request->isoNumeric,
        ]);

        if($nation) {
            return redirect()->route('nations.index')->with('success', __('general.success'));
        } else {
            return redirect()->route('nations.index')->with('error',__('general.error'));
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
        $nation = Nation::find($id);
        return view('geo.nations.show', compact('nation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nation = Nation::find($id);
        return view('geo.nations.edit', compact('nation'));
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
            'countryName' => 'required|string',
            'countryCode' => 'required|string|size:2',
            'currencyCode' => 'required|string|between:1,3',
            'continentName' => 'required|string|max:100',
            'continent' => 'required|string|size:2',
            'extra_ue' => 'boolean',
            'viesCode' => 'nullable|string|size:2',
            'isoAlpha3' => 'nullable|string|max:3',
            'isoNumeric' => 'nullable|string|max:3',
        ]);

        $nation = Nation::find($id);
        $extra_ue = 0;
        if($request->has('extra_ue') && $request->extra_ue == 1){
            $extra_ue = 1;
        }
        $nation->update([
            'countryName' => $request->countryName,
            'countryCode' => $request->countryCode,
            'currencyCode' => $request->currencyCode,
            'continentName' => $request->continentName,
            'continent' => $request->continent,
            'extraue' => $extra_ue,
            'viesCode' => $request->viesCode,
            'isoAlpha3' => $request->isoAlpha3,
            'isoNumeric' => $request->isoNumeric,
        ]);
        if($nation) {
            return redirect()->route('nations.index')->with('success',__('general.success'));
        } else {
            return redirect()->route('nations.index')->with('error',__('general.error'));
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
        $delete = Nation::find($id)->delete();
        if($delete) {
            return redirect()->route('nations.index')->with('success',__('general.success'));
        } else {
            return redirect()->route('nations.index')->with('error',__('general.error'));
        }
    }
}
