@inject('advancesearch_helper', '\Robust\RealEstate\Helpers\AdvanceSearchHelper')
<div class="system-settings__advance-search">
    {{Form::open(['route' => ['admin.settings.store'], 'method' => $ui->getMethod()])}}
        <fieldset>
            <legend>Advance Search Filters</legend>
            <div class="row multi-select-container">
                <div class="col s6">
                    {{ Form::label('first_block', 'First Block', ['class' => 'control-label' ]) }}
                    {{ Form::select('first_block[]', $advancesearch_helper->getAdvanceSearchFilters(), 
                        isset($settings['first_block']) ? explode(",", $settings['first_block']):[], 
                        [
                            'class'=>'browser-default multi-select',
                            'multiple'
                        ]) 
                    }}
                </div>
                <div class="col s6">
                    {{ Form::label('second_block', 'Second Block', ['class' => 'control-label' ]) }}
                    {{ Form::select('second_block[]', $advancesearch_helper->getAdvanceSearchFilters(), 
                        isset($settings['first_block']) ? explode(",", $settings['first_block']):[],
                        [
                            'class'=>'browser-default multi-select',
                            'multiple'
                        ]) 
                    }}
                </div>
            </div>
            <div class="row multi-select-container">
            <div class="col s6">
                    {{ Form::label('third_block', 'Third Block', ['class' => 'control-label' ]) }}
                    {{ Form::select('third_block[]',  $advancesearch_helper->getAdvanceSearchFilters(),
                        isset($settings['first_block']) ? explode(",", $settings['first_block']):[],
                        [
                            'class'=>'browser-default multi-select',
                            'multiple'
                        ]) 
                    }}
                </div>
                <div class="col s6">
                    {{ Form::label('fourth_block', 'Fourth Block', ['class' => 'control-label' ]) }}
                    {{ Form::select('fourth_block[]',  $advancesearch_helper->getAdvanceSearchFilters(), 
                        isset($settings['first_block']) ? explode(",", $settings['first_block']):[], 
                        [
                        'class'=>'browser-default multi-select',
                        'multiple'
                        ]) 
                    }}
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Default Values For Filters</legend>
             <div class="col s4">
                {{ Form::label("default_values['cities']", 'Cities', ['class' => 'control-label' ]) }}
                {{ Form::select("default_values['cities']",  $advancesearch_helper->getAdvanceSearchFilters(),
                    isset($settings['default_values']['cities']) ? explode(",", $settings['default_values']['cities']):[],
                    [
                        'class'=>'browser-default multi-select',
                        'multiple'
                    ]) 
                }}
            </div>
            <div class="col s4">
                {{ Form::label("default_values['property_type']", 'Property Type', ['class' => 'control-label' ]) }}
                {{ Form::select("default_values['property_type']",  $advancesearch_helper->getAdvanceSearchFilters(),
                    isset($settings['default_values']['property_type']) ? explode(",", $settings['default_values']['property_type']):[],
                    [
                        'class'=>'browser-default multi-select',
                        'multiple'
                    ]) 
                }}
            </div>

            <div class="col s4">
                {{ Form::label("default_values['status']", 'Property Status', ['class' => 'control-label' ]) }}
                {{ Form::select("default_values['status']",  [
                        'active' => 'Properties for Sale',
                        'sold' => 'Sold'
                    ],
                    isset($settings['default_values']['status']) ? explode(",", $settings['default_values']['status']):[],
                    [
                        'class'=>'browser-default multi-select',
                        'multiple'
                    ]) 
                }}
            </div>
        </fieldset>
        <div class="form-group form-material">
            {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
        </div>
    {{Form::close()}}
</div>