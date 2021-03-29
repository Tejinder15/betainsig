$(document).ready(function(){
  var lid = $('#likers-id').val();
  var uid = $('#user-id').val();
  $(document).on("click",".like",function(e){
    var pid = $(this).data("id");
    // alert("hello Guys");
    $.ajax({
      url: "includes/like.php",
      type: "POST",
      data: {id:pid,likerid:lid,userid:uid},
      success: function(data){
          if(data==1){
            alert("You have Lked the Post.");
            // alert(data);
          }
          else{
            alert("Already Liked the Post.");
            // alert(data);
          }
      }
    });
  });

  $(document).on("click",".repo",function(e){
    var piid = $(this).data("st");
    $.ajax({
      url: "includes/report.php",
      type: "POST",
      data: {st:piid,userid:uid},
      success: function(data){
        if(data==1){
          alert("You Reported this Post.");
          // alert(data);
        }
        else{
          alert("You have Already Reported this Post");
          // alert(data);
        }
      }
    });
  });

  // For posting comments
  $(document).on("click",".comment",function(e){
    e.preventDefault();
    var pic = $(this).data("com");
    var comval = $(this).siblings('.write-comment').val();
    $.ajax({
      url:"includes/comment.php",
      type:"POST",
      data:{com:pic,commenter:lid,coment:comval},
      success:function(data){
        if(data==1){
          alert("Comment Posted Successfully.");
          location.reload();
        }else{
          alert("Sorry Could Not Post the comment");
          alert(data);
        }
      }
    });
  });

  // For Saving Post
  $(document).on("click",".sav_act",function(e){
    e.preventDefault();
    var psv = $(this).data("sv");
    $.ajax({
      url: "includes/save.php",
      type: "POST",
      data:{sv:psv,saver:lid},
      success:function(data){
        if(data==1){
          alert("Saved Successfully");
        }else{
          alert("Sorry could not save");
          alert(data);
        }
      }
    });
  });
});
