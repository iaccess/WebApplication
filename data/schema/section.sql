DROP TABLE IF EXISTS section;

CREATE TABLE IF NOT EXISTS section (    
    code VARCHAR(10) NOT NULL PRIMARY KEY,
    day VARCHAR(20) NOT NULL,
    starts_at time without time zone NOT NULL,
    ends_at time without time zone NOT NULL,
    UNIQUE (day, starts_at, ends_at)
);

INSERT INTO section (code, day, starts_at, ends_at) VALUES
    ('TBA', 'TBA', '0:00 AM', '0:00 AM'),
    ('M2F825', 'M-F', '8:00 AM', '5:00 PM'),
    ('M2F8212', 'M-F', '8:00 AM', '12:00 PM'),
    ('M2F125', 'M-F', '1:00 PM', '5:00 PM'),
    ('M2F52830', 'M-F', '5:00 PM', '8:30 PM'), 
    ('SAT825', 'SAT', '8:00 AM', '5:00 PM'),
    ('SAT8212', 'SAT', '8:00 AM', '12:00 PM'),
    ('SAT125', 'SAT', '1:00 PM', '5:00 PM'),
    ('SAT52830', 'SAT', '5:00 PM', '8:30 PM'), 
    ('SUN825', 'SUN', '8:00 AM', '5:00 PM'),
    ('SUN8212', 'SUN', '8:00 AM', '12:00 PM'),
    ('SUN125', 'SUN', '1:00 PM', '5:00 PM'),
    ('SUN52830', 'SUN', '5:00 PM', '8:30 PM');
