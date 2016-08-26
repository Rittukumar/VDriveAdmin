-- changing the datatype of phone number field.
ALTER TABLE `driver_registration` MODIFY COLUMN `phone_number` VARCHAR(50) NOT NULL DEFAULT '0';