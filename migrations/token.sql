CREATE TABLE `token`
(
    `token` varchar(255) NOT NULL,
    `user_id` varchar(255) NULL,
    `date` varchar(255) NULL
);
-- ALTER TABLE `token` ADD `date` DATETIME(6) NULL DEFAULT NULL AFTER `user_id`;