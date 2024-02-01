@extends('layout.app')
@section('title',trans_choice('production.program',2))
@section('page_name',trans_choice('production.program',2))
@section('content')

        <div class="card">
          <div class="card-body">
              <h3 class="card-title">{{trans_choice('production.program',2)}}</h3>
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-hover datatable">
                  <thead>
                  <tr>
                    <th>{{__('general.updated_at')}}</th>
                    <th>{{__('general.name')}}</th>
                    <th>{{ trans_choice('production.machine',1)}}</th>
                    <th>{{ __('production.ref_id') }}</th>
                    <th class="no-sort"></th>
                  </tr>
                  </thead>
                  <tbody>
                      @forelse($machine_programs as $machine_program)

                        <tr>
                            <td data-sort="{{ $machine_program->updated_at }}">{{ convertToLocal($machine_program->updated_at) }}</td>
                            <td>{{ $machine_program->name }}</td>
                            <td>{{ $machine_program->machine->name }}</td>
                            <td>{{ $machine_program->ref_id }}</td>
                            <td>
                                <a href="{{ route('programs.show', $machine_program->uuid ) }}" class="btn btn-sm btn-icon btn-outline-secondary"><i class="fa fa-info-circle"></i></a>
                                @can('programs_u')
                                  <a href="{{ route('programs.edit', $machine_program->uuid ) }}" class="btn btn-sm btn-icon btn-primary"><i class="fa fa-edit"></i></a>
                                @endcan
                                @can('programs_d')
                                  <button class="btn btn-sm btn-icon btn-danger" onclick="show_confirm_delete('permission-delete-{{$machine_program->uuid}}')"><i class="fa fa-trash"></i></button>
                                  <form method="post" id="permission-delete-{{$machine_program->uuid}}" action="{{ route('programs.destroy',$machine_program->uuid) }}">
                                      @csrf
                                      {{ method_field('DELETE') }}
                                  </form>
                                @endcan
                            </td>
                        </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>

          </div>
          <div class="card-footer">
              <p class="text-right"><a class="btn btn-primary" href="{{ route('programs.create') }}"><i class="fa fa-plus-circle"></i> {{__('general.new')}}</a> </p>
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
