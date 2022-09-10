CREATE TABLE feedback
(
    `id` int NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `email` varchar(319) NOT NULL,
    `subject` varchar(100) NOT NULL,
    `message` varchar(100) NOT NULL,
    PRIMARY KEY (`id`)
);
