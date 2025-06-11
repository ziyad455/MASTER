import tkinter as tk
from tkinter import messagebox
import mysql.connector
import customtkinter as ctk
from typing import List, Optional, Dict, Any


class Student:
    """Student class to represent a student entity"""
    
    def __init__(self, student_id: int = None, first_name: str = "", last_name: str = "", 
                 age: int = 0, group_name: str = ""):
        self.id = student_id
        self.first_name = first_name
        self.last_name = last_name
        self.age = age
        self.group_name = group_name
        self.subjects = []
        self.exams = {}
    
    def get_full_name(self):
        """Return full name of the student"""
        return f"{self.first_name} {self.last_name}"
    
    def is_valid_age(self):
        """Check if age is within valid range (18-30)"""
        return 18 <= self.age <= 30
    
    def add_exam_score(self, subject_id: int, score: float):
        """Add exam score for a subject"""
        self.exams[subject_id] = score
    
    def get_exam_score(self, subject_id: int):
        """Get exam score for a specific subject"""
        return self.exams.get(subject_id)
    
    def __str__(self):
        return f"Student(ID: {self.id}, Name: {self.get_full_name()}, Age: {self.age}, Group: {self.group_name})"


class Subject:
    """Subject class to represent a subject entity"""
    
    def __init__(self, subject_id: int = None, subject_name: str = ""):
        self.id = subject_id
        self.subject_name = subject_name
    
    def __str__(self):
        return f"Subject(ID: {self.id}, Name: {self.subject_name})"


class Exam:
    """Exam class to represent an exam entity"""
    
    def __init__(self, student_id: int, subject_id: int, score: float):
        self.student_id = student_id
        self.subject_id = subject_id
        self.score = score
    
    def is_passing_grade(self, passing_score: float = 60.0):
        """Check if the exam score is a passing grade"""
        return self.score >= passing_score
    
    def get_letter_grade(self):
        """Convert numeric score to letter grade"""
        if self.score >= 18:
            return "A"
        elif self.score >= 15:
            return "B"
        elif self.score >= 12:
            return "C"
        elif self.score >= 10:
            return "D"
        else:
            return "F"
    
    def __str__(self):
        return f"Exam(Student: {self.student_id}, Subject: {self.subject_id}, Score: {self.score})"


