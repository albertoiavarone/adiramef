@extends('layout.app')
@section('title','Home')
@section('content')

    <div class="row">
        <div class="col-md-6">
            <h3 class="my-5"><i class="fas fa-mobile-alt"></i> {{__('messages.verify_phone_number')}}</h3>

            @if(session('error'))
                <h4 class="text-danger">{{session('error')}}</h4>
            @endif

            @if($res)
                <p>{{ __('messages.digit_code').auth()->user()->phone_number }}</p>
                {!!
                    BootForm::open()
                            ->action(route('phone-verify'))
                            ->post()
                            ->id('phone-code-verify-form')
                !!}

                    <div class="d-flex flex-wrap flex-stack">
                        <input type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" id="code1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2 font-size-h1" onkeyup="focus_to(2)" value="" required/>
                        <input type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" id="code2" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2 font-size-h1" onkeyup="focus_to(3)" value="" required/>
                        <input type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" id="code3" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2 font-size-h1" onkeyup="focus_to(4)" value="" required/>
                        <input type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" id="code4" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2 font-size-h1" onkeyup="focus_to(5)" value="" required/>
                        <input type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" id="code5" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2 font-size-h1" onkeyup="focus_to(6)" value="" required/>
                        <input type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" id="code6" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2 font-size-h1" onkeyup="focus_to(7)" value="" required/>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary" id="phone-code-verify-btn"><i class="fa fa-check-circle"></i> {{__('general.confirm')}}</button>
                    <input type="hidden" name="code" id="code">
                {!!
                    BootForm::close()
                !!}
            @endif
            <hr>
            @if($can_send)
                @if($res)
                    <p class="mt-5">{{__('messages.code_resend')}}</p>
                @else
                    <p class="mt-5">{{__('messages.code_send')}}</p>
                @endif
                {!!
                    BootForm::open()
                            ->action(route('phone-sendcode'))
                            ->post()
                !!}
                    <button type="submit" class="btn btn-info mt-5"><i class="fa fa-paper-plane"></i> {{__('general.send')}}</button>
                {!!
                    BootForm::close()
                !!}
            @else
                <h3 class=" text-center text-info mt-10"><i class="fas fa-exclamation-triangle"></i> {{ __('messages.code_send_blocked')}}</h3>
            @endif
        </div>
        <div class="col-md-6">
            <img class="img-fluid" src="{{ asset('assets/media/svg/illustrations/login-visual-5.svg')}}">
        </div>
    </div>
@endsection

@section('head')
    @parent

@endsection

@section('script')
    @parent
    <script>
      $('#phone-code-verify-btn').click(function(){
        var code = '';
        for(i=1;i<=6;i++){
          code+=parseInt($('#code'+i).val());
        }
        $('#code').val(code);
        $('#phone-code-verify-form').submit();
      });

      function focus_to(index){
        if(index<=6){
          $('#code'+index).focus();
        } else {
          $('#phone-code-verify-btn').focus();
        }
      }
    </script>
@endsection
