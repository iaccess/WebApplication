DROP TABLE IF EXISTS training_program;

CREATE TABLE IF NOT EXISTS training_program (
    id SERIAL NOT NULL PRIMARY KEY,
    code VARCHAR(50) UNIQUE NOT NULL DEFAULT '',
    title VARCHAR(255) NOT NULL DEFAULT '',
    level INTEGER NOT NULL DEFAULT 0,
    slug VARCHAR(255) NOT NULL DEFAULT '',
    description TEXT NOT NULL DEFAULT '',
    status VARCHAR(10) NOT NULL DEFAULT 'NTR',
    hours INTEGER NOT NULL DEFAULT 0,
    sector_code VARCHAR(5) NOT NULL DEFAULT '',
    UNIQUE (code, title, sector_code),
    FOREIGN KEY (sector_code) REFERENCES sector (code) ON DELETE RESTRICT ON UPDATE CASCADE
);

INSERT INTO training_program (sector_code, code, title, slug, level, hours) VALUES
    ('ELC', 'ELCEPA213', 'Electronics Products Assembly and Servicing NC II', 'electronics-products-assembly-and-servicing-nc-2', 2, 260),
    ('ELC', 'ELCCSS213', 'Computer Systems Servicing NC II', 'computer-systems-servicing-nc-2', 2, 280),
    ('SOC', 'SOCBKP308', 'Bookkeeping NC III', 'bookkeeping-nc-3', 3, 292),
    ('SOC', 'SOCSES105', 'Security Services NC I', 'security-services-nc-1', 1, 170),
    ('SOC', 'SOCSES207', 'Security Services NC II', 'security-services-nc-2', 2, 223),
    ('TRS', 'TRSEMS308', 'Events Management Services NC III', 'events-management-services-nc-3', 3, 108),
    ('TRS', 'TRSHSK213', 'Housekeeping NC II', 'housekeeping-nc-2', 2, 436),
    ('TRS', 'TRSBPP209', 'Bread and Pastry Production NC II', 'bread-and-pastry-production-nc-2', 2, 116),
    ('TRS', 'TRSFBS213', 'Food and Beverage Services NC II', 'food-and-beverage-services-nc-2', 2, 366),
    ('ALT', 'ALTDRV205', 'Driving NC II', 'driving-nc-2', 2, 118),
    ('ALT', 'ALTMSE205', 'Motorcycle/Small Engine Servicing NC II', 'motorcycle-small-engine-servicing-nc-2', 2, 278),
    ('CON', 'CONEIM208', 'Electrical Installation and Maintenance NC II', 'electrical-installation-and-maintenance-nc-2', 2, 402),
    ('MEE', 'MEEEAW107', 'Shielded Metal Arc Welding (SMAW) NC I', 'shielded-metal-arc-welding-nc-1', 1, 268),
    ('MEE', 'MEEEAW207', 'Shielded Metal Arc Welding (SMAW) NC II', 'shielded-metal-arc-welding-nc-2', 2, 268);