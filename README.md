# 🏛️ Senate Simulation

> *Making the U.S. Legislative Process Interactive and Accessible*

A civic education web application that transforms the way people learn 
about the legislative process. Instead of passively reading about how 
bills become laws, users actively participate — reviewing real-style 
bills and casting votes in a mock Senate session.

**Self-initiated project** — conceived, pitched, and built independently 
in a professional work environment.

---

## 📸 Screenshots
![User Profile](/images/profile.png)
![Committee Agenda](/images/agenda.png)
![User Voting on a bill](/images/vote.png)
![Live Senate Board during Voting](/images/board.png)

---

## 🎯 The Problem It Solves

Civic education around the legislative process is often passive, 
text-heavy, and disengaging. Senate Simulation changes that by putting 
users in the seat of a Senator — making democracy hands-on, interactive, 
and memorable.

---

## ✨ Features

### 👤 User Experience
- Secure account creation and login
- Browse and review active bills
- Cast votes in mock Senate sessions
- View voting outcomes and session results

### 🔐 Admin Panel
- User management and role-based access control
- Bill creation, editing, and session management
- Voting oversight and administrative reporting

---

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| Frontend | JavaScript, HTML, CSS |
| Backend | PHP |
| Database | MySQL |
| Authentication | Role-based user authentication (RBAC) |
| Scale | Architected for MySQL maximum row capacity |

---

## 🚀 Getting Started

### Dependencies
- PHP 7.4+
- MySQL 5.7+
- Web server (Apache or Nginx)
- Modern web browser
- Docker and Docker Compose (optional, for containerized setup)

### Docker Setup (Recommended)
If you prefer running the app in containers, this project includes a Docker Compose configuration for the web app and MySQL database.

1. Make sure Docker Desktop (or Docker Engine) is installed and running.
2. Copy the example environment file and update it if needed:
   ```bash
   cp .env.example .env
   ```
   On Windows PowerShell, use:
   ```powershell
   copy .env.example .env
   ```
3. From the project root, build and start the containers:
   ```bash
   docker compose up --build -d
   ```
4. Open the application in your browser at http://localhost/.
5. The MySQL database is exposed on port 3307 and is initialized with the SQL script in the sql/init.sql file. The Docker setup uses the values from your .env file for the database connection. Update the defaults in .env before launching anything publicly.
6. To stop and remove the containers when you are done:
   ```bash
   docker compose down
   ```

### Installing

1. Clone the repository
   ```bash
   git clone https://github.com/jhallgd/senate-simulation.git
   ```

2. Navigate to the project directory
   ```bash
   cd senate-simulation
   ```

3. Create your environment file from the example:
   ```bash
   cp .env.example .env
   ```
   Edit .env with your local database host, port, database name, username, and password. Replace the placeholder secrets before running the app.

4. Import the database schema
   ```bash
   mysql -u your_username -p your_database < sql/init.sql
   ```

5. Point your web server document root to the src directory so that the app entry point loads from src/index.php.


### Running the Application
1. Start your local web server (Apache/Nginx)
2. Navigate to http://localhost/
3. Log in
4. Begin adding and assigning bills, committees, senators, and parties.

### 📖 How to Use
**As a User:**
1. Create an account and log in
2. Navigate to the Bills section
3. Review bill details and supporting information
4. Cast your vote in the active session

**As an Admin:**
1. Log in with admin credentials
2. Create and manage bills in the admin panel
3. Open and close voting sessions
4. Monitor user activity and voting results

### 🗺️ Version History
### Version	Notes
0.1	Initial Release
Active	Continuously developed and improved

### 👤 Author
Jacob Hall

GitHub: [@jhallgd](https://github.com/jhallgd)
[Portfolio](https://jacob-hall.com/)
[LinkedIn](https://www.linkedin.com/in/jacob-a-hall/)

### 📄 License
This project is licensed under the MIT License — see the [LICENSE.md](/docs/LICENSE) file for details.

### 🙏 Acknowledgments
Inspired by Schoolhouse Rock — "I'm Just a Bill" 🎵
Built with the goal of making civic education engaging for everyone

### 💡 Why I Built This
This project wasn't assigned — I pitched it. I saw an opportunity to make civic education more engaging and took ownership of it from concept to execution. It reflects my belief that technology should make complex systems more accessible to everyone.
   
