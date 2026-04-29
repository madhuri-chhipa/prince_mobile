@if ($paginator->hasPages())
<ul class="pagination">
    @if ($paginator->onFirstPage())
        <li class="page-item disabled"><a class="page-link"><span>&laquo;</span></a></li>
    @else
        <li class="page-item"><a href="{{ route('products', ['cat_slug' => request()->cat_slug, 'search' => request()->search, 'sort' => 'price', 'order' => request()->order, 'page'=> ($paginator->currentPage()-1)]) }}" class="page-link" rel="prev">&laquo;</a></li>
    @endif
   <!-- Pagination Elements -->
    @foreach($elements as $element)
        @if (is_string($element))
            <li class="page-item disabled"><a class="page-link"><span>{{ $element }}</span></a></li>
        @endif
        @if(is_array($element))
            @foreach($element as $page => $url)
                @if($page == $paginator->currentPage())
                    <li class="page-item active"><a class="page-link"><span>{{$page}}</span></a></li>
                @else
                    <li class="page-item" >
                        <a class="page-link" href="{{route('products', ['cat_slug' => request()->cat_slug, 'search' => request()->search,  'sort' => 'price', 'order' => request()->order, 'page'=> $page]) }}">{{ $page }}</a>
                    </li>
                @endif
            @endforeach
        @endif
    @endforeach
    @if ($paginator->hasMorePages())
    <li class="page-item">
        <a class="page-link" href="{{ route('products', ['cat_slug' => request()->cat_slug, 'search' => request()->search, 'sort' => 'price', 'order' => request()->order, 'page'=> ($paginator->currentPage()+1)]) }}" rel="next"><span>&raquo;</span></a>
    </li>
    @else
        <li class="page-item disabled">
            <a class="page-link"><span>&raquo;</span></a>
        </li>
    @endif
</ul>

@else
    
@endif