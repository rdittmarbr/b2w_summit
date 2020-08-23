create database clibras;

-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
-- Criando o usuário para acesso ao banco
--
CREATE USER 'clibrasbbb'@'localhost' IDENTIFIED BY 'CLibras@019';
GRANT ALL PRIVILEGES ON clibras.* TO 'clibrasbbb'@'localhost';
CREATE USER 'clibrasbbb'@'%' IDENTIFIED BY 'CLibras@019';
GRANT ALL PRIVILEGES ON clibras.* TO 'clibrasbbb'@'%';

FLUSH PRIVILEGES;

use clibras;
-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
-- S I S T E M A : tabelas internas
-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
-- Módulos do sistema
--
create table cl_module (
  idModule   integer UNSIGNED not null AUTO_INCREMENT comment 'ID Módulo',
  idModuleFK integer UNSIGNED                         comment 'ID Módulo - Pai',
  code       varchar(9)       not null                comment 'Código',
  name       varchar(125)     not null                comment 'Descrição do Módulo' ,
  system     boolean          not null default false  comment 'Modulo do sistema' ,
  active     boolean          not null default false  comment 'Módulo ativo (data de ativação)',
  PRIMARY KEY (idModule)
) ENGINE=InnoDB COMMENT='Módulos do sistema';

CREATE UNIQUE INDEX cl_ix_module_code
  ON cl_module(code);

ALTER TABLE cl_module
  ADD FOREIGN KEY (idModuleFK)
  REFERENCES cl_fk_module_module(idModule);

INSERT INTO cl_module(idModule, code, name, system, active) values
( 1, 'USU','Módulos de Controle e Manutenção de Usuários', true, true),
( 2, 'GLB','Módulos Globais', true, true),
( 3, 'PBL','Módulos Públicos - Gerais', true, true),
( 4, 'DSK','Desktop', true, true),
( 5, 'SYS','Sistema', true, true);

INSERT INTO cl_module(idModuleFK, code, name, system, active) values
( 1, 'USULGI','Login do usuário', true, true),
( 1, 'USUSYS','Manutenção das opções do sistema para o usuário', true, true),
( 1, 'USUDTA','Manutenção dos dados do Usuário', true, true),
( 1, 'USUPSS','Trocar a senha do usuário', true, true),
( 5, 'SYSMNU','Menu Lateral de seleção de módulos', true, true);

-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
-- Grupo do Menu
--
create table cl_menuGroup (
  idMenuGoup integer UNSIGNED not null AUTO_INCREMENT comment 'ID Menu Grupo',
  name       varchar(125)     not null                comment 'Descrição do Grupo',
  PRIMARY KEY (idMenuG)
) ENGINE=InnoDB COMMENT='Grupo do Menu do sistema';

INSERT INTO cl_menu(idMenuGroup, name) values
( 1 , 'Administrador - Lateral'),
( 2 , 'Administrador - Superior'),
( 3 , 'Público'),
( 4 , 'Aluno - Superior'),
( 5 , 'Atendimento Imediato');

-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
-- Menu do Sistema
--
create table cl_menu (
  idMenu      integer UNSIGNED not null AUTO_INCREMENT comment 'ID Menu',
  idMenuFK    integer UNSIGNED                         comment 'ID Menu',
  idMenuGroup integer UNSIGNED not null                comment 'ID do Grupo de Menus',
  code        varchar(9)       not null                comment 'Código',
  name        varchar(125)     not null                comment 'Descrição do Menu' ,
  system      boolean          not null default false  comment 'Modulo do sistema' ,
  active      boolean          not null default false  comment 'Módulo ativo (data de ativação)',
  idModule    integer UNSIGNED                         comment 'ID do Módulo',
  js          text                                     comment 'Codificação JS (se necessário)',
  PRIMARY KEY (idMenu)
) ENGINE=InnoDB AUTO_INCREMENT=1000 COMMENT='Menu administrativo do sistema' ;

CREATE UNIQUE INDEX cl_ix_menu_code
  ON cl_menu(code);

