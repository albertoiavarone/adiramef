<div class="d-flex align-items-center">
    <!--begin::Actions-->
    <!--
        <a href="#" class="btn btn-light-primary font-weight-bolder btn-sm" data-toggle="modal" data-target="#UserCodeInfo"><i class="fa fa-user-circle"></i></a>
    -->
    <!--end::Actions-->
    <div class="btn-group">
      <a class="btn btn-sm btn-outline-secondary" href="{{ url('machines') }}"><i class="fa fa-cog"></i> {{trans_choice('production.machine',2)}}</a>
      <a class="btn btn-sm btn-outline-secondary" href="{{ url('orders') }}"><i class="fa fa-shopping-cart"></i> {{trans_choice('general.order',2)}}</a>
      <a class="btn btn-sm btn-outline-secondary" href="{{ url('works') }}"><i class="fa fa-wrench"></i> {{trans_choice('production.work',2)}}</a>
    </div>
</div>
