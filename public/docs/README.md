# UsahaKu API Documentation

## Overview

The UsahaKu API provides a complete interface for managing blog content, categories, and comments in our multi-tenant blog platform. This API follows RESTful principles and returns JSON responses.

## Base URL

All API requests should be made to the following base URL:

```
https://yourdomain.com/api/v1
```

## Authentication

Some endpoints require authentication using a Bearer token. Include your API token in the Authorization header:

```
Authorization: Bearer YOUR_API_TOKEN
```

Endpoints marked with "Auth Required" in the documentation require authentication.

## API Resources

### Blog Categories

Manage blog categories in your application.

#### Endpoints

- `GET /blog-categories` - Retrieve a paginated list of blog categories (Auth Required)
- `POST /blog-categories` - Create a new blog category (Auth Required)
- `GET /blog-categories/{id}` - Retrieve a specific blog category by ID
- `PUT /blog-categories/{id}` - Update an existing blog category (Auth Required)
- `DELETE /blog-categories/{id}` - Delete an existing blog category (Auth Required)

#### Required Fields for Creation
- `username` (string) - The username associated with the category
- `subdomain` (string) - The subdomain for multi-tenancy
- `title` (string) - The title of the category
- `slug` (string) - The URL-friendly slug for the category

### Blogs

Manage blog posts in your application.

#### Endpoints

- `GET /blogs` - Retrieve a paginated list of blogs
- `POST /blogs` - Create a new blog post (Auth Required)
- `GET /blogs/{id}` - Retrieve a specific blog by ID
- `PUT /blogs/{id}` - Update an existing blog (Auth Required)
- `DELETE /blogs/{id}` - Delete an existing blog (Auth Required)
- `GET /blogs/category/{category}` - Retrieve blogs filtered by category ID
- `GET /blogs/author/{author}` - Retrieve blogs filtered by author

#### Required Fields for Creation
- `slug` (string) - URL-friendly slug for the blog
- `subdomain` (string) - The subdomain for multi-tenancy
- `username` (string) - The username associated with the blog
- `title` (string) - The title of the blog
- `blog_category_id` (integer) - ID of the blog category
- `author` (string) - The author of the blog
- `content` (string) - The content of the blog

### Blog Comments

Manage comments on blog posts.

#### Endpoints

- `GET /blog-comments` - Retrieve a paginated list of blog comments
- `POST /blog-comments` - Create a new blog comment
- `GET /blog-comments/{id}` - Retrieve a specific blog comment by ID
- `PUT /blog-comments/{id}` - Update an existing blog comment (Auth Required)
- `DELETE /blog-comments/{id}` - Delete an existing blog comment (Auth Required)

#### Required Fields for Creation
- `blog_id` (integer) - ID of the blog being commented on
- `username` (string) - The username of the commenter
- `subdomain` (string) - The subdomain for multi-tenancy
- `content` (string) - The comment content

## Error Handling

Our API returns standard HTTP status codes. Common error codes include:

- `200 OK` - Request successful
- `201 Created` - Resource successfully created
- `204 No Content` - Request successful, no content to return
- `400 Bad Request` - Request was malformed
- `401 Unauthorized` - Authentication required
- `403 Forbidden` - Access to resource denied
- `404 Not Found` - Resource doesn't exist
- `422 Unprocessable Entity` - Validation error
- `500 Internal Server Error` - Server error

## API Documentation Interface

You can interact with our API documentation directly through our interactive API browser:

- [API Documentation](./index.html) - Main documentation page
- [Interactive API Browser](./api.html) - Interactive Swagger UI

## Example Usage

### Creating a blog post

```bash
curl -X POST https://yourdomain.com/api/v1/blogs \
  -H "Authorization: Bearer YOUR_API_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "slug": "my-new-blog",
    "subdomain": "main",
    "username": "admin",
    "title": "My New Blog Post",
    "blog_category_id": 1,
    "author": "John Doe",
    "content": "This is the content of my blog post"
  }'
```

### Retrieving blogs by category

```bash
curl -X GET https://yourdomain.com/api/v1/blogs/category/1
```

## Rate Limiting

The API implements rate limiting to prevent abuse. The default rate limits are:

- 60 requests per minute for authenticated users
- 30 requests per minute for unauthenticated users

## Versioning

This documentation covers version 1 of the API. Future versions will be released as `/api/v2`, `/api/v3`, etc., to maintain backward compatibility.

## Support

For API support or questions, please contact:
- Email: api-support@usahaku.com
- Issue Tracker: https://github.com/kasurtipis/usahaku/issues