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
    `name`          VARCHAR(30)     NOT NULL,
    `image`         VARCHAR(30)     NOT NULL    UNIQUE,
    `link`          VARCHAR(50)     NOT NULL    UNIQUE,
    `year`          YEAR            NOT NULL,
    `category`      VARCHAR(10)     NOT NULL,
    `description`   VARCHAR(100)    NOT NULL    UNIQUE
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `Developers` (
    `id`            TINYINT         UNSIGNED    PRIMARY KEY AUTO_INCREMENT,
    `name`          VARCHAR(30)     NOT NULL    UNIQUE,
    `image`         VARCHAR(30)     NOT NULL    UNIQUE,
    `email`         VARCHAR(30)     NOT NULL    UNIQUE,
    `linkedin`      VARCHAR(30)     NOT NULL    UNIQUE,
    `github`        VARCHAR(30)     NOT NULL    UNIQUE,
    `website`       VARCHAR(30)     NOT NULL    UNIQUE,
    `position`      VARCHAR(30)     NOT NULL,
    `city`          VARCHAR(30)     NOT NULL,
    `presentation`  VARCHAR(255)    NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8;

INSERT INTO `Services`
(`name`, `icon`, `description`) VALUES
('Responsive Web Design',       'tablet-alt',           'Vous avez besoin d’un site Web, nos conceptions utilisent l’approche Mobile First pour le Responsive Web Design, une sémantique SEO Friendly, ainsi qu’une administration totalement sécurisée.'),
('Expertise SEO',               'chart-line',           'Vous cherchez plutôt l’optimisation de votre site pour les moteurs de recherche, nous pouvons optimiser les performances, l’accessibilité, le SEO & créer des données structurées.'),
('Outil de Programmation',      'robot',                'Votre besoin est un outil digital pour votre entreprise, nous proposons la conception d’outils entièrement personnalisés selon vos critères.'),
('Transformation Digitale',     'magic',                'Votre entreprise a besoin d’une transformation numérique, nous pouvons vous aider à faire évoluer d’anciens processus vers des processus numériques pour optimiser temps & argent.'),
('Formation & Mentorat',        'chalkboard-teacher',   'Les compétences vous manquent, vous recherchez plutôt une formation dans le développement, que ce soit en Frontend, Backend ou Fullstack, nous pouvons vous accompagner sous forme de mentorat.'),
('Recrutement de Développeurs', 'user-plus',            'Enfin, nous proposons le recrutement de développeurs Frontend, Backend & FullStack diplômés sur les technologies JavaScript & PHP');

INSERT INTO `Projects`
(`name`, `image`, `link`, `year`, `category`, `description`) VALUES
('Pam',             'pam.png',          'packagist.org/packages/devsagency/pam',    2018,   'tool',     'Microframework Php Adaptatif'),
('Animadio',        'animadio.png',     'www.npmjs.com/package/animadio',           2019,   'tool',     'Framework CSS'),
('Animadio',        'animadio-org.jpg', 'animadio.org',                             2019,   'website',  'Documentation du Framework Animadio'),
('Pam',             'pam-net.jpg',      'pam.devsagency.net',                       2020,   'website',  'Documentation du Microframework Pam'),
('Astronomy',       'astronomy.jpg',    'astronomy.philippebeck.net',               2020,   'website',  'Bibliothèque de Médias sur l’Astronomie'),
('Asperger',        'asperger.png',     'asperger.philippebeck.net',                2021,   'website',  'Tests pour le Syndrome d’Asperger'),
('Tools2Code',      'tools2code.png',   'tools2code.devsagency.net',                2021,   'website',  'Annuaire d’Outils pour Coder'),
('Philippe Beck',   'portal.png',       'philippebeck.net',                         2021,   'website',  'Portail vers mes Projets & Réseaux');

INSERT INTO `Developers`
(`name`, `image`, `email`, `linkedin`, `github`, `website`, `position`, `city`, `presentation`) VALUES
('Timothée Segard', 'timothee.jpg', 'segard.timothee@gmail.com', 'timothee-segard', 'TimSeg', 'boutiqueaem.pro', 'Développeur Web / Intégrateur', 'Paris / Lille', 'Développeur Web indépendant ou en équipe, ayant aussi une expérience de plusieurs années dans la gestion de projets numériques. Je sais comprendre & devancer les attentes des personnes qui souhaite une présence en ligne, ou une refonte de leur site Web.');
