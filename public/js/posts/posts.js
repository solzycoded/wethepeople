$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function(){
    // follow OR un-follow an author
    (new FollowAuthor()).toggle();
});