<div class="topbar-item">
    <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
        <div class="symbol symbol-40 symbol-circle" data-toggle="tooltip" title="" data-original-title="{{ Auth::user()->name }}">
			<img alt="{{ Auth::user()->name }}" src="{{ asset( !is_null(auth()->user()->image) ? 'storage/'.auth()->user()->image : 'assets/media/users/blank.png') }}">
		</div>
    </div>
</div>
