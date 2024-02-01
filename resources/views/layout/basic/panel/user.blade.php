
		<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
			<!--begin::Header-->
			<div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
				<h3 class="font-weight-bold m-0">{{ Auth::user()->name }}
				<!--<small class="text-muted font-size-sm ml-2">{{ auth()->user()->code }}</small>-->
				</h3>
				<p href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
					<i class="ki ki-close icon-xs text-muted"></i>
				</a>
			</div>
			<!--end::Header-->
			<!--begin::Content-->
			<div class="offcanvas-content pr-5 mr-n5">
				<!--begin::Header-->
				<div class="d-flex align-items-center mt-5">
					<div class="symbol symbol-100 mr-5">
						<div class="symbol-label" style="background-image:url('{{ asset( !is_null(auth()->user()->image) ? 'storage/'.auth()->user()->image : 'assets/media/users/blank.png') }}')"></div>
						<i class="symbol-badge bg-success"></i>
					</div>
					<div class="d-flex flex-column">
						<div class="text-muted mt-1 mb-2"><i class="fa fa-user"></i> {{ __('roles.'.auth()->user()->getRoleNames()[0]) }}</div>
						<div class="text-muted mt-1 mb-2"><i class="fa fa-globe"></i> {{ auth()->user()->timezone }}</div>
						<div class="text-muted mt-1"><i class="fa fa-info-circle"></i> {{ __('general.code').': '.auth()->user()->code }}</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<p class="text-muted text-center mt-3"><i class="fas fa-sign-in-alt"></i> {{__('auth.last_login_at').':'.( auth()->user()->last_login_at ? convertToLocal(auth()->user()->last_login_at) : '') }}</p>
				<button type="button" class="btn btn-secondary btn-sm btn-block mt-3"
					onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
					<i class="fas fa-sign-out-alt"></i> {{__('auth.logout')}}
				</button>

				<!--end::Header-->
				<!--begin::Separator-->
				<div class="separator separator-dashed mt-1 mb-3"></div>
				<!--end::Separator-->
				<!--begin::Nav-->
				<div class="navi navi-spacer-x-0 p-0">
					<!--begin::Item-->
					<a href="{{ route('profile.edit') }}" class="navi-item">
						<div class="navi-link">
							<div class="symbol symbol-40 bg-light mr-3">
								<div class="symbol-label">
									<span class="svg-icon svg-icon-md svg-icon-success">
										<i class="fa fa-user"></i>
									</span>
								</div>
							</div>
							<div class="navi-text">
								<div class="font-weight-bold">{{__('users.my_profile')}}</div>
								<div class="text-muted">{{__('users.my_profile_info')}}</div>
							</div>
						</div>
					</a>
					<!--end:Item-->
					<!--begin::Item-->
					<a href="{{ route('profile.password') }}" class="navi-item">
						<div class="navi-link">
							<div class="symbol symbol-40 bg-light mr-3">
								<div class="symbol-label">
									<span class="svg-icon svg-icon-md svg-icon-warning">
										<!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Chart-bar1.svg-->
										<i class="fa fa-key"></i>
										<!--end::Svg Icon-->
									</span>
								</div>
							</div>
							<div class="navi-text">
								<div class="font-weight-bold">{{__('users.my_password')}}</div>
								<div class="text-muted">{{__('users.change_password')}}</div>
							</div>
						</div>
					</a>
					<!--end:Item-->

					<!--begin::Item-->
					<a href="{{ route('2fa-settings') }}" class="navi-item">
						<div class="navi-link">
							<div class="symbol symbol-40 bg-light mr-3">
								<div class="symbol-label">
									<span class="svg-icon svg-icon-md svg-icon-danger">
										<i class="fa fa-lock"></i>
									</span>
								</div>
							</div>
							<div class="navi-text">
								<div class="font-weight-bold">{{__('auth.mf_auth')}}</div>
								<div class="text-muted">{{__('auth.mf_auth_info')}}</div>
							</div>
						</div>
					</a>
					<!--end:Item-->
					<!--begin::Item-->
					<a href="#" class="navi-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
						<div class="navi-link">
							<div class="symbol symbol-40 bg-light mr-3">
								<div class="symbol-label">
									<span class="svg-icon svg-icon-md svg-icon-primary">
										<i class="fas fa-sign-out-alt"></i>
									</span>
								</div>
							</div>
							<div class="navi-text">
								<div class="font-weight-bold">{{__('auth.logout')}}</div>
								<div class="text-muted">{{__('auth.logout_info')}}</div>
							</div>
						</div>
					</a>
					{!! BootForm::open()
						->action(route('logout'))
						->post()
						->id('logout-form')
						->class('d-none')
					!!}
					{!! BootForm::close() !!}
					<!--end:Item-->
				</div>
				<!--end::Nav-->
				<!--begin::Separator-->
				<div class="separator separator-dashed my-7"></div>
				<!--end::Separator-->

			</div>
			<!--end::Content-->
		</div>
