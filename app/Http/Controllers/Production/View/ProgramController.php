<?php

namespace App\Http\Controllers\Production\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Production\Machine;
use App\Models\Production\Program;
use App\Helpers\Files;

class ProgramController extends Controller
{
  public function __construct(){
      $this->middleware('permission:programs_r')->only('index');
      $this->middleware('permission:programs_c')->only('create');
      $this->middleware('permission:programs_c')->only('store');
      $this->middleware('permission:programs_r')->only('show');
      $this->middleware('permission:programs_u')->only('edit');
      $this->middleware('permission:programs_u')->only('update');
      $this->middleware('permission:programs_d')->only('delete');
      $this->files = new Files();
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $machine_programs = Program::orderBy('name')->get();
      return view('production.machine_programs.index',compact('machine_programs'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      $machines = Machine::orderBy('name')->get();
      return view('production.machine_programs.create', compact('machines'));
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
          'machine' => 'required|exists:machines,id',
          'name' => 'required|string',
          'ref_id' => 'nullable|string|max:20',
          'description' => 'nullable|string',
          'uploaded_file' => 'nullable|max:2048'
      ]);
      $machine = Machine::find($request->machine);

      $check = Program::where('machine_id', $machine->id)->where('ref_id',$request->ref_id )->first();
      if($check){
        return redirect()->route('programs.index')->with('error',__('general.request_already_exists'));
      }

      $machine_program = Program::create([
          'name' => $request->name,
          'machine_id' => $machine->id,
          'ref_id' => $request->ref_id,
          'description' => $request->description,
      ]);
      if($machine_program) {
          return redirect()->route('programs.index')->with('success', __('general.success'));
      } else {
          return redirect()->route('programs.index')->with('error',__('general.error'));
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
    $machine_program = Program::where('uuid',$uuid)->firstOrFail();
    return view('production.machine_programs.show', compact('machine_program'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function edit($uuid)
   {
       $machine_program = Program::where('uuid',$uuid)->firstOrFail();
       $machines = Machine::orderBy('name')->get();
       return view('production.machine_programs.edit', compact('machine_program','machines'));
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
        'ref_id' => 'nullable|string|max:20',
        'description' => 'nullable|string',
    ]);


    $machine_program = Program::where('uuid', $uuid)->firstOrFail();

    $check = Program::where('machine_id', $machine_program->machine->id)->where('ref_id',$request->ref_id )->where('uuid','!=', $uuid)->first();
    if($check){
      return redirect()->route('programs.edit',$uuid )->with('error',__('general.request_already_exists'));
    }

    $update = $machine_program->update([
        'name' => $request->name,
        'ref_id' => $request->ref_id,
        'description' => $request->description,
    ]);

    if($update){
        return redirect()->route('programs.edit',$uuid)->with('success', __('general.success'));
    } else {
        return redirect()->route('programs.edit',$uuid)->with('error',__('general.error'));
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
       $delete = Program::where('uuid',$uuid)->delete();
       if($delete) {
           return redirect()->route('programs.index')->with('success',__('general.success'));
       } else {
           return redirect()->route('programs.index')->with('error',__('general.error'));
       }
   }
}
