@extends('layout.app')
@section('title',__('geo.nations'))
@section('page_name',__('geo.nations'))
@section('content')

        <div class="card">
              <div class="card-body">
                  <h3 class="card-title">{{__('geo.nations')}}</h3>
                    <table id="example1" class="table  table-hover datatable">
                      <thead class="thead-light">
                      <tr>
                        <th>{{__('geo.nation')}}</th>
                        <th>{{__('geo.country_code')}}</th>
                        <th>{{__('geo.currency')}}</th>
                        <th>{{__('geo.continent_name')}}</th>
                        <th>{{__('geo.continent_code')}}</th>
                        <th>{{__('geo.vies_code')}}</th>
                        <th>{{__('geo.extra_ue')}}</th>
                        <th>ISO</th>
                        <th>ISO Alpha3</th>
                        <th class="no-sort"></th>
                      </tr>
                      </thead>
                      <tbody>
                          @forelse($nations as $nation)
                            <tr>
                                <td>{{ $nation->countryName }}</td>
                                <td>{{ $nation->countryCode }}</td>
                                <td>{{ $nation->currencyCode }}</td>
                                <td>{{ $nation->continentName }}</td>
                                <td>{{ $nation->continent }}</td>
                                <td>{{ $nation->viesCode }}</td>
                                <td>{!! $nation->extraue == 1 ? '<i class="fa fa-check-circle"></i>' : '' !!}</td>
                                <td>{{ $nation->isoNumeric }}</td>
                                <td>{{ $nation->isoAlpha3 }}</td>
                                <td class="text-right">
                                    <a href="{{ route('nations.show', $nation->id ) }}" class="btn btn-sm btn-secondary btn-icon"><i class="fa fa-info-circle"></i></a>
                                    <a href="{{ route('nations.edit', $nation->id ) }}" class="btn btn-sm btn-info btn-icon"><i class="fa fa-edit"></i></a>
                                    <button class="btn btn-sm btn-danger btn-icon" onclick="show_confirm_delete('nation-delete-{{$nation->id}}')"><i class="fa fa-trash"></i></button>
                                    <form method="post" id="nation-delete-{{$nation->id}}" action="{{ route('nations.destroy',$nation->id) }}">
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
                  <p class="text-right"><a class="btn btn-primary" href="{{ route('nations.create') }}"><i class="fa fa-plus-circle"></i> {{__('general.new')}}</a> </p>
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
