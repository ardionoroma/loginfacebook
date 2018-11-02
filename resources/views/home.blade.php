@extends('layouts.app')

@section('content')
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-sm-8">

            <div class="card hovercard">
                <div class="cardheader">

                </div>
                <div class="avatar">
                    <img alt="" src="{{ Auth::user()->profpic }}">
                </div>
                <div class="info">
                    <div class="title">
                        <a target="_blank" href="https://facebook.com">{{ Auth::user()->name }}</a>
                    </div>
                    <div class="desc">{{ Auth::user()->email }}</div>
                    <div class="desc">Last Login: {{ Auth::user()->lastlogin }}</div>
                    <div class="desc"><br></div>
                </div>
                <div class="bottom">
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
