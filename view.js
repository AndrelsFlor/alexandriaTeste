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

  $("#aprovaObra").click(function(e){
    e.preventDefault();
    var idObra = $("#idObra").val();
    var idEditora = $("#idEditora").val();
    if(confirm("Deseja mesmo aprova essa obra?")){

      $.ajax({
        url:"main.php",
        type:"POST",
        dataType:"json",
        data:{acao:"aprovaObra",idObra:idObra,idEditora:idEditora},
        success:function(){
            alert("Obra aprovada!");
            history.back();
        }
      });
    }
  });
});
