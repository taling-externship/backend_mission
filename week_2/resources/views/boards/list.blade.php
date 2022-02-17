@extends('layout.default')
@section('content')
    <div class="flex justify-center">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <form action="{{ route('boards') }}" method="get" class="p-4"
                      style="display: flex; align-items: center;">
                    <label for="table-search" class="sr-only">Search</label>
                    <input type="search"
                           name="search"
                           style="margin-right: 10px"
                           class="col form-control relative flex-auto min-w-0 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                           placeholder="Search" aria-label="Search" aria-describedby="search"/>
                    <button
                        class="btn inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700  focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out flex items-center"
                        type="submit"
                        id="search">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search" class="w-4"
                             role="img"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor"
                                  d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
                        </svg>
                    </button>
                </form>
                <div class="p-4 text-right">
                    <a class="btn bg-blue-600 text-white m-auto p-3
                        font-medium text-xs leading-tight uppercase rounded shadow-md
                        hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700  focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition
                        duration-150 ease-in-out items-center"
                       href="{{ route('boards.create')  }}">작성</a>
                </div>
                <div class="overflow-hidden">
                    <table class="min-w-full">
                        <thead class="border-b">
                        <tr>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-center">
                                #
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                제목
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-center">
                                작성일
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-center">
                                수정
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-center">
                                삭제
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($boards as $board)
                            <tr class="border-b">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                                    {{ $board->id }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('boards.detail', ['slug' => $board->slug ]) }}">
                                        {{ $board->title }}
                                    </a>
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center">
                                    {{ date('Y년 m월 d일', strtotime($board->created_at)) }}
                                </td>
                                <td class="text-sm text-gray-900 text-red font-light px-6 py-4 whitespace-nowrap text-center">
                                    <a href="{{ route('boards.edit', ['id' => $board->id ]) }}">
                                        수정
                                    </a>
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center">
                                    <form action="{{ route('boards.delete', ['id' => $board->id ]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">삭제</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr class="border-b">
                                <td colspan="5"
                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                                    비엇다
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $boards->links() }}
            </div>
        </div>
    </div>
@stop
