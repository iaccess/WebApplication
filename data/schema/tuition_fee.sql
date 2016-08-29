DROP TABLE IF EXISTS tuition_fee;
CREATE TABLE IF NOT EXISTS tuition_fee (
    code uuid NOT NULL PRIMARY KEY DEFAULT gen_random_uuid(),
    training_program_code VARCHAR(50) NOT NULL DEFAULT '',
    fee INTEGER NOT NULL DEFAULT 0,
    description TEXT NOT NULL DEFAULT '',
    created_at DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (training_program_code, fee, created_at)
);

INSERT INTO tuition_fee (training_program_code, fee, description) VALUES
    ('TRSEMS308', 8500, 'Tuition fee for SY 2016'),
    ('SOCBKP308', 8500, 'Tuition fee for SY 2016'),
    ('TRSHSK213', 9500, 'Tuition fee for SY 2016'),
    ('ELCEPA213', 10500, 'Tuition fee for SY 2016'),
    ('ELCCSS213', 10500, 'Tuition fee for SY 2016'),
    ('SOCSES105', 7500, 'Tuition fee for SY 2016'),
    ('SOCSES207', 7500, 'Tuition fee for SY 2016'),
    ('ALTDRV205', 7500, 'Tuition fee for SY 2016'),
    ('MEEEAW107', 15800, 'Tuition fee for SY 2016'),
    ('MEEEAW207', 15800, 'Tuition fee for SY 2016'),
    ('CONEIM208', 12500, 'Tuition fee for SY 2016'),    
    ('ALTMSE205', 9500, 'Tuition fee for SY 2016'),    
    ('TRSBPP209', 8000, 'Tuition fee for SY 2016'),
    ('TRSFBS213', 8500, 'Tuition fee for SY 2016');