@extends('layouts.main')

@section('content')
    <div class="py-12">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (count($videos) == 0)
                        <p>Видео нет</p>
                    @else
                        @foreach ($videos as $video)
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
