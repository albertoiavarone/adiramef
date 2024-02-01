<div class="card">
  <div class="card-header bg-light"><i class="fa fa-folder-open"></i> {{trans_choice('commercial.document',2)}}
  </div>
  <div class="card-body">

      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>{{__('general.created_at')}}</th>
              <th>{{__('general.label')}}</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($order->documents as $document)
            <tr>
              <td>{{ convertToLocal($document->created_at)}}</td>
              <td>{{ $document->label }}</td>
              <td>
                <div class="btn-group">
                  <a class="btn btn-sm btn-outline-secondary  btn-icon " target="_blank"
                     href="{{ asset('storage/'.$document->path) }}">
                     <i class="fa fa-download"></i>
                  </a>
                  <button type="button" class="btn btn-sm btn-outline-danger btn-icon" onclick="show_confirm_delete('training-document-delete-{{$document->uuid}}')"><i class="fa fa-trash"></i></button>

                </div>
                <form method="post" id="training-document-delete-{{$document->uuid}}" action="{{ route('order.attachment.delete',$document->uuid) }}">
                    @csrf
                    {{ method_field('DELETE') }}
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>
  </div>
