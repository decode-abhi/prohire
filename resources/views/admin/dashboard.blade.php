@extends('admin.admin-layout')
    <!-- admin/dashboard.blade.php -->
    @section('content')
<h1>Welcome admin!</h1>
<p>Your dashboard content goes here.</p>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>

@endsection