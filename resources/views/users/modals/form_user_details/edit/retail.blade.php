
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('users.surname') }}</label>
            <input type="text" class="form-control" name="surname" value="{{ $user_detail->surname }}" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('users.name') }}</label>
            <input type="text" class="form-control" name="name"  value="{{ $user_detail->name }}" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('users.fiscal_code') }}</label>
            <input type="text" class="form-control" name="fiscal_code"  value="{{ $user_detail->fiscal_code }}" maxlength="20" required>
        </div>
    </div>

    <div class="col-md-8">
        <div class="form-group">
            <label>{{ __('users.address') }}</label>
            <input type="text" class="form-control" name="address" value="{{ $user_detail->address }}" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('users.address_number') }}</label>
            <input type="text" class="form-control" name="address_number" value="{{ $user_detail->address_number }}" required>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('geo.province')}}</label>
            <select class="form-control" name="province_id" id="edit_province_id" >
                <option value=""></option>
                @forelse($provinces as $province)
                   <option value="{{ $province->id }}" {{ $user_detail->province_id == $province->id ? 'selected' : '' }} >{{ $province->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('geo.city')}}</label>
            <select class="form-control" name="city_id" id="edit_city_id" required>
                <option value=""></option>
                @forelse($cities as $city)
                   <option value="{{ $city->id }}" {{ $user_detail->city_id == $city->id ? 'selected' : '' }} >{{ $city->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('users.postal_code') }}</label>
            <input type="text" class="form-control" name="postal_code" value="{{ $user_detail->postal_code }}" maxlength="10" required>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('users.email') }}</label>
            <input type="email" class="form-control" name="email" value="{{ $user_detail->email }}" readonly>
        </div>
    </div>

     <div class="col-md-4">
         <div class="form-group">
             <label>{{ __('users.phone_number') }}</label>
             <input type="text" class="form-control" name="phone_number" value="{{ $user_detail->phone_number }}" required>
         </div>
     </div>


    <input type="hidden" name="user_type" value="retail">
    <input type="hidden" name="uuid" value="{{ $user_detail->uuid }}">
