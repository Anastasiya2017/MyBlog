$(function(){
    change_value('#nickname', 'Ник');
    change_value('#comment', 'Комментарий');
    $('.commentbutton').click(function(){
        var nickname = $('#nickname').val();
        var comment = $('#comment').val();
        if(nickname != 'Ник' && comment != 'Комментарий'
          ){
            $.ajax({
                type: "POST";
                url: "commentss.php",
                dataType: "json",
                data:{nickname:nickname, comment:comment},
                success: function(data){
                    $("ul#commentslist").prepend("<li> + data.nickname + '<p>' + data.comment")  + '</p></li><hr>');
                
            }
            })
        }
    })
});
