# TO-DO App - RESTful API with PHP & JavaScript

A complete web application demonstrating RESTful web services with CRUD operations using PHP backend and JavaScript frontend.

## Features

- ✅ Complete CRUD operations (Create, Read, Update, Delete)
- ✅ RESTful API endpoints
- ✅ Modern responsive UI
- ✅ Real-time updates
- ✅ Form validation
- ✅ Error handling
- ✅ JSON responses
- ✅ Proper HTTP status codes

## Project Structure

```
TODO APP_Restful API/
├── api/
│   └── items.php          # Main API endpoint
├── assets/
│   ├── css/
│   │   └── style.css      # Styling
│   └── js/
│       └── app.js         # Frontend JavaScript
├── config/
│   └── database.php       # Database configuration
├── database/
│   └── schema.sql         # Database schema
├── models/
│   └── Task.php           # Task model
├── index.html             # Main frontend page
└── README.md              # This file
```

## Setup Instructions

### Prerequisites
- XAMPP (or similar local server with PHP and MySQL)
- Web browser
- Text editor

### Installation Steps

1. **Start XAMPP Services**
   - Start Apache and MySQL services in XAMPP Control Panel

2. **Setup Database**
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Import the `database/schema.sql` file to create the database and table
   - Or manually run the SQL commands from `database/schema.sql`

3. **Configure Database Connection**
   - Edit `config/database.php` if needed (default settings work with XAMPP)
   - Default settings:
     - Host: localhost
     - Database: todo_app
     - Username: root
     - Password: (empty)

4. **Deploy Application**
   - Copy the entire project folder to `C:\xampp\htdocs\`
   - Or create a symbolic link to your project folder

5. **Access Application**
   - Open browser and go to: `http://localhost/TODO APP_Restful API/`
   - Or whatever folder name you used

## API Endpoints

### Base URL: `http://localhost/TODO APP_Restful API/api/items.php`

| Method | Endpoint | Description | Request Body |
|--------|----------|-------------|--------------|
| GET | `/` | Get all tasks | - |
| GET | `/{id}` | Get single task | - |
| POST | `/` | Create new task | `{"title": "string", "description": "string", "completed": boolean}` |
| PUT | `/{id}` | Update task | `{"title": "string", "description": "string", "completed": boolean}` |
| DELETE | `/{id}` | Delete task | - |

### Example API Usage

#### Get All Tasks
```bash
curl -X GET http://localhost/TODO APP_Restful API/api/items.php
```

#### Get Single Task
```bash
curl -X GET http://localhost/TODO APP_Restful API/api/items.php/1
```

#### Create Task
```bash
curl -X POST http://localhost/TODO APP_Restful API/api/items.php \
  -H "Content-Type: application/json" \
  -d '{"title": "New Task", "description": "Task description", "completed": false}'
```

#### Update Task
```bash
curl -X PUT http://localhost/TODO APP_Restful API/api/items.php/1 \
  -H "Content-Type: application/json" \
  -d '{"title": "Updated Task", "description": "Updated description", "completed": true}'
```

#### Delete Task
```bash
curl -X DELETE http://localhost/TODO APP_Restful API/api/items.php/1
```

## Testing with Postman

1. Import the following collection into Postman:

```json
{
  "info": {
    "name": "TODO API",
    "schema": "https://schema.getpostman.com/json/collection/v2.1.0/collection.json"
  },
  "item": [
    {
      "name": "Get All Tasks",
      "request": {
        "method": "GET",
        "header": [],
        "url": {
          "raw": "http://localhost/TODO APP_Restful API/api/items.php",
          "protocol": "http",
          "host": ["localhost"],
          "path": ["TODO APP_Restful API", "api", "items.php"]
        }
      }
    },
    {
      "name": "Create Task",
      "request": {
        "method": "POST",
        "header": [
          {
            "key": "Content-Type",
            "value": "application/json"
          }
        ],
        "body": {
          "mode": "raw",
          "raw": "{\n  \"title\": \"Test Task\",\n  \"description\": \"This is a test task\",\n  \"completed\": false\n}"
        },
        "url": {
          "raw": "http://localhost/TODO APP_Restful API/api/items.php",
          "protocol": "http",
          "host": ["localhost"],
          "path": ["TODO APP_Restful API", "api", "items.php"]
        }
      }
    }
  ]
}
```

## Features Demonstrated

### Backend (PHP)
- RESTful API design
- PDO database connection
- MVC pattern implementation
- Input validation and sanitization
- Proper HTTP status codes
- JSON response format
- Error handling

### Frontend (JavaScript)
- Modern ES6+ JavaScript
- Fetch API for HTTP requests
- Dynamic DOM manipulation
- Form handling and validation
- Responsive design
- Real-time UI updates
- User-friendly error messages

### Database
- MySQL database
- Proper table structure
- Auto-increment primary key
- Timestamps for tracking
- Boolean field for completion status

## Troubleshooting

### Common Issues

1. **Database Connection Error**
   - Check if MySQL is running in XAMPP
   - Verify database credentials in `config/database.php`
   - Ensure database `todo_app` exists

2. **404 Errors**
   - Check if Apache is running
   - Verify file paths are correct
   - Check `.htaccess` file if using URL rewriting

3. **CORS Issues**
   - The API includes CORS headers
   - If testing from different domain, adjust CORS settings

4. **Permission Errors**
   - Ensure XAMPP has proper file permissions
   - Check folder permissions in Windows

### Browser Console Testing

Open browser developer tools and test API calls:

```javascript
// Get all tasks
fetch('api/items.php')
  .then(response => response.json())
  .then(data => console.log(data));

// Create a task
fetch('api/items.php', {
  method: 'POST',
  headers: {'Content-Type': 'application/json'},
  body: JSON.stringify({
    title: 'Console Test',
    description: 'Created from browser console',
    completed: false
  })
})
.then(response => response.json())
.then(data => console.log(data));
```

## License

This project is for educational purposes. Feel free to use and modify as needed.

## Author
#princeMukwasa.    

Created as a demonstration of RESTful API development with PHP and JavaScript.



