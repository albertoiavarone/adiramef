@extends('layout.app')
@section('title',trans_choice('production.machine',2))
@section('page_name',trans_choice('production.machine',2))
@section('content')

        <div class="card">
              <div class="card-body">
                <h3 class="card-title">{{trans_choice('production.machine',2)}}</h3>
                <div class="row">
                @forelse( $machines as $machine )
                    <div class="col-md-4">
                        @include('production.machines.shared.card-full')
                    </div>
                @endforeach
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <p class="text-right"><a class="btn btn-primary" href="{{ route('machines.create') }}"><i class="fa fa-plus-circle"></i> {{__('general.new')}}</a> </p>
              </div>
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
