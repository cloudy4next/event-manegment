\# Event Management System

This is a PHP-based Event Management System that allows users to create
events, register for events, and view event details, with a paginated
list of registered users.

\## Table of Contents - \[Requirements\](#requirements) -
\[Installation\](#installation) - \[Database Setup\](#database-setup) -
\[Configuration\](#configuration) - \[Usage\](#usage) - \[API
Endpoints\](#api-endpoints) - \[Frontend\](#frontend) - \[File
Structure\](#file-structure) - \[Notes\](#notes) - \[License\](#license)

\## Requirements

\- PHP \>= 7.4 - MySQL or MariaDB - Apache or Nginx server - Composer
(optional for autoloading)

\## Installation

1\. \*\*Clone the Repository\*\*

Clone the repository to your local machine.

\`\`\`bash git clone
https://github.com/cloudy4next/event-management.git cd
event-management \`\`\`

2\. \*\*Install Composer Dependencies (Optional)\*\*

If you\'re using Composer for autoloading:

\`\`\`bash composer install \`\`\`

\## Database Setup

1\. \*\*Create Database\*\*

Log into your MySQL or MariaDB server and create a new database:

\`\`\`sql CREATE DATABASE event_management; \`\`\`

2\. \*\*Create Tables\*\*

Use the following SQL to create the necessary tables for events and
registrations:

\`\`\`sql USE event_management;

CREATE TABLE events ( id INT AUTO_INCREMENT PRIMARY KEY, name
VARCHAR(255) NOT NULL, event_date DATE NOT NULL, location VARCHAR(255)
NOT NULL, description TEXT NOT NULL, created_at TIMESTAMP DEFAULT
CURRENT_TIMESTAMP );

CREATE TABLE registrations ( id INT AUTO_INCREMENT PRIMARY KEY, event_id
INT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL,
address TEXT NOT NULL, mobile VARCHAR(15) NOT NULL, registered_at
TIMESTAMP DEFAULT CURRENT_TIMESTAMP, FOREIGN KEY (event_id) REFERENCES
events(id) ); \`\`\`

3\. \*\*Configure Database Credentials\*\*

Update the database credentials in \`config/config.php\`:

\`\`\`php define(\'DB_HOST\', \'localhost\'); define(\'DB_USER\',
\'root\'); define(\'DB_PASS\', \'\'); define(\'DB_NAME\',
\'event_management\'); \`\`\`

\## Configuration

Make sure the following configurations are in place:

1\. \*\*Database Connection:\*\* Ensure that \`config/config.php\`
contains the correct database credentials. 2. \*\*Event Management:\*\*
The application is designed to manage events, allowing users to create
and register for events.

\## Usage

1\. \*\*Start the PHP Server\*\*

If you\'re using a simple PHP server, run the following command from the
project root:

\`\`\`bash php -S localhost:8000 -t public \`\`\`

This will start the server on \`http://localhost:8000\`.

2\. \*\*Access the Application\*\*

Open your browser and navigate to \`http://localhost:8000\` to access
the event management system.

 - \*\*Login Page:\*\* \`/login\`  - \*\*Event List:\*\* \`/events\`  -
\*\*Event Creation:\*\* \`/events/create\`  - \*\*Event Details:\*\*
\`/events/view/{event_id}\`  - \*\*Registration Form:\*\*
\`/registrations/store/{event_id}\`  - \*\*Registered Users List:\*\*
\`/registrations/list/{event_id}/{page}\`

\## API Endpoints

The following API endpoints are available to interact programmatically
with the system:

1\. \*\*Get All Events\*\*

\`\`\`bash GET /api/events \`\`\`

Response:

\`\`\`json \[ { \"id\": 1, \"name\": \"Event Name\", \"event_date\":
\"2025-02-25\", \"location\": \"Event Location\", \"description\":
\"Event Description\" } \] \`\`\`

2\. \*\*Get Event Details\*\*

\`\`\`bash GET /api/events/{event_id} \`\`\`

Example Request: \`/api/events/1\`

Response:

\`\`\`json { \"id\": 1, \"name\": \"Event Name\", \"event_date\":
\"2025-02-25\", \"location\": \"Event Location\", \"description\":
\"Event Description\", \"registrations\": \[ { \"name\": \"User Name\",
\"email\": \"user@example.com\" } \] } \`\`\`

3\. \*\*Register for an Event\*\*

\`\`\`bash POST /registrations/store/{event_id} \`\`\`

Request Body:

\`\`\`json { \"name\": \"John Doe\", \"email\": \"john@example.com\",
\"address\": \"123 Street Name\", \"mobile\": \"123456789\" } \`\`\`

Response:

\`\`\`json { \"success\": true } \`\`\`

4\. \*\*Get Registrations for an Event with Pagination\*\*

\`\`\`bash GET /registrations/list/{event_id}/{page} \`\`\`

Example Request: \`/registrations/list/1/1\`

Response:

\`\`\`json { \"registrations\": \[ { \"name\": \"John Doe\", \"email\":
\"john@example.com\" } \], \"totalPages\": 3, \"currentPage\": 1 }
\`\`\`

\## Frontend

The frontend is a simple HTML/PHP interface that allows users to:

1\. \*\*View a list of events\*\* and their details. 2. \*\*Register for
an event\*\* by filling out the registration form. 3. \*\*View the list
of registered users\*\* for each event, with pagination.

The registration form and event details are located on the event detail
page (\`/events/view/{event_id}\`). Once registered, users will see a
success message.

\### Notes

\- \*\*Pagination:\*\* Registered users for each event are displayed
with pagination. - \*\*Toasts:\*\* Success or failure messages for
registration are shown using toasts. - \*\*AJAX:\*\* The registration
form uses AJAX for submitting data without reloading the page. -
\*\*Session:\*\* Sessions are used for user authentication
(login/logout).

\-\--

\## License

This project is open-source and available under the \[MIT
License\](LICENSE).
