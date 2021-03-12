DROP DATABASE IF EXISTS `devsagency`;
CREATE DATABASE `devsagency` CHARACTER SET utf8;

USE `devsagency`;

CREATE TABLE `Services` (
    `id`            TINYINT         UNSIGNED    PRIMARY KEY AUTO_INCREMENT,
    `name`          VARCHAR(30)     NOT NULL,
    `icon`          VARCHAR(30)     NOT NULL    UNIQUE,
    `description`   VARCHAR(255)    NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `Projects` (
    `id`            TINYINT         UNSIGNED    PRIMARY KEY AUTO_INCREMENT,
    `name`          VARCHAR(30)     NOT NULL    UNIQUE,
    `image`         VARCHAR(30)     NOT NULL    UNIQUE,
    `link`          VARCHAR(50)     NOT NULL    UNIQUE,
    `year`          YEAR            NOT NULL,
    `category`      VARCHAR(10)     NOT NULL,
    `description`   VARCHAR(100)    NOT NULL    UNIQUE
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `Graduates` (
    `id`            TINYINT         UNSIGNED    PRIMARY KEY AUTO_INCREMENT,
    `name`          VARCHAR(30)     NOT NULL    UNIQUE,
    `image`         VARCHAR(30)     NOT NULL    UNIQUE,
    `email`         VARCHAR(30)     NOT NULL    UNIQUE,
    `linkedin`      VARCHAR(30)     NOT NULL    UNIQUE,
    `website`       VARCHAR(30)     NOT NULL    UNIQUE,
    `position`      VARCHAR(30)     NOT NULL,
    `city`          VARCHAR(30)     NOT NULL,
    `presentation`  VARCHAR(255)    NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `Members` (
    `id`            TINYINT         UNSIGNED    PRIMARY KEY AUTO_INCREMENT,
    `name`          VARCHAR(30)     NOT NULL    UNIQUE,
    `image`         VARCHAR(30)     NOT NULL    UNIQUE,
    `email`         VARCHAR(30)     NOT NULL    UNIQUE,
    `pass`          VARCHAR(100)    NOT NULL,
    `linkedin`      VARCHAR(30)     NOT NULL    UNIQUE,
    `website`       VARCHAR(30)     NOT NULL    UNIQUE,
    `position`      VARCHAR(30)     NOT NULL    UNIQUE,
    `city`          VARCHAR(30)     NOT NULL,
    `presentation`  VARCHAR(255)    NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8;

INSERT INTO `Services`
(`name`, `icon`, `description`) VALUES
('Responsive Web Design',       'tablet-alt',           'Si votre besoin est un site Web, nous vous proposons une approche Mobile First pour le Responsive Web Design, une conception SEO Friendly & une administration totalement sécurisée.'),
('Expertise SEO',               'chart-line',           'Sinon, si vous avez votre propre site Web & avez besoin d’une optimisation pour les moteurs de recherche, nous proposons la création de données structurées & l’optimisation des langages de programmation.'),
('Outil de Programmation',      'robot',                'Même si votre besoin est un outil de programmation pour la création de sites Web, nous pouvons offrir un Framework entièrement personnalisé pour vos propres projets.'),
('Transformation Digitale',     'magic',                'Mais si vous pensez que votre entreprise a besoin d’une véritable transformation numérique, nous pouvons vous aider à transformer d’anciens processus en processus numériques pour optimiser temps & argent.'),
('Formation & Mentorat',        'chalkboard-teacher',   'De plus, nous proposons de la formation en développement informatique sous forme de mentorat, que ce soit du développement Frontend, Backend, Fullstack ou encore de l’IT.'),
('Recrutement de Développeurs', 'user-plus',            'Enfin, nous proposons le recrutement de développeurs Frontend, Backend ou FullStack diplômés sur les technologies JavaScript & PHP');

INSERT INTO `Projects`
(`name`, `image`, `link`, `year`, `category`, `description`) VALUES
('Pam',             'pam.png',          'packagist.org/packages/devsagency/pam',    2018,   'tool',     'Microframework Php Adaptatif'),
('Animadio',        'animadio.png',     'www.npmjs.com/package/animadio',           2019,   'tool',     'Framework CSS Animadio'),
('Animadio.org',    'animadio-org.jpg', 'animadio.org',                             2019,   'website',  'Documentation du Framework Animadio'),
('Pam.net',         'pam-net.jpg',      'pam.devsagency.net',                       2020,   'website',  'Documentation du Microframework Pam'),
('Astronomy',       'astronomy.jpg',    'astronomy.philippebeck.net',               2020,   'website',  'Bibliothèque de Médias sur l’Astronomie'),
('Asperger',        'asperger.jpg',     'asperger.philippebeck.net',                2021,   'website',  'Tests pour le Syndrome d’Asperger'),
('Tools2Code',      'tools2code.jpg',   'tools2code.devsagency.net',                2021,   'website',  'Annuaire de Liens vers des Outils pour Coder'),
('Philippe Beck',   'portal.jpg',       'philippebeck.net',                         2021,   'website',  'Portail de Liens de mes Organisations');

INSERT INTO `Graduates`
(`name`, `image`, `email`, `linkedin`, `website`, `position`, `city`, `presentation`) VALUES
('Timothée Segard', 'timothee.jpg', 'segard.timothee@gmail.com', 'timothee-segard', 'boutiqueaem.pro', 'Développeur Web / Intégrateur', 'Paris / Lille', 'Développeur web indépendant ou en équipe, ayant également plusieurs années d’expérience dans la gestion de projets numériques. Je sais comprendre & anticiper les attentes des personnes qui souhaitent avoir une première présence en ligne, ou une refonte de leur site internet.');
