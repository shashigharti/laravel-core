@set('mainBannerSliders', $banner_helper->getBannersByType(['main-banner']))
{{--main--banner_slider--}}
<div class="slides  owl-theme">
    @foreach($mainBannerSliders as $mainBannerSlider)
        @set('properties', json_decode($mainBannerSlider->properties))
        @if($properties)
            <div class="item">
{{--                <img src="{{$properties->image ? getMedia($properties->image) : "/images/banners/banner.jpg"}}" alt="">--
        @endif
    @endforeach
</div>
