import tkinter as tk
from tkinter import messagebox
import mysql.connector


conn = mysql.connector.connect(
    host="localhost",
    user="root",
    password="ziyad123",
    database="students_management"
)

cursor = conn.cursor()


window = tk.Tk()
window.title("Student Management System")
window.configure(bg="#e0f7fa") 
window.geometry("400x400")


bg_color = "#e0f7fa"  
button_color = "#00796b" 
button_text_color = "white"
label_color = "#004d40"  
entry_bg_color = "white"
entry_fg_color = "black"

def add():
    def add_student():
        first_name = entry_first_name.get()
        last_name = entry_last_name.get()
        age = entry_age.get()
        group = group_var.get()

        if not first_name or not last_name or not age or not group:
            messagebox.showerror("Error", "Please fill all fields")
            return
        elif not age.isdigit():
            messagebox.showerror("Error", "Invalid age (must be a number)")
            return
        
        elif int(age) < 0 or int(age) > 30:
            messagebox.showerror("Error", "Invalid age (must be between 0 and 30)")
            return

        try:
            cursor.execute("INSERT INTO students (first_name, last_name, age, group_name) VALUES (%s, %s, %s, %s)",
                           (first_name, last_name, age, group))
            conn.commit()
            messagebox.showinfo("Success", "Student added successfully!")
            clear_fields()

        except mysql.connector.Error as err:
            messagebox.showerror("Database Error", f"Error: {err}")

    def clear_fields():
        entry_first_name.delete(0, tk.END)
        entry_last_name.delete(0, tk.END)
        entry_age.delete(0, tk.END)
        group_var.set('')

    root = tk.Toplevel()
    root.title("Add Student")
    root.configure(bg=bg_color)
    root.geometry("300x300")

    label_first_name = tk.Label(root, text="First Name", bg=bg_color, fg=label_color)
    label_first_name.grid(row=0, column=0, padx=10, pady=10)
    entry_first_name = tk.Entry(root, bg=entry_bg_color, fg=entry_fg_color)
    entry_first_name.grid(row=0, column=1, padx=10, pady=10)

    label_last_name = tk.Label(root, text="Last Name", bg=bg_color, fg=label_color)
    label_last_name.grid(row=1, column=0, padx=10, pady=10)
    entry_last_name = tk.Entry(root, bg=entry_bg_color, fg=entry_fg_color)
    entry_last_name.grid(row=1, column=1, padx=10, pady=10)

    label_age = tk.Label(root, text="Age", bg=bg_color, fg=label_color)
    label_age.grid(row=2, column=0, padx=10, pady=10)
    entry_age = tk.Entry(root, bg=entry_bg_color, fg=entry_fg_color)
    entry_age.grid(row=2, column=1, padx=10, pady=10)

    label_group = tk.Label(root, text="Group", bg=bg_color, fg=label_color)
    label_group.grid(row=3, column=0, padx=10, pady=10)
    l = ['DEV101', 'DEV102', 'DEV103', 'DEV104', 'DEV105', 'DEV106', 'DEV107', 'DEV108', 'DEV109']
    group_var = tk.StringVar()
    group_var.set(l[0])
    group_menu = tk.OptionMenu(root, group_var, *l)
    group_menu.config(fg="black")
    group_menu.grid(row=3, column=1, padx=10, pady=10)

    add_button = tk.Button(root, text="Submit", command=add_student, bg=button_color, fg=button_text_color)
    add_button.grid(row=4, column=0, columnspan=2, padx=10, pady=10)

    back_button = tk.Button(root, text="Back to Main Menu", command=root.destroy, bg=button_color, fg=button_text_color)
    back_button.grid(row=5, column=0, columnspan=2, padx=10, pady=10)

