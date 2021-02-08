-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-07-2020 a las 21:15:22
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `facesegurity2.0`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `registraradministrador` (IN `idadmi` INT, IN `nom` TEXT, IN `fkpefid` INT, IN `emausu` VARCHAR(100), IN `pasusu` VARCHAR(100))  insert into administrador(id_admi,nom,pefid,emausu,pasusu)values
(idadmi,nom,fkpefid,emausu,pasusu)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarcargo` (IN `id_cargo` VARCHAR(30), IN `tip_cargo` VARCHAR(30), IN `nom_cargo` TEXT, IN `fec_cargo` DATE, IN `estado` VARCHAR(30))  insert into cargo(id_cargo,tip_cargo,nom_cargo,fec_cargo,estado)values
(id_cargo,tip_cargo,nom_cargo,fec_cargo,estado)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrardependencia` (`iddependencia` INT, `nom` TEXT, `correo` VARCHAR(45), `activi` TEXT, `nove` TEXT, `empnit` INT)  insert into dependencia(id_dependencia,nom,correo,activi,nove,emp_nit)values
(iddependencia,nom,correo,activi,nove,empnit)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrardocumento` (IN `iddoc` INT, IN `nom` TEXT, IN `autdoc` TEXT, IN `feccrea` DATE, IN `idemp` INT, IN `id_tpdoc` INT)  insert into documento(id_doc,nom,aut_doc,fec_crea,id_emp,id_tpdoc)values
(iddoc,nom,autdoc,feccrea,idemp,id_tpdoc)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarempleado` (IN `idemp` INT, IN `nomb` TEXT, IN `apelli` TEXT, IN `correo` VARCHAR(45), IN `emausu` VARCHAR(100), IN `pasusu` VARCHAR(100), IN `idcargo` INT, IN `inicont` DATE, IN `direc` VARCHAR(35), IN `tel` INT, IN `genero` TEXT, IN `foto` VARCHAR(45), IN `estado` VARCHAR(35), IN `iddependencia` INT, IN `pefid` INT)  insert into empleado(id_emp,nomb,apelli,correo,emausu,pasusu,id_cargo,ini_cont,direc,tel,genero,foto,estado,id_dependencia,pefid)values
(idemp,nomb,apelli,correo,emausu,pasusu,idcargo,inicont,direc,tel,genero,foto,estado,iddependencia,pefid)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarempresa` (IN `empnit` INT, IN `nomemp` TEXT, IN `direc` VARCHAR(35), IN `ciudad` TEXT, IN `tel` INT, IN `nomrepre` TEXT, IN `correorepre` VARCHAR(45), IN `razsoci` VARCHAR(45), IN `sectecon` TEXT, IN `descemp` TEXT, IN `idadmi` INT, IN `pefid` INT, IN `idtipemp` INT, IN `emausu` VARCHAR(100), IN `pasusu` VARCHAR(100))  INSERT INTO
empresa(emp_nit,nom_emp,direc,ciudad,tel,nom_repre,correo_repre,raz_soci,sect_econ,desc_emp,id_admi,pefid,idtipemp,emausu,pasusu)VALUES
(empnit,nomemp,direc,ciudad,tel,nomrepre,correorepre,razsoci,sectecon,descemp,idadmi,pefid,idtipemp,emausu,pasusu)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarpagina` (`pag_id` BIGINT, `pag_nom` VARCHAR(40), `pag_arc` VARCHAR(100), `pag_mos` INT, `pag_ord` INT, `pag_men` VARCHAR(10))  insert into pagina (pagid,pagnom,pagarc,pagmos,pagord,pagmen)values
(pag_id,pag_nom,pag_arc,pag_mos,pag_ord,pag_men)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarperfil` (IN `pefid` INT, IN `pefnom` VARCHAR(30))  insert into perfil(pefid,pefnom)values
(pefid,pefnom)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrartipodocumento` (IN `idtpdoc` INT, IN `nomtpdoc` VARCHAR(30), IN `ext` VARCHAR(30))  insert into tipo_documento (id_tpdoc,nom_tpdoc,extencion)values
(idtpdoc,nomtpdoc,ext)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrartipoempresa` (`idtipemp` INT, `tipoemp` VARCHAR(45), `sector` VARCHAR(45), `procapital` VARCHAR(45), `ambactuacion` VARCHAR(45))  insert into tipoempresa (idtipemp,tipo_emp,sector,procapital,ambactuacion)values
(idtipemp,tipoemp,sector,procapital,ambactuacion)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `valida_empleado` (IN `user` VARCHAR(100), IN `pass` VARCHAR(100))  BEGIN
SELECT a.id_emp, a.nomb, a.pefid, p.pefnom, p.pefbus, p.pefdes, p.pefedi, p.pefeli FROM empleado AS a INNER JOIN perfil AS p ON a.pefid=p.pefid WHERE a.emausu=user AND a.pasusu=pass;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `valida_empresa` (IN `user` VARCHAR(100), IN `pass` VARCHAR(100))  BEGIN
SELECT a.emp_nit, a.nom_emp, a.pefid, p.pefnom, p.pefbus, p.pefdes, p.pefedi, p.pefeli FROM empresa AS a INNER JOIN perfil AS p ON a.pefid=p.pefid WHERE a.emausu=user AND a.pasusu=pass;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `valida_usu` (IN `user` VARCHAR(100), IN `pass` VARCHAR(100))  BEGIN
SELECT a.id_admi, a.nom, a.pefid, p.pefnom, p.pefbus, p.pefdes, p.pefedi, p.pefeli FROM administrador AS a INNER JOIN perfil AS p ON a.pefid=p.pefid WHERE a.emausu=user AND a.pasusu=pass;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id_admi` int(11) NOT NULL,
  `nom` text NOT NULL,
  `pefid` int(11) NOT NULL,
  `emausu` varchar(100) NOT NULL,
  `pasusu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id_admi`, `nom`, `pefid`, `emausu`, `pasusu`) VALUES
