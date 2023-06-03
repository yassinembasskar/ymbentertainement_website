/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  21/05/2023 13:33:57                      */
/*==============================================================*/

drop database ymbentertainement;

create database ymbentertainement;

use ymbentertainement;

drop table if exists ABONNE;

drop table if exists ADMIN;

drop table if exists ARTICLE;

drop table if exists CATEGORIE;

drop table if exists COMMENTS;

/*==============================================================*/
/* Table : ABONNE                                               */
/*==============================================================*/
create table ABONNE
(
   ID_ABONNE            int not null auto_increment,
   USERNAME_ABONNE      varchar(30) not null,
   PASSWORD_ABONNE      varchar(32) not null,
   EMAIL_ABONNE         varchar(254) not null,
   primary key (ID_ABONNE, USERNAME_ABONNE)
);

/*==============================================================*/
/* Table : ADMIN                                                */
/*==============================================================*/
create table ADMIN
(
   ID_ADMIN             int not null auto_increment,
   USERNAME_ADMIN       varchar(30) not null,
   PASSWORD_ADMIN       varchar(32) not null,
   CREATOR_ADMIN        bool not null,
   primary key (ID_ADMIN, USERNAME_ADMIN)
);

/*==============================================================*/
/* Table : ARTICLE                                              */
/*==============================================================*/
create table ARTICLE
(
   ID_ARTCL             int not null auto_increment,
   ID_CATEG             int not null,
   ID_ADMIN             int not null,
   USERNAME_ADMIN       varchar(30) not null,
   TITLE_ARTCL          varchar(100) not null,
   DESCRIPTION_ARTCL    varchar(250) not null,
   MAIN_IMG_ARTCL       longblob not null,
   CONTENT_ARTCL        varchar(15000) not null,
   DATE_ARTCL           date not null,
   VISITS_ARTCL         int not null,
   primary key (ID_ARTCL)
);

/*==============================================================*/
/* Table : CATEGORIE                                            */
/*==============================================================*/
create table CATEGORIE
(
   ID_CATEG             int not null,
   NAME_CATEG           varchar(20) not null,
   primary key (ID_CATEG)
);

/*==============================================================*/
/* Table : COMMENTS                                             */
/*==============================================================*/
create table COMMENTS
(
   ID_COMMENT           int not null auto_increment,
   ID_ABONNE            int not null ,
   USERNAME_ABONNE      varchar(30) not null,
   ID_ARTCL             int not null,
   CONTENT_COMMENT      varchar(500) not null,
   primary key (ID_COMMENT)
);

alter table ARTICLE add constraint FK_APPARTIENT foreign key (ID_CATEG)
      references CATEGORIE (ID_CATEG) on delete restrict on update restrict;

alter table ARTICLE add constraint FK_MANIPULATE foreign key (ID_ADMIN, USERNAME_ADMIN)
      references ADMIN (ID_ADMIN, USERNAME_ADMIN) on delete restrict on update restrict;

alter table COMMENTS add constraint FK_CAN_CREATE foreign key (ID_ABONNE, USERNAME_ABONNE)
      references ABONNE (ID_ABONNE, USERNAME_ABONNE) on delete restrict on update restrict;

alter table COMMENTS add constraint FK_CONTIENT foreign key (ID_ARTCL)
      references ARTICLE (ID_ARTCL) on delete restrict on update restrict;

