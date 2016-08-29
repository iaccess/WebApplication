DROP TABLE IF EXISTS student;

DROP TYPE sex;
CREATE TYPE sex AS ENUM ('male', 'female');

DROP SEQUENCE student_identification_number;
CREATE SEQUENCE student_identification_number MAXVALUE 99999 START 1;

CREATE TABLE IF NOT EXISTS student (
    id SERIAL NOT NULL PRIMARY KEY,
    guid uuid UNIQUE NOT NULL DEFAULT gen_random_uuid(),
    student_id VARCHAR(10) UNIQUE NOT NULL DEFAULT concat('2009-', lpad((nextval('student_identification_number'::regclass))::text, 5, '0'::text)),
    first_name VARCHAR(255) NOT NULL DEFAULT '',
    middle_name VARCHAR(255) NOT NULL DEFAULT '',
    last_name VARCHAR(255) NOT NULL DEFAULT '',
    gender sex NOT NULL DEFAULT 'male',
    birthdate date,
    civil_status_id smallint NOT NULL DEFAULT 1,
    is_active boolean NOT NULL DEFAULT false,
    created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp with time zone,
    deleted_at timestamp with time zone,
    UNIQUE (first_name, middle_name, last_name)
);