@extends(Site::templateResolver('real-estate::website.layouts.default'))

@inject('location_helper','Robust\RealEstate\Helpers\LocationHelper')
@inject('marketreport_helper','Robust\RealEstate\Helpers\MarketReportHelper')

@set('locations',$location_helper->getLocations(['cities','counties','zips']))
@set('settings', config('rws.market-report'))

@section('header')
    <header class="sub-header">
        <div class="container-fluid">
            <div class="site-menu">
                @include(Site::templateResolver('real-estate::website.frontpage.partials.menu'))
            </div>
        </div>
    </header>
@endsection
@section('body_section')
    <section class="market market-insight main-content" data-page='{{$page_type}}'>        
            <div class="container-fluid">
                @include(Site::templateResolver('real-estate::website.market-report.partials.info'))
                @if(isset($data['records']))
                    <h5> {{ $title }} Subdivisions </h5>
                    @include(Site::templateResolver('real-estate::website.market-report.partials.tool-box'))
                    @include(Site::templateResolver('real-estate::website.market-report.partials.locations'),
                    [
                        'records' => $data['records']??[]
                    ])
                @endif
            </div>       
        <div class="container-fluid">
            <div class="market-insight__stat">
                <h4> Monthly Summary Report </h4>
                <div class="market-insight__stat-container">
                    <table class="table striped">
                        <thead>
                            <tr>
                                <th>Year</th>
                                <th class="text-center">#Props Active</th>
                                <th class="text-center">#Props Sold</th>
                                <th class="text-center">Average Price</th>
                                <th class="text-center">Avg. Days List-Sell</th>
                                <th class="text-center">%Sale-to-List Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['insights'] as $insight)
                                <tr class="text-center">
                                    <th scope="text-left">{{ $insight->active_count}}</th>
                                    <td>{{ $insight->system_price}}</td>
                                    <td>{{ $insight->system_price}}</td>
                                    <td>{{ $insight->system_price}}</td>
                                    <td>{{ $insight->system_price}}</td>
                                    <td>{{ $insight->system_price}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('footer')
    @include(Site::templateResolver('real-estate::website.frontpage.partials.footer'))
@endsection

