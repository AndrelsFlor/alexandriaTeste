$(document).ready(function(){
  $.ajax({
    url:"main.php",
    type:"POST",
    dataType:"json",
    data:{acao:"loadObraView",idObra:$("#idObra").val()},
    success: function(data){
      $("#mostraObra").attr("src","uploads/"+encodeURI(data.caminho));
    }
  });
});
