@extends(Site::templateResolver('core::website.layouts.default'))
@inject('banner_helper','Robust\Banners\Helpers\BannerHelper')
@section('header')
    @include(Site::templateResolver('real-estate::website.frontpage.partials.header'))
@endsection
@section('body_section')
    <section class="market market-insight main-content" data-page='{{$page_type}}'>

        @if(isset($data['records']))
            <div class="container-fluid">
                @include(Site::templateResolver('real-estate::website.market-report.partials.info'))
                @include(Site::templateResolver('real-estate::website.market-report.partials.tool-box'))
                @include(Site::templateResolver('real-estate::website.market-report.partials.locations'),
                ['records' => $data['records']??[]])
            </div>
        @endif
        <div class="container-fluid">
            <div class="market-insight__stat">
                <h4> Monthly Summary Report </h4>
                <div class="market-insight__stat-container">
                    <table class="table striped">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th class="text-center">#Props Active</th>
                                <th class="text-center">#Props Sold</th>
                                <th class="text-center">Average Price</th>
                                <th class="text-center">Avg. Days List-Sell</th>
                                <th class="text-center">%Sale-to-List Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <th scope="text-left">5</th>
                                <td>10</td>
                                <td>11</td>
                                <td>12</td>
                                <td>13</td>
                                <td>14</td>
                            </tr>
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
    @include(Site::templateResolver('core::website.frontpage.partials.footer'))
@endsection