(1, 'Duvan', 2, 'duvan@gmail.com', '952a7c238933b79813ee1e70179d52635c0b6c7c'),
(2, 'Santiago', 2, 'santi@gmail.com', 'a9522e54c81a2b6058365dac919d1fa18dd54d9d'),
(3, 'Deisy', 2, 'dary@gmail.com', '5dd3770a6852536fadbc5c0581d6509d06c08b30');

--
-- Disparadores `administrador`
--
DELIMITER $$
CREATE TRIGGER `Actualizaradministrador` AFTER UPDATE ON `administrador` FOR EACH ROW INSERT INTO auditoria(nomtbl, datos_new_old, modif, proceso)
VALUES ("administrador",concat(OLD.id_admi,"-",OLD.nom,"-",OLD.pefid,"-",OLD.emausu,"-",OLD.pasusu,"-",NEW.id_admi,"-",NEW.nom,"-",NEW.pefid,"-",NEW.emausu,"-",NEW.pasusu),NOW(),"Actualización")
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Eliminaradministrador` AFTER DELETE ON `administrador` FOR EACH ROW INSERT INTO auditoria(nomtbl, datos_new_old, modif, proceso)
VALUES ("administrador",concat(OLD.id_admi,"-",OLD.nom,"-",OLD.pefid,"-",OLD.emausu,"-",OLD.pasusu),NOW(),"Eliminación")
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE `auditoria` (
  `idusu` int(5) NOT NULL,
  `nomtbl` varchar(50) DEFAULT NULL,
  `datos_new_old` varchar(1000) DEFAULT NULL,
  `modif` datetime DEFAULT NULL,
  `proceso` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `auditoria`
--

INSERT INTO `auditoria` (`idusu`, `nomtbl`, `datos_new_old`, `modif`, `proceso`) VALUES
(0, 'administrador', '1-Duvan-2-duvan@gmail.com-952a7c238933b79813ee1e70179d52635c0b6c7c-1-Duvan-2-duvan@gmail.com-952a7c238933b79813ee1e70179d52635c0b6c7c', '2020-07-17 16:20:23', 'Actualización'),
(0, 'empresa', '1-Psi-cra 12 No34-34-Bogota-1-Luchini-luchini@gmail.com-representante-industrial-bebidas gaseosas-1-2-1-psi@gmail.com-362e23c2483147bb81d3f37228b81043ddf9df07-1-Psi-cra 12 No34-34-Bogota-1-Luchini-luchini@gmail.com-representante-industrial-bebidas gaseosas-1-2-1-psi@gmail.com-362e23c2483147bb81d3f37228b81043ddf9df07', '2020-07-17 16:42:45', 'Actualización'),
(0, 'perfil', '2-administardor-1-1-1-1-2-administardor-1-1-1-1', '2020-07-17 16:43:01', 'Actualización'),
(0, 'perfil', '2-administardor-1-1-1-1-2-administardor-1-1-1-1', '2020-07-17 16:43:01', 'Actualización'),
(0, 'perfil', '2-administardor-1-1-1-1-2-administardor-1-1-1-1', '2020-07-17 16:43:01', 'Actualización'),
(0, 'perfil', '2-administardor-1-1-1-1-2-administardor-1-1-1-1', '2020-07-17 16:43:01', 'Actualización'),
(0, 'perfil', '2-administardor-1-1-1-1-2-administardor-1-1-1-1', '2020-07-17 16:43:01', 'Actualización'),
(0, 'perfil', '3-empleado -1-1-1-1-3-empleado -1-1-1-1', '2020-07-17 16:54:58', 'Actualización'),
(0, 'perfil', '3-empleado -1-1-1-1-3-empleado -1-1-1-1', '2020-07-17 16:54:58', 'Actualización'),
(0, 'perfil', '3-empleado -1-1-1-1-3-empleado -1-1-1-1', '2020-07-17 16:54:58', 'Actualización'),
(0, 'perfil', '3-empleado -1-1-1-1-3-empleado -1-1-1-1', '2020-07-17 16:54:58', 'Actualización'),
(0, 'perfil', '3-empleado -1-1-1-1-3-empleado -1-1-1-0', '2020-07-17 16:54:58', 'Actualización'),
(0, 'empresa', '1-Psi-cra 12 No34-34-Bogota-1-Luchini-luchini@gmail.com-representante-industrial-bebidas gaseosas-1-2-1-psi@gmail.com-362e23c2483147bb81d3f37228b81043ddf9df07-1-Psi-cra 12 No34-34-Bogota-1-Luchini-luchini@gmail.com-representante-industrial-bebidas gaseosas-1-4-1-psi@gmail.com-f0254cd8ea03bbe979b2ce9dd1df09bf7f995b6e', '2020-07-17 18:19:35', 'Actualización'),
(0, 'empresa', '1-Psi-cra 12 No34-34-Bogota-1-Luchini-luchini@gmail.com-representante-industrial-bebidas gaseosas-1-4-1-psi@gmail.com-f0254cd8ea03bbe979b2ce9dd1df09bf7f995b6e-1-Psi-cra 12 No34-34-Bogota-1-Luchini-luchini@gmail.com-representante-industrial-bebidas gaseosas-1-4-1-psi@gmail.com-362e23c2483147bb81d3f37228b81043ddf9df07', '2020-07-17 18:24:35', 'Actualización'),
(0, 'tipodocumento', '1Textotxt, doc, docx1Textotxt, doc, docx', '2020-07-17 18:53:12', 'Actualizacion'),
(0, 'pagina', '1Administradorvista/vadministrador.php11Home1Administradorvista/vadministrador.php11Home', '2020-07-17 18:57:49', 'Actualizacion'),
(0, 'tipoempresa', '1Micro TercearioPublicaNacional1Micro TercearioPublicaNacional', '2020-07-17 19:00:19', 'Actualizacion'),
(0, 'cargo', '11Auxiliar Auxiliar2020-06-29Inactivo 11Auxiliar Auxiliar2020-06-29Inactivo ', '2020-07-17 19:02:21', 'Actualizacion'),
(0, 'documento', '1Papeleomaii2020-07-14111Papeleomaii2020-07-1411', '2020-07-17 19:04:53', 'Actualizaci?n'),
(0, 'dependencia', '1Administracionadministracion@gmail.comControl y Logisticaninguna11Administracionadministracion@gmail.comControl y Logisticaninguna1', '2020-07-17 19:10:46', 'Actualizaci?n'),
(0, 'empleado', '1DuvanLozano Romeroduvanlozanoromero@gmail.comduvanlozanoromero@gmail.com0937afa17f4dc08f3c0e5dc908158370ce64df86112020-06-16cra 12 No34-341masculinofoto.jpgActivo 131DuvanLozano Romeroduvanlozanoromero@gmail.comduvanlozanoromero@gmail.com0937afa17f4dc08f3c0e5dc908158370ce64df86112020-06-16cra 12 No34-341masculinofoto.jpgActivo 13', '2020-07-17 19:27:16', 'Actualizaci?n'),
(0, 'pagina', '2Empresavista/vempresa.php12Home2Empresavista/vempresa.php12Home', '2020-07-18 14:20:02', 'Actualizacion'),
(0, 'pagina', '3Empleadovista/vempleado.php13Home3Empleadovista/vempleado.php13Home', '2020-07-18 14:22:08', 'Actualizacion'),
(0, 'pagina', '4Dependenciavista/vdependencia.php14Home4Dependenciavista/vdependencia.php14Home', '2020-07-18 14:24:21', 'Actualizacion'),
(0, 'pagina', '5Documentovista/vdocumento.php15Home5Documentovista/vdocumento.php15Home', '2020-07-18 14:25:24', 'Actualizacion'),
(0, 'pagina', '6Cargovista/vcargo.php16Home6Cargovista/vcargo.php16Home', '2020-07-18 14:27:13', 'Actualizacion'),
(0, 'pagina', '7Paginavista/vpag.php17Home7Paginavista/vpag.php17Home', '2020-07-18 14:27:53', 'Actualizacion'),
(0, 'pagina', '8Perfilvista/vpef.php18Home8Perfilvista/vpef.php18Home', '2020-07-18 14:28:39', 'Actualizacion'),
(0, 'pagina', '9Tipo de Empresavista/vtipoempresa.php19Home9Tipo de Empresavista/vtipoempresa.php19Home', '2020-07-18 14:29:18', 'Actualizacion'),
(0, 'pagina', '10Tipo de Documentovista/vtipo_documento.php110Home10Tipo de Documentovista/vtipo_documento.php110Home', '2020-07-18 14:29:51', 'Actualizacion'),
(0, 'pagina', '101Iniciohome.php1101Index101Iniciohome.php1101Index', '2020-07-18 14:31:03', 'Actualizacion'),
(0, 'pagina', '150Salirvista/vsalir.php1150Home150Salirvista/vsalir.php1150Home', '2020-07-18 14:31:52', 'Actualizacion'),
(0, 'pagina', '7Paginavista/vpag.php17Home7Paginavista/vpag.php17Home', '2020-07-18 14:34:08', 'Actualizacion'),
(0, 'pagina', '7Paginavista/vpag.php17Home7Paginavista/vpag.php17Home', '2020-07-18 14:34:13', 'Actualizacion'),
(0, 'pagina', '10Tipo de Documentovista/vtipo_documento.php110Home10Tipo de Documentovista/vtipo_documento.php110Home', '2020-07-18 14:36:13', 'Actualizacion'),
(0, 'pagina', '10Tipo de Documentovista/vtipo_documento.php110Home10Tipo de Documentovista/vtipo_documento.php110Home', '2020-07-18 14:36:17', 'Actualizacion'),
(0, 'perfil', '3-empleado -1-1-1-0-3-empleado -1-1-1-1', '2020-07-19 08:28:18', 'Actualización'),
(0, 'perfil', '3-empleado -1-1-1-1-3-empleado -1-1-1-2', '2020-07-19 08:28:21', 'Actualización'),
(0, 'pagina', '112perfilvista/vpef.php1112Home', '2020-07-19 08:31:32', 'Eliminacion'),
(0, 'perfil', '3-empleado -1-1-1-2-3-empleado -1-1-1-1', '2020-07-19 08:32:33', 'Actualización'),
(0, 'perfil', '2-administardor-1-1-1-1-2-administardor-1-1-1-2', '2020-07-19 08:32:36', 'Actualización'),
(0, 'perfil', '2-administardor-1-1-1-2-2-administardor-1-1-1-1', '2020-07-19 08:32:56', 'Actualización'),
(0, 'perfil', '4-empresa-1-1-1-1-4-empresa-1-1-2-1', '2020-07-19 08:34:16', 'Actualización'),
(0, 'perfil', '4-empresa-1-1-2-1-4-empresa-1-1-1-1', '2020-07-19 08:34:18', 'Actualización'),
(0, 'perfil', '2-administardor-1-1-1-1-2-administardor-1-1-1-2', '2020-07-19 09:06:34', 'Actualización'),
(0, 'perfil', '2-administardor-1-1-1-2-2-administardor-1-1-1-1', '2020-07-19 09:07:24', 'Actualización'),
(0, 'perfil', '2-administardor-1-1-1-1-2-administardor-1-1-2-1', '2020-07-19 09:07:26', 'Actualización'),
(0, 'perfil', '2-administardor-1-1-2-1-2-administardor-1-1-2-2', '2020-07-19 09:07:28', 'Actualización'),
(0, 'perfil', '2-administardor-1-1-2-2-2-administardor-1-1-2-1', '2020-07-19 09:07:49', 'Actualización'),
(0, 'perfil', '2-administardor-1-1-2-1-2-administardor-1-1-1-1', '2020-07-19 09:07:51', 'Actualización'),
(0, 'perfil', '2-administardor-1-1-1-1-2-administardor-1-1-1-2', '2020-07-19 09:24:10', 'Actualización'),
(0, 'perfil', '2-administardor-1-1-1-2-2-administardor-1-1-2-2', '2020-07-19 09:25:21', 'Actualización'),
(0, 'perfil', '2-administardor-1-1-2-2-2-administardor-1-1-2-1', '2020-07-19 09:26:03', 'Actualización'),
(0, 'perfil', '2-administardor-1-1-2-1-2-administardor-1-1-1-1', '2020-07-19 09:26:04', 'Actualización'),
(0, 'perfil', '4-empresa-1-1-1-1-4-empresa-1-1-1-2', '2020-07-19 09:26:07', 'Actualización'),
(0, 'perfil', '3-empleado -1-1-1-1-3-empleado -1-1-1-2', '2020-07-19 09:26:09', 'Actualización'),
(0, 'perfil', '3-empleado -1-1-1-2-3-empleado -1-1-2-2', '2020-07-19 09:26:11', 'Actualización'),
(0, 'perfil', '3-empleado -1-1-2-2-3-empleado -1-1-1-2', '2020-07-19 09:26:56', 'Actualización'),
(0, 'perfil', '3-empleado -1-1-1-2-3-empleado -1-1-1-1', '2020-07-19 09:26:58', 'Actualización'),
(0, 'perfil', '3-empleado -1-1-1-1-3-empleado -1-1-2-1', '2020-07-19 09:27:01', 'Actualización'),
(0, 'perfil', '3-empleado -1-1-2-1-3-empleado -1-1-2-2', '2020-07-19 09:27:02', 'Actualización');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id_cargo` int(11) NOT NULL,
  `tip_cargo` varchar(30) NOT NULL,
  `nom_cargo` varchar(30) NOT NULL,
  `fec_cargo` date NOT NULL,
  `estado` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id_cargo`, `tip_cargo`, `nom_cargo`, `fec_cargo`, `estado`) VALUES
(11, 'Auxiliar ', 'Auxiliar', '2020-06-29', 'Inactivo '),
(12, 'Auxiliar Contable', 'auxiliar logico', '2020-06-16', 'Inactivo '),
(13, 'Jefe', 'Jefe principal', '2020-06-30', 'Activo '),
(14, 'Gerente', 'Gerente de ventas', '2020-06-09', 'Activo ');

--
-- Disparadores `cargo`
--
DELIMITER $$
CREATE TRIGGER `actualizarcargo` AFTER UPDATE ON `cargo` FOR EACH ROW INSERT INTO auditoria(nomtbl, datos_new_old, modif, proceso)
values("cargo",concat(old.id_cargo,old.tip_cargo,old.nom_cargo,old.fec_cargo,old.estado,new.id_cargo,new.tip_cargo,new.nom_cargo,new.fec_cargo,new.estado),NOW(),"Actualizacion")
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `eliminarcargo` AFTER DELETE ON `cargo` FOR EACH ROW INSERT INTO auditoria(nomtbl, datos_new_old, modif, proceso)
values("cargo",concat(old.id_cargo,old.tip_cargo,old.nom_cargo,old.fec_cargo,old.estado),NOW(),"Eliminacion")
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependencia`
--

