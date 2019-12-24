<?php
namespace Robust\RealEstate\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Robust\RealEstate\Repositories\Website\MarketReportRepository;

/**
 * Class MarketReportController
 * @package Robust\RealEstate\Controllers\Website
 */
class MarketReportController extends Controller
{

    /**
     * @var MarketReportRepository
     */
    protected $model;


    /**
     * MarketReportController constructor.
     * @param MarketReportRepository $model
     */
    public function __construct(MarketReportRepository $model)
    {
        $this->model = $model;
    }


    /**
     * @param Request $request
     * @param $location_type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $location_type){
        $records = $this->model->getReports($location_type)
        //->wherePriceBetween(explode('-', $data['price']))
        ->get();
        return view('real-estate::website.market-report.index', [
            'records' => $records,
            'page_content' => 'market-report',
            'page_type' => $location_type]
        );
    }


    /**
     * @param Request $request
     * @param $location_type
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getInsight(Request $request, $location_type, $slug){
        $response = $this->model->getInsight($location_type, $slug);
        return view('real-estate::website.market-report.insight', [
            'data' => $response,
            'isInsight' => true,
            'page_type' => $location_type,
            'page_content' => 'insight',
            'title' => ucwords(str_replace('-', ' ', $slug)),
            'sub_location_type' => $response['sub_location_type'] ?? null
        ]);
    }
}
