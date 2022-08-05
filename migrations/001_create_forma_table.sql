CREATE TABLE forma
(
    id int NOT NULL AUTO_INCREMENT,
    name_site varchar(255) NOT NULL,
    protocol_site varchar(255) NOT NULL,
    time_check int NULL,
    address_mail varchar(319) NOT NULL,
    id_tekegram varchar(100) NOT NULL,
    key_telegram varchar(100) NOT NULL,
    date_add int NULL,
    PRIMARY KEY (id)
);