def addsubgect():
    def add_subgect():
        student_id = entry_student.get()
        selected_indices = list_subject.curselection()
        cursor.execute("SELECT id FROM students")
        student_ids = [row[0] for row in cursor.fetchall()]

        subject_ids = [subjects_list[index][0] for index in selected_indices]

        if not student_id or not subject_ids:
            messagebox.showerror("Error", "Please fill all fields")
            return
        elif int(student_id) not in student_ids:
            messagebox.showerror("Error", "Student ID does not exist")
            return
        else:
            try:
                for subject_id in subject_ids:
                    cursor.execute("INSERT INTO student_subject (student_id, subject_id) VALUES (%s, %s)",
                                   (student_id, subject_id))
                conn.commit()
                messagebox.showinfo("Success", "Subjects added successfully!")
                clear_fields()
            except mysql.connector.Error as err:
                messagebox.showerror("Database Error", f"Error: {err}")

    root2 = tk.Toplevel()
    root2.title("Add Subject")
    root2.configure(bg=bg_color)
    root2.geometry("400x400")

    label_student = tk.Label(root2, text="Enter Student ID", bg=bg_color, fg=label_color)
    label_student.pack(padx=10, pady=10)

    entry_student = tk.Entry(root2, bg=entry_bg_color, fg=entry_fg_color)
    entry_student.pack(padx=10, pady=10)

    label_subgect = tk.Label(root2, text="Subject", bg=bg_color, fg=label_color)
    label_subgect.pack(padx=10, pady=10)

    list_subject = tk.Listbox(root2, selectmode=tk.MULTIPLE, bg=entry_bg_color, fg=entry_fg_color)
    cursor.execute("SELECT id, subject_name FROM subject")
    subjects = cursor.fetchall()

    # Save subject data in a list
    subjects_list = [(subject[0], subject[1]) for subject in subjects]

    # Add subject names to the Listbox
    for index, subject in enumerate(subjects_list):
        list_subject.insert(index, subject[1])  # Show subject names only

    list_subject.pack(padx=10, pady=10)

    def clear_fields():
        entry_student.delete(0, tk.END)
        list_subject.selection_clear(0, tk.END)

    submit_button = tk.Button(root2, text="Submit", command=add_subgect, bg=button_color, fg=button_text_color)
    submit_button.pack(padx=10, pady=10)

    back_button = tk.Button(root2, text="Back to Main Menu", command=root2.destroy, bg=button_color, fg=button_text_color)
    back_button.pack(padx=10, pady=10)

def add_exam():
    def submit_exam():
        student_id = entry_student_id.get()
        subject_id = entry_subject_id.get()
        exam_score = entry_score.get()

        # Fetch all student IDs
        cursor.execute("SELECT id FROM students")
        student_ids = [row[0] for row in cursor.fetchall()]

        # Fetch all subject IDs
        cursor.execute("SELECT id FROM subject")
        subject_ids = [row[0] for row in cursor.fetchall()]

        # Fetch the subjects for the specific student
        cursor.execute("SELECT subject_id FROM student_subject WHERE student_id = %s", (student_id,))
        student_subjects = [row[0] for row in cursor.fetchall()]

        if not student_id or not subject_id or not exam_score:
            messagebox.showerror("Error", "Please fill all fields")
            return
        elif not student_id.isdigit() or int(student_id) not in student_ids:
            messagebox.showerror("Error", "Invalid Student ID")
            return
        elif not subject_id.isdigit() or int(subject_id) not in subject_ids:
            messagebox.showerror("Error", "Invalid Subject ID")
            return
        elif int(subject_id) not in student_subjects:
            messagebox.showerror("Error", "The student is not enrolled in this subject")
            return
        else:
            try:
                cursor.execute("INSERT INTO exams (student_id, subject_id, score) VALUES (%s, %s, %s)",
                               (student_id, subject_id, exam_score))
                conn.commit()
                messagebox.showinfo("Success", "Exam added successfully!")
                clear_fields()
            except mysql.connector.Error as err:
                messagebox.showerror("Database Error", f"Error: {err}")

    def clear_fields():
        entry_student_id.delete(0, tk.END)
        entry_subject_id.delete(0, tk.END)
        entry_score.delete(0, tk.END)

    root3 = tk.Toplevel()
    root3.title("Add Exam")
    root3.configure(bg=bg_color)
    root3.geometry("400x400")

    tk.Label(root3, text="Student ID", bg=bg_color, fg=label_color).pack(padx=10, pady=10)
    entry_student_id = tk.Entry(root3, bg=entry_bg_color, fg=entry_fg_color)
    entry_student_id.pack(padx=10, pady=10)

    tk.Label(root3, text="Subject ID", bg=bg_color, fg=label_color).pack(padx=10, pady=10)
    entry_subject_id = tk.Entry(root3, bg=entry_bg_color, fg=entry_fg_color)
    entry_subject_id.pack(padx=10, pady=10)

    tk.Label(root3, text="Score", bg=bg_color, fg=label_color).pack(padx=10, pady=10)
    entry_score = tk.Entry(root3, bg=entry_bg_color, fg=entry_fg_color)
    entry_score.pack(padx=10, pady=10)

    submit_button = tk.Button(root3, text="Submit", command=submit_exam, bg=button_color, fg=button_text_color)
    submit_button.pack(padx=10, pady=10)

    back_button = tk.Button(root3, text="Back to Main Menu", command=root3.destroy, bg=button_color, fg=button_text_color)
    back_button.pack(padx=10, pady=10)
