@extends('jobseeker.jobseeker-layout')
@section('content')
 @include('message')
    <h1>content</h1>
    <p><a href="{{route('job.index')}}">view all jobs</a></p>
@endsection