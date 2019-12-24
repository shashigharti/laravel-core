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
                    <div class="row">
                        <div class="col s12">
                            <h5> {{ $title }} Subdivisions </h5>
                        </div>
                    </div>
                    @include(Site::templateResolver('real-estate::website.market-report.partials.tool-box'))
                    @include(Site::templateResolver('real-estate::website.market-report.partials.locations'),
                    [
                        'records' => $data['records']??[]
                    ])
                @endif
            </div>       
        <div class="container-fluid">
            <div class="row">
                <div class="col s12">
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
                                        <th>{{ DateTime::createFromFormat('!m', $insight->month)->format('F') . ", " . $insight->year }}</th>
                                        <td>{{ $insight->active_count }}</td>
                                        <td>{{ $insight->sold_count }}</td>
                                        <td>${{ number_format($insight->system_price_avg) }}</td>
                                        <td>{{ $insight->days_on_mls_avg }}</td>
                                        <td>{{ $insight->percent }}%</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('footer')
    @include(Site::templateResolver('real-estate::website.frontpage.partials.footer'))
@endsection

