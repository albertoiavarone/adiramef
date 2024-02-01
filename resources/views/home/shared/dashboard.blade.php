<div class="row mb-5">
  <div class="col-md-12 mb-3">
    <div class="card">
        <div class="card-header bg-light">
            <i class="far fa-copy"></i> {{  trans_choice('commercial.order', 2) }}
        </div>
        <div class="card-body">
          <p>{{ ucfirst(__('general.year'))}} {{ date('Y')}}</p>
            <div class="table-responsive">
              <table class="table">
                  @foreach($orders_statuses as $value)
                  <tr>
                      <td>{{ __('commercial.status_'.$value->name) }}</td>
                      <td>{{ $value->cont }}</td>
                  </tr>
                  @endforeach
              </table>
            </div>
            <hr />
            <a class="link float-right" href="{{ route('orders.index')}}"> vai agli {{  trans_choice('commercial.order', 2) }}</a>
        </div>
    </div>
  </div>
  <div class="col-md-12 mb-3">
    <div class="card">
        <div class="card-header bg-light">
            <i class="fas fa-clipboard-list"></i> {{  trans_choice('production.work', 2) }}
        </div>
        <div class="card-body">
          <p>{{ ucfirst(__('general.year'))}} {{ date('Y')}}</p>
          <div class="table-responsive">
            <table class="table">
                @foreach($works_by_month as $value)
                <tr>
                    <td>{{ $months[$value->month] }}</td>
                    <td>{{ $value->cont }}</td>
                </tr>
                @endforeach
            </table>
          </div>

            <hr />
            <a class="link float-right" href="{{ route('works.index')}}"> vai alle {{  trans_choice('production.work', 2) }}</a>
        </div>
    </div>
  </div>
</div>
