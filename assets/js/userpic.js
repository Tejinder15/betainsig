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
});
