    {!! BootForm::open()->id('schedule-form')!!}

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>{{ trans_choice('production.program', 1) }}</label>
                <select class="form-control" name="program" id="program">
                    <option value=""></option>
                    @forelse($machine->programs as $program)
                    <option value="{{ $program->id }}">{{ $program->name }} [{{ $program->ref_id }}]</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-8"></div>
        <div class="col-md-4">
            <div class="form-group">
                <label>{{ trans_choice('general.order', 1) }}</label>
                <select id="order" name="order_number"  required></select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>{{ trans_choice('production.piece', 2) }}</label>
                <input type="number" class="form-control"  name="item_to_produce" step=1 min=1 value=1 required></select>
            </div>
        </div>
    </div>
    <div class="row" id="box-options">
        <div class="col-md-4">
            <div class="form-group">
                <label>Barcode</label>
                <input type="text" class="form-control" name="barcodes[]" value="33123123132" placeholder="es L6124S" maxlength="32" required />
            </div>
        </div>
        <div class="col-md-8 mb-5">
            <button type="button" class="btn btn-outline-primary btn-sm mt-8" id="add-row"><i class="fa fa-plus"></i></button>
        </div>
    </div>
    <div class="row" id="box-options">
    </div>
    <hr />
    <button type="type" class="btn btn-primary btn-sm float-right"><i class="fa fa-save"></i> {{__('general.save')}}</button>
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <input type="hidden" name="uuid" value="{{ $machine->uuid }}" />
    {!! BootForm::close() !!}
    <div class="clearfix"></div>



    <script>
        $(document).ready(function(){
            let row = 1;
            set_select2('program');
            refreshInputRequired()

            $('#add-row').click(function(){
                $('#box-options').append(
                    '<div class="col-md-4 mb-5 block'+row+'">'+
                        '<input type="text" class="form-control uppercase" name="barcodes[]"  placeholder="es L6124S" maxlength="32"  required />'+
                    '</div>'+
                    '<div class="col-md-8 mb-5 block'+row+'">'+
                    '<button type="button" class="btn btn-outline-danger btn-sm" onclick="$(\'.block'+row+'\').remove()"><i class="fa fa-trash"></i></button>'+
                    '</div>'

                    );
            row++;
            });


        });

        //-----------------------------
        $('#order').select2({
            placeholder: "{{__('general.select')}}",
            width: "100%",
            allowClear: true,
            minimumInputLength: 3,
            language: {
                inputTooShort: function() {
                    return 'Digita almeno 3 caratteri...';
                }
            },
            ajax: {
                url: '{{ route('order.search.by.code') }}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    var query = {
                        term: params.term
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.text,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });
    //-------------------------------------------------------------

        $('#schedule-form').on('submit', function(e) {
               e.preventDefault();
               var program = $('#program').val();
               var path = $('#path').val();
               var section = $('#section').val();
               $.ajax({
                   type: "POST",
                   url: "{{ route('machine.save.schedule')}}",
                   data: $('#schedule-form').serialize(),
                   success: function( msg ) {
                       toastr.success('{{session('success')}}', '{{__('general.success')}}');
                       content_show('schedule');
                   }
               });
           });


</script>
