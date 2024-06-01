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
                            <a href="{{ route('LikeVideo', ['id' => $video->id, 'status' => 'like']) }}"
                                class="p-2 hover:bg-zinc-500 rounded-lg w-100">Лайк {{ count($like) }}</a>
                            <a href="{{ route('LikeVideo', ['id' => $video->id, 'status' => 'dislike']) }}"
                                class="p-2 hover:bg-zinc-500 rounded-lg w-100">Дизлайк {{ count($dislike) }}</a>
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
                        <div class="flex justify-between items-start">
                            <section class="py-8 lg:py-16">
                                <div class="max-w-2xl mx-auto px-4">
                                    <div class="flex justify-between items-start mb-6">
                                        <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Комментарии
                                            ({{ count($comments) }})
                                        </h2>
                                    </div>
                                    <form class="mb-6" method="POST" action="{{ route('newComment') }}">
                                        <div
                                            class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                            <label for="comment" class="sr-only">Ваш комментарий</label>
                                            <textarea id="comment" rows="6" name="message"
                                                class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                                                placeholder="Ваш комментарий" required></textarea>
                                        </div>
                                        <button type="submit"
                                            class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                                            Опубликовать
                                        </button>
                                    </form>
                                    <article class="p-6 text-base bg-white rounded-lg dark:bg-gray-900">
                                        <footer class="flex justify-between items-center mb-2">
                                            <div class="flex items-center">
                                                <p
                                                    class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">
                                                    <img class="mr-2 w-6 h-6 rounded-full"
                                                        src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                                                        alt="Michael Gough">Michael Gough
                                                </p>
                                                <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate
                                                        datetime="2022-02-08" title="February 8th, 2022">Feb. 8, 2022</time>
                                                </p>
                                            </div>
                                            <button id="dropdownComment1Button" data-dropdown-toggle="dropdownComment1"
                                                class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 dark:text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                                type="button">
                                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="currentColor" viewBox="0 0 16 3">
                                                    <path
                                                        d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                                </svg>
                                                <span class="sr-only">Comment settings</span>
                                            </button>
                                            <!-- Dropdown menu -->
                                            <div id="dropdownComment1"
                                                class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                                    aria-labelledby="dropdownMenuIconHorizontalButton">
                                                    <li>
                                                        <a href="#"
                                                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a href="#"
                                                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
                                                    </li>
                                                    <li>
                                                        <a href="#"
                                                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </footer>
                                        <p class="text-gray-500 dark:text-gray-400">Very straight-to-point article. Really
                                            worth
                                            time reading. Thank you! But tools are just the
                                            instruments for the UX designers. The knowledge of the design tools are as
                                            important
                                            as the
                                            creation of the design strategy.</p>
                                        <div class="flex items-center mt-4 space-x-4">
                                            <button type="button"
                                                class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400 font-medium">
                                                <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z" />
                                                </svg>
                                                Reply
                                            </button>
                                        </div>
                                    </article>
                                </div>
                            </section>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
