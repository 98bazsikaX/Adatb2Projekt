# Repülőjegy foglalás, utazási iroda - Projektterv

## 1. Összefoglaló
Projektünk egy repülőjegy foglaló webalkalmazás tervezése és implementációja. Célunk, hogy a látogatók, felhasználók kényelmesen tudjanak repülőjegyet foglalni különböző légitársaságoktól, a világ minél több pontjára.

## 2. Projekt bemutatása

### 2.1. Specifikáció
A látogatók böngészni, keresni tudnak járatokat igényeiknek megfelelően, jegyvásárláshoz azonban regisztrálni kell, majd bejelentkezni. A felhasználó ki tudja választani, mely járatra szeretne jegye(ke)t venni, megadja az adatokat (saját és más utasok), majd kifizeti a jegye(ke)t (kedvezmények automatikus érvényesítése után). Ezt követően, amennyiben minden rendben ment, a felhasználó e-mailben kapja meg a jegye(ke)t. Amennyiben az adott járat mégsem megfelelő valakinek, úgy lehetősege van visszamondani, esetleg járatot cserélni.

### 2.2. Funkcionális követelmények
- Böngészés
- Regisztráció
- Bejelentkezés
- Különböző légitársaságok, repülőjáratok, járattípusok
- Keresés/szűrés
- Repülőjegy vásárlás repülőjáratra (árak, kedvezmények)
- Különböző méretű csomagok kezelése (kategóriák, méretek, árak)
- Visszamondás/csere

### 2.3. Nem-funkcionális követelmények

- Letisztult UI, használata intuitív

## 3. Diagramok

### 3.1. AFD-k

#### 3.1.1. Fizikai AFD

##### 3.1.1.1. 1. szint
[1. szintű fizikai adatfolyam diagram](./doc/dia/afd/fizikai/img/lvl1.png)
![1. szintű fizikai adatfolyam diagram](./doc/dia/afd/fizikai/img/lvl1.png)
##### 3.1.1.2. 2. szint
[2. szintű fizikai adatfolyam diagram](./doc/dia/afd/fizikai/img/lvl2.png)
![2. szintű fizikai adatfolyam diagram](./doc/dia/afd/fizikai/img/lvl2.png)
##### 3.1.1.3. 3. szint
[3. szintű fizikai adatfolyam diagram](./doc/dia/afd/fizikai/img/lvl3.png)
![3. szintű fizikai adatfolyam diagram](./doc/dia/afd/fizikai/img/lvl3.png)
#### 3.1.2. Logikai AFD

