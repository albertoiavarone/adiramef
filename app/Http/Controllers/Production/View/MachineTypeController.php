<?php

namespace App\Http\Controllers\Production\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Production\MachineType;
use App\Helpers\Files;


class MachineTypeController extends Controller
{
    public function __construct(){
        $this->middleware('permission:machine_types_r')->only('index');
        $this->middleware('permission:machine_types_c')->only('create');
        $this->middleware('permission:machine_types_c')->only('store');
        $this->middleware('permission:machine_types_r')->only('show');
        $this->middleware('permission:machine_types_u')->only('edit');
        $this->middleware('permission:machine_types_u')->only('update');
        $this->middleware('permission:machine_types_d')->only('delete');
        $this->file = new Files();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $machine_types = MachineType::get();
        return view('production.machine_types.index',compact('machine_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('production.machine_types.create');
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
            'uploaded_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $machine_type = MachineType::create([
            'name' => $request->name,
        ]);
        if($machine_type) {
            if($request->uploaded_file){
                $fileName = $this->file->uploadImage( $request->file('uploaded_file'),
                                            $path='machine_types',
                                            $filename = $machine_type->uuid,
                                            $resize=true,
                                            $w=300,
                                            $h='');
                if($fileName){
                    $machine_type->update([
                        'logo_path' => $fileName,
                    ]);
                }
            }
            return redirect()->route('machine-types.index')->with('success', __('general.success'));
        } else {
            return redirect()->route('machine-types.index')->with('error',__('general.error'));
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
     public function edit($uuid)
     {
         $machine_type = MachineType::where('uuid',$uuid)->firstOrFail();
         return view('production.machine_types.edit', compact('machine_type'));
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $request->validate([
            'name' => 'required|string',
            'uploaded_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $machine_type = MachineType::where('uuid',$uuid)->firstOrFail();
        if($machine_type) {
            $machine_type->update([
                'name' => $request->name,
            ]);
            if($request->uploaded_file){
                $fileName = $this->file->uploadImage( $request->file('uploaded_file'),
                                            $path='machine_types',
                                            $filename = $machine_type->uuid,
                                            $resize=true,
                                            $w=300,
                                            $h='');
                if($fileName){
                    $machine_type->update([
                        'logo_path' => $fileName,
                    ]);
                }
            }
            return redirect()->route('machine-types.index')->with('success',__('general.success'));
        } else {
            return redirect()->route('machine-types.index')->with('error',__('general.error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($uuid)
     {
         $delete = MachineType::where('uuid',$uuid)->delete();
         if($delete) {
             return redirect()->route('machine-types.index')->with('success',__('general.success'));
         } else {
             return redirect()->route('machine-types.index')->with('error',__('general.error'));
         }
     }
}
