
<div class="row">
    @if($manteinance->logs->count() > 0 )
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>{{ __('general.created_at')}}</th>
                        <th>{{ __('general.status')}}</th>
                        <th>{{ __('users.user')}}</th>
                        <th>{{ __('general.notes')}}</th>
                        <th>{{ trans_choice('documents.document',1)}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($manteinance->logs as $log)

                    <tr >
                        <td data-sort="{{ $log->created_at }}">{{ convertToLocal( $log->created_at ) }}</td>
                        <td>{!! view('production.manteinance.tds.status', ['manteinance' => $log ]  ) !!}</td>
                        <td>{{  $log->user->name  }}</td>
                        <td width="50%">{{  $log->notes  }}</td>
                        <td>
                            @if($log->path_doc)
                            <a class="btn btn-sm btn-outline-secondary  btn-icon " target="_blank"
                               href="{{ asset('storage/'.$log->path_doc) }}">
                               <i class="fa fa-download"></i>
                            </a>
                            @endif
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
