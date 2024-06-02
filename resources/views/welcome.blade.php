@extends('layouts.main')

@section('content')
    <div class="py-12">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 grid grid-cols-4 gap-4">
                    @if (count($videos) == 0)
                        <p>Видео нет</p>
                    @else
                        @foreach ($videos as $video)
                            @if ($video->visibility == 'unban' or Auth::user()->is_admin == true)
                                <a href="{{ route('watchVideo', ['id' => $video->id]) }}" class="flex pb-6">
                                    <div
                                        class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                        <video class="w-96">
                                            <source src="{{ asset($video->path) }}" type="video/mp4">
                                        </video>
                                        <div class="p-5">
                                            <h5
                                                class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                                {{ $video->name }}</h5>
                                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                                {{ $video->created_at }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
