<?php

namespace App\Http\Controllers\User\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\User\UserDetail;
use App\Models\Geo\Nation;
use App\Models\Geo\Province;
use App\Models\Geo\City;
use App\Classes\Users;


class UserDetailController extends Controller
{

    public function __construct(){
        /*
        $this->middleware('permission:users_detail_r')->only('index');
        $this->middleware('permission:users_detail_c')->only('create');
        $this->middleware('permission:users_detail_c')->only('store');
        $this->middleware('permission:users_detail_r')->only('show');
        $this->middleware('permission:users_detail_u')->only('edit');
        $this->middleware('permission:users_detail_u')->only('update');
        $this->middleware('permission:users_detail_d')->only('delete');
        */
        $this->users = new Users();
    }


    /*
    *
    *
    */
    public function store(Request $request){

        $request->validate(["user_type" => 'required|string|in:retail,business,retail-freelance,business-pa']);
        $user_type = $request->user_type;

        $request->validate([
                  "surname" => 'required|string|max:255',
                  "name" => 'required|string|max:255',
                  "fiscal_code" => 'required|string|max:20',
                  "province_id" => 'required|exists:provinces,id',
                  "city_id" => 'required|exists:cities,id',
                  "postal_code" => 'required|string|max:10',
                  "address" => 'required|string|max:255',
                  "address_number" => 'required|string|max:255',
                  "phone_number" => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                  'route_callback' => 'nullable|string',
            ]);

        $user = User::where('uuid',$request->user_uuid)->firstOrFail();
        $province = Province::find($request->province_id);
        $is_default = true;

        $user_detail = UserDetail::create([
            "user_id" => $user->id,
            "label" => $request->name.' '.$request->surname,
            "nation_id" => $province->nation->id,
            "is_business" => 0,
            "is_freelance" => 0,
            "is_pa" => 0,
            "surname" => $request->surname,
            "name" => $request->name,
            "fiscal_code" => $request->fiscal_code,
            "province_id" => $request->province_id,
            "city_id" => $request->city_id,
            "postal_code" => $request->postal_code,
            "address" => $request->address,
            "address_number" => $request->address_number,
            "email" => $request->email,
            "phone_number" => $request->phone_number,
            "is_default" => $is_default,
        ]);

        if($user_detail){
            $user->update([
                'name' => $request->name.' '.$request->surname
            ]);
        }

        if($is_default){
            $others_user_details = UserDetail::where('user_id',$user->id)->where('id','!=',$user_detail->id)->get();
            foreach($others_user_details as $other){
                $other->is_default = 0;
                $other->save();
            }
        }

        if($user_detail) {
            $status = 'success';
            $msg = __('general.success');
        } else {
            $status = 'error';
            $msg = __('general.error');
        }

        //custom route resirect
        if($request->has('route_callback') ){
            return redirect()->route($request->route_callback)->with( $status , $msg );
        }

        if(auth()->user()->id == $user_detail->user_id){
            return redirect()->route('profile.edit')->with( $status , $msg );
        } else {
            return redirect()->route('users.edit',$user_detail->user->uuid)->with( $status , $msg );
        }

    }
    /*
    *  UPDATE record
    *
    */
    public function update(Request $request,$id){

        $request->validate(["user_type" => 'required|string|in:retail,business,retail-freelance,business-pa']);
        $user_type = $request->user_type;


        $request->validate([
                  "surname" => 'required|string|max:255',
                  "name" => 'required|string|max:255',
                  "fiscal_code" => 'required|string|max:20',
                  "province_id" => 'required|exists:provinces,id',
                  "city_id" => 'required|exists:cities,id',
                  "postal_code" => 'required|string|max:10',
                  "address" => 'required|string|max:255',
                  "address_number" => 'required|string|max:255',
                  "phone_number" => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                  'route_callback' => 'nullable|string',
            ]);

        $user_detail = UserDetail::findOrFail($id);
        $user = User::where('id',$user_detail->user_id)->firstOrFail();


        $is_default = true;


        $update = $user_detail->update([
            "label" => $request->label,
            "surname" => $request->surname,
            "name" => $request->name,
            "fiscal_code" => $request->fiscal_code,
            "province_id" => $request->province_id,
            "city_id" => $request->city_id,
            "postal_code" => $request->postal_code,
            "address" => $request->address,
            "address_number" => $request->address_number,
            "phone_number" => $request->phone_number,

        ]);

        if($update){
            $user->update([
                'name' => $request->name.' '.$request->surname
            ]);
        }


        if($is_default){
            $others_user_details = UserDetail::where('user_id',$user->id)->where('id','!=',$user_detail->id)->get();
            foreach($others_user_details as $other){
                $other->is_default = 0;
                $other->save();
            }
        }

        if($user_detail) {
            $status = 'success';
            $msg = __('general.success');
        } else {
            $status = 'error';
            $msg = __('general.error');
        }
        if(auth()->user()->id == $user_detail->user_id){
            return redirect()->route('profile.edit')->with( $status , $msg );
        } else {
            return redirect()->route('users.edit',$user_detail->user->uuid)->with( $status , $msg );
        }

    }
    /*
    *
    *
    */
    public function edit($id){
        $user_detail = UserDetail::findOrFail($id);
        $nations = Nation::get();
        $provinces = Province::where('nation_id',$user_detail->nation_id)->get();
        $cities = City::where('province_id',$user_detail->province_id)->get();
        $form_view = $this->users->getFormDetail($user_detail->uuid);
        return view('users.modals.edit_user_detail', compact('user_detail','nations','provinces','cities','form_view'));
    }
    /*
    *
    *
    */
    public function copy($uuid){

        $user_detail = UserDetail::where('uuid',$uuid)->firstOrFail();
        $new_user_detail = $user_detail->replicate();
        $new_user_detail->is_default = 0;
        $new_user_detail->created_at = \Carbon\Carbon::now();
        $new_user_detail->updated_at = \Carbon\Carbon::now();
        $new_user_detail->label = $user_detail->label.' '.__('general.copy');
        $new_user_detail -> save();

        if($new_user_detail) {
            $status = 'success';
            $msg = __('general.success');
        } else {
            $status = 'error';
            $msg = __('general.error');
        }

        if(auth()->user()->id == $user_detail->user_id){
            return redirect()->route('profile.edit')->with( $status , $msg );
        } else {
            return redirect()->route('users.edit',$user_detail->user->uuid)->with( $status , $msg );
        }

    }
    /*
    *
    *
    */
    public function destroy($uuid){

        $user_detail = UserDetail::where('uuid',$uuid)->firstOrFail();
        $delete = $user_detail->delete();
        if($delete  && $user_detail->is_default){
            $other_user_detail = UserDetail::where('user_id',$user_detail->user_id)->first();
            if($other_user_detail){
                $other_user_detail->is_default = 1;
                $other_user_detail->save();
            }
        }

        if($delete) {
            $status = 'success';
            $msg = __('general.success');
        } else {
            $status = 'error';
            $msg = __('general.error');
        }
        if(auth()->user()->id == $user_detail->user_id){
            return redirect()->route('profile.edit')->with( $status , $msg );
        } else {
            return redirect()->route('users.edit',$user_detail->user->uuid)->with( $status , $msg );
        }

    }
    /*
    *
    * load form for user details
    *
    */
    public function loadForm(Request $request){
        $request->validate([
            'action_type' => 'required|string|in:add,edit',
            'type' => 'required|string|in:retail,retail-freelance,business,business-pa',
            'uuid' => 'nullable|exists:user_details,uuid',
        ]);

        $user_detail = $nations = $provinces = $cities = [];
        if($request->has('uuid') && $request->action_type == 'edit'){
            $user_detail = UserDetail::where('uuid',$request->uuid)->firstOrFail();
            $nations = Nation::get();
            $provinces = Province::where('nation_id',$user_detail->nation_id)->get();
            $cities = City::where('province_id',$user_detail->province_id)->get();
        }
        $returnHTML = view('users.modals.form_user_details.'.$request->action_type.'.'.$request->type, compact('user_detail','nations','provinces','cities') )->render();
        return $returnHTML;

    }

//-------------------------
}