CREATE TABLE `dependencia` (
  `id_dependencia` int(11) NOT NULL,
  `nom` text NOT NULL,
  `correo` varchar(45) NOT NULL,
  `activi` text NOT NULL,
  `nove` text NOT NULL,
  `emp_nit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dependencia`
--

INSERT INTO `dependencia` (`id_dependencia`, `nom`, `correo`, `activi`, `nove`, `emp_nit`) VALUES
(1, 'Administracion', 'administracion@gmail.com', 'Control y Logistica', 'ninguna', 1),
(2, 'Productiva', 'Productiva@gmail.com', 'Elavoracion', 'inactivo', 3),
(3, 'Logistica', 'Logistica@gmail.com', 'Vigilar', 'Laborando', 4),
(4, 'Comercial', 'Comercial@gmail.com', 'Ventas ', 'ninguna', 5),
(5, 'Servicio', 'servicio@gmail.com', 'Prestacion de servicios', 'Laborando', 2);

--
-- Disparadores `dependencia`
--
DELIMITER $$
CREATE TRIGGER `actualizardependencia` AFTER UPDATE ON `dependencia` FOR EACH ROW INSERT INTO auditoria(nomtbl, datos_new_old, modif, proceso)
values("dependencia",concat(old.id_dependencia,old.nom,old.correo,old.activi,old.nove,old.emp_nit,new.id_dependencia,new.nom,new.correo,new.activi,new.nove,new.emp_nit),NOW(),"Actualizaci?n")
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `eliminardependencia` AFTER DELETE ON `dependencia` FOR EACH ROW INSERT INTO auditoria(nomtbl, datos_new_old, modif, proceso)
values("dependencia",concat(old.id_dependencia,old.nom,old.correo,old.activi,old.nove,old.emp_nit),NOW(),"eliminacion")
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `id_doc` int(11) NOT NULL,
  `nom` text NOT NULL,
  `aut_doc` text NOT NULL,
  `fec_crea` date NOT NULL,
  `id_emp` int(11) NOT NULL,
  `id_tpdoc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `documento`
--

INSERT INTO `documento` (`id_doc`, `nom`, `aut_doc`, `fec_crea`, `id_emp`, `id_tpdoc`) VALUES
(1, 'Papeleo', 'maii', '2020-07-14', 1, 1),
(2, 'aiudaaa', 'antonio', '2020-07-29', 2, 7);

--
-- Disparadores `documento`
--
DELIMITER $$
CREATE TRIGGER `actualizardocumento` AFTER UPDATE ON `documento` FOR EACH ROW INSERT INTO auditoria(nomtbl, datos_new_old, modif, proceso)
values("documento",concat(old.id_doc,old.nom,old.aut_doc,old.fec_crea,old.id_emp,old.id_tpdoc,new.id_doc,new.nom,new.aut_doc,new.fec_crea,new.id_emp,new.id_tpdoc),NOW(),"Actualizaci?n")
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `eliminardocumento` AFTER DELETE ON `documento` FOR EACH ROW INSERT INTO auditoria(nomtbl, datos_new_old, modif, proceso)
values("documento", concat(old.id_doc,old.nom,old.aut_doc,old.fec_crea,old.id_emp,old.id_tpdoc),NOW(),"Eliminaci?n")
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_emp` int(11) NOT NULL,
  `nomb` text NOT NULL,
  `apelli` text NOT NULL,
  `correo` varchar(45) NOT NULL,
  `emausu` varchar(100) NOT NULL,
  `pasusu` varchar(100) NOT NULL,
  `id_cargo` int(11) NOT NULL,
  `ini_cont` date NOT NULL,
  `direc` varchar(35) NOT NULL,
  `tel` int(11) NOT NULL,
  `genero` text NOT NULL,
  `foto` varchar(45) NOT NULL,
  `estado` varchar(35) NOT NULL,
  `id_dependencia` int(11) NOT NULL,
  `pefid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_emp`, `nomb`, `apelli`, `correo`, `emausu`, `pasusu`, `id_cargo`, `ini_cont`, `direc`, `tel`, `genero`, `foto`, `estado`, `id_dependencia`, `pefid`) VALUES
