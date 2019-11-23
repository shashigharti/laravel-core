@set('sliders', $banner_helper->getBannersByType(['slider']))
<section class="advertisement">
    <div class="container-fluid">
        <div class="row">
            <div class="col s8">
                <h4 class="sub-title">Homes For Sale in Honolulu</h4>
            </div>
            <div class="col s4 right-align">
                <a href="#" class="view-all">View All</a>
            </div>
        </div>
        <div class="adv-slider2">
            @foreach($sliders as $slider)
                <div class="single-block">
                    @set('properties', json_decode($slider->properties))
                    <img src={{$properties->image ?? getMedia($properties->image)}}>
                    <div class="slider--text">
                        <h4>$149,000</h4>
                        <p>{{$slider->header}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

