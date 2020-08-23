"use strict"
/*-------------------------------------------------------------------------------------------------------------
Mantenedor     : Rodrigo Dittmar
Linguaguem     : javascript
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
Modulo         : Calendário/Agenda do sistema
Dependencia    : TcAjax
------------------------------------------------------------------------------------------------------------*/

/*=============================================================================================================
Agenda do usuário
/*------------------=------------=-----------------------------------------------------------------------------
TcCalendar          :Classe de manipulação do calendário/agenda
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-------------------------------------------------------------------------------------------------------------*/
function TcCalendar() {
	this.FDate = new Date();    // Data Atual
	this.FEvents = [];          // array Contendo os eventos

  this.FCalendar = false;     // Armazena o calendário geral
	this.FSchedule = []         // Armazena a agenda

	this.console   = false;     // Função de Console/Log
}
/*------------------=-----------=------------------------------------------------------------------------------
get                 :recupera eventos do calendario
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-------------------------------------------------------------------------------------------------------------*/
TcCalendar.prototype.get = function () {
	return this.FCount;
}
/*------------------=-----------=------------------------------------------------------------------------------
rpcServer           : Requisição de chamadas ao servidor os dados recebidos do servidor
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
param               :StAll      : Parametros para o POST
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-------------------------------------------------------------------------------------------------------------*/
TcDesktop.prototype.rpcServer=function( aParam ) {
	let obj  = this;
	var ajax = new TcAjax( 'ajax-json.php', 'POST' , 'J' );
	var h;

	ajax.debug = this.debug;

	if(this.FDebug) this.debug( );
	//------------------------------------------------
	//Adicionando os parametros
	for( h in aParam )
		ajax.addParam( h , aParam[h] );

	this.FPackage.FCount += 1;
	ajax.addParam( 'C', this.FPackage.FCount );

	//------------------------------------------------
	//Processando o retorno
	ajax.FProcess = function( ajax_request ) {
		var h

		//------------------------------------------------
		//Verificando o Pacote
		if( !(ajax_request = eval('('+ajax_request+')')) ) {
			obj.error( this.FMessage['ajax'] );
			return( false );
		}

		//------------------------------------------------
		//Debug
		if(obj.FDebug) obj.debug( ajax_request , 1 );

		//------------------------------------------------
		//Executa o javascript - BEFORE
		if( ajax_request.js && ajax_request.js.before ) {
			for( h in ajax_request.js.before )
				if( ( ajax_request.js.before[h] = eval( ajax_request.js.before[h] ) ) && isFunction(ajax_request.js.before[h]) )
					ajax_request.js.before[h]();
		}
		//------------------------------------------------
		//Processando os pacotes
		if( ajax_request.pkg ) {
			for( h in ajax_request.pkg )
				obj.processModule.call(obj , h , ajax_request.pkg[h] );
		}
/*    //Linguagem
		if( ajax_request.pkg.l )
			for( h in ajax_request.pkg.l )
				obj.processLanguage.call(obj , h , ajax_request.pkg.l[h] );
		//Grid do Formulario
		if( ajax_request.pkg.d )
			for( h in ajax_request.pkg.d )
				obj.processFormField.call(obj , h , ajax_request.pkg.d[h] );
		//Grid do Formulario
		if( ajax_request.pkg.f )
			for( h in ajax_request.pkg.f )
				obj.processForm.call(obj , h , ajax_request.pkg.f[h] );
		//Grid de Dados
		if( ajax_request.pkg.g )
			for( h in ajax_request.pkg.g )
				obj.processGrid.call(obj , h , ajax_request.pkg.g[h] );
		//Browse de Dados
		if( ajax_request.pkg.b )
			for( h in ajax_request.pkg.b )
				obj.processBrowse.call(obj , h , ajax_request.pkg.b[h] );
		//Grid do Formulario
		if( ajax_request.pkg.c )
			for( h in ajax_request.pkg.c )
				obj.processCompany.call(obj , ajax_request.pkg.c[h] );
		*/
		//------------------------------------------------
		//Executa o javascript AFTER
		if( ajax_request.js && ajax_request.js.after )
			for( h in ajax_request.js.after )
				if( ( ajax_request.js.after[h] = eval( ajax_request.js.after[h] ) ) && isFunction(ajax_request.js.after[h]) )
					ajax_request.js.after[h]();
		//------------------------------------------------
	}
	ajax.open();
	return(true);
};
/*------------------=-----------=------------------------------------------------------------------------------
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
aClean              :boolean    : Força a limpeza dos cookies da classe (apaga os cookies para recuperar)
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-------------------------------------------------------------------------------------------------------------*/
TcCalendar.prototype.rpcServer = function( aClean ) {
	let aCookie,i,j;

	// Limpar os cookies dentro da classe
	if( aClean ) {this.FCookie = []; this.FCount=0;}
  if( this.debug ) this.debug( aClean );

	//Transforma a string cookie em array, separado por ;
	aCookie = document.cookie.split(/\s*;\s*/); // Evitando o problema do cookie precedido por espaço
	j = aCookie.length;   // não atualizar this.FCount - duplicação de cookies por utilizarem path
	for(i = 0; i < j ; i++) {
		aCookie[i] = aCookie[i].split(/\s*=\s*/,2);

		//Evitando duplicação do cookie (javascrpt não le o parametro 'path')
		if( !( this.FCookie[aCookie[i][0]] )) {
			this.FCookie[aCookie[i][0]] = new TcCookie( aCookie[i][0], aCookie[i][1] );
			++this.FCount;
		}

	}
	return null;
}
/*------------------=-----------=------------------------------------------------------------------------------
isset               :verifica se o Cookie existe
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
aCookie             :string     : Nome do Cookie
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
										:boolean    : True se existe / False se não existe
-------------------------------------------------------------------------------------------------------------*/
TcCalendar.prototype.isSet = function( aCookie ) {
  if( this.debug ) this.debug();
	return( (this.FCookie[aCookie] ) );
}
/*------------------=-----------=------------------------------------------------------------------------------
add                 :adiciona um cookie na classe e sincroniza com o site
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
aCookie             :string     : Nome do Cookie
aValue              :string     : Valor do Cookie
aExpires            :variable   : Data de validade do cookie (em inteiro - MaxAge, em String - Expires)
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-------------------------------------------------------------------------------------------------------------*/
TcCalendar.prototype.add = function( aCookie, aValue , aExpires ) {
  if( this.debug ) this.debug();

	this.FCookie[aCookie] = new TcCookie( aCookie , aValue , aExpires );
	this.FCookie[aCookie].set();
	++this.FCount;
	return true;
}
/*------------------=-----------=-----------------------------------------------------------------------------
delete              :Exclui um cookie da classe e do site
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
aCookie             :string     : Nome do Cookie
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
------------------------------------------------------------------------------------------------------------*/
TcCalendar.prototype.delete = function( aCookie ) {
  if( this.debug ) this.debug();

	if( this.FCookie[aCookie] ) {
		this.FCookie[aCookie].delete();
		delete this.FCookie[aCookie];
		--this.FCount;
		return true;
	} else {
		// se o cookie não estiver setado na array, busca o cookie no site e elimina
		let a = new TcCookie(aCookie);
		a.get();
		a.delete();
		return true;
	}
	return false;
}
/*------------------=-----------=------------------------------------------------------------------------------
TcCookie            :Classe de manutencao do cookie - Filha do TcCalendar
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
aName               :string     : Nome do Cookie
aValue              :string     : Valor do Cookie
aExpires            :variable   : Data de validade do cookie (em inteiro - MaxAge, em String - Expires)
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-------------------------------------------------------------------------------------------------------------*/
function TcCookie( aName  , aValue , aExpires ) {
	this.FName  = aName || '';   // Cookie
	this.FValue = aValue || '';  // valor
	this.FPath = '';             // path - Parametro não está definido para acesso via navegador

	// Se o objeto
	if( isNumber( aExpires ) ) {
		this.FExpires = '';                      // data de validade
		this.FMaxAge = 86400 || aExpires;        // validade em segundos (1 dia - 60*60*24)
	} else if( isString( aExpires ) ) {
		this.FExpires = '' || aExpires ;         // data de validade
		this.FMaxAge = '';                       // validade em segundos (1 dia - 60*60*24)
	} else {
		this.FExpires = '';                      // data de validade
		this.FMaxAge = 86400;                    // validade em segundos (1 dia - 60*60*24)
	}

	// Se o valor for em branco, busca o cookie no site
	if( this.FValue == '' )
		this.get();
	else
		this.set();

	return true;
}
/*------------------=-----------=------------------------------------------------------------------------------
set                 :define o valor do cookie
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
aValue              :string     :valor do cookie, se não enviado, atualiza com o valor da classe
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-------------------------------------------------------------------------------------------------------------*/
TcCookie.prototype.set = function( aValue ) {
	let aCookie = '';
	if( this.FName == '' ) {
		return false;
	}
	this.FValue = aValue || this.FValue;
	aCookie = this.FName + '=' + this.FValue;
	aCookie += ( ( this.FPath == '' ) ? '' : ';path='+this.FPath );
	aCookie += ( ( this.FExpires == '' ) ? '' : ';expires='+this.FExpires );
	aCookie += ( ( this.FMaxAge == '' ) ? '' : ';maxage='+this.FMaxAge );
	document.cookie = aCookie;
	return null;
};
/*------------------=-----------=------------------------------------------------------------------------------
get                 :Recupera o valor do cookie presente no site
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
aName               :string     :Nome do Cookie
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-------------------------------------------------------------------------------------------------------------*/
TcCookie.prototype.get = function( aName ) {
	let i,j;
	let aCookie = document.cookie.split(/\s*;\s*/);
	this.FName = aName || this.FName;
	for (i = 0; i < aCookie.length -1 ; i++) {
		let j = aCookie[i].split(/\s*=\s*/,2);
		if( trim(j[0]) === this.FName ) {
			this.FValue = j[1];
			this.FMaxAge = 0;
			this.FExpires = '';
			this.FPath = '';
			break;
		}
	}
	return true;
}
/*------------------=-----------=------------------------------------------------------------------------------
delete              :Elimina um cookie, mas ainda mantem a classe do cookie
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
aName               :string     :Nome do Cookie
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-------------------------------------------------------------------------------------------------------------*/
TcCookie.prototype.delete = function( aName ) {
	let aDate = new Date('2000,1,1');
	let aCookie = aName || this.FName + '=';
	aCookie += ';expires='+aDate.toGMTString();
	document.cookie = aCookie;
	return true;
}