def show_student():
    def fetch_student():
        student_id = entry_student_id.get()

        cursor.execute("SELECT * FROM students WHERE id = %s", (student_id,))
        student = cursor.fetchone()

        if not student:
            messagebox.showerror("Error", "Student not found")
            return

        output = f"ID: {student[0]}\nName: {student[1]} {student[2]}\nAge: {student[3]}\nGroup: {student[4]}\n"

        # Fetch subjects
        cursor.execute(
            "SELECT subject.subject_name FROM subject "
            "JOIN student_subject ON subject.id = student_subject.subject_id "
            "WHERE student_subject.student_id = %s", (student_id,)
        )
        subjects = cursor.fetchall()
        subject_names = ", ".join([subject[0] for subject in subjects])
        output += f"Subjects: {subject_names}\n"

        # Fetch exams
        cursor.execute(
            "SELECT subject.subject_name, exams.score FROM exams "
            "JOIN subject ON subject.id = exams.subject_id "
            "WHERE exams.student_id = %s", (student_id,)
        )
        exams = cursor.fetchall()
        exam_info = "\n".join([f"{exam[0]}: {exam[1]}" for exam in exams])
        output += f"Exams:\n{exam_info}" if exams else "No exam records found."

        messagebox.showinfo("Student Info", output)

    root4 = tk.Toplevel()
    root4.title("Show Student Information")
    root4.configure(bg=bg_color)

    tk.Label(root4, text="Enter Student ID", bg=bg_color, fg=label_color).pack(padx=10, pady=10)
    entry_student_id = tk.Entry(root4, bg=entry_bg_color, fg=entry_fg_color)
    entry_student_id.pack(padx=10, pady=10)

    fetch_button = tk.Button(root4, text="Fetch Info", command=fetch_student, bg=button_color, fg=button_text_color)
    fetch_button.pack(padx=10, pady=10)

    back_button = tk.Button(root4, text="Back to Main Menu", command=root4.destroy, bg=button_color, fg=button_text_color)
    back_button.pack(padx=10, pady=10)
    
def delete_student():
    def delete():
        student_id = entry_student_id.get()

        cursor.execute("SELECT id FROM students WHERE id = %s", (student_id,))
        student = cursor.fetchone()

        if not student:
            messagebox.showerror("Error", "Student not found")
            return

        try:
            cursor.execute("DELETE FROM student_subject WHERE student_id = %s", (student_id,))
            cursor.execute("DELETE FROM exams WHERE student_id = %s", (student_id,))
            cursor.execute("DELETE FROM students WHERE id = %s", (student_id,))
            conn.commit()
            messagebox.showinfo("Success", "Student deleted successfully!")
            clear_fields()

        except mysql.connector.Error as err:
            messagebox.showerror("Database Error", f"Error: {err}")

    def clear_fields():
        entry_student_id.delete(0, tk.END)

    root5 = tk.Toplevel()
    root5.title("Delete Student")
    root5.configure(bg=bg_color)
    root5.geometry("300x200")

    tk.Label(root5, text="Enter Student ID", bg=bg_color, fg=label_color).pack(padx=10, pady=10)
    entry_student_id = tk.Entry(root5, bg=entry_bg_color, fg=entry_fg_color)
    entry_student_id.pack(padx=10, pady=10)

    delete_button = tk.Button(root5, text="Delete", command=delete, bg=button_color, fg=button_text_color)
    delete_button.pack(padx=10, pady=10)

    back_button = tk.Button(root5, text="Back to Main Menu", command=root5.destroy, bg=button_color, fg=button_text_color)
    back_button.pack(padx=10, pady=10)

