@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="py-8">
        <div class="max-w-7xl mx-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 text-center">
                    <h2 class="text-2xl font-bold mb-2 py-4">{{$jobOpportunity->title}}</h2>
                </div>
                <div class="p-6 bg-white border-b border-gray-200 text-center">
                    <h5 class="text-sm font-bold mb-2">
                        {{$jobOpportunity->company_name}} / {{$jobOpportunity->location}}
                    </h5>
                </div>
                <div class="p-6 bg-white border-b border-gray-200 text-center">
                    <h6 class="text-sm font-bold mb-2">
                        {{$jobOpportunity->salary_range}}
                    </h6>
                </div>
                <div class="bg-white border-b border-gray-200 mx-4">
                    <p class="text-md mb-2">
                        <strong>Job Description</strong>: {{$jobOpportunity->description}}
                    </p>
                </div>
                <div class="bg-white border-b border-gray-200 mx-4">
                    <p class="text-md mb-2">
                        <strong>Skills</strong>:
                    </p>
                    <ul>
                        @foreach (explode(';', $jobOpportunity->skills) as $skill)
                            <li>{{ $skill }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="bg-white border-b border-gray-200 mx-4">
                    <div class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Apply to this Job</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">Use a permanent address where you can receive mail.</p>

                        <form action="{{ route('job-opportunities.apply') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <input type="hidden" name="opportunity" id="opportunity" value="{{$jobOpportunity->slug}}"/>
                                <div class="sm:col-span-3 py-2">
                                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                                    <div class="mt-2">
                                        <input type="text" name="name" id="name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div class="sm:col-span-3 py-2">
                                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                                    <div class="mt-2">
                                        <input id="email" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div class="sm:col-span-3 py-2">
                                    <label for="resume" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                        <span>Upload resume</span>
                                        <input id="resume" name="resume" type="file" accept=".pdf,.doc,.docx">
                                    </label>
                                </div>
                            </div>
                            <div class="mt-6 flex items-center justify-end gap-x-6 py-4">
                                <button type="submit" class="rounded-md px-3 py-2 text-sm font-semibold text-black">Apply</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
