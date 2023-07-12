@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="container mx-auto">
  <h1 class="text-2xl font-bold my-4 text-center">Update Job Opportunity</h1>

  <form action="{{ route('admin.job-opportunity.update', $jobOpportunity->slug) }}" method="POST" enctype="multipart/form-data">
    @csrf  
    @method('PUT')

    <div class="grid grid-cols-4 gap-4">
      <div class="col-span-4 sm:col-span-2 py-2">
        <label for="company_name" class="block font-medium">Company:</label>
        <input type="text" value="{{$jobOpportunity->company_name}}" style="width: 100%;" id="company_name" name="company_name" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
      </div>

      <div class="col-span-4 sm:col-span-2 py-2">
        <label for="location" class="block font-medium">Location:</label>
        <input type="text" value="{{$jobOpportunity->location}}" style="width: 100%;" id="location" name="location" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
      </div>

      <div class="col-span-4 sm:col-span-2 py-2">
        <label for="title" class="block font-medium">Job Title:</label>
        <input type="text" value="{{$jobOpportunity->title}}" style="width: 100%;" id="title" name="title" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
      </div>

      <div class="col-span-4 sm:col-span-2">
        <label for="salary_range" class="block font-medium">Salary Range:</label>
        <input type="text" value="{{$jobOpportunity->salary_range}}" style="width: 100%;" placeholder="" id="salary_range" name="salary_range" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
        <p class="text-sm text-gray-500">Hint: 30k-50k</p>
      </div>

      <div class="col-span-4 sm:col-span-2">
        <label for="skills" class="block font-medium">Skills:</label>
        <input type="text" value="{{$jobOpportunity->skills}}" style="width: 100%;" id="skills" name="skills" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
        <p class="text-sm text-gray-500">Semicolon-separated list: Skill1; Skill2; Skill3; ....</p>
      </div>

      <div class="col-span-4 sm:col-span-2 py-2">
        <label for="description" class="block font-medium">Description:</label>
        <textarea style="resize: none;width: 100%;" id="description" name="description" rows="4" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="5" required>
          {{$jobOpportunity->description}}
        </textarea>
      </div>

      <div class="col-span-4">
        <div class="flex justify-end">
          <button type="submit" class="px-4 py-2 bg-indigo-500 text-black font-medium rounded-md hover:bg-indigo-600">SAVE</button>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection
