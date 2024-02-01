<div class="dropdown">
    <!--begin::Toggle-->
    <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
        <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
            <img class="h-20px w-20px rounded-sm" src="{{asset('assets/media/svg/flags/'.(session('locale')?session('locale') : app()->getLocale()).'.svg') }} " alt="{{ session('locale')?session('locale') : app()->getLocale() }}" />
        </div>
    </div>
    <!--end::Toggle-->
    <!--begin::Dropdown-->
    <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
        <!--begin::Nav-->
        <ul class="navi navi-hover py-4">
            @foreach(config('languages.lang') as $lang_code=>$lang_info)
            <form method="post" action="{{ route('locale',$lang_code) }}" id="lng_frm_{{ $lang_code }}">
                @csrf
                <!--begin::Item-->
                <li class="navi-item">
                    <a href="#" class="navi-link" onclick="$('#lng_frm_{{$lang_code}}').submit();return false;">
                        {!! getFlag($lang_code) !!}
                        <span class="navi-text">{{$lang_info['name']}}</span>
                    </a>
                </li>
                <!--end::Item-->
            </form>
            @endforeach
        </ul>
        <!--end::Nav-->
    </div>
    <!--end::Dropdown-->
</div>