ALTER TABLE cl_menu
  ADD FOREIGN KEY (idMenuFK)
  REFERENCES cl_fk_menu_menu(idMenu);

-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-- Implementando o Menu de Administrador
INSERT INTO cl_menu(idMenuGroup, idMenu, code, name, system, active) values
( 1, 101, 'USU','Módulos de controle e manutenção de usuários', true, true),
( 1, 102, 'GLB','Módulos Globais', true, true),
( 1, 103, 'PBL','Módulos Públicos - Gerais', true, true),
( 1, 104, 'DSK','Desktop', true, true),
( 1, 105, 'SYS','Sistema', true, true);
INSERT INTO cl_menu(idMenuGroup, idMenuFK, code, name, system, active) values
( 1, 101, 'USULGI','Login do usuário', true, true),
( 1, 101, 'USUSYS','Manutenção das opções do sistema para o usuário', true, true),
( 1, 101, 'USUDTA','Manutenção dos dados do Usuário', true, true),
( 1, 101, 'USUPSS','Trocar a senha do usuário', true, true),
( 5, 105, 'SYSMNU','Menu Lateral de seleção de módulos', true, true);
-- Implementando o Menu do Aluno
INSERT INTO cl_menu(idMenuGroup, idMenu, code, name, system, active) values
( 4, 401, '401','Atendimento', true, true),
( 4, 402, '402','Minha Conta', true, true);
INSERT INTO cl_menu(idMenuGroup, idMenu, code, name, system, active) values
( 4, 403, '403','Sair', true, true);
INSERT INTO cl_menu(idMenuGroup, idMenuFK, code, name, system, active) values
( 4, 401, '401001','Imediato', true, true),
( 4, 401, '401002','Agendamento', true, true),
( 4, 402, '402001','Meus Dados', true, true),
( 4, 402, '402002','Mudar Senha', true, true),
( 4, 402, '402003','Sistema', true, true);
INSERT INTO cl_menu(idMenuGroup, idMenuFK, code, name, system, active) values
( 5, 501, '501001','Imediato', true, true),
( 5, 502, '502002','Agendamento', true, true),
( 5, 503, '503001','Meus Dados', true, true),
( 5, 504, '504002','Mudar Senha', true, true),
( 5, 505, '505003','Sistema', true, true);
-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
-- U S U A R I O : Tabelas de controle dos usuários
-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
-- Perfil de Usuários
--
create table cl_userProfile (
  iduserProfile integer  UNSIGNED not null AUTO_INCREMENT comment 'ID do Perfil' ,
  name          varchar(60)       not null                comment 'Nome do Grupo/Perfil' ,
  master        boolean           not null default false  comment 'Usuário Mestre',
  idMenuGoupTop integer UNSIGNED  not null                comment 'ID Menu Grupo - Barra de navegação Superior',
  idMenuGoup    integer UNSIGNED  not null                comment 'ID Menu Grupo - Barra de navegação Vertical',
  PRIMARY KEY (iduserProfile)
) ENGINE=InnoDB comment 'Perfil dos usuários';

ALTER TABLE cl_menu
  ADD FOREIGN KEY (idMenuFK)
  REFERENCES cl_fk_menu_menu(idMenu);

ALTER TABLE cl_menu
  ADD FOREIGN KEY (idMenuFK)
  REFERENCES cl_fk_menu_menu(idMenu);

INSERT INTO cl_userprofile values( 1, 'Master', true);
INSERT INTO cl_userprofile values( 2, 'Intérprete', true);
INSERT INTO cl_userprofile values( 3, 'Aluno', true);

