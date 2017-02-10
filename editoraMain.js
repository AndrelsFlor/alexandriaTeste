

$(document).ready(function(){

	var id = $("#idEditora").val();
	$.ajax({
		url:"main.php",
		type:"POST",
		dataType:"json",
		data:{acao:"carregaDadosEditora", id:id},
		success: function(dados){
			$(document).data('nome_editora',dados.nome);
			$(document).data('id_editora',	id);
			$(document).data('cnpj_editora',dados.cnpj);
			$(document).data('email_editora',dados.email);
			$(document).data('logo_editora',dados.logo);

			$("#divNome").append(	$(document).data('nome_editora'));



			$("#logoEditora").attr("src","imagens/"+dados.logo);



		}
	});

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

	$("#updateEditora").on('shown.bs.collapse',function(){
		$("#name").val($(document).data('nome_editora'));
		$("#email").val($(document).data('email_editora'));



	});

	$("#confirmarUpdate").click(function(e){
		e.preventDefault();

		var nome = $("#name").val();
		var email = $("#email").val();

		if(nome == "" || email == ""){
			$("#divErro").attr("class","alert alert-danger");
			$("#divErro").append("Todos os campos devem estar preenchidos!");
		}
		else{
			$(document).data('nome_editora',nome);
			$(document).data('email_editora',email);

			$.ajax({
				url:"main.php",
				type:"POST",
				dataType:"json",
				data:{id: 				$(document).data('id_editora'),
							nome: 			$(document).data('nome_editora'),
							email: 			$(document).data('email_editora'),
							cnpj:				$(document).data('cnpj_editora'),
							biografia: 	$(document).data('biografia'),
							acao:				'updateEditora'},
				success: function(data){
						window.location.reload(true);
				}
			});
		}

	});

$("#pesquisaObras").click(function(){
	$.ajax({
		url:"main.php",
		type:"POST",
		dataType:"json",
		data:{acao:"loadTags"},
		success:function(data){
			$.each(data,function(){
				$("#selectTags").append(
						"<option value="+this.id+">"+this.tag+"</option>");

			});
			$("#selectTags").append("<option value='todas'>Todas</option>");
		}

	});
});

$("#selectTags").change(function(){
	 var tag = $("#selectTags").val();
	 	$("#corpoTabela").html("");
		$.ajax({
			url:"main.php",
			type:"POST",
			dataType:"json",
			data:{acao:"loadObrasEditora",tag:tag},
			success:function(data){
					$("#tabelaObras").attr("style","");

					$.each(data,function(){

						$("#corpoTabela").append("<tr><td><a href=uploads/"+encodeURI(this.caminho)+">"+this.titulo+"</a></td><td>"+this.autor+"</td><td>"+this.pgDisp+"</td><td>"+this.pgTotal+"</td></tr>");
					});
			}

		});
});

});
