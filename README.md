Hi Sir, here is the live link for my project. I deployed it using InfinityFree because the system is built with PHP. Since GitHub Pages only supports static sites and doesn't run .php files, I had to use an external host to keep the website functional. Thank you!

https://fqhkm.page.gd/


Project Title "Nexus Student Portal"

## 📝 Project Description
The Nexus Student Portal is a centralized, web-based student information management platform developed using a rapid-development PHP framework. The portal streamlines the user onboarding process by enabling synchronized account creation and academic profiling through a single gateway. Designed with a premium dark-mode interface, the application is fully optimized for production deployment in cloud hosting environments, ensuring high responsiveness, strict data privacy, and a modern user experience.


## ⚡ Features Included

### 1. Dual-Table Synchronized Registration
* **Single-Form Onboarding:** Users only need to fill out a single intuitive form to simultaneously create their portal credentials and complete their academic profiles.
* **Automated Relational Mapping:** Upon submission, the system executes a secure transaction that maps account credentials (`username`, `email`, `password`) into the `users` table, while automatically linking and saving academic profile details (`name`, `student_id`, `ic_number`, `faculty`, `course`, `semester`) into the `students` table using a relational Foreign Key (`user_id`).

### 2. Premium Dark Mode UI/UX
* **Modern Aesthetic:** Built using the premium *Plus Jakarta Sans* typography paired with a deep navy visual palette and vibrant neon blue accent glows to minimize user eye strain during extended use.
* **Responsive Architecture:** Fully responsive layout integrated with *Font Awesome 6* iconography, ensuring a seamless visual experience across smartphones, tablets, and desktop computers.

### 3. Custom Session & Personalized Experience
* **State Management:** Utilizes a secure stateful authentication plugin to manage active user sessions and protect restricted student directories from unauthorized access.
* **Dynamic Data Rendering:** Features personalized dashboard greetings that dynamically extract data from the authenticated session entity to welcome the student by name (e.g., *"Welcome back, [Student Name]"*).

### 4. Production-Ready Deployment Optimization
* **Error Level Filtering:** Configured at the local application level (`app_local.php`) to suppress non-breaking syntax notices and deprecation warnings typical of shared hosting environments, ensuring a clean, polished user interface on the live server.

---

## 🛠️ Frameworks / Libraries Used
* **Backend Framework:** CakePHP 5.x (Rapid Development PHP Framework)
* **Database Management System:** MySQL / MariaDB
* **Security Module:** CakePHP Authentication Plugin (Bcrypt Hashing Component)
* **Frontend Design:** Custom CSS3 Media Queries & Premium Dark Mode Components
* **Typography & Icons:** Google Fonts (Plus Jakarta Sans) & Font Awesome 6 Icons
* **Hosting Platform:** InfinityFree Web Hosting (Apache Server Environment)

---

## 🔑 Instructions to Test Login

Follow these step-by-step instructions to test the registration and authentication flow of the portal:

1. **Navigate to the Sign Up Page:**
   * Access the portal's registration URL (e.g., `/users/signup` or `/users/add`).
   * Complete all fields under the **Account Details** and **Student Information** sections.
   * Click the **"Register New Account"** button. The system will create records in both tables simultaneously.

2. **Access the Login Page:**
   * You will be automatically redirected, or you can manually navigate to the login interface (e.g., `/users/login`).

3. **Enter Test Credentials:**
   * **Username / Email:** *(Enter the username or email address registered in Step 1)*
   * **Password:** *(Enter the plain-text password chosen during registration)*

4. **Verify Authentication Success:**
   * Click **Login**. The system will verify the password against the encrypted hash in the database.
   * Upon successful verification, you will be redirected to the secure **Student Dashboard**, where a personalized welcome message will dynamically display your registered name at the top of the portal.
