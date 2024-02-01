<div class="modal fade" id="Modal-Filter" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white"><i class="fa fa-search text-white"></i> {{ trans_choice('general.filter',2) }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body" >
                {!! BootForm::open()->id('filter-form')->attribute('data-fncs','formFilter') !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ trans_choice('production.machine',1) }}</label>
                                <select class="form-control" name="machine_uuid" id="machine">
                                    <option value=""></option>
                                    @forelse($machines as $machine)
                                    <option value="{{ $machine->uuid }}">{{ $machine->type->name }} {{ $machine->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                          {!! BootForm::text(__('general.code'),'code' )->id('code')->placeholder('es. ABC123')!!}
						</div>


                        <div class="col-md-6">
                            {!! BootForm::text(__('production.date_from'),'date_from' )->id('date_from')->class('form-control datepicker')->placeholder(__('general.select'))!!}
                        </div>
                        <div class="col-md-6">
                            {!! BootForm::text( __('production.date_to'),'date_to' )->id('date_to')->class('form-control datepicker')->placeholder(__('general.select'))!!}
                        </div>
                        <div class="col-md-6">
                            {!! BootForm::text(__('production.time_from'),'time_from' )->id('time_from')->class('form-control')->placeholder(__('general.select'))!!}
                        </div>
                        <div class="col-md-6">
                            {!! BootForm::text(__('production.time_to'),'time_to' )->id('time_to')->class('form-control')->placeholder(__('general.select'))!!}
                        </div>
                    </div>
                    {!! BootForm::hidden('filterData')->value('filterData') !!}
                {!! BootForm::close() !!}
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-primary" onclick="formFilter('{{route('allworks')}}');" >{{ __('general.search')}}</button>

                <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">{{__('general.close')}}</button>
            </div>
        </div>
    </div>
</div>

@section('script')
  @parent
  <script>
      $(document).ready(function(){
          set_datepicker('date_from');
          set_datepicker('date_to');
          set_timepicker('time_from');
          set_timepicker('time_to');
          set_select2('machine');
          set_select2('program');
          set_select2('operator');
      });

      function formFilter(route,tableId){
              var Dtable =  $('#works').DataTable();
              var data = $('#works').DataTable().ajax.params();
              args = {
                  machine_uuid : $('#machine').val(),
                  program_uuid : $('#program').val(),
                  operator_uuid : $('#operator').val(),
                  date_from : $('#date_from').val(),
                  date_to : $('#date_to').val(),
                  time_from : $('#time_from').val(),
                  time_to : $('#time_to').val(),
				  code : $('#code').val(),
                  filterData: 'true',
              };

              text = {
                  machine : $('#machine option:selected').text(),
                  program : $('#program option:selected').text(),
                  operator : $('#operator option:selected').text(),
                  date_from : $('#date_from').val(),
                  date_to : $('#date_to').val(),
                  time_from : $('#time_from').val(),
                  time_to : $('#time_to').val(),
				  code : $('#code').val(),
              };

              label = {
                  machine : '{{trans_choice('production.machine',1)}}',
                  program : '{{trans_choice('production.program',1)}}',
                  operator : '{{trans_choice('production.operator',1)}}',
                  date_from : '{{__('production.date_from')}}',
                  date_to : '{{__('production.date_to')}}',
                  time_from : '{{__('production.time_from')}}',
                  time_to : '{{__('production.time_to')}}',
				  code : '{{__('general.code')}}',
              };

              var params = $.merge(args,data);
              Dtable.ajax.url(route + '?'+$.param(params));
              Dtable.draw();
              $('#Modal-Filter').modal('hide');
              $('#filters').html('<h4 class="text-primary"><i class="fa fa-filter"></i> {{ __('general.filtering_by')}}</h4>');

              var filters = 0;
              $.each( text, function( key, value ) {
                if(value){
                    filters++;
                  $('#filters').append('<button class="btn bg-light mr-4" onclick="filter_remove(\''+key+'\',\''+route+'\')"><strong>'+label[key]+':</strong> '+value+'<span class="ml-2" aria-hidden="true">&times;</span></button>')
                }
              });

              if(filters == 0) $('#filters').append('<p>{{__('general.no_filter')}}</p>');
      }
      function filter_remove(id,route){
          $("#"+id).val(null).trigger("change");
          formFilter(route);
      }
  </script>
@endsection
