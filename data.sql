INSERT INTO "Role" (name)
VALUES
    ('User'),
    ('Admin'),
    ('Seller');

INSERT INTO "Category" (name)
VALUES
    ('Instru'),
    ('Drum kit'),
    ('Sample'),
    ('Vocal');

INSERT INTO "Element" (name)
VALUES
    ('Button'),
    ('Title H1'),
    ('Title H2'),
    ('Title H3'),
    ('Paragraph'),
    ('Image');

INSERT INTO "User" (id_role, is_verified, firstname, lastname, pseudo, birth_date, email, phone, country, thumbnail, zip_code, address, pwd, token)
VALUES
    (1, TRUE, 'Leon', 'Trotsky', 'lvansky', '1879-11-07', 'ltrotsky@email.com', '1234567890', 'RU', 'trotsky.jpg', '101000', 'Bolshoi avenue, Moscow', 'password', '$2y$10$SgXyxMk6.OFJkgJK5TJvVuhGOoCRrIgjZZKDftytdLBcNt0fOp3ee'),
    (1, TRUE, 'Rosa', 'Luxemburg', 'rluxemburg', '1871-03-05', 'rluxemburg@email.com', '0987654321', 'GR', 'luxemburg.jpg', '10115', 'Rosa-Luxemburg-Str. Berlin', 'password', '$2y$10$SgXyxMk6.OFJkgJK5TJvVuhGOoCRrIgjZZKDftytdLBcNt0fOp3ee'),
    (1, TRUE, 'Che', 'Guevara', 'cguevara', '1928-06-14', 'cguevara@email.com', '0123456789', 'AR', 'guevara.jpg', '1060', 'Avenida de la Revolucion, Buenos Aires', 'password', '$2y$10$SgXyxMk6.OFJkgJK5TJvVuhGOoCRrIgjZZKDftytdLBcNt0fOp3ee'),
    (1, TRUE, 'Friedrich', 'Engels', 'fengels', '1820-11-28', 'fengels@email.com', '9012345678', 'GE', 'engels.jpg', '40213', 'Engels-Platz, Düsseldorf', 'password', '$2y$10$SgXyxMk6.OFJkgJK5TJvVuhGOoCRrIgjZZKDftytdLBcNt0fOp3ee'),
    (1, TRUE, 'Neoxzzyi', 'Rsk', 'NeOxZzyi_RsK', '2001-11-03', 'neoxzzyi.rsk@gmail.com', '0504030201', 'GE', 'https://image.noelshack.com/fichiers/2023/23/6/1686353910-ilyesse.png', '75001', '75 avenue de la bretagne', '$2y$10$PpE1dRBuXWUtDu6XiA3n4OFeuaAjuxWEJTGhIGopTouqs0LMOPGHS', '$2y$10$SgXyxMk6.OFJkgJK5TJvVuhGOoCRrIgjZZKDftytdLBcNt0fOp3ee'),
    (2, TRUE, 'Ilyesse', 'HAMCHERIF', 'Akyrox', '2003-03-19', 'ilyesse@bhgroupe.fr', '0607080102', 'FR', 'https://image.noelshack.com/fichiers/2023/23/6/1686353910-ilyesse.png', '91000', '1 rue du test', '$2y$10$PpE1dRBuXWUtDu6XiA3n4OFeuaAjuxWEJTGhIGopTouqs0LMOPGHS', '$2y$10$SgXyxMk6.OFJkgJK5TJvVuhGOoCRrIgjZZKDftytdLBcNt0fOp3ee'),
    (2, TRUE, 'Lounis', 'KERNOUG', 'W', '2003-03-19', 'louniskernougpro@gmail.com', '0607080102', 'FR', 'https://image.noelshack.com/fichiers/2023/23/6/1686353910-ilyesse.png', '91000', '1 rue du test', '$2y$10$PpE1dRBuXWUtDu6XiA3n4OFeuaAjuxWEJTGhIGopTouqs0LMOPGHS', '$2y$10$SgXyxMk6.OFJkgJK5TJvVuhGOoCRrIgjZZKDftytdLBcNt0fOp3ee'),
    (3, TRUE, 'Akyrox', 'The Genius', 'AkyroxTheGenius', '1991-08-19', 'pro.akyrox@gmail.com', '0102030405', 'DZ', 'https://image.noelshack.com/fichiers/2023/23/6/1686353910-ilyesse.png', '75001', '75 avenue de la bretagne', '$2y$10$PpE1dRBuXWUtDu6XiA3n4OFeuaAjuxWEJTGhIGopTouqs0LMOPGHS', '$2y$10$SgXyxMk6.OFJkgJK5TJvVuhGOoCRrIgjZZKDftytdLBcNt0fOp3ee');

