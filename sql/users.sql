CREATE TABLE users (
    id CHAR(36) PRIMARY KEY COMMENT 'Primary Key UUID',
    first_name VARCHAR(40) DEFAULT NULL COMMENT 'The users first name',
    last_name VARCHAR(40) DEFAULT NULL COMMENT 'The users last name',
    email VARCHAR(200) DEFAULT NULL COMMENT 'A unique identifier for a user',
    created DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT 'When the user was created',
    modified DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'When the user was last edited'
) ENGINE=INNODB;

INSERT INTO COMMENT 'Adding a new set of data'
  users
SET
  id=UUID(),
  first_name='John',
  last_name='Falzone',
  email='21jroc@gmail.com';

INSERT INTO
  users
SET
  id=UUID(),
  first_name='Bob',
  last_name='John',
  email='bobjohnson@gmail.com';

SELECT * FROM users; COMMENT 'Running a query to search all data in the table'

SELECT * FROM users WHERE email='21jroc@gmail.com';

SELECT
  first_name,
  last_name
FROM
  users
WHERE
  email='21jroc@gmail.com';

SELECT
  CONCAT(last_name, ' , ' first_name)
FROM
  users
WHERE
  email='21jroc@gmail.com';

SELECT
  first_name,
  last_name
FROM
  users
WHERE
  email LIKE '%.com';

SELECT COMMENT 'Search users table for all first and last names matching emails with .com and list in descending order'
  first_name,
  last_name
FROM
  users
WHERE
  email LIKE '%.com'
ORDER BY
  last_name DESC;
