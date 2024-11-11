
#   NovelNook

NovelNook is a dynamic web application built primarily with PHP, designed as a comprehensive platform for managing and browsing a collection of books. This application features user authentication, book management (adding, editing, and removing books), and a user dashboard, making it ideal for book enthusiasts or as a portfolio project for web development.

##  Features
-   User Registration and Login: Secure registration and login system for users to create accounts and access their own dashboard.
-   Book Management: Users can add, edit, and delete books from their collection.
-   Browse Books: Easily browse the collection, with options to view book details and cover images.
-   User Dashboard: A personalized dashboard for users to manage their profile and book collection.
-   Reusable Components: Common website elements like a navigation bar and footer are modularized for maintainability.


##  Project Structure
The project is organized into various PHP files to handle specific functionalities:

-   index.php: The homepage, allowing users to browse the main collection.
-   login.php / registration.php / logout.php: Handles user authentication and    session management.
-   userDashboard.php: A dashboard providing users with personalized options to manage their collection.
-   InsertBook.php / editBook.php / removeBook.php: Enables users to add, update, or remove books in the collection.
-   Navbar.php: Modular navigation bar for consistent header navigation across pages.
-   footer.php: Reusable footer component.
-   dbConn.php: Database connection file to manage database interactions.
-   script.js and style.css: Additional JavaScript and CSS for enhancing the user interface and interactivity.

##  Setup
### Prerequisites
-   PHP (version 7.4)
-   MySQL/MariaDB database
-   Apache or another server environment (e.g., XAMPP for local development)

##  Installation
Clone the repository:
git clone https://github.com/your-username/NovelNook.git

Navigate to the project folder and set up the MySQL database:

Create a new database in MySQL (e.g., novelnook_db).

Import the provided SQL file (if available) or create tables according to the code in dbConn.php.

Update dbConn.php with your database credentials:

`$servername = "localhost";
$username = "your_db_username";
$password = "your_db_password";
$dbname = "novelnook_db";`

Start your server and navigate to http://localhost/NovelNook/index.php to access the application.

##  Usage
-   Register/Login: Begin by creating an account or logging in as an existing user.
-   Manage Books: Use the dashboard to add new books, edit details, or remove them as needed.
-   Browse Collection: View the entire book collection on the homepage, along with cover images and book details.
