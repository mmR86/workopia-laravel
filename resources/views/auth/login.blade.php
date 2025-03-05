<x-layout>
    <div class="bg-white rounded-lg shadow md w-full md:max-w-xlmx-auto mt-12 p-8 py-12">
        <h2 class="text-4xl text-center font-bold mb-4">Login</h2>
        <form method="POST" action="{{route('login.authenticate')}}">
            @csrf
            <x-inputs.text id="email" name="email" type="email" placeholder="Email Adress" />
            <x-inputs.text id="password" name="password" type="password" placeholder="Password" />

            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded focus:outline-none">Login</button>
            <p class="mt-4 text-gry-500">Don't have an account?</p>
            <a href="{{route('register')}}" class="text-blue-900 font-bold">Register</a>
        </form>
    </div>
</x-layout>