@extends('layouts.app')

@section('content')
<div class="container mx-auto">
  <h3 class="text-2xl font-bold my-4">List of Jobs</h3>
  
  <table class="min-w-full">
    <thead>
      <tr>
        <th class="py-1 px-4 bg-gray-100 border-b">Company</th>
        <th class="py-1 px-4 bg-gray-100 border-b">Location</th>
        <th class="py-1 px-4 bg-gray-100 border-b">Title</th>
        <th class="py-1 px-4 bg-gray-100 border-b">Applicants</th>
        <th colspan="2" class="py-1 px-4 bg-gray-100 border-b text-center">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($jobs as $job)
      <tr>
        <td class="py-1 px-4 border-b">{{ $job->company_name }}</td>
        <td class="py-1 px-4 border-b">{{ $job->location }}</td>
        <td class="py-1 px-4 border-b">{{ $job->title }}</td>
        <td class="py-1 px-4 border-b">
          <a href="{{ route('admin.job-opportunity.applicants', $job->slug) }}"
            class="px-4 py-2 bg-blue-500 text-black font-medium rounded-md hover:bg-blue-600">
            View
          </a>
        </td>
        <td class="py-1 px-4 border-b">
          <a href="{{ route('admin.job-opportunity.edit', $job->slug) }}"
            class="px-4 py-2 bg-blue-500 text-black font-medium rounded-md hover:bg-blue-600">
            Modify
          </a>
        </td>
        <td class="py-1 px-4 border-b">
          <form action="{{ route('admin.job-opportunity.destroy', $job->slug) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-2 py-1 bg-red-500 text-black font-medium rounded-md hover:bg-red-600">Remove</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<div class="container mx-auto text-center">
    <a class="text-2xl font-bold my-4" href="{{ route('admin.job-opportunity.create') }}">Create New</a>
</div>
@endsection
