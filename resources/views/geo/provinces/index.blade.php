@extends('layout.app')
@section('title',__('geo.provinces'))
@section('page_name',__('geo.provinces'))
@section('content')

        <div class="card">
              <div class="card-body">
                  <h3 class="card-title">{{__('geo.provinces')}}</h3>
                <table id="example1" class="table  table-hover datatable">
                  <thead class="thead-light">
                  <tr>
                    <th>ID</th>
                    <th>{{__('general.name')}}</th>
                    <th>{{__('general.abbreviation')}}</th>
                    <th>{{__('geo.region')}}</th>
                    <th>{{__('geo.nation')}}</th>
                    <th>{{__('geo.continent_name')}}</th>
                    <th class="no-sort"></th>
                  </tr>
                  </thead>
                  <tbody>
                      @forelse($provinces as $province)
                        <tr>
                            <td>{{ intval($province->id) }}</td>
                            <td>{{ $province->name }}</td>
                            <td>{{ $province->province_abbreviation }}</td>
                            <td>{{ $province->region }}</td>
                            <td>{{ $province->nation->countryName }}</td>
                            <td>{{ $province->nation->continentName }}</td>
                            <td class="text-right">
                                <a href="{{ route('provinces.show', $province->id ) }}" class="btn btn-sm btn-secondary btn-icon"><i class="fa fa-info-circle"></i></a>
                                <a href="{{ route('provinces.edit', $province->id ) }}" class="btn btn-sm btn-info btn-icon"><i class="fa fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-icon" onclick="show_confirm_delete('province-delete-{{$province->id}}')"><i class="fa fa-trash"></i></button>
                                <form method="post" id="province-delete-{{$province->id}}" action="{{ route('provinces.destroy',$province->id) }}">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                </form>
                            </td>
                        </tr>
                      @endforeach
                  </tbody>
                </table>
                <hr />

              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <p class="text-right"><a class="btn btn-primary" href="{{ route('provinces.create') }}"><i class="fa fa-plus-circle"></i> {{__('general.new')}}</a> </p>
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
