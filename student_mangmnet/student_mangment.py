import tkinter as tk
from tkinter import messagebox
import mysql.connector
import customtkinter as ctk


conn = mysql.connector.connect(
    host="localhost",
    user="root",
    password="ziyad123",
    database="students_management"
)

cursor = conn.cursor()


ctk.set_appearance_mode("dark")
ctk.set_default_color_theme("dark-blue")

window = ctk.CTk()
window.title("Student Management System")
window.geometry("800x600")


main_frame = ctk.CTkFrame(window)
add_student_frame = ctk.CTkFrame(window)
add_subject_frame = ctk.CTkFrame(window)
exam_menu_frame = ctk.CTkFrame(window)
add_exam_frame = ctk.CTkFrame(window)
view_exam_frame = ctk.CTkFrame(window)
show_student_frame = ctk.CTkFrame(window)
delete_student_frame = ctk.CTkFrame(window)
modify_student_frame = ctk.CTkFrame(window)
enter_student_frame = ctk.CTkFrame(window)
show_group_students_frame = ctk.CTkFrame(window)


def show_frame(frame):
    for f in [main_frame, add_student_frame, enter_student_frame, add_subject_frame, exam_menu_frame, add_exam_frame, view_exam_frame, show_student_frame, delete_student_frame, modify_student_frame, show_group_students_frame]:
        f.pack_forget()
    frame.pack(fill='both', expand=True)


def main_menu():
    show_frame(main_frame)


def add_student():
    show_frame(add_student_frame)

    def add_student_to_db():
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
        elif int(age) < 18 or int(age) > 30:
            messagebox.showerror("Error", "Invalid age (must be between 18 and 30)")
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

    label_first_name = ctk.CTkLabel(add_student_frame, text="First Name")
    label_first_name.grid(row=0, column=0, padx=10, pady=10)
    entry_first_name = ctk.CTkEntry(add_student_frame)
    entry_first_name.grid(row=0, column=1, padx=10, pady=10)

    label_last_name = ctk.CTkLabel(add_student_frame, text="Last Name")
    label_last_name.grid(row=1, column=0, padx=10, pady=10)
    entry_last_name = ctk.CTkEntry(add_student_frame)
    entry_last_name.grid(row=1, column=1, padx=10, pady=10)

    label_age = ctk.CTkLabel(add_student_frame, text="Age")
    label_age.grid(row=2, column=0, padx=10, pady=10)
    entry_age = ctk.CTkEntry(add_student_frame)
    entry_age.grid(row=2, column=1, padx=10, pady=10)

    label_group = ctk.CTkLabel(add_student_frame, text="Group")
    label_group.grid(row=3, column=0, padx=10, pady=10)
    group_var = tk.StringVar()
    groups = ['DEV101', 'DEV102', 'DEV103', 'DEV104', 'DEV105', 'DEV106', 'DEV107', 'DEV108', 'DEV109']
    group_var.set(groups[0])
    group_menu = ctk.CTkOptionMenu(add_student_frame, variable=group_var, values=groups)
    group_menu.grid(row=3, column=1, padx=10, pady=10)

    submit_button = ctk.CTkButton(add_student_frame, text="Submit", command=add_student_to_db)
    submit_button.grid(row=4, column=0, columnspan=2, padx=10, pady=10)

    back_button = ctk.CTkButton(add_student_frame, text="Back to Main Menu", command=main_menu)
    back_button.grid(row=5, column=0, columnspan=2, padx=10, pady=10)

