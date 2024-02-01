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
                          {!! BootForm::text(__('general.code'),'code' )->id('code')->placeholder('es. ABC123')!!}
                      </div>
                      <div class="col-md-6">
                          {!! BootForm::text(trans_choice('commercial.ref_code',1),'ref_code' )->id('ref_code')->placeholder('es. ABC123')!!}
                      </div>
                      <div class="col-md-6">
                          {!! BootForm::text(__('general.name'),'name' )->id('name')->placeholder('es. Commessa Rossi ')!!}
                      </div>
                      <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('general.status') }}</label>
                                <select class="form-control" name="status" id="status">
                                    <option value=""></option>
                                    @forelse($order_statuses as $status)
                                    <option value="{{ $status->id }}">{{ __('commercial.status_'.$status->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                      </div>

                        <div class="col-md-6">
                            {!! BootForm::text(__('production.date_from'),'date_from' )->id('date_from')->class('form-control datepicker')->placeholder(__('general.select'))!!}
                        </div>
                        <div class="col-md-6">
                            {!! BootForm::text( __('production.date_to'),'date_to' )->id('date_to')->class('form-control datepicker')->placeholder(__('general.select'))!!}
                        </div>

                    </div>
                    {!! BootForm::hidden('filterData')->value('filterData') !!}
                {!! BootForm::close() !!}
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-primary" onclick="formFilter('{{route('allorders')}}');" >{{ __('general.search')}}</button>

                <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">{{__('general.close')}}</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        set_datepicker('date_from');
        set_datepicker('date_to');
        set_select2('status');
    });

    function formFilter(route,tableId){
            var Dtable =  $('#Orders').DataTable();
            var data = $('#Orders').DataTable().ajax.params();
            args = {
                date_from : $('#date_from').val(),
                date_to : $('#date_to').val(),
                code : $('#code').val(),
                ref_code : $('#ref_code').val(),
                name : $('#name').val(),
                status : $('#status').val(),
                filterData: 'true',
            };

            text = {
                date_from : $('#date_from').val(),
                date_to : $('#date_to').val(),
                code : $('#code').val(),
                ref_code : $('#ref_code').val(),
                name : $('#name').val(),
                status : $('#status option:selected').text(),
            };

            label = {
                date_from : '{{__('production.date_from')}}',
                date_to : '{{__('production.date_to')}}',
                code : '{{__('general.code')}}',
                ref_code : '{{ trans_choice('commercial.ref_code',1)}}',
                name : '{{__('general.name')}}',
                status : '{{__('general.status')}}',
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
