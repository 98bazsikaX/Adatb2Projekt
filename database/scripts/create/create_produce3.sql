create or replace PROCEDURE sadd( fid flights.id%TYPE,quantity purchases.quantity%TYPE) AS
kof airplanes.capacity%TYPE;
aid airplanes.id%TYPE;
cap airplanes.capacity%TYPE;
seatid seats.seat_id%TYPE;
sume NUMBER;
ifsum NUMBER;
i NUMBER:=1;


BEGIN 

   SELECT COUNT(seat) INTO kof FROM seats WHERE seats.flight_id=fid;
   SELECT flights.airplane_id  INTO aid FROM flights WHERE flights.id=fid; 
   SELECT capacity INTO cap FROM airplanes WHERE airplane_id=aid;
    seatid:=fid+cap;
   sume:=cap-kof;
   ifsum:=sume-quantity;
   IF ifsum>=0 THEN
   WHILE i <=quantity
   LOOP
    INSERT INTO SEATS(SEAT_ID,FLIGHT_ID,SEAT,SEAT_STATE) VALUES(seatid,fid,kof,'1');
    kof:=kof+1;
    seatid:= seatid+1;
    i:=i+1;
   END LOOP;
END if;


END sadd;

/