def add_subject():
    show_frame(add_subject_frame)

    def add_subject_to_group():
        group = group_var.get()
        selected_indices = list_subject.curselection()
        subject_ids = [subjects_list[index][0] for index in selected_indices]

        if not group or not subject_ids:
            messagebox.showerror("Error", "Please fill all fields")
            return
        else:
            try:
                for subject_id in subject_ids:
                    cursor.execute("INSERT INTO group_subject (group_name, subject_id) VALUES (%s, %s)",
                                   (group, subject_id))
                conn.commit()
                messagebox.showinfo("Success", "Subjects added to group successfully!")
                clear_fields()
            except mysql.connector.Error as err:
                messagebox.showerror("Database Error", f"Error: {err}")

    def clear_fields():
        group_var.set(groups[0])
        list_subject.selection_clear(0, tk.END)

    label_group = ctk.CTkLabel(add_subject_frame, text="Select Group")
    label_group.pack(padx=10, pady=10)
    group_var = tk.StringVar()
    groups = ['DEV101', 'DEV102', 'DEV103', 'DEV104', 'DEV105', 'DEV106', 'DEV107', 'DEV108', 'DEV109']
    group_var.set(groups[0])
    group_menu = ctk.CTkOptionMenu(add_subject_frame, variable=group_var, values=groups)
    group_menu.pack(padx=10, pady=10)

    label_subject = ctk.CTkLabel(add_subject_frame, text="Select Subjects")
    label_subject.pack(padx=10, pady=10)

    list_subject = tk.Listbox(add_subject_frame, selectmode=tk.MULTIPLE)
    cursor.execute("SELECT id, subject_name FROM subject")
    subjects = cursor.fetchall()
    subjects_list = [(subject[0], subject[1]) for subject in subjects]

    for index, subject in enumerate(subjects_list):
        list_subject.insert(index, subject[1])
    list_subject.pack(padx=10, pady=10)

    submit_button = ctk.CTkButton(add_subject_frame, text="Submit", command=add_subject_to_group)
    submit_button.pack(padx=10, pady=10)

    back_button = ctk.CTkButton(add_subject_frame, text="Back to Main Menu", command=main_menu)
    back_button.pack(padx=10, pady=10)


def exam_menu():
    show_frame(exam_menu_frame)

    add_exam_button = ctk.CTkButton(exam_menu_frame, text="Add Exam", command=add_exam)
    add_exam_button.pack(padx=10, pady=10)

    view_exam_button = ctk.CTkButton(exam_menu_frame, text="View Exam", command=view_exam)
    view_exam_button.pack(padx=10, pady=10)

    back_button = ctk.CTkButton(exam_menu_frame, text="Back to Main Menu", command=main_menu)
    back_button.pack(padx=10, pady=10)

def add_exam():
    show_frame(add_exam_frame)

    def fetch_subjects():
        student_id = entry_student_id.get()
        cursor.execute("SELECT group_name FROM students WHERE id = %s", (student_id,))
        student_group = cursor.fetchone()
        if not student_group:
            messagebox.showerror("Error", "Invalid Student ID")
            return

        cursor.execute("SELECT subject.id, subject.subject_name FROM subject "
                       "JOIN group_subject ON subject.id = group_subject.subject_id "
                       "WHERE group_subject.group_name = %s", (student_group[0],))
        subjects = cursor.fetchall()

        if not subjects:
            messagebox.showerror("Error", "No subjects found for the student's group")
            return

        for subject_id, subject_name in subjects:
            label = ctk.CTkLabel(add_exam_frame, text=subject_name)
            label.pack(padx=10, pady=5)
            entry = ctk.CTkEntry(add_exam_frame)
            entry.pack(padx=10, pady=5)
            entry_scores[subject_id] = entry

    def submit_exam_to_db():
        student_id = entry_student_id.get()

        if not student_id or not student_id.isdigit():
            messagebox.showerror("Error", "Please enter a valid Student ID")
            return

        try:
            for subject_id, entry in entry_scores.items():
                score = entry.get()
                if score:
                    cursor.execute("REPLACE INTO exams (student_id, subject_id, score) VALUES (%s, %s, %s)", (student_id, subject_id, score))
            conn.commit()
            messagebox.showinfo("Success", "Exam added/updated successfully!")
            clear_fields()
        except mysql.connector.Error as err:
            messagebox.showerror("Database Error", f"Error: {err}")

    def clear_fields():
        entry_student_id.delete(0, tk.END)
        for entry in entry_scores.values():
            entry.delete(0, tk.END)

    entry_scores = {}

    ctk.CTkLabel(add_exam_frame, text="Student ID").pack(padx=10, pady=10)
    entry_student_id = ctk.CTkEntry(add_exam_frame)
    entry_student_id.pack(padx=10, pady=10)

    fetch_button = ctk.CTkButton(add_exam_frame, text="Fetch Subjects", command=fetch_subjects)
    fetch_button.pack(padx=10, pady=10)

    submit_button = ctk.CTkButton(add_exam_frame, text="Submit", command=submit_exam_to_db)
    submit_button.pack(padx=10, pady=10)

    back_button = ctk.CTkButton(add_exam_frame, text="Back to Exam Menu", command=exam_menu)
    back_button.pack(padx=10, pady=10)


