$(document).ready(function(){
    var lid = $('#likers-id').val();
    
    $(document).on("click",".like",function(e){
      var pid = $(this).data("id");
      var uid = $(this).siblings('.u-id').val();
      // alert("hello Guys");
      $.ajax({
        url: "includes/postlike.php",
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
    //   var uid = $('.user-id').val();
    var uid = $(this).siblings('.us-id').val();
    // alert(piid);
    // alert(uid);
      $.ajax({
        url: "includes/postreport.php",
        type: "POST",
        data: {st:piid,userid:uid},
        success: function(data){
          if(data==1){
            alert("You Reported this Post.");
            // alert(data);
            // alert(uid);
          }
          else{
            alert("You have Already Reported this Post");
            // alert(data);
            // alert(uid);
          }
        }
      });
    });

    $(document).ready(function(){
      $(document).on("click",".action",function(e){
var poid = $(this).data("id");
$.ajax({
  url: "includes/action.php",
  type: "POST",
  data: {id:poid},
  success: function(data){
    if(data==1){
      alert("Post Removed from Insignia");
      alert(data);
    }
    else{
      alert("Could not remove the Post");
      alert(data);
    }
  }
});
});
  });
  });
  