@extends('Layouts.Layout-2')

@section('Title', 'Portfolio - ' . session()->get('APP_NAME'))

@section('Content')
<div class="video"> 
    <h1>🎥 Video Presentations</h1>
    <div class="video-container"> 
        {{-- VIDEO --}}
        @foreach ($Portfolios as $video)
        <div class="mb-4">
            <video width="500" controls>
                <source src="{{ asset('videos/' . $video->title) }}" type="video/mp4">
            </video>
        </div> 
        @endforeach
    </div>
</div>
@endsection