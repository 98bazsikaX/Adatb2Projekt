CREATE OR REPLACE PROCEDURE tadd(mail users.email%TYPE ,first users.first_name%TYPE,last users.last_name%TYPE,birth users.birth_date%TYPE) AS
pid PURCHASES.ID%TYPE;
BEGIN 
    SELECT PURCHASES.ID INTO pid FROM PURCHASES WHERE USER_EMAIL = mail;

    INSERT INTO TICKETS(purchase_id,first_name,last_name,birth_date) VALUES(pid,first,last,birth);

END tadd;

