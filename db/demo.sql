USE checkvoyages;

-- 1. Insertion des groupes de destinations
INSERT INTO destinationGroup (id_destinationGroup, name) VALUES
(1, 'Europe'),
(2, 'Asie'),
(3, 'Amérique du Sud'),
(4, 'Amérique du Nord'),
(5, 'Océanie');

-- 2. Insertion des utilisateurs (Duck Family)
INSERT INTO `user` (id_user, lastname, firstname, login, email, psswrd) VALUES
(1, 'Duck', 'Riri', 'riri', 'riri@duck.com', MD5('123456789')),
(2, 'Duck', 'Fifi', 'fifi', 'fifi@duck.com', MD5('123456789')),
(3, 'Duck', 'Loulou', 'loulou', 'loulou@duck.com', MD5('123456789'));

-- 3. Insertion des destinations
INSERT INTO destination (id_destination, id_destinationGroup, title, content, thumbnail, publication_date) VALUES
(1, 1, "Toulouse", "La ville rose, célèbre pour son architecture en briques de terre cuite et son dynamisme aéronautique.", "toulouse.jpg", NOW()),
(2, 1, "Madrid", "Capitale de l'Espagne, connue pour ses musées d'art prestigieux et sa vie nocturne animée.", "madrid.jpg", NOW()),
(3, 1, "Paris", "La ville lumière, capitale mondiale de la gastronomie, de la mode et de la culture.", "paris.jpg", NOW()),
(4, 5, "Sydney", "La plus grande ville d'Australie, entre plages de surf iconiques et opéra majestueux.", "sydney.jpeg", NOW()),
(5, 3, "Guayaquil", "Port principal de l'Équateur, porte d'entrée vers les îles Galápagos et son célèbre Malecon.", "guayaquil.webp", NOW()),
(6, 3, "Lima", "Capitale du Pérou, réputée pour sa gastronomie exceptionnelle et ses vestiges coloniaux.", "lima.jpeg", NOW()),
(7, 2, "Tokyo", "Une métropole fascinante mélangeant gratte-ciels ultra-modernes et temples traditionnels.", "tokyo.jpg", NOW()),
(8, 4, "New York", "La ville qui ne dort jamais, de Central Park à l'Empire State Building.", "new-york.jpg", NOW()),
(9, 4, "Calgary", "Ville canadienne au pied des Rocheuses, célèbre pour son Stampede et sa nature sauvage.", "calgary.jpg", NOW());

