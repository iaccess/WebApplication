ALTER SEQUENCE student_identification_number RESTART;

ALTER TABLE IF EXISTS students
    ALTER COLUMN student_id SET DEFAULT CONCAT('2011-', lpad(nextval('student_identification_number')::text, 5,'0'));

INSERT INTO students (first_name, middle_name, last_name) VALUES
    ('Noralyn','B.','Caindog'),
    ('Leah','C.','Lacsi'),
    ('Mary ann','C.','Alico'),
    ('Rehana','Z.','Ali '),
    ('Padam','p.','Bhusal'),
    ('John  Keith','P.','Ritcha'),
    ('Rodney','B.','Bordado'),
    ('Saad','S.','Dita'),
    ('Joseph Leonen','H.','Rejas');
	
