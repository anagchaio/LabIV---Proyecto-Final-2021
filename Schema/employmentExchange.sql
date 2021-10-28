CREATE database BolsaDeEmpleo;

use BolsaDeEmpleo;

CREATE TABLE careers(
	id_career int NOT NULL AUTO_INCREMENT,
	career_description varchar(100) NOT NULL,
	active boolean NOT NULL,
	constraint pk_career primary key (id_career)
);


CREATE TABLE companies(
	id_company int NOT NULL AUTO_INCREMENT,
	company_name varchar(50) NOT NULL,
	yearFoundantion DATE NOT NULL,
	city varchar(50) NOT NULL,
	description varchar(100) NOT NULL,
	logo longblob NOT NULL,
	email varchar(50) unique NOT NULL,
	phonenumber int(11) NOT NULL,
	constraint pk_company primary key (id_company)
);

CREATE TABLE jobPositions(
	id_jobPosition int NOT NULL AUTO_INCREMENT,
	jobPosition_description varchar(100) NOT NULL,
	career_id int not null,
	constraint pk_jobPosition primary key (id_jobPosition),
	constraint fk_career_id foreign key(career_id) references career(id_career)
);

CREATE TABLE jobOffers(
	id_jobOffer int NOT NULL AUTO_INCREMENT,
	jobOffer_description varchar(300) NOT NULL,
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

-- Parte Usuarios
CREATE TABLE userTypes(
	id_userType int NOT NULL AUTO_INCREMENT,
	name varchar(50) NOT NULL,
    constraint pk_userType primary key (id_userType)
);

CREATE TABLE users(
	id_user int NOT NULL AUTO_INCREMENT,
	email varchar(50) unique NOT NULL,
	password varchar(50) NOT NULL,
	name varchar(50) NOT NULL,
	id_student int,
	id_userType int NOT NULL,
    constraint pk_user primary key (id_user),
    constraint fk_userType foreign key (id_userType) references userTypes(id_userType)
);

INSERT INTO userTypes (name)
VALUES ('ADMIN');
INSERT INTO userTypes (name)
VALUES ('STUDENT');

INSERT INTO users (email, password, name, id_student, id_userType)
VALUES ('admin@admin.com', 'admin', 'ADMIN', NULL, 1);



