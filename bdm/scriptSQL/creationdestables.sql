/*==============================================================*/
/* Table : IMAGE                                                */
/*==============================================================*/
create table IMAGE 
(
   IMAGE                long varchar                   not null,
   LIEN                 long varchar                   null,
   constraint PK_IMAGE primary key (IMAGE)
);

/*==============================================================*/
/* Index : IMAGE_PK                                             */
/*==============================================================*/
create unique index IMAGE_PK on IMAGE (
IMAGE ASC
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
   TEXTE                long varchar                   not null,
   LIB                  long varchar                   not null,
   constraint PK_TAG_TEXTE primary key (TEXTE, LIB),
   constraint FK_TAG_TEXT_ASSOCIATI_TEXTE foreign key (TEXTE)
      references TEXTE (TEXTE),
   constraint FK_TAG_TEXT_ASSOCIATI_TAG foreign key (LIB)
      references TAG (LIB)
);

/*==============================================================*/
/* Table : TAG_IMAGE                                            */
/*==============================================================*/
create table TAG_IMAGE 
(
   IMAGE                long varchar                            not null,
   LIB                  long varchar                   not null,
   constraint PK_TAG_IMAGE primary key (IMAGE, LIB),
   constraint FK_TAG_IMAG_ASSOCIATI_IMAGE foreign key (IMAGE)
      references IMAGE (IMAGE),
   constraint FK_TAG_IMAG_ASSOCIATI_TAG foreign key (LIB)
      references TAG (LIB)
);

/*==============================================================*/
/* Table : TEXTE                                                */
/*==============================================================*/
create table TEXTE 
(
   TEXTE                long varchar                   not null,
   LIEN                 long varchar                   null,
   constraint PK_TEXTE primary key (TEXTE)
);

/*==============================================================*/
/* Index : TEXTE_PK                                             */
/*==============================================================*/
create unique index TEXTE_PK on TEXTE (
TEXTE ASC
);

