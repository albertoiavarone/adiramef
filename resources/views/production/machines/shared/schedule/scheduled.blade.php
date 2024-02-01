<div class="card">
      <div class="card-body">
        <h3 class="card-title">{{ trans_choice('production.last_schedule',2)}}</h3>
        <table id="eee" class="table  table-hover datatable">
          <thead class="thead-light">
          <tr>
            <th>{{__('general.created_at')}}</th>
            <th>{{__('general.name')}}</th>
            <th class="no-sort"></th>
          </tr>
          </thead>
          <tbody>
              @forelse($machine->schedules->take(5) as $schedule)
                <tr>
                    <td>{{ convertToLocal($schedule->created_at) }}</td>
                    <td>{{ $schedule->name }}</td>
                    <td>
                        {!! view('production.schedules.tds.buttons', compact('schedule')) !!}
                    </td>
                </tr>
              @endforeach
          </tbody>
        </table>
      </div>
     
      
