$(document).ready(function(){
  var pos = $(".post-container");
  $(document).on("click",".delbtn", function(){
    var posid = $(this).data("id");
    var dbtn = this;
    // alert("Hello World");
    // alert(posid);

    $.ajax({
      url: "includes/pic_delete.php",
      type: "POST",
      data: {id:posid},
      success: function(data){
        if(data==1){
          $(dbtn).closest("pos").fadeOut();
        }else {
          alert("Sorry Could Not Delete the Post!!");
        }
      }
    });
  });

  $(document).on("click",".stbtn", function(){
    var pid = $(this).data("st");
    // alert("hello Guys");
    $.ajax({
      url: "includes/pic_likes.php",
      type: "POST",
      data: {st:pid},
      success: function(data){
          alert("You have "+data+" likes on your Post.");
      }
    });
  });

  var uid = $('#user').val();
  $(document).on("click",".del",function(){
    var sid = $(this).data("pid");
    $.ajax({
      url: "includes/del_save.php",
      type: "POST",
      data: {per:uid,pid:sid},
      success: function(data){
        if(data){
          alert("Successfully deleted the Post");
          // location.reload();
          alert(data);
        }else{
          alert("sorry could not delelte the post");
          alert(data);
        }
      }
    });
  });
});
