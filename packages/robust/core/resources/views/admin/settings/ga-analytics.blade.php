<div class="system-settings__ga-analytics">
    {{Form::open(['route' => ['admin.settings.store'], 'method' => $ui->getMethod()])}}
        {{ Form::hidden('slug', $slug, [
                    'class' => 'form-control'
                ]) 
        }}
        <div class="form-group form-material row">
            <div class="col s12 input-field">                
                {{ Form::textarea('code', isset($settings['code'])?$settings['code']:'', [
                        'class' => 'form-control',
                        'rows' => 3
                    ]) 
                }}
                {{ Form::label('code', 'Head Script', ['class' => 'control-label' ]) }}
            </div>
        </div>

        <div class="form-group form-material row">
            <div class="col s12 input-field">                
                {{ Form::textarea('body-script', isset($settings['body-script'])?$settings['body-script']:'', [
                        'class' => 'form-control',
                        'rows' => 3
                    ]) 
                }}
                {{ Form::label('body-script', 'Body Script', ['class' => 'control-label' ]) }}
            </div>
        </div>
        <div class="form-group form-material">
            {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
        </div>
    {{Form::close()}}
</div>