##### 3.1.2.1. 1. szint
[1. szintű logikai adatfolyam diagram](./doc/dia/afd/logikai/img/lvl1.png)
![1. szintű logikai adatfolyam diagram](./doc/dia/afd/logikai/img/lvl1.png)
##### 3.1.2.2. 2. szint
[2. szintű logikai adatfolyam diagram](./doc/dia/afd/logikai/img/lvl2.png)
![2. szintű logikai adatfolyam diagram](./doc/dia/afd/logikai/img/lvl2.png)
##### 3.1.2.3. 3. szint
[3. szintű fizikai adatfolyam diagram](./doc/dia/afd/logikai/img/lvl3.png)
![3. szintű fizikai adatfolyam diagram](./doc/dia/afd/logikai/img/lvl3.png)
### 3.2. Egyed-kapcsolat diagram
[Egyed-kapcsolat diagram](./doc/dia/entity_relationship.png)
![Egyed-kapcsolat diagram](./doc/dia/entity_relationship.png)
## 4. EK diagram leképezése
Jogosultság(<ins>azonosító</ins>, név)  
Felhasználó(<ins>e-mail</ins>, jelszó, telefonszám, vezetéknév, utónév, születési-dátum, ország, irányítószám, város, cím, *Jogosultság.azonosító*, regisztráció-időpont)  
Napló(<ins>azonosító</ins>, *Felhasználó.e-mail*, belépés-időpontja, kilépés-időpontja)  
Légitársaság(<ins>kód</ins>, név, rövidítés, ország)  
Repülő(<ins>azonosító</ins>, repülő-azonosító, *Légitársaság.kód*, típus, férőhely)  
Repülőtér(<ins>kód</ins>, név, ország, város)  
Járat(<ins>járatszám</ins>, *Repülő.azonosító*, jegyár, indulás-idő, *indulás-repülőtér*, érkezés-idő, *érkezés-repülőtér*)  
Ülőhely-állapot(<ins>azonosító</ins>, állapot)  
Ülőhely(<ins>*Járat.járatszám*</ins>, <ins>szék</ins>, *állapot*)  
Kedvezmény-típusok(<ins>név</ins>, szorzó)  
Kedvezmény(<ins>azonosító</ins>, *Járat.járatszám*, *típus*, mérték, mettől, meddig)  
Vásárlási-állapot(<ins>azonosító</ins>, állapot)  
Vásárlás(<ins>azonosító</ins>, *Felhasználó.e-mail*, *Járat.járatszám*, darabszám, mikor, *állapot*)  
Jegy(<ins>azonosító</ins>, *Vásárlás.azonosító*, vezetéknév, utónév, születési-dátum)  
Csomag-típus(<ins>azonosító</ins>, *Légitársaság.azonosító*, rövidítés, leírás, magasság, szélesség, mélység, ár)  
Csomag(<ins>azonosító</ins>, *Jegy.azonosító*, *Csomag-típus.azonosító*)  
Keresés(<ins>azonosító</ins>, *Felhasználó.e-mail*, *indulás-ország*, *indulás-város*, *érkezés-ország*, *érkezés-város*, mettől, meddig, ártól, árig, <ins>mikor</ins>)  

### 4.1. 1. normálforma
A relációséma 1NF-ben van: többértékű attribútumok nem voltak, az összetett attribútumok pedig helyettesítve lettek részattribútumaikkal.

### 4.2. 2. normálforma
A relációséma 2NF-ben van: ahol a kulcs kompozit lett volna, ott egyedi azonosító lett bevezetve, így a sémák mindegyikében egyetlen attribútumból áll a kulcs.

### 4.3. 3. normálforma
A relációséma 3NF-ben van: a sémák mindegyikében a másodlagos attribútumok közvetlenül függnek a kulcsoktól.

## 5. Relációsémák
[EK diagramból képzett relációsémák](./doc/relation_schema.xlsx)

### 5.1. Jogosultság

Jogosultság | &nbsp;       | &nbsp;
----------- | ------------ | -------------------------
azonosito   | NUMBER(1)    | A jogosultság azonosítója
nev         | VARCHAR2(20) | A jogosultság elnevezése

### 5.2. Felhasználó

Felhasználó           | &nbsp;        | &nbsp;
--------------------- | ------------- | -----------------------------------------
email                 | VARCHAR2(64)  | A felhasználó egyedi e-mail címe
jelszo                | VARCHAR2(255) | A felhasználó jelszava
telszam               | VARCHAR2(18)  | A felhasználó telefonszáma
v_nev                 | VARCHAR2(30)  | A felhasználó vezetékneve
u_nev                 | VARCHAR2(30)  | A felhasználó utóneve
szul_datum            | DATE          | A felhasználó születési dátuma
orszag                | VARCHAR2(35)  | A felhasználó lakcíme (ország)
irsz                  | VARCHAR2(10)  | A felhasználó lakcíme (irsz)
varos                 | VARCHAR2(40)  | A felhasználó lakcíme (varos)
cim                   | VARCHAR2(40)  | A felhasználó lakcíme (cim)
jogosultsag_azonosito | NUMBER(1)     | A felhasználó jogosultsága
regisztracio_idopont  | DATE          | A felhasználó regisztrációjának időpontja

### 5.3. Napló

