$(document).ready(function(){
  $(document).on("click",".unfo", function(e){
    e.preventDefault();
    var fid = $(this).data("id");
    var element = $(this);
    $.ajax({
      url: "includes/unfollow.php",
      type:"POST",
      data:{id:fid},
      success:function(data){
          if(data==1){
            alert("You Unfollowed the User.");
            element.closest(".following-details").remove();
          }
          else{
            alert("Could not unfollow the User.");
          }
      }
    });
  });

  var us = $('#user').val();
  $(document).on("click",".fol",function(e){
    e.preventDefault();
    var fid = $(this).data("fo");
    $.ajax({
      url: "includes/follow.php",
      type:"POST",
      data:{fo:fid,uid:us},
      success:function(data){
        if(data==1){
          alert("Followed Back the user");
        }else if(data==2){
          alert("Already Following the user");
        }else{
          alert("Sorry Could not follow back");
          alert(data);
        }
      }
    });
  });
});
