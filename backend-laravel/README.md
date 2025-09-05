# # BACKEND GUIDE

# Laravel API for User Management

This is a RESTful API built with Laravel for managing users and their roles. The API allows for creating users, assigning roles, and retrieving user data grouped by roles.

## Features

- Create new users with full name, email, and roles.
- Retrieve a list of users grouped by their assigned roles.
- Role management with a many-to-many relationship between users and roles.
- Error handling with structured responses.

## Technologies Used

- Laravel 8
- PHP 7.3 or higher
- MySQL or any other supported database
- Axios (for frontend API consumption)

## Getting Started

### Prerequisites

- PHP (version 7.3 or higher)
- Composer
- Laravel 8
- MySQL or any other supported database

### Installation

1. Clone the repository:
  - https:
  ```bash
  git clone https://github.com/janzcio/laravel-react-simple-usermanagement-exam.git
  cd laravel-react-simple-usermanagement-exam\backend-laravel\
  ```
  - SSH:
  ```bash
  git clone git@github.com:janzcio/laravel-react-simple-usermanagement-exam.git
  cd laravel-react-simple-usermanagement-exam\backend-laravel\

2. Install the dependencies:
```bash
composer install
```

3. Create a ``.env`` file by copying the example:
```bash
cp .env.example .env
```
4. Generate the application key:
```bash
php artisan key:generate
```
5. Set up your database configuration in the .env file:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```
6. Run the migrations to create the necessary tables:
```bash
php artisan migrate
```
7. run seeder for inistal data of roles and users:
```bash
php artisan db:seed
```
8. Start the Laravel development server:
```bash
php artisan serve
```
9. The API will be available at http://127.0.0.1:8000/api.

### API Endpoints
- POST ``/api/users``: Create a new user.
```bash
Request Body:
{
  "full_name": "John Doe",
  "email": "john.doe@example.com",
  "roles": [1, 2] // Array of role IDs
}
```
- GET ``/api/users?role_id=1&groupbyrole=true``: Retrieve a list of users grouped by their roles.

   - Query Parameters:
      - role_id (optional): Filter users by a specific role ID.
      - groupbyrole (optional): If set to true, groups users by their roles in the response.
   - GET /api/roles: Retrieve a list of available roles.

### Error Handling
The API returns standardized error responses. For example:
```bash
{
    "status": "error",
    "description": "Unprocessable Entity",
    "errors": [
        {
            "field": "roles",
            "message": "At least one role is required."
        }
    ]
}
```

### Testing
You can use tools like Postman or cURL to test the API endpoints.
