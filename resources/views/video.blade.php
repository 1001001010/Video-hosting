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
                        <div class=" whitespace-nowrap flex justify-between w-max gap-5">
                            <a href="{{ route('LikeVideo', ['id' => $video->id, 'status' => 'like']) }}"
                                class="p-2 hover:bg-zinc-300 rounded w-100 bg-gray-200 dark:text-black">Лайк
                                {{ count($like) }}</a>
                            <a href="{{ route('LikeVideo', ['id' => $video->id, 'status' => 'dislike']) }}"
                                class="p-2 hover:bg-zinc-300 rounded w-100 bg-gray-200 dark:text-black">Дизлайк
                                {{ count($dislike) }}</a>
                        </div>
                        <div class="flex gap-5" style="align-items: center">
                            <h1 class="font-semibold text-2xl">{{ $video->name }}</h1>
                        </div>
                        <p class="h-min">{{ $video->created_at->format('M. j, Y h:m') }}</p>
                        <h1 class="pb-6 font-semibold text-1xl">{{ $video->description }}</h1>
                        <h1 class="font-semibold">Автор: {{ $video->user->name }}</h1>

                        @if (Auth::user() and Auth::user()->is_admin == true)
                            <a href="{{ route('BanVideo', ['id' => $video->id, 'status' => 'unban']) }}"
                                class="mt-2 inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-800 uppercase tracking-widest hover:bg-gray-600 dark:hover:bg-white {{ $video->visibility == 'unban' ? 'bg-slate-600 dark:bg-white' : '' }} transition ease-in-out duration-150">Нет
                                ограничений</a>
                            <a href="{{ route('BanVideo', ['id' => $video->id, 'status' => 'violation']) }}"
                                class="mt-2 inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-800 uppercase tracking-widest hover:bg-gray-600 dark:hover:bg-white {{ $video->visibility == 'violation' ? 'bg-slate-600 dark:bg-white' : '' }} transition ease-in-out duration-150">Нарушение</a>
                            <a href="{{ route('BanVideo', ['id' => $video->id, 'status' => 'shadow_ban']) }}"
                                class="mt-2 inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-800 uppercase tracking-widest hover:bg-gray-600 dark:hover:bg-white {{ $video->visibility == 'shadow_ban' ? 'bg-slate-600 dark:bg-white' : '' }} transition ease-in-out duration-150">Теневой
                                бан</a>
                            <a href="{{ route('BanVideo', ['id' => $video->id, 'status' => 'ban']) }}"
                                class="mt-2 inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-800 uppercase tracking-widest hover:bg-gray-600 dark:hover:bg-white  {{ $video->visibility == 'ban' ? 'bg-slate-600 dark:bg-white' : '' }} transition ease-in-out duration-150">Бан</a>
                        @endif
                    </div>
                    <div class="p-6 text-gray-900 dark:text-gray-100 h-auto w-3/6">
                        <div class="flex justify-between items-start">
                            <section class="py-8 lg:py-16 w-screen">
                                <div class="mx-auto">
                                    <div class="flex justify-between items-start mb-6">
                                        <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Комментарии
                                            ({{ count($comments) }})
                                        </h2>
                                    </div>
                                    <form class="mb-6" method="POST"
                                        action="{{ route('newComment', ['id' => $video->id]) }}">
                                        @csrf
                                        <div
                                            class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                            <label for="comment" class="sr-only">Ваш комментарий</label>
                                            <textarea id="comment" rows="6" name="message"
                                                class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                                                placeholder="Ваш комментарий" required></textarea>
                                        </div>
                                        <button type="submit"
                                            class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center border text-gray-500 bg-primary-900 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                                            Опубликовать
                                        </button>
                                    </form>
                                    @foreach ($comments as $comment)
                                        <article class="p-6 mb-5 text-base bg-gray-200 rounded-lg dark:bg-gray-900">
                                            <footer class="flex justify-between items-center mb-2 w-max">
                                                <div class="flex items-center">
                                                    <p
                                                        class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">
                                                        {{ $comment->user->name }}
                                                    </p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate
                                                            datetime="2022-02-08"
                                                            title="February 8th, 2022">{{ $comment->created_at->format('M. j, Y h:m') }}</time>
                                                    </p>
                                                </div>

                                            </footer>
                                            <p class="text-gray-500 dark:text-gray-400">{{ $comment->message }}</p>
                                        </article>
                                    @endforeach
                                </div>
                            </section>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