-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
-- Tabela de Usuários
-- userPassword
create table cl_user (
  idUser        integer UNSIGNED not null comment 'ID Usuário' ,
  name          varchar(150) not null comment 'Nome Completo' ,
  socialName    varchar(150)          comment 'Nome Social' ,
  nickName      varchar(150)          comment 'Como você quer ser chamado',
  code          varchar(60)  not null comment 'Código do Usuário' ,
  avatar        varchar(100)          comment 'Avatar - Local de Imagem do Usuário',
  active        datetime              comment 'Usuário Ativo (data de bloqueio)' ,
  register      varchar(60) not null  comment 'Código de Registro (GRR, Código do Aluno, Matrícula...)' ,
  rf            varchar(20) comment 'Registro federal, CPF/CNPJ - Chave para integração com o sistema externo' ,
  email                     varchar(75) not null               comment 'Email de Registro' ,
  emailConfirmed            boolean     not null default false comment 'Usuário confirmou email',
  emailAlternative          varchar(75)                        comment 'Email Alternativo' ,
  emailAlternativeConfirmed boolean     not null default false comment 'Usuário confirmou email',
  phone                     varchar(15)                        comment 'Telefone de Contato',
  forcePassword  boolean      not null comment 'Força a atualização da senha' ,
  password       varchar(100) not null comment 'Senha',
  datePassword   datetime              comment 'Data de alteração da senha' ,
  dateRegister   datetime default now() not null comment 'Data de Registro' ,
  lastAccess     datetime                        comment 'Data/Hora do último acesso ao sistema' ,
  currentAccess  datetime                        comment 'Data/Hora do acesso atual',
  master         boolean default false not null comment 'Usuário Mestre' ,
  libras         boolean default false not null comment 'Usuário Surdo' ,
  braile         boolean default false not null comment 'Usuário Cego' ,
  daltonico      boolean default false not null comment 'Usuário Daltônico' ,
  session        varchar(60) UNIQUE comment 'Sessão para recuperar o usuário' ,
  sessionDate    datetime            comment 'Data de validade da sessão',
  theme          varchar(60)          comment 'Skin do sistema, se em branco utiliza o padrão',
  hash           varchar(60) not null comment 'Código HASH do usuário',
  iconAnimated   boolean default false comment 'Exibir Ícone Animado',
  videoAutoplay  boolean default true  comment 'Auto - Play nos Vídeos',
  videoMute      boolean default true  comment 'Vídeo no Mudo',
  notification   boolean default false comment 'Ativar Notificações',
  geolocation    boolean default false comment 'Usar Geolocalização',
  city           varchar(120) not null default '' comment 'Cidade',
  address        varchar(120) not null default '' comment 'Endereço de correspondência/Residência',
  timezone       integer not null default '99'    comment 'Fuso Horário',
  PRIMARY KEY (idUser)
) ENGINE=InnoDB COMMENT='Um Registro por usuário';

-- Código do usuário
CREATE UNIQUE INDEX cl_ix_user_usucde
  ON cl_user (code);

-- Número de Registro
CREATE UNIQUE INDEX cl_ix_user_usurge
  ON cl_user (register);

-- Email
CREATE UNIQUE INDEX cl_ix_user_usueml
  ON cl_user (email);

-- Email Alternativo
CREATE UNIQUE INDEX cl_ix_user_usuema
  ON cl_user (emailAlternative);

-- Sessão do usuário
CREATE UNIQUE INDEX cl_ix_user_ususes
  ON cl_user (session);

-- Sessão do usuário
CREATE UNIQUE INDEX cl_ix_user_usuhsh
  ON cl_user (hash);

-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
-- Usuários por Grupo (Relação dos usuários x perfil)
--
create table cl_usergroup (
  iduserProfile integer  UNSIGNED not null PRIMARY KEY comment 'ID do Perfil' ,
  iduser integer UNSIGNED not null PRIMARY KEY comment 'ID Usuário'
) ENGINE=InnoDB;

ALTER TABLE cl_usergroup
  ADD FOREIGN KEY (idUser)
  REFERENCES cl_user(idUser);

ALTER TABLE cl_usergroup
  ADD FOREIGN KEY (iduserProfile)
  REFERENCES cl_userprofile(iduserProfile);

create table cl_userSession (
  idUserSession integer UNSIGNED not null AUTO_INCREMENT comment 'ID da sessão do usuário',
  idUser     integer  UNSIGNED not null                comment 'ID Usuário' ,
  accessDate datetime          not null                comment 'Data do último acesso',
  createDate datetime          not null                comment 'Data da criação da sessão',
  PRIMARY KEY (idUserSession)
);

