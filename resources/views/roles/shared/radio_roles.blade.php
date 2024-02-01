@if($roles->count() > 1)
    <!--begin::Input group-->
    <div class="fv-row mb-5">
        <label class="form-label fw-bolder text-dark fs-6">{{ __('roles.role') }}</label>
        <div class="radio-list">
            @foreach($roles as $role)
                <label class="radio">
                <input type="radio" name="role" value="{{$role->name}}" required 
                {{ auth()->user() && auth()->user()->getRoleNames()[0] == $role->name ? 'checked' : ''}}
                />
                <span></span>{{__('roles.'.$role->name)}} </label>
            @endforeach
        </div>
    </div>
    <!--end::Input group-->
@endif
