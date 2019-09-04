CREATE TABLE customers (	  
    id int(11) NOT NULL,	  
    name varchar(255) NOT NULL,	  
    email varchar(80) NOT NULL,	  
    data_hora datetime NOT NULL,
    );
    
ALTER TABLE customers 
	ADD PRIMARY KEY (id);	  	
    
ALTER TABLE customers 
	MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;