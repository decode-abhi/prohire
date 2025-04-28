@extend('recruiter.recruiter-layout')
<h1>Welcome recruiter!</h1>
<p>Your dashboard content goes here.</p>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <x-alert-message />

    <button type="submit">Logout</button>
</form>
</body>
</html>