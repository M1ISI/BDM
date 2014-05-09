#ifndef __DEF_MP3TAG_ADDDB__
#define __DEF_MP3TAG_ADDDB__

    #include <sqlite3.h>

    #ifndef WIN32
        #include <sys/types.h>
    #endif

    #define TAG_FIELD_SIZE 30
    #define DB_PATH "../../../testBDD/test.db"

    typedef struct{
       char tag[3];
       char title[TAG_FIELD_SIZE];
       char artist[TAG_FIELD_SIZE];
       char album[TAG_FIELD_SIZE];
       char year[4];
       char comment[TAG_FIELD_SIZE];
       unsigned char genre;
    } mp3Tag;

    /*int isDir(struct dirent* ent);
    char* strtrim (char *str);
    sqlite3* connectToDb();
    int addDataToDb(sqlite3 *db, mp3Tag myTag);
    void dirExplorer(char* dir, sqlite3* db);*/

#endif
