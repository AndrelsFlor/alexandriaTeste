$(document).ready(function(){
  var idEditora = $("#idEditora").val();
  $.ajax({
    url:"main.php",
    type:"POST",
    dataType:"json",
    data:{acao:'listaCriticos',idEditora:idEditora},
    success:function(data){
      $.each(data,function(){

        $("#listaCriticos").append("<li class='list-group-item'>"+this.nome+"<span class='badge' id="+this.id+"><label class='glyphicon glyphicon-trash'><button id="+this.id+" style='display:none' class='deletaCritico'></button></label></li>");
      });
    }
  });

  $("#cadastraCritico").submit(function(e){
    e.preventDefault();
    var data = $(this).serialize();
    $.ajax({
      url:"main.php",
      type:"POST",
      dataType:"json",
      data:data,
      success:function(data){
        $("#listaCriticos").html("");
        $.each(data,function(){

          $("#listaCriticos").append("<li class='list-group-item'>"+this.nome+"<span class='badge' id="+this.id+"><label class='glyphicon glyphicon-trash'><button id="+this.id+" style='display:none' class='deletaCritico'></button></label></li>");

        });
      }
    });

  });

  $(this).on("click",".deletaCritico",function(){
    alert($(this).attr("id"));
  });
});
