/*==============================================================*/
/* Table : COLORS                                               */
/*==============================================================*/
create table COLORS 
(
   ID_COLOR             integer                        not null,
   R                    integer                        not null,
   G                    integer                        not null,
   B                    integer                        not null,
   PERCENT              float                          not null,
   constraint PK_COLORS primary key (ID_COLOR)
);

/*==============================================================*/
/* Table : HAVE_COLOR                                           */
/*==============================================================*/
create table HAVE_COLOR 
(
   ID_COLOR             integer                        not null,
   ID_IMAGE             integer                        not null,
   constraint PK_HAVE_COLOR primary key (ID_COLOR, ID_IMAGE),
   constraint FK_HAVE_COLOR__COLORS foreign key (ID_COLOR)
      references COLORS (ID_COLOR),
   constraint FK_HAVE_COLOR__IMAGE foreign key (ID_IMAGE)
      references IMAGE (ID_IMAGE)
);


/*==============================================================*/
/* Table : IMAGE                                                */
/*==============================================================*/
create table IMAGE 
(
   ID_IMAGE             integer     PRIMARY KEY   AUTOINCREMENT,
   IMAGE                long varchar                   not null,
   LINKS                long varchar                   null,
   TYPE                 long varchar                   not null
);


/*==============================================================*/
/* Table : KEYWORDS                                             */
/*==============================================================*/
create table KEYWORDS 
(
   ID_KEYWORD           integer                        not null,
   KEYWORD              long varchar                   null,
   constraint PK_KEYWORDS primary key (ID_KEYWORD)
);


/*==============================================================*/
/* Table : TAGS                                                 */
/*==============================================================*/
create table TAGS 
(
   ID_TEXT              integer                        not null,
   ID_WORD              integer                        not null,
   COUNT                integer                        null,
   constraint PK_TAGS primary key (ID_TEXT, ID_WORD),
   constraint FK_TAGS_TAGS_TEXTS foreign key (ID_TEXT) references TEXTS (ID_TEXT),
   constraint FK_TAGS_TAGS2_WORDS foreign key (ID_WORD)references WORDS (ID_WORD)
);

/*==============================================================*/
/* Table : TAGS_IMAGE                                           */
/*==============================================================*/
create table TAGS_IMAGE 
(
   ID_IMAGE             integer                        not null,
   ID_KEYWORD           integer                        not null,
   PRIORITY             integer                        null,
   constraint PK_TAGS_IMAGE primary key (ID_IMAGE, ID_KEYWORD),
   constraint FK_TAGS_IMA_TAGS_IMAG_IMAGE foreign key (ID_IMAGE) references IMAGE (ID_IMAGE),
   constraint FK_TAGS_IMA_TAGS_IMAG_KEYWORDS foreign key (ID_KEYWORD) references KEYWORDS (ID_KEYWORD)
);


/*==============================================================*/
/* Table : TEXTS                                                */
/*==============================================================*/
create table TEXTS 
(
   ID_TEXT              integer     PRIMARY KEY   AUTOINCREMENT,
   LINKS                long varchar                   null,
   FILE                 long varchar                   not null,
   NB_WORDS             integer                        not null
);

/*==============================================================*/
/* Table : WORDS                                                */
/*==============================================================*/
create table WORDS 
(
   ID_WORD              integer                        not null,
   WORD                 long varchar                   not null,
   constraint PK_WORDS primary key (ID_WORD)
);

