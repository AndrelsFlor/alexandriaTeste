$(document).ready(function(){

  $("#LayoutTexto").toggle();
  $.ajax({
    url:"main.php",
    type:"POST",
    dataType:"json",
    data:{acao:"loadObraView",idObra:$("#idObra").val()},
    success: function(data){
      $("#mostraObra").attr("src","uploads/"+encodeURI(data.caminho));
    }
  });

  $("#aprovaObra").click(function(){
    $("#LayoutTexto").toggle();
  });

  $("#btnConfirma").click(function(e){
    e.preventDefault();
    var idObra = $("#idObra").val();
    var idEditora = $("#idEditora").val();
    var texto = $("#textoAprovacao").val();
    if(confirm("Deseja mesmo aprova essa obra?")){

      $.ajax({
        url:"main.php",
        type:"POST",
        dataType:"json",
        data:{acao:"aprovaObra",idObra:idObra,idEditora:idEditora,texto:texto},
        success:function(){
            alert("Obra aprovada!");
            parent.history.back();
        }
      });
    }
  });
});
