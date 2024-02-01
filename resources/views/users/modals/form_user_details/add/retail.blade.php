
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('users.surname') }}</label>
            <input type="text" class="form-control" name="surname" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('users.name') }}</label>
            <input type="text" class="form-control" name="name" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('users.fiscal_code') }}</label>
            <input type="text" class="form-control" name="fiscal_code" maxlength="20" required>
        </div>
    </div>

    <div class="col-md-8">
        <div class="form-group">
            <label>{{ __('users.address') }}</label>
            <input type="text" class="form-control" name="address" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('users.address_number') }}</label>
            <input type="text" class="form-control" name="address_number" required>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('geo.province')}}</label>
            <select class="form-control" name="province_id" id="province_id" >
                <option value=""></option>
                @forelse($provinces as $province)
                   <option value="{{ $province->id }}">{{ $province->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('geo.city')}}</label>
            <select class="form-control" name="city_id" id="city_id" required>
                <option value=""></option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('users.postal_code') }}</label>
            <input type="text" class="form-control" name="postal_code" maxlength="10" required>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('users.email') }}</label>
            <input type="email" class="form-control" name="email" value="{{ $user->email}}" readonly>
        </div>
    </div>
     <div class="col-md-4">
         <div class="form-group">
             <label>{{ __('users.phone_number') }}</label>
             <input type="text" class="form-control" name="phone_number" {{ config('values.USER_PHONE_VERIFY') && !auth()->user()->phone_number_verified ? 'required':''}}>
         </div>
     </div>
     <div class="col-md-4"></div>

    <input type="hidden" name="user_type" value="retail">
