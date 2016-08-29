DROP extension pgcrypto;
CREATE EXTENSION pgcrypto;

CREATE TABLE IF NOT EXISTS student (
  id integer NOT NULL DEFAULT nextval('students_id_seq'::regclass),
  guid uuid NOT NULL DEFAULT gen_random_uuid(),
  student_id character varying(10) NOT NULL DEFAULT concat('2009-', lpad((nextval('student_identification_number'::regclass))::text, 5, '0'::text)),
  first_name character varying(255) NOT NULL DEFAULT ''::character varying,
  middle_name character varying(255) NOT NULL DEFAULT ''::character varying,
  last_name character varying(255) NOT NULL DEFAULT ''::character varying,
  gender sex NOT NULL DEFAULT 'male'::sex,
  birthdate date,
  civil_status_id smallint NOT NULL DEFAULT 1,
  is_active boolean NOT NULL DEFAULT false,
  created_at timestamp without time zone NOT NULL DEFAULT now(),
  updated_at timestamp without time zone,
  deleted_at timestamp without time zone,
  CONSTRAINT students_pkey PRIMARY KEY (id),
  CONSTRAINT students_first_name_middle_name_last_name_key UNIQUE (first_name, middle_name, last_name),
  CONSTRAINT students_guid_key UNIQUE (guid),
  CONSTRAINT students_student_id_key UNIQUE (student_id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.students
  OWNER TO gabby;