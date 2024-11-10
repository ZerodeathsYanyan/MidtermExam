create table Chefs (
	chef_ID INT AUTO_INCREMENT PRIMARY KEY,
	first_name VARCHAR(50),
	last_name VARCHAR(50),
	date_of_birth DATE,
    specialization VARCHAR(50),
	date_registered TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
create table Dishes (
	dishes_ID INT AUTO_INCREMENT PRIMARY KEY,
	nameofdish VARCHAR(50),
	typeofdish VARCHAR(50),
	ratings INT,
    chef_ID VARCHAR(50)
);

ALTER TABLE chefs
ADD username varchar(50);

ALTER TABLE chefs
ADD password varchar(50);

ALTER TABLE Dishes
ADD added_by INT,  
ADD last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP; 


