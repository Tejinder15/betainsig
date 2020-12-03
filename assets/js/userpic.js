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
          }
          else{
            alert("Already Liked the Post.");
          }
      }
    });
  });
});
