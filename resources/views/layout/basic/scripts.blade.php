        <!--begin::Global Config(global config for global JS scripts)-->
		<script src="{{ asset('assets/js/global.js') }}">
        </script>
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
		<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
		<script src="{{ asset('assets/js/pages/crud/forms/widgets/select2.js') }} "></script>
		<script src="{{ asset('assets/js/pages/features/miscellaneous/toastr.js') }}"></script>
		<script src="{{ asset('assets/plugins/custom/tinymce/tinymce.bundle.js') }} "></script>
		<script src="{{ asset('assets/js/pages/crud/forms/editors/tinymce.js') }} "></script>
		<script src="{{ asset('assets/js/pages/features/miscellaneous/sweetalert2.js') }}"></script>
		<!--end::Global Theme Bundle-->


		<!--begin::Page Scripts(used by this page)-->
		<script src="{{ asset('assets/js/pages/widgets.js') }}"></script>
		<!-- start: localization for datepicker -->
		<script src="{{ asset('plugins/datepicker/locales/bootstrap-datepicker.'.session('locale').'.min.js') }}" charset="UTF-8"></script>
		<!-- end: localization for datepicker -->
		<script src="{{ asset('plugins/select2/js/i18n/'.session('locale').'.js') }}"></script>

		<script>
			/* flag required input */
			function checkInputRequired(){
				$('input[required], select[required],checkbox[required],radiobox[required],textarea[required]').parent().find('label').append('<span class="text-danger st-required">*</span>');
			}
			/* refresh flag required input */
			function refreshInputRequired(){
				$('input[required], select[required],checkbox[required],radiobox[required],textarea[required]').parent().find('label').find('span').remove();
				checkInputRequired();
			}
			/*
			initialize select2
			*/
			function set_select2(id){
				$('#'+id).select2({
					placeholder: "{{__('general.select')}}",
					width: "100%",
					allowClear: true
				});
			}
			/*
			initialize datepicker
			*/
			function set_datepicker(id){
				$('#'+id).datepicker({
		          rtl: KTUtil.isRTL(),
		          todayHighlight: true,
		          orientation: "bottom left",
				  language: '{{ strtolower(session('locale')) }}'
		         });
			}
			/*
			initialize timepicker
			*/
			function set_timepicker(id){
				$('#'+id).timepicker({
				 timeFormat: 'hh:mm:ss',
		         defaultTime: '',
		         minuteStep: 1,
		         showSeconds: true,
				 use24hours: true,
		         showMeridian: false,
		         language: '{{ strtolower(session('locale')) }}'
		        });
			}
			/*
			initialize datetimepicker
			*/
			function set_datetimepicker(id, defaultDateValue=''){
				$('#'+id).datetimepicker({
						useCurrent: false,
						locale: '{{ session('locale')}}',
						format: 'DD/MM/YYYY H:mm:ss',
						useSeconds: true,
						defaultDate: defaultDateValue,
				});
			}
			/*
			ajax get to receive option - parse id & name from response
			*/
			function getAjaxDataSelectOptions(select_id_source,url,select_id_destination){
			    $.get( url, function( response ) {
			        var html =  '<option value=""></option>';
					var msg = '';
					if($('#resp_'+select_id_destination).length){
						$('#resp_'+select_id_destination).remove();
					}
				   if(response.status){
						if(response.data.length == 0){
							msg = '<small id="resp_'+select_id_destination+'" class="text-warning">{{ __('general.data_not_found') }}</small>';
						} else {
							msg = '<small  id="resp_'+select_id_destination+'" class="text-success">{{ __('general.loaded_data') }}</small>';
							$.each(response.data, function(i,item){
							   html+= '<option value="'+item.id+'">'+item.name+'</option>';
						   });
						}
			        }  else {
						 msg = '<small  id="resp_'+select_id_destination+'" class="text-danger">{{ __('general.not_loaded_data') }}</small>';
			        }
			       $('#'+select_id_destination).parent().append(msg);
				   $('#'+select_id_destination).html(html);
			    });
			}

			$(document).ready(function(){
				checkInputRequired();
				activeMemuItem();
			});

			// init Tiny Editor Wysiwyg
			function initTinyMce(selectorId,text=''){
				tinymce.init({
	                selector: '#'+selectorId,
					toolbar: 'advlist | autolink | link image | lists charmap | print preview code',
					plugins : 'advlist autolink link image lists charmap print preview code',
					branding: false,
					language: '{{ session('locale') }}',
	                setup: function (editor) {
	                  editor.on('init', function (e) {
	                    editor.setContent(text);
	                  });
	                }
	              });
			}

			//toastr cfg
			toastr.options = {
		      "closeButton": true,
		      "debug": false,
		      "newestOnTop": true,
		      "progressBar": true,
		      "positionClass": "toast-top-right",
		      "preventDuplicates": false,
		      "onclick": null,
		      "showDuration": "5000",
		      "hideDuration": "1000",
		      "timeOut": "5000",
		      "extendedTimeOut": "1000",
		      "showEasing": "swing",
		      "hideEasing": "linear",
		      "showMethod": "fadeIn",
		      "hideMethod": "fadeOut",
		    };

			//----check integer input
			$('.number').keyup(function(event){
				if( parseInt($(this).val()) > parseInt($(this).attr('max')) ){
					$(this).val( $(this).attr('max') );
					alert(" Max: "+$(this).attr('max') );
					return;
				}
	        	if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
	            event.preventDefault();
	        }});
			//------------------------------------------------------------
			function timestampToLocal(timestamp){
				var date = new Date(timestamp).toLocaleDateString('it',{ year: 'numeric', month: '2-digit', day: '2-digit' })
				return date;
			}
			//------------------------------------------------------------
			function show_confirm_delete(form_id){
		        Swal.fire({
		            title: "{{__('alert.confirm_delete_title')}}",
		            text: "{{__('alert.confirm_delete_text')}}",
		            icon: "warning",
		            showCancelButton: true,
					cancelButtonText: "{{__('general.cancel')}}",
		            confirmButtonText: "{{__('alert.confirm_delete_button_text')}}",
		        }).then(function(result) {
		            if (result.value) {
						$('#'+form_id).submit();
		            }
		        });
			}
			//------------------------------------------------------------
			function promptAlert(text,title='{{ __('general.warning')}}',icon='warning'){
				Swal.fire({
					title: title,
					text: text,
					icon: icon
				});
			}
			//------------------------------------------------------------
			function markAsReadNotification(id,url=''){
				$.post( "{{ route('notification.asRead') }}",{
						uuid: id ,
						_token: "{{ csrf_token() }}"
					})
				.done(function( data ) {
					if($('#read_info_'+id).length == 1){
						$('#read_info_'+id).html('<span class="badge badge-success">{{ trans_choice('notifications.readed', 1)}}</span>');
					}
					if(url){
						window.location.href = url;
					}
				});
			}
			//------------------------------------------------------------
			function activeMemuItem(){
				var route = '{{ Route::currentRouteName() }}'.split(".",1);
				if(route!='home'){
					$(".menu-item").find("[data-menu='"+route+"']").addClass('menu-item-active');
					$(".menu-item").find("[data-menu='"+route+"']").parent().parent().parent().addClass('menu-item-open');
				} else {
					$(".home-item").addClass('menu-item-active');
				}
			}
			//------------------------------------------------------------
			function ajax_req(route,uuid,modal_title=''){
		            $.post( route,{
		                    _token: "{{ csrf_token() }}",
		                    uuid : uuid
		            }).done(function( response ) {
		                openModal('Modal-Default',modal_title,response);
		            });
			}
			//------------------------------------------------------------
			function openModal(modalID='Modal-Default', title='Title',body='Modal Body'){
		        $('#'+modalID).modal('show');
		        $('#'+modalID+' .modal-title').html(title);
		        $('#'+modalID+' .modal-body').html(body);
		        $('#'+modalID).on("hidden.bs.modal", function(){
		            $('#'+modalID+" .modal-body").html("");
		        });
		    }
			//------------------------------------------------------------
			function setActiveTab(defaultTab='info'){
				@if( session()->get('id_tab_active'))
					$('#{{ session()->get('id_tab_active') }}').addClass('active show');
					$('a[href*="#{{ session()->get('id_tab_active') }}"]').addClass('active');
				@else
					$('a[href*="#'+defaultTab+'"]').addClass('active');
					$('#'+defaultTab+'').addClass('active show');
				@endif
		    }
			//------------------------------------------------------------
		</script>
		<!--end::Page Scripts-->
