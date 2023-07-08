# Auth App

Auth App is a basic MVC application built using PHP. It provides a simple authentication system with CRUD operations, routing system, database interactions, and file uploading functionality. This application is created for learning purposes and demonstrates how to handle authentication using middleware, work with relationships in the database, and implement a validation system.

## Table of Contents

- [Installation](#installation)
- [Features](#features)
- [Folder Structure](#folder-structure)
- [Configuration](#configuration)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)

## Installation

To get started with the Auth App, follow the steps below:

1. Clone the repository:

```shell
git clone https://github.com/mohamdebenchikh/auth-app.git
```

2. Configure the database settings in `src/config.php` file. Modify the `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, and `DB_PASS` constants according to your database configuration.

3. Make sure you have Apache server and PHP installed on your local machine.

4. Set up the Apache virtual host to point to the `public` directory of the application.

5. Start the Apache server.

6. Open your web browser and navigate to the configured virtual host URL.

## Features

The Auth App provides the following features:

- User authentication (login, registration, logout)
- User profile management (view profile, edit profile)
- Change password functionality
- Create, update, and delete posts
- File uploading with validation
- MVC architecture
- Routing system
- Middleware for authentication and guest access
- Validation rules for form validation
- Database interactions with PDO
- Basic views with Blade-like syntax

## Folder Structure

The folder structure of the Auth App is organized as follows:

```
auth-app/
  |- public/                  # Web root directory
  |   |- css/                 # CSS files
  |   |- js/                  # JavaScript files
  |   |- images/              # Uploaded images
  |- src/                     # Application source code
  |   |- Controllers/         # Controller classes
  |   |- Core/                # Core classes (Application, Database, Request, Response, etc.)
  |   |- Middleware/          # Middleware classes
  |   |- Models/              # Model classes
  |   |- Views/               # View files
  |   |- ValidationRules/     # Validation rules
  |   |- helpers.php          # Helper functions
  |   |- config.php           # Configuration file
  |- vendor/                  # Composer packages and autoloaded files
  |- .gitignore               # Git ignore file
  |- README.md                # Project README file
```

## Configuration

The configuration file `src/config.php` contains the necessary settings for the Auth App. It defines constants for paths, URLs, and database credentials. Modify the values of the following constants according to your environment:

- `ROOT_DIR`: The root directory path of your application.
- `BASE_PATH`: The base path of the application, which follows the domain name in the URL.
- `APP_NAME`: The name of your application.
- `APP_URL`: The base URL of your application.
- `DB_HOST`: The hostname of your database server.
- `DB_PORT`: The port number for the database connection.
- `DB_NAME`: The name of the database.
- `DB_USER`: The username for the database connection.
- `DB_PASS`: The password for the database connection.

Ensure that you provide the correct database credentials to establish a successful connection to your database.

## Usage

To use the Auth App, follow these steps:

1. Ensure that you have completed the installation steps mentioned above.

2. Start the Apache server and ensure it is running.

3. Open your web browser and navigate to the configured virtual host URL.

4. You will be presented with the homepage of the Auth App.

5. Register a new user account or log in with an existing account.

6. Explore the various features of the application, such as viewing and editing the profile, changing the password, and performing CRUD operations on posts.

## Contributing

Contributions to the Auth App are welcome! If you have any suggestions, improvements, or bug fixes, please create a pull request. Before submitting a pull request, make sure to run the tests (if any) and ensure that your changes adhere to the coding standards of the project.

## License

The Auth App is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

This readme file provides an overview of the Auth App, its installation process, features, folder structure, configuration, usage, and contribution guidelines. Feel free to modify this readme file according to your project's specific requirements.
