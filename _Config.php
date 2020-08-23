<?PHP
/*-----------------------------------------------------------------------------------------------------------
Descricao      : Arquivo de Configura�ao
-------------------------------------------------------------------------------------------------------------
Autor          : Rodrigo Dittmar <rodrigo@dittmar.com.br>
Linguaguem     : php 5.x
Data           : 20130801
-----------------------------------------------------------------------------------------------------------*/
//Systemas
define("ES_SYTEXTEOF"  , "\r\n");        //Final de Texto (\r\n)
define("ES_SYLANGUAGE" , "pt-br");       //Linguagem

//(DB) Tipo de Banco de dados
define("ES_DBFILE"     ,0);
define("ES_DBMYSQL40"  ,1);
define("ES_DBMYSQL41"  ,2);
define("ES_DBFIREBIRD" ,3);
define("ES_DBINTERBASE",3);

//(VB) Definindo os Tipos de Header para o pacote enviado
define("ES_headerTEXT",0);
define("ES_headerHTML",0);
define("ES_headerJSON",1);
define("ES_headerMPEG",2);
define("ES_headerJPG",3);
define("ES_headerPDF",3);

//(VB) Definindo os Tipos de variaveis do do Banco
define("ES_VBINTEGER",0);
define("ES_VBDOUBLE",1);
define("ES_VBVARCHAR",2);
define("ES_VBDATE",3);
define("ES_VBTIME",4);
define("ES_VBBLOB",5);
define("ES_VBCURRENCY",6);
define("ES_VBBOOL",6);
define("ES_VBUNKNOW",-1);

//(VB) Definindo o tipo de operacao de equivalencia no sql
define("ES_EBEQUAL",1);
define("ES_EBDIFFERENT",2);
define("ES_EBGREATER",3);       //Maior
define("ES_EBLESS",4);          //Menor
define("ES_EBGREATEREQUAL",5);  //MaiorIGUAL
define("ES_EBLESSEQUAL",6);     //MenorIGUAL
define("ES_EBCONTAINS", 9);     //Contendo
define("ES_EBNOTCONTAINS", 10); //Nao Contendo
define("ES_EBISNULL",7);        //NULLO
define("ES_EBISNONULL",8);
define("ES_EBUNKNOW",-1);

//(OP) Definindo as operacoes de formulario
define("ES_OPBROWSE",0);
define("ES_OPGRID",1);
define("ES_OPFORM",2);
define("ES_OPUPDATE",3);
define("ES_OPINSERT",4);
define("ES_OPDELETE",5);
define("ES_OPUNKNOW",-1);

//Limites de tamanho de campo para login
define("ES_LOGINPASS_MIN",3);
define("ES_LOGINPASS_MAX",25);

?>
