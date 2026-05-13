from tkinter import*
from tkinter import messagebox
import sqlite3

conn=sqlite3.connect('abhay_db')
cur=conn.cursor()
#cur.execute("CREATE TABLE table1 (name varchar2(20),city varchar2(20))")

def insert():
    cur.execute("INSERT INTO table1(name,city) VALUES(?,?)",(e1.get(),e2.get()))
    messagebox.showinfo("INSERT","RECORD INSERTED SUCCESSFULLY")
    select()
    conn.commit()

def select():
    l1.delete(0,END)
    cur.execute("SELECT * FROM table1")
    for i in cur.fetchall():
        l1.insert(END," ","NAME : ",i[0]," ","CITY : ",i[1])
    conn.commit()

def update():
   cur.execute("UPDATE table1 SET city=(?) WHERE name=(?)",(e2.get(),e1.get()))
   messagebox.showinfo("UPDATE","RECORD UPDATED SUCCESSFULLY")
   select()
   conn.commit()

def delete():
   cur.execute("DELETE FROM table1 WHERE name=(?)",(e1.get(),))
   messagebox.showinfo("UPDATE","RECORD DELETED SUCCESSFULLY")
   select()
   conn.commit()
 

root=Tk()
root.geometry("800x500")

e1=Entry(root)
e1.pack()
e2=Entry(root)
e2.pack()


b1=Button(root,text="INSERT",bg='pink',command=insert)
b1.pack()
b2=Button(root,text="UPDATE",bg='pink',command=update)
b2.pack()
b3=Button(root,text="DELETE",bg='pink',command=delete)
b3.pack()

l1=Listbox(height=50,width=100)
l1.pack()

root.mainloop()