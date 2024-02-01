@extends('layout.app')
@section('title',trans_choice('production.provider',2))
@section('page_name',trans_choice('production.provider',2))
@section('content')

        <div class="card">
          <div class="card-body">
              <h3 class="card-title">{{trans_choice('production.provider',2)}}</h3>
              <div class="row ">
                  @forelse($providers as $provider)
                  <div class="col-md-4 mb-5">
                      @include('production.providers.shared.card')
                  </div>
                  @endforeach
              </div>

          </div>
          <div class="card-footer">
            @can('providers_c')
              <p class="text-right"><a class="btn btn-primary" href="{{ route('providers.create') }}"><i class="fa fa-plus-circle"></i> {{__('general.new')}}</a> </p>
            @endcan
          </div>
        </div>
@endsection

@section('head')
    @parent
@endsection

@section('script')
    @parent
    <!-- DataTable init  -->
    @include('layout.basic.js.datatable')
@endsection
