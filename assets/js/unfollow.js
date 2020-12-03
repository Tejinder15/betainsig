$(document).ready(function(){
  $(document).on("click",".unfo", function(e){
    e.preventDefault();
    var fid = $(this).data("id");
    var element = $(this);
    $.ajax({
      url: "includes/follow.php",
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
});
