
@if ($paginator->hasPages())
<ul class="pagination pagination-rounded justify-content-center mt-4">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="page-item disabled"> <a  class="page-link" href="javascript: void(0);"><i class="mdi mdi-chevron-left"></i></a></li>
        @else
        <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="mdi mdi-chevron-left"></i></a></li>
        @endif


        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled"><span>{{ $element }}</span></li>
            @endif


            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                     <li class="page-item active">
                                                        <a href="javascript: void(0);" class="page-link">{{ $page }}</a>
                                                    </li>
                    
                    @else
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach


        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="mdi mdi-chevron-right"></i></a></li>
        @else
        <li class="page-item disabled"> <a  class="page-link" href="javascript: void(0);"><span><i class="mdi mdi-chevron-right"></i></span></a></li>
        @endif
    </ul>
@endif