def modify_student():
    def update_student():
        student_id = entry_student_id.get()
        first_name = entry_first_name.get()
        last_name = entry_last_name.get()
        age = entry_age.get()
        group = group_var.get()

        if not student_id:
            messagebox.showerror("Error", "Please enter student ID")
            return

        cursor.execute("SELECT id FROM students WHERE id = %s", (student_id,))
        student = cursor.fetchone()

        if not student:
            messagebox.showerror("Error", "Student not found")
            return

        try:
            cursor.execute("UPDATE students SET first_name = %s, last_name = %s, age = %s, group_name = %s WHERE id = %s",
                           (first_name, last_name, age, group, student_id))
            conn.commit()

            # Update subjects
            selected_indices = list_subject.curselection()
            subjects_to_add = [subjects_list[index][0] for index in selected_indices]
            cursor.execute("DELETE FROM student_subject WHERE student_id = %s", (student_id,))
            for subject_id in subjects_to_add:
                cursor.execute("INSERT INTO student_subject (student_id, subject_id) VALUES (%s, %s)", (student_id, subject_id))

            # Update exams
            cursor.execute("SELECT id FROM subject")
            subject_ids = [row[0] for row in cursor.fetchall()]
            for subject_id in subject_ids:
                score = entry_scores[subject_id].get()
                if score:
                    cursor.execute("REPLACE INTO exams (student_id, subject_id, score) VALUES (%s, %s, %s)", (student_id, subject_id, score))

            conn.commit()
            messagebox.showinfo("Success", "Student details updated successfully!")
            clear_fields()

        except mysql.connector.Error as err:
            messagebox.showerror("Database Error", f"Error: {err}")

    def clear_fields():
        entry_student_id.delete(0, tk.END)
        entry_first_name.delete(0, tk.END)
        entry_last_name.delete(0, tk.END)
        entry_age.delete(0, tk.END)
        group_var.set('')
        list_subject.selection_clear(0, tk.END)
        for entry in entry_scores.values():
            entry.delete(0, tk.END)

    root6 = tk.Toplevel()
    root6.title("Modify Student")
    root6.configure(bg=bg_color)
    root6.geometry("400x600")

    tk.Label(root6, text="Student ID", bg=bg_color, fg=label_color).pack(padx=10, pady=10)
    entry_student_id = tk.Entry(root6, bg=entry_bg_color, fg=entry_fg_color)
    entry_student_id.pack(padx=10, pady=10)

    tk.Label(root6, text="First Name", bg=bg_color, fg=label_color).pack(padx=10, pady=10)
    entry_first_name = tk.Entry(root6, bg=entry_bg_color, fg=entry_fg_color)
    entry_first_name.pack(padx=10, pady=10)

    tk.Label(root6, text="Last Name", bg=bg_color, fg=label_color).pack(padx=10, pady=10)
    entry_last_name = tk.Entry(root6, bg=entry_bg_color, fg=entry_fg_color)
    entry_last_name.pack(padx=10, pady=10)

    tk.Label(root6, text="Age", bg=bg_color, fg=label_color).pack(padx=10, pady=10)
    entry_age = tk.Entry(root6, bg=entry_bg_color, fg=entry_fg_color)
    entry_age.pack(padx=10, pady=10)

    tk.Label(root6, text="Group", bg=bg_color, fg=label_color).pack(padx=10, pady=10)
    l = ['DEV101', 'DEV102', 'DEV103', 'DEV104', 'DEV105', 'DEV106', 'DEV107', 'DEV108', 'DEV109']
    group_var = tk.StringVar()
    group_var.set(l[0])
    group_menu = tk.OptionMenu(root6, group_var, *l)
    group_menu.config(fg="black")
    group_menu.pack(padx=10, pady=10)

    tk.Label(root6, text="Subjects", bg=bg_color, fg=label_color).pack(padx=10, pady=10)
    list_subject = tk.Listbox(root6, selectmode=tk.MULTIPLE, bg=entry_bg_color, fg=entry_fg_color)
    cursor.execute("SELECT id, subject_name FROM subject")
    subjects = cursor.fetchall()
    subjects_list = [(subject[0], subject[1]) for subject in subjects]

    for index, subject in enumerate(subjects_list):
        list_subject.insert(index, subject[1])
    list_subject.pack(padx=10, pady=10)

    tk.Label(root6, text="Exam Scores", bg=bg_color, fg=label_color).pack(padx=10, pady=10)
    entry_scores = {}
    for subject_id, subject_name in subjects_list:
        tk.Label(root6, text=subject_name, bg=bg_color, fg=label_color).pack(padx=10, pady=10)
        entry_scores[subject_id] = tk.Entry(root6, bg=entry_bg_color, fg=entry_fg_color)
        entry_scores[subject_id].pack(padx=10, pady=10)

    submit_button = tk.Button(root6, text="Submit", command=update_student, bg=button_color, fg=button_text_color)
    submit_button.pack(padx=10, pady=10)

    back_button = tk.Button(root6, text="Back to Main Menu", command=root6.destroy, bg=button_color, fg=button_text_color)
    back_button.pack(padx=10, pady=10)

