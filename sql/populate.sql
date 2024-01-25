INSERT INTO ROLE(content) VALUES ('ADMIN'), ('TEACH'), ('STUDT'), ('BLIST');
INSERT INTO THEME(content) VALUES ('ANTIQUITE'), ('MOYENAGE'), ('MODERNE'), ('CONTEMP');
INSERT INTO skinpart (skinpartid, name)
VALUES
    (1, 'hat'),
    (2, 'hair'),
    (3, 'teeshirt'),
    (4, 'pants'),
    (5, 'shoes'),
    (0, 'skincolor');
INSERT INTO skinobject (name, price, location, parts)
VALUES
    ('Pantalon bleu', 1000, 'blue-pants.png', 4),
    ('Cheveux court brun', 1000, 'brown-hair.png', 2),
    ('Couronne', 1200, 'crown.png', 1),
    ('Tee-shirt rouge', 800, 'red-shirt.png', 3),
    ('Chaussures blanches', 500, 'white-shoes.png', 5),
    ('bicorne', 1000, 'bicorne.png', 1),
    ('Chrono Travel T-shirt', 200, 'ct-shirt.png', 3),
    ('Cheveux long brun', 80, 'long-hair.png', 2),
    ('Couleur de peau', 0, 'skin1.png', 0),
    ('Couleur de peau', 0, 'skin2.png', 0),
    ('Couleur de peau', 0, 'skin3.png', 0),
    ('Couleur de peau', 0, 'skin4.png', 0);

