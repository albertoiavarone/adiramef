@extends('layout.app')
@section('title',trans_choice('notifications.notification', 2))
@section('page_name',trans_choice('notifications.notification', 2))
@section('content')



<h3 class="card-title">{{trans_choice('reports.report', 2)}}</h3>

<div class="alert alert-custom alert-secondary p-4" role="alert">
	<div class="alert-icon">
		<i class="flaticon-questions-circular-button"></i>
	</div>
	<div class="alert-text">{{ __('reports.notification_center_description') }}
        <button class="btn btn-sm btn-outline-primary float-right" data-toggle="modal" data-target="#newReportModal">
            <i class="fa fa-plus"></i> {{__('general.new').' '.trans_choice('reports.report',1)}}
        </button>
    </div>
</div>

<div class="table-responsive mt-5">
    <table id="reports" class="table  table-hover datatable">
        <thead class="thead-light">
            <tr>
               <th>{{__('general.date')}}</th>
			   <th>{{__('general.type')}}</th>
               <th>{{__('general.target')}}</th>
               <th>{{ trans_choice('reports.send_mode',1)}}</th>
               <th>{{__('general.recipient')}}</th>
               <th>{{ trans_choice('reports.rule',1)}}</th>
               <th>{{ __('reports.send_at')}}</th>
               <th class="no-sort"></th>
            </tr>
        </thead>
        <tbody>
            @forelse(auth()->user()->reports as $report)
            <tr>
                <td data-sort="{{ \Carbon\Carbon::parse($report->created_at)->format('YmdHis')}}">{{ convertToLocal($report->created_at)}}</td>
            	<td>{{ __('reports.'.$report->report->type)}}</td>
				<td>{{ $report->target }}</td>
                <td>{{ $report->send_mode }}</td>
                <td>
                    @forelse($report->recipients as $recipient)
                        {{ $recipient }}<br>
                    @endforeach
                </td>
                <td>{{ $report->rule }}</td>
                <td>
                    @forelse($report->action_times as $keytime)
                        <i class="fa fa-clock"></i> {{ $action_times[$keytime] }}<br>
                    @endforeach
					<br>
					<small>{{ $report->weekdays ? __('messages.only_weekdays') : __('messages.all_days') }}</small>
                </td>
                <td>
                    <button class="btn btn-sm btn-danger btn-icon" onclick="show_confirm_delete('report-user-delete-{{$report->uuid}}')"><i class="fa fa-trash"></i></button>
                    <form method="post" id="report-user-delete-{{$report->uuid}}" action="{{ route('user-reports.destroy',$report->uuid) }}">
                        @csrf
                        {{ method_field('DELETE') }}
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>





@endsection

@section('head')
    @parent
@endsection

@section('script')
    @parent

    @include('reports.shared.modal_new_report')

    <!-- DataTable init  -->
    @include('layout.basic.js.datatable')
@endsection