Napló     | &nbsp;       | &nbsp;
--------- | ------------ | ----------------------------------------------------
azonosito | NUMBER(6)    | A napló bejegyzés egyedi azonosítója
email     | VARCHAR2(64) | A napló bejegyzéshez tartozó felhasználó e-mail címe
belepes   | DATE         | A felhasználó belépési ideje
kilepes   | DATE         | A felhasználó kilépési ideje

### 5.4. Légitársaság

Légitársaság | &nbsp;       | &nbsp;
------------ | ------------ | ---------------------------------
kod          | CHAR(3)      | A légitársaság ICAO kódja
nev          | VARCHAR2(50) | A légitársaság teljes neve
rovidites    | VARCHAR2(20) | A légitársaság nevének rövidítése
orszag       | VARCHAR2(35) | A légitársaság székhelye

### 5.5. Repülő

Repülő           | &nbsp;       | &nbsp;
---------------- | ------------ | ---------------------------------------------------
azonosito        | NUMBER(6)    | A repülőgép egyedi azonosítója
repulo_azonosito | NUMBER(4)    | A repülőgép azonosítója a légitársaságon belül
legitarsasag_kod | CHAR(3)      | A légitársaság kódja, amelyhez a repülőgép tartozik
tipus            | VARCHAR2(20) | A repülőgép típusa
ferohely         | NUMBER(3)    | A repülőgép maximális utasszáma

### 5.6. Repülőtér

Repülőtér | &nbsp;       | &nbsp;
--------- | ------------ | ---------------------------------
kod       | CHAR(4)      | A repülőtér ICAO kódja
nev       | VARCHAR2(64) | A repülőtér neve
orszag    | VARCHAR2(35) | A repülőtérnek otthont adó ország
varos     | VARCHAR2(35) | A repülőtérnek otthont adó város

### 5.7. Járat

Járat            | &nbsp;    | &nbsp;
---------------- | --------- | ------------------------------------------------
jaratszam        | NUMBER(6) | A járat egyedi azonosítója
repulo_azonosito | NUMBER(4) | A járathoz tartozó repülő azonosítója
jegyar           | NUMBER(6) | Egyetlen jegy ára (Ft)
indulas          | DATE      | A járat indulásának időpontja
indulas_kod      | CHAR(4)   | A repülőtér kódja, amelyről a repülőgép felszáll
erkezes          | DATE      | A járat érkezésének időpontja
erkezes_kod      | CHAR(4)   | A repülőtér kódja, amelyre a repülőgép leszáll

### 5.8. Ülőhely állapot

Ülőhely állapot | &nbsp;       | &nbsp;
--------------- | ------------ | -------------------------------------
azonosito       | NUMBER(1)    | Az ülőhely állapot egyedi azonosítója
nev             | VARCHAR2(20) | Az ülőhely állapot megnevezése

### 5.9. Ülőhely

Ülőhely   | &nbsp;    | &nbsp;
--------- | --------- | -------------------------------------------
jaratszam | NUMBER(6) | A járat azonosítója, amelyen az ülőhely van
szek      | NUMBER(3) | Az ülőhely száma a járaton
allapot   | NUMBER(1) | Az ülőhely állapota

### 5.10. Kedvezmény típus

Kedvezmény típus | &nbsp;       | &nbsp;
---------------- | ------------ | ---------------------------
nev              | VARCHAR2(20) | A kedvezmény típusának neve
szorzo           | NUMBER(3, 2) | A kedvezmény szorzója

### 5.11. Kedvezmény

Kedvezmény | &nbsp;       | &nbsp;
---------- | ------------ | -----------------------------------------------
azonosito  | NUMBER(6)    | A kedvezmény egyedi azonosítója
jaratszam  | NUMBER(6)    | A járat azonosítója, amelyre a jegy(ek) szólnak
tipus      | VARCHAR2(20) | A kedvezmény típusa
mertek     | NUMBER(6, 1) | A kedvezmény mértéke
mettol     | DATE         | A kedvezmény kezdete
meddig     | DATE         | A kedvezmény vége

### 5.12. Vásárlás állapot

