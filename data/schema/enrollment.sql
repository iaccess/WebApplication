DROP TYPE enrollment_status;
DROP TABLE tvet_program_enrollment;
DROP extension pgcrypto;
CREATE EXTENSION pgcrypto;

CREATE TYPE enrollment_status AS ENUM ('pending', 'enrolled', 'withdrawn', 'dropped');

-- TO DO: 
-- 1. Expose DAY, MONTH, YEAR information
-- 2. scholarship information
-- 3. processing staff
-- 4. enrollment status
CREATE TABLE tvet_program_enrollment
(
    id SERIAL NOT NULL PRIMARY KEY,
    class_code uuid NOT NULL DEFAULT gen_random_uuid(),
    student_id VARCHAR(10) NOT NULL DEFAULT 'YYYY-00000',
    tuition_code uuid NOT NULL DEFAULT gen_random_uuid(),
    scholarship_id INTEGER NOT NULL DEFAULT 0,
    status enrollment_status NOT NULL DEFAULT 'pending',
    date_enrolled date NOT NULL DEFAULT current_date,
    UNIQUE (student_id, class_code)
);