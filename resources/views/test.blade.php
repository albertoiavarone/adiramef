@extends('layout.app')

@section('content')

<!-- Default box -->
      <div class="card">
        <div class="card-body">
          <div class="example-preview">
    			<ul class="nav nav-tabs" id="myTab" role="tablist">
    				<li class="nav-item">
    					<a class="nav-link" id="home-tab" data-toggle="tab" href="#home">
    						<span class="nav-icon">
    							<i class="flaticon2-chat-1"></i>
    						</span>
    						<span class="nav-text">Home</span>
    					</a>
    				</li>
    				<li class="nav-item active">
    					<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" aria-controls="profile">
    						<span class="nav-icon">
    							<i class="flaticon2-layers-1"></i>
    						</span>
    						<span class="nav-text">Profile</span>
    					</a>
    				</li>
    				<li class="nav-item dropdown">
    					<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
    						<span class="nav-icon">
    							<i class="flaticon2-rocket-1"></i>
    						</span>
    						<span class="nav-text">Dropdown</span>
    					</a>
    					<div class="dropdown-menu dropdown-menu-right" style="">
    						<a class="dropdown-item" href="#">Action</a>
    						<a class="dropdown-item" href="#">Another action</a>
    						<a class="dropdown-item" href="#">Something else here</a>
    						<div class="dropdown-divider"></div>
    						<a class="dropdown-item" href="#">Separated link</a>
    					</div>
    				</li>
    				<li class="nav-item">
    					<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" aria-controls="contact">
    						<span class="nav-icon">
    							<i class="flaticon2-rocket-1"></i>
    						</span>
    						<span class="nav-text">Contact</span>
    					</a>
    				</li>
    			</ul>
    			<div class="tab-content mt-5" id="myTabContent">
    				<div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <form method="post" action="{{ route('test.post') }}" enctype="multipart/form-data">
                            <input class="form-control" type="file" name="uploaded_file">
                            @csrf
                            <button type="submit" class="btn btn-primary">submit</button>
                        </form>


                    </div>
    				<div class="tab-pane fade " id="profile" role="tabpanel" aria-labelledby="profile-tab">Tab content 2</div>
    				<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">Tab content 3</div>
    			</div>
    		</div>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

@endsection

@section('script')
    @parent
    <!-- DataTable init  -->
    @include('layout.basic.js.datatable')
@endsection