def view_exam_result():
    def fetch_exam_result():
        student_id = entry_student_id.get()

        cursor.execute("SELECT * FROM students WHERE id = %s", (student_id,))
        student = cursor.fetchone()

        if not student:
            messagebox.showerror("Error", "Student not found")
            return

        # Fetch exam scores
        cursor.execute(
            "SELECT exams.score, subject.subject_name FROM exams "
            "JOIN subject ON subject.id = exams.subject_id "
            "WHERE exams.student_id = %s", (student_id,)
        )
        exams = cursor.fetchall()

        if not exams:
            messagebox.showinfo("Exam Results", "No exam records found for this student.")
            return

        passed_exams = [exam for exam in exams if exam[0] > 10]
        avg_score = sum(exam[0] for exam in exams) / len(exams)
        result = "Passed" if avg_score > 10 else "Failed"
        
        output = f"Student ID: {student_id}\nName: {student[1]} {student[2]}\n"
        output += f"Average Score: {avg_score:.2f}\nResult: {result}\n\n"
        output += "Exam Scores:\n"
        for exam in exams:
            output += f"{exam[1]}: {exam[0]}\n"

        messagebox.showinfo("Exam Results", output)

    root7 = tk.Toplevel()
    root7.title("View Exam Result")
    root7.configure(bg=bg_color)
    root7.geometry("400x400")

    tk.Label(root7, text="Enter Student ID", bg=bg_color, fg=label_color).pack(padx=10, pady=10)
    entry_student_id = tk.Entry(root7, bg=entry_bg_color, fg=entry_fg_color)
    entry_student_id.pack(padx=10, pady=10)

    fetch_button = tk.Button(root7, text="Fetch Result", command=fetch_exam_result, bg=button_color, fg=button_text_color)
    fetch_button.pack(padx=10, pady=10)

    back_button = tk.Button(root7, text="Back to Main Menu", command=root7.destroy, bg=button_color, fg=button_text_color)
    back_button.pack(padx=10, pady=10)
    

    root7 = tk.Toplevel()
    root7.title("View Exam Result")
    root7.configure(bg=bg_color)
    root7.geometry("400x400")

    tk.Label(root7, text="Enter Student ID", bg=bg_color, fg=label_color).pack(padx=10, pady=10)
    entry_student_id = tk.Entry(root7, bg=entry_bg_color, fg=entry_fg_color)
    entry_student_id.pack(padx=10, pady=10)

    fetch_button = tk.Button(root7, text="Fetch Result", command=fetch_exam_result, bg=button_color, fg=button_text_color)
    fetch_button.pack(padx=10, pady=10)

    back_button = tk.Button(root7, text="Back to Main Menu", command=root7.destroy, bg=button_color, fg=button_text_color)
    back_button.pack(padx=10, pady=10)

button_frame = tk.Frame(window, bg=bg_color)
button_frame.pack(pady=20)

button_width = 25

tk.Button(button_frame, text="Add Student", command=add, bg=button_color, fg=button_text_color, width=button_width).pack(pady=5)
tk.Button(button_frame, text="Add Subject to Student", command=addsubgect, bg=button_color, fg=button_text_color, width=button_width).pack(pady=5)
tk.Button(button_frame, text="Add Exam", command=add_exam, bg=button_color, fg=button_text_color, width=button_width).pack(pady=5)
tk.Button(button_frame, text="Show Student Information by ID", command=show_student, bg=button_color, fg=button_text_color, width=button_width).pack(pady=5)
tk.Button(button_frame, text="Delete Student", command=delete_student, bg=button_color, fg=button_text_color, width=button_width).pack(pady=5)
tk.Button(button_frame, text="Modify Student", command=modify_student, bg=button_color, fg=button_text_color, width=button_width).pack(pady=5)
tk.Button(button_frame, text="View Exam Result", command=view_exam_result, bg=button_color, fg=button_text_color, width=button_width).pack(pady=5)
                                                                                 

window.mainloop()
