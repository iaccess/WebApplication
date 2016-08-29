ALTER SEQUENCE student_identification_number RESTART;

ALTER TABLE IF EXISTS students
    ALTER COLUMN student_id SET DEFAULT CONCAT('2013-', lpad(nextval('student_identification_number')::text, 5,'0'));

INSERT INTO students (first_name, middle_name, last_name) VALUES
    ('Leonard','L.','Alcantara'),
    ('Jogen','S.','Alicos'),
    ('Shelly Mae','M.','Baguio'),
    ('Rudel','P.','Calisagan'),
    ('Marilou','C.','Caliso'),
    ('Celstino','C.','Campugan'),
    ('Georabie','B.','Lacida'),
    ('Mark Dave','B.','Lim'),
    ('Darwin','I.','Mahinay'),
    ('Jordan','S.','Manseguiao'),
    ('Roniel','T.','Panorel'),
    ('Lou Jiam','B.','Reyes'),
    ('Dhannica Joy','A.','Romarez'),
    ('Gerundy','L.','Sechong'),
    ('Regino','N.','Serojales');
	
