# # FRONTEND GUIDE
# REACTJS User Management Application

This is a simple user management application built with React 17, TypeScript, Axios, and Tailwind CSS. The application allows users to create new user accounts and view a list of users grouped by their roles.

## Features

- Create new users with full name, email, and roles.
- View a list of users grouped by their assigned roles.
- Responsive design using Tailwind CSS for styling.
- Type safety with TypeScript.
- API integration using Axios.

## Technologies Used

- React 17
- TypeScript
- Axios
- Tailwind CSS
- React Router

## Getting Started

### Prerequisites

- Node.js (version 14 or higher)
- npm (Node Package Manager)

### Installation

1. Clone the repository:

   - https:
  ```bash
  git clone https://github.com/janzcio/laravel-react-simple-usermanagement-exam.git
  cd laravel-react-simple-usermanagement-exam\front-end-react\
  ```
  - SSH:
  ```bash
  git clone git@github.com:janzcio/laravel-react-simple-usermanagement-exam.git
  cd laravel-react-simple-usermanagement-exam\front-end-react\
  ```
2. Install the dependencies:
    ```bash
    npm install
    ```

3. Create a .env file in the root of the project and set the base URL for your API:
    ```bash
    REACT_APP_API_BASE_URL=http://127.0.0.1:8000/api
     ```

4. Start the development server:
    ```bash
    npm start
    ```

5. Open your browser and navigate to http://localhost:3000 to view the application.

### Usage
1. Create User: 
- Navigate to the user creation form at http://localhost:3000/users/create.
- Fill out the form with the user's full name, email, and roles (comma-separated role IDs).
- Click the "Submit" button. After submission, you will be redirected to the user list page

2. View Users by Role: 
- The user list page displays users grouped by their roles.
- You can see the full name and email of each user under their respective roles.
- Access the user list at http://localhost:3000/users/list.

### API Endpoints
- POST /api/users: Create a new user.
 ```bash
Request Body:
{
"full_name": "John Doe",
"email": "john.doe@example.com",
"roles": [1, 2] // Array of role IDs
}
```

- GET /api/users: Retrieve a list of users.

- GET /api/roles: Retrieve a list of available roles.

Styling
This application uses Tailwind CSS for styling. You can customize the styles in the src/index.css file and the Tailwind configuration in tailwind.config.js.
````
