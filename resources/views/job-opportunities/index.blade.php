@extends('layouts.app')

@section('content')
    <job-list :jobs="{{ json_encode($jobOpportunities) }}"></job-list>
@endsection