(1, 'Duvan', 'Lozano Romero', 'duvanlozanoromero@gmail.com', 'duvanlozanoromero@gmail.com', '0937afa17f4dc08f3c0e5dc908158370ce64df86', 11, '2020-06-16', 'cra 12 No34-34', 1, 'masculino', 'foto.jpg', 'Activo ', 1, 3),
(2, 'Felipe', 'Salamanca Porra', 'gatito@gmail.com', 'Busetero', 'df2cd7104536553afde9f7d66133d578eccb4606', 11, '2020-06-02', 'cra 12 No34-34', 2, 'masculino', 'foto2.jpg', 'Inactivo ', 1, 2),
(3, 'Melissa', 'Lozano Romero', 'melisadayana@gmail.com', 'melisa@gmail.com', 'b6a9bd1071d37d92d43c22131e0b16c8781d8b82', 11, '2020-07-22', 'cra 12 No34-34', 3, 'Femenino', 'foto2.jpg', 'Activo ', 1, 3);

--
-- Disparadores `empleado`
--
DELIMITER $$
CREATE TRIGGER `actuliazarempleado` AFTER UPDATE ON `empleado` FOR EACH ROW INSERT INTO auditoria(nomtbl, datos_new_old, modif, proceso)
values("empleado", concat(old.id_emp,old.nomb,old.apelli,old.correo,old.emausu,old.pasusu,old.id_cargo,old.ini_cont,old.direc,old.tel,old.genero,old.foto,old.estado,old.id_dependencia,old.pefid,new.id_emp,new.nomb,new.apelli,new.correo,new.emausu,new.pasusu,new.id_cargo,new.ini_cont,new.direc,new.tel,new.genero,new.foto,new.estado,new.id_dependencia,new.pefid),NOW(),"Actualizaci?n")
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `eliminarempleado` AFTER DELETE ON `empleado` FOR EACH ROW INSERT INTO auditoria(nomtbl, datos_new_old, modif, proceso)
values("empleado", concat(old.id_emp,old.nomb,old.apelli,old.correo,old.emausu,old.pasusu,old.id_cargo,old.ini_cont,old.direc,old.tel,old.genero,old.foto,old.estado,old.id_dependencia,old.pefid),NOW(),"Eliminaci?n")
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `emp_nit` int(11) NOT NULL,
  `nom_emp` text NOT NULL,
  `direc` varchar(35) NOT NULL,
  `ciudad` text NOT NULL,
  `tel` int(11) NOT NULL,
  `nom_repre` text NOT NULL,
  `correo_repre` varchar(45) NOT NULL,
  `raz_soci` varchar(45) NOT NULL,
  `sect_econ` text NOT NULL,
  `desc_emp` text NOT NULL,
  `id_admi` int(11) NOT NULL,
  `pefid` int(11) NOT NULL,
  `idtipemp` int(11) NOT NULL,
  `emausu` varchar(100) NOT NULL,
  `pasusu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`emp_nit`, `nom_emp`, `direc`, `ciudad`, `tel`, `nom_repre`, `correo_repre`, `raz_soci`, `sect_econ`, `desc_emp`, `id_admi`, `pefid`, `idtipemp`, `emausu`, `pasusu`) VALUES
(1, 'Psi', 'cra 12 No34-34', 'Bogota', 1, 'Luchini', 'luchini@gmail.com', 'representante', 'industrial', 'bebidas gaseosas', 1, 4, 1, 'psi@gmail.com', '362e23c2483147bb81d3f37228b81043ddf9df07'),
(2, 'Coca-cola', 'Cra 34 No-12-08', 'Cali', 34267, 'Duvan', 'duvan@gmail.com', 'Dueño', 'industrial', 'bebidas gaseosas', 1, 4, 3, 'cocacola@gmail.com', '7a93f2260a777c8f2c0f16631853fd2a5fe29b66'),
(3, 'Croydon', 'Cra 10 No21-05', 'Medellin', 234577, 'Diesy', 'deisy@gmail.com', 'Representante', 'Textil', 'Venta de Zapatos ', 1, 4, 1, 'croydon@gmail.com', '94569f0c0436b915e40e323c24a9012ab51846bb'),
(4, 'ArrozDiana', 'cra 03 No20-34', 'Bogota', 234667, 'Santiago', 'santiago@gmail.com', 'Dueño', 'industrial', 'Fabricacion de alimentos procesados', 1, 4, 4, 'arrozdiana@gmail.com', '2d7fb2d13be9288d7a0175885122b92af53def5c'),
(5, 'Gomosos', 'cra 12 No 1-34', 'Barranquilla', 234556, 'melisa', 'melisa@gmail.com', 'Representante', 'Textil', 'Venta de Zapatos ', 1, 4, 2, 'gomosos@gmail.com', '5074aa35f7116ac214b86c00e7f8d2635abc2747');

--
-- Disparadores `empresa`
--
DELIMITER $$
CREATE TRIGGER `Actualizarempresa` AFTER UPDATE ON `empresa` FOR EACH ROW INSERT INTO auditoria(nomtbl, datos_new_old, modif, proceso)
VALUES ("empresa",concat(OLD.emp_nit,"-",OLD.nom_emp,"-",OLD.direc,"-",OLD.ciudad,"-",OLD.tel,"-",OLD.nom_repre,"-",OLD.correo_repre,"-",OLD.raz_soci,"-",OLD.sect_econ,"-",OLD.desc_emp,"-",OLD.id_admi,"-",OLD.pefid,"-",OLD.idtipemp,"-",OLD.emausu,"-",OLD.pasusu,"-",NEW.emp_nit,"-",NEW.nom_emp,"-",NEW.direc,"-",NEW.ciudad,"-",NEW.tel,"-",NEW.nom_repre,"-",NEW.correo_repre,"-",NEW.raz_soci,"-",NEW.sect_econ,"-",NEW.desc_emp,"-",NEW.id_admi,"-",NEW.pefid,"-",NEW.idtipemp,"-",NEW.emausu,"-",NEW.pasusu),NOW(),"Actualización")
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Eliminarempresa` AFTER DELETE ON `empresa` FOR EACH ROW INSERT INTO auditoria(nomtbl, datos_new_old, modif, proceso)
VALUES ("empresa",concat(OLD.emp_nit,"-",OLD.nom_emp,"-",OLD.direc,"-",OLD.ciudad,"-",OLD.tel,"-",OLD.nom_repre,"-",OLD.correo_repre,"-",OLD.raz_soci,"-",OLD.sect_econ,"-",OLD.desc_emp,"-",OLD.id_admi,"-",OLD.pefid,"-",OLD.idtipemp,"-",OLD.emausu,"-",OLD.pasusu),NOW(),"Eliminación")
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagina`
--

CREATE TABLE `pagina` (
  `pagid` bigint(20) NOT NULL,
  `pagnom` varchar(40) NOT NULL,
  `pagarc` varchar(100) NOT NULL,
  `pagmos` int(11) NOT NULL,
  `pagord` int(11) NOT NULL,
  `pagmen` varchar(10) NOT NULL,
  `icono` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pagina`
