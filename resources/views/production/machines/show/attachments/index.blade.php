<div class="card ">
    <div class="card-header">
        <h3 class="text-muted float-left">{{ trans_choice('commercial.attachment',2)}}</h3>
        <button type="button" class="btn btn-sn btn-outline-secondary float-right" data-toggle="modal" data-target="#Modal-Attachment-Add"><i class="fa fa-plus"></i> {{ __('general.add') }}</button>
    </div>
    <div class="card-body" id="box-loading">
        <div class="row">
            <div class="col-md-12">
                @if($machine->attachments->count() > 0 )
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-hover datatable">
                    <thead>
                    <tr>
                      <th>{{__('general.created_at')}}</th>
                      <th>{{__('general.name')}}</th>
                      <th>{{__('general.description')}}</th>
                      <th class="no-sort"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($machine->attachments as $attachment)
                        <tr>
                          <td>{{ convertToLocal($attachment->created_at) }}</td>
                          <td>{{ $attachment->label }}</td>
                          <td>{{ $attachment->description }}</td>
                          <td>
                            <a class="btn btn-sm btn-outline-secondary  btn-icon " target="_blank"
                                  href="{{ asset('storage/'.$attachment->path) }}"><i class="fa fa-download"></i>
                            </a>
                          </td>
                        </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                @else
                    <p class="text-muted">
                        {{ __('general.data_not_found')}}
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>

@include('layout.basic.js.datatable')
@include('production.machines.show.attachments.shared.modal_add')
