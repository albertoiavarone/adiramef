				<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
					<!--begin::Brand-->
					<div class="brand flex-column-auto" id="kt_brand">
						<!--begin::Logo-->
						<a href="{{route('home')}}" class="brand-logo">
							<img class="img-fluid" alt="{{__('general.brand')}}" src="{{ asset('assets/media/logos/logo-light.png') }}" />
						</a>
						<!--end::Logo-->
						<!--begin::Toggle-->
						<button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
							<span class="svg-icon svg-icon svg-icon-xl">
								<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<polygon points="0 0 24 0 24 24 0 24" />
										<path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
										<path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
									</g>
								</svg>
								<!--end::Svg Icon-->
							</span>
						</button>
						<!--end::Toolbar-->
					</div>
					<!--end::Brand-->
                    <!--begin::Aside Menu-->
                    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
                        <!--begin::Menu Container-->
                        <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
                            <!--begin::Menu Nav-->
                            <ul class="menu-nav">
                                <li class="menu-item home-item" aria-haspopup="true" data-menu="home">
                                    <a href="{{route('home')}}" class="menu-link">
                                        <i class="menu-icon flaticon-home"></i>
                                        <span class="menu-text">Dashboard</span>
                                    </a>
                                </li>



								@canany(['roles_r','permissions_r', 'manteinance_types_r', 'geo_nations_r', 'geo_provinces_r', 'geo_cities_r'])

								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover" >
                                    <a href="javascript:;" class="menu-link menu-toggle">
                                        <i class="menu-icon flaticon-cogwheel"></i>
                                        <span class="menu-text">{{__('general.settings')}}</span>
                                        <i class="menu-arrow"></i>
                                    </a>
                                    <div class="menu-submenu">
                                        <i class="menu-arrow"></i>
                                        <ul class="menu-subnav">
                                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                                <span class="menu-link">
                                                    <span class="menu-text">{{__('general.authorizations')}}</span>
                                                </span>
                                            </li>
																						@canany(['roles_r','permissions_r'])
																							<li class="menu-section">
																									<h4 class="menu-text">{{__('general.authorizations')}}</h4>
																									<i class="menu-icon ki ki-bold-more-hor icon-md"></i>
																							</li>
																						@endcanany
											@can('roles_r')
                                            <li class="menu-item" aria-haspopup="true" data-menu="roles">
                                                <a href="{{ url('roles') }}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">{{__('roles.roles')}}</span>
                                                </a>
                                            </li>
											@endcan
											@can('permissions_r')
                                            <li class="menu-item" aria-haspopup="true" data-menu="permissions">
                                                <a href="{{ url('permissions') }}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">{{__('permissions.permissions')}}</span>
                                                </a>
                                            </li>
											@endcan

											@canany(['manteinance_types_r','manteinances_r'])
												<li class="menu-section">
														<h4 class="menu-text">{{trans_choice('general.service',2)}}</h4>
														<i class="menu-icon ki ki-bold-more-hor icon-md"></i>
												</li>
											@endcanany

											@can('manteinance_types_r')
                                            <li class="menu-item" aria-haspopup="true" data-menu="manteinance-types">
                                                <a href="{{ url('manteinance-types') }}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">{{trans_choice('production.manteinance_type',2)}}</span>
                                                </a>
                                            </li>
											@endcan


											@canany(['geo_nations_r', 'geo_provinces_r', 'geo_cities_r'])
																						<li class="menu-section">
						                                    <h4 class="menu-text">Geo</h4>
						                                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
						                                </li>
											@endcanany
											@can('geo_nations_r')
																						<li class="menu-item" aria-haspopup="true" data-menu="nations">
																								<a href="{{ url('nations') }}" class="menu-link">
																										<i class="menu-bullet menu-bullet-dot">
																												<span></span>
																										</i>
																										<span class="menu-text">{{__('geo.nations')}}</span>
																								</a>
																						</li>
											@endcan
											@can('geo_provinces_r')
																						<li class="menu-item" aria-haspopup="true" data-menu="provinces">
																								<a href="{{ url('provinces') }}" class="menu-link">
																										<i class="menu-bullet menu-bullet-dot">
																												<span></span>
																										</i>
																										<span class="menu-text">{{__('geo.provinces')}}</span>
																								</a>
																						</li>
											@endcan
											@can('geo_cities_r')
																						<li class="menu-item" aria-haspopup="true" data-menu="cities">
																								<a href="{{ url('cities') }}" class="menu-link">
																										<i class="menu-bullet menu-bullet-dot">
																												<span></span>
																										</i>
																										<span class="menu-text">{{__('geo.cities')}}</span>
																								</a>
																						</li>
											@endcan
                                        </ul>
                                    </div>
                                </li>
								@endcanany

								@canany(['users_r'])
								<!-- start:block Users -->
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
										<i class="menu-icon flaticon-users"></i>
										<span class="menu-text">{{__('users.users')}}</span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											@can('users_r')
											<li class="menu-item" aria-haspopup="true" data-menu="users">
												<a href="{{ url('users') }}" class="menu-link">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">{{__('users.users')}}</span>
												</a>
											</li>
											@endcan
										</ul>
									</div>
								</li>
								<!-- end:block Users -->
								@endcanany

								@canany(['machines_r','builders_r', 'machine_types_r', 'providers_r'])
								<!-- start:block Users -->
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
										<i class="menu-icon flaticon-layers"></i>
										<span class="menu-text">Asset</span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											@can('providers_r')
                          <li class="menu-item" aria-haspopup="true" data-menu="providers">
                              <a href="{{ url('providers') }}" class="menu-link">
                                  <i class="menu-bullet menu-bullet-dot">
                                      <span></span>
                                  </i>
                                  <span class="menu-text">{{trans_choice('production.provider',2)}}</span>
                              </a>
                          </li>
											@endcan
											@can('builders_r')
                          <li class="menu-item" aria-haspopup="true" data-menu="builders">
                              <a href="{{ url('builders') }}" class="menu-link">
                                  <i class="menu-bullet menu-bullet-dot">
                                      <span></span>
                                  </i>
                                  <span class="menu-text">{{trans_choice('production.builder',2)}}</span>
                              </a>
                          </li>
											@endcan
											@can('machine_types_r')
                          <li class="menu-item" aria-haspopup="true" data-menu="machine-types">
                              <a href="{{ url('machine-types') }}" class="menu-link">
                                  <i class="menu-bullet menu-bullet-dot">
                                      <span></span>
                                  </i>
                                  <span class="menu-text">{{trans_choice('production.machine_type',2)}}</span>
                              </a>
                          </li>
											@endcan

											@can('machines_r')
												<li class="menu-item" aria-haspopup="true" data-menu="machines">
													<a href="{{ url('machines') }}" class="menu-link">
														<i class="menu-bullet menu-bullet-dot">
															<span></span>
														</i>
														<span class="menu-text">{{trans_choice('production.machine',2)}}</span>
													</a>
												</li>
											@endcan
										</ul>
									</div>
								</li>
								<!-- end:block Users -->
								@endcanany
								@canany(['works_r','programs_r','syncs_r','diagnostics_r','orders_r','lots_r'])
								<!-- start:block Users -->
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
										<i class="menu-icon flaticon-dashboard"></i>
										<span class="menu-text">{{__('production.production')}}</span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											@can('orders_r')
												<li class="menu-item" aria-haspopup="true" data-menu="orders">
													<a href="{{ url('orders') }}" class="menu-link">
														<i class="menu-bullet menu-bullet-dot">
															<span></span>
														</i>
														<span class="menu-text">{{trans_choice('general.order',2)}}</span>
													</a>
												</li>
											@endcan
											@can('programs_r')
												<li class="menu-item" aria-haspopup="true" data-menu="programs">
													<a href="{{ url('programs') }}" class="menu-link">
														<i class="menu-bullet menu-bullet-dot">
															<span></span>
														</i>
														<span class="menu-text">{{trans_choice('production.program',2)}}</span>
													</a>
												</li>
											@endcan
											@can('works_r')
						                        <li class="menu-item" aria-haspopup="true" data-menu="works">
						                            <a href="{{ url('works') }}" class="menu-link">
						                                <i class="menu-bullet menu-bullet-dot">
						                                    <span></span>
						                                </i>
						                                <span class="menu-text">{{trans_choice('production.work',2)}}</span>
						                            </a>
						                        </li>
											@endcan
											@can('syncs_r')
												<li class="menu-item" aria-haspopup="true" data-menu="syncs">
													<a href="{{ url('syncs') }}" class="menu-link">
														<i class="menu-bullet menu-bullet-dot">
															<span></span>
														</i>
														<span class="menu-text">{{trans_choice('production.sync',2)}}</span>
													</a>
												</li>
											@endcan
											@can('localizations_r')
												<li class="menu-item" aria-haspopup="true" data-menu="telemetries">
													<a href="{{ url('telemetries') }}" class="menu-link">
														<i class="menu-bullet menu-bullet-dot">
															<span></span>
														</i>
														<span class="menu-text">{{trans_choice('production.localization',2)}}</span>
													</a>
												</li>
											@endcan
											@can('work_schedule_r')
												<li class="menu-item" aria-haspopup="true" data-menu="schedules">
													<a href="{{ url('schedules') }}" class="menu-link">
														<i class="menu-bullet menu-bullet-dot">
															<span></span>
														</i>
														<span class="menu-text">{{trans_choice('production.schedule',2)}}</span>
													</a>
												</li>
											@endcan
											@can('manteinances_r')
					                          <li class="menu-item" aria-haspopup="true" data-menu="manteinances">
					                              <a href="{{ url('manteinances') }}" class="menu-link">
					                                  <i class="menu-bullet menu-bullet-dot">
					                                      <span></span>
					                                  </i>
					                                  <span class="menu-text">{{trans_choice('production.manteinance',1)}}</span>
					                              </a>
					                          </li>
											@endcan

										</ul>
									</div>
								</li>
								<!-- end:block Users -->
								@endcanany
                        	</ul>
                        <!--end::Menu Nav-->
                    	</div>
                    <!--end::Menu Container-->
                	</div>
                <!--end::Aside Menu-->
                </div>