--

INSERT INTO `pagina` (`pagid`, `pagnom`, `pagarc`, `pagmos`, `pagord`, `pagmen`, `icono`) VALUES
(1, 'Administrador', 'vista/vadministrador.php', 1, 1, 'Home', 'fa fa-user fa lg'),
(2, 'Empresa', 'vista/vempresa.php', 1, 2, 'Home', 'fa fa-briefcase fa lg'),
(3, 'Empleado', 'vista/vempleado.php', 1, 3, 'Home', 'fa fa-users fa lg'),
(4, 'Dependencia', 'vista/vdependencia.php', 1, 4, 'Home', 'fa fa-tags fa lg'),
(5, 'Documento', 'vista/vdocumento.php', 1, 5, 'Home', 'fa fa-file-text fa lg'),
(6, 'Cargo', 'vista/vcargo.php', 1, 6, 'Home', 'fa fa-cubes fa lg'),
(7, 'Pagina', 'vista/vpag.php', 1, 7, 'Home', 'fa fa-folder-open fa lg'),
(8, 'Perfil', 'vista/vpef.php', 1, 8, 'Home', 'fa fa-address-book fa lg'),
(9, 'Tipo de Empresa', 'vista/vtipoempresa.php', 1, 9, 'Home', 'fa fa-building fa lg'),
(10, 'Tipo de Documento', 'vista/vtipo_documento.php', 1, 10, 'Home', 'fa fa-clipboard fa lg'),
(101, 'Inicio', 'home.php', 1, 101, 'Index', 'fa fa-play fa lg'),
(150, 'Salir', 'vista/vsalir.php', 1, 150, 'Home', 'fa fa-sign-out fa lg');