class DatabaseManager:
    """Database manager class to handle all database operations"""
    
    def __init__(self):
        self.connection = None
        self.cursor = None
        self.connect()
    
    def connect(self):
        """Establish database connection"""
        try:
            self.connection = mysql.connector.connect(
                host="localhost",
                user="user name",
                password="your password",
                database="students_management"
            )
            self.cursor = self.connection.cursor()
        except mysql.connector.Error as err:
            messagebox.showerror("Database Error", f"Connection failed: {err}")
    
    def close(self):
        """Close database connection"""
        if self.cursor:
            self.cursor.close()
        if self.connection:
            self.connection.close()
    
    def add_student(self, student: Student):
        """Add a new student to the database"""
        try:
            query = "INSERT INTO students (first_name, last_name, age, group_name) VALUES (%s, %s, %s, %s)"
            self.cursor.execute(query, (student.first_name, student.last_name, student.age, student.group_name))
            self.connection.commit()
            return True
        except mysql.connector.Error as err:
            messagebox.showerror("Database Error", f"Error adding student: {err}")
            return False
    
    def get_student_by_id(self, student_id: int) -> Optional[Student]:
        """Retrieve a student by ID"""
        try:
            query = "SELECT * FROM students WHERE id = %s"
            self.cursor.execute(query, (student_id,))
            result = self.cursor.fetchone()
            
            if result:
                student = Student(result[0], result[1], result[2], result[3], result[4])
                # Load exam scores
                self.load_student_exams(student)
                return student
            return None
        except mysql.connector.Error as err:
            messagebox.showerror("Database Error", f"Error retrieving student: {err}")
            return None
    
    def load_student_exams(self, student: Student):
        """Load exam scores for a student"""
        try:
            query = "SELECT subject_id, score FROM exams WHERE student_id = %s"
            self.cursor.execute(query, (student.id,))
            results = self.cursor.fetchall()
            
            for subject_id, score in results:
                student.add_exam_score(subject_id, score)
        except mysql.connector.Error as err:
            messagebox.showerror("Database Error", f"Error loading exams: {err}")
    
    def update_student(self, student: Student):
        """Update student information"""
        try:
            query = "UPDATE students SET first_name = %s, last_name = %s, age = %s, group_name = %s WHERE id = %s"
            self.cursor.execute(query, (student.first_name, student.last_name, student.age, student.group_name, student.id))
            self.connection.commit()
            return True
        except mysql.connector.Error as err:
            messagebox.showerror("Database Error", f"Error updating student: {err}")
            return False
    
    def delete_student(self, student_id: int):
        """Delete a student and their exam records"""
        try:
            # Delete exam records first
            self.cursor.execute("DELETE FROM exams WHERE student_id = %s", (student_id,))
            # Delete student record
            self.cursor.execute("DELETE FROM students WHERE id = %s", (student_id,))
            self.connection.commit()
            return True
        except mysql.connector.Error as err:
            messagebox.showerror("Database Error", f"Error deleting student: {err}")
            return False
    
    def get_students_by_group(self, group_name: str) -> List[Student]:
        """Get all students in a specific group"""
        try:
            query = "SELECT id, first_name, last_name FROM students WHERE group_name = %s"
            self.cursor.execute(query, (group_name,))
            results = self.cursor.fetchall()
            
            students = []
            for result in results:
                student = Student(result[0], result[1], result[2], group_name=group_name)
                students.append(student)
            return students
        except mysql.connector.Error as err:
            messagebox.showerror("Database Error", f"Error retrieving students: {err}")
            return []
    
    def get_subjects(self) -> List[Subject]:
        """Get all subjects"""
        try:
            query = "SELECT id, subject_name FROM subject"
            self.cursor.execute(query)
            results = self.cursor.fetchall()
            
            subjects = []
            for result in results:
                subject = Subject(result[0], result[1])
                subjects.append(subject)
            return subjects
        except mysql.connector.Error as err:
            messagebox.showerror("Database Error", f"Error retrieving subjects: {err}")
            return []
    
    def get_subjects_by_group(self, group_name: str) -> List[Subject]:
        """Get subjects for a specific group"""
        try:
            query = """
                SELECT subject.id, subject.subject_name 
                FROM subject 
                JOIN group_subject ON subject.id = group_subject.subject_id 
                WHERE group_subject.group_name = %s
            """
            self.cursor.execute(query, (group_name,))
            results = self.cursor.fetchall()
            
            subjects = []
            for result in results:
                subject = Subject(result[0], result[1])
                subjects.append(subject)
            return subjects
        except mysql.connector.Error as err:
            messagebox.showerror("Database Error", f"Error retrieving group subjects: {err}")
            return []
    
    def add_exam(self, exam: Exam):
        """Add or update an exam record"""
        try:
            query = "REPLACE INTO exams (student_id, subject_id, score) VALUES (%s, %s, %s)"
            self.cursor.execute(query, (exam.student_id, exam.subject_id, exam.score))
            self.connection.commit()
            return True
        except mysql.connector.Error as err:
            messagebox.showerror("Database Error", f"Error adding exam: {err}")
            return False
    
    def add_subject_to_group(self, group_name: str, subject_ids: List[int]):
        """Add subjects to a group"""
        try:
            for subject_id in subject_ids:
                query = "INSERT INTO group_subject (group_name, subject_id) VALUES (%s, %s)"
                self.cursor.execute(query, (group_name, subject_id))
            self.connection.commit()
            return True
        except mysql.connector.Error as err:
            messagebox.showerror("Database Error", f"Error adding subjects to group: {err}")
            return False
    
    def get_exam_results_by_group_and_subject(self, group_name: str, subject_id: int) -> List[Dict[str, Any]]:
        """Get exam results for a specific group and subject"""
        try:
            query = """
                SELECT students.id, students.first_name, students.last_name, exams.score 
                FROM students 
                JOIN exams ON students.id = exams.student_id 
                WHERE students.group_name = %s AND exams.subject_id = %s
            """
            self.cursor.execute(query, (group_name, subject_id))
            results = self.cursor.fetchall()
            
            exam_results = []
            for result in results:
                exam_result = {
                    'student_id': result[0],
                    'first_name': result[1],
                    'last_name': result[2],
                    'score': result[3]
                }
                exam_results.append(exam_result)
            return exam_results
        except mysql.connector.Error as err:
            messagebox.showerror("Database Error", f"Error retrieving exam results: {err}")
            return []


