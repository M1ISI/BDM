/*==============================================================*/
/* Table : COLORS                                               */
/*==============================================================*/
create table COLORS 
(
   ID_COLOR             integer		PRIMARY KEY   AUTOINCREMENT,
   R                    integer                        not null,
   G                    integer                        not null,
   B                    integer                        not null,
   PERCENT              float                          not null
);

/*==============================================================*/
/* Table : HAVE_COLOR                                           */
/*==============================================================*/
create table HAVE_COLOR 
(
   COLOR             integer                        not null,
   IMAGE             integer                        not null,
   constraint PK_HAVE_COLOR primary key (COLOR, IMAGE),
   constraint FK_HAVE_COLOR__COLORS foreign key (COLOR)
      references COLORS (ID_COLOR),
   constraint FK_HAVE_COLOR__IMAGES foreign key (IMAGE)
      references IMAGE (ID_IMAGE)
);


/*==============================================================*/
/* Table : WORDS                                                */
/*==============================================================*/
create table WORDS 
(
   ID_WORD              integer     PRIMARY KEY   AUTOINCREMENT,
   WORD                 long varchar                   not null
);


/*==============================================================*/
/* Table : TYPES                                                */
/*==============================================================*/
create table TYPES 
(
   ID_TYPE              integer     PRIMARY KEY   AUTOINCREMENT,
   TYPE                 long varchar                   not null
);



/*==============================================================*/
/* Table : FILES                                                */
/*==============================================================*/
create table FILES 
(
   ID_FILE              integer     PRIMARY KEY   AUTOINCREMENT,
   PATH					long varchar					null,
   URL					long varchar					null,
   TYPE                 integer                   	   null,
   check(PATH is not null or URL is not null),
   constraint FK_FILES__TYPES foreign key (TYPE)
      references TYPES (ID_TYPE)
);


/*==============================================================*/
/* Table : IMAGES                                               */
/*==============================================================*/
create table IMAGES 
(
   ID_IMAGE             integer     PRIMARY KEY   AUTOINCREMENT,
   FILE					integer							not null,
   constraint FK_IMAGES__FILES foreign key (FILE)
      references FILES (ID_FILES)
);

/*==============================================================*/
/* Table : IMAGES_KEYWORDS                                           */
/*==============================================================*/
create table IMAGES_KEYWORDS
(
   IMAGE             integer                        not null,
   KEYWORD           integer                        not null,
   PRIORITY             integer                        null,
   constraint PK_TAGS_IMAGES_KEYWORDS primary key (IMAGE, KEYWORD),
   constraint FK_TAGS_IMAGES_KEYWORDS__IMAGES foreign key (IMAGE) references IMAGES (ID_IMAGE),
   constraint FK_TAGS_IMAGES_KEYWORDS__WORDS foreign key (KEYWORD) references WORDS (ID_WORD)
);


/*==============================================================*/
/* Table : TEXTS                                                */
/*==============================================================*/
create table TEXTS 
(
   ID_TEXT              integer     PRIMARY KEY   AUTOINCREMENT,
   NAME                 long varchar               not null,
   FILE                 integer                   	 not null,
   NB_WORDS             integer                     not null,
   constraint FK_TEXTS__FILES foreign key (FILE)
      references FILES (ID_FILES)
);


/*==============================================================*/
/* Table : TEXTS_KEYWORDS                                       */
/*==============================================================*/
create table TEXTS_KEYWORDS 
(
   TEXT              integer                        not null,
   WORD              integer                        not null,
   COUNT             integer                        null,
   constraint PK_TEXTS_KEYWORDS primary key (TEXT, WORD),
   constraint FK_TEXTS_KEYWORDS__TEXTS foreign key (TEXT) references TEXTS (ID_TEXT),
   constraint FK_TEXTS_KEYWORDS__WORDS foreign key (WORD)references WORDS (ID_WORD)
);


/*==============================================================*/
/* Table : STYLES                                               */
/*==============================================================*/
create table STYLES
(
   ID_STYLE              integer     PRIMARY KEY   AUTOINCREMENT,
   STYLE                 long varchar                   not null
);


/*==============================================================*/
/* Table : MUSICS                                               */
/*==============================================================*/
create table MUSICS
(
   ID_MUSIC              integer     PRIMARY KEY   AUTOINCREMENT,
   FILE                  integer                   not null,
   TITLE                 long varchar              null,
   AUTHOR                long varchar              null,
   YEAR                  integer                   null,
   STYLE                 integer                   not null,
   constraint FK_MUSICS_FILES foreign key (FILE) references FILES (ID_FILE),
   constraint FK_MUSICS_STYLES foreign key (STYLE) references STYLES (ID_STYLE)
);
