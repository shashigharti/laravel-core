<?php

return [
    'data-field-mapping' => [
        'sold' => 'closed'                
    ],
    'market-report' => [
        'report-type' => [
            'cities' => 'City', 
            'zips' => 'Zip Code', 
            'school_districts' => 'School District'
        ],
        'price-range' => [
            'min' => 0, 
            'max' => 44500000, 
            'increment' => 1500000,
            'default' => ['average' => '3010000'],
            'field-to-compare' => 'median_price_active'
        ]
        
    ],
    'sorting' => [
        ['display' => 'Recently Added', 'value' => 'input_date-desc'],
        ['display' => 'Price High - Low', 'value' => 'system_price-asc'],
        ['display' => 'Price Low - High', 'value' => 'system_price-desc'],        
        ['display' => 'Recently Sold 7 Days', 'value' => 'sold_date-7_days'],
        ['display' => 'Recently Sold 14 Days', 'value' => 'sold_date-14_days'],
        ['display' => 'Recently Sold 30 Days', 'value' => 'sold_date-30_days']
    ],
    'data' => [
        'listings-price' => ['min' => 10000, 'condition' => '>=', 'field-to-compare' => 'system_price'],
        'timeframe' => "- 365 day"
    ],
    // third party server field mapping with listing properties
    'advance-search' => [
        'lot_description' => [
            'blade' => 'attributes-select-remote',
            'display_name' => 'Lot Description'
        ],
        'design' => [
            'blade' => 'attributes-select-remote',
            'display_name' => 'Architectural Style'
        ],
        'waterfront_details' => [
            'blade' => 'attributes-select-remote',
            'display_name' => 'Lot Water Features'
        ],
        'interior' => [
            'blade' => 'attributes-select-remote',
            'display_name' => 'Interior'
        ],
        'exterior' => [
            'blade' => 'attributes-select-remote',
            'display_name' => 'Exterior'
        ],
        'pool' => [
            'blade' => 'attributes-select-remote',
            'display_name' => 'Pool'
        ],
        'counties' => [
            'blade' => 'locations-select-remote',
            'display_name' => 'Counties'
        ],
        'cities' => [
            'blade' => 'locations-select-remote',
            'display_name' => 'City'
        ],
        'zips' => [
            'blade' => 'locations-select-remote',
            'display_name' => 'Zip'
        ],
        'elementary_schools' => [
            'blade' => 'locations-select-remote',
            'display_name' => 'Elementary School'
        ],
        'middle_schools' => [
            'blade' => 'locations-select-remote',
            'display_name' => 'Middle School'
        ],
        'high_schools' => [
            'blade' => 'locations-select-remote',
            'display_name' => 'High School'
        ]
        
    ]


];

?>