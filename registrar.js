
  var formulario = document.getElementById("formulario");

  var nomeForm = document.getElementById("first_name").value;
  var emailForm = document.getElementById("email").value;
  var senha1Form = document.getElementById("password");
  var senha2Form = document.getElementById("password_confirmation");

  var enviaForm = function(nome,email,senha1,senha2){

    if(senha1 !== senha2){

      alert("As senhas não batem!");
    }else{


      var xhr = new XMLHttpRequest();
      xhr.open('POST','main.php');
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
          var resposta = JSON.parse(this.responseText);
          if(resposta.status == "sucesso") {
            alert("Cadastro efetuado com sucesso");
          }else{
            alert("Erro ao cadastrar, tente novamente mais tarde");
          }
        }
      }
      xhr.send(encodeURI("nome="+nome+"&email="+email+"&senha="+senha1+"&senha2="+senha2));
    }
  }

  if(formulario.addEventListener){
    formulario.addEventListener("submit", function(evt){
      evt.preventDefault();

      enviaForm(nomeForm,emailForm,senha1Form.value,senha2Form.value);
    },true);
  }else{
    formulario.attachEvent('onsubmit',function(evt){
      evt.preventDefault();
      enviaForm(nomeForm,emailForm,senha1Form,senha2Form);
    });
  }
