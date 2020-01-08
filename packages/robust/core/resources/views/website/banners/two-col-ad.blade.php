@set('TwoColAds', $banner_helper->getBannersByType(['two-col-ad']))
@foreach($TwoColAds as $key => $TwoColAd)
    @set('properties', json_decode($TwoColAd->properties))
    @set('location',$location_helper->getLocation($properties->locations))
    @if($properties)
        @set('image',$listing_helper->getImageByLocation($location,$properties->image ?? ''))
        @set('url',!in_array($properties->button_url,['','#']) ? $properties->button_url : '#')
        <section class="adv--block">
            <div class="container-fluid">
                <div class="row">
                    @if($key%2)
                        <div class="col m7 s12">
                            <img src="{{$image}}" alt="{{$properties->header ?? ''}}">
                        </div>
                        <div class="col m5 s12">
                            <h4>{{$properties->header ?? ''}}</h4>
                            <p>{{$properties->content ?? ''}}</p>
                            <p><i>City : {{$properties->locations ?? ''}}</i></p>
                            <a href="{{$url}}" class="buy-now-btn">{{$proerties->button_text ?? 'Buy Now'}}</a>
                        </div>
                     @else
                        <div class="col m5 s12">
                            <h4>{{$properties->header ?? ''}}</h4>
                            <p>{{$properties->content ?? ''}}</p>
                            <p><i>City : {{$properties->location ?? ''}}</i></p>
                            <a href="{{$url}}" class="buy-now-btn">{{$proerties->button_text ?? 'Buy Now'}}</a>
                        </div>
                        <div class="col m7 s12">
                            <img src="{{$image}}" alt="{{$properties->header ?? ''}}">
                        </div>
                      @endif
                </div>
            </div>
        </section>
    @endif
@endforeach
