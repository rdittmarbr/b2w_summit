"use strict"
/*------------------------------------------------------------------------------------------------------------
Mantenedor     : Rodrigo Dittmar
Linguaguem     : javascript
Dependencia    :
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
Modulo         : Definicao de classes diversas
------------------------------------------------------------------------------------------------------------*/

/*============================================================================================================
Manipulação de Eventos na página
/*------------------=-----------=-----------------------------------------------------------------------------
StEvent             : Estrutura para o observer
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
js                  :variant    : codigo javascript string / funcao javascript
type                :boolean    : before/after (True/False)
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
------------------------------------------------------------------------------------------------------------*/
function StEvent( js , type ) {
  this.js   = js;
  this.type = !(!type);
}
/*============================================================================================================
Manipulação de Eventos na página
/*------------------=-----------=-----------------------------------------------------------------------------
TcEvent             : Classe que armazena/gerencia os eventos para o observer
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
------------------------------------------------------------------------------------------------------------*/
function TcEvent() {
  this.FEvent = new Array();    // Eventos
};
/*------------------=-----------=-----------------------------------------------------------------------------
addEvent            : Adiciona eventos ao objeto DOM
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
_TcEvent_AEV_o      :DOM        : objeto DOM
_TcEvent_AEV_event  :string     : nome do evento
_TcEvent_AEV_js     :variant    : codigo javascript string / funcao javascript
_TcEvent_AEV_booble :boolean    : Impede evento em cascata
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
------------------------------------------------------------------------------------------------------------*/
TcEvent.prototype.addEvent=function( _TcEvent_AEV_o , _TcEvent_AEV_event , _TcEvent_AEV_js , _TcEvent_AEV_booble ) {
  if( !isDom(_TcEvent_AEV_o ) ) return( false );

  var _TcEvent_REG_obj = this;
  //setando as Variaveis Locais para uso no evento
  var _TcEvent_GEV_js     = isFunction( _TcEvent_AEV_js ) ? _TcEvent_AEV_js : eval( _TcEvent_AEV_js );
  var _TcEvent_GEV_booble = !(!_TcEvent_AEV_booble);
  var _TcEvent_GEV_o_id   = ( _TcEvent_AEV_o.id ) ? _TcEvent_AEV_o.id : 'document';
  //Criando o observer
  if( !(this.FEvent[_TcEvent_GEV_o_id]) )
    this.FEvent[_TcEvent_GEV_o_id] = new Array()
  this.FEvent[_TcEvent_GEV_o_id][_TcEvent_AEV_event] = new Array();
  //Adicionando o Evento
  addEvent( _TcEvent_AEV_o , _TcEvent_AEV_event , function( event ) {
    //Variaveis locais
    let _TcEvent_GEV_Event  = event || window.event || null;
    var _TcEvent_GET_Target = _TcEvent_GEV_Event.target || _TcEvent_GEV_Event.srcElement;
    //Executando o evento
    var _TcEvent_GET_Result = _TcEvent_GEV_js( _TcEvent_GEV_Event , _TcEvent_GET_Target );
    //Executando os eventos observer
    if( _TcEvent_REG_obj.FEvent[_TcEvent_GEV_o_id][_TcEvent_GEV_Event.type] ) {
      for( var h in _TcEvent_REG_obj.FEvent[_TcEvent_GEV_o_id][_TcEvent_GEV_Event.type] )
       if( _TcEvent_REG_obj.FEvent[_TcEvent_GEV_o_id][_TcEvent_GEV_Event.type][h].js )
          _TcEvent_REG_obj.FEvent[_TcEvent_GEV_o_id][_TcEvent_GEV_Event.type][h].js( _TcEvent_GEV_Event , _TcEvent_GET_Target );
        else
          eval( _TcEvent_REG_obj.FEvent[_TcEvent_GEV_o_id][_TcEvent_GEV_Event.type][h].text );
    }
    return(_TcEvent_GET_Result);
  } );
};
/*------------------------------------------------------------------------------------------------------------
addObserver         : Adiciona eventos observadores ao Evento
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
_TcEvent_OEV_o      :string               : ID DOM Object
_TcEvent_OEV_event  :string               : nome do evento
_TcEvent_OEV_js     :variant              : codigo javascript string / funcao javascript
_TcEvent_OEV_type   :boolean              : Evento deve executar Antes/Apos o evento pai
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
------------------------------------------------------------------------------------------------------------*/
TcEvent.prototype.addObserver=function( _TcEvent_OEV_o , _TcEvent_OEV_event , _TcEvent_OEV_js , _TcEvent_OEV_type ) {
  //Criando o observer
  if( _TcEvent_OEV_o == document ) _TcEvent_OEV_o = 'document';
  if( this.FEvent[_TcEvent_OEV_o] && this.FEvent[_TcEvent_OEV_o][_TcEvent_OEV_event] )
    this.FEvent[_TcEvent_OEV_o][_TcEvent_OEV_event].push( new StEvent( _TcEvent_OEV_js , _TcEvent_OEV_type ) )
  return( this.FEvent[_TcEvent_OEV_o][_TcEvent_OEV_event].length-1 );
};
/*------------------------------------------------------------------------------------------------------------
removeObserver      : Remove eventos observadores
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
_TcEvent_REV_o      :string               : ID DOM Object que sera excluido
_TcEvent_REV_event  :string               : nome do evento
_TcEvent_REV_id     :integer              : ID do evento observer
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
------------------------------------------------------------------------------------------------------------*/
TcEvent.prototype.removeObserver=function( _TcEvent_REV_o , _TcEvent_REV_event , _TcEvent_REV_id ) {
  //Criando o observer
  if( _TcEvent_REV_o == document ) _TcEvent_REV_o = 'document';
  if( this.FEvent[_TcEvent_REV_o] &&
      this.FEvent[_TcEvent_REV_o][_TcEvent_REV_event] &&
      this.FEvent[_TcEvent_REV_o][_TcEvent_REV_event][_TcEvent_REV_id] )
    delete( this.FEvent[_TcEvent_REV_o][_TcEvent_REV_event][_TcEvent_REV_id] );
  return;
};




