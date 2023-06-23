@props(['author'])

@php
    $request = request()->only(['author']);
    $userId = isset(auth()->user()->id) ? auth()->user()->id : 0;
@endphp

@if(isset($request['author']))
    <div class="mt-2 mx-auto text-center" 
        x-data="{followed: {{ ($userId && $author->following($userId) ? 'true' : 'false') }}, toggle() { this.followed = !this.followed }}"> 
        <p class="font-bold">
            All posts for 
            <small class="text-blue-500">{{ $request['author'] }}</small>
        </p>

        @if($userId && $author->id!==$userId)
            <button @click="toggle()"
                type="button"
                id="follow-btn"
                class="text-white pt-1 pr-3 pl-3 pb-1 rounded-full mt-2" :class=" followed ? 'bg-gray-300' : 'bg-blue-500'"
                follower="{{ $userId }}" followee="{{ $author->id }}">

                <template x-if="followed">
                    <span>Following</span>
                </template>
                <template x-if="!followed">
                    <span>Follow</span>
                </template>

            </button>
        @endif
    </div>
@endif