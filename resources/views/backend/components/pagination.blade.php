<nav aria-label="...">
    <ul class="pagination">
        <li class="page-item {{$paginator->onFirstPage() ? 'disabled' : ''}}">
            <a class="page-link" href="{{$paginator->previousPageUrl()}}" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <li class="page-item {{$paginator->currentPage() === $i ? 'active' : ''}}">
                <a class="page-link" href="{{$paginator->url($i)}}">{{$i}}</a>
            </li>
        @endfor
        <li class="page-item {{$paginator->hasMorePages() ? '' : 'disabled'}}">
            <a class="page-link" href="{{$paginator->nextPageUrl()}}" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>
</nav>
