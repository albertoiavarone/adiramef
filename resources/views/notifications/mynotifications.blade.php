@extends('layout.app')
@section('title',trans_choice('notifications.notification', 2))
@section('page_name',trans_choice('notifications.notification', 2))
@section('content')


        <div class="card">
          <div class="card-body">
              <h3 class="card-title">{{trans_choice('notifications.notification', 2)}}</h3>
              <table id="notifications" class="table  table-hover datatable">
                  <thead class="thead-light">
                  <tr>
                    <th>{{__('general.date')}}</th>
                    <th>{{__('general.type')}}</th>
                    <th>{{__('general.label')}}</th>
                    <th></th>
                    <th class="no-sort"></th>
                  </tr>
                  </thead>
                  <tbody>
                      @forelse(auth()->user()->notifications as $notification)
                      <tr>
                          <td data-sort="{{ \Carbon\Carbon::parse($notification->created_at)->format('YmdHis')}}">{{ convertToLocal($notification->created_at)}}</td>
                          <td>{{ trans_choice('notifications.'.$notification->data['group'], 1) }}</td>
                          <td>{{ $notification->data['text']}}</td>
                          <td>{!! view('notifications.tds.read', compact('notification')) !!}</td>
                          <td>{!! view('notifications.tds.url', compact('notification')) !!}</td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->


@endsection

@section('head')
    @parent
@endsection

@section('script')
    @parent
    <!-- DataTable init  -->
    @include('layout.basic.js.datatable')
@endsection
