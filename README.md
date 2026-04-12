**ENZYMEBASE (Educational Project)**

This project is a web-based enzyme database system developed as part of an academic project in Bioinformatics.

It allows users to store, manage, and retrieve enzyme-related information using a MySQL database and PHP-based web interface.

The system demonstrates database design, CRUD operations, and integration of backend with frontend.

--------------------------------------------------

**Features**

- Search enzymes by name  
- View enzyme details (enzyme ID, EC number, function, UniProt ID, molecular weight)  
- Insert new enzyme records into the database  
- Update existing enzyme records  
- Delete enzyme entries  
- Navigate through different modules (enzymes, kinetics, cofactors, organisms, reactions)  

--------------------------------------------------

**Folder Structure**

enzymebase/

├── database/            Database connection file  
├── insert/              Insert, update, delete operations  
├── search/              Search functionality  
├── pages/               Front-end pages (enzyme, kinetics, cofactors, organisms, reactions)  
├── images/              Icons and images used in UI  
├── index.php            Main entry point  

--------------------------------------------------

**Technologies Used**

- PHP  
- MySQL  
- HTML  
- CSS  
- XAMPP (local server environment)  

--------------------------------------------------

**Setup Instructions (XAMPP)**

1. Install XAMPP  

2. Place the project folder inside:  
   C:\xampp\htdocs\  

3. Start Apache and MySQL  

4. Create database using phpMyAdmin:  
   - Open http://localhost/phpmyadmin  
   - Create a database (e.g., enzymebase)  
   - Import the SQL file  

5. Run the project:  
   http://localhost/enzymebase  

--------------------------------------------------

**Functionality Overview**

Search Module  
Allows users to search enzymes using enzyme name. Results are displayed dynamically using PHP and MySQL queries.

Insert Module  
Provides forms to add new enzyme data into the database.

Update Module  
Allows modification of existing enzyme records using editable forms.

Delete Module  
Enables removal of enzyme records with confirmation.

--------------------------------------------------

**Learning Outcomes**

- Designing relational database schemas  
- Implementing CRUD operations using PHP and MySQL  
- Handling user input and form submission  
- Connecting backend database with frontend interface  
- Structuring a web-based project  

--------------------------------------------------

**Authors**

Mansi Parihar  
Sahana Udupa  
Niharika W N  