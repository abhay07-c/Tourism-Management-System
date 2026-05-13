from tkinter import *
from tkinter import messagebox

def new():
    # Open a new window
    new_window = Toplevel(root)
    new_window.title("New Window")
    new_window.geometry("500x500")
    Label(new_window, text="This is a new window", font=("Arial", 14)).pack(pady=50)

def open_file():
    messagebox.showerror("Open", "Functionality not provided")

def exit_file():
    root.destroy()

root = Tk()
root.title("Python Practical")
root.geometry("500x500")
root.config(background="grey")

# Main menu
menu = Menu(root)

# File submenu
file_menu = Menu(menu, tearoff=0)
file_menu.add_command(label="New", command=new)
file_menu.add_command(label="Open", command=open_file)
file_menu.add_separator()
file_menu.add_command(label="Exit", command=exit_file)

# Add File submenu to main menu
menu.add_cascade(label="File", menu=file_menu)

edit_menu = Menu(menu, tearoff=0)
edit_menu.add_command(label="cut")
edit_menu.add_command(label="copy")
edit_menu.add_command(label="paste")

menu.add_cascade(label="Edit",menu=edit_menu)
# Set the menu
root.config(menu=menu)

root.mainloop()
