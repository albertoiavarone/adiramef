@extends('layout.app')
@section('title',__('permissions.permissions'))

@section('content')
        <div class="card">
              <div class="card-body">
                  <h3 class="card-title">{{__('general.new')}} {{__('permissions.permission')}}</h3>
                  {!! BootForm::open()
                        ->action(route('permissions.store'))
                         ->id('form-create')
                         ->post()
                  !!}
                    {!! BootForm::text(__('permissions.group'), 'group')->required()->placeholder('es. role') !!}
                    {!! BootForm::checkbox(__('permissions.crud_create'),'crud',1)->id('crud')->class('mb-3') !!}
                    {!! BootForm::text(__('permissions.name'), 'name')->id('name')->required()->placeholder('es. role_c') !!}
                    {!! BootForm::text(__('permissions.description'), 'description')->required()->placeholder('es. create roles') !!}
                    {!! BootForm::text(__('permissions.guard_name'), 'guard_name')->required()->value('web') !!}

                    <hr class="mt-10">
                    <div class="btn-group float-right mt-10">
                        <a class="btn btn-secondary float-left" href="{{ route('permissions.index') }}"><i class="fa fa-arrow-circle-left"></i> Indietro</a>

                        <button type="submit" class="btn btn-outline-primary">
                            <i class="fa fa-save"></i> {{__('general.add')}}
                        </button>
                    </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
             {!! BootForm::close() !!}
@endsection

@section('head')
    @parent
@endsection

@section('script')
    @parent
    <script>
        $('#crud').click(function(){
            if($(this).is(':checked')){
                $('#name').prop('required',false).prop('readonly',true);
                //$('#name').prop('readonly',true);
                $('#name').val($('#group').val());

            } else {
                $('#name').prop('required',true).prop('readonly',false);
                $('#name').val('');
            }
        });
    </script>
@endsection
