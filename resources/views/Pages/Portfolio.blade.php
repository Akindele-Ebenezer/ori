@extends('Layouts.Layout-2')

@section('Title', 'Portfolio - ' . session()->get('APP_NAME'))

@section('Content')
<div class="video"> 
    <h1>🎥 Video Portfolios</h1>
    <div class="video-container"> 
        {{-- VIDEO --}}
        @foreach ($Portfolios as $video)
        <div class="mb-4">
            <h2>{{ $video->title ?: 'Untitled Video Presentation' }}</h2>
            <video width="500" controls>
                @php
                    $videoSource = $video->thumbnail ?: $video->title;
                @endphp
                <source src="{{ str_starts_with((string) $videoSource, 'http') ? $videoSource : asset('videos/' . basename((string) $videoSource)) }}" type="video/mp4">
            </video>
        </div> 
        @endforeach
    </div>
</div>
@endsection