    <button class="btn btn-sm btn-outline-secondary mb-5" data-toggle="modal" data-target="#SCM-Schedule" ><i class="fa fa-info-circle"></i> Info</button>
    
    {!! BootForm::open()->id('schedule-form')!!}
    <div class="col-md-6 mb-5">
        <label>{{ __('general.name')}}</label>
        <input type="text" class="form-control" name="name"  placeholder="es Programma Alpha" maxlength="255" required />
    </div>
    <div class="row" id="box-options">
        <div class="col-md-6">
            <label>{{ trans_choice('production.program',1)}}</label>
        </div>
        <div class="col-md-4">
            <label>Path</label>
        </div>
        <div class="col-md-2">
            <label>Area</label>
        </div>
        
        <div class="col-md-4 mb-5">
            <input type="text" class="form-control" name="program[]"  placeholder="es L6124S" maxlength="255" required />
        </div>
        <div class="col-md-6 mb-5">
            <input type="text" class="form-control"  name="path[]" placeholder="es Y:\L6124S.pgmx" maxlength="255" required />
        </div>
        <div class="col-md-2 mb-5">
            <input type="text" class="form-control text-uppercase"  name="section[]" placeholder="es. A, B, -AD, etc" maxlength="3" required />
        </div>
    </div>
    <button type="button" class="btn btn-outline-warning btn-sm" id="add-row"><i class="fa fa-plus"></i> {{__('general.add')}}</button>
    <hr />
    <button type="type" class="btn btn-primary btn-sm float-right" id="add-row"><i class="fa fa-save"></i> {{__('general.save')}}</button>
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <input type="hidden" name="uuid" value="{{ $machine->uuid }}" />
    {!! BootForm::close() !!}
    <div class="clearfix">
        
    </div>
    
    

    
    <script>
        $(document).ready(function(){
            $('#add-row').click(function(){
                $('#box-options').append(
                    '<div class="col-md-4 mb-5">'+
                        '<input type="text" class="form-control uppercase" name="program[]" id="program"  placeholder="es L6124S" maxlength="255"  required />'+
                    '</div>'+
                    '<div class="col-md-6 mb-5">'+
                        '<input type="text" class="form-control" name="path[]"  id="path"  placeholder="es Y:\L6124S.pgmx"  maxlength="255" required />'+
                    '</div>'+
                    '<div class="col-md-2 mb-5">'+
                        '<input type="text" class="form-control text-uppercase"  name="section[]"  id="section" placeholder="es. A or B or D" maxlength="3" required />'+
                    '</div>'
                    );
            });
        });
        
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

    
    <!-- Modal Show-->
    <div class="modal fade" id="SCM-Schedule" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="SCM-Schedule"><strong class="text-primary">{{__('general.name') }}</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body" >
                    <h4>Per capirne di più...</h4>
                    <pre>
                        
                        Nel caso di una macchina con quattro aree (A,B,C,D) tutte libere, le righe:
                        …
                        [B]00034,“Beta.Pgm R=5”
                        [A]00035,“Alfa.Pgm -AB R=7”
                        [C]00036,“Gamma.Pgm R=10”
                        [D]00037,“Gamma.Pgm R=2”
                        …
                        determinano il caricamento di Beta.Pgm su B, Gamma.Pgm su C e D e l’accodamento di Alfa.Pgm in
                        attesa che si liberi B.
                    </pre>
                    
                    <h4>Esempio di codice generato</h4>
                    <pre>
                        [X]00101,00002,00000,00000
                
                        [Y]0
                        [Y]0
                        [Y]1
                
                        [X]00001,00001,00001,00000
                        [D]00001,"Y:\L6124S.pgmx"
                        [A]00002,"Y:\L2230N.pgmx"
                        [D]00003,"Y:\L5069s.pgmx"
                        [A]00004,"Y:\L5020s.pgmx"
                    </pre>
    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">{{__('general.close')}}</button>
                </div>
            </div>
        </div>
    </div>

    
    