/*============================================================================================================
Manipulação de videos
/*------------------=-----------=-----------------------------------------------------------------------------
TcVideos            :Classe de manutencao de Videos
Veicular arquivos de vídeo com o tipo MIME correto no cabeçalho Content-Type
AddType video/ogg .ogv
AddType video/mp4 .mp4
AddType video/webm .webm
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
------------------------------------------------------------------------------------------------------------*/
function TcVideos( ) {

}
/*------------------=-----------=-----------------------------------------------------------------------------
TcCookie            :Classe de manutencao do cookie - Filha do TcVideos
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
------------------------------------------------------------------------------------------------------------*/
function TcVideo( aVideo , aCodec ) {
	this.FSource = aVideo || "";    // Vídeo
	this.FCodec  = aCodec || "";    // Codec
	this.FSize   = { width: 0,
									 height: 0 } ;  // Tamanho Horizontal do vídeo
	this.FPoster = "" ;             // Poster do video
	this.FHistory = [];             // Pontos de atenção no vídeo
	this.FReopen = 0;               // status do vídeo (true se já assistiu 100%)
	this.FDOM = '';                 // Elemento do Vídeo
}
/*------------------=-----------=-----------------------------------------------------------------------------
play                :Executa um vídeo do ponto de parada ou a partir de um ponto
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
aTime               :integer    : tempo de início do vídeo / não informar nada para tocar de onde parou
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
------------------------------------------------------------------------------------------------------------*/
TcVideo.prototype.play = function( aTime ) {}
/*------------------=-----------=-----------------------------------------------------------------------------
pause               :Pausa um vídeo
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
------------------------------------------------------------------------------------------------------------*/
TcVideo.prototype.pause = function() {}
/*------------------=-----------=-----------------------------------------------------------------------------
mute                :Muta um vídeo / ou / Desmuta
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
------------------------------------------------------------------------------------------------------------*/
TcVideo.prototype.mute = function() {}
/*------------------=-----------=-----------------------------------------------------------------------------
print               :Realiza um print do frame atual do vídeo para criar o history
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
------------------------------------------------------------------------------------------------------------*/
TcVideo.prototype.print = function() {}
/*------------------=-----------=-----------------------------------------------------------------------------
setView             :Grava se o vídeo foi visto 100%, para marcar como já visualizado
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
------------------------------------------------------------------------------------------------------------*/
TcVideo.prototype.setView = function () {}
//define os pontos de parada do vídeo (history)
/*------------------=-----------=-----------------------------------------------------------------------------
setHistory          :Define o ponto de parada do vídeo
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
------------------------------------------------------------------------------------------------------------*/
TcVideo.prototype.setHistory = function() {
	//this.FHistory[] = new TcVideoHistory()
}
/*------------------=-----------=-----------------------------------------------------------------------------
TcVideoHistory      :Classe de exibição das interações dos videos - Filha do TcVideo
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
------------------------------------------------------------------------------------------------------------*/
function TcVideoHistory( aTime, aPoster, aObject ) {
	this.FTime   = aTime || 0;                 // Tempo que o histórico deve aparecer
	this.FPoster = aPoster || "";              // Imagem do poster
	this.FObject = aObject || "";              // Objeto do Histórico
}

