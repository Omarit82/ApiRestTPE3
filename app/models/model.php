<?php
    class Model {
        protected $db;

        function __construct() {
            $this->db = new PDO('mysql:host='. MYSQL_HOST .';dbname='. MYSQL_DB .';charset=utf8', MYSQL_USER, MYSQL_PASS);
            $this->deploy();
        }

        function deploy() {
            // Chequear si hay tablas
            $query = $this->db->query('SHOW TABLES');
            $tables = $query->fetchAll(); // Nos devuelve todas las tablas de la db
            if(count($tables)==0) {
                // Si no hay crearlas
                $sql=<<<END
                SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
                START TRANSACTION;
                SET time_zone = "+00:00";


                /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
                /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
                /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
                /*!40101 SET NAMES utf8mb4 */;

                --
                -- Database: `comercio_discos`
                --

                -- --------------------------------------------------------

                --
                -- Table structure for table `discos`
                --

                CREATE TABLE `discos` (
                `id` int(11) NOT NULL,
                `nombre` varchar(45) NOT NULL,
                `autor` varchar(45) NOT NULL,
                `genero` varchar(45) NOT NULL,
                `precio` float NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                --
                -- Dumping data for table `discos`
                --

                INSERT INTO `discos` (`id`, `nombre`, `autor`, `genero`, `precio`) VALUES
                (1, 'Si Te Agarran Las Ganas', 'Leo Mattioli', 'Cumbia', 4000),
                (3, 'The dark side of the moon', 'Pink Floyd', 'Rock', 8990.9),
                (4, 'Use your Ilussion I', 'Guns & Roses', 'Rock', 7500.9),
                (5, 'El Tesoro de los Inocentes', 'Los Fundamentalistas del Aire Acondicionado', 'Rock', 6500),
                (6, 'Porco Rex', 'Los Fundamentalistas del Aire Acondicionado', 'Rock', 7200.5),
                (7, 'Girotondo', 'Giusy Ferreri', 'Pop', 6250.25),
                (8, 'Cortometraggi', 'Giusy Ferreri', 'Pop', 4250.75),
                (9, 'Gulp!', 'Patricio Rey y sus Redonditos de Ricota', 'Rock', 6500),
                (14, 'JiJiJi', 'Indio Solari', 'Rock', 5000.33);

                -- --------------------------------------------------------

                --
                -- Table structure for table `genero`
                --

                CREATE TABLE `genero` (
                `id_genero` int(11) NOT NULL,
                `genero` varchar(50) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                --
                -- Dumping data for table `genero`
                --

                INSERT INTO `genero` (`id_genero`, `genero`) VALUES
                (1, 'rock'),
                (2, 'blues'),
                (3, 'pop'),
                (4, 'clasica');

                -- --------------------------------------------------------

                --
                -- Table structure for table `users`
                --

                CREATE TABLE `users` (
                `id` int(11) NOT NULL,
                `email` varchar(50) NOT NULL,
                `pass` varchar(100) NOT NULL,
                `nivel` varchar(15) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                --
                -- Dumping data for table `users`
                --

                INSERT INTO `users` (`id`, `email`, `pass`, `nivel`) VALUES
                (1, 'omar@email.com', '$2y$10$Ok1SIqiVKjesOXh/uUHKge/F9LFvFTqhpu8hdnBfxZ7iRqItW1Dou', 'admin'),
                (2, 'matias@email.com', '$2y$10$NqrD5XR954nuZPsfs8rRzeOBVAdBLfEVaYj2gHFVaNPpCOLJjxDC.', 'admin'),
                (3, 'guest@email.com', '$2y$10$a2R1d1falFvRJc0hm0knWeZygzcgHnpXXQ2FtjWy59Ny5jJ8D9jhW', 'user'),
                (4, 'webadmin', '$2y$10$b095X3XhrDjPwzbj3BgwiuN.1RyATcDddARL7yxi5.pBuLItt4w9K', 'admin');

                --
                -- Indexes for dumped tables
                --

                --
                -- Indexes for table `users`
                --
                ALTER TABLE `users`
                ADD PRIMARY KEY (`id`);

                --
                -- AUTO_INCREMENT for dumped tables
                --

                --
                -- AUTO_INCREMENT for table `users`
                --
                ALTER TABLE `users`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
                COMMIT;

                /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
                /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
                /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

                END;
                $this->db->query($sql);
            }
        
        }
    }
    
                    