--
-- Disparadores `pagina`
--
DELIMITER $$
CREATE TRIGGER `actualizarpagina` AFTER UPDATE ON `pagina` FOR EACH ROW INSERT INTO auditoria(nomtbl, datos_new_old, modif, proceso)
values("pagina",concat(old.pagid,old.pagnom,old.pagarc,old.pagmos,old.pagord,old.pagmen,new.pagid,new.pagnom,new.pagarc,new.pagmos,new.pagord,new.pagmen),NOW(),"Actualizacion")
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `eliminarpagina` AFTER DELETE ON `pagina` FOR EACH ROW INSERT INTO auditoria(nomtbl, datos_new_old, modif, proceso)
values("pagina",concat(old.pagid,old.pagnom,old.pagarc,old.pagmos,old.pagord,old.pagmen),NOW(),"Eliminacion")
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagper`
--

CREATE TABLE `pagper` (
  `pagid` bigint(20) NOT NULL,
  `pefid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pagper`
--

INSERT INTO `pagper` (`pagid`, `pefid`) VALUES
(5, 3),
(150, 3),
(10, 3),
(101, 3),
(4, 4),
(5, 4),
(3, 4),
(150, 4),
(101, 4),
(1, 2),
(6, 2),
(4, 2),
(5, 2),
(3, 2),
(2, 2),
(7, 2),
(8, 2),
(150, 2),
(10, 2),
(9, 2),
(101, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `pefid` int(11) NOT NULL,
  `pefnom` varchar(30) NOT NULL,
  `pefbus` tinyint(1) NOT NULL,
  `pefdes` tinyint(1) NOT NULL,
  `pefedi` tinyint(1) NOT NULL,
  `pefeli` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`pefid`, `pefnom`, `pefbus`, `pefdes`, `pefedi`, `pefeli`) VALUES
(2, 'administardor', 1, 1, 1, 1),
(3, 'empleado ', 1, 1, 2, 2),
(4, 'empresa', 1, 1, 1, 2);

--
-- Disparadores `perfil`
--
DELIMITER $$
CREATE TRIGGER `Actualizarperfil` AFTER UPDATE ON `perfil` FOR EACH ROW INSERT INTO auditoria(nomtbl, datos_new_old, modif, proceso)
VALUES ("perfil",concat(OLD.pefid,"-",OLD.pefnom,"-",OLD.pefbus,"-",OLD.pefdes,"-",OLD.pefedi,"-",OLD.pefeli,"-",NEW.pefid,"-",NEW.pefnom,"-",NEW.pefbus,"-",NEW.pefdes,"-",NEW.pefedi,"-",NEW.pefeli),NOW(),"Actualización")
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Eliminarperfil` AFTER DELETE ON `perfil` FOR EACH ROW INSERT INTO auditoria(nomtbl, datos_new_old, modif, proceso)
VALUES ("perfil",concat(OLD.pefid,"-",OLD.pefnom,"-",OLD.pefbus,"-",OLD.pefdes,"-",OLD.pefedi,"-",OLD.pefeli),NOW(),"Eliminación")
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoempresa`
--

CREATE TABLE `tipoempresa` (
  `idtipemp` int(11) NOT NULL,
  `tipo_emp` varchar(45) NOT NULL,
  `sector` varchar(45) NOT NULL,
  `procapital` varchar(45) NOT NULL,
  `ambactuacion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipoempresa`
--

INSERT INTO `tipoempresa` (`idtipemp`, `tipo_emp`, `sector`, `procapital`, `ambactuacion`) VALUES
(1, 'Micro ', 'Terceario', 'Publica', 'Nacional'),
(2, 'Pequeña', 'Primario', 'Privada', 'Local'),
(3, 'Mediana', 'Secundario', 'Mixta', 'Multinacional'),
(4, 'Grande', 'Primario', 'Publica', 'Nacional');

--
-- Disparadores `tipoempresa`
--
DELIMITER $$
CREATE TRIGGER `actualizartipoempresa` AFTER UPDATE ON `tipoempresa` FOR EACH ROW INSERT INTO auditoria(nomtbl, datos_new_old, modif, proceso)
values("tipoempresa",concat(old.idtipemp,old.tipo_emp,old.sector,old.procapital,old.ambactuacion,new.idtipemp,new.tipo_emp,new.sector,new.procapital,new.ambactuacion),NOW(),"Actualizacion")
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `eliminartipoempresa` AFTER DELETE ON `tipoempresa` FOR EACH ROW INSERT INTO auditoria(nomtbl, datos_new_old, modif, proceso)
values("tipoempresa",concat(old.idtipemp,old.tipo_emp,old.sector,old.procapital,old.ambactuacion),NOW(),"Eliminacion")
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id_tpdoc` int(11) NOT NULL,
  `nom_tpdoc` varchar(30) NOT NULL,
  `extencion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id_tpdoc`, `nom_tpdoc`, `extencion`) VALUES
