@extends('layouts.main')

@section('content')
    <div class="py-12">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @if (($video->visibility == 'violation' or $video->visibility == 'ban') and Auth::user()->is_admin == false)
                    <h1 class="p-3 font-semibold">Видео недоступно</h1>
                @else
                    <div class="p-6 w-full text-gray-900 dark:text-gray-100 flex justify-center">
                        <video class="" autoplay controls controlsList="nodownload">
                            <source src="{{ asset($video->path) }}" type="video/mp4">
                        </video>
                    </div>
                    <div class="p-6 text-gray-900 dark:text-gray-100 h-auto">
                        <div class=" whitespace-nowrap flex justify-between w-max">
                            <button class="p-2 hover:bg-zinc-500 rounded-lg w-100">Лайк {{ $video->count_like }}</button>
                            <button class="p-2 hover:bg-zinc-500 rounded-lg w-100">Дизлайк
                                {{ $video->count_dislike }}</button>
                        </div>
                        <div class="flex gap-5" style="align-items: center">
                            <h1 class="font-semibold text-2xl">{{ $video->name }}</h1>
                        </div>
                        <p class="h-min">{{ date('d-m-Y h:m', strtotime($video->created_at)) }}</p>
                        <h1 class="pb-6 font-semibold text-1xl">{{ $video->description }}</h1>
                        <h1 class="font-semibold">Автор: {{ $video->user->name }}</h1>

                        @if (Auth::user() and Auth::user()->is_admin == true)
                            <a href="{{ route('BanVideo', ['id' => $video->id, 'status' => 'unban']) }}"
                                class="mt-2 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white {{ $video->visibility == 'unban' ? 'bg-gray-700 dark:bg-white' : '' }} transition ease-in-out duration-150">Нет
                                ограничений</a>
                            <a href="{{ route('BanVideo', ['id' => $video->id, 'status' => 'violation']) }}"
                                class="mt-2 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white {{ $video->visibility == 'violation' ? 'bg-gray-700 dark:bg-white' : '' }} transition ease-in-out duration-150">Нарушение</a>
                            <a href="{{ route('BanVideo', ['id' => $video->id, 'status' => 'shadow_ban']) }}"
                                class="mt-2 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white {{ $video->visibility == 'shadow_ban' ? 'bg-gray-700 dark:bg-white' : '' }} transition ease-in-out duration-150">Теневой
                                бан</a>
                            <a href="{{ route('BanVideo', ['id' => $video->id, 'status' => 'ban']) }}"
                                class="mt-2 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white {{ $video->visibility == 'ban' ? 'bg-gray-700 dark:bg-white' : '' }} transition ease-in-out duration-150">Бан</a>
                        @endif
                    </div>
                    <div class="p-6 text-gray-900 dark:text-gray-100 h-auto">
                        <h1 class="font-semibold text-2xl">Комментарии</h1>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
