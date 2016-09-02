DROP TABLE IF EXISTS class_schedule;

CREATE TABLE IF NOT EXISTS class_schedule (
    id uuid NOT NULL PRIMARY KEY DEFAULT gen_random_uuid(),
    training_program_code VARCHAR(50) NOT NULL DEFAULT '',
    section_code VARCHAR(10) NOT NULL DEFAULT 'TBA',
    started_at date NOT NULL DEFAULT CURRENT_DATE,
    ended_at date,
    created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (training_program_code, section_code, started_at, ended_at)
);

INSERT INTO class_schedule (training_program_code, section_code) VALUES
   ('ELCCSS213', 'M2F52830'),
   ('ELCCSS213', 'SUN825'),
   ('ELCCSS213', 'SAT825'),
   ('ELCCSS213', 'M2F825'),
   ('CONEIM208', 'M2F52830'),
   ('CONEIM208', 'SAT825'),
   ('MEEEAW207', 'M2F825'),
   ('MEEEAW207', 'M2F52830'),
   ('ALTMSE205', 'M2F125');