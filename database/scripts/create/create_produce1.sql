CREATE OR REPLACE PROCEDURE padd(mail users.email%TYPE, flight_id flights.id%TYPE, quantity  purchases.quantity%TYPE) AS

BEGIN 
    INSERT INTO PURCHASES(USER_EMAIL,FLIGHT_ID,QUANTITY,PURCHASE_STATE) VALUES(mail,flight_id,quantity,'1');

END padd;