/*===========================================================================================================
RECORD / STRUCT
/*------------------=-----------=-----------------------------------------------------------------------------
StPointer           : Estrutura para armazenar os pontos X/Y
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
x                   :integer    : Ponto X
y                   :integer    : Ponto Y
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-----------------------------------------------------------------------------------------------------------*/
function StPointer( x , y ) {
	this.x = x || 0;
	this.y = y || 0;
}
/*============================================================================================================
Classes de Eventos
/*------------------=-----------=-----------------------------------------------------------------------------
TcMouse             : Classe que armazena os X Y
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
aType               :boolean    : Cria o evento de captura da movimentacao do mouse
aOwner              :Object     : Proprietário da classe
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
------------------------------------------------------------------------------------------------------------*/
function TcMouse( aType , aOwner ) {
  this.FOwner = aOwner // Proprietário da Classe
  //this.FEvent =
  this.x = 0;          //Localizacao x
	this.y = 0;          //Localizacao y
	//------------------------------------------------
	if( aType )
		this.setMouseEvent();
}
/*------------------=-----------=-----------------------------------------------------------------------------
setMouseEvent      : Recupera a Posicao do Mouse
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
------------------------------------------------------------------------------------------------------------*/
TcMouse.prototype.setMouseEvent = function( ) {
	var obj = this;
	//Recuperando o ponteiro do Mouse
	this.FOwner.FEvent.addEvent( document , 'mousemove' , function ( e ) {
    e = e || window.e || null;
    obj.x = e.pageX || e.x || 0;
		obj.y = e.pageY || e.y || 0;
	} );
}


/*-----------------------------------------------------------------------------------------------------------
StCursorPosition    : Estrutura para armazenar o ponteiro do cursor
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
start               :integer              : Ponto de inicio do cursor
end                 :integer              : Ponto final do cursor
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-----------------------------------------------------------------------------------------------------------*/
function StCursorPosition( ) {
	this.start = 0;
	this.end   = 0;
}

