# -*- coding: utf-8 -*-
"""
Created on Mon Jul  1 20:58:57 2019
@author: hape
"""

import MySQLdb

import time
import datetime
#import tkinter
#from tkinter import messagebox
from datetime import datetime 
import random

db = MySQLdb.connect("localhost","root","","db_simkasu")
cursor = db.cursor()
#root = tkinter.Tk()
#root.withdraw()

sql2 = cursor.execute("select count(*) from kandang")
data = cursor.fetchone()

jml = data[0]
w = 1

#PILIH TANAMAN
print("=====pilih kandang======") 
while w < jml+1 :
        z = str(w)
        sql = cursor.execute("select nama_kandang from kandang where id_kandang ='"+z+"'")
        kandang = cursor.fetchone()
        t = str(kandang[0])
        print(w,t)
        w+=1
nm_kandang =  str(input("masukkan nama kandang : "))

#PILIH SENSOR
print("=======pilih sensor======")
print("1.Ph Air")
print("2.Suhu")

sensor = int(input("masukkan nomor sensor :"))
    
waktu_cek =  input("masukkan waktu (menit) : ")
total_cek =  input("masukkan total cek : ")


a = cursor.execute("select * from kandang where nama_kandang like '%"+nm_kandang+"%'")
b = cursor.fetchone()
id_kandang =str(b[0])

#sensor PH
if sensor == 1:
    pilih_sensor = 'ph'
    nilai = 0
    ttc = int(total_cek)
    wtc =  int(waktu_cek)
    nilai_max = ttc
    while nilai < nilai_max :
        #x = 0    
        #y = 1
        ph_before = str(random.randint(0,14))
        ph_after = str(random.randint(0,14))
        #while x < y :
        t_end = time.time() + 60 * wtc
        v=0
        tbl_ph =[]
            
        while time.time() < t_end:
        # do whatever you d
            print("-----")
            v+=1  
           
        waktu_perbaikan = str(datetime.now())
        inp_ph= id_kandang,ph_before,ph_after,waktu_perbaikan
        tbl_ph.append(inp_ph)
        sq = "insert into "+pilih_sensor+ "(id_kandang,ph_before,ph_after,waktu_perbaikan) values (%s,%s,%s,%s)"
        inpt = cursor.executemany(sq,tbl_ph)
        print("BERHASIL",tbl_ph)
            
        nilai+=1 

#SENSOR SUHU UNTUK KANDANG        
if sensor == 2:    
    pilih_sensor = 'temperature'
    nilai = 0
    ttc = int(total_cek)
    wtc =  int(waktu_cek)
    nilai_max = ttc
    while nilai < nilai_max :
        #x = 0    
        #y = 1
        temp_before = str(random.randint(10,37))
        temp_after = str(random.randint(10,37))
        #while x < y :
        t_end = time.time() + 60 * wtc
        v=0
        tbl_ph =[]
            
        while time.time() < t_end:
        # do whatever you d
            print("-----")
            v+=1  
           
        waktu = str(datetime.now())
        inp_ph= id_kandang,temp_before,temp_after,waktu
        tbl_ph.append(inp_ph)
        sq = "insert into "+pilih_sensor+" (id_kandang,temp_before,temp_after,waktu_perbaikan) values (%s,%s,%s,%s)"
        inpt = cursor.executemany(sq,tbl_ph)
        print("BERHASIL",tbl_ph)
            
        nilai+=1 

   
    
db.commit()
db.close()