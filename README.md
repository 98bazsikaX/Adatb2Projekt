# Repülőjegy foglalás, utazási iroda - Projektterv

## 1. Összefoglaló
Projektünk egy repülőjegy foglaló webalkalmazás tervezése és implementációja. Célunk, hogy a látogatók, felhasználók kényelmesen tudjanak repülőjegyet foglalni különböző légitársaságoktól, a világ minél több pontjára.

## 2. Projekt bemutatása

### 2.1. Specifikáció
A látogatók böngészni, keresni tudnak járatokat igényeiknek megfelelően, jegyvásárláshoz azonban regisztrálni kell, majd bejelentkezni. A felhasználó ki tudja választani, mely járatra szeretne jegye(ke)t venni, megadja az adatait, majd kifizeti a jegyeket. Ezt követően, amennyiben minden rendben ment, a felhasználó e-mailben kapja meg a jegye(ke)t. Amennyiben az adott járat mégsem megfelelő valakinek, úgy lehetősege van visszamondani, esetleg járatot cserélni.

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
[1. szintű fizikai adatfolyam diagram](./doc/dia/afd/fizikai/lvl1.ccd)

##### 3.1.1.2. 2. szint
[2. szintű fizikai adatfolyam diagram](./doc/dia/afd/fizikai/lvl2.ccd)

#### 3.1.2. Logikai AFD

##### 3.1.2.1. 1. szint
[1. szintű logikai adatfolyam diagram](./doc/dia/afd/logikai/lvl1.ccd)

##### 3.1.2.2. 2. szint
[2. szintű logikai adatfolyam diagram](./doc/dia/afd/logikai/lvl2.ccd)

### 3.2. Egyedmodell
[Egyedmodell]()

### 3.3. Egyed-kapcsolat diagram
[Egyed-kapcsolat diagram](./doc/dia/entity_relationship.ccd)

## 4. EK diagram leképezése
Felhasználó(<ins>e-mail</ins>, jelszó, telefonszám, vezetéknév, utónév)
Légitársaság(<ins>kód</ins>, név, ország)
Repülő(<ins>azonosító</ins>, <ins>*Légitársaság.kód*</ins>, típus, férőhely)
Repülőtér(<ins>kód</ins>, név, ország, város)
Járat(<ins>járatszám</ins>, *Repülő.azonosító*, *Légitársaság.kód*, jegyár, indulás_idő, *indulás_repülőtér*, érkezés_idő, *érkezés_repülőtér*)
Vásárlás(<ins>*Felhasználó.e-mail*</ins>, <ins>mikor</ins>, *Járat.járatszám*, darabszám)
Keresés(<ins>*Felhasználó.e-mail*</ins>, <ins>mikor</ins>, *indulás_ország*, *indulás_város*, *érkezés_ország*, *érkezés_város*, mettől, meddig)

### 4.1. 1. normálforma
A relációséma 1NF-ben van: többértékű attribútumok nem voltak, az összetett attribútumok pedig helyettesítve lettek részattribútumaikkal.

### 4.2. 2. normálforma
A relációséma 2NF-ben van: 4 sémában egyetlen attribútumból áll a kulcs, a maradék 3 sémában pedig minden másodlagos attribútum teljesen függ a kulcsoktól.

### 4.3. 3. normálforma
A relációséma 3NF-ben van: a sémák mindegyikében a másodlagos attribútumok közvetlenül függnek a kulcsoktól.

## 5. Relációsémák
[EK diagramból képzett relációsémák](./doc/relation_schema.xlsx)

### 5.1. Felhasználó

Felhasználó | &nbsp;       | &nbsp;
----------- | ------------ | --------------------------
email       | VARCHAR(64)  | A felhasználó e-mail címe
jelszo      | VARCHAR(255) | A felhasználó jelszava
telszam     | VARCHAR(18)  | A felhasználó telefonszáma
v_nev       | VARCHAR(30)  | A felhasználó vezetékneve
u_nev       | VARCHAR(30)  | A felhasználó utóneve

### 5.2. Légitársaság

Légitársaság | &nbsp;      | &nbsp;
------------ | ----------- | --------------------------
kod          | CHAR(3)     | A légitársaság ICAO kódja
nev          | VARCHAR(50) | A légitársaság teljes neve
orszag       | VARCHAR(35) | A légitársaság székhelye

### 5.3. Repülő

Repülő           | &nbsp;      | &nbsp;
---------------- | ----------- | ---------------------------------------------------
azonosito        | NUMBER(4)   | A repülőgép azonosítója a légitársaságon belül
legitarsasag_kod | CHAR(3)     | A légitársaság kódja, amelyhez a repülőgép tartozik
tipus            | VARCHAR(20) | A repülőgép típusa
ferohely         | NUMBER(3)   | A repülőgép maximális utasszáma

### 5.4. Repülőtér

Repülőtér | &nbsp;      | &nbsp;
--------- | ----------- | ---------------------------------
kod       | CHAR(4)     | A repülőtér ICAO kódja
nev       | VARCHAR(64) | A repülőtér neve
orszag    | VARCHAR(35) | A repülőtérnek otthont adó ország
varos     | VARCHAR(35) | A repülőtérnek otthont adó város

### 5.5. Járat

Járat            | &nbsp;    | &nbsp;
---------------- | --------- | ------------------------------------------------
jaratszam        | NUMBER(6) | A járat egyedi azonosítója
repulo_azonosito | NUMBER(4) | A járathoz tartozó repülő azonosítója
legitarsasag_kod | CHAR(3)   | A járathoz tartozó repülő légitársaságának kódja
jegyar           | NUMBER(6) | Egyetlen jegy ára Ft-ban
indulas          | DATE      | A járat indulásának pontos időpontja
indulas_kod      | CHAR(4)   | A repülőtér kódja, amelyről a repülőgép felszáll
erkezes          | DATE      | A járat érkezésének pontos időpontja
erkezes_kod      | CHAR(4)   | A repülőtér kódja, amelyre a repülőgép leszáll

### 5.6. Vásárlás

Vásárlás    | &nbsp;      | &nbsp;
----------- | ----------- | -----------------------------------------------
email       | VARCHAR(64) | A jegye(ke)t vásárló felhasználó e-mail címe
idopont     | DATE        | A jegyvásárlás pontos időpontja
jaratszam   | NUMBER(6)   | A járat azonosítója, amelyre a jegy(ek) szólnak
darabszam   | NUMBER(2)   | A vásárolt jegyek száma

### 5.7. Keresés

Keresés        | &nbsp;      | &nbsp;
-------------- | ----------- | --------------------------------------------------
email          | VARCHAR(64) | Az keresést indító felhasználó e-mail címe
idopont        | DATE        | A keresés pontos időpontja
indulas_orszag | VARCHAR(35) | A keresett ország, ahonnan a járat indul
indulas_varos  | VARCHAR(35) | A keresett város, ahonnan a járat indul
erkezes_orszag | VARCHAR(35) | A keresett ország, ahova a járat leszáll
erkezes_varos  | VARCHAR(35) | A keresett város, ahova a járat leszáll
mettol         | DATE        | A járat indulási idejének kezdete (napra pontosan)
meddig         | DATE        | A járat indulási idejének vége (napra pontosan)

## 6. Szerep-funkció mátrix
[Szerep-funkció mátrix](./doc/role_function_matrix.xlsx)

## 7. Képernyőtervek
...

## 8. Menütervek
...