-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
-- U S U A R I O : Tabelas de usuários Master
-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
-- Usuários - Solicitação de Reset de senha (password resset)
--
create table cl_userPR (
  idUserPR   integer  UNSIGNED not null AUTO_INCREMENT comment 'ID da chamada ao Reset da Senha' ,
  idUser     integer  UNSIGNED not null                comment 'ID Usuário' ,
  accessDate datetime          not null                comment 'Data da solicitação do Reset da Senha',
  validate   datetime          not null                comment 'Data de validade da solicitação do Reset',
  IP         varchar(60)       not null                comment 'IP da estação que solicitou o Reset da Senha',
  token      varchar(32)       not null                comment 'Chave para validar a troca de senha',
  PRIMARY KEY (idUserPR)
) ENGINE=InnoDB comment 'Rastreamento de solicitação de resset de senhas';

-- Código do usuário
CREATE UNIQUE INDEX cl_ix_userPR_iduser
  ON cl_userPR(idUser);

-- Código do usuário
ALTER TABLE cl_userPR
  ADD FOREIGN KEY (idUser)
  REFERENCES cl_user(idUser);

INSERT INTO cl_user(idUser,code,name,register,email,updatePassword,password,master,hash,avatar)
          VALUES(1,'ADMIN','ADMINISTRADOR','ADMIN','admin@ufpr.br',true,'43462781a76fc16b09da04c2b889ecb8',true,'b21e37e823768603ce200e543f608a92',null);
INSERT INTO cl_user(idUser,code,name,register,email,updatePassword,password,master,hash,avatar,cpf)
          VALUES(2,'rdittmar','Rodrigo Dittmar','GRR20192649','dittmar@ufpr.br',true,'43462781a76fc16b09da04c2b889ecb8',true,'1ba13f1d8947e9490da8d9186207f183',null,'02916273905');
INSERT INTO cl_user(idUser,code,name,register,email,updatePassword,password,master,hash,avatar)
          VALUES(3,'maurohs','Mauro Hiroto Suzuki','maurohs','maurohs@ufpr.br ',true,'43462781a76fc16b09da04c2b889ecb8',true,'3ccab38b5e6f1bf00f2b4d31bfc83564',null);
INSERT INTO cl_user(idUser,code,name,register,email,updatePassword,password,master,hash,avatar)
          VALUES(4,'alexandrecarneiro','Alexandre Carneiro','GRR20166359','alexandrecarneiro@ufpr.br',true,'43462781a76fc16b09da04c2b889ecb8',true,'c314017178e8501413801051e704a860',null);
INSERT INTO cl_user(idUser,code,name,register,email,updatePassword,password,master,hash,avatar)
          VALUES(5,'leo.stefan','Leonardo Stefan','leo.stefan','leo.stefan@ufpr.br',true,'43462781a76fc16b09da04c2b889ecb8',true,'810c9caee18050b33d498e5af8d8a459',null);
INSERT INTO cl_user(idUser,code,name,register,email,updatePassword,password,master,hash,avatar)
          VALUES(6,'juliaponnick','Julia Ponnick','GRR20176597','juliaponnick@ufpr.br',true,'43462781a76fc16b09da04c2b889ecb8',true,'abb08f387ad16c04f2fbd46782e18c26',null);
INSERT INTO cl_user(idUser,code,name,register,email,updatePassword,password,master,hash,avatar,cpf)
          VALUES(7,'patricklacerda','Patrick Lacerda','GRR20161708','patricklacerda@ufpr.br',true,'43462781a76fc16b09da04c2b889ecb8',true,'8c5fc75138a572b7484381fa44787f3d',null,'08409268981');

update cl_user set avatar = concat("img/avt/",hash,".png") where iduser=2;
update cl_user set avatar = concat("img/avt/",hash,".jpg") where iduser=6;

INSERT INTO cl_usergroup values( 1, 1 );
INSERT INTO cl_usergroup values( 1, 2 );
INSERT INTO cl_usergroup values( 1, 3 );
INSERT INTO cl_usergroup values( 3, 4 );
INSERT INTO cl_usergroup values( 3, 5 );
INSERT INTO cl_usergroup values( 3, 6 );

