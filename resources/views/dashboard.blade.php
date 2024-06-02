<x-app-layout>
    <div class="py-12 max-w-9xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100 h-auto">
                <h1 class="p-3 font-semibold">Мои видео</h1>
                <button type="button" data-modal-target="default-modal" data-modal-toggle="default-modal"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Загрузить видео
                </button>
            </div>
            <div class="p-6 text-gray-900 dark:text-gray-100 grid grid-cols-4 gap-4">
                @if (count($user_videos) == 0)
                    <p>Видео нет</p>
                @else
                    @foreach ($user_videos as $video)
                        @if ($video->visibility == 'shadow_ban' or $video->visibility == 'unban' or Auth::user()->is_admin == true)
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
    <div style="background-color: rgb(0, 0, 0, 0.4);" id="default-modal" tabindex="-1" aria-hidden="true"
        class=" hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] h-screen">
        <div class="relative p-4 w-1/2 max-w-9xl max-h-9xl">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Загрузка видео
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <form class="max-w-md mx-auto" method="POST" action="{{ route('NewVideo') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text" name="video_name" id="video_name"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                required />
                            <label for="video_name"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Название
                                видео</label>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <label for="video_message"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Описание
                                видео</label>
                            <textarea id="video_message" name="video_message" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Введите описание" required></textarea>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <label for="video_category"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Выберите
                                категорию</label>
                            <select id="video_category" name="category_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="video_file">Выберите файл</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="video_file" name="video_file" id="video_file" type="file" required>
                        </div>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Загрузить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
