<!DOCTYPE html>
<html>
<head>
    <title>File Manager - @yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{  URL::asset('semantic/dist/semantic.min.css') }}">

    <script src="{{  URL::asset('assets/jquery.min.js') }}"></script>
    <script src="{{  URL::asset('semantic/dist/semantic.min.js') }}"></script>


   <!-- <link rel="stylesheet" type="text/css" href="{{  URL::asset('semantic/dist/components/reset.css') }}">
    <link rel="stylesheet" type="text/css" href="{{  URL::asset('semantic/dist/components/site.css') }}">

    <link rel="stylesheet" type="text/css" href="{{  URL::asset('semantic/dist/components/container.css') }}">
    <link rel="stylesheet" type="text/css" href="{{  URL::asset('semantic/dist/components/grid.css') }}">
    <link rel="stylesheet" type="text/css" href="{{  URL::asset('semantic/dist/components/header.css') }}">
    <link rel="stylesheet" type="text/css" href="{{  URL::asset('semantic/dist/components/image.css') }}">
    <link rel="stylesheet" type="text/css" href="{{  URL::asset('semantic/dist/components/menu.css') }}">

    <link rel="stylesheet" type="text/css" href="{{  URL::asset('semantic/dist/components/divider.css') }}">
    <link rel="stylesheet" type="text/css" href="{{  URL::asset('semantic/dist/components/list.css') }}">
    <link rel="stylesheet" type="text/css" href="{{  URL::asset('semantic/dist/components/segment.css') }}">
    <link rel="stylesheet" type="text/css" href="{{  URL::asset('semantic/dist/components/dropdown.css') }}">
    <link rel="stylesheet" type="text/css" href="{{  URL::asset('semantic/dist/components/icon.css') }}">-->
    <style type="text/css">

        body {
            background-color: #FFFFFF;
        }

        .ui.menu .item img.logo {
            margin-right: 1.5em;
        }

        .main.container {
            margin-top: 7em;
        }

        .wireframe {
            margin-top: 2em;
        }

        .ui.footer.segment {
            margin: 5em 0em 0em;
            padding: 5em 0em;
        }

    </style>
</head>
<body>

<div class="ui fixed inverted menu">
    @section('sidebar')

        <div class="ui container">
            <a href="{{ URL('/') }}" class="header item">
                <img class="logo" src="{{  URL::asset('assets/images/logo.png') }}">
                Personal File Management
            </a>

        </div>

    @show
</div>
<div class="ui main text container">
    @yield('content')
</div>

<div class="ui inverted vertical footer segment">
    <div class="ui center aligned container">
        <div class="ui inverted section divider"></div>
        <img src="{{  URL::asset('assets/images/logo.png') }}" class="ui centered mini image">
        <div class="ui horizontal inverted small divided link list">
            <span>Developed by </span><a class="item" href="http://www.armannadim.com">Aseq A Arman Nadim</a>
        </div>
    </div>
</div>
</body>
</html>