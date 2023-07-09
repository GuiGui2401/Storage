from Tkinter import *
import os

main = Tk()
main.geometry('{}x{}'.format(1440, 810))
main.wm_title("Face recognition using OpenCV with Eigenface algorithm - made by priya@bluetronics.co.in")

svalue = StringVar() # defines the widget state as string

imagePath = PhotoImage(file="facerec.png")
widgetf = Label(main, image=imagePath).pack(side="left")
imagePath1 = PhotoImage(file="efylogo.png")
widgetf = Label(main, image=imagePath1).pack(side="top")

comments = """Welcome to face recognition using Eigenface algorithm.
Enter the name of the person in the text box given above to get trained.
Click the train to train the faces and recognize to recognize it






"""

widgets = Label(main, 
           justify=LEFT,
           padx = 10, 
           text=comments).pack(side="bottom")

w = Entry(main,textvariable=svalue) # adds a textarea widget
w.pack()
w.place(x=400,y=100)
def fisher_train_button_fn():
    name = svalue.get()
    os.system('python train_eigen.py %s'%name)

def fisher_recog_button_fn():
    os.system('python recog_eigen.py')

train_fisher_button = Button(main,text="train", command=fisher_train_button_fn)
train_fisher_button.pack()
train_fisher_button.place(x=499,y=150)
recog_fisher_button = Button(main,text="recognize", command=fisher_recog_button_fn)
recog_fisher_button.pack()
recog_fisher_button.place(x=465,y=200)

main.mainloop()
