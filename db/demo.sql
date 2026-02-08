-- J'insére un user fictif pour mon article
INSERT INTO `user`(lastname, firstname, thumbnail, psswrd, email, login) VALUES ('Garcia', 'Gabriela', NULL , MD5('12345678'), 'gaby@gmail.com', 'gaby');

-- J'insère un groupe de destination
INSERT INTO destinationGroup (name) VALUES ('Europe'), ('Amérique du Sud');

-- J'insére une destination
INSERT INTO destination (title, content, thumbnail, publication_date, id_destinationgroup) VALUES ('Madrid', 'Magnifique destination en Espagne, connue pour sa culture, ses musées et son ambiance vivante.', 'madrid.jpg', NOW(), 1);

-- Je récupère l'id user et la destination
SELECT id_user FROM `user` WHERE login = 'gaby';
SELECT id_destination FROM destination WHERE title = 'Madrid';

-- Je crée un article lié, comme ça mon user non connecté pourra le lire
INSERT INTO article (title, thumbnail, content, creation_date, id_user, id_destination)
VALUES (
    'Que faire à Madrid en 3 jours',
    'madrid-article.jpg',
    'Voici un guide complet pour visiter Madrid en seulement trois jours.',
    NOW(),
    1,   -- id_user récupéré plus haut
    1    -- id_destination récupéré plus haut
);

INSERT INTO article (title, thumbnail, content, creation_date, id_user, id_destination)
VALUES (
        'Séjour à Toulouse',
        'toulouse-article.jpg',
        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque lacinia, dui nec tincidunt interdum, lorem velit sollicitudin elit, sit amet blandit massa lorem nec mi. Vivamus gravida urna vestibulum rhoncus porttitor. Suspendisse orci massa, elementum sit amet risus nec, bibendum ornare urna. Donec sit amet congue justo. Donec rutrum sagittis ante in blandit. Donec semper efficitur tincidunt. Nullam ut rhoncus tellus, id lobortis sem. Aenean ac scelerisque justo, non finibus metus. Pellentesque suscipit elit eu augue condimentum, varius vehicula quam suscipit. Suspendisse dictum velit placerat libero malesuada, faucibus aliquet massa dapibus. Nunc quis nisl enim. Duis id risus ac sapien cursus tristique. Curabitur eu est fermentum, placerat orci in, ultricies magna.

Morbi ut sapien quam. Mauris vitae sem ut nulla dapibus rutrum nec in dolor. Etiam viverra hendrerit velit vel bibendum. Fusce interdum nunc ut sapien gravida, in iaculis dui porta. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean a sodales mi, id gravida lectus. Mauris nec augue porta velit lobortis tempus ac a diam. Donec felis dolor, varius at faucibus sed, pharetra vitae risus.

Ut lorem nisl, ultrices id dictum in, sollicitudin ac odio. Vivamus sed mattis est, nec vulputate urna. Sed id bibendum nunc. Quisque et erat eget risus porta mollis eget vel sem. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse consequat purus est, eget porta dolor ultricies a. Sed iaculis dictum urna, aliquam dignissim odio tincidunt non. Maecenas luctus, enim quis consectetur cursus, lorem metus elementum ante, vel dapibus elit orci eget purus. Aenean volutpat felis felis, in lacinia turpis volutpat vel. Etiam porttitor, magna sed mollis consectetur, elit odio posuere nibh, ac vulputate tortor lorem sagittis ante.",
        NOW(),
        1,
        3
       );

INSERT INTO article (title, thumbnail, content, creation_date, id_user, id_destination)
VALUES (
           'Voyage à Guayaquil',
           'guayaquil-article.JPG',
           "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque lacinia, dui nec tincidunt interdum, lorem velit sollicitudin elit, sit amet blandit massa lorem nec mi. Vivamus gravida urna vestibulum rhoncus porttitor. Suspendisse orci massa, elementum sit amet risus nec, bibendum ornare urna. Donec sit amet congue justo. Donec rutrum sagittis ante in blandit. Donec semper efficitur tincidunt. Nullam ut rhoncus tellus, id lobortis sem. Aenean ac scelerisque justo, non finibus metus. Pellentesque suscipit elit eu augue condimentum, varius vehicula quam suscipit. Suspendisse dictum velit placerat libero malesuada, faucibus aliquet massa dapibus. Nunc quis nisl enim. Duis id risus ac sapien cursus tristique. Curabitur eu est fermentum, placerat orci in, ultricies magna.

   Morbi ut sapien quam. Mauris vitae sem ut nulla dapibus rutrum nec in dolor. Etiam viverra hendrerit velit vel bibendum. Fusce interdum nunc ut sapien gravida, in iaculis dui porta. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean a sodales mi, id gravida lectus. Mauris nec augue porta velit lobortis tempus ac a diam. Donec felis dolor, varius at faucibus sed, pharetra vitae risus.

   Ut lorem nisl, ultrices id dictum in, sollicitudin ac odio. Vivamus sed mattis est, nec vulputate urna. Sed id bibendum nunc. Quisque et erat eget risus porta mollis eget vel sem. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse consequat purus est, eget porta dolor ultricies a. Sed iaculis dictum urna, aliquam dignissim odio tincidunt non. Maecenas luctus, enim quis consectetur cursus, lorem metus elementum ante, vel dapibus elit orci eget purus. Aenean volutpat felis felis, in lacinia turpis volutpat vel. Etiam porttitor, magna sed mollis consectetur, elit odio posuere nibh, ac vulputate tortor lorem sagittis ante.",
           NOW(),
           1,
           2
       );

