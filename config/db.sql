DROP DATABASE IF EXISTS devagency;
CREATE DATABASE devagency CHARACTER SET utf8;

USE devagency;

CREATE TABLE User
(
    id            SMALLINT      UNSIGNED  PRIMARY KEY AUTO_INCREMENT,
    name          VARCHAR(50)   NOT NULL,
    image         VARCHAR(50)   UNIQUE,
    email         VARCHAR(100)  NOT NULL  UNIQUE,
    pass          VARCHAR(100)  NOT NULL
)
    ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE Project
(
    id              TINYINT         UNSIGNED    PRIMARY KEY     AUTO_INCREMENT,
    name            VARCHAR(50)     NOT NULL    UNIQUE,
    image           VARCHAR(50)     NOT NULL    UNIQUE,
    link            VARCHAR(50)     NOT NULL    UNIQUE,
    year            YEAR            NOT NULL,
    category        VARCHAR(10)     NOT NULL,
    description     VARCHAR(255)    NOT NULL    UNIQUE
)
    ENGINE=INNODB DEFAULT CHARSET=utf8;

INSERT INTO Project
(name,              image,              link,                                       year,   category,   description)
VALUES
('Pam',             'pam.png',          'packagist.org/packages/philippebeck/pam',  2018,   'tool',     'Php Approachable Microframework'),
('Animadio',        'animadio.png',     'www.npmjs.com/package/animadio',           2019,   'tool',     'CSS Framework'),
('Animadio.org',    'animadio-org.jpg', 'animadio.org',                             2019,   'website',  'CSS Framework Website & Documentation'),
('Animadio.js',     'animadio-js.jpg',  'www.npmjs.com/package/animadio.js',        2020,   'tool',     'Animadio JS Library'),
('Astronomy',       'astronomy.jpg',    'astronomy.philippebeck.net',               2020,   'website',  'Astronomy Website'),
('DevAgency',       'devagency.jpg',    'philippebeck.net',                         2020,   'website',  'Development Agency'),
('Pam.net',         'pam-net.jpg',      'pam.philippebeck.net',                     2020,   'website',  'Pam Website & Documentation'),
('Astrology',       'astrology.jpg',    'astrology.philippebeck.net',               2020,   'website',  'Astrology Website');