Vásárlás állapot | &nbsp;       | &nbsp;
---------------- | ------------ | --------------------------------------
azonosito        | NUMBER(1)    | A vásárlási állapot egyedi azonosítója
nev              | VARCHAR2(20) | A vásárlási állapot megnevezése

### 5.13. Vásárlás

Vásárlás  | &nbsp;       | &nbsp;
--------- | ------------ | -----------------------------------------------
azonosito | NUMBER(6)    | A vásárlás egyedi azonosítója
email     | VARCHAR2(64) | A jegye(ke)t vásárló felhasználó e-mail címe
jaratszam | NUMBER(6)    | A járat azonosítója, amelyre a jegy(ek) szólnak
darabszam | NUMBER(2)    | A vásárolt jegyek száma
idopont   | DATE         | A jegyvásárlás időpontja
allapot   | NUMBER(1)    | A vásárlás állapota

### 5.14. Jegy

Jegy               | &nbsp;       | &nbsp;
------------------ | ------------ | --------------------------------------
azonosito          | NUMBER(6)    | A jegy egyedi azonosítója
vasarlas_azonosito | NUMBER(6)    | A jegyhez tartozó vásárlás
v_nev              | VARCHAR2(30) | A jegy tulajdonosának vezetékneve
u_nev              | VARCHAR2(30) | A jegy tulajdonosának utóneve
szul_datum         | DATE         | A jegy tulajdonosának születési dátuma

### 5.15. Csomag típus

Csomag típus     | &nbsp;       | &nbsp;
---------------- | ------------ | --------------------------------------------------------------
azonosito        | NUMBER(3)    | A csomag típus egyedi azonosítója
legitarsasag_kod | CHAR(3)      | A légitársaság kódja, amelyhez a csomag típus tartozik
rovidites        | VARCHAR2(5)  | A csomag típus rövidítése
leiras           | VARCHAR2(25) | A csomag típus leírása
magassag         | NUMBER(4, 1) | A csomag típus által meghatározott csomag max. magassága (cm)
szelesseg        | NUMBER(4, 1) | A csomag típus által meghatározott csomag max. szélessége (cm)
melyseg          | NUMBER(4, 1) | A csomag típus által meghatározott csomag max. mélysége (cm)
ar               | NUMBER(5)    | A csomag típus által meghatározott csomag ára (Ft)

### 5.16. Csomag

Csomag                 | &nbsp;    | &nbsp;
---------------------- | --------- | ----------------------------------------------
azonosito              | NUMBER(6) | A csomag egyedi azonosítója
jegy_azonosito         | NUMBER(6) | A jegy azonosítója, amelyhez a csomag tartozik
csomag_tipus_azonosito | NUMBER(3) | A csomag típusának azonosítója

### 5.17. Keresés

Keresés        | &nbsp;       | &nbsp;
-------------- | ------------ | --------------------------------------------------
azonosito      | NUMBER(6)    | A keresés egyedi azonosítója
email          | VARCHAR2(64) | Az keresést indító felhasználó e-mail címe
idopont        | DATE         | A keresés pontos időpontja
indulas_orszag | VARCHAR2(35) | A keresett ország, ahonnan a járat indul
indulas_varos  | VARCHAR2(35) | A keresett város, ahonnan a járat indul
erkezes_orszag | VARCHAR2(35) | A keresett ország, ahova a járat leszáll
erkezes_varos  | VARCHAR2(35) | A keresett város, ahova a járat leszáll
mettol         | DATE         | A járat indulási idejének kezdete (napra pontosan)
meddig         | DATE         | A járat indulási idejének vége (napra pontosan)
artol          | NUMBER(6)    | A járat jegyárának minimuma
arig           | NUMBER(6)    | A járat jegyárának maximuma
idopont        | DATE         | A keresés időpontja

## 6. Szerep-funkció mátrix
[Szerep-funkció mátrix](./doc/role_function_matrix.xlsx)
![role_function_pic](./doc/role_function.png)

## 7. Képernyőtervek
...

## 8. Menütervek
...