-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
-- Agenda do Usuário
--
create table cl_schedule (
  idSchedule integer  UNSIGNED not null comment 'ID Agenda' ,
  idUser     integer  UNSIGNED not null comment 'ID Usuário' ,
  dateEvent  datetime  not null         comment 'Data do Evento' ,
  Subject varchar(200) not null         comment 'Assunto',
  PRIMARY KEY (idUserPR)
);

ALTER TABLE cl_schedule
  ADD FOREIGN KEY (idUser)
  REFERENCES cl_user(idUser);

-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
-- V I D E O S : Videos Internos
-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
-- Sistema de Vídeos
--
create table cl_video (
  idVideo  integer UNSIGNED not null AUTO_INCREMENT comment 'ID Módulo',
  idModuleF integer UNSIGNED                         comment 'ID Módulo - Pai',
  code      varchar(9)       not null                comment 'Código',
  name      varchar(125)     not null                comment 'Descrição do Módulo' ,
  system    boolean          not null default false  comment 'Modulo do sistema' ,
  active    boolean          not null default false  comment 'Módulo ativo (data de ativação)',
  PRIMARY KEY (idModule)
) ENGINE=InnoDB COMMENT='Módulos do sistema';

CREATE UNIQUE INDEX cl_ix_module_code
  ON cl_module (code);

ALTER TABLE cl_module
  ADD FOREIGN KEY (idModuleF)
  REFERENCES cl_fk_module_module(idModule);

INSERT INTO cl_module(idModule, code, name, system, active) values
( 1, 'USU','Módulos de controle e manutenção de usuários', true, true),
( 2, 'GLB','Módulos Globais', true, true),
( 3, 'PBL','Módulos Públicos - Gerais', true, true),
( 4, 'DSK','Desktop', true, true);

INSERT INTO cl_module(idModuleF, code, name, system, active) values
( 1, 'USULGI','Login do usuário', true, true),
( 1, 'USUSYS','Manutenção das opções do sistema para o usuário', true, true),
( 1, 'USUDTA','Manutenção dos dados do Usuário', true, true),
( 1, 'USUPSS','Trocar a senha do usuário', true, true);

-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
-- E S T A T I S T I C A S : Estatísticas de usu
-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
-- Módulos do sistema
--

-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
-- C H A M A D A S : Chamadas de Vídeo
-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
-- Chamadas de Vídeos
--
REATE TABLE `mdl_comments` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `contextid` bigint(10) NOT NULL,
  `component` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commentarea` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `itemid` bigint(10) NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `format` tinyint(2) NOT NULL DEFAULT 0,
  `userid` bigint(10) NOT NULL,
  `timecreated` bigint(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mdl_comm_concomite_ix` (`contextid`,`commentarea`,`itemid`),
  KEY `mdl_comm_use_ix` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPRESSED COMMENT='moodle comments module';
/*!40101 SET character_set_client = @saved_cs_client */;


-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --$_SESSION['log']
-- L O G : Logs de acess/sistema
-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
-- Log de Acessos
--

create table cl_logUser (
  idLogUser     integer  UNSIGNED not null AUTO_INCREMENT comment 'ID LOG',
  idUser        integer           not null comment 'ID Usuário',
  accessDate    datetime          not null comment 'Data de Acesso',
  IP            varchar(60)       not null comment 'IP de Acesso',
  userAgent     varchar(250)      not null comment 'User Agent',
  PRIMARY KEY (idLogUser)
) ENGINE=InnoDB COMMENT='Log de acessos';


create table cl_logUserBBB (
  idLogUserBBB integer UNSIGNED not null AUTO_INCREMENT comment 'ID LOG Atenimento',
  idUser       integer          not null comment 'ID Usuário',
  accessDate   datetime         not null comment 'Data de Acesso',
  idBBB        integer          not null comment 'ID da sessão',
  PRIMARY KEY (idLogUserBBB)
) ENGINE=InnoDB COMMENT='Log de Chamadas BBB';

