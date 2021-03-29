$(document).ready(function(){
    var uid = $('#myid').val();
    $(document).on("click",".del",function(e){
        e.preventDefault();
      var sid = $(this).data("pid");
      $.ajax({
        url: "includes/del_save.php",
        type: "POST",
        data: {per:uid,pid:sid},
        success: function(data){
          if(data){
            alert("Successfully deleted the Post");
            location.reload();
          }else{
            alert("sorry could not delelte the post");
            alert(data);
          }
        }
      });
    });
  });
  