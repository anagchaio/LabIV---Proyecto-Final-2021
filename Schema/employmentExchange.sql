CREATE database BolsaDeEmpleo;

use BolsaDeEmpleo;

CREATE TABLE careers(
	id_career int NOT NULL AUTO_INCREMENT,
	description varchar(100) NOT NULL,
	active boolean NOT NULL,
	constraint pk_career primary key (id_career)
);


CREATE TABLE companies(
	id_company int NOT NULL AUTO_INCREMENT,
	name varchar(50) NOT NULL,
	yearFoundantion DATE NOT NULL,
	city varchar(50) NOT NULL,
	description varchar(100) NOT NULL,
	logo longblob NOT NULL,
	email varchar(50) unique NOT NULL,
	phonenumber int(11) NOT NULL,
	constraint pk_company primary key (id_company)
);


CREATE TABLE users(
	id_user int NOT NULL AUTO_INCREMENT,
	email varchar(50) unique NOT NULL,
	password varchar(50) NOT NULL,
	name varchar(50) NOT NULL,
	id_student int,
	id_userType int NOT NULL
);

CREATE TABLE students(
	id_student int NOT NULL AUTO_INCREMENT,
	name varchar(50) NOT NULL,
	lastName varchar(50) NOT NULL,
	dni int(10),
	fileNumber mediumint unique,
	gender varchar(20),
	birthday DATE,
	email varchar(50) unique NOT NULL,
	phoneNumber int(11),
	active boolean NOT NULL,
	idcareer int NOT NULL,
	constraint pk_student primary key(id_student),
	constraint fk_idcareer foreign key (idcareer) references career(id_career)
);

CREATE TABLE jobPositions(
	id_jobPosition int NOT NULL AUTO_INCREMENT,
	description varchar(100) NOT NULL,
	career_id int not null,
	constraint pk_jobPosition primary key (id_jobPosition),
	constraint fk_career_id foreign key(career_id) references career(id_career)
);



CREATE TABLE jobOffers(
	id_jobOffer int NOT NULL AUTO_INCREMENT,
	description varchar(300) NOT NULL,
	limit_date DATE NOT NULL,
	state boolean NOT NULL,
	company_id int NOT NULL,
	jobPosition_id int NOT NULL,
	student_id int NOT NULL,
	constraint pk_jobOffer primary key (id_jobOffer),
	constraint fk_company_id foreign key (company_id) references company(id_company),
	constraint fk_jobPosition_id foreign key (jobPosition_id) references jobPosition(id_jobPosition),
	constraint fk_student_id foreign key(student_id) references student(id_student)
);

