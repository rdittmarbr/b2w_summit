create database ame;

-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
-- Criando o usuário para acesso ao banco
--
CREATE USER 'ame'@'localhost' IDENTIFIED BY 'ame@019';
GRANT ALL PRIVILEGES ON ame.* TO 'ame'@'localhost';
CREATE USER 'ame'@'%' IDENTIFIED BY 'ame@019';
GRANT ALL PRIVILEGES ON ame.* TO 'ame'@'%';

FLUSH PRIVILEGES;

use ame;

-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
-- Tabela de Usuários
-- userPassword
create table cl_user (
  idUser        integer UNSIGNED not null AUTO_INCREMENT comment 'ID Usuário' ,
  name          varchar(150)     not null                comment 'Nome Completo' ,
  socialName    varchar(150)                             comment 'Nome Social' ,
  nickName      varchar(150)                             comment 'Como você quer ser chamado',
  code          varchar(60)      not null                comment 'Código do Usuário' ,
  avatar        varchar(100)                             comment 'Avatar - Local de Imagem do Usuário',
  active        datetime                                 comment 'Usuário Ativo (data de bloqueio)' ,
  register      varchar(60)      not null                comment 'Código de Registro (GRR, Código do Aluno, Matrícula...)' ,
  rf            varchar(20)                              comment 'Registro federal, CPF/CNPJ - Chave para integração com o sistema externo' ,
  email         varchar(75)      not null                comment 'Email de Registro' ,
  emailC        boolean          not null default false  comment 'Usuário confirmou email',
  emailA        varchar(75)                              comment 'Email Alternativo' ,
  emailAC       boolean          not null default false  comment 'Usuário confirmou email',
  phone         varchar(15)                              comment 'Telefone de Contato',
  forcePassword boolean          not null default false  comment 'Força a atualização da senha' ,
  password      varchar(100)     not null                comment 'Senha',
  datePassword  datetime         not null default now()  comment 'Data de alteração da senha' ,
  dateRegister  datetime         not null default now()  comment 'Data de Registro' ,
  lastAccess    datetime                                 comment 'Data/Hora do último acesso ao sistema' ,
  currentAccess datetime                                 comment 'Data/Hora do acesso atual',
  master        boolean          not null default false  comment 'Usuário Mestre' ,
  libras        boolean          not null default false  comment 'Usuário Surdo' ,
  braile        boolean          not null default false  comment 'Usuário Cego' ,
  daltonico     boolean          not null default false  comment 'Usuário Daltônico' ,
  theme         varchar(60)                              comment 'Skin do sistema, se em branco utiliza o padrão',
  hash          varchar(60)      not null                comment 'Código HASH do usuário',
  iconAnimated  boolean          not null default false  comment 'Exibir Ícone Animado',
  videoAutoplay boolean          not null default true   comment 'Auto - Play nos Vídeos',
  videoMute     boolean          not null default true   comment 'Vídeo no Mudo',
  notification  boolean          not null default false  comment 'Ativar Notificações',
  geolocation   boolean          not null default false  comment 'Usar Geolocalização',
  city          varchar(120)     not null default ''     comment 'Cidade',
  address       varchar(120)     not null default ''     comment 'Endereço de correspondência/Residência',
  timezone      integer          not null default '99'   comment 'Fuso Horário',
  css           text                      default ''     comment 'Configuração personalizada para o usuário',
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
  session       varchar(60)                            comment 'Sessão para recuperar o usuário' ,
  sessionDate   datetime                               comment 'Data de validade da sessão',
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

INSERT INTO cl_user(idUser,code,name,register,email,password,master,hash,avatar,forcePassword)
          VALUES(1,'admin','ADMINISTRADOR','ADMIN','admin@ufpr.br','67568ab36a448b32d3f407449fdd5d56',true,'b21e37e823768603ce200e543f608a92',null,false);
INSERT INTO cl_user(idUser,code,name,register,email,password,master,hash,avatar,rf,forcePassword)
          VALUES(2,'rdittmar','Rodrigo Dittmar','GRR20192649','dittmar@ufpr.br','3a530ae39139087aa49a539656cdaec9',true,'1ba13f1d8947e9490da8d9186207f183',null,'02916273905',false);

update cl_user set avatar = concat("img/avt/",hash,".png") where iduser=2;


INSERT INTO cl_usergroup values( 1, 1 );
INSERT INTO cl_usergroup values( 1, 2 );
INSERT INTO cl_usergroup values( 1, 3 );
INSERT INTO cl_usergroup values( 3, 4 );
INSERT INTO cl_usergroup values( 3, 5 );
INSERT INTO cl_usergroup values( 3, 6 );

