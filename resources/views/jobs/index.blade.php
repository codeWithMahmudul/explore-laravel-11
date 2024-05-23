<x-layout>
    <x-slot:heading>Job Listings</x-slot:heading>


    <div class="space-y-4">
        @foreach ($jobs as $job)
            <article>
                <a href="/jobs/{{ $job['id'] }}" class="block px-4 py-6 border border-gray-200 rounded-lg">
                    <div>{{ $job->employer->name }}</div>
                   <div>
                    {{ $job['title'] }}: Pays {{ $job['salary'] }} per year.
                   </div>
                </a>
            </article>
        @endforeach
        <div>
            {{ $jobs->links() }}
        </div>
    </div>
</x-layout>
