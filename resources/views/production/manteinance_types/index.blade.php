@extends('layout.app')
@section('title',trans_choice('production.manteinance_type',2))

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{trans_choice('production.manteinance_type', 2)}}</h3>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-hover datatable">
                <thead>
                <tr>
                    <th>{{__('general.updated_at')}}</th>
                    <th>{{__('general.name')}}</th>
                    <th>{{__('general.status')}}</th>
                    <th class="no-sort">{{__('general.action')}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($types as $type)

                    <tr>
                        <td>{{ convertToLocal($type->updated_at) }}</td>
                        <td>{{ $type->name }}</td>
                        <td><i class="fa fa-{{ $type->active ? 'check' : 'times' }}-circle text-{{ $type->active ? 'success' : 'danger' }}"></i></td>
                        <td>
                            @can('manteinance_types_u')
                            <a href="{{ route('manteinance-types.edit', $type->id ) }}"
                               class="btn btn-sm btn-info btn-icon"><i class="fa fa-edit"></i>
                            </a>
                            @endcan
                            @can('manteinance_types_d')
                              @if( $type->manteinances->count() == 0)
                                <button class="btn btn-sm btn-icon btn-outline-danger"
                                        onclick="show_confirm_delete('manteinance-types-delete-{{$type->id}}')"><i
                                        class="fa fa-trash"></i></button>
                                <form method="post" id="manteinance-types-delete-{{$type->id}}"
                                      action="{{ route('manteinance-types.destroy', $type->id) }}">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                </form>
                                @else
                                <button class="btn btn-sm btn-outline-secondary btn-icon" onclick="promptAlert('Operazione non consentita, Servizi collegati')">
                                    <i class="fa fa-trash"></i>
                                </button>
                                @endif
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <p class="text-right"><a class="btn btn-primary" href="{{ route('manteinance-types.create') }}">
              <i class="fa fa-plus-circle"></i> {{__('general.add')}}</a>
            </p>
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
    <script>
        $(document).ready(function () {
            $('#example1').DataTable({
                "order": [[1, "asc"]]
            });
        });
    </script>
@endsection
