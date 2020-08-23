// Muda o estado de um elemento(ID)
function Mudarestado(el, btnImagem) {
    var display = document.getElementById(el).style.display;
    if((display == 'none') || (display == '')){
        document.getElementById(el).style.display = 'flex';
        document.getElementById(btnImagem).style.opacity = '1';
    }
    else{
        document.getElementById(el).style.display = 'none';
        document.getElementById(btnImagem).style.opacity = '0.7';
    }
}
//==============================================================================

// Exemplo de JavaScript inicial para desativar envios de formulário, se houver campos inválidos.
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Pega todos os formulários que nós queremos aplicar estilos de validação Bootstrap personalizados.
    var forms = document.getElementsByClassName('needs-validation');
    // Faz um loop neles e evita o envio
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();

//==============================================================================

/* Máscaras ER */
function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}
function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}
function mtel(v){
    v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
    v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
    v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
    return v;
}
function id( el ){
    return document.getElementById( el );
}
window.onload = function(){
    id('telefone').onkeyup = function(){
        mascara( this, mtel );
    }
}


//==============================================================================


//==============================================================================
class localDeAtendimento{
    constructor(nome, src, id){
        this.nome = nome;
        this.src = src;
        this.id = id;
    }
}

// // ----------------------------------------
// //Adiciona classe em um ID
// function addClass(id, classe) {
//   var elemento = document.getElementById(id);
//   var classes = elemento.className.split(' ');
//   var getIndex = classes.indexOf(classe);
//
//   if (getIndex === -1) {
//     classes.push(classe);
//     elemento.className = classes.join(' ');
//   }
// }
//
// // ----------------------------------------
//
// function over(el) {
//     document.getElementById(el).src = "imagem/gif16-9.gif";
// }
//
// function out(el, source){
//     document.getElementById(el).src = source;
// }


// ----------------------------------------

// ----------------------------------------

// ----------------------------------------

// ----------------------------------------

// ----------------------------------------

// ----------------------------------------
