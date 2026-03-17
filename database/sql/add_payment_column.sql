-- Run this SQL in your database (phpMyAdmin or MySQL Workbench)
-- This adds the payment column to the classes table

ALTER TABLE classes ADD COLUMN payment DECIMAL(10,2) NULL AFTER duration;
