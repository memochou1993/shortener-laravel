@extends('layouts.app')

@section('content')
    <div class="ui vertical orange inverted masthead center aligned segment">
        <div class="ui stackable center aligned grid">
            <div class="row">
                <a href="/">
                    <h1 class="ui inverted header">
                        URL Shortener
                    </h1>
                </a>
            </div>

            <div class="row">
                <h2>Simplify your links</h2>
            </div>

            @include('includes.form')

            @include('common.status')

            @include('common.errors')
        </div>
    </div>
    
    <div class="ui vertical stripe segment">
        <div class="ui stackable center aligned grid">
            <div class="eight wide column">
                <div id="links">
                    @include('link.part')
                </div>
            </div>
        </div>
    </div>

    <div class="ui inverted vertical footer segment">
        <div class="ui center aligned grid">
            <div class="row">
                © 2018 Memo Chou
            </div>
        </div>
    </div>
@endsection