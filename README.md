<p align="center">
  <img width="700" height="100" src="https://github.com/LianaDace/news-page/blob/main/📰_News_Page_Project_.png">
</p>

 # To Run This News Page Project You Need:
 
````
 - ✅ You should have PHP ^7.4
 ````
 
  ## How To Launch This Project: 
 
❗️[Register here to get API key 🔑](https://newsapi.org)

---

### Install:

✅[Composer](https://getcomposer.org) <br>
✅[nikic/fast-route](https://packagist.org/packages/nikic/fast-route) <br>
✅[Twig](https://packagist.org/packages/twig/twig) <br>
✅[PHP-DI](https://php-di.org) <br>
✅[dotenv](https://www.npmjs.com/package/dotenv)



### Create:

- create .env file (into main directory) and copy ⬇️ into file
````
NEWSAPI_URL="https://newsapi.org/v2/" <br>
NEWSAPI_KEY=""
````

- copy your API 🔑 into file .env NEWSAPI_KEY="✅"
````
Create database and connect with project 
````
**Into database you need to create tables:**

- id INT AUTO_INCREMENT PRIMARY KEY,
- title varchar(255) NOT NULL,
- description varchar(255) NOT NULL,
- url varchar (255) NOT NULL,
- image varchar (255),
- date_created timestamp CURRENT_TIMESTAMP DEFAULT_GENERATED on update CURRENT_TIMESTAMP,

---

- .env file and copy ⬇️ into file and fill in with your data


DB_NAME="_your-atabase-name_" <br>
USER_NAME="_your-user-name_"<br>
PASSWORD="_your-user-password_"<br>
HOST_NAME="_your-host-name_"<br>
DRIVER="pdo_mysql"<br>



 
 
 
