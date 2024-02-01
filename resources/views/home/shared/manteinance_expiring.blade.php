<div class="row">
  <div class="col-md-12 mb-3">
    <div class="card">
        <div class="card-header bg-light">
            <i class="far fa-calendar-alt "></i> {{  trans_choice('production.manteinance_expiring', 2) }}
            <span class="badge badge-{{ $manteinances->count() > 0 ? 'danger' : 'secondary'}}">{{ $manteinances->count()}}</span>
        </div>
        <div class="card-body">
          <div class="table-responsive">
              <table class="table">
                  @foreach($manteinances as $manteinance)
                  <tr>
                      <td>{{ $manteinance->type->name }}</td>
                      <td>{{ $manteinance->machine->type->name }}</td>
                      <td>{{ $manteinance->machine->name }}</td>
                      <td>{{ formatDate($manteinance->expire_date) }}</td>
                  </tr>
                  @endforeach
              </table>
          </div>
            <hr />
            <a class="link float-right" href="{{ route('manteinances.index')}}"> vai alle {{  trans_choice('production.manteinance', 2) }}</a>
        </div>
    </div>
  </div>
</div>
