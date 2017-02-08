$(document).ready(function(){
	$("#uploaImagemForm").submit(function(e){

		e.preventDefault();
		   var formData = new FormData(this);
            $.ajax({
                    url: "main.php",
                    type: 'POST',
                    data: formData,
                    success: function (data) {
                        alert("upload efetuado com sucesso!!");
                        $("#divImagem").html(data);
                         $("#btnEnviaImagem").attr("value","Enviar");
                    },
                    cache: false,
                    contentType: false,
                    processData: false,
                    xhr: function() {  // Custom XMLHttpRequest
                        var myXhr = $.ajaxSettings.xhr();
                        if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                            myXhr.upload.addEventListener('progress', function () {
                                
                                $("#btnEnviaImagem").attr("value","Carregando.");
                                $("#btnEnviaImagem").attr("value","Carregando..");
                                $("#btnEnviaImagem").attr("value","Carregando...");
                            }, false);
                        }
                    return myXhr;
                    }
                });
        });


	$("#pesquisaObras").click(function(){
		$.ajax({
			url:"main.php",
			type:"POST",
			data:{acao:"pesquisaObrasLayout"},
			success:function(data){
				$("#display").html;
			}
		});
	});
});