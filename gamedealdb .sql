
--
-- Database: `gamedealdb`
--

INSERT INTO `developpeur` (`id`, `nom`) VALUES
(1, 'test'),
(2, 'Ubisoft'),
(3, 'Rockstar Games'),
(4, 'Capcom');

-- --------------------------------------------------------

INSERT INTO `editeur` (`id`, `nom`) VALUES
(1, 'test'),
(2, 'Take2 Interactive'),
(3, 'Activision Blizzard');

-- --------------------------------------------------------

INSERT INTO `jeux` (`id`, `developpeur_id`, `editeur_id`, `nom`, `date_sortie`) VALUES
(2, 1, 1, 'test', '1999-08-21 00:00:00'),
(3, 3, 2, 'GTA 5', '2013-09-21 00:00:00'),
(4, 2, 2, 'Assassin\'s Creed', '2007-09-09 00:00:00');

-- --------------------------------------------------------

INSERT INTO `offre` (`id`, `jeux_id`, `coupon_id`, `prix`, `lien`, `edition`, `plateforme_jeu`, `plateforme_activation`) VALUES
(1, 2, NULL, 15, 'http://test.com/test', 'deluxe', 'PC', 'Steam'),
(2, 4, NULL, 25, 'http://test.com/test', 'deluxe', 'PC', 'Uplay'),
(3, 3, NULL, 15, 'http://test.com/test', 'standard', 'PC', 'Epic Games');

-- --------------------------------------------------------

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`) VALUES
(2, 'test@test.com', '[\"ROLE_USER\",\"ROLE_ADMIN\"]', '$2y$13$lD4anTwC4HseEgFvjOC7Sel6bzEVSyouJScRi8oPcZ6TiEth9SZIa', 'test user'),
(3, 'user@user.com', '[]', '$2y$13$wGYdJdKO5hNHAD32pTXAkuPXMn0PQOsdx4ePcwMM3F3NcHsafDalu', 'test user'),
(4, 'akramchami98@gmail.com', '[]', '$2y$13$2XtVBpDKcl6Lf3KfYoTU6ulM6diGoinDu6fLQLjGbz3B0NPqRb8b.', 'akram');


