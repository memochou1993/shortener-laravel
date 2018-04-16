<div class="row">
    <div class="eight wide column">
        <form action="{{ route('generate') }}" method="POST" class="ui @if ($agent->isMobile()) small @else massive @endif form">
            {{ csrf_field() }}
                
            <div class="ui action input fluid">
                <input type="text" name="link" placeholder="http://" autocomplete="off" required>

                <button class="ui violet button" id="shorten">SHORTEN</button>
            </div>
        </form>
    </div>
</div>