/*-----------------------------------------------------------------------------------------------------------
TcKey               : Classe que armazena os valores das Teclas pressionadas
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
aType               :boolean              : Cria o evento de captura das teclas pressionadas
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-----------------------------------------------------------------------------------------------------------*/
function TcKey( aType ) {
	this.keyMapI = { 190:'.', 61:'+',109:'-',
										65:'a', 66:'b', 67:'c', 68:'d' ,69 :'e',70 :'f',71 :'g',72 :'h',73 :'i',74 :'j',75:'k',76:'l',77:'m',78:'n',79:'o',80:'p',81:'q',82:'r',83:'s',84:'t',85:'u',86:'v',87:'w',88:'x',89:'y',90:'z',32:' ',
										48:'0', 49:'1', 50:'2', 51:'3' ,52 :'4',53 :'5',54 :'6',55 :'7',56 :'8',57 :'9',
										96:'0', 97:'1', 98:'2', 99:'3' ,100:'4',101:'5',102:'6',103:'7',104:'8',105:'9',
										27:'VK_ESC',  13:'VK_ENTER',  9:'VK_TAB',  19:'VK_PAUSE',
										37:'VK_LEFT', 39:'VK_RIGHT', 38:'VK_UP',   40:'VK_DOWN',
										36:'VK_HOME', 35:'VK_END',   33:'VK_PGUP', 34:'VK_PGDN',
										45:'VK_INS',  46:'VK_DEL',    8:'VK_BKS',
									 112:'VK_F1',  113:'VK_F2',   114:'VK_F3',  115:'VK_F4',
									 116:'VK_F5',  117:'VK_F6',   118:'VK_F7',  119:'VK_F8',
									 120:'VK_F9',  121:'VK_F10',  122:'VK_F11', 123:'VK_F12'};
	this.keyMapC = { '.':190, '+': 61, '-':109,
									 'a': 65, 'b': 66, 'c': 67, 'd': 68, 'e': 69, 'f': 70, 'g': 71, 'h': 72, 'i': 73, 'j': 74, 'k': 75, 'l': 76, 'm': 77, 'n': 78, 'o': 79, 'p': 80, 'q': 81, 'r': 82, 's': 83, 't': 84, 'u': 85, 'v': 86, 'x': 88,'w': 87, 'y': 89, 'z': 90,' ': 32,
									 '1': 49, '2': 50, '3': 51, '4': 52, '5': 53, '6': 54, '7': 55, '8': 56, '9': 57, '0': 48,
									 'VK_ESC' : 27, 'VK_ENTER': 13, 'VK_TAB' :  9, 'VK_PAUSE': 19,
									 'VK_LEFT': 37, 'VK_RIGHT': 39, 'VK_UP'  : 38, 'VK_DOWN' : 40,
									 'VK_HOME': 36, 'VK_END'  : 35, 'VK_PGUP': 33, 'VK_PGDN' : 34,
									 'VK_INS' : 45, 'VK_DEL'  : 46, 'VK_BKS' :  8,
									 'VK_F1'  :112, 'VK_F2'   :113, 'VK_F3'  :114, 'VK_F4'   :115,
									 'VK_F5'  :116, 'VK_F6'   :117, 'VK_F7'  :118, 'VK_F8'   :119,
									 'VK_F9'  :120, 'VK_F10'  :121, 'VK_F11' :122, 'VK_F12'  :123};
	this.ctrl      = false;
	this.shift     = false;
	this.alt       = false;
	this.key       = 0;
	this.char      = '';
	//------------------------------------------------
	this.FShortCut = new Array();   //Eventos que devem ocorrer apos a digitacao de uma tecla
	//------------------------------------------------
	if( aType )
		this.setKey();
}
/*---------------------------------------------------------------------------------------------------------
setKey              : Recupera a tecla pressionada
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
---------------------------------------------------------------------------------------------------------*/
TcKey.prototype.setKey = function( ) {
	var obj = this;
	//Executando o evento
	esEvent.addEvent( document , 'keydown' , keyDown = function ( event , target ) {
		event = event || window.event || null;
		obj.key  = event.charCode || event.keyCode || event.which || 0;
		obj.ctrl = event.ctrlKey;
		obj.alt  = event.altKey;
		obj.shift= event.shiftKey;
		obj.char = obj.keyMapI[obj.key] || '';
		//------------------------------------------------
		if( obj.FShortCut[obj.char + (obj.ctrl?'C':' ') + (obj.alt?'A':' ') + (obj.shift?'S':' ') ] ) {
			var js = obj.FShortCut[obj.char + (obj.ctrl?'C':' ') + (obj.alt?'A':' ') + (obj.shift?'S':' ') ];
			js( event , target );
		}
	} , true );
}
/*---------------------------------------------------------------------------------------------------------
shortCut            : Associa uma tecla a uma funcao javascript
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
key                 :Object               : Objeto Key que chama o evento
js                  :js                   : Elemento Javascript
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
---------------------------------------------------------------------------------------------------------*/
TcKey.prototype.shortCut=function( key , js ) {
	this.FShortCut[key.char + (key.ctrl?'C':' ') + (key.alt?'A':' ') + (key.shift?'S':' ') ] = js;
};
/*---------------------------------------------------------------------------------------------------------
isChar               : Verifica se a tecla digitada � um caracter
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
---------------------------------------------------------------------------------------------------------*/
TcKey.prototype.isChar = function( ) {
	return( this['char'].indexOf('VK') == -1 );
};
/*---------------------------------------------------------------------------------------------------------
isSChar              : Verifica se a tecla digitada � uma tecla de navegacao/funcao
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
---------------------------------------------------------------------------------------------------------*/
TcKey.prototype.isSChar = function( ) {
	return( this['char'].indexOf('VK') >= 0 );
};
/*---------------------------------------------------------------------------------------------------------
isText              : Verifica se a tecla digitada � um texto (a..z)
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
---------------------------------------------------------------------------------------------------------*/
TcKey.prototype.isText = function( ) {
	return( this.isChar() && ((this['char'] >= 'a' && this['char'] <= 'z' ) || this['char']==' ' ) );
};
/*---------------------------------------------------------------------------------------------------------
isNumber            : Verifica se a tecla digitada � um Numero (0..9)
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
---------------------------------------------------------------------------------------------------------*/
TcKey.prototype.isNumber = function( ) {
	return( this.isChar() && this['char'] >= '0' && this['char'] <= '9' );
};
/*---------------------------------------------------------------------------------------------------------
isFunction          : Verifica se a tecla digitada � uma Funcao (F1..F12)
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
---------------------------------------------------------------------------------------------------------*/
TcKey.prototype.isFunction = function( ) {
	return( this.isSChar() && this['key'] >= 112 && this['key'] <= 123 );
};
