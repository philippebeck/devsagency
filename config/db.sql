DROP DATABASE IF EXISTS `devagency`;
CREATE DATABASE `devagency` CHARACTER SET utf8;

USE `devagency`;

CREATE TABLE `Service`
(
    `id`            SMALLINT        UNSIGNED    PRIMARY KEY AUTO_INCREMENT,
    `name`          VARCHAR(30)     NOT NULL,
    `icon`          VARCHAR(30)     NOT NULL    UNIQUE,
    `description`   VARCHAR(255)    NOT NULL
)
    ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `Project`
(
    `id`            TINYINT         UNSIGNED    PRIMARY KEY AUTO_INCREMENT,
    `name`          VARCHAR(20)     NOT NULL    UNIQUE,
    `image`         VARCHAR(30)     NOT NULL    UNIQUE,
    `link`          VARCHAR(50)     NOT NULL    UNIQUE,
    `year`          YEAR            NOT NULL,
    `category`      VARCHAR(10)     NOT NULL,
    `description`   VARCHAR(255)    NOT NULL    UNIQUE
)
    ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `User`
(
    `id`    SMALLINT        UNSIGNED    PRIMARY KEY AUTO_INCREMENT,
    `name`  VARCHAR(20)     NOT NULL,
    `image` VARCHAR(30)     UNIQUE,
    `email` VARCHAR(50)     NOT NULL    UNIQUE,
    `pass`  VARCHAR(100)    NOT NULL
)
    ENGINE=INNODB DEFAULT CHARSET=utf8;

INSERT INTO Service
(name,                      icon,                   description)
VALUES
('Responsive Web Design',   'tablet-alt',           'Responsive Web Design is an approach to web design that makes web pages render well on a variety of devices & window or screen sizes.'),
('SEO Expertise',           'chart-line',           'Search Engine Optimization is the process of growing the website traffic by increasing the visibility of a web page to users of a web search engine.'),
('Programming Tool',        'robot',                'Programming Tool is a computer program that software developers use to create, debug, maintain, or otherwise support other programs & applications.'),
('Digital Transformation',  'magic',                'Digital Transformation is the use of new, fast & frequently changing digital technology to solve problems ; it is about transforming processes that were non digital or manual to digital processes.'),
('Development Mentorship',  'chalkboard-teacher',   'Development Mentorship is a relationship in which a more experienced or more knowledgeable developer helps to guide a less experienced or less knowledgeable in computer development.');

INSERT INTO Project
(name,              image,              link,                                       year,   category,   description)
VALUES
('Animadio',        'animadio.png',     'www.npmjs.com/package/animadio',           2019,   'tool',     'CSS Framework'),
('Pam',             'pam.png',          'packagist.org/packages/philippebeck/pam',  2018,   'tool',     'Php Approachable Microframework'),
('Animadio.js',     'animadio-js.png',  'www.npmjs.com/package/animadio.js',        2020,   'tool',     'Animadio JS Library'),
('Animadio.org',    'animadio-org.jpg', 'animadio.org',                             2019,   'website',  'CSS Framework Website & Documentation'),
('Pam.net',         'pam-net.jpg',      'pam.philippebeck.net',                     2020,   'website',  'Pam Website & Documentation'),
('Astronomy',       'astronomy.jpg',    'astronomy.philippebeck.net',               2020,   'website',  'Astronomy Website'),
('Astrology',       'astrology.jpg',    'astrology.philippebeck.net',               2020,   'website',  'Astrology Website'),
('DevAgency',       'devagency.jpg',    'philippebeck.net',                         2020,   'website',  'Development Agency');

