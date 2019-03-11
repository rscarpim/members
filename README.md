# members
<h3>Project to Login as an Administrator or a Regular User - PHP OO.</h3>

<h4><strong>Process to create the Database and the Stored Procedure</strong></h4>


Creating the Table
```
 CREATE TABLE `tb_users` 
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_user_name` varchar(255) DEFAULT NULL,
  `u_user_password` varchar(255) DEFAULT NULL,
  `u_user_first_name` varchar(45) DEFAULT NULL,
  `u_user_last_name` varchar(45) DEFAULT NULL,
  `u_user_email` varchar(255) DEFAULT NULL,
  `u_user_created@` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `u_user_update@` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
```

Creating de Stored Procedure CRUD
```
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_crud_users`(
    IN pType				SMALLINT,
    IN pUserID				INT,
    IN pUserName			VARCHAR(255),
    IN pUserPassword			VARCHAR(255),
    IN pUserFirstName			VARCHAR(45),
    IN pUserLastName			VARCHAR(45),
    IN pUserEMail		 	VARCHAR(255)
)
BEGIN

	START TRANSACTION;
    
		CASE pType
        
			/* INSERT*/
			WHEN 1 THEN
			BEGIN
            
				INSERT INTO tb_users 
					( u_user_name, 
					  u_user_password, 
					  u_user_first_name, 
					  u_user_last_name, 
					  u_user_email )
				VALUES
					( pUserName, 
					  pUserPassword, 
					  pUserFirstName, 
					  pUserLastName, 
					  pUserEmail );
			END;
			/* EDIT*/
			WHEN 2 THEN
			BEGIN
			
				/*UPDATE tb_users SET();*/
			END;
			/* DELETE*/
			WHEN 3 THEN
			BEGIN
				/*DELETE FROM tb_users WHERE  */
			END;
			
		END CASE;
        
	COMMIT;
END$$
DELIMITER ;
```

Populating the Table - This is The Master User.<br/>
User Name : masteruser<br/>
Password : 123456<br/>
```
INSERT INTO tb_users (`u_user_name`, 
		      `u_user_password`, 
		      `u_user_first_name`, 
		      `u_user_last_name`, 
		      `u_user_email`, 
		      `u_user_created@`, 
		      `u_user_update@`, 
		      `u_user_level`)
VALUES
		     ('masteruser', 
		      '$2y$12$oqdNoiYV7mbH38MRo2qXHu.Bq5NbigOXBYO3V.Q2CvFqaPpukhr1C', 
 		      'master', 
		      'user', 
		      'master@master.com', 
		      NULL, 
		      NULL, 
		      '1');
 ``` 
 
 Populating the Table - This is a Regular User.<br/>
 User Name : regularuser.<br/>
 Password : 123456<br/>
 ```
INSERT INTO tb_users (`u_user_name`, 
		      `u_user_password`, 
		      `u_user_first_name`, 
		      `u_user_last_name`, 
		      `u_user_email`, 
		      `u_user_created@`, 
		      `u_user_update@`, 
		      `u_user_level`)
VALUES
		     ('regularuser', 
		      '$2y$12$oqdNoiYV7mbH38MRo2qXHu.Bq5NbigOXBYO3V.Q2CvFqaPpukhr1C', 
 		      'regular', 
		      'user', 
		      'regular@regular.com', 
		      NULL, 
		      NULL, 
		      '0');
 ``` 
           
