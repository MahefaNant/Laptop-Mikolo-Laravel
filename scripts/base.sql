--create database laptop;
-- \c laptop

create table magasinCentrale(/**/
    id_magasinCentrale serial primary key ,
    lieu varchar(20) unique ,
    mail varchar(50) unique ,
    code varchar(100)
);

create table utilisateur(/**/
    id_utilisateur serial primary key ,
    nom varchar(20),
    prenom varchar(20),
    mail varchar(50) unique ,
    code varchar(50)
);

create table pointDeVente(/**/
    id_pointdevente serial primary key ,
    adresse varchar(50)
);

create table affectation(/**/
    id_affectation serial primary key ,
    id_pointdevente integer not null ,
    id_utilisateur integer not null ,
    dateaffectation timestamp default now(),
    etat integer default 1
);

/*---------------LAPTOP-----------------*/

create table marque(
    id_marque serial primary key ,
    marque varchar(20)
);

create table modele (
    id_modele serial primary key ,
    id_marque integer not null ,
    modele varchar(30)
);

create table processeur(
    id_processeur serial primary key ,
    processeur varchar(30),
    description text
);

create table ram(
    id_ram serial primary key ,
    ram integer,
    description text
);

create table ecran(
    id_ecran serial primary key ,
    pouce integer,
    description text
);

create table dur(
    id_dur serial primary key ,
    dur integer,
    description text
);

create table laptop(
    id_laptop serial primary key,
    id_modele integer not null ,
    id_processeur integer not null,
    id_ram integer not null,
    id_ecran integer not null,
    id_dur integer not null,
    prix double precision default 5000
);

create table achat(
    id_achat serial primary key ,
    id_laptop integer not null ,
    quantiter int check ( quantiter>0 ),
    date_entree timestamp default now(),
    prixdachat double precision
);

create table transfert_to_pv(
    id_transfert_to_pv serial primary key ,
    id_laptop integer not null ,
    id_pointdevente integer not null,
    quantiter int check ( quantiter>0 ),
    datetransfert timestamp default now(),
    etat integer default 0
);

create table stockmagasin(
    id_stockmagasin serial primary key ,
    id_laptop integer not null,
    quantiter int check ( quantiter>0 ),
    date_entree timestamp default null,
    date_sortie timestamp default null,
    prixdachat double precision
);

create table stockpoindevente(
    id_stockpointdevente serial primary key ,
    id_laptop integer not null,
    quantiter int check ( quantiter>0 ),
    date_entree timestamp default null,
    date_sortie timestamp default null,
    id_pointdevente integer not null
);

create table receptionpv(
    id_receptionpv serial primary key ,
    id_laptop integer not null ,
    id_pointdevente integer not null,
    quantiter int check ( quantiter>0 ),
    datereception timestamp default now(),
    id_utilisateur integer null
);

create table perte(
    id_perte serial primary key ,
    id_laptop integer not null ,
    id_pointdevente integer not null,
    quantiter int check ( quantiter>0 ),
    datereception timestamp not null,
    id_utilisateur integer null
);

create table pertemag(
    id_pertemag serial primary key ,
    id_laptop integer not null ,
    id_pointdevente integer not null,
    quantiter int check ( quantiter>0 ),
    datereception timestamp not null,
    id_utilisateur integer null
);

create table renvoi(
    id_renvoi serial primary key ,
    id_laptop integer not null ,
    id_pointdevente integer not null,
    quantiter int check ( quantiter>0 ),
    daterenvoi timestamp default now(),
    etat integer default 0 ,
    id_utilisateur integer not null
);

create table receptionmag(
    id_receptionmag serial primary key ,
    id_laptop integer not null ,
    quantiter int check ( quantiter>0 ),
    id_pointdevente integer not null,
    datereception timestamp default now(),
    id_utilisateur integer not null
);

create table vente(
    id_vente serial primary key ,
    id_laptop integer not null ,
    quantiter int check ( quantiter>0 ),
    id_pointdevente integer not null,
    datevente timestamp default now(),
    id_utilisateur integer not null
);

create table commission(
    id_commission serial primary key ,
    total_min double precision,
    total_max double precision,
    commission double precision
);

/*--------------------------------------*/




------------------------ALTER---------------------------
-------------------------------------------------------

alter table affectation add foreign key (id_pointdevente) references pointDeVente(id_pointdevente);/**/
alter table affectation add foreign key (id_utilisateur) references utilisateur(id_utilisateur);/**/


