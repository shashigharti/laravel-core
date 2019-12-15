<?php
namespace Robust\RealEstate\Repositories\API;

use Robust\RealEstate\Models\Location;

/**
 * Class LocationRepository
 * @package Robust\RealEstate\Repositories\API
 */
class LocationRepository
{
    /**
     * @var Location
     */
    protected $model;

    protected const FIELDS_QUERY_MAP = [
        'name' => ['name' => 'name', 'condition' => 'LIKE'],
        'type' => ['name' => 'type', 'condition' => 'LIKE'],
        'id' => ['name' => 'id', 'condition' => '='],
        'status' => ['name' => 'status', 'condition' => '='],
        'type' => ['name' => 'locationable_type', 'condition' => '=']
    ];

     protected const RELATION_MAP = [
        'cities' => ['class' => '\Robust\RealEstate\Models\City'],
        'zips' => ['class' => '\Robust\RealEstate\Models\Zip'],
        'counties' => ['class' => '\Robust\RealEstate\Models\County'],
        'high-schools' => ['class' => '\Robust\RealEstate\Models\HighSchool'],
        'elementary-schools' => ['class' => '\Robust\RealEstate\Models\ElementarySchool'],
        'middle-schools' => ['class' => '\Robust\RealEstate\Models\MiddleSchool']
    ];

    /**
     * LocationRepository constructor.
     * @param Location $model
     */
    public function __construct(Location $model)
    {
        $this->model = $model;
    }

    /**
     * @param $params
     * @return Eloquent Collection
     */
    public function getLocations($params = [], $fields = [])
    {
        $qBuilder = $this->model;

        // Get mapping locationable object for type
        $params = collect($params)->map(function ($value, $key) {
            if($key == 'type'){                
                return LocationRepository::RELATION_MAP[$value]['class'];
            }
            return $param;
        });


        // Limit the number of fields based on the params
        if(count($fields) > 0){
            $qBuilder = $qBuilder->select($fields);
        }
        
        foreach($params as $key => $param){
            $qBuilder->where(LocationRepository::FIELDS_QUERY_MAP[$key]['name'], 
            LocationRepository::FIELDS_QUERY_MAP[$key]['condition'],
            $param);
        }
        return $qBuilder->get();
    }
}
