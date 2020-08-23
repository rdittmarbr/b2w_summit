/*-----------------------------------------------------------------------------------------------------------
Mantenedor     : Rodrigo Dittmar / rodrigo.dittmar@gmail.com
Linguaguem     : javascript (2.1)
Dependencia    : fx.js
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
Modulo         : Classes e Funcoes de Debug
-----------------------------------------------------------------------------------------------------------*/

debug_PRINTFUNCTION  = true;
debug_PRINTUPPER     = true;
debug_EELEMENT       = false;
debug_EELEMENTS      = new Array( 'ELEMENT_NODE' , 'ATTRIBUTE_NODE' , 'TEXT_NODE' , 'CDATA_SECTION_NODE' ,
                                  'ENTITY_REFERENCE_NODE' , 'ENTITY_NODE' , 'PROCESSING_INSTRUCTION_NODE' , 'COMMENT_NODE' ,
                                  'DOCUMENT_NODE' , 'DOCUMENT_TYPE_NODE' , 'DOCUMENT_FRAGMENT_NODE' , 'NOTATION_NODE' );
debug_IELEMENT       = false;
debug_IELEMENTS      = new Array( 'type' );

/*===========================================================================================================
Manipulacao de Eventos
/*-----------------------------------------------------------------------------------------------------------
domWrite            : Retorna elementos DOM de um objeto Javascript
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
o                   :DOM Object           : Objeto DOM
level               :integer              : Número de recursoes
-----------------------------------------------------------------------------------------------------------*/
function domWrite( o , level , oparent ) { 
  var h,k,l,m,n;
  level = level || 0;
  oparent = oparent || $('error');
  k = createTable( {'border':'1'} , oparent );
  l = createTableBody( '' , k );
  for( var h in o ){
//    if( debug_IELEMENT && debug_IELEMENTS.inArray( h ) ) {
      
//    }|| ((!debug_PRINTUPPER && h.toUpperCase() != h ) || (debug_PRINTUPPER && h.toUpperCase() == h ) ) ||
//        (!debug_FILTERELEMENT || (debug_FILTERELEMENT && !debug_FILTERELEMENTS.inArray( h ) ) )
//      ) { 
      if( isFunction(o[h]) && debug_PRINTFUNCTION ) {
        m = createTableRow( false , l )
        n = createTableCol( {'class':'lessbottom','text':h} , m );
        n=createTableCol( {'class':'lessbottom','text':'function'} , m );
      } else if( isString(o[h]) || isNumber(o[h]) ) {
        m = createTableRow( false , l )
        n = createTableCol( {'class':'lessbottom','text':h} , m );
        n=createTableCol( {'class':'lessbottom','text':o[h]} , m );
      } else if( isDom(o[h]) ) {
        m = createTableRow( false , l )
        n = createTableCol( {'class':'lessbottom','text':h} , m );
        n=createTableCol( {'class':'lessbottom','text':'dom'} , m );
//        if( level < 1 )
//          domWrite( o[h] , level + 1 , n );
//      }
  /*    if( (isArray(o[h]) || isObject( o[h] ) ) && level < 5 ) {
        n=createTableCol( '' , m );
        n.appendChild( domWrite( o[h] , level + 1 ) );
      } else {
        n=createTableCol( 'text='+o[h] , m );
      }*/
    }
  }
  return( k );
}