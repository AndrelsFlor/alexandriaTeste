var formulario = document.getElementById("formulario");

var nomeForm = document.getElementById("first_name");
var emailForm = document.getElementById("email");
var senha1Form = document.getElementById("password");
var senha2Form = document.getElementById("password_confirmation");
var senha1AdmForm = document.getElementById("password_adm");
var senha2AdmForm = document.getElementById("password_adm_confirmation");
var cnpjForm = document.getElementById("cnpj");

function validarCNPJ(cnpj) {

    cnpj = cnpj.replace(/[^\d]+/g,'');

    if(cnpj == '') return false;

    if (cnpj.length != 14)
        return false;

    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" ||
        cnpj == "11111111111111" ||
        cnpj == "22222222222222" ||
        cnpj == "33333333333333" ||
        cnpj == "44444444444444" ||
        cnpj == "55555555555555" ||
        cnpj == "66666666666666" ||
        cnpj == "77777777777777" ||
        cnpj == "88888888888888" ||
        cnpj == "99999999999999")
        return false;

    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0,tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;

    tamanho = tamanho + 1;
    numeros = cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
          return false;

    return true;

}


var enviaForm = function (nome,email,senha1,senha2,senha1Adm,senha2Adm,cnpj){
  if(senha1 != senha2){
    alert("As senhas de usuário não batem!");
  }else if(senha1Adm != senha2Adm){
    alert("As senhas de administrador não batem!");
  }else if(!validarCNPJ(cnpj)){
    alert("CNPJ inválido!");
  }else{
  var xhr = new XMLHttpRequest();
  xhr.open("POST","main.php");
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){
      var resposta = JSON.parse(this.responseText);
      if(resposta.status == "sucesso"){
        alert("Cadastro efetuado com sucesso!");
        window.location="index.html";
      }
    }
  }
  xhr.send(encodeURI("nome="+nome+"&email="+email+"&senha="+senha1+"&cnpj="+cnpj+"&senhaAdm="+senha1Adm+"&acao=insereEditora"));
}
}


if(formulario.addEventListener){
  formulario.addEventListener('submit',function(evt){
    evt.preventDefault();
    enviaForm(nomeForm.value,emailForm.value,senha1Form.value,senha2Form.value,senha1AdmForm.value,senha2AdmForm.value,cnpjForm.value);
  },true);
}else{
  formulario.attachEvent("onsubmit",function(evt){
    evt.preventDefault();
    enviaForm(nomeForm.value,emailForm.value,senha1Form.value,senha2Form.value,senha1AdmForm.value,senha2AdmForm.value,cnpjForm.value);
  });
}
