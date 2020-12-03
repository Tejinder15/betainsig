$(document).ready(function(){
  // var pos = $(".post-container");
  // $(document).on("click",".delbtn", function(){
  //   var posid = $(this).data("id");
  //   var dbtn = this;
    // alert("Hello World");
    // alert(posid);

  //   $.ajax({
  //     url: "includes/pic_delete.php",
  //     type: "POST",
  //     data: {id:posid},
  //     success: function(data){
  //       if(data == 1){
  //         alert("Post Deleted");
  //       }else {
  //         alert("Sorry Could Not Delete the Post!!");
  //       }
  //     }
  //   });
  // });

//This is for Status Button For checking Likes on Post
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

  //For preventing like,comment and msg Button
  $(document).on("click",".like",function(e){
    e.preventDefault();
  });
  $(document).on("click",".comment",function(e){
    e.preventDefault();
  });
  $(document).on("click",".messag",function(e){
    e.preventDefault();
  });

});
