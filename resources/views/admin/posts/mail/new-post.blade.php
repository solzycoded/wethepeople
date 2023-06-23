{{-- @vite(['resources/js/app.js']) --}}

<x-mail::message>
    {{-- <div style="margin: 5px; text-align: center; font-family: Arial, Helvetica, sans-serif; background: rgb(240, 240, 240); padding: 5px 10px"> --}}
    <div>
        <a href="https://wethepeople.com">
            <img src="https://res.cloudinary.com/hustleinlagos/image/upload/v1687187215/logo_no-bg_lftn55.png" height="80" />
        </a>
    </div>
    <br>

    <div style="text-align: left">
        <div>
            Hi Somebody,
            <br>
            <p>One of the authors you follow on <a href="https://wethepeople.com" style="color: #0CC0DF !important; text-decoration: none">wethepeople</a>, {{ $author->name }}, just published a new post...</p>

            <div>
                <h3>{{ $title }}</h3>
                <h4>{{ $excerpt }}... 
                    {{-- <a href="https://wethepeople.com/{{ $slug }}" style="color: #0CC0DF !important; text-decoration: none">continue reading</a> --}}
                </h4>
                <x-mail::button :url="'https://wethepeople.com/' . $slug">
                    View Post
                </x-mail::button>
            </div>
        </div>
        <br>
    
        {{-- FOOTER --}}
        <div style="background-color: white; border-radius: 15px; padding: 3px 6px">
            <p>
                You're receiving this mail, because you signed up on 
                <a href="https://wethepeople.com" style="color: #0CC0DF !important; text-decoration: none">wethepeople</a> and also because you followed, 
                <a href="https://wethepeople.com/?author={{ $author->name }}" style="color: #0CC0DF !important; text-decoration: none">{{ $author->name }}</a>. 
                Kindly ignore this email, if you didn't sign up on 
                <a href="https://wethepeople.com" style="color: #0CC0DF !important; text-decoration: none">wethepeople.com</a>, Thank you.
            </p>

            <small style="color: lightgrey">wethepeople (a blog, made for the people, by <a href="thesolomonfidelis.com">thesolomonfidelis</a>)</small>
        </div>
    </div>

</x-mail::message>
