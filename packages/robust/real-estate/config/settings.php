<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |-------------------------------------y-------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services your application utilizes. Set this in your ".env" file.
    |
    */  
    [
        'display_name' => 'Data Mapping',
        'slug' => 'data-mapping',
    ],
    [
        'display_name' => 'Advance Search',
        'slug' => 'advance-search',
        'property' => json_encode([
            "first_block" => ["search","property_type","status","pictures"],
            "second_block" => ["cities","counties","price","beds","bathrooms"],
            "third_block" => ["square_feet","year_built","stories","lot_description","exterior"],
            "fourth_block" => ["interior","elementary_schools","middle_schools","high_schools","pool","waterfront_details","design"]
        ])
    ],
    [
        'display_name' => 'Real Estate',
        'slug' => 'real-estate',
        'property' => json_encode([
            'application' => [
                'price' => [
                    'min' => 25000,
                    'max' => 5000000,
                    'increment' => 150000
                ]
            ],
           'market-report' => [
                'report-type' => ['cities', 'zips','school_districts']                    
           ]           
        ])
    ]
];