@extends('layout.master')

@section('title', 'Home Page')

@section('sidebar')
    @parent

@endsection

@section('content')

    <h2 class="ui dividing header" style="line-height: 40px!important;">Persons
        <button class="ui inverted blue button" style="float: right" onclick="$('.ui.modal').modal('show');">
            <i class="icon user"></i>
            Add Person
        </button>
    </h2>

    <p>Click on the image to see the file of the person.</p>
    <div class="ui three doubling stackable cards">
        @foreach($persons as $person)

            <a class="ui card" href="{{URL('files/'.$person['person_id'])}}">
                <div class="image">
                    <img src="assets/images/persons/{{ $person['image'] }}">

                </div>
                <div class="content">
                    <div class="header">{{ $person['name'] }}</div>
                    <div class="header">Total Files: {{ count($fileCount[$person['name']]) }}</div>
                </div>
            </a>

        @endforeach
    </div>

    <div class="ui small modal">
        <i class="close icon"></i>
        <div class="header">
            Add person
        </div>
        <form class="ui form six" enctype="multipart/form-data" method="POST" action="{{URL('add-person')}}">
            {{ csrf_field() }}
            <div class="content">
                <div class="description" style="padding: 20px;">
                    <div class="field">
                        <label>Name</label>
                        <div class="two fields">
                            <div class="field">
                                <input type="text" name="name" placeholder="Name">
                            </div>

                        </div>
                    </div>
                    <div class="field">
                        <label>Upload photo</label>
                        <input type="file" name="photo" placeholder="Photo">
                    </div>
                </div>
            </div>
            <div class="actions">
                <div class="ui black deny button">
                    Cancel
                </div>
                <button class="ui button" type="submit">Submit</button>

            </div>
        </form>
    </div>

@endsection