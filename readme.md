**Project's name: CRUD Project - CRUD operations using PHP & MySQL**

<a name="readme-top"></a>
<div align="center">
    <img src="/logo_jcm_md.png" alt="main-logo" width="500"  height="auto" />
  <br/>
  <h3><b>CRUDProject - CRUD operations using PHP</b></h3>
</div>

📗 Table of Contents <a name="table_of-contents"></a>

- [📗 Table of Contents](#table-of-contents)
- [📖 About project ](#about-project)
  - [🛠 Built With ](#-built-with-)
    - [Tech Stack ](#tech-stack-)
    - [Key Features ](#key-features-)
  - [💻 Getting Started ](#-getting-started-)
    - [Prerequisites](#prerequisites)
    - [Setup](#setup)
    - [Install](#install)
    - [Usage](#usage)
  - [👥 Author ](#-author-)
  - [🙏 Acknowledgments ](#-acknowledgments-)
  - [📝 License ](#-license-)

## 📖 About project - CRUDProject - CRUD operations using PHP <a name="about-project"></a>

The CRUDProject application is a simple PHP project to create a simple CRUD Web Application for users management. It uses PHP version 8.2.12 and MariaDB database server version 10.4.32. This project is part of the Pentatech IT Solutions PHP Internship program.


## 🛠 Built With <a name="built-with"></a>

### Tech Stack <a name="tech-stack"></a>

  <ul>
    <li><a href="https://www.apachefriends.org/download.html">XAMPP</a></li>
    <li><a href="https://www.php.net/downloads.php">PHP v 8.2.12</a></li>
    <li><a href="https://mariadb.org/download/">MariaDB v 10.4.32</a></li>
  </ul>

### Key Features <a name="key-features"></a>
- **Login and Signup forms, developed in the previous project.**
- **Implementation of session management.**
- **Implement a dashboard with a list of Users**
- **Implement CRUD operations for each user (Create, Read, Update, and Delete)**


<p align="right">(<a href="#readme-top">back to top</a>)</p>

## 💻 Getting Started <a name="getting-started"></a>

To get a local copy up and running, follow these steps.

### Prerequisites

In order to run this project you need:

[Install XAMPP](https://www.apachefriends.org/download.html)

Prerequisites: XAMPP application, including Apache web server, PHP (version 8), and MySQL DB server or MariaDB server. You can use a code editor like Visual Studio Code...

### Setup
Clone the CRUDProject repo. You can clone this project inside of XAMPP's public folder called htdocs (in Windows C:\xampp\htdocs).

```sh
  cd C:\xampp\htdocs
  git clone https://github.com/PentaTech-IT-Solutions/crud-project.git
```

### Install

This project requires the following dependencies: the PHP interpreter, the Apache Web Server, and a MySQL or MariaDB database server. All three components are bundled into XAMPP application (for Windows or Linux). Other similar software applications are WAMP (for Windows), LAMP (for Linux), and MAMP (for Mac).


### Database

Create a database using the url "localhost/phpmyadmin" in the browser. The PHPMyAdmin application will open to manage the database server.

You can use the file database/team_management.sql inside of an SQL tab of the PHPMyAdmin application. It contains all the information to set up the database to start using it.

You can call the database something like "crud_project". You can use PHPMyAdmin's graphic interface to create the database and the table.

- Create the crud_project database
- Create a users table (it will contain 6 columns).
- Create each column with the apropriate name, type, size, and other features. Columns are: id, username, fullname, email, password, phonenumber.


### Usage

To run the project, use the browser to enter the following path...

http://localhost/CRUDProject/signup.html or

http://localhost/CRUDProject/login.html


<p align="right">(<a href="#readme-top">back to top</a>)</p>


## 👥 Author <a name="author"></a>

👤 **Juan Carlos Muñoz**

- GitHub: [@jcmunav63](https://github.com/jcmunav63)
- Twitter: [@jcmunav63](https://twitter.com/jcmunav63)
- LinkedIn: [@juan-carlos-muñoz](https://www.linkedin.com/in/juan-carlos-mu%C3%B1oz-fullstackdev/)

<p align="right">(<a href="#readme-top">back to top</a>)</p>


## 🙏 Acknowledgments <a name="acknowledgements"></a>

* I would like to acknowledge all the support and help from PentaTech-IT-Solutions.

<p align="right">(<a href="#readme-top">back to top</a>)</p>


## 📝 License <a name="license"></a>

This project is [MIT](./LICENSE) licensed.

<p align="right">(<a href="#readme-top">back to top</a>)</p>
