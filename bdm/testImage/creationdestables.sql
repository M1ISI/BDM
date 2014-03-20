/*==============================================================*/
/* Table : IMAGE                                                */
/*==============================================================*/
create table IMAGE 
(
   ID                   INTEGER     PRIMARY KEY   AUTOINCREMENT,
   IMAGE                long varchar                   not null,
   LIEN                 long varchar                   null,
   TYPE                 long varchar                   not null
);

/*==============================================================*/
/* Index : IMAGE_PK                                             */
/*==============================================================*/
create unique index IMAGE_PK on IMAGE (
ID ASC
);

/*==============================================================*/
/* Table : TAG                                                  */
/*==============================================================*/
create table TAG 
(
   LIB                  long varchar                   not null,
   PRIORITE             integer                        null,
   constraint PK_TAG primary key (LIB)
);

/*==============================================================*/
/* Index : TAG_PK                                               */
/*==============================================================*/
create unique index TAG_PK on TAG (
LIB ASC
);

/*==============================================================*/
/* Table : TAG_TEXTE                                            */
/*==============================================================*/
create table TAG_TEXTE 
(
   ID                long varchar                   not null,
   LIB                  long varchar                   not null,
   constraint PK_TAG_TEXTE primary key (ID, LIB),
   constraint FK_TAG_TEXT_ASSOCIATI_TEXTE foreign key (ID)
      references TEXTE (ID),
   constraint FK_TAG_TEXT_ASSOCIATI_TAG foreign key (LIB)
      references TAG (LIB)
);

/*==============================================================*/
/* Table : TAG_IMAGE                                            */
/*==============================================================*/
create table TAG_IMAGE 
(
   ID                   integer                        not null,
   LIB                  long varchar                   not null,
   constraint PK_TAG_IMAGE primary key (ID, LIB),
   constraint FK_TAG_IMAG_ASSOCIATI_IMAGE foreign key (ID)
      references IMAGE (ID),
   constraint FK_TAG_IMAG_ASSOCIATI_TAG foreign key (LIB)
      references TAG (LIB)
);

/*==============================================================*/
/* Table : TEXTE                                                */
/*==============================================================*/
create table TEXTE 
(
   ID                   INTEGER     PRIMARY KEY   AUTOINCREMENT,
   TEXTE                long varchar                   not null,
   LIEN                 long varchar                   null
);

/*==============================================================*/
/* Index : TEXTE_PK                                             */
/*==============================================================*/
create unique index TEXTE_PK on TEXTE (
ID ASC
);

