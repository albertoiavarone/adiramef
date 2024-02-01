<?php

namespace App\Http\Controllers\Geo\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Geo\Nation;
use App\Models\Geo\Province;
use App\Models\Geo\City;


class CityController extends Controller
{

    public function __construct(){
        $this->middleware('permission:geo_cities_r')->only('index');
        $this->middleware('permission:geo_cities_c')->only('create');
        $this->middleware('permission:geo_cities_c')->only('store');
        $this->middleware('permission:geo_cities_r')->only('show');
        $this->middleware('permission:geo_cities_u')->only('edit');
        $this->middleware('permission:geo_cities_u')->only('update');
        $this->middleware('permission:geo_cities_d')->only('delete');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

            $columnConfig = [];
            $columnConfig[] = ['data' => 'id', 'orderable'=>true];
            $columnConfig[] = ['data' => 'name', 'orderable'=>true,'searchable'=>true];
            $columnConfig[] = ['data' => 'province', 'orderable'=>true,'searchable'=>true];
            $columnConfig[] = ['data' => 'province_abbreviation', 'orderable'=>true];
            $columnConfig[] = ['data' => 'nation', 'orderable'=>true];
            $columnConfig[] = ['data' => 'code', 'orderable'=>true,'searchable'=>true];
            $columnConfig[] = ['data' => 'created_at', 'orderable'=>true];
            $columnConfig[] = ['data' => 'buttons', 'orderable'=>false];
            return view('geo.cities.index', compact('columnConfig'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nations= Nation::get();
        return view('geo.cities.create', compact('nations'));
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
            'province_id' => 'required|exists:provinces,id',
            'name' => 'required|string',
            'code' => 'nullable|string|max:10',
        ]);
        $province = Province::find($request->province_id);
        $city = City::create([
            'nation_id' => $province->nation_id,
            'province_id' => $province->id,
            'name' => $request->name,
            'code' => $request->code,
        ]);

        if($city) {
            return redirect()->route('cities.index')->with('success',__('general.success'));
        } else {
            return redirect()->route('cities.index')->with('error',__('general.error'));
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
        $city = City::find($id);
        return view('geo.cities.show', compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = City::find($id);
        $nations= Nation::get();
        $provinces= Province::where('nation_id',$city->nation_id)->get();
        return view('geo.cities.edit', compact('city','nations','provinces'));
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
            'province_id' => 'required|exists:provinces,id',
            'name' => 'required|string',
            'code' => 'nullable|string|max:10',
        ]);
        $province = Province::find($request->province_id);
        $city = City::find($id);
        $city->update([
                    'nation_id' => $province->nation_id,
                    'province_id' => $province->id,
                    'name' => $request->name,
                    'code' => $request->code,
                ]);

        if($city) {
            return redirect()->route('cities.index')->with('success',__('general.success'));
        } else {
            return redirect()->route('cities.index')->with('error',__('general.error'));
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
        $delete = City::find($id)->delete();

        if($delete) {
            return redirect()->route('cities.index')->with('success',__('general.success'));
        } else {
            return redirect()->route('cities.index')->with('error',__('general.error'));
        }
    }

    /**
    *
    *get province by nation id
    */
    public function getCitiesByProvince($province_id){
        $cities = City::where('province_id',$province_id)->get();
        return response()->json([
            'status' => true,
            'data' => $cities
        ]);
    }

    /*
    * list for datatable server side
    */
    public function allCities(Request $request)
    {

        $columns = array(
                            0 =>'id',
                            1 =>'name',
                            2=> 'province',
                            3=> 'province_abbreviation',
                            4=> 'nation',
                            5=> 'code',
                            6=> 'created_at',
                            7=> 'buttons',
                        );
        //dd($request);

        $totalData = City::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $cities = City::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }
        else {
            $search = $request->input('search.value');

            $cities =  City::where('name', 'LIKE',"%{$search}%")
                            ->orWhere('code', 'LIKE',"%{$search}%")
                            ->orWhereHas('province', function($q) use ($search){
                                return $q->where('name','LIKE',"{$search}");
                            })
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = City::where('name', 'LIKE',"%{$search}%")
                             ->orWhere('code', 'LIKE',"%{$search}%")
                             ->orWhereHas('province', function($q) use ($search){
                                 return $q->where('name','LIKE',"{$search}");
                             })
                             ->count();
        }

        $data = array();
        if(!empty($cities))
        {
            foreach ($cities as $city)
            {
                $show =  route('cities.show',$city->id);
                $edit =  route('cities.edit',$city->id);

                $nestedData['id'] = $city->id;
                $nestedData['name'] = $city->name;
                $nestedData['province'] = $city->province->name;
                $nestedData['province_abbreviation'] = $city->province->province_abbreviation;
                $nestedData['nation'] = $city->nation->countryName;
                $nestedData['code'] = $city->code;
                $nestedData['created_at'] = convertToLocal($city->created_at);
                $nestedData['buttons'] = view('geo.cities.tds.buttons',['city'=>$city])->render();
                $data[] = $nestedData;

            }
        }

        $json_data = array(
                    "draw"            => intval($request->input('draw')),
                    "recordsTotal"    => intval($totalData),
                    "recordsFiltered" => intval($totalFiltered),
                    "data"            => $data
                    );

        echo json_encode($json_data);

    }

}
