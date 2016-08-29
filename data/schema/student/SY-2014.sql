ALTER SEQUENCE student_identification_number RESTART;

ALTER TABLE IF EXISTS students
    ALTER COLUMN student_id SET DEFAULT CONCAT('2014-', lpad(nextval('student_identification_number')::text, 5,'0'));

INSERT INTO students (first_name, middle_name, last_name) VALUES
    ('Mariano','G.','Paquiz'),
    ('Catherine Gale','V.','Balila'),
    ('Melanie April','F.','Bahian'),
    ('Chris-Ler','N.','Cabtalan'),
    ('John Dave','E.','Cabtalan'),
    ('Leah Mae','B.','Candidado'),
    ('Vlademir','V.','Cortez'),
    ('Kim','N.','Dividina'),
    ('Roland','A.','Espejo'),
    ('Aljon','E.','Franco'),
    ('Chosen','E.','Galota'),
    ('Crizelle Jay','M.','Garban'),
    ('Ivy Joy','D.','Jumalon'),
    ('Neil Bryan','C.','Magsayo'),
    ('Rose Jane','E.','Mangubat'),
    ('Marian Lou','C.','Ponce'),
    ('Jaymart','V.','Tangente'),
    ('Narciso, Jr.','M.','Tual'),
    ('Benjamin, Jr.','G.','Cadotdot'),
    ('John Rey','C.','Cañete'),
    ('Ben Mark','T.','Cuevas'),
    ('Rey Joseph','T.','Feril'),
    ('Mohaimen','F.','Macmod'),
    ('Ruben','A.','Supat'),
    ('Reynaldo','M.','Amba'),
    ('Warrien','V.','Baño'),
    ('Aramiel','R.','Bulusan'),
    ('Christer','P.','Ermac'),
    ('Nyl John','A.','Depio'),
    ('Sailanie','M.','Marcos'),
    ('John Earl','N.','Montebon'),
    ('Kenneth','T.','Nabung'),
    ('Julito, Jr.','J.','Socayre'),
    ('Diana Jane','C.','Torres'),
    ('Francis','M.','Cocos'),
    ('Dharell Bryce','S.','Nuenay'),
    ('Amor Jun','K.','Tapi-on'),
    ('Regine','V.','Cantos'),
    ('Nordilyn','A.','Claros'),
    ('Hienz','C.','Duhaylungsod'),
    ('Joan','R.','Echavez'),
    ('Queenie','D.','Kiunisala'),
    ('Jonh Francis Anthony','S.','Marzon'),
    ('Nicole','E.','Mendez'),
    ('Jenny Dhev','C.','Nopal'),
    ('Richer','M.','Olarde'),
    ('Jessel','E.','Sandoval'),
    ('Pettirose','L.','Talingting'),
    ('Jane','Y.','Viajante'),
    ('Jessevel','Q.','Cabatuan'),
    ('Myfel','T.','Cabatuan'),
    ('Jena Mae','N.','Duhaylongsod'),
    ('Shella Marielhou','E.','Yurong'),
    ('Elmer','C.','Ponce'),
    ('Alexander','F.','Cabaro'),
    ('Euxine Irr','G.','Alia'),
    ('Elona','P.','Edmilao'),
    ('Raquel','C.','Pendang'),
    ('Cheen Kie','N.','Baguhin'),
    ('Ronie','B.','Bentilacion'),
    ('Vincent James','B.','Bitangcor'),
    ('Wenie Boy','A.','Burgos'),
    ('Kem','G.','Caroro'),
    ('Ruel Julius','V.','Condrado'),
    ('Christopher','D.','Dablo'),
    ('Marvin','P.','Florentino'),
    ('Joart','D.','Gonzaga'),
    ('Jorick','G.','Macabuhay'),
    ('Adonis','T.','Magtagad'),
    ('Julie Boy','E.','Mahinay'),
    ('Junjie','A.','Miñoza'),
    ('Jemnel','L.','Pioquinto'),
    ('Jobren','M.','Salvador'),
    ('Juharie','B.','Sarip'),
    ('Matthew Kirk','B.','Tamayo'),
    ('Geric','F.','Viloria'),
    ('Dayanara','Y.','Adolfo'),
    ('Rachelle','A.','Fusilero'),
    ('Nekki Lou','G.','Gravador'),
    ('Rhen Ann Mhay','L.','Illana'),
    ('Ericka','O.','Jimenez'),
    ('Dimple','G.','Labasano'),
    ('Alleah Nasminah','S.','Macabato'),
    ('Lani','M.','Urbano'),
    ('Sabino, Jr.','C.','Tagudin'),
    ('Lena','S.','Lluisma'),
    ('Aruen','L.','Banlat'),
    ('Ana','B.','Sagun'),
    ('Aprilyn','M.','Tomis'),
    ('Joan','V.','Maghanoy'),
    ('Monsanto','C.','Charito'),
    ('Jahara','B.','Dibaratun'),
    ('Jojie','B.','Ong'),
    ('Aizha','E.','Pilapil'),
    ('Edfran Jed','A.','Serino'),
    ('Nieves','P.','Dizon'),
    ('Irish Jade','B.','Egoc'),
    ('Froilan','D.','Escalante'),
    ('Mary Jane','N.','Lagbas'),
    ('MayJane','B.','Laraño'),
    ('Victoria','E.','Mirador'),
    ('Jacqueline','B.','Obed'),
    ('Mary Anne','L.','Obed'),
    ('Metelyn','A.','Dumanjug'),
    ('Arjie','S.','Gaid'),
    ('Hazel May','B.','Javelona'),
    ('Genelyn','D.','Lahoylahoy'),
    ('Maria Teresa','R.','Pepito'),
    ('Emmie Kate','A.','Resus'),
    ('Reymar','R.','Sarsoza'),
    ('Ana Marie','M.','Tabudlong'),
    ('Analee','M','Vequizo');
	