-- 4. Insertion des articles (entre 1 et 3 par destination)
INSERT INTO article (title, content, thumbnail, creation_date, id_user, id_destination) VALUES
-- Toulouse
("Mon weekend à Toulouse", "J'ai adoré me balader sur les bords de la Garonne sous le soleil couchant. La place du Capitole est magnifique avec ses briques roses qui s'enflamment au crépuscule. J'ai aussi visité la basilique Saint-Sernin, un chef-d'œuvre de l'art roman. Toulouse est une ville dynamique et accueillante où il fait bon vivre et flâner dans les ruelles du centre historique.", "toulouse-article-2.jpg", NOW(), 1, 1),
("Les bonnes adresses toulousaines", "Voici une sélection de restaurants pour déguster un vrai cassoulet. Ne manquez pas le marché Victor Hugo pour ses produits locaux de qualité. Pour une pause sucrée, les salons de thé près de la place Saint-Georges sont parfaits. Enfin, pour boire un verre le soir, le quartier de la Daurade offre une ambiance conviviale avec vue sur le Pont Neuf éclairé.", "toulouse-article.webp", NOW(), 2, 1),
-- Madrid
("Visite du Prado", "Une collection d'art incroyable, prévoyez au moins une demi-journée pour voir les chefs-d'œuvre de Velázquez et Goya. Le musée est immense et chaque salle réserve des surprises. C'est un passage obligé pour tout amateur d'art visitant la capitale espagnole. N'oubliez pas de réserver vos billets à l'avance pour éviter les longues files d'attente à l'entrée.", "madrid-article-2.jpg", NOW(), 3, 2),
-- Paris
("Flânerie dans le Marais", "Les petites rues de ce quartier historique cachent de vrais trésors : des hôtels particuliers somptueux, des boutiques de créateurs et des galeries d'art. La place des Vosges est l'endroit idéal pour faire une pause au calme. C'est un quartier qui a su préserver son âme tout en devenant l'un des plus branchés de la capitale. Un vrai bonheur pour les promeneurs.", NULL, NOW(), 1, 3),
("Paris vue d'en haut", "Monter au sommet de l'Arc de Triomphe offre une vue unique sur les Champs-Élysées et la tour Eiffel. On peut admirer l'organisation parfaite des douze avenues qui partent de la place de l'Étoile. C'est encore plus impressionnant au coucher du soleil quand les lumières de la ville commencent à s'allumer. Une expérience incontournable pour saisir l'immensité de Paris.", NULL, NOW(), 2, 3),
("Le Louvre de nuit", "La pyramide éclairée est tout simplement magique le soir, loin de la foule de la journée. Les reflets sur les bassins d'eau ajoutent une touche de poésie à l'ensemble. C'est le moment idéal pour une balade romantique ou pour prendre des photos spectaculaires de l'architecture. Le calme qui règne sur la place du Carrousel à cette heure-là est très ressourçant.", NULL, NOW(), 3, 3),
-- Sydney
("Surf à Bondi Beach", "Les vagues étaient parfaites ce matin. Une expérience inoubliable pour tout surfeur, débutant ou confirmé ! L'ambiance sur la plage est électrique dès le lever du soleil. Après la session, rien de tel qu'un petit-déjeuner dans l'un des nombreux cafés avec vue sur l'océan. La randonnée côtière de Bondi à Coogee offre également des paysages à couper le souffle.", "sydney-article.jpg", NOW(), 1, 4),
-- Guayaquil
("Escapade à Las Peñas", "Monter les 444 marches pour arriver au phare en vaut vraiment la peine pour la vue panoramique sur le fleuve Guayas. Les maisons colorées du quartier historique sont pleines de charme et racontent l'histoire de la ville. On y trouve de nombreux ateliers d'artistes et des petits bars typiques. C'est un véritable voyage dans le temps au cœur de la modernité de Guayaquil.", "guayaquil-article.jpg", NOW(), 2, 5),
("Le parc aux iguanes", "C'est surprenant de voir autant d'iguanes en plein centre-ville, juste devant la cathédrale. Ils se promènent en toute liberté au milieu des passants et grimpent aux arbres du parc Bolivar. C'est une attraction unique qui ravit les petits comme les grands. On peut les observer de très près, ce qui permet de réaliser de superbes photos de ces reptiles fascinants.", "guayaquil-article-2.jpg", NOW(), 3, 5),
-- Lima
("Explosion de saveurs à Lima", "La cuisine péruvienne est sans aucun doute l'une des meilleures au monde. À Lima, j'ai pu déguster un ceviche d'une fraîcheur incroyable dans un petit restaurant de Miraflores. Le mélange de saveurs acides, épicées et marines est un pur délice pour les papilles. La ville regorge de marchés colorés et de restaurants gastronomiques qui célèbrent la richesse de la terre et de la mer.", "lima.jpeg", NOW(), 1, 6),
-- Tokyo
("Shibuya Crossing", "Le carrefour le plus célèbre du monde est encore plus impressionnant en vrai qu'en vidéo. Lorsque les feux passent au vert, une marée humaine s'élance dans toutes les directions avec une discipline fascinante. Il faut monter dans l'un des cafés surplombant la place pour observer ce spectacle urbain unique. C'est le cœur battant de Tokyo, un symbole de sa modernité trépidante.", "tokyo-article.jpg", NOW(), 2, 7),
("Calme et sérénité au Meiji-jingu", "Un havre de paix au milieu de l'effervescence tokyoïte. Ce sanctuaire shintoïste niché au cœur d'une forêt dense offre une pause spirituelle bienvenue. En marchant sous les immenses torii en bois, on oublie vite que l'on se trouve dans l'une des plus grandes métropoles mondiales. C'est un lieu chargé d'histoire et de respect où la nature reprend ses droits sur le béton.", "tokyo-article-2.jpg", NOW(), 3, 7),
-- New York
("Central Park en automne", "Les couleurs des arbres sont magnifiques à cette période de l'année, offrant un dégradé de rouge et d'orangé. Se promener autour de The Lake ou monter sur Belvedere Castle permet de s'évader du bruit de Manhattan. C'est le poumon vert de la ville, un espace immense où les New-Yorkais viennent courir, faire du vélo ou simplement profiter d'un pique-nique au soleil.", "new-york.jpg", NOW(), 1, 8),
("Spectacle à Broadway", "J'ai eu la chance de voir le Roi Lion, les décors et les costumes sont somptueux. La qualité des performances vocales et scéniques est tout simplement époustouflante. Broadway est une expérience sensorielle complète qui vous transporte dans un autre monde pendant quelques heures. C'est une étape incontournable de tout séjour à New York pour s'imprégner de l'énergie culturelle de la ville.", "new-york-article", NOW(), 2, 8),
-- Calgary
("Aux portes des Rocheuses", "Calgary est le point de départ idéal pour explorer Banff et Lake Louise, situés à seulement une heure de route. La ville elle-même offre un beau mélange de modernité avec ses gratte-ciels et de tradition western avec son célèbre Stampede. En hiver, les stations de ski environnantes sont parmi les meilleures au monde, attirant des passionnés de glisse de tous les horizons.", "calgary-article.jpeg", NOW(), 3, 9);