alter table modele add foreign key (id_marque) references marque(id_marque);

alter table laptop add foreign key (id_modele) references modele(id_modele);
alter table laptop add foreign key (id_processeur) references processeur(id_processeur);
alter table laptop add foreign key (id_ram) references ram(id_ram);
alter table laptop add foreign key (id_ecran) references ecran(id_ecran);
alter table laptop add foreign key (id_dur) references dur(id_dur);

alter table achat add foreign key (id_laptop) references laptop(id_laptop);


alter table transfert_to_pv add foreign key (id_laptop) references laptop(id_laptop);
alter table transfert_to_pv add foreign key (id_pointdevente) references pointDeVente(id_pointdevente);

alter table receptionpv add foreign key (id_laptop) references laptop(id_laptop);
alter table receptionpv add foreign key (id_pointdevente) references pointDeVente(id_pointdevente);
alter table receptionpv add foreign key (id_utilisateur) references utilisateur(id_utilisateur);

alter table renvoi add foreign key (id_laptop) references laptop(id_laptop);
alter table renvoi add foreign key (id_pointdevente) references pointDeVente(id_pointdevente);
alter table renvoi add foreign key (id_utilisateur) references utilisateur(id_utilisateur);

alter table receptionmag add foreign key (id_laptop) references laptop(id_laptop);
alter table receptionmag add foreign key (id_pointdevente) references pointDeVente(id_pointdevente);
alter table receptionmag add foreign key (id_utilisateur) references utilisateur(id_utilisateur);


alter table vente add foreign key (id_laptop) references laptop(id_laptop);
alter table vente add foreign key (id_pointdevente) references pointDeVente(id_pointdevente);
alter table vente add foreign key (id_utilisateur) references utilisateur(id_utilisateur);

alter table perte add foreign key (id_laptop) references laptop(id_laptop);
alter table perte add foreign key (id_pointdevente) references pointDeVente(id_pointdevente);
alter table perte add foreign key (id_utilisateur) references utilisateur(id_utilisateur);

alter table pertemag add foreign key (id_laptop) references laptop(id_laptop);
alter table pertemag add foreign key (id_pointdevente) references pointDeVente(id_pointdevente);
alter table pertemag add foreign key (id_utilisateur) references utilisateur(id_utilisateur);

alter table stockmagasin add foreign key (id_laptop) references laptop(id_laptop);

alter table stockPoindeVente add foreign key (id_laptop) references laptop(id_laptop);
alter table stockPoindeVente add foreign key (id_pointdevente) references pointDeVente(id_pointdevente);

-------------------------------------------------------
-------------------------------------------------------

------------------------DATA---------------------------
-------------------------------------------------------

insert into magasinCentrale values (default, 'lieuM1','magasin1@gmail.com', md5('magasin1'));

insert into pointDeVente values (default,'lieu1', 'point1@gmail.com',md5('point1'));

insert into type_materiel values (default, 'processeur');
insert into type_materiel values (default, 'ram');
insert into type_materiel values (default, 'Ecran');
insert into type_materiel values (default, 'Disque dur');

insert into marque values (default, 'ASUS');
insert into marque values (default, 'ACER');
insert into marque values (default, 'HP');
insert into marque values (default, 'MAC BOOK');
insert into marque values (default, 'MSI');

insert into modele values (default, 1, 'ZenBook UX430UA');
insert into modele values (default, 1, 'ROG Strix Scar III');
insert into modele values (default, 1, 'VivoBook S15');
insert into modele values (default, 2, 'Aspire E15');
insert into modele values (default, 2, 'Swift 3');
insert into modele values (default, 2, 'Nitro 5');

insert into utilisateur values (default,'user1','xx','user1@gmail.com',md5('user1'));
insert into utilisateur values (default,'user2','xx','user2@gmail.com',md5('user2'));

insert into commission values (default, 0,2000000,3);
insert into commission values (default, 2000001,5000000,8);
insert into commission values (default, 5000001,300000000,15);

-------------------------------------------------------
-------------------------------------------------------

delete from vente;
delete from stockPoindeVente;
delete from receptionpv;
delete from transfert_to_pv;
delete from stockmagasin;
delete from perte;
delete from achat;
delete from pertemag;
delete from receptionmag;
delete from receptionpv;
delete from renvoi;