(1, 'Texto', 'txt, doc, docx'),
(2, 'Imagen', 'jpg, gif, bmp, png'),
(3, 'Vídeo', 'avi, mp4, mpeg, mwv'),
(4, 'Ejecución o del sistema', 'exe, bat, dll, sys'),
(5, 'Audio', 'mp3, wav, wma'),
(6, 'Archivo comprimido', 'zip, rar, tar'),
(7, 'Lectura', 'pdf, epub, azw, ibook'),
(8, 'Imagen de disco', 'iso, mds, img');

--
-- Disparadores `tipo_documento`
--
DELIMITER $$
CREATE TRIGGER `actualizartipo_documento` AFTER UPDATE ON `tipo_documento` FOR EACH ROW INSERT INTO auditoria(nomtbl, datos_new_old, modif, proceso)
values("tipodocumento",concat(old.id_tpdoc,old.nom_tpdoc,old.extencion,new.id_tpdoc,new.nom_tpdoc,new.extencion),NOW(),"Actualizacion")
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `eliminartipo_documento` AFTER DELETE ON `tipo_documento` FOR EACH ROW INSERT INTO auditoria(nomtbl, datos_new_old, modif, proceso)
values("tipodocumento",concat(old.id_tpdoc,old.nom_tpdoc,old.extencion),NOW(),"Eliminacion")
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_admi`),
  ADD KEY `pefid` (`pefid`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Indices de la tabla `dependencia`
--
ALTER TABLE `dependencia`
  ADD PRIMARY KEY (`id_dependencia`),
  ADD KEY `emp_nit` (`emp_nit`);

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`id_doc`),
  ADD KEY `id_emp` (`id_emp`),
  ADD KEY `id_tpdoc` (`id_tpdoc`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_emp`),
  ADD KEY `pefid` (`pefid`),
  ADD KEY `id_cargo` (`id_cargo`),
  ADD KEY `id_dependencia` (`id_dependencia`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`emp_nit`),
  ADD KEY `pefid` (`pefid`),
  ADD KEY `id_admi` (`id_admi`),
  ADD KEY `idtipemp` (`idtipemp`);

