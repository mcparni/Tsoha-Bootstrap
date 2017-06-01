INSERT INTO Admin (name, password) VALUES ('admintest', 'admin_23');
INSERT INTO Player (name, description, createdon) VALUES ('Pelaaja1', 'Kova luu', NOW());
INSERT INTO Sport (name, description, sort_order, createdon) VALUES ('Mökkitikka', 'Tikanheitto viidellä tikalla. Suurin tulos voittaa', 1, NOW());
INSERT INTO Sport (name, description, sort_order, createdon) VALUES ('Pussijuoksu', 'Juostaan jätesäkissä talon ympäri. Nopein aika voittaa', 0, NOW());
INSERT INTO Results (player_id, sport_id, result, createdon) VALUES (1,1,'38', NOW());
