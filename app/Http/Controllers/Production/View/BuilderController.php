<?php

namespace App\Http\Controllers\Production\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Production\Builder;
use App\Helpers\Files;

class BuilderController extends Controller
{
    public function __construct(){
        $this->middleware('permission:builders_r')->only('index');
        $this->middleware('permission:builders_c')->only('create');
        $this->middleware('permission:builders_c')->only('store');
        $this->middleware('permission:builders_r')->only('show');
        $this->middleware('permission:builders_u')->only('edit');
        $this->middleware('permission:builders_u')->only('update');
        $this->middleware('permission:builders_d')->only('delete');
        $this->file = new Files();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $builders = Builder::get();
        return view('production.builders.index',compact('builders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('production.builders.create');
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
        $builder = Builder::create([
            'name' => $request->name,
        ]);
        if($builder) {
            if($request->uploaded_file){
                $fileName = $this->file->uploadImage( $request->file('uploaded_file'),
                                            $path='builders',
                                            $filename = $builder->uuid,
                                            $resize=true,
                                            $w=300,
                                            $h='');
                if($fileName){
                    $builder->update([
                        'logo_path' => $fileName,
                    ]);
                }
            }
            return redirect()->route('builders.index')->with('success', __('general.success'));
        } else {
            return redirect()->route('builders.index')->with('error',__('general.error'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        /*
        */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $builder = Builder::where('uuid',$uuid)->firstOrFail();
        return view('production.builders.edit', compact('builder'));
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
            'uploaded_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $builder = Builder::where('uuid',$uuid)->firstOrFail();

        if($builder) {
            $builder->update([
                'name' => $request->name,
            ]);
            if($request->uploaded_file){
                $fileName = $this->file->uploadImage( $request->file('uploaded_file'),
                                            $path='builders',
                                            $filename = $builder->uuid,
                                            $resize=true,
                                            $w=300,
                                            $h='');
                if($fileName){
                    $builder->update([
                        'logo_path' => $fileName,
                    ]);
                }
            }
            return redirect()->route('builders.index')->with('success',__('general.success'));
        } else {
            return redirect()->route('builders.index')->with('error',__('general.error'));
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
        $delete = Builder::where('uuid',$uuid)->delete();
        if($delete) {
            return redirect()->route('builders.index')->with('success',__('general.success'));
        } else {
            return redirect()->route('builders.index')->with('error',__('general.error'));
        }
    }
}
