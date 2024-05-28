@extends('layouts.main')

@section('content')
    <div class="py-12">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 w-full text-gray-900 dark:text-gray-100 flex justify-center">
                    <video class="" autoplay controls controlsList="nodownload">
                        <source src="{{ asset($video->path) }}" type="video/mp4">
                    </video>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100 h-auto">
                    <div class=" whitespace-nowrap flex justify-between w-min bg-zinc-400 rounded-lg">
                        <button class="p-2 hover:bg-zinc-500 rounded-lg">Лайк {{ $video->count_like }}</button>
                        <button class="p-2 hover:bg-zinc-500 rounded-lg">Дизлайк {{ $video->count_dislike }}</button>
                    </div>
                    <div class="flex gap-5" style="align-items: center">
                        <h1 class="font-semibold text-2xl">{{ $video->name }}</h1>
                        <p class="h-min">{{ date('d-m-Y h:m', strtotime($video->created_at)) }}</p>
                    </div>
                    <h1 class="pb-6 font-semibold text-1xl">{{ $video->description }}</h1>
                    <h1 class="font-semibold">Автор: {{ $video->user->name }}</h1>

                    @if (Auth::user()->is_admin == true)
                        @if ($video->visibility == 1)
                            <a href="{{ route('BanVideo', ['id' => $video->id]) }}"
                                class="mt-2 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Скрыть</a>
                        @else
                            <a href="{{ route('BanVideo', ['id' => $video->id]) }}"
                                class="mt-2 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Отобразить</a>
                        @endif
                    @endif
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100 h-auto">
                    <h1 class="font-semibold text-2xl">Комментарии</h1>
                </div>
            </div>
        </div>
    </div>
@endsection
