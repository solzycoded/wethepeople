class Bookmark{
    toggle(){
        $('#bookmark-post').click(function () {
            let bookmarkBtn = $(this);

            let postId = bookmarkBtn.attr('post-id');
            let bookmark = (new Bookmark()).bookmark(bookmarkBtn);

            const ajax = new Ajax(
                'POST', 
                '/portfolios/wethepeople/public/bookmark-post', 
                {post_id: postId, bookmark: bookmark}
            );
            ajax.request(function (response){}, (new Bookmark()).failureResponse);
        });
    }
    
    bookmark(bookmarkBtn){
        return (bookmarkBtn.children('i.bi-bookmark-x-fill')).length > 0;
    }

    failureResponse(response){
        let bookmarkBtn = $('#bookmark-post');
        
        bookmarkBtn.children('i')
            .removeClass('bi-bookmark-x-fill')
            .addClass('bi-bookmark-plus');
        
        // change the "bookmark" value, for alpine's "x-data" FROM it's current value to it's orginal value
        let bookmark = (new Bookmark()).bookmark(bookmarkBtn);
        bookmarkBtn.parent().attr('x-data', '{bookmarked: ' + (bookmark ? 'true' : 'false') + '}');
    }
}