--
-- Indices de la tabla `pagina`
--
ALTER TABLE `pagina`
  ADD PRIMARY KEY (`pagid`);

--
-- Indices de la tabla `pagper`
--
ALTER TABLE `pagper`
  ADD KEY `pagid` (`pagid`),
  ADD KEY `pefid` (`pefid`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`pefid`);

--
-- Indices de la tabla `tipoempresa`
--
ALTER TABLE `tipoempresa`
  ADD PRIMARY KEY (`idtipemp`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id_tpdoc`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `pefid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `administrador_ibfk_1` FOREIGN KEY (`pefid`) REFERENCES `perfil` (`pefid`);

--
-- Filtros para la tabla `dependencia`
--
ALTER TABLE `dependencia`
  ADD CONSTRAINT `dependencia_ibfk_1` FOREIGN KEY (`emp_nit`) REFERENCES `empresa` (`emp_nit`);

--
-- Filtros para la tabla `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `documento_ibfk_1` FOREIGN KEY (`id_emp`) REFERENCES `empleado` (`id_emp`),
  ADD CONSTRAINT `documento_ibfk_2` FOREIGN KEY (`id_tpdoc`) REFERENCES `tipo_documento` (`id_tpdoc`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`pefid`) REFERENCES `perfil` (`pefid`),
  ADD CONSTRAINT `empleado_ibfk_2` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`id_cargo`),
  ADD CONSTRAINT `empleado_ibfk_3` FOREIGN KEY (`id_dependencia`) REFERENCES `dependencia` (`id_dependencia`);

--
-- Filtros para la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `empresa_ibfk_1` FOREIGN KEY (`pefid`) REFERENCES `perfil` (`pefid`),
  ADD CONSTRAINT `empresa_ibfk_2` FOREIGN KEY (`id_admi`) REFERENCES `administrador` (`id_admi`),
  ADD CONSTRAINT `empresa_ibfk_3` FOREIGN KEY (`idtipemp`) REFERENCES `tipoempresa` (`idtipemp`);

--
-- Filtros para la tabla `pagper`
--
ALTER TABLE `pagper`
  ADD CONSTRAINT `pagper_ibfk_1` FOREIGN KEY (`pagid`) REFERENCES `pagina` (`pagid`),
  ADD CONSTRAINT `pagper_ibfk_2` FOREIGN KEY (`pefid`) REFERENCES `perfil` (`pefid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
