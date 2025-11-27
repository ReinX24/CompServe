@if ($paginator->hasPages())
    <nav class="flex flex-col items-center gap-4 py-4">

        {{-- Small screens (Previous / Next only) --}}
        <div class="sm:hidden flex w-full justify-between">
            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <button class="btn btn-disabled w-1/2">« Prev</button>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="btn btn-primary w-1/2">« Prev</a>
            @endif

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="btn btn-primary w-1/2 ml-2">Next »</a>
            @else
                <button class="btn btn-disabled w-1/2 ml-2">Next »</button>
            @endif
        </div>

        {{-- Desktop pagination --}}
        <div class="hidden sm:flex sm:flex-col sm:items-center gap-3">

            {{-- Showing info --}}
            <p class="text-sm opacity-70">
                Showing
                <span class="font-semibold">{{ $paginator->firstItem() }}</span>
                to
                <span class="font-semibold">{{ $paginator->lastItem() }}</span>
                of
                <span class="font-semibold">{{ $paginator->total() }}</span>
                results
            </p>

            {{-- Numbered Pagination --}}
            <div class="join">
                {{-- Previous Arrow --}}
                @if ($paginator->onFirstPage())
                    <button class="join-item btn btn-disabled">«</button>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}"
                        class="join-item btn btn-primary">«</a>
                @endif

                {{-- Page Numbers --}}
                @foreach ($elements as $element)
                    {{-- Ellipses ("...") --}}
                    @if (is_string($element))
                        <button
                            class="join-item btn btn-square btn-disabled">{{ $element }}</button>
                    @endif

                    {{-- Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <button
                                    class="join-item btn btn-square btn-active btn-primary">{{ $page }}</button>
                            @else
                                <a href="{{ $url }}"
                                    class="join-item btn btn-square">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Arrow --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}"
                        class="join-item btn btn-square btn-primary">»</a>
                @else
                    <button class="join-item btn btn-disabled">»</button>
                @endif
            </div>
        </div>

    </nav>
@endif
