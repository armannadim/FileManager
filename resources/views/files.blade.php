@extends('layout.master')

@section('title', 'Files')

@section('sidebar')
    @parent

@endsection

@section('content')


    <div class="ui dividing header">Files of <h2 class="">{{ $person->name }} </h2>
        <button class="ui inverted blue button" style="float: right" onclick="$('.ui.modal').modal('show');">
            <i class="icon user"></i>
            Add Files
        </button>
    </div>
    <p>Click on the icon to see the file.</p>
    <div class="ui four doubling stackable cards">
        @foreach($files as $file)

                <!--<a class="ui card" target="_blank" href="{{URL('file/'.$file['path'])}}">-->
        <a class="ui card" target="_blank"
           href="{{ \App\Http\Controllers\Controller::getFile($file['dirname'], $file['basename'])}}">
            <div class="image" style="padding: 50px;">
                <img src="{{  URL::asset('assets/images/file_ext/'. $file['extension'] .'.png') }} ">
            </div>
            <div class="content">
                <div class="">{{  $file['basename'] }}</div>
                <div class="header"></div>
            </div>
        </a>

        @endforeach
    </div>

    <div class="ui small modal">
        <i class="close icon"></i>
        <div class="header">
            Add Files
        </div>
        <form class="ui form six" enctype="multipart/form-data" method="POST" action="{{URL('add-files')}}">
            {{ csrf_field() }}
            <input type="hidden" name="person_id" value="{{ $person->person_id }}">
            <div class="content">
                <div class="description" style="padding: 20px;">
                    <div class="field">
                        <label>Caption</label>
                        <div class="two fields">
                            <div class="field">
                                <input type="text" name="caption" placeholder="File name">
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label>Upload File</label>
                        <input type="file" name="file" placeholder="file">
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