def view_exam():
    show_frame(view_exam_frame)

    def fetch_subjects():
        group = group_var.get()
        cursor.execute("SELECT subject.id, subject.subject_name FROM subject "
                       "JOIN group_subject ON subject.id = group_subject.subject_id "
                       "WHERE group_subject.group_name = %s", (group,))
        subjects = cursor.fetchall()
        subject_names = [subject[1] for subject in subjects]
        # Recreate subject_menu with new values
        subject_menu = ctk.CTkOptionMenu(view_exam_frame, variable=subject_var, values=subject_names)
        subject_menu.pack(padx=10, pady=10)

    def fetch_exam_results():
        group = group_var.get()
        subject_name = subject_var.get()

        cursor.execute("SELECT subject.id FROM subject WHERE subject_name = %s", (subject_name,))
        subject_id = cursor.fetchone()[0]

        cursor.execute("SELECT students.id, students.first_name, students.last_name, exams.score FROM students "
                       "JOIN exams ON students.id = exams.student_id "
                       "WHERE students.group_name = %s AND exams.subject_id = %s", (group, subject_id))
        results = cursor.fetchall()

        if not results:
            messagebox.showinfo("No Results", "No exam results found for the specified group and subject")
            return

        output = f"Exam Results for Group {group} and Subject {subject_name}:\n"
        for student_id, first_name, last_name, score in results:
            output += f"ID: {student_id}, Name: {first_name} {last_name}, Score: {score}\n"

        messagebox.showinfo("Exam Results", output)

    label_group = ctk.CTkLabel(view_exam_frame, text="Select Group")
    label_group.pack(padx=10, pady=10)
    group_var = tk.StringVar()
    groups = ['DEV101', 'DEV102', 'DEV103', 'DEV104', 'DEV105', 'DEV106', 'DEV107', 'DEV108', 'DEV109']
    group_var.set(groups[0])
    group_menu = ctk.CTkOptionMenu(view_exam_frame, variable=group_var, values=groups, command=lambda x: fetch_subjects())
    group_menu.pack(padx=10, pady=10)

    label_subject = ctk.CTkLabel(view_exam_frame, text="Select Subject")
    label_subject.pack(padx=10, pady=10)
    subject_var = tk.StringVar()
    subject_menu = ctk.CTkOptionMenu(view_exam_frame, variable=subject_var, values=[])
    subject_menu.pack(padx=10, pady=10)

    fetch_button = ctk.CTkButton(view_exam_frame, text="Fetch Results", command=fetch_exam_results)
    fetch_button.pack(padx=10, pady=10)

    back_button = ctk.CTkButton(view_exam_frame, text="Back to Exam Menu", command=exam_menu)
    back_button.pack(padx=10, pady=10)

def show_student():
    show_frame(show_student_frame)

    def fetch_student():
        student_id = entry_student_id.get()
        if not student_id:
            messagebox.showerror("Error", "Please enter a Student ID")
            return

        cursor.execute("SELECT * FROM students WHERE id = %s", (student_id,))
        student = cursor.fetchone()

        if not student:
            messagebox.showerror("Error", "Student not found")
            return

        output = f"ID: {student[0]}\nName: {student[1]} {student[2]}\nAge: {student[3]}\nGroup: {student[4]}\n"
        cursor.execute(
            "SELECT subject.subject_name FROM subject "
            "JOIN group_subject ON subject.id = group_subject.subject_id "
            "WHERE group_subject.group_name = %s", (student[4],)
        )
        subjects = cursor.fetchall()
        subject_names = ", ".join([subject[0] for subject in subjects])
        output += f"Subjects: {subject_names}\n"

        cursor.execute(
            "SELECT subject.subject_name, exams.score FROM exams "
            "JOIN subject ON subject.id = exams.subject_id "
            "WHERE exams.student_id = %s", (student_id,)
        )
        exams = cursor.fetchall()
        exam_info = "\n".join([f"{exam[0]}: {exam[1]}" for exam in exams])
        output += f"Exams:\n{exam_info}" if exams else "No exam records found."

        messagebox.showinfo("Student Info", output)

    ctk.CTkLabel(show_student_frame, text="Enter Student ID").pack(padx=10, pady=10)
    entry_student_id = ctk.CTkEntry(show_student_frame)
    entry_student_id.pack(padx=10, pady=10)

    fetch_button = ctk.CTkButton(show_student_frame, text="Fetch Info", command=fetch_student)
    fetch_button.pack(padx=10, pady=10)

    back_button = ctk.CTkButton(show_student_frame, text="Back to Main Menu", command=main_menu)
    back_button.pack(padx=10, pady=10)


