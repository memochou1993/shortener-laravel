@if (session('status'))
    <div class="row">
        <div class="five wide column">
            <div id="loading">
                <img src="{{ asset('img/loading.svg') }}" alt="Loading...">
            </div>

            <div class="ui success message fluid" hidden>
                <h1>Successfully Created!</h1>

                <div class="ui big action input fluid">
                    <input type="text" value="{{ config('app.url') }}/{{ $new_link }}">

                    <button class="ui teal icon button">
                        <i class="copy icon"></i>
                    </button>
                </div>
            </div>

            <div id="copied" hidden>
                <h3>Copied!</h3>
            </div>
        </div>
    </div>
@endif