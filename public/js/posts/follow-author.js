class FollowAuthor{
    toggle(){
        $('#follow-btn').click(function () {
            let followBtn = $(this);
            let content = $.trim(followBtn.text()).toLowerCase();

            let follow = content=="following" ? true : false;
            let follower = followBtn.attr('follower');
            let followee = followBtn.attr('followee');

            const ajax = new Ajax(
                'POST', 
                '/follow-author', 
                {follower_id: follower, followee_id: followee, follow: follow}
            );
            ajax.request(function (response){}, (new FollowAuthor()).failureResponse);
        });
    }
    
    failureResponse(response){
        // trigger failure action (the follow button would be unfollowed)
        // display "failure to follow alert"
        $('#follow-btn').text('Following').click();
    }
}