DROP TABLE IF EXISTS sector;

CREATE TABLE IF NOT EXISTS sector (
    id SERIAL NOT NULL PRIMARY KEY,
    code VARCHAR(5) UNIQUE NOT NULL DEFAULT '',
    name VARCHAR(255) NOT NULL DEFAULT '',
    slug VARCHAR(255) NOT NULL DEFAULT '',
    description TEXT NOT NULL DEFAULT '',
    UNIQUE (code, name)
);

INSERT INTO sector (code, name, slug) VALUES
    ('AFF', 'Agriculture, Forestry and Fishery', 'agriculture-forestry-and-fishery'),
    ('ALT', 'Automotive and Land Transportation', 'automotive-and-land-transportation'),
    ('CON', 'Construction', 'construction'),
    ('DCR', 'Decorative Crafts', 'decorative-crafts'),
    ('ELC', 'Electronics', 'electronics'),
    ('FLG', 'Footwear and Leathergoods', 'footwear-and-leathergoods'),
    ('FUR', 'Furniture and Fixtures', 'furniture-and-fixtures'),
    ('GRM', 'Garments', 'garments'),
    ('HHC', 'HHC (Human Health Care)', 'human-heath-care'),
    ('HVC', 'Heating, Ventilation, Airconditioning and Refrigeration', 'heating-ventilation-airconditioning-and-refrigeration'),
    ('ICT', 'Information and Communication Technology', 'information-and-communication-technology'),
    ('MT', 'Maritime', 'maritime'),
    ('MEE', 'Metals and Engineering', 'metals-and-engineering'),
    ('PFB', 'Processed Food & Beverages', 'processed-food-and-beverages'),
    ('PYR', 'Pyrotechnics', 'pyrotechnics'),
    ('SOC', 'Social, Community Development and other Services', 'social-community-development-and-other-services'),
    ('TRS', 'Tourism (Hotel and Restaurant)', 'tourism-hotel-and-restaurant'),
    ('TVET', 'TVET', 'tvet'),
    ('UTL', 'Utilities ( Water Supply, Sewerage, Waste Management, etc)', 'utilities'),
    ('VSA', 'Visual Arts', 'visual-arts'),
    ('WRT', 'Wholesale and Retail Trading', 'wholesale-and-retail-trading');
