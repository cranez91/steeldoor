@extends('layouts.app')

@section('content')
<div class="container mx-auto">
  <h3 class="text-2xl font-bold my-4">List of Applicants</h3>

  <table class="min-w-full">
    <thead>
      <tr>
        <th class="py-1 px-4 bg-gray-100 border-b">Email</th>
        <th class="py-1 px-4 bg-gray-100 border-b">Name</th>
        <th class="py-1 px-4 bg-gray-100 border-b">Resume</th>
      </tr>
    </thead>
    <tbody>
      @if($applicants->count() == 0)
      <tr class="text-center">
        <td colspan="3" class="py-1 px-4 border-b">No applicants were found</td>
      </tr>
      @endif
      @foreach ($applicants as $applicant)
      <tr>
        <td class="py-1 px-4 border-b">{{ $applicant->email }}</td>
        <td class="py-1 px-4 border-b">{{ $applicant->name }}</td>
        <td class="py-1 px-4 border-b">
        <a href="{{ url('storage/resumes/' . $applicant->resume) }}" download>Download</a>    
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
