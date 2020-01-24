@set('params',request()->route()->parameters())
<section class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="inner--main--title center-align">
                    @if(isset($title) && ($title !== ''))
                        <h1> {{ $title }} </h1>
                    @elseif(isset($page) && ($page->title != '') && isset($location))
                        <h1> {{ ucwords(strtolower($location->name)) . " " . $page->title }} </h1>
                    @elseif(isset($page) && ($page->title != '') )
                        <h1> {{  settings('real-estate', 'client')['name'] . " " . $page->title }} </h1>
                    @else
                        <h1> {{ settings('real-estate', 'client')['name'] }} Homes For Sale </h1>
                    @endif
                </div>
                <div class="top--breadcrumb center-align">
                    <span>
                        <a href="javascript:void(0)">
                            {{$location->active_count ?? $results->total()}} Homes For Sale
                        </a>
                    </span>
                    <span>/</span>
                    <span><a href="javascript:void(0)">{{$location->sold_count ?? ''}} Sold Homes</a></span>
                </div>

                @include(Site::templateResolver('core::website.listings.partials.search'))
            </div>
        </div>
        <div class="search--main--content">
            <div class="search--left--section">
                <div class="listing--houses">
                    <div class="row">
                        @forelse($results as $result)
                            @set('properties',$result->property->pluck('value','type'))
                            @set('image',$result->images ? $result->images->first() : null)
                            <a href="{{route('website.realestate.single',['slug' => $result->slug])}}">
                                <div class="col m3 s12">
                                    <div class="single--list--block">
                                        <img
                                            src={{$image ? $image->url :  ''}} alt="{{$result->address_street}} {{$location_helper->getLocation($result->city_id)->name}}">
                                        <div class="list--overlay">
        									<span class="tag active">
        										@if(isset($result->status) && !in_array($result->status,['none','None','0']))
                                                    {{$result->status}}
                                                @endif
        									</span>
                                            <span class="fav">
        										<i class="fa fa-heart"></i>
        									</span>
                                            <div class="bottom--detail">
                                                <h3 class="price">
                                                    @if(isset($result->system_price) && !in_array($result->system_price,['none','None']))
                                                        ${{$result->system_price}}
                                                    @endif
                                                </h3>
                                                <p class="info">
                                                    @if(isset($result->address_street) && !in_array($result->address_street,['none','None','0']))
                                                        {{$result->address_street}}
                                                    @endif
                                                    @if(isset($result->city_id))
                                                        {{$location_helper->getLocation($result->city_id)->name}}
                                                    @endif
                                                    @if(isset($result->state) && !in_array($result->state,['none','None','0']))
                                                        {{ ' | '.$result->state}}
                                                    @endif
                                                    @if(isset($result->county_id))
                                                        {{ ' | '. $location_helper->getLocation($result->county_id)->name}}
                                                    @endif
                                                </p>
                                                <span>
                                                    @if(isset($properties['year_built']))
                                                        {{ 'Built in '.$properties['year_built']}}
                                                    @endif
                                                </span>

                                                <span>
                                                @if(isset($properties['total_square_feet']))
                                                        {{' | '. $properties['total_square_feet'] .' sq.ft'}}
                                                    @endif
                                            </span>
                                                <div class="details">
                                                <span>
                                                    @if(isset($result->bedrooms) && !in_array($result->bedrooms,['none','None','0']))
                                                        <img src="/assets/website/images/bed.png" alt="Bed">
                                                        {{ $result->bedrooms}}
                                                    @endif
                                                </span>
                                                    <span class="center-align">
                                                    @if(isset($result->baths_full) && !in_array($result->baths_full,['none','None','0']))
                                                            <img src="/assets/website/images/bathtub.png"
                                                                 alt="Bathtub">{{ $result->baths_full}}
                                                        @endif
                                                </span>
                                                    <span class="right-align">
                                                    @if(isset($result->picture_count) && !in_array($result->picture_count,['none','None','0']))
                                                            <img src="/assets/website/images/camera.png" alt="Picture">
                                                            {{ $result->picture_count}}
                                                        @endif
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                        @endforelse
                    </div>
                </div>

                <div class="listing--report">
                    <div class="row">
                        <div class="col s12">
                            <h4 class="page--sub--title">OHAU MARKET REPORTS</h4>
                        </div>
                        <div class="col s12">
                            <div class="single--report--block">
                                <span class="main-info">293</span>
                                <p>Propertes for sale (Today's date)</p>
                            </div>
                            <div class="single--report--block">
                                <span class="main-info">293</span>
                                <p>Propertes for sale (Today's date)</p>
                            </div>
                            <div class="single--report--block">
                                <span class="main-info">293</span>
                                <p>Propertes for sale (Today's date)</p>
                            </div>
                            <div class="single--report--block">
                                <span class="main-info">293</span>
                                <p>Propertes for sale (Today's date)</p>
                            </div>
                            <div class="single--report--block">
                                <span class="main-info">293</span>
                                <p>Propertes for sale (Today's date)</p>
                            </div>
                            <div class="single--report--block">
                                <span class="main-info">293</span>
                                <p>Propertes for sale (Today's date)</p>
                            </div>
                            <div class="single--report--block">
                                <span class="main-info">293</span>
                                <p>Propertes for sale (Today's date)</p>
                            </div>
                            <div class="single--report--block">
                                <span class="main-info">293</span>
                                <p>Propertes for sale (Today's date)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="comment--section">
                    <div class="row">
                        <div class="col s12">
                            <p>With subdivision Info being few and far between on the Internet, our members are
                                encouraged to share useful information.</br>

                                If you live in Bellaire Heights Ph 5 or have information that will help others make home
                                buying or selling decisions here, please share it with us!</p>
                            <textarea class="text-left">Write your comment here..
        							</textarea>
                            <div>
                                <input type="checkbox">
                                <span>Allow other members to contact me with questions</span>
                            </div>
                            <a href="#" class="btn theme-btn">Add Comment</a>
                        </div>
                    </div>
                </div>
                <div class="area--list--block">
                    <div class="row">
                        <div class="col s12">
                            <h4 class="page--sub--title">OHAU MARKET REPORTS</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                        <div class="col s3">
                            <a href="#">All Anchorage Real Estate Prices</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 bottom-text">
                            <p>Search homes for sale in the Greater Anchorage Area. Real Estate Listings include large
                                photos, virtual tours, Google Maps and more.This website includes all the MLS Property
                                Listings in Anchorage, Eagle River, Chugiak/Peters Creek, Girdwood, Palmer, Wasilla.</p>
                            <p>
                                If you currently own real estate and are looking to research the Anchorage Area Real
                                Estate Market, this site contains information about Anchorage Sold Property Listings
                                giving you the
                                actual prices that homes and real estate sold for.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @include(Site::templateResolver('core::website.listings.partials.map'))
        </div>
    </div>
</section>
