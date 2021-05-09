CREATE OR REPLACE PROCEDURE padd(mail IN users.email%TYPE, flight_id IN flights.id%TYPE, quantity IN purchases.quantity%TYPE) AS

BEGIN 
    INSERT INTO PURCHASES(USER_EMAIL,FLIGHT_ID,QUANTITY,PURCHASE_STATE) VALUES(mail,flight_id,quantity,'1');

END padd;