-----

DROP TABLE IF EXISTS `mdl_chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mdl_chat` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `course` bigint(10) NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `intro` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `introformat` smallint(4) NOT NULL DEFAULT 0,
  `keepdays` bigint(11) NOT NULL DEFAULT 0,
  `studentlogs` smallint(4) NOT NULL DEFAULT 0,
  `chattime` bigint(10) NOT NULL DEFAULT 0,
  `schedule` smallint(4) NOT NULL DEFAULT 0,
  `timemodified` bigint(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `mdl_chat_cou_ix` (`course`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPRESSED COMMENT='Each of these is a chat room';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mdl_chat`
--

LOCK TABLES `mdl_chat` WRITE;
/*!40000 ALTER TABLE `mdl_chat` DISABLE KEYS */;
/*!40000 ALTER TABLE `mdl_chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mdl_chat_messages`
--

DROP TABLE IF EXISTS `mdl_chat_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mdl_chat_messages` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `chatid` bigint(10) NOT NULL DEFAULT 0,
  `userid` bigint(10) NOT NULL DEFAULT 0,
  `groupid` bigint(10) NOT NULL DEFAULT 0,
  `issystem` tinyint(1) NOT NULL DEFAULT 0,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` bigint(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `mdl_chatmess_use_ix` (`userid`),
  KEY `mdl_chatmess_gro_ix` (`groupid`),
  KEY `mdl_chatmess_timcha_ix` (`timestamp`,`chatid`),
  KEY `mdl_chatmess_cha_ix` (`chatid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPRESSED COMMENT='Stores all the actual chat messages';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mdl_chat_messages`
--

LOCK TABLES `mdl_chat_messages` WRITE;
/*!40000 ALTER TABLE `mdl_chat_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `mdl_chat_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mdl_chat_messages_current`
--

DROP TABLE IF EXISTS `mdl_chat_messages_current`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mdl_chat_messages_current` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `chatid` bigint(10) NOT NULL DEFAULT 0,
  `userid` bigint(10) NOT NULL DEFAULT 0,
  `groupid` bigint(10) NOT NULL DEFAULT 0,
  `issystem` tinyint(1) NOT NULL DEFAULT 0,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` bigint(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `mdl_chatmesscurr_use_ix` (`userid`),
  KEY `mdl_chatmesscurr_gro_ix` (`groupid`),
  KEY `mdl_chatmesscurr_timcha_ix` (`timestamp`,`chatid`),
  KEY `mdl_chatmesscurr_cha_ix` (`chatid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPRESSED COMMENT='Stores current session';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mdl_chat_messages_current`
--

LOCK TABLES `mdl_chat_messages_current` WRITE;
/*!40000 ALTER TABLE `mdl_chat_messages_current` DISABLE KEYS */;
/*!40000 ALTER TABLE `mdl_chat_messages_current` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mdl_chat_users`
--

DROP TABLE IF EXISTS `mdl_chat_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mdl_chat_users` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `chatid` bigint(11) NOT NULL DEFAULT 0,
  `userid` bigint(11) NOT NULL DEFAULT 0,
  `groupid` bigint(11) NOT NULL DEFAULT 0,
  `version` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `firstping` bigint(10) NOT NULL DEFAULT 0,
  `lastping` bigint(10) NOT NULL DEFAULT 0,
  `lastmessageping` bigint(10) NOT NULL DEFAULT 0,
  `sid` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `course` bigint(10) NOT NULL DEFAULT 0,
  `lang` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `mdl_chatuser_use_ix` (`userid`),
  KEY `mdl_chatuser_las_ix` (`lastping`),
  KEY `mdl_chatuser_gro_ix` (`groupid`),
  KEY `mdl_chatuser_cha_ix` (`chatid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPRESSED COMMENT='Keeps track of which users are in which chat rooms';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mdl_chat_users`
--

LOCK TABLES `mdl_chat_users` WRITE;
/*!40000 ALTER TABLE `mdl_chat_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `mdl_chat_users` ENABLE KEYS */;
UNLOCK TABLES;
