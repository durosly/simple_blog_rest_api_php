# simple blog rest api with php

You can create, read all, read single, update and delete post as well as categories by making simple request to the server.
### How to use
* Create a database and import sql file in sql folder.
* You can use post man or any api testing tool of your choice to make request.
* A .htaccess file has been used to ensure clean url so url paths are in the form `locahost/your-project-folder-name/api/post/read/2`.
###### Post
* To read all post, make a GET request to `locahost/your-project-folder-name/api/post/read`.
* To read single post, make a GET request to `locahost/your-project-folder-name/api/post/read/2` where /[0-9]+ denotes the id of the post you wish to read.
* To update a post, make a PUT request to `locahost/your-project-folder-name/api/post/update`. Body should contain a json data with the following:
  - id
  - title
  - body
  - author
  - category_id
* To create a post, make a POST request to `locahost/your-project-folder-name/api/post/create`. Body should contain a json data with the following:
  - title
  - body
  - author
  - category_id
  - created_at need not be specified as it takes the current timestamp by default.
* To delete a post, make a DELETE request to `locahost/your-project-folder-name/api/post/delete`. Body should contain a json data with the id of the post to be deleted.
###### Category
* To read all categories, make a GET request to `locahost/your-project-folder-name/api/category/read`.
* To read single category, make a GET request to `locahost/your-project-folder-name/api/category/read/2` where /[0-9]+ denotes the id of the category you wish to read.
* To update a category, make a PUT request to `locahost/your-project-folder-name/api/category/update`. Body should contain a json data with the following:
  - id
  - name
  
* To create a category, make a POST request to `locahost/your-project-folder-name/api/category/create`. Body should contain a json data with the following:
  - name
  - created_at need not be specified as it takes the current timestamp by default.
* To delete a category, make a DELETE request to `locahost/your-project-folder-name/api/category/delete`. Body should contain a json data with the id of the category to be deleted. PS Do ensure not to delete a category associated to a post as there's is not implementation to prevent this and so may cause unintended error in output later on.
