<!-- resources/views/jobs/search.blade.php -->
<form action="{{ route('jobs.search') }}" method="GET">
    <input type="text" name="keyword" placeholder="Search jobs or PDFs" value="{{ request('keyword') }}">
    <button type="submit">Search</button>
</form>

<!-- Display search results -->
@if($jobs->isNotEmpty())
    <ul>
        @foreach($jobs as $job)
            <li>
                <strong>{{ $job->title }}</strong><br>
                {{ Str::limit($job->description, 100) }}<br>
                <!-- Display associated PDF content -->
                @if($job->pdfDocuments)
                    @foreach($job->pdfDocuments as $pdf)
                        <div>{{ Str::limit($pdf->content, 150) }}</div>
                    @endforeach
                @endif
            </li>
        @endforeach
    </ul>
    {{ $jobs->links() }}
@else
    <p>No jobs found.</p>
@endif
