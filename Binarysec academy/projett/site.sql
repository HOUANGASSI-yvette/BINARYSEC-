-- creation de la base de donnee
create database cart_db;

--creation de la table produit pour gerer les produits
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    namee VARCHAR(100),
    price VARCHAR(50),
    imagee BLOB
);

-- creation de la table utilisateur pour gerer les connexions (confere note.txt)
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
)