DROP VIEW IF EXISTS v_modele CASCADE;
DROP VIEW IF EXISTS v_pertelap CASCADE;
DROP VIEW IF EXISTS v_ventelap CASCADE;
DROP VIEW IF EXISTS v_affectation CASCADE;
DROP VIEW IF EXISTS v_achat CASCADE;
DROP VIEW IF EXISTS v_stock CASCADE;
DROP VIEW IF EXISTS v_lapstock CASCADE;
DROP VIEW IF EXISTS v_venteparmoisparans CASCADE;
DROP VIEW IF EXISTS v_perteparmoisparans CASCADE;
DROP VIEW IF EXISTS v_global_venteparmoisparans CASCADE;
DROP VIEW IF EXISTS v_global_perteparmoisparans CASCADE;
DROP VIEW IF EXISTS v_beneficeparmoisparans CASCADE;
DROP VIEW IF EXISTS v_laptop CASCADE;
DROP VIEW IF EXISTS v_stockpv CASCADE;
DROP VIEW IF EXISTS v_lapstockpv CASCADE;
DROP VIEW IF EXISTS v_stockmag CASCADE;
DROP VIEW IF EXISTS v_lapstockmag CASCADE;
DROP VIEW IF EXISTS v_laptpv CASCADE;
DROP VIEW IF EXISTS v_stockpvmanquant CASCADE;
DROP VIEW IF EXISTS v_lapstockpvmanquant CASCADE;



create or replace view v_modele as SELECT mod.*, marq.marque
from modele mod
join marque marq on mod.id_marque = marq.id_marque;

create or replace view v_laptop as SELECT laptop.id_laptop,
        v_mod.marque, v_mod.modele, proc.processeur, proc.description as proc_desc,
        dur.dur, dur.description as dur_desc,
        ecran.pouce, ecran.description as ecran_desc,
        ram.ram, ram.description as ram_desc,
        laptop.prix
        from laptop
        join v_modele v_mod on laptop.id_modele = v_mod.id_modele
        join processeur proc on laptop.id_processeur = proc.id_processeur
        join dur on laptop.id_dur = dur.id_dur
        join ecran  on laptop.id_ecran = ecran.id_ecran
        join ram on laptop.id_ram = ram.id_ram;

create or replace view v_affectation as SELECT af.*, us.mail,us.code, p.adresse
from affectation as af
join utilisateur as us on af.id_utilisateur = us.id_utilisateur
join pointDeVente as p on af.id_pointdevente = p.id_pointdevente;

create or replace view v_achat as SELECT lap.*, a.id_achat, a.quantiter,a.date_entree,a.prixdachat
from achat as a
join v_laptop as lap on a.id_laptop = lap.id_laptop;

create or replace view v_stock as
SELECT a.id_laptop, (SUM(a.quantiter) - COALESCE(t.stock_restant, 0)) AS stock_restant
FROM achat a
         LEFT JOIN (
    SELECT id_laptop, SUM(quantiter) AS stock_restant
    FROM transfert_to_pv
    GROUP BY id_laptop
) t ON a.id_laptop = t.id_laptop
GROUP BY a.id_laptop, t.stock_restant;


create or replace view v_lapstock as select v_lap.*, st.stock_restant
from v_stock as st join v_laptop as v_lap  on st.id_laptop = v_lap.id_laptop;

create or replace view v_laptpv as select v_laptop.*, t.id_transfert_to_pv,t.quantiter,t.datetransfert,t.etat,t.id_pointdevente
from transfert_to_pv as t
join v_laptop on t.id_laptop = v_laptop.id_laptop;

create or replace view v_laprenvoi as select v_laptop.*, t.id_renvoi,t.quantiter,t.daterenvoi,t.etat,t.id_pointdevente, t.id_utilisateur
from renvoi as t
join v_laptop on t.id_laptop = v_laptop.id_laptop;

create  or replace view v_stockpvmanquant as
select t.id_laptop, (SUM(t.quantiter) - COALESCE(r.manquant,0)) as manquant
from transfert_to_pv as t
         LEFT JOIN (
    select  id_laptop, SUM(quantiter) as manquant
    from receptionpv
    group by  id_laptop
) as r on t.id_laptop = r.id_laptop
GROUP BY  t.id_laptop, r.manquant;

create or replace view v_lapstockpvmanquant as
select lap.*, st.manquant
from v_stockpvmanquant as st
join v_laptop lap on st.id_laptop=lap.id_laptop;

/*---------------------------------*/


