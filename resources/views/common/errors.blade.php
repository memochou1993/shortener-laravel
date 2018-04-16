@if ($errors->first('link'))
    <div class="row">
        <div class="five wide column">
            <div class="ui error message fluid">
                <i class="close icon"></i>
                
                <div class="header">
                    {{ $errors->first('link') }}
                </div>
            </div>
        </div>
    </div>
@endif