class StudentManagementApp:
    """Main application class"""
    
    def __init__(self):
        self.db_manager = DatabaseManager()
        self.groups = ['DEV101', 'DEV102', 'DEV103', 'DEV104', 'DEV105', 'DEV106', 'DEV107', 'DEV108', 'DEV109']
        self.light_mode = True
        
        self.setup_ui()
        self.create_frames()
        self.setup_main_menu()
    
    def setup_ui(self):
        """Setup the main UI configuration"""
        ctk.set_appearance_mode("light")
        ctk.set_default_color_theme("blue")
        
        self.window = ctk.CTk()
        self.window.title("Student Management System")
        self.window.geometry("600x600")
        
        # Create all frames
        self.frames = {}
    
    def create_frames(self):
        """Create all UI frames"""
        frame_names = [
            'main', 'add_student', 'add_subject', 'exam_menu', 'add_exam', 
            'view_exam', 'show_student', 'delete_student', 'modify_student', 
            'enter_student', 'show_group_students'
        ]
        
        for name in frame_names:
            self.frames[name] = ctk.CTkFrame(self.window)
    
    def show_frame(self, frame_name: str):
        """Show specific frame and hide others"""
        for frame in self.frames.values():
            frame.pack_forget()
        self.frames[frame_name].pack(fill='both', expand=True)
    
    def setup_main_menu(self):
        """Setup the main menu"""
        self.show_frame('main')
        
        button_width = 200
        button_height = 40
        
        buttons = [
            ("Add Student", self.add_student_screen),
            ("Add Subjects to Group", self.add_subject_screen),
            ("Exam", self.exam_menu_screen),
            ("Show Student Information by ID", self.show_student_screen),
            ("Delete Student", self.delete_student_screen),
            ("Modify Student", self.modify_student_screen),
            ("Show Group Students", self.show_group_students_screen)
        ]
        
        for text, command in buttons:
            ctk.CTkButton(
                self.frames['main'], 
                text=text, 
                command=command, 
                width=button_width, 
                height=button_height
            ).pack(pady=5)
        
        # Mode switch button
        self.mode_button = ctk.CTkButton(
            self.frames['main'], 
            text="⚪", 
            command=self.switch_mode,
            width=30, 
            height=30, 
            corner_radius=15, 
            border_width=2, 
            fg_color="white"
        )
        self.mode_button.place(x=10, y=10)
    
    def switch_mode(self):
        """Switch between light and dark mode"""
        self.light_mode = not self.light_mode
        
        if self.light_mode:
            ctk.set_appearance_mode("light")
            ctk.set_default_color_theme("light-blue")
            self.mode_button.configure(text="⚪", fg_color="white")
        else:
            ctk.set_appearance_mode("dark")
            ctk.set_default_color_theme("dark-blue")
            self.mode_button.configure(text="⚫️", fg_color="black")
    
    def add_student_screen(self):
        """Add student screen"""
        self.show_frame('add_student')
        self.window.geometry("400x400")
        
        # Clear previous widgets
        for widget in self.frames['add_student'].winfo_children():
            widget.destroy()
        
        # Setup grid
        self.frames['add_student'].grid_rowconfigure((0, 7), weight=1)
        self.frames['add_student'].grid_columnconfigure((0, 2), weight=1)
        
        # Entry fields
        ctk.CTkLabel(self.frames['add_student'], text="First Name").grid(row=1, column=0, padx=10, pady=10, sticky="e")
        self.entry_first_name = ctk.CTkEntry(self.frames['add_student'])
        self.entry_first_name.grid(row=1, column=1, padx=10, pady=10, sticky="w")
        
        ctk.CTkLabel(self.frames['add_student'], text="Last Name").grid(row=2, column=0, padx=10, pady=10, sticky="e")
        self.entry_last_name = ctk.CTkEntry(self.frames['add_student'])
        self.entry_last_name.grid(row=2, column=1, padx=10, pady=10, sticky="w")
        
        ctk.CTkLabel(self.frames['add_student'], text="Age").grid(row=3, column=0, padx=10, pady=10, sticky="e")
        self.entry_age = ctk.CTkEntry(self.frames['add_student'])
        self.entry_age.grid(row=3, column=1, padx=10, pady=10, sticky="w")
        
        ctk.CTkLabel(self.frames['add_student'], text="Group").grid(row=4, column=0, padx=10, pady=10, sticky="e")
        self.group_var = tk.StringVar(value=self.groups[0])
        group_menu = ctk.CTkOptionMenu(self.frames['add_student'], variable=self.group_var, values=self.groups)
        group_menu.grid(row=4, column=1, padx=10, pady=10, sticky="w")
        
        # Buttons
        ctk.CTkButton(self.frames['add_student'], text="Submit", command=self.add_student_to_db).grid(row=5, column=0, columnspan=2, pady=10)
        ctk.CTkButton(self.frames['add_student'], text="Back to Main Menu", command=self.main_menu).grid(row=6, column=0, columnspan=2, pady=10)
    
    def add_student_to_db(self):
        """Add student to database using Student class"""
        first_name = self.entry_first_name.get().strip()
        last_name = self.entry_last_name.get().strip()
        age_str = self.entry_age.get().strip()
        group = self.group_var.get()
        
        # Validation
        if not all([first_name, last_name, age_str, group]):
            messagebox.showerror("Error", "Please fill all fields")
            return
        
        try:
            age = int(age_str)
        except ValueError:
            messagebox.showerror("Error", "Invalid age (must be a number)")
            return
        
        # Create student object
        student = Student(first_name=first_name, last_name=last_name, age=age, group_name=group)
        
        # Validate age using student method
        if not student.is_valid_age():
            messagebox.showerror("Error", "Invalid age (must be between 18 and 30)")
            return
        
        # Add to database
        if self.db_manager.add_student(student):
            messagebox.showinfo("Success", "Student added successfully!")
            self.clear_add_student_fields()
        
    def clear_add_student_fields(self):
        """Clear add student form fields"""
        self.entry_first_name.delete(0, tk.END)
        self.entry_last_name.delete(0, tk.END)
        self.entry_age.delete(0, tk.END)
        self.group_var.set(self.groups[0])
    
    def show_student_screen(self):
        """Show student information screen"""
        self.show_frame('show_student')
        self.window.geometry("400x300")
        messagebox.showinfo("Info", "Make sure you know student ID or go to show students")
        
        # Clear previous widgets
        for widget in self.frames['show_student'].winfo_children():
            widget.destroy()
        
        ctk.CTkLabel(self.frames['show_student'], text="Enter Student ID").grid(row=0, column=0, padx=10, pady=10, sticky="w")
        self.entry_student_id = ctk.CTkEntry(self.frames['show_student'])
        self.entry_student_id.grid(row=0, column=1, padx=10, pady=10)
        
        ctk.CTkButton(self.frames['show_student'], text="Fetch Info", command=self.fetch_student_info).grid(row=1, column=0, columnspan=2, padx=10, pady=10)
        ctk.CTkButton(self.frames['show_student'], text="Back to Main Menu", command=self.main_menu).grid(row=2, column=0, columnspan=2, padx=10, pady=10)
    
    def fetch_student_info(self):
        """Fetch and display student information"""
        student_id_str = self.entry_student_id.get().strip()
        
        if not student_id_str:
            messagebox.showerror("Error", "Please enter a Student ID")
            return
        
        try:
            student_id = int(student_id_str)
        except ValueError:
            messagebox.showerror("Error", "Invalid Student ID")
            return
        
        # Get student using database manager
        student = self.db_manager.get_student_by_id(student_id)
        
        if not student:
            messagebox.showerror("Error", "Student not found")
            return
        
        # Get subjects for the student's group
        subjects = self.db_manager.get_subjects_by_group(student.group_name)
        subject_names = ", ".join([subject.subject_name for subject in subjects])
        
        # Display student information
        output = f"ID: {student.id}\n"
        output += f"Name: {student.get_full_name()}\n"
        output += f"Age: {student.age}\n"
        output += f"Group: {student.group_name}\n"
        output += f"Subjects: {subject_names}\n"
        
        # Display exam scores
        if student.exams:
            output += "Exams:\n"
            for subject in subjects:
                score = student.get_exam_score(subject.id)
                if score is not None:
                    exam = Exam(student.id, subject.id, score)
                    output += f"{subject.subject_name}: {score} ({exam.get_letter_grade()})\n"
        else:
            output += "No exam records found."
        
        messagebox.showinfo("Student Info", output)
    
    def delete_student_screen(self):
        """Delete student screen"""
        self.show_frame('delete_student')
        self.window.geometry("400x300")
        messagebox.showinfo("Info", "Make sure you know student ID or go to show students")
        
        # Clear previous widgets
        for widget in self.frames['delete_student'].winfo_children():
            widget.destroy()
        
        ctk.CTkLabel(self.frames['delete_student'], text="Enter Student ID").grid(row=0, column=0, padx=10, pady=10, sticky="w")
        self.entry_delete_student_id = ctk.CTkEntry(self.frames['delete_student'])
        self.entry_delete_student_id.grid(row=0, column=1, padx=10, pady=10)
        
        ctk.CTkButton(self.frames['delete_student'], text="Delete", command=self.delete_student).grid(row=1, column=0, columnspan=2, padx=10, pady=10)
        ctk.CTkButton(self.frames['delete_student'], text="Back to Main Menu", command=self.main_menu).grid(row=2, column=0, columnspan=2, padx=10, pady=10)
    
    def delete_student(self):
        """Delete student from database"""
        student_id_str = self.entry_delete_student_id.get().strip()
        
        if not student_id_str:
            messagebox.showerror("Error", "Please enter a Student ID")
            return
        
        try:
            student_id = int(student_id_str)
        except ValueError:
            messagebox.showerror("Error", "Invalid Student ID")
            return
        
        # Check if student exists
        student = self.db_manager.get_student_by_id(student_id)
        if not student:
            messagebox.showerror("Error", "Student not found")
            return
        
        # Confirm deletion
        result = messagebox.askyesno("Confirm Delete", f"Are you sure you want to delete {student.get_full_name()}?")
        if result:
            if self.db_manager.delete_student(student_id):
                messagebox.showinfo("Success", "Student deleted successfully!")
                self.entry_delete_student_id.delete(0, tk.END)
    
    def show_group_students_screen(self):
        """Show group students screen"""
        self.show_frame('show_group_students')
        self.window.geometry("400x300")
        
        # Clear previous widgets
        for widget in self.frames['show_group_students'].winfo_children():
            widget.destroy()
        
        ctk.CTkLabel(self.frames['show_group_students'], text="Select Group").grid(row=0, column=0, padx=10, pady=10)
        
        self.group_students_var = tk.StringVar(value=self.groups[0])
        group_menu = ctk.CTkOptionMenu(self.frames['show_group_students'], variable=self.group_students_var, values=self.groups)
        group_menu.grid(row=0, column=1, padx=10, pady=10)
        
        ctk.CTkButton(self.frames['show_group_students'], text="Fetch Students", command=self.fetch_group_students).grid(row=1, column=0, columnspan=2, padx=10, pady=10)
        ctk.CTkButton(self.frames['show_group_students'], text="Back to Main Menu", command=self.main_menu).grid(row=2, column=0, columnspan=2, padx=10, pady=10)
    
    def fetch_group_students(self):
        """Fetch and display students in a group"""
        group = self.group_students_var.get()
        students = self.db_manager.get_students_by_group(group)
        
        if not students:
            messagebox.showerror("Error", "No students found in this group")
            return
        
        output = f"Students in {group}:\n"
        for student in students:
            output += f"ID: {student.id}, Name: {student.get_full_name()}\n"
        
        messagebox.showinfo("Group Students", output)
    
    # Placeholder methods for other screens (you can implement these similarly)
    def add_subject_screen(self):
        messagebox.showinfo("Info", "Add Subject screen - implement similar to original")
        self.main_menu()
    
    def exam_menu_screen(self):
        """Exam menu screen"""
        self.show_frame('exam_menu')
        self.window.geometry("400x350")

        # Clear previous widgets
        for widget in self.frames['exam_menu'].winfo_children():
            widget.destroy()

        ctk.CTkLabel(self.frames['exam_menu'], text="Exam Menu", font=("Arial", 18)).pack(pady=10)

        ctk.CTkButton(self.frames['exam_menu'], text="Add Exam Score", command=self.add_exam_screen).pack(pady=10)
        ctk.CTkButton(self.frames['exam_menu'], text="View Exam Results", command=self.view_exam_screen).pack(pady=10)
        ctk.CTkButton(self.frames['exam_menu'], text="Back to Main Menu", command=self.main_menu).pack(pady=10)

    def add_exam_screen(self):
        """Add exam score screen"""
        self.show_frame('add_exam')
        self.window.geometry("400x400")

        # Clear previous widgets
        for widget in self.frames['add_exam'].winfo_children():
            widget.destroy()

        ctk.CTkLabel(self.frames['add_exam'], text="Student ID").grid(row=0, column=0, padx=10, pady=10, sticky="e")
        self.entry_exam_student_id = ctk.CTkEntry(self.frames['add_exam'])
        self.entry_exam_student_id.grid(row=0, column=1, padx=10, pady=10, sticky="w")

        ctk.CTkLabel(self.frames['add_exam'], text="Subject ID").grid(row=1, column=0, padx=10, pady=10, sticky="e")
        self.entry_exam_subject_id = ctk.CTkEntry(self.frames['add_exam'])
        self.entry_exam_subject_id.grid(row=1, column=1, padx=10, pady=10, sticky="w")

        ctk.CTkLabel(self.frames['add_exam'], text="Score").grid(row=2, column=0, padx=10, pady=10, sticky="e")
        self.entry_exam_score = ctk.CTkEntry(self.frames['add_exam'])
        self.entry_exam_score.grid(row=2, column=1, padx=10, pady=10, sticky="w")

        ctk.CTkButton(self.frames['add_exam'], text="Submit", command=self.add_exam_to_db).grid(row=3, column=0, columnspan=2, pady=10)
        ctk.CTkButton(self.frames['add_exam'], text="Back to Exam Menu", command=self.exam_menu_screen).grid(row=4, column=0, columnspan=2, pady=10)

    def add_exam_to_db(self):
        """Add exam score to database"""
        student_id_str = self.entry_exam_student_id.get().strip()
        subject_id_str = self.entry_exam_subject_id.get().strip()
        score_str = self.entry_exam_score.get().strip()

        if not all([student_id_str, subject_id_str, score_str]):
            messagebox.showerror("Error", "Please fill all fields")
            return

        try:
            student_id = int(student_id_str)
            subject_id = int(subject_id_str)
            score = float(score_str)
        except ValueError:
            messagebox.showerror("Error", "Invalid input (IDs must be integers, score must be a number)")
            return

        # Check if student exists
        student = self.db_manager.get_student_by_id(student_id)
        if not student:
            messagebox.showerror("Error", "Student not found")
            return

        # Check if subject exists
        subjects = self.db_manager.get_subjects()
        subject_ids = [subj.id for subj in subjects]
        if subject_id not in subject_ids:
            messagebox.showerror("Error", "Subject not found")
            return

        exam = Exam(student_id, subject_id, score)
        if self.db_manager.add_exam(exam):
            messagebox.showinfo("Success", "Exam score added successfully!")
            self.entry_exam_student_id.delete(0, tk.END)
            self.entry_exam_subject_id.delete(0, tk.END)
            self.entry_exam_score.delete(0, tk.END)

    def view_exam_screen(self):
        """View exam results screen"""
        self.show_frame('view_exam')
        self.window.geometry("400x400")

        # Clear previous widgets
        for widget in self.frames['view_exam'].winfo_children():
            widget.destroy()

        ctk.CTkLabel(self.frames['view_exam'], text="Group Name").grid(row=0, column=0, padx=10, pady=10, sticky="e")
        self.exam_group_var = tk.StringVar(value=self.groups[0])
        group_menu = ctk.CTkOptionMenu(self.frames['view_exam'], variable=self.exam_group_var, values=self.groups)
        group_menu.grid(row=0, column=1, padx=10, pady=10, sticky="w")

        ctk.CTkLabel(self.frames['view_exam'], text="Subject ID").grid(row=1, column=0, padx=10, pady=10, sticky="e")
        self.entry_view_exam_subject_id = ctk.CTkEntry(self.frames['view_exam'])
        self.entry_view_exam_subject_id.grid(row=1, column=1, padx=10, pady=10, sticky="w")

        ctk.CTkButton(self.frames['view_exam'], text="Fetch Results", command=self.fetch_exam_results).grid(row=2, column=0, columnspan=2, pady=10)
        ctk.CTkButton(self.frames['view_exam'], text="Back to Exam Menu", command=self.exam_menu_screen).grid(row=3, column=0, columnspan=2, pady=10)

    def fetch_exam_results(self):
        """Fetch and display exam results for a group and subject"""
        group = self.exam_group_var.get()
        subject_id_str = self.entry_view_exam_subject_id.get().strip()

        if not subject_id_str:
            messagebox.showerror("Error", "Please enter a Subject ID")
            return

        try:
            subject_id = int(subject_id_str)
        except ValueError:
            messagebox.showerror("Error", "Invalid Subject ID")
            return

        results = self.db_manager.get_exam_results_by_group_and_subject(group, subject_id)
        if not results:
            messagebox.showerror("Error", "No exam results found for this group and subject")
            return

        output = f"Exam Results for Group {group}, Subject ID {subject_id}:\n"
        for res in results:
            exam = Exam(res['student_id'], subject_id, res['score'])
            output += f"ID: {res['student_id']}, Name: {res['first_name']} {res['last_name']}, Score: {res['score']} ({exam.get_letter_grade()})\n"

        messagebox.showinfo("Exam Results", output)
    
    def modify_student_screen(self):
        messagebox.showinfo("Info", "Modify Student screen - implement similar to original")
        self.main_menu()
    
    def main_menu(self):
        """Return to main menu"""
        self.window.geometry("600x600")
        self.show_frame('main')
    
    def run(self):
        """Start the application"""
        self.window.mainloop()
    
    def __del__(self):
        """Cleanup when app is destroyed"""
        if hasattr(self, 'db_manager'):
            self.db_manager.close()


# Run the application
if __name__ == "__main__":
    app = StudentManagementApp()
    app.run()