create or replace view v_stockmag as
SELECT id_laptop,
       SUM(CASE WHEN date_entree IS NOT NULL THEN quantiter ELSE 0 END) -
       SUM(CASE WHEN date_sortie IS NOT NULL THEN quantiter ELSE 0 END) AS stock_actuel
FROM stockmagasin
GROUP BY id_laptop;

create or replace view v_lapstockmag as
SELECT v_lap.*, stock.stock_actuel as stock_actuel
from v_stockmag as stock join v_laptop as v_lap  on stock.id_laptop = v_lap.id_laptop;

-- create or replace view v_stockpv as
SELECT id_laptop,
       SUM(CASE WHEN date_entree IS NOT NULL THEN quantiter ELSE 0 END) -
       SUM(CASE WHEN date_sortie IS NOT NULL THEN quantiter ELSE 0 END) AS stock_actuel
FROM stockPoindeVente
WHERE id_pointdevente = ?
GROUP BY id_laptop;

-- create or replace view v_lapstockpv as
SELECT v_lap.*, stock.stock_actuel as stock_actuel
from v_stockpv as stock join v_laptop as v_lap  on stock.id_laptop = v_lap.id_laptop;

SELECT st.id_laptop,
       SUM(CASE WHEN st.date_entree IS NOT NULL THEN st.quantiter ELSE 0 END) -
       SUM(CASE WHEN st.date_sortie IS NOT NULL THEN st.quantiter ELSE 0 END) AS stock_actuel,
       v_lap.marque
FROM stockPoindeVente AS st
         JOIN v_laptop AS v_lap ON st.id_laptop = v_lap.id_laptop
WHERE st.id_pointdevente = 1
GROUP BY st.id_laptop, v_lap.marque;

create or replace view v_ventelap as
select v.id_vente, lap.* , v.quantiter, v.id_pointdevente, v.datevente, p.adresse, v.id_utilisateur
from vente as v
join v_laptop as lap on v.id_laptop = lap.id_laptop
join pointDeVente as p on v.id_pointdevente = p.id_pointdevente;

create or replace view v_pertelap as
select p.* , lap.prix from perte as p
join v_laptop as lap on p.id_laptop = lap.id_laptop;

select extract(month from datevente) as month, sum(quantiter) as total from vente where extract(year from datevente) ='2023' group by month;
select id_laptop, id_pointdevente , sum(quantiter),extract(month from datereception) as month from receptionpv group by id_pointdevente,id_laptop, extract(month from datereception);

select id_pointdevente , sum(quantiter),extract(month from datevente) as month from vente group by id_pointdevente, extract(month from datevente);

create or replace view v_venteparmoisparans as
SELECT EXTRACT(month FROM datevente) AS month,
       id_pointdevente,
       SUM(quantiter) AS total_quantiter,
       SUM(quantiter * prix) AS total_value,
        EXTRACT(year from datevente) as year
FROM v_ventelap
GROUP BY EXTRACT(month FROM datevente), id_pointdevente, year;

create or replace view v_perteparmoisparans as
SELECT EXTRACT(month FROM datereception) AS month,
       id_pointdevente,
       SUM(quantiter) AS total_quantiter,
       SUM(quantiter * prix) AS total_value,
        EXTRACT(year from datereception) as year
FROM v_pertelap
GROUP BY EXTRACT(month FROM datereception), id_pointdevente,year;

select (v.total_quantiter - p.total_quantiter) tot from v_venteparmoisparans as v
left join v_perteparmoisparans as p on v.month = p.month ;

create  or replace view v_global_venteparmoisparans as
SELECT month, SUM(total_quantiter) AS total_quantiter, SUM(total_value) AS total_value, year
FROM v_venteparmoisparans
GROUP BY month, year;

create  or replace view v_global_perteparmoisparans as
SELECT month, SUM(total_quantiter) AS total_quantiter, SUM(total_value) AS total_value, year
FROM v_perteparmoisparans
GROUP BY month, year;

create or replace view v_beneficeparmoisparans as
SELECT vp.month, vp.year,
       vp.total_quantiter - COALESCE(gp.total_quantiter, 0) AS diff_total_quantiter,
       vp.total_value - COALESCE(gp.total_value, 0) AS diff_total_value
FROM v_global_venteparmoisparans vp
         LEFT JOIN v_global_perteparmoisparans gp ON vp.month = gp.month AND vp.year = gp.year
GROUP BY vp.month, vp.year, vp.total_quantiter, vp.total_value, gp.total_quantiter, gp.total_value;