def delete_student():
    show_frame(delete_student_frame)

    def delete():
        student_id = entry_student_id.get()
        cursor.execute("SELECT id FROM students WHERE id = %s", (student_id,))
        student = cursor.fetchone()

        if not student:
            messagebox.showerror("Error", "Student not found")
            return

        try:
            cursor.execute("DELETE FROM exams WHERE student_id = %s", (student_id,))
            cursor.execute("DELETE FROM students WHERE id = %s", (student_id,))
            conn.commit()
            messagebox.showinfo("Success", "Student deleted successfully!")
            clear_fields()
        except mysql.connector.Error as err:
            messagebox.showerror("Database Error", f"Error: {err}")

    def clear_fields():
        entry_student_id.delete(0, tk.END)

    ctk.CTkLabel(delete_student_frame, text="Enter Student ID").pack(padx=10, pady=10)
    entry_student_id = ctk.CTkEntry(delete_student_frame)
    entry_student_id.pack(padx=10, pady=10)

    delete_button = ctk.CTkButton(delete_student_frame, text="Delete", command=delete)
    delete_button.pack(padx=10, pady=10)

    back_button = ctk.CTkButton(delete_student_frame, text="Back to Main Menu", command=main_menu)
    back_button.pack(padx=10, pady=10)


def modify_student():
    show_frame(enter_student_frame)
    ctk.CTkLabel(enter_student_frame, text="Enter Student ID").pack(padx=10, pady=10)
    entry_student_id = ctk.CTkEntry(enter_student_frame)
    entry_student_id.pack(padx=10, pady=10)

    def fetch_student():
        student_id = entry_student_id.get()
        cursor.execute("SELECT * FROM students WHERE id = %s", (student_id,))
        student = cursor.fetchone()
        if student_id == '':
            messagebox.showerror("ERROR", "Fill out the entry")
            
        elif not student:
            messagebox.showerror("Error", "Student not found")
            return
        else:
            show_update_form(student_id, student)

    submit_button = ctk.CTkButton(enter_student_frame, text="Submit", command=fetch_student)
    submit_button.pack(padx=10, pady=10)
    back_button = ctk.CTkButton(enter_student_frame, text="Back to Main Menu", command=main_menu)
    back_button.pack(padx=10, pady=10)


