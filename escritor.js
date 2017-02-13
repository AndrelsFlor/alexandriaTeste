$(document).ready(function() {
    $(document).mousemove(function(event) {
        TweenLite.to($("body"),
        .5, {
            css: {
                backgroundPosition: "" + parseInt(event.pageX / 8) + "px " + parseInt(event.pageY / '12') + "px, " + parseInt(event.pageX / '15') + "px " + parseInt(event.pageY / '15') + "px, " + parseInt(event.pageX / '30') + "px " + parseInt(event.pageY / '30') + "px",
            	"background-position": parseInt(event.pageX / 8) + "px " + parseInt(event.pageY / 12) + "px, " + parseInt(event.pageX / 15) + "px " + parseInt(event.pageY / 15) + "px, " + parseInt(event.pageX / 30) + "px " + parseInt(event.pageY / 30) + "px"
            }
        })
    })

     var $btnSets = $('#responsive'),
        $btnLinks = $btnSets.find('a');

        $btnLinks.click(function(e) {
            e.preventDefault();
            $(this).siblings('a.active').removeClass("active");
            $(this).addClass("active");
            var index = $(this).index();
            $("div.user-menu>div.user-menu-content").removeClass("active");
            $("div.user-menu>div.user-menu-content").eq(index).addClass("active");
        });



        $('.view').hover(
            function(){
                $(this).find('.caption').slideDown(250); //.fadeIn(250)
            },
            function(){
                $(this).find('.caption').slideUp(250); //.fadeOut(205)
            }
        );

        $(this).on('click',"#notificacao",function(){
        	alert("notificacao");
        });
        $(this).on('click',"#obras",function(e){
        	var id = $("#idEscritor").val();
        	e.preventDefault();
        	$.ajax({
        		url:"main.php",
        		type:"POST",
        		data:{idEscritor:id,acao:'listaObras'},
        		success:function(data){
        			$("#display").html(data);


        		}
        	});
        });

        $("#updateEscritor").click(function(){
            var id = $("#idEscritor").val();
            $.ajax({

                url:"main.php",
                type:"POST",
                data:{acao:"updateEscritorLayout",id:id},
                success:function(data){
                    $("#display").html(data);
                }
            });
        });
        $(document).on('click',"#cancelarUpdate",function(e){
            e.preventDefault();
            $.ajax({
                url:"main.php",
                type:"POST",
                data:{acao:'cancelar'},
                success: function(data){
                    $("#display").html(data);
                }
            });
        });

        $(document).on('click',"#confirmarUpdate",function(e){
            e.preventDefault();
            var id = $("#idEscritor").val();
            var data = $("#formUpdateEscritor").serialize();
            if(confirm("Deseja mesmo salvar as alterações?")){
                $.ajax({
                    url:'main.php',
                    type:"POST",
                    data:data,
                    success:function(data){
                        $("#divNome").html(data);
                        $("#display").html("");
                    }
                });
            }
        });
        $(document).on('click',"#divImagem",function(){
            var id = $("#idEscritor").val();
            $.ajax({
                url:"main.php",
                type:"POST",
                data:{acao:"updateImagemLayout",id:id},
                success: function(data){
                    $("#uploadImagemDiv").html(data);
                }
            });
        });

        $(document).on('submit',"#uploaImagemForm", function(e){
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

     $(document).on("click","#btnCancelaImagem",function(){
        $.ajax({
            url:"main.php",
            type:"POST",
            data:{acao:'cancelaImagem'},
            success:function(data){
                $("#uploadImagemDiv").html(data);
            }
        });
     });

     $(document).on('click',"#btnCancelaLista",function(){
        $.ajax({
            url:"main.php",
            type:"POST",
            data:{acao:"cancelaListaObra"},
            success:function(data){
                $("#display").html(data);
            }
        });
     });
     $(document).on('click',"#uploadObra",function(e){
        e.preventDefault();
        var id = $("#idEscritor").val();
        $.ajax({
            url:"main.php",
            type:"POST",
            data:{acao:"uploadObraLayout",id:id},
            success:function(data){
                $("#display").html(data);
            }
        });

     });
     $(document).on('click',"#cancelaUploadObra",function(){
        $.ajax({
            url:"main.php",
            type:"POST",
            data:{acao:"cancelaUploadObra"},
            success:function(data){
                $("#display").html(data);
            }
        });
     });
     $(document).on('submit',"#formUploaObra",function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
                url: "main.php",
                type: 'POST',
                data: formData,
                success: function (data) {
                    alert("upload efetuado com sucesso!!");
                    $("#display").html();
                     $("#confirmaUploadObra").attr("value","Enviar");
                },
                cache: false,
                contentType: false,
                processData: false,
                xhr: function() {  // Custom XMLHttpRequest
                    var myXhr = $.ajaxSettings.xhr();
                    if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                        myXhr.upload.addEventListener('progress', function () {

                            $("#confirmaUploadObra").attr("value","Carregando.");
                            $("#confirmaUploadObra").attr("value","Carregando..");
                            $("#confirmaUploadObra").attr("value","Carregando...");
                        }, false);
                    }
                return myXhr;
                }
            });

     });

     $(document).on('click','.btnDeletaObra',function(e){
       e.preventDefault();
       if(confirm("Deseja mesmo deletar essa obra?")){
         var id = $(this).attr('id');
         var idEscritor = $(this).attr('idEscritor');
         $.ajax({
           url:"main.php",
           type:"POST",
           data:{acao:'deletaObra',idObra:id,idEscritor:idEscritor},
           success:function(data){
             alert('sucesso!');
             $("#display").html(data);
           }
         });
       }
     });


          setInterval(function(){
            var cont = 0;
           $.ajax({
             url:"main.php",
             type:"POST",
             dataType:"json",
             data:{acao:"verificaAprovacao",id:$("#idEscritor").val()},
             success: function(data){
               $.each(data,function(){
                 if(this.flag != 1){
                   cont++;
                   $("#notificaSino").attr("style","color:#ff0000");
                   $("#notificaSino").html(cont);


                 }
               });

             }
           });
          },2000);

    });
