@extends('layout.app')
@section('title',trans_choice('production.program',1))
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="{{url('programs')}}" class="text-muted">{{trans_choice('production.program',1)}}</a>
    </li>
    <li class="breadcrumb-item text-muted">
        <span class="text-muted">{{ $machine_program->name }}</span>
    </li>
@endsection

@section('content')

<div class="card">
    <div class="card-header"><h4>{{trans_choice('production.program',1)}}</h4></div>
    <div class="card-body">

      <dl class="row">
        <dt class="col-md-4">{{ trans_choice('production.machine', 1) }}</dt>
        <dd class="col-md-8">{{ $machine_program->machine->name }}</dd>
        <dt class="col-md-4">{{ trans_choice('production.builder', 1) }}</dt>
        <dd class="col-md-8">{{ $machine_program->machine->builder->name }}</dd>
        <dt class="col-md-4">{{ __('general.name') }}</dt>
        <dd class="col-md-8">{{  $machine_program->name }}</dd>
        <dt class="col-md-4">{{ __('production.ref_id') }}</dt>
        <dd class="col-md-8">{{  $machine_program->ref_id }}</dd>
        <dt class="col-md-4">{{ __('general.description') }}</dt>
        <dd class="col-md-8">{{  $machine_program->description }}</dd>
        <dt class="col-md-4">{{ __('general.created_at') }}</dt>
        <dd class="col-md-8">{{  convertToLocal($machine_program->created_at) }}</dd>
        <dt class="col-md-4">{{ __('general.updated_at') }}</dt>
        <dd class="col-md-8">{{  convertToLocal($machine_program->updated_at) }}</dd>

      </dl>

      @if($machine_program->file_path)

          <a class="btn btn-outline-secondary" target="_blank"  href="{{ asset('storage/'.$machine_program->file_path) }}">
            <i class="fa fa-file"></i> {{ $machine_program->original_file_name }}
          </a>

      @endif
    </div>
</div>
<hr class="mt-10">
<div class="btn-group float-right mt-10">
    <a class="btn btn-outline-secondary" href="{{ route('programs.index') }}">
        <i class="fa fa-arrow-circle-left"></i> {{__('general.cancel')}}
    </a>

</div>
@endsection

@section('head')
    @parent

@endsection

@section('script')
    @parent
    <script>
      $(document).ready(function(){
        //
      })
    </script>


@endsection
