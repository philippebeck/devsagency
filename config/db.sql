DROP DATABASE IF EXISTS `devsagency`;
CREATE DATABASE `devsagency` CHARACTER SET utf8;

USE `devsagency`;

CREATE TABLE `Services`
(
    `id`            TINYINT         UNSIGNED    PRIMARY KEY AUTO_INCREMENT,
    `name`          VARCHAR(30)     NOT NULL,
    `icon`          VARCHAR(30)     NOT NULL    UNIQUE,
    `description`   VARCHAR(255)    NOT NULL
)
    ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `Projects`
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

CREATE TABLE `Graduates`
(
    `id`            TINYINT         UNSIGNED    PRIMARY KEY AUTO_INCREMENT,
    `name`          VARCHAR(30)     NOT NULL    UNIQUE,
    `image`         VARCHAR(30)     NOT NULL    UNIQUE,
    `email`         VARCHAR(30)     NOT NULL    UNIQUE,
    `linkedin`      VARCHAR(30)     NOT NULL    UNIQUE,
    `website`       VARCHAR(30)     NOT NULL    UNIQUE,
    `position`      VARCHAR(30)     NOT NULL,
    `city`          VARCHAR(30)     NOT NULL,
    `presentation`  VARCHAR(255)    NOT NULL
)
    ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `Users`
(
    `id`            TINYINT         UNSIGNED    PRIMARY KEY AUTO_INCREMENT,
    `name`          VARCHAR(30)     NOT NULL    UNIQUE,
    `image`         VARCHAR(30)     NOT NULL    UNIQUE,
    `email`         VARCHAR(30)     NOT NULL    UNIQUE,
    `pass`          VARCHAR(100)    NOT NULL,
    `website`       VARCHAR(30)     NOT NULL    UNIQUE,
    `position`      VARCHAR(30)     NOT NULL    UNIQUE,
    `city`          VARCHAR(30)     NOT NULL,
    `presentation`  VARCHAR(255)    NOT NULL
)
    ENGINE=INNODB DEFAULT CHARSET=utf8;

INSERT INTO `Services`
(`name`,                    `icon`,                 `description`)
VALUES
('Responsive Web Design',   'tablet-alt',           'If your need is a Website, we offer a Mobile First approach for Responsive Web Design, a SEO Friendly Conception & a completely Secure Administration.'),
('SEO Expertise',           'chart-line',           'Else if you have your own website & need Search Engine Optimization, we offer Structured Data creation & Programming Languages optimization.'),
('Programming Tool',        'robot',                'Even if your need is a Programming Tool for Website Building, we can offer a Completely Personalized Framework for your Own Projects.'),
('Digital Transformation',  'magic',                'But if you think that your Company need a real Digital Transformation, we can help you to transform old processes to Digital Processes & to optimize Time & Money.'),
('Development Mentorship',  'chalkboard-teacher',   'Finally, we propose Development Mentorship for some kind of computer domains, like Frontend & Backend Development or else System Administration.');

INSERT INTO `Projects`
(`name`,            `image`,            `link`,                                     `year`, `category`, `description`)
VALUES
('Animadio',        'animadio.png',     'www.npmjs.com/package/animadio',           2019,   'tool',     'CSS Framework'),
('Pam',             'pam.png',          'packagist.org/packages/philippebeck/pam',  2018,   'tool',     'Php Approachable Microframework'),
('Animadio.js',     'animadio-js.png',  'www.npmjs.com/package/animadio.js',        2020,   'tool',     'Animadio JS Library'),
('Animadio.org',    'animadio-org.jpg', 'animadio.org',                             2019,   'website',  'CSS Framework Website & Documentation'),
('Pam.net',         'pam-net.jpg',      'pam.devsagency.net',                       2020,   'website',  'Pam Website & Documentation'),
('Astronomy',       'astronomy.jpg',    'astronomy.philippebeck.net',               2020,   'website',  'Astronomy Website');
