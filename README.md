# 📚 Book Lost and Found System (BookMark)

This is a web-based **Book Lost and Found System** developed using **PHP**, **MySQL**, and **Apache XAMPP**.  
It is designed for college libraries where students are issued books and may sometimes forget them in classrooms.  
The system helps manage such lost books, track student fines, and maintain detailed records of found and returned books.

---

## 🎯 Purpose

The main goal of this system is to provide an efficient and trackable way to manage lost library books. It ensures:

- Cleaners or staff can report found books easily.
- Admins can store, track, and search for lost books.
- Students can reclaim their lost books through a proper workflow.
- Fines are managed based on how many times a student has lost books.
- Reports can be generated for monthly or yearly insights.

---

## ⚙️ Technologies Used

- **Frontend**: HTML, CSS, Bootstrap
- **Backend**: PHP
- **Database**: MySQL
- **Server**: Apache (via XAMPP)

---

## 🧑‍💼 Roles Involved

- **Admin**: Manages the system, registers found books, processes student claims, applies fines, and unlocks books.
- **Cleaner/Staff**: Hands over any books found in classrooms to the admin.
- **Student**: Approaches the admin when they realize a book is lost.

---

## 🔄 Workflow Overview

1. **Book Found**
   - A staff member finds a lost book in a classroom.
   - The book is handed over to the **Admin**.

2. **Book Registration**
   - Admin records:
     - Book Title
     - Cover Image
     - Date Found
     - Any other description
   - Book is now listed in the system.

3. **Student Search**
   - When a student realizes a book is lost, they can check with the admin.
   - Admin uses a search feature to find the book details.

4. **Fine System**
   - **First loss**: No fine.
   - **Second loss onward**: Fines are applied and **double** with each repeated loss.
   - Student must pay the fine at the **Accounts/Admin Office** and get a receipt.

5. **Book Unlocking**
   - Admin enters:
     - Student Enrollment Number
     - Receipt Number
     - Fine Amount
     - Date
   - Once verified, the book is **unlocked** and returned to the student.

6. **Record Keeping**
   - System maintains:
     - Monthly and yearly statistics
     - History of lost and returned books
   - Admin can **export reports** as:
     - Excel
     - PDF

---

## 🗂️ Features

- Add new lost books with details and images
- Search for lost books
- Fine tracking based on loss history
- Receipt-based validation for book reclaim
- Unlock and return books after fine processing
- Generate and export monthly/yearly reports
- Maintain complete history of book status

---

## 📦 Folder Structure (Example)

bms/ 
├── bookmark/
    └── admin
    └── assets
    └── jsPDF
    └── pages
    └── tcpdf
├── home/
├── login/
    └── index.php
├── index.php 


---

## 📊 Future Enhancements (Optional)

- Student login to view their history
- Email/SMS notifications
- QR code for each book entry
- Dashboard analytics for admin

---

## 🙌 Acknowledgements

This project was developed as a part of my academic journey to solve a real-world issue observed in our college environment.  
Special thanks to the college administration and faculty for encouraging practical problem-solving through projects.

---

## ✍️ Author

**Prakash Sirvi**  
- MCA Student | Passionate about solving real-world problems through tech  
- GitHub: [github.com/prakash0067](https://github.com/prakash0067)  
