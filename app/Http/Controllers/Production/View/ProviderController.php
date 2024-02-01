<?php

namespace App\Http\Controllers\Production\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Production\Provider;
use App\Helpers\Files;

class ProviderController extends Controller
{
    public function __construct(){
        $this->middleware('permission:providers_r')->only('index');
        $this->middleware('permission:providers_c')->only('create');
        $this->middleware('permission:providers_c')->only('store');
        $this->middleware('permission:providers_r')->only('show');
        $this->middleware('permission:providers_u')->only('edit');
        $this->middleware('permission:providers_u')->only('update');
        $this->middleware('permission:providers_d')->only('delete');
        $this->file = new Files();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Provider::where('status',1)->get();
        return view('production.providers.index',compact('providers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('production.providers.create');
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
          'class_name' => 'required|string',
          'option_keys.*' => 'nullable|string',
          'option_values.*' => 'nullable|string',
          'uploaded_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
          'geo_info' => 'nullable|boolean',
      ]);

      $geo_info = 0;
      if($request->geo_info){
          $geo_info = 1;
      }

      $options = [];
      if(!empty($request->option_keys) && !empty($request->option_values)){
          foreach($request->option_keys as $i => $value){
              if($value == '') continue;
              $options[$value] = $request->option_values[$i];
          }

      }
      $provider = Provider::create([
            'name' => $request->name,
            'class_name' => $request->class_name,
            'options' => $options,
            'geo_info' => $geo_info,
        ]);

      if($provider) {

          if($request->uploaded_file){
              $fileName = $this->file->uploadImage( $request->file('uploaded_file'),
                                          $path='providers',
                                          $filename = $provider->uuid,
                                          $resize=true,
                                          $w=300,
                                          $h='');
              if($fileName){
                  $provider->update([
                      'logo_path' => $fileName,
                  ]);
              }
          }
          return redirect()->route('providers.index')->with('success',__('general.success'));
      } else {
          return redirect()->route('providers.index')->with('error',__('general.error'));
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
        $provider = Provider::where('uuid',$uuid)->firstOrFail();
        return view('production.providers.edit', compact('provider'));
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
            'class_name' => 'required|string',
            'option_keys.*' => 'nullable|string',
            'option_values.*' => 'nullable|string',
            'uploaded_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'geo_info' => 'nullable|boolean',
        ]);
        
        $provider = Provider::where('uuid',$uuid)->firstOrFail();

        $geo_info = 0;
        if($request->geo_info){
            $geo_info = 1;
        }

        $options = [];
        if(!empty($request->option_keys) && !empty($request->option_values)){
            foreach($request->option_keys as $i => $value){
                if($value == '') continue;
                $options[$value] = $request->option_values[$i];
            }

        }

        if($provider) {
            $provider->update([
                'name' => $request->name,
                'class_name' => $request->class_name,
                'options' => $options,
                'geo_info' => $geo_info,
            ]);
            if($request->uploaded_file){
                $fileName = $this->file->uploadImage( $request->file('uploaded_file'),
                                            $path='providers',
                                            $filename = $provider->uuid,
                                            $resize=true,
                                            $w=300,
                                            $h='');
                if($fileName){
                    $provider->update([
                        'logo_path' => $fileName,
                    ]);
                }
            }
            return redirect()->route('providers.index')->with('success',__('general.success'));
        } else {
            return redirect()->route('providers.index')->with('error',__('general.error'));
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
        $delete = Provider::where('uuid',$uuid)->delete();
        if($delete) {
            return redirect()->route('providers.index')->with('success',__('general.success'));
        } else {
            return redirect()->route('providers.index')->with('error',__('general.error'));
        }
    }
}