INSERT INTO "Product" (id_seller, id_category, name, description, price, stock, thumbnail, slug, meta_title, meta_description, meta_keywords)
VALUES
    (4, 1, 'Produit 1', 'Description du produit 1', '1', '∞', 'https://image.noelshack.com/fichiers/2023/24/4/1686860445-visuel-07.jpg', 'produit-un', 'Produit 1', 'Ceci est le produit 1', 'Produit un'),
    (4, 2, 'Produit 2', 'Description du produit 2', '2', '∞',  'https://image.noelshack.com/fichiers/2023/24/4/1686860518-football-5-parapan-2007-final.jpg', 'produit-deux', 'Produit 2', 'Ceci est le produit 2', 'Produit deux'),
    (7, 3, 'Produit 3', 'Description du produit 3', '3', '1', 'https://image.noelshack.com/fichiers/2023/24/4/1686860564-cecifoot.jpeg', 'produit-trois', 'Produit 3', 'Ceci est le produit 3', 'Produit trois');

INSERT INTO "Comment" (content, date, id_user, id_product, id_reporter, is_reported)
VALUES
    ('Je suis le commentaire 1 du produit 1', '2023-06-15', 7, 1, 1, FALSE),
    ('Je suis le commentaire 2 du produit 1', '2023-06-15', 2, 1, 5, TRUE),
    ('Je suis le commentaire 3 du produit 1', '2023-06-15', 3, 1, 3, TRUE),
    ('Je suis le commentaire 1 du produit 2', '2023-06-15', 4, 2, 6, FALSE),
    ('Je suis le commentaire 1 du produit 3', '2023-06-15', 5, 3, 5, FALSE),
    ('Je suis le commentaire 2 du produit 2', '2023-06-15', 5, 2, 7, TRUE),
    ('Je suis le commentaire 2 du produit 3', '2023-06-15', 6, 3, 6, FALSE),
    ('Je suis le commentaire 4 du produit 1', '2023-06-15', 6, 1, 7, TRUE);

INSERT INTO "Page" (id_user, cover_image, cover_title, slug, meta_title, meta_description, meta_keywords)
VALUES
    (6, 'https://image.noelshack.com/fichiers/2023/27/3/1688509863-images.jpg', 'Titre page 1', 'page-une', 'Page 1', 'Ceci est la page 1', 'Page une'),
    (6, 'https://image.noelshack.com/fichiers/2023/27/3/1688509880-2022-fifa-fifpro-men-s-w11.jpg', 'Titre page 2', 'page-deux', 'Page 2', 'Ceci est la page 2', 'Page deux'),
    (6, 'https://image.noelshack.com/fichiers/2023/27/3/1688509931-images-1.jpg', 'Titre page 3', 'page-trois', 'Page 3', 'Ceci est la page 3', 'Page trois'),
    (6, 'https://image.noelshack.com/fichiers/2023/27/3/1688509931-2x1-nswitch-lolsurprisebbsborntotravel-frfr-image1600w.jpg', 'Titre page 4', 'page-quatre', 'Page 4', 'Ceci est la page 4', 'Page quatre');

INSERT INTO "PageElement" (id_page, id_element, content)
VALUES
    (1, 2, 'Je joue a un mode lune sur mincraft #4'),
    (1, 5, 'Ne vous fiez surtout pas a la démo du site minecraft. net !Vous pouvez jouer au mode solo et au mode multijoueur. Le but du jeu est de survivre aux créatures nocturnes qui attaquent les joueurs à mort, il faut pour cela se créer un abri de la cabane en bois au château fort, les joueurs peuvent exploiter absolument tout, la terre, la pierre, le fer, lor, le bois, et créer une bonne centaine dobjet avec une table de craft 5 cases ou en fonction de lendroit ou on met telle objet à telle place on peut créer telle objet avec telle fusion. Les joueurs peuvent faire absolument TOUT ! du pvp, du pve, des lexploration ! la map se génère aléatoirement et peut faire 8 fois la surface de la terre ! Bref un jeu infini et de survie, impossible de sen lasser !'),
    (1, 3, 'Images du mode'),
    (1, 6, 'Miniature mode minecraft'),
    (1, 4, 'Vidéo de présentation'),
    (1, 5, 'Vous trouverez ci-dessous la vidéo de présentation du mode.'),
    (1, 1, 'Voir la vidéo'),
    (2, 2, 'Titre h1'),
    (2, 1, 'Cliquez sur moi'),
    (4, 6, 'élément de la table');
