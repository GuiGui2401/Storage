package com.example.testleon;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;

import android.database.sqlite.SQLiteOpenHelper;
import android.database.sqlite.SQLiteDatabase;
public class DatabaseHelper extends SQLiteOpenHelper {
    public static final String DATABASE_NAME = "RFIDGES.db";
    public static final String TABLE_NAME = "Utilisateur";
    public static final String COL_1 = "ID_CARTE_RFID";
    public static final String COL_2 = "NAME";
    public static final String COL_3 = "LASTNAME";
    public static final String COL_4 = "EMAIL";
    public static final String COL_5 = "MDP";

    public static final String COL_11 = "ID_TRANSACTION";
    public static final String COL_22 = "MONTANT";
    public static final String COL_33 = "DATE";
    public static final String COL_44 = "HEURE";
    public static final String COL_55 = "STATUT";

    public DatabaseHelper(Context context) {
        super(context, DATABASE_NAME, null, 1);
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        db.execSQL("create table " + TABLE_NAME +" (ID_CARTE_RFID INTEGER PRIMARY KEY AUTOINCREMENT,NAME TEXT,LASTNAME TEXT,EMAIL TEXT,MDP TEXT,ID_TRANSACTION TEXT,MONTANT TEXT,DATE TEXT,HEURE TEXT,STATUT TEXT)");
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS "+TABLE_NAME);
        onCreate(db);
    }

    public boolean insertData(String name,String lastname,String email,String mdp,String id_transaction,String montant,String date,String heure,String statut) {
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues contentValues = new ContentValues();
        contentValues.put(COL_2,name);
        contentValues.put(COL_3,lastname);
        contentValues.put(COL_4,email);
        contentValues.put(COL_5,mdp);
        contentValues.put(COL_11,id_transaction);
        contentValues.put(COL_22,montant);
        contentValues.put(COL_33,date);
        contentValues.put(COL_44,heure);
        contentValues.put(COL_55,statut);
        long result = db.insert(TABLE_NAME,null ,contentValues);
        if(result == -1)
            return false;
        else
            return true;
    }

    public Cursor getAllData() {
        SQLiteDatabase db = this.getWritableDatabase();
        Cursor res = db.rawQuery("select * from "+TABLE_NAME,null);
        return res;
    }

    public boolean updateData(String id_carte_rfid,String name,String lastname,String email,String mdp,String id_transaction,String montant,String date,String heure,String statut) {
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues contentValues = new ContentValues();
        contentValues.put(COL_1,id_carte_rfid);
        contentValues.put(COL_2,name);
        contentValues.put(COL_3,lastname);
        contentValues.put(COL_4,email);
        contentValues.put(COL_5,mdp);
        contentValues.put(COL_11,id_transaction);
        contentValues.put(COL_22,montant);
        contentValues.put(COL_33,date);
        contentValues.put(COL_44,heure);
        contentValues.put(COL_55,statut);;
        db.update(TABLE_NAME, contentValues, "ID_CARTE_RFID = ?",new String[] { id_carte_rfid });
        return true;
    }

    public Integer deleteData (String id_carte_rfid) {
        SQLiteDatabase db = this.getWritableDatabase();
        return db.delete(TABLE_NAME, "ID_CARTE_RFID = ?",new String[] {id_carte_rfid});
    }
}
