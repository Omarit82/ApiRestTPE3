<?php
    require_once "./config.php";
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
                -- Base de datos: `comercio_discos`
                --

                -- --------------------------------------------------------

                --
                -- Estructura de tabla para la tabla `discos`
                --

                CREATE TABLE `discos` (
                `id` int(11) NOT NULL,
                `nombre` varchar(45) NOT NULL,
                `autor` varchar(45) NOT NULL,
                `genero` varchar(45) NOT NULL,
                `precio` float NOT NULL,
                `oferta` tinyint(1) NOT NULL DEFAULT 0
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                --
                -- Volcado de datos para la tabla `discos`
                --

                INSERT INTO `discos` (`id`, `nombre`, `autor`, `genero`, `precio`, `oferta`) VALUES
                (2, 'Si te agarran las ganas', 'Leo Mattioli', 'Cumbia', 7580.9, 0),
                (3, 'The dark side of the moon', 'Pink Floyd', 'Rock', 8990.9, 0),
                (4, 'Use your Ilussion I', 'Guns & Roses', 'Rock', 7500.9, 0),
                (5, 'El Tesoro de los Inocentes', 'Los Fundamentalistas del Aire Acondicionado', 'Rock', 6500, 0),
                (6, 'Porco Rex', 'Los Fundamentalistas del Aire Acondicionado', 'Rock', 7200.5, 0),
                (7, 'Girotondo', 'Giusy Ferreri', 'Pop', 6250.25, 0),
                (8, 'Cortometraggi', 'Giusy Ferreri', 'Pop', 4250.75, 0),
                (9, 'Gulp!', 'Patricio Rey y sus Redonditos de Ricota', 'Rock', 6500, 0),
                (14, 'JiJiJi', 'Indio Solari', 'Rock', 5000.33, 0),
                (15, 'Crossroads', 'Eric Clapton', 'Blues', 7500, 0),
                (16, 'Las ciudades Venideras', 'Emilia Inclan', 'Pop', 7500.2, 1),
                (17, 'Pies Descalzos', 'Shakira', 'Pop', 5520.0, 1),
                (18, 'Get Up', 'Bryan Adams', 'Rock', 7500.2, 0),
                (19, 'El amor despues del amor', 'Fito Paez', 'Rock', 4500, 1);

                -- --------------------------------------------------------

                --
                -- Estructura de tabla para la tabla `genero`
                --

                CREATE TABLE `genero` (
                `id_genero` int(11) NOT NULL,
                `genero` varchar(50) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                --
                -- Volcado de datos para la tabla `genero`
                --

                INSERT INTO `genero` (`id_genero`, `genero`) VALUES
                (1, 'rock'),
                (2, 'blues'),
                (3, 'pop'),
                (4, 'clasica'),
                (5, 'cumbia');

                -- --------------------------------------------------------

                --
                -- Estructura de tabla para la tabla `users`
                --

                CREATE TABLE `users` (
                `id` int(11) NOT NULL,
                `email` varchar(50) NOT NULL,
                `pass` varchar(100) NOT NULL,
                `nivel` varchar(15) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                --
                -- Volcado de datos para la tabla `users`
                --

                INSERT INTO `users` (`id`, `email`, `pass`, `nivel`) VALUES
                (1, 'omar@email.com', '$2y$10$'Ok1SIqiVKjesOXh/uUHKge/F9LFvFTqhpu8hdnBfxZ7iRqItW1Dou', 'admin'),
                (2, 'matias@email.com', '$2y$10$'NqrD5XR954nuZPsfs8rRzeOBVAdBLfEVaYj2gHFVaNPpCOLJjxDC.', 'admin'),
                (3, 'guest@email.com', '$2y$10$'a2R1d1falFvRJc0hm0knWeZygzcgHnpXXQ2FtjWy59Ny5jJ8D9jhW', 'user'),
                (4, 'webadmin', '$2y$10$'b095X3XhrDjPwzbj3BgwiuN.1RyATcDddARL7yxi5.pBuLItt4w9K', 'admin');

                --
                -- Índices para tablas volcadas
                --

                --
                -- Indices de la tabla `discos`
                --
                ALTER TABLE `discos`
                ADD PRIMARY KEY (`id`);

                --
                -- Indices de la tabla `users`
                --
                ALTER TABLE `users`
                ADD PRIMARY KEY (`id`);

                --
                -- AUTO_INCREMENT de las tablas volcadas
                --

                --
                -- AUTO_INCREMENT de la tabla `discos`
                --
                ALTER TABLE `discos`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

                --
                -- AUTO_INCREMENT de la tabla `users`
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
    
                    