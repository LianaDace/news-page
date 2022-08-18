CREATE TABLE articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title varchar(255) NOT NULL,
    description varchar(255) NOT NULL,
    url varchar (255) NOT NULL,
    image varchar (255),
    date_created timestamp CURRENT_TIMESTAMP DEFAULT_GENERATED on update CURRENT_TIMESTAMP,
) ENGINE=INNODB;