def show_update_form(student_id, student):
    show_frame(modify_student_frame)

    # Create two sub-frames for splitting the content
    left_frame = ctk.CTkFrame(modify_student_frame)
    left_frame.grid(row=0, column=0, padx=10, pady=10, sticky="nsew")
    right_frame = ctk.CTkFrame(modify_student_frame)
    right_frame.grid(row=0, column=1, padx=10, pady=10, sticky="nsew")

    modify_student_frame.grid_columnconfigure(0, weight=1)
    modify_student_frame.grid_columnconfigure(1, weight=1)
    modify_student_frame.grid_rowconfigure(0, weight=1)

    def update_student():
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
        elif int(age) < 18 or int(age) > 30:
            messagebox.showerror("Error", "Invalid age (must be between 18 and 30)")
            return

        try:
            cursor.execute("UPDATE students SET first_name = %s, last_name = %s, age = %s, group_name = %s WHERE id = %s",
                           (first_name, last_name, age, group, student_id))
            conn.commit()

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
        entry_first_name.delete(0, tk.END)
        entry_last_name.delete(0, tk.END)
        entry_age.delete(0, tk.END)
        group_var.set('')
        for entry in entry_scores.values():
            entry.delete(0, tk.END)

    # Left frame content
    ctk.CTkLabel(left_frame, text="First Name").pack(padx=10, pady=10)
    entry_first_name = ctk.CTkEntry(left_frame)
    entry_first_name.insert(0, student[1])
    entry_first_name.pack(padx=10, pady=10)

    ctk.CTkLabel(left_frame, text="Last Name").pack(padx=10, pady=10)
    entry_last_name = ctk.CTkEntry(left_frame)
    entry_last_name.insert(0, student[2])
    entry_last_name.pack(padx=10, pady=10)

    ctk.CTkLabel(left_frame, text="Age").pack(padx=10, pady=10)
    entry_age = ctk.CTkEntry(left_frame)
    entry_age.insert(0, student[3])
    entry_age.pack(padx=10, pady=10)

    ctk.CTkLabel(left_frame, text="Group").pack(padx=10, pady=10)
    group_var = tk.StringVar()
    groups = ['DEV101', 'DEV102', 'DEV103', 'DEV104', 'DEV105', 'DEV106', 'DEV107', 'DEV108', 'DEV109']
    group_var.set(student[4])
    group_menu = ctk.CTkOptionMenu(left_frame, variable=group_var, values=groups)
    group_menu.pack(padx=10, pady=10)

    # Right frame content
    ctk.CTkLabel(right_frame, text="Exam Scores").pack(padx=10, pady=10)
    entry_scores = {}
    cursor.execute("SELECT id, subject_name FROM subject")
    subjects = cursor.fetchall()
    subjects_list = [(subject[0], subject[1]) for subject in subjects]

    for subject_id, subject_name in subjects_list:
        ctk.CTkLabel(right_frame, text=subject_name).pack(padx=10, pady=10)
        entry_scores[subject_id] = ctk.CTkEntry(right_frame)
        cursor.execute("SELECT score FROM exams WHERE student_id = %s AND subject_id = %s", (student_id, subject_id))
        exam_score = cursor.fetchone()
        if exam_score:
            entry_scores[subject_id].insert(0, exam_score[0])
        entry_scores[subject_id].pack(padx=10, pady=10)

    submit_button = ctk.CTkButton(modify_student_frame, text="Submit", command=update_student)
    submit_button.grid(row=1, column=0, columnspan=2, padx=10, pady=10)

    back_button = ctk.CTkButton(modify_student_frame, text="Back to Main Menu", command=main_menu)
    back_button.grid(row=2, column=0, columnspan=2, padx=10, pady=10)


def show_group_students():
    show_frame(show_group_students_frame)

    def fetch_group_students():
        group = group_var.get()
        if not group:
            messagebox.showerror("Error", "Please select a group")
            return

        cursor.execute("SELECT id, first_name, last_name FROM students WHERE group_name = %s", (group,))
        students = cursor.fetchall()

        if not students:
            messagebox.showerror("Error", "No students found in this group")
            return

        output = f"Students in {group}:\n"
        for student in students:
            output += f"ID: {student[0]}, Name: {student[1]} {student[2]}\n"

        messagebox.showinfo("Group Students", output)

    label_group = ctk.CTkLabel(show_group_students_frame, text="Select Group")
    label_group.pack(padx=10, pady=10)
    group_var = tk.StringVar()
    groups = ['DEV101', 'DEV102', 'DEV103', 'DEV104', 'DEV105', 'DEV106', 'DEV107', 'DEV108', 'DEV109']
    group_var.set(groups[0])
    group_menu = ctk.CTkOptionMenu(show_group_students_frame, variable=group_var, values=groups)
    group_menu.pack(padx=10, pady=10)

    fetch_button = ctk.CTkButton(show_group_students_frame, text="Fetch Students", command=fetch_group_students)
    fetch_button.pack(padx=10, pady=10)

    back_button = ctk.CTkButton(show_group_students_frame, text="Back to Main Menu", command=main_menu)
    back_button.pack(padx=10, pady=10)

# Main Frame (Main Menu)
main_frame.pack(fill='both', expand=True)

button_width = 200  
button_height = 40  

ctk.CTkButton(main_frame, text="Add Student", command=add_student, width=button_width, height=button_height).pack(pady=5)
ctk.CTkButton(main_frame, text="Add Subjects to Group", command=add_subject, width=button_width, height=button_height).pack(pady=5)
ctk.CTkButton(main_frame, text="Exam", command=exam_menu, width=button_width, height=button_height).pack(pady=5)
ctk.CTkButton(main_frame, text="Show Student Information by ID", command=show_student, width=button_width, height=button_height).pack(pady=5)
ctk.CTkButton(main_frame, text="Delete Student", command=delete_student, width=button_width, height=button_height).pack(pady=5)
ctk.CTkButton(main_frame, text="Modify Student", command=modify_student, width=button_width, height=button_height).pack(pady=5)
ctk.CTkButton(main_frame, text="Show Group Students", command=show_group_students, width=button_width, height=button_height).pack(pady=5)

window.mainloop()