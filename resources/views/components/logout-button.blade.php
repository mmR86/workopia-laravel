<form method="POST" action="{{route('logout')}}">
    @csrf
    <button type="submit" class="text-white ml-5 md:ml-0">
        <i class="fa fa-sign-out"></i> Logout
    </button>
</form>