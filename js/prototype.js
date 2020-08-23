"use strict"
/*-----------------------------------------------------------------------------------------------------------
Mantenedor     : Rodrigo Dittmar / rodrigo.dittmar@gmail.com
Linguaguem     : javascript (2.1)
Dependencia    :
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
Modulo         : Funcoes auxiliares
-----------------------------------------------------------------------------------------------------------*/
var protoDebug = false;    // Exibe o debug no console

String.prototype.left = function( len ) {
  len = len || this.length;
  return this.substring(0 , len);
}

String.prototype.right = function( len ) {
  len = len || this.length;
  return this.substring( ( (this.length - len)>0?(this.length - len):0) ,
                          ( (this.length - len)>0?(this.length - len):0) + len );
}

Number.prototype.toFormated = function( str ) {
  str = str || '0';
  return (str + this).right(str.length);
}

/*=============================================================================================================
Extendendo as classes DOM
/*------------------=-----------=------------------------------------------------------------------------------
currentStyle        : Retorna o estilo do elemento DOM (completo)
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
 * Any copyright is dedicated to the Public Domain.
 * http://creativecommons.org/publicdomain/zero/1.0/
-------------------------------------------------------------------------------------------------------------*/
if (!("currentStyle" in Element.prototype)) {
  Object.defineProperty(Element.prototype, "currentStyle", {
    enumerable: true,
    get: function() {
      return window.getComputedStyle(this);
    }
  });
}
/*-------------------------------------------------------------------------------------------------------------
clearChild          : Remove os objetos Dom filhos
/*------------------=-----------=------------------------------------------------------------------------------
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-------------------------------------------------------------------------------------------------------------*/
if (!("clearChild" in Element.prototype)) {
  Object.defineProperty(Element.prototype, "clearChild", {
    enumerable: true,
    get: function() {
      while( this.firstChild )
        this.removeChild(this.firstChild);
    }
  });
}
/*-------------------------------------------------------------------------------------------------------------
removeClass         : Remove uma classe a um elemento DOM
/*------------------=-----------=------------------------------------------------------------------------------
FUNÇAO PENDENTE DE DESENVOLVIMENTO
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-------------------------------------------------------------------------------------------------------------*/
if (!("removeClass" in Element.prototype)) {
  Object.defineProperty(Element.prototype, "removeClass", {
    enumerable: true,
    set: function( aClass ) {
      this.className = this.className.replace ( new RegExp( "\\b"+aClass+"\\b" ), "" );
      void this.offsetWidth;  // Bug CSS
      if( typeof protoDebug !="undefined" && protoDebug) {
        console.log('removeClass',this,aClass);
      }
      return this.className;
    },
    get: function() {
      return this.className;
    }
  });
}
/*-------------------------------------------------------------------------------------------------------------
addClass         : Adiciona uma classe a um elemento DOM
/*------------------=-----------=------------------------------------------------------------------------------
FUNÇAO PENDENTE DE DESENVOLVIMENTO
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-------------------------------------------------------------------------------------------------------------*/
if (!("addClass" in Element.prototype)) {
  Object.defineProperty(Element.prototype, "addClass", {
    enumerable: true,
    set: function( aClass ) {
      this.removeClass = aClass;
      void this.offsetWidth;  // Bug CSS
      this.className = this.className + (this.className==""?"": " ") + aClass;
      if( typeof protoDebug !="undefined" && protoDebug) {
        console.log('addClass',this,aClass);
      }
      return this.className;
    },
    get: function() {
      return this.className;
    }
  });
}
/*-------------------------------------------------------------------------------------------------------------
blink               : Faz com que um input pisque - utilizando a classe blink do CSS
/*------------------=-----------=------------------------------------------------------------------------------
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-------------------------------------------------------------------------------------------------------------*/
if (!("blink" in HTMLInputElement.prototype)) {
  Object.defineProperty(HTMLInputElement.prototype, "blink", {
    enumerable: true,
    get: function(a) {
      this.removeClass = "an_blink";
      void this.offsetWidth;  // Bug CSS
      this.addClass = "an_blink";
      if( typeof protoDebug !="undefined" && protoDebug) {
        console.log('blink',this,aClass);
      }
      return true;
    }
  });
};
/*-------------------------------------------------------------------------------------------------------------
SetHint             : Atualiza o componente para exibir o hint customizado - GIFs animados
/*------------------=-----------=------------------------------------------------------------------------------
FUNÇAO PENDENTE DE DESENVOLVIMENTO
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-------------------------------------------------------------------------------------------------------------*/
if (!("setHint" in Element.prototype)) {
  Object.defineProperty(Element.prototype, "setHint", {
    enumerable: true,
    get: function(a) {
      return true;
    }
  });
};
