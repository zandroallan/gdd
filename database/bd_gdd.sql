/*
 Navicat Premium Data Transfer

 Source Server         : 127.0.0.1
 Source Server Type    : MySQL
 Source Server Version : 80022
 Source Host           : 127.0.0.1:3306
 Source Schema         : bd_gdd

 Target Server Type    : MySQL
 Target Server Version : 80022
 File Encoding         : 65001

 Date: 13/05/2024 11:33:44
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for c_actividad_laboral
-- ----------------------------
DROP TABLE IF EXISTS `c_actividad_laboral`;
CREATE TABLE `c_actividad_laboral`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `clave` varchar(4) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `activo` bit(1) NULL DEFAULT b'1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of c_actividad_laboral
-- ----------------------------
INSERT INTO `c_actividad_laboral` VALUES (1, 'PRI', 'Privado', b'1', NULL, '2019-12-19 09:28:48', NULL);
INSERT INTO `c_actividad_laboral` VALUES (2, 'PUB', 'Publico', b'1', NULL, '2019-12-19 09:28:54', NULL);
INSERT INTO `c_actividad_laboral` VALUES (3, 'NING', 'Ninguno', b'1', NULL, '2019-12-19 09:28:54', NULL);
INSERT INTO `c_actividad_laboral` VALUES (4, 'OTR', 'Otro (especifique)', b'1', NULL, '2019-12-19 09:28:58', NULL);

-- ----------------------------
-- Table structure for c_areas
-- ----------------------------
DROP TABLE IF EXISTS `c_areas`;
CREATE TABLE `c_areas`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_dependencia` int NOT NULL,
  `subsecretaria` int NULL DEFAULT NULL,
  `direccion` int NULL DEFAULT NULL,
  `departamento` int NULL DEFAULT NULL,
  `oficina` int NULL DEFAULT NULL,
  `id_area` int NULL DEFAULT NULL,
  `id_cargo` int NOT NULL,
  `id_titulo` int NOT NULL,
  `principal` tinyint(1) NULL DEFAULT NULL,
  `area` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sexo` char(2) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ap_paterno` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ap_materno` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `folio_estructura` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `origen` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_cargo`(`id_cargo` ASC) USING BTREE,
  INDEX `id_titulo`(`id_titulo` ASC) USING BTREE,
  INDEX `subsecretaria`(`subsecretaria` ASC) USING BTREE,
  INDEX `direccion`(`direccion` ASC) USING BTREE,
  INDEX `departamento`(`departamento` ASC) USING BTREE,
  INDEX `oficina`(`oficina` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 153 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of c_areas
-- ----------------------------
INSERT INTO `c_areas` VALUES (1, 4, NULL, NULL, NULL, NULL, 1, 1, 10, 1, 'Oficina de la C. Secretaria', 'F', 'Liliana', 'Angell', 'Gonzalez', 'OS', 'Edificio', '2016-08-25 04:00:00', '2019-10-07 10:30:07', NULL);
INSERT INTO `c_areas` VALUES (2, 4, 1, NULL, NULL, NULL, 1, 6, 2, 1, 'Secretaria Particular', 'F', 'María del Rocío', 'Aguilar', 'Jiménez', 'SP', 'Edificio', '2017-02-02 06:00:00', '2019-11-14 10:27:46', NULL);
INSERT INTO `c_areas` VALUES (3, 4, 1, NULL, NULL, NULL, 1, 7, 4, 1, 'Secretaria Técnica', 'F', 'María Claudia', 'Vázquez', 'Castillejos', 'ST', 'Edificio', '2017-02-02 06:00:00', '2019-11-14 10:27:48', NULL);
INSERT INTO `c_areas` VALUES (4, 4, NULL, NULL, NULL, NULL, 2, 8, 4, 1, 'Encargada de Gestión Ejecutiva Interna', 'F', 'Ana Beatriz', 'Kanter', 'Macal', 'SP/GEI', 'Edificio', '2017-02-02 06:00:00', '2020-02-13 09:57:37', NULL);
INSERT INTO `c_areas` VALUES (5, 4, 1, NULL, NULL, NULL, 1, 8, 4, 1, 'Coordinación de Programación de Auditorías y Evaluación Interna', 'M', 'José Roberto', 'García', 'Gordillo', 'CPAyEI', 'Edificio', '2017-02-02 06:00:00', '2019-11-14 10:28:04', NULL);
INSERT INTO `c_areas` VALUES (6, 4, NULL, NULL, NULL, NULL, 5, 5, 4, 1, 'Área de Programación de Auditorías', 'F', 'Zulma del Roció', 'Nuricumbo', 'Corzo', 'CPAyEI/APA', 'Edificio', '2017-02-02 06:00:00', '2019-08-09 14:56:20', NULL);
INSERT INTO `c_areas` VALUES (7, 4, NULL, NULL, NULL, NULL, 5, 5, 2, 1, 'Área de Evaluación Interna', 'F', 'Patricia', 'Juárez', 'Nafate', 'CPAyEI/AEI', 'Edificio', '2017-02-02 06:00:00', '2019-08-09 14:56:20', NULL);
INSERT INTO `c_areas` VALUES (8, 4, 1, NULL, NULL, NULL, 1, 8, 4, 1, 'Coordinación de Enlace de Auditorías Estado-Federación', 'M', 'Diego', 'Lugo', 'Segovia', 'CEAE-F', 'Edificio', '2017-02-02 06:00:00', '2019-11-14 10:28:24', NULL);
INSERT INTO `c_areas` VALUES (9, 4, NULL, NULL, NULL, NULL, 1, 5, 2, 1, 'Oficialía de Partes', 'F', 'Grisel Isabel', 'Espinosa', 'Coello', 'OOP', 'Edificio', '2017-02-02 06:00:00', '2019-08-09 14:56:20', NULL);
INSERT INTO `c_areas` VALUES (10, 4, NULL, NULL, NULL, NULL, 1, 5, 1, 1, 'Recepción', 'F', 'Consuelo', 'Santiago', 'Mendoza', '', 'Edificio', '2017-02-02 06:00:00', '2019-08-09 14:56:20', NULL);
INSERT INTO `c_areas` VALUES (11, 4, 1, NULL, NULL, NULL, 1, 4, 2, 1, 'Unidad de Transparencia', 'F', 'Maritza del Carmen', 'Pintado ', 'Ortega', 'UT', 'Edificio', '2017-02-02 06:00:00', '2019-11-14 10:28:35', NULL);
INSERT INTO `c_areas` VALUES (12, 4, 1, NULL, NULL, NULL, 1, 4, 5, 1, 'Unidad de Apoyo Administrativo', 'M', 'Joel', 'Pereira', 'Hernandez', 'UAA', 'Edificio', '2017-02-02 06:00:00', '2019-11-14 10:28:48', NULL);
INSERT INTO `c_areas` VALUES (13, 4, 1, 12, NULL, NULL, 12, 5, 2, 1, 'Área de Recursos Humanos', 'F', 'Magally Elizabeth', 'Guillen', 'Montesinos', 'UAA/ARH', 'Edificio', '2017-02-02 06:00:00', '2019-11-14 10:38:25', NULL);
INSERT INTO `c_areas` VALUES (14, 4, 1, 12, NULL, NULL, 12, 5, 4, 0, 'Área de Recursos Financieros y Contabilidad', 'M', 'José Isidro', 'Ovando', 'Perez', 'UAA/ARFC', 'Edificio', '2017-02-02 06:00:00', '2019-11-14 10:38:25', NULL);
INSERT INTO `c_areas` VALUES (15, 4, 1, 12, NULL, NULL, 12, 5, 2, 1, 'Área de Recursos Materiales y Servicios', 'F', 'Ana Melina', 'Zárate', 'Valencia', 'UAA/ARMyS', 'Edificio', '2017-02-02 06:00:00', '2019-11-14 10:38:25', NULL);
INSERT INTO `c_areas` VALUES (16, 4, 1, NULL, NULL, NULL, 1, 4, 2, 1, 'Unidad de Informática y Desarrollo Digital', 'M', 'Rodolfo', 'Jiménez', 'Santos', 'UIyDD', 'Edificio', '2017-02-02 06:00:00', '2019-11-14 10:28:52', NULL);
INSERT INTO `c_areas` VALUES (17, 4, 1, 16, NULL, NULL, 16, 5, 3, 0, 'Área de Desarrollo de Sistemas', 'M', 'Manuel Jesús', 'Aguiar', 'Gamez', 'UIyDD/ADS', 'Edificio', '2017-02-02 06:00:00', '2019-11-14 10:39:07', NULL);
INSERT INTO `c_areas` VALUES (18, 4, 1, 16, NULL, NULL, 16, 5, 3, 0, 'Área de Servicios a Usuarios', 'M', 'Gabriel', 'Narcia', 'Gómez', 'UIyDD/ASU', 'Edificio', '2017-02-02 06:00:00', '2019-11-14 10:39:07', NULL);
INSERT INTO `c_areas` VALUES (19, 4, 1, 16, NULL, NULL, 16, 5, 3, 0, 'Área de Diseño E Imagen', 'M', 'Calixto David', 'Gutiérrez', 'Gomez', 'UIyDD/ADI', 'Edificio', '2017-02-02 06:00:00', '2019-11-14 10:39:07', NULL);
INSERT INTO `c_areas` VALUES (20, 4, NULL, 16, NULL, NULL, 16, 5, 3, 0, 'Área de Firma Electrónica', 'M', 'Roberto David', 'Hernández', 'Martinez', 'UIyDD/AFE', 'Edificio', '2017-02-02 06:00:00', '2019-12-27 11:08:14', NULL);
INSERT INTO `c_areas` VALUES (21, 4, 1, NULL, NULL, NULL, 1, 4, 3, 1, 'Unidad de Planeación', 'M', 'Carlos Alberto', 'Jiménez', 'Aquino', 'UP', 'Edificio', '2017-02-02 06:00:00', '2019-11-14 10:29:10', NULL);
INSERT INTO `c_areas` VALUES (22, 4, NULL, NULL, NULL, NULL, 21, 5, 4, 1, 'Área de Planeación y Seguimiento Operativo', 'M', 'Humberto', 'Ross', 'Zuñiga', 'UP/APySO', 'Edificio', '2017-02-02 06:00:00', '2019-01-29 10:23:43', NULL);
INSERT INTO `c_areas` VALUES (23, 4, NULL, NULL, NULL, NULL, 21, 5, 5, 1, 'Área de Desarrollo Institucional', 'M', 'Carlos', 'López', 'Limon', 'UP/DI', 'Edificio', '2017-02-02 06:00:00', '2019-01-29 10:23:43', NULL);
INSERT INTO `c_areas` VALUES (24, 4, 1, NULL, NULL, NULL, 1, 8, 2, 1, 'Coordinación de Comisarios y Despachos Externos', 'F', 'Lorena', 'Maza', 'Leon', 'CCyDE', 'Edificio', '2017-02-02 06:00:00', '2019-11-14 10:29:19', NULL);
INSERT INTO `c_areas` VALUES (25, 4, NULL, NULL, NULL, NULL, 24, 5, 4, 1, 'Área de Supervisión de Comisarios y despachos Externos', 'F', 'Elizabeth', 'Soto', 'Figueroa', 'CCyDE', 'Edificio', '2017-02-02 06:00:00', '2019-08-09 14:56:20', NULL);
INSERT INTO `c_areas` VALUES (26, 4, 1, NULL, NULL, NULL, 1, 8, 3, 1, 'Coord. de Verificación de la Supervisión Externa de la Obra Pública Estatal', 'M', 'Ramiro', 'Flores', 'Cartagena', 'CVSEOPE\r\n', 'Edificio', '2017-02-02 06:00:00', '2019-11-14 10:29:37', NULL);
INSERT INTO `c_areas` VALUES (27, 4, NULL, NULL, NULL, NULL, 26, 5, 6, 0, 'Área de Registro de Contratistas y Supervisores de Obra Pública', 'M', 'Arturo', 'Moguel', 'Nuricumbo', 'CVSEOPE/ARCySOP', 'Edificio', '2017-02-02 06:00:00', '2019-10-08 11:16:20', NULL);
INSERT INTO `c_areas` VALUES (28, 4, NULL, NULL, NULL, NULL, 26, 5, 3, 0, 'Área de Verificación de la Supervisión Externa', 'M', 'Manlio Favio', 'Chacón', 'Sol', 'CVSEOPE/AVSEyCMC', 'Edificio', '2017-02-02 06:00:00', '2019-10-08 11:16:20', NULL);
INSERT INTO `c_areas` VALUES (29, 4, 1, NULL, NULL, NULL, 1, 2, 8, 1, 'Subsecretaría de Auditoría Pública para la Administración Centralizada', 'M', 'Antonio', 'Ovando', 'Ocaña', 'S\'SAPAC', 'Edificio', '2017-02-02 06:00:00', '2019-11-14 10:29:43', NULL);
INSERT INTO `c_areas` VALUES (30, 4, NULL, NULL, NULL, NULL, 29, 3, 4, 1, 'Dirección de  Auditoría en Dependencias \"A\"', 'M', 'Luis Roberto', 'Sánchez', 'Aguilar', 'S\'SAPAC/DAD\"A\"', 'Edificio', '2017-02-02 06:00:00', '2019-01-29 10:23:44', NULL);
INSERT INTO `c_areas` VALUES (31, 4, NULL, NULL, NULL, NULL, 30, 5, 4, 1, 'Departamento de Control y Apoyo de Auditorías a Dependencias \"A\"', 'M', 'Francisco Javier', 'Chandomi', 'Hernandez', 'S\'SAPAC/DAD\"A\"', 'Edificio', '2017-02-02 06:00:00', '2019-01-29 10:23:44', NULL);
INSERT INTO `c_areas` VALUES (32, 4, NULL, NULL, NULL, NULL, 30, 11, 3, 1, 'Contraloría de Auditoría Pública para el Sector Económico, Turismo y Transporte', 'M', 'Luis Alberto', 'Sandoval', 'Jiménez', 'S\'SAPAC/DAD\"A\"/CAPSETyT', 'Edificio', '2017-02-02 06:00:00', '2019-01-29 12:31:51', NULL);
INSERT INTO `c_areas` VALUES (33, 4, NULL, NULL, NULL, NULL, 30, 10, 9, 1, 'Contraloría Interna en la Secretaria de Hacienda', 'M', 'Jesús', 'Díaz', 'García', 'S\'SAPAC/DAD\"A\"/CISH', 'Edificio', '2017-02-02 06:00:00', '2019-01-29 12:38:14', NULL);
INSERT INTO `c_areas` VALUES (34, 4, NULL, NULL, NULL, NULL, 30, 11, 4, 1, 'Contraloría de Auditoría Pública a Fideicomisos', 'F', 'Birene', 'Chandomi', 'Escobar', 'S\'SAPAC/DAD\"A\"/CAPF', 'Edificio', '2017-02-02 06:00:00', '2019-08-09 14:56:20', NULL);
INSERT INTO `c_areas` VALUES (36, 4, NULL, NULL, NULL, NULL, 30, 11, 4, 1, 'Contraloría de Auditoría Pública para el Sector Campo', 'M', 'Miguel Ángel', 'Bautista', 'Trujillo', 'S\'SAPAC/DAD\"A\"/CAPSC', 'Edificio', '2017-02-02 06:00:00', '2019-01-29 12:38:39', NULL);
INSERT INTO `c_areas` VALUES (37, 4, NULL, NULL, NULL, NULL, 30, 14, 4, 1, 'Contraloría de Auditoría Pública para el Sector Gobierno y Planeación', 'M', 'Gerardo', 'Espinosa', 'Cifuentes', 'S\'SAPAC/DAD\"A\"/CAPSGyP\r\n', 'Edificio', '2017-02-02 06:00:00', '2019-02-19 10:41:50', NULL);
INSERT INTO `c_areas` VALUES (38, 4, NULL, NULL, NULL, NULL, 30, 11, 2, 1, 'Contraloría de Auditoría Pública para el Sector Desarrollo Social', 'M', 'Heber Antonio', 'Rincon', 'Sarmiento', 'S\'SAPAC/DAD\"A\"/CAPSDS', 'Edificio', '2017-02-02 06:00:00', '2019-02-27 13:56:11', NULL);
INSERT INTO `c_areas` VALUES (39, 4, NULL, NULL, NULL, NULL, 30, 11, 9, 1, 'Contraloría de Auditoría Pública Región Altos', 'F', 'Martha', 'Cigarroa', 'Ovando', 'S\'SAPAC/DAD\"A\"/CAPRA', 'Edificio', '2017-02-02 06:00:00', '2019-08-09 15:00:28', NULL);
INSERT INTO `c_areas` VALUES (40, 4, NULL, NULL, NULL, NULL, 30, 11, 4, 1, 'Contraloría de Auditoría Pública Región Soconusco', 'F', 'Mirna Araceli', 'Ordoñez', 'Gómez ', 'S\'SAPAC/DAD\"A\"/CAPRS', 'Edificio', '2017-02-02 06:00:00', '2019-08-09 15:00:28', NULL);
INSERT INTO `c_areas` VALUES (41, 4, NULL, NULL, NULL, NULL, 29, 3, 4, 1, 'Dirección de Auditorías en Dependencias \"B\"', 'M', 'Antonio Ismael', 'Torres', 'Bouchot', 'S\'SAPAC/DAD\"B\"', 'Edificio', '2017-02-02 06:00:00', '2019-01-29 10:23:44', NULL);
INSERT INTO `c_areas` VALUES (43, 4, NULL, NULL, NULL, NULL, 41, 5, 4, 1, 'Departamento de Control y Apoyo de Auditorías a Dependencias \"B\"', 'M', 'Juan Carlos', 'Morellon', 'Hernandez', 'S\'SAPAC/DAD\"B\"', 'Edificio', '2017-02-02 06:00:00', '2019-01-29 10:23:44', NULL);
INSERT INTO `c_areas` VALUES (44, 4, NULL, NULL, NULL, NULL, 41, 10, 4, 1, 'Contraloría Interna en la Secretaria de Seguridad y Protección Ciudadana', 'M', 'Julián German', 'Borrego', 'Vidal', 'S\'SAPAC/DAD\"B\"/CISSPyC', 'Edificio', '2017-02-02 06:00:00', '2019-01-29 12:29:32', NULL);
INSERT INTO `c_areas` VALUES (45, 4, NULL, NULL, NULL, NULL, 41, 10, 4, 1, 'Contraloría Interna en la Secretaria de Educación', 'M', 'José Fredi', 'López', 'Méndez', 'S\'SAPAC/DAD\"B\"/CISE', 'Edificio', '2017-02-02 06:00:00', '2019-01-29 12:38:14', NULL);
INSERT INTO `c_areas` VALUES (46, 4, NULL, NULL, NULL, NULL, 41, 10, 4, 1, 'Contraloría Interna en la Subsecretaria de Educación Federalizada', 'M', 'Carlos Arturo', 'Lara', 'Nucamendi', 'S\'SAPAC/DAD\"B\"/CISEF', 'Edificio', '2017-02-02 06:00:00', '2019-01-31 10:00:57', NULL);
INSERT INTO `c_areas` VALUES (47, 4, NULL, NULL, NULL, NULL, 41, 10, 3, 1, 'Contraloría Interna en la Secretaría de Obras Públicas', 'M', 'Arturo de Jesús', 'Paniagua', 'Cruz', 'S\'SAPAC/DAD\"B\"/CISOPyC', 'Edificio', '2017-02-02 06:00:00', '2019-01-29 12:29:09', NULL);
INSERT INTO `c_areas` VALUES (48, 4, NULL, NULL, NULL, NULL, 41, 11, 3, 1, 'Contraloría de Auditoría Pública en los Sectores Carreteros e Hidráulico', 'M', 'Ramón Walter', 'Camejo', 'Magariño', 'S\'SAPAC/DAD\"B\"/CAPSCH', 'Edificio', '2017-02-02 06:00:00', '2019-01-29 12:38:39', NULL);
INSERT INTO `c_areas` VALUES (49, 4, NULL, NULL, NULL, NULL, 41, 11, 11, 1, 'Contraloría de Auditoría Pública para el Sector Medio ambiente y Trabajo', 'F', 'María Celia', 'Reyes', 'Cruz', 'S\'SAPAC/DAD\"B\"/CAPSMAyTI', 'Edificio', '2017-02-02 06:00:00', '2019-08-09 15:00:28', NULL);
INSERT INTO `c_areas` VALUES (50, 4, NULL, NULL, NULL, NULL, 41, 11, 4, 1, 'Contraloría de Auditoría Pública Región Istmo-Costa', 'M', 'José Ain', 'Narcia', 'Perez', 'S\'SAPAC/DAD\"B\"/CAPRIC', 'Edificio', '2017-02-02 06:00:00', '2019-01-29 12:38:39', NULL);
INSERT INTO `c_areas` VALUES (51, 4, NULL, NULL, NULL, NULL, 29, 3, 4, 1, 'Dirección de Auditoría a Programas Federales', 'M', 'Carlos Alberto', 'Góngora', 'Solis', 'DAFP', 'Edificio', '2017-02-02 06:00:00', '2019-01-29 10:23:44', NULL);
INSERT INTO `c_areas` VALUES (52, 4, NULL, NULL, NULL, NULL, 51, 5, 4, 1, 'Departamento de Auditoría Financiera', 'M', 'Carlos Jesus', 'Gómez', 'Saad', 'DAFP/DF', 'Edificio', '2017-02-02 06:00:00', '2019-01-29 10:23:44', NULL);
INSERT INTO `c_areas` VALUES (53, 4, NULL, NULL, NULL, NULL, 51, 5, 6, 1, 'Departamento de Auditoría Técnica', 'M', 'José Alberto', 'Gutiérrez', 'Schroeder', 'DAFP/DT', 'Edificio', '2017-02-02 06:00:00', '2019-01-29 10:23:44', NULL);
INSERT INTO `c_areas` VALUES (54, 4, 1, NULL, NULL, NULL, 1, 2, 4, 1, 'Subsecretaría de Auditoría Pública para la Administración Descentralizada', 'M', 'Oscar', 'Gómez', 'Nangullasmu', 'SAPAD', 'Edificio', '2017-02-02 06:00:00', '2019-11-14 10:29:59', NULL);
INSERT INTO `c_areas` VALUES (55, 4, NULL, NULL, NULL, NULL, 54, 3, 3, 1, 'Dirección de Auditoría en Entidades \"A\"', 'M', 'Marco Antonio', 'Cáceres', 'Rodas', 'SAPAD/DAE\"A\"', 'Edificio', '2017-02-02 06:00:00', '2019-01-29 12:30:24', NULL);
INSERT INTO `c_areas` VALUES (56, 4, NULL, NULL, NULL, NULL, 55, 5, 4, 1, 'Departamento de Control y Apoyo de Auditorías a Entidades \"A\"', 'M', 'Hugo Alberto', 'Castro', 'Ruiz', 'SAPAD/DAE\"A\"', 'Edificio', '2017-02-02 06:00:00', '2019-01-29 10:23:44', NULL);
INSERT INTO `c_areas` VALUES (58, 4, NULL, NULL, NULL, NULL, 55, 11, 4, 1, 'Contraloría de Auditoría Pública para el Sector Educativo Tecnológico', 'M', 'Gabriel ', 'Toala', 'Moreno', 'SAPAD/DAE\"A\"/CAPSET', 'Edificio', '2017-02-02 06:00:00', '2019-03-22 12:38:31', NULL);
INSERT INTO `c_areas` VALUES (59, 4, NULL, NULL, NULL, NULL, 64, 11, 2, 1, 'Contraloría de Auditoría Pública en el Régimen Estatal de Protección Social en Salud', 'M', 'Everardo', 'López', 'Dominguez', 'SAPAD/DAE\"B\"/CAPREPSS', 'Edificio', '2017-02-02 06:00:00', '2019-03-21 13:33:35', NULL);
INSERT INTO `c_areas` VALUES (60, 4, NULL, NULL, NULL, NULL, 55, 11, 2, 1, 'Contraloría de Auditoría Pública para el Sector Seguridad y Protección Civil', 'M', 'Julio', 'Ruíz', 'Ramírez', 'SAPAD/DAE\"A\"/CAPSSyPC', 'Edificio', '2017-02-02 06:00:00', '2019-03-08 10:45:16', NULL);
INSERT INTO `c_areas` VALUES (61, 4, NULL, NULL, NULL, NULL, 55, 11, 4, 1, 'Contraloría de Auditoría Pública para el Sector de Educación Media', 'F', 'Annabell', 'García', 'Cruz', 'SAPAD/DAE\"A\"/CAPSEM', 'Edificio', '2017-02-02 06:00:00', '2019-08-09 15:00:28', NULL);
INSERT INTO `c_areas` VALUES (62, 4, NULL, NULL, NULL, NULL, 55, 11, 4, 1, 'Contraloría de Auditoría Pública en Organismos Descentralizados', 'F', 'Griselda María Antonieta', 'Luis', 'Gutiérrez', 'SAPAD/DAE\"A\"/CAPOD', 'Edificio', '2017-02-02 06:00:00', '2019-08-09 15:00:28', NULL);
INSERT INTO `c_areas` VALUES (63, 4, NULL, NULL, NULL, NULL, 55, 11, 3, 1, 'Contraloría Interna del INIFECH', 'M', 'Ramiro', 'Cruz', 'Martinez', 'SAPAD/DAE\"A\"/CIINIFECH', 'Edificio', '2017-02-02 06:00:00', '2019-01-29 14:00:42', NULL);
INSERT INTO `c_areas` VALUES (64, 4, NULL, NULL, NULL, NULL, 54, 3, 4, 1, 'Dirección de Auditoría en Entidades \"B\"', 'F', 'Verónica', 'Cruz', 'Samayoa', 'SAPAD/DAE\"B\"', 'Edificio', '2017-02-02 06:00:00', '2019-08-09 15:00:28', NULL);
INSERT INTO `c_areas` VALUES (65, 4, NULL, NULL, NULL, NULL, 64, 5, 2, 1, 'Departamento de Control y Apoyo de Auditorías a Entidades \"B\"', 'F', 'Araceli', 'Solís', 'Rios', 'SAPAD/DAE\"B\"/DCyAAA\"B\"', 'Edificio', '2017-02-02 06:00:00', '2019-08-09 15:00:28', NULL);
INSERT INTO `c_areas` VALUES (66, 4, NULL, NULL, NULL, NULL, 64, 11, 2, 1, 'Contraloría de Auditoría Pública en Organismos Desectorizados', 'F', 'Ana Silvia', 'Rovelo', 'Ruiz', 'SAPAD/DAE\"B\"/CAPOD', 'Edificio', '2017-02-02 06:00:00', '2019-08-09 15:00:28', NULL);
INSERT INTO `c_areas` VALUES (67, 4, NULL, NULL, NULL, NULL, 64, 10, 4, 1, 'Contraloría Interna en el ISSTECH', 'F', 'Dolores Soledad', 'Martínez', 'Castañon', 'SAPAD/DAE\"B\"/CIISSTECH', 'Edificio', '2017-02-02 06:00:00', '2019-08-09 15:00:28', NULL);
INSERT INTO `c_areas` VALUES (68, 4, NULL, NULL, NULL, NULL, 64, 11, 4, 1, 'Contraloría de Auditoría Pública a Entidades Productivas', 'F', 'Sahily', 'Ruiz', 'Burguete', 'SAPAD/DAE\"B\"/CAPEP', 'Edificio', '2017-02-02 06:00:00', '2019-08-09 15:00:28', NULL);
INSERT INTO `c_areas` VALUES (69, 4, NULL, NULL, NULL, NULL, 64, 10, 4, 1, 'Contraloría Interna en el Instituto de Salud', 'M', 'Eliazar', 'Ramirez', 'Torres', 'SAPAD/DAE\"B\"/CIIS', 'Edificio', '2017-02-02 06:00:00', '2019-03-22 12:38:57', NULL);
INSERT INTO `c_areas` VALUES (70, 4, NULL, NULL, NULL, NULL, 54, 3, 2, 1, 'Dirección de Contraloría Social', 'F', 'María del Carmen', 'Zebadua', 'Pérez', 'SAPAD/DCS', 'Edificio', '2017-02-02 06:00:00', '2019-02-11 12:57:51', NULL);
INSERT INTO `c_areas` VALUES (71, 4, NULL, NULL, NULL, NULL, 70, 5, 2, 0, 'Departamento de Evaluación de la Gestión Pública', 'M', 'Jorge Arturo', 'Ruiz', 'Coutiño', 'SAPAD/DCS/DSCS\r\n', 'Edificio', '2017-02-02 06:00:00', '2019-10-08 11:18:41', NULL);
INSERT INTO `c_areas` VALUES (72, 4, NULL, NULL, NULL, NULL, 70, 5, 2, 0, 'Departamento de Asesoría de Contraloría Social', 'M', 'Anuar Pavel', 'Ulloa', 'Montiel', 'SAPAD/DCS/DACS', 'Edificio', '2017-02-02 06:00:00', '2019-10-08 11:18:41', NULL);
INSERT INTO `c_areas` VALUES (73, 4, NULL, NULL, NULL, NULL, 70, 12, 2, 1, 'Contraloría Social Regional Villaflores', 'M', 'Hermelinda', 'Herrera', 'Corzo', 'SAPAD/DCS/CSRV', 'Edificio', '2017-02-02 06:00:00', '2019-01-29 12:37:48', NULL);
INSERT INTO `c_areas` VALUES (74, 4, NULL, NULL, NULL, NULL, 70, 12, 5, 1, 'Contraloría Social Regional Comitán', 'F', 'Ana Cristel', 'Aguirre', 'Rodriguez', 'SAPAD/DCS/CSRCO', 'Edificio', '2017-02-02 06:00:00', '2019-08-09 15:00:28', NULL);
INSERT INTO `c_areas` VALUES (75, 4, NULL, NULL, NULL, NULL, 70, 12, 2, 1, 'Contraloría Social Regional Pichucalco', 'M', 'Eleodoro Genaro', 'Mendoza', 'Latournerie', 'SAPAD/DCS/CSRP', 'Edificio', '2017-02-02 06:00:00', '2019-01-29 12:37:48', NULL);
INSERT INTO `c_areas` VALUES (76, 4, NULL, NULL, NULL, NULL, 70, 12, 2, 1, 'Contraloría Social Regional Tonalá', 'M', 'Jairo Raquel', 'Tino', 'Sanchez', 'SAPAD/DCS/CSRT', 'Edificio', '2017-02-02 06:00:00', '2019-01-29 12:37:48', NULL);
INSERT INTO `c_areas` VALUES (77, 4, NULL, NULL, NULL, NULL, 70, 12, 2, 1, 'Contraloría Social Regional Cintalapa', 'F', 'Alejandra', 'Aranda', 'Nieto', 'SAPAD/DCS/CSRCI', 'Edificio', '2017-02-02 06:00:00', '2019-08-09 15:00:28', NULL);
INSERT INTO `c_areas` VALUES (78, 4, NULL, NULL, NULL, NULL, 70, 12, 2, 1, 'Contraloría Social Regional San Cristóbal de las Casas', 'M', 'Jorge Daniel', 'Flores', 'Crocker', 'SAPAD/DCS/CSRSC', 'Edificio', '2017-02-02 06:00:00', '2019-01-29 12:37:48', NULL);
INSERT INTO `c_areas` VALUES (79, 4, NULL, NULL, NULL, NULL, 70, 12, 2, 1, 'Contraloría Social Regional Ocosingo', 'M', 'Antonio', 'Santiago', 'Ambrosio', 'SAPAD/DCS/CSRO', 'Edificio', '2017-02-02 06:00:00', '2019-01-29 12:37:48', NULL);
INSERT INTO `c_areas` VALUES (80, 4, NULL, NULL, NULL, NULL, 70, 12, 3, 1, 'Contraloría Social Regional Tapachula', 'F', 'Mirna Araceli', 'Ordoñez', 'Gómez', 'S\'SAPAC/DAD\"A\"/CAPRS', 'Edificio', '2017-02-02 06:00:00', '2019-08-09 15:00:28', NULL);
INSERT INTO `c_areas` VALUES (81, 4, NULL, NULL, NULL, NULL, 70, 12, 4, 1, 'Contraloría Social Regional Chiapas de Corzo', 'F', 'Perla del Roció', 'Pérez', 'Aguilar', 'SAPAD/DCS/CSRCC', 'Edificio', '2017-02-02 06:00:00', '2019-08-09 15:00:28', NULL);
INSERT INTO `c_areas` VALUES (82, 4, NULL, NULL, NULL, NULL, 70, 12, 2, 1, 'Contraloría Social Regional Palenque', 'F', 'Lucero', 'Núñez', 'Bonfil', 'SAPAD/DCS/CSRPA', 'Edificio', '2017-02-02 06:00:00', '2019-08-09 15:00:28', NULL);
INSERT INTO `c_areas` VALUES (83, 4, NULL, NULL, NULL, NULL, 70, 12, 4, 1, 'Contraloría Social Regional Motozintla', 'M', 'Rafael', 'Alfaro', 'Cruz', 'SAPAD/DCS/CSRMO', 'Edificio', NULL, '2019-01-29 12:37:48', NULL);
INSERT INTO `c_areas` VALUES (84, 4, 1, NULL, NULL, NULL, 1, 2, 5, 1, 'Subsecretaria Jurídica y de Prevención', 'M', 'Jesús David', 'Pineda', 'Carpio', 'SSJP', 'Edificio', '2017-02-02 06:00:00', '2019-11-14 10:30:22', NULL);
INSERT INTO `c_areas` VALUES (85, 4, NULL, NULL, NULL, NULL, 84, 3, 2, 1, 'Dirección de Responsabilidades', 'F', 'Patricia', 'Mendoza', 'Bravo', 'SSJP/DR', 'Edificio', '2017-02-02 06:00:00', '2019-08-09 15:00:28', NULL);
INSERT INTO `c_areas` VALUES (86, 4, NULL, NULL, NULL, NULL, 85, 8, 2, 1, 'Coordinación \"A\" de Procedimientos Administrativos', 'F', 'María de Lourdes', 'Rivera', 'Centeno', 'SSJP/DR-CA', 'Edificio', '2017-02-02 06:00:00', '2019-08-09 15:00:28', NULL);
INSERT INTO `c_areas` VALUES (87, 4, NULL, NULL, NULL, NULL, 85, 8, 2, 1, 'Coordinación \"B\" de Procedimientos Administrativos', 'F', 'Ana Luisa', 'Bielma', 'Noriega', 'SSJP/DR-CB', 'Edificio', '2017-02-02 06:00:00', '2019-08-09 15:00:28', NULL);
INSERT INTO `c_areas` VALUES (88, 4, NULL, NULL, NULL, NULL, 85, 8, 2, 1, 'Coordinación \"C\" de Procedimientos Administrativos', 'M', 'Raúl Rodolfo', 'Camacho', 'Juarez', 'SSJP/DR-CC', 'Edificio', '2017-02-02 06:00:00', '2019-01-29 12:36:47', NULL);
INSERT INTO `c_areas` VALUES (89, 4, NULL, NULL, NULL, NULL, 85, 5, 2, 1, 'Departamento de Proyectistas', 'M', 'Jorge Israel', 'Sarmiento', 'Gonzalez', 'SSJP/DR', 'Edificio', '2017-02-02 06:00:00', '2019-01-29 10:23:46', NULL);
INSERT INTO `c_areas` VALUES (91, 4, NULL, NULL, NULL, NULL, 84, 3, 2, 1, 'Dirección de Enlace de Fiscalización', 'F', 'Nadia', 'López', 'Diaz', 'SSJP/DEF', 'Edificio', '2017-02-02 06:00:00', '2019-08-09 15:00:28', NULL);
INSERT INTO `c_areas` VALUES (92, 4, NULL, NULL, NULL, NULL, 91, 5, 6, 1, 'Departamento de Informe Técnico de la Fiscalización', 'M', 'Juan Carlos', 'Castro', 'Alegria', 'SSJP/DEF/DITF', 'Edificio', '2017-02-02 06:00:00', '2019-01-29 10:23:46', NULL);
INSERT INTO `c_areas` VALUES (93, 4, NULL, NULL, NULL, NULL, 91, 5, 2, 1, 'Departamento de Análisis Documental', 'M', 'Adalberto', 'Ruiz', 'Aguilar', 'SSJP/DEF/DAD', 'Edificio', '2017-02-02 06:00:00', '2019-01-29 10:23:46', NULL);
INSERT INTO `c_areas` VALUES (94, 4, NULL, NULL, NULL, NULL, 84, 3, 2, 1, 'Dirección Jurídica', 'M', 'Daniel de Jesús', 'Alhor', 'Zea', 'SSJP/DJ', 'Edificio', '2017-02-02 06:00:00', '2019-01-29 12:36:11', NULL);
INSERT INTO `c_areas` VALUES (95, 4, NULL, NULL, NULL, NULL, 94, 5, 2, 0, 'Departamento de Procedimientos Administrativos', 'M', 'Marco Antonio', 'Escobar', 'Alvarez', 'SSJP/DJ/DPA', 'Edificio', '2017-02-02 06:00:00', '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (96, 4, NULL, NULL, NULL, NULL, 94, 5, 2, 0, 'Departamento de Asuntos Jurídicos', 'M', 'Amado', 'Pérez', 'Rodriguez', 'SSJP/DJ/DAJ', 'Edificio', '2017-02-02 06:00:00', '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (97, 4, NULL, NULL, NULL, NULL, 94, 5, 2, 0, 'Departamento de Querellas y Denuncias', 'F', 'Ana Paulina', 'Ovando', 'Gallardo', 'SSJP/DJ/DQyD', 'Edificio', '2017-02-02 06:00:00', '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (98, 4, NULL, NULL, NULL, NULL, 84, 3, 2, 1, 'Dirección de Evolución Patrimonial Conflicto de Interés y Ética', 'F', 'Sandra del Carmen', 'Domínguez', 'Lopez', 'SSJP/DEPCIyE', 'Edificio', '2017-02-02 06:00:00', '2019-08-09 15:00:28', NULL);
INSERT INTO `c_areas` VALUES (99, 4, NULL, NULL, NULL, NULL, 98, 5, 2, 1, 'Departamento de Evolución Patrimonial', 'M', 'Johny', 'Iglesias', 'Reyes', 'SSJP/DEPCIyE/DEP', 'Edificio', '2017-02-02 06:00:00', '2019-01-29 10:23:46', NULL);
INSERT INTO `c_areas` VALUES (100, 4, NULL, NULL, NULL, NULL, 98, 5, 2, 1, 'Departamento de Declaración Patrimonial', 'M', 'Fredy', 'Ventura', 'De Los Santos', 'SSJP/DEPCIyE/DRP', 'Edificio', '2017-02-02 06:00:00', '2019-01-29 10:23:46', NULL);
INSERT INTO `c_areas` VALUES (101, 4, NULL, NULL, NULL, NULL, 98, 5, 2, 1, 'Departamento de Ética y Prevención de Conflicto de Interés', 'M', 'Wilson', 'Espinosa', 'Aguilar', 'SSJP/DEPCIyE/DEPCI', 'Edificio', '2017-02-02 06:00:00', '2019-01-29 10:23:46', NULL);
INSERT INTO `c_areas` VALUES (102, 4, NULL, NULL, NULL, NULL, 102, 9, 2, 1, 'Asesor de la C. Secretaria y Secretario Técnico ante la CPCE-F', 'M', 'Julio Antonio', 'Renaud', 'Hernandez', 'ST/CPCE-F', 'Edificio', '2018-02-21 10:02:12', '2019-10-07 10:30:07', NULL);
INSERT INTO `c_areas` VALUES (103, 4, NULL, NULL, NULL, NULL, 84, 4, 2, 0, 'Unidad de Trasparencia', 'F', 'Maritza del Carmen', 'Pintado', 'Ortega', '', 'Edificio', NULL, '2019-08-09 15:00:28', NULL);
INSERT INTO `c_areas` VALUES (104, 4, NULL, NULL, NULL, NULL, 32, 5, 2, 0, 'Área de Auditoría Pública Sector Económico, Turismo y Transporte', 'F', 'Claudia', 'Melchor', 'Grajales', '', 'Edificio', NULL, '2019-10-08 11:15:30', NULL);
INSERT INTO `c_areas` VALUES (105, 4, NULL, NULL, NULL, NULL, 32, 5, 2, 0, 'Área de Control Seguimiento Evaluación y Normatividad Jurídica Sector Económico, Turismo y Transporte', 'F', 'Norma Elena', 'Vázquez', 'Castillejos', '', 'Edificio', NULL, '2019-10-08 11:15:30', NULL);
INSERT INTO `c_areas` VALUES (106, 4, NULL, NULL, NULL, NULL, 33, 5, 2, 0, 'Área de Auditoría Pública en la Secretaria de Hacienda', 'M', 'Oscar', 'Coello', 'Perez', '', 'Edificio', NULL, '2019-10-08 11:15:30', NULL);
INSERT INTO `c_areas` VALUES (107, 4, NULL, NULL, NULL, NULL, 33, 5, 2, 0, 'Área de Control Seguimiento Evaluación y Normatividad Jurídica en la Secretaria de Hacienda', 'F', 'Norma de Jesús', 'López', 'Juarez', '', 'Edificio', NULL, '2019-10-08 11:15:30', NULL);
INSERT INTO `c_areas` VALUES (108, 4, NULL, NULL, NULL, NULL, 34, 5, 2, 0, 'Área de Auditoría Pública a Fideicomisos', 'M', 'Benito Martin', 'Díaz', 'Ballinas', '', 'Edificio', NULL, '2019-10-08 11:15:30', NULL);
INSERT INTO `c_areas` VALUES (109, 4, NULL, NULL, NULL, NULL, 34, 5, 2, 0, 'Área de Control Seguimiento Evaluacion y Normatividad Juridica a Fideicomisos', 'F', 'Isela', 'Rodríguez', 'Oliva', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (110, 4, NULL, NULL, NULL, NULL, 36, 5, 2, 0, 'Área de Auditoría Pública para el Sector Campo', 'F', 'Verónica Janett', 'Domínguez', 'Farrera', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (111, 4, NULL, NULL, NULL, NULL, 37, 5, 2, 0, 'Área de Auditoría Pública Sector Gobierno y Planeación', 'M', 'Raúl', 'Camas', 'Vida', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (112, 4, NULL, NULL, NULL, NULL, 37, 5, 2, 0, 'Área de Control Seguimiento Evaluacion y Normatividad Juridica Sector Gobierno y Planeación', 'F', 'Elizabeth', 'Sánchez', 'Cruz', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (113, 4, NULL, NULL, NULL, NULL, 38, 5, 2, 0, 'Área de Auditoría Pública Sector desarrollo Social', 'F', 'Eréndira', 'Corzo', 'Reyes', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (114, 4, NULL, NULL, NULL, NULL, 38, 5, 2, 0, 'Área de Control Seguimiento Evaluacion y Normatividad Juridica Sector Desarrollo Social', 'M', 'Heber Antonio', 'Rincón', 'Sarmiento', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (115, 4, NULL, NULL, NULL, NULL, 40, 5, 2, 0, 'Área de Auditoría Pública  Región Soconusco', 'F', 'Amanda', 'Escobar', 'Muñoz', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (116, 4, NULL, NULL, NULL, NULL, 40, 5, 2, 0, 'Área de Control Seguimiento Evaluacion y Normatividad Juridica  Región Soconusco', 'M', 'Francisco', 'Cundapi', 'Hernandez ', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (117, 4, NULL, NULL, NULL, NULL, 44, 5, 2, 0, 'Área de Auditoría Pública Seguridad y Protección Ciudadana', 'M', 'Cesar', 'Zebadua', 'Hernandez ', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (118, 4, NULL, NULL, NULL, NULL, 44, 5, 2, 0, 'Área de Control Seguimiento Evaluacion y Normatividad Juridica Seguridad y Protección Ciudadana', 'F', 'Hermila Antonia', 'Morales', 'Lesciur', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (119, 4, NULL, NULL, NULL, NULL, 45, 5, 2, 0, 'Área de Auditoría Pública Secretaria de Educación', 'M', 'Julio Cesar', 'Santiago', 'Meza', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (120, 4, NULL, NULL, NULL, NULL, 45, 5, 2, 0, 'Área de Control Seguimiento Evaluacion y Normatividad Juridica Secretaria de Educación', 'F', 'Norma Elena', 'Vázquez', 'Castillejos', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (121, 4, NULL, NULL, NULL, NULL, 46, 5, 2, 0, 'Área de Auditoría Pública en la Subsecretaria de Educación Federalizada', 'F', 'Rusbi Adriana', 'Carrascosa', 'Solis', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (122, 4, NULL, NULL, NULL, NULL, 46, 5, 2, 0, 'Área de Control Seguimiento Evaluacion y Normatividad Juridica en la Subsecretaria de Educación Federalizada', 'M', 'Ignacio', 'Posadas ', 'Rios ', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (123, 4, NULL, NULL, NULL, NULL, 47, 5, 2, 0, 'Área de Auditoría Pública en la Secretaría de Obra Pública y Comunicaciones', 'M', 'Rene Armando', 'Juárez', 'Palacios', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (124, 4, NULL, NULL, NULL, NULL, 47, 5, 2, 0, 'Área de Control Seguimiento Evaluacion y Normatividad Juridica en la Secretaría de Obra Pública y Comunicaciones', 'F', 'María Agustina', 'Cantoral', 'Molina', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (125, 4, NULL, NULL, NULL, NULL, 48, 5, 2, 0, 'Área de Auditoría Pública en los Sectores Carreteros E Hidráulico', 'M', 'Fabricio', 'Espinosa', 'Hernandez ', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (126, 4, NULL, NULL, NULL, NULL, 48, 5, 2, 0, 'Área de Control Seguimiento Evaluacion y Normatividad Juridica en los Sectores Carreteros e Hidráulico', 'M', 'Amado', 'Alegría', 'Hernandez', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (127, 4, NULL, NULL, NULL, NULL, 49, 5, 2, 0, 'Área de Auditoría Pública para el Sector Medio Ambiente y Trabajo', 'M', 'Gilberto Nicanor', 'Hernández', 'Dominguez', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (128, 4, NULL, NULL, NULL, NULL, 50, 5, 2, 0, 'Área de Auditoría Pública  Región Istmo-Costa', 'F', 'María de Lourdes', 'Salinas', 'Escobar', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (129, 4, NULL, NULL, NULL, NULL, 58, 5, 2, 0, 'Área de Auditoría Pública para el Sector Educativo Tecnológico', 'F', 'Faustina', 'Reyes', 'Hernandez', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (130, 4, NULL, NULL, NULL, NULL, 58, 5, 2, 0, 'Área de Control Seguimiento Evaluación y Normatividad Jurídica para el Sector Educativo Tecnológico', 'M', 'Humberto Carlos', 'López', 'Campos', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (131, 4, NULL, NULL, NULL, NULL, 60, 5, 2, 0, 'Área de Auditoría Pública para el Sector Seguridad y Protección Civil', 'M', 'Ciro', 'López', 'Esquipulas ', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (132, 4, NULL, NULL, NULL, NULL, 61, 5, 2, 0, 'Área de Auditoría Pública para el Sector de Educación Media', 'M', 'Benjamín', 'Palafox', 'Palacios', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (133, 4, NULL, NULL, NULL, NULL, 61, 5, 2, 0, 'Área de Control Seguimiento Evaluación y Normatividad Jurídica para el Sector de Educación Media', 'M', 'José Rafael', 'Castañeda', 'Vazquez ', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (134, 4, NULL, NULL, NULL, NULL, 62, 5, 2, 0, 'Área de Auditoría Pública en Organismos Descentralizados', 'M', 'José Emilio', 'Mandujano', 'Wilson', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (135, 4, NULL, NULL, NULL, NULL, 63, 5, 2, 0, 'Área de Auditoría Pública  del Inifech', 'M', 'Edy', 'Cabrera', 'Rodriguez', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (136, 4, NULL, NULL, NULL, NULL, 63, 5, 3, 0, 'Área de Control Seguimiento Evaluación y Normatividad Jurídica del INIFECH', 'M', 'Carlos Adán', 'Vázquez', 'Lara ', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (137, 4, NULL, NULL, NULL, NULL, 66, 5, 2, 0, 'Área de Auditoría Pública en Organismos Desectorizados', 'M', 'José Manuel', 'Salazar', 'Ovando', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (138, 4, NULL, NULL, NULL, NULL, 67, 5, 2, 0, 'Área de Auditoría Pública en el ISSTECH', 'F', 'Marina Siboney', 'Peña', 'Merino', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (139, 4, NULL, NULL, NULL, NULL, 67, 5, 2, 0, 'Área de Control Seguimiento Evaluación y Normatividad Jurídica en el ISSTECH', 'F', 'Elda Ruth', 'Zambrano', 'Gutierrez', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (140, 4, NULL, NULL, NULL, NULL, 68, 5, 2, 0, 'Área de Auditoría Pública  a Entidades Productivas', 'F', 'Verónica', 'Juárez', 'Nafate', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (141, 4, NULL, NULL, NULL, NULL, 69, 5, 2, 0, 'Área de Auditoría Pública de Salud', 'F', 'María Magdalena', 'Grajales', 'Garcia', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (142, 4, NULL, NULL, NULL, NULL, 69, 5, 2, 0, 'Área de Control Seguimiento Evaluación y Normatividad Jurídica de Salud', 'M', 'Lisandro', 'Nucamendi', 'Gonzalez', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (143, 4, NULL, NULL, NULL, NULL, 59, 5, 2, 0, 'Área de Auditoría Pública  en el Régimen Estatal de Protección Social en la Salud', 'M', 'Juan Antonio', 'Jiménez', 'Martinez', 'SSJP/DR', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (144, 4, NULL, NULL, NULL, NULL, 85, 5, 2, 0, 'Departamento de Impugnaciones', 'M', 'Raúl', 'Camacho', 'Juarez', '', 'Edificio', NULL, '2019-10-08 11:22:11', NULL);
INSERT INTO `c_areas` VALUES (145, 4, NULL, NULL, NULL, NULL, 11, 5, 2, 1, 'Área Coordinadora de Archivos', 'M', 'Carlos Ricardo', 'Esponda', 'Canela', 'UT/ACA', 'Edificio', NULL, '2019-12-27 11:08:15', NULL);
INSERT INTO `c_areas` VALUES (148, 4, NULL, NULL, NULL, NULL, 3, 13, 2, 1, 'Cordinación General de Entrega Recepción', 'M', 'Zayder', 'Antonio', 'Solorza', NULL, '', NULL, '2019-12-27 11:08:15', NULL);
INSERT INTO `c_areas` VALUES (150, 4, NULL, NULL, NULL, NULL, 12, 5, 4, 1, 'Área de Recursos Financieros y Contabilidad', 'M', 'Rosario', 'Hernandez', 'Jimenez', 'UAA/ARFC', 'Edificio', NULL, '2019-10-08 11:35:09', NULL);
INSERT INTO `c_areas` VALUES (151, 4, NULL, NULL, NULL, NULL, 1, 15, 4, 1, 'Comité de Ética y Conflicto de Interés', 'M', 'Joel ', 'Pereyra', 'Hernandez', 'CEyPCI', 'Edificio', NULL, '2019-10-08 11:35:09', NULL);
INSERT INTO `c_areas` VALUES (152, 4, NULL, NULL, NULL, NULL, 1, 2, 2, 1, 'Secretaria Técnica del Comité de Transparencia', 'F', 'Nadia', 'López', 'Díaz', 'CTST', 'Edificio', NULL, '2019-10-08 11:35:09', NULL);

-- ----------------------------
-- Table structure for c_cargos
-- ----------------------------
DROP TABLE IF EXISTS `c_cargos`;
CREATE TABLE `c_cargos`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nombre_` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of c_cargos
-- ----------------------------
INSERT INTO `c_cargos` VALUES (1, 'Secretaria', 'Secretaria', '2016-08-25 04:00:00', '2019-01-25 10:52:33', NULL);
INSERT INTO `c_cargos` VALUES (2, 'Subsecretario', 'Subsecretaria', '2016-08-25 04:00:00', '2017-12-06 11:05:23', NULL);
INSERT INTO `c_cargos` VALUES (3, 'Director', 'Directora', '2016-08-25 04:00:00', '2017-12-06 11:05:27', NULL);
INSERT INTO `c_cargos` VALUES (4, 'Jefe de Unidad', 'Jefa de Unidad', '2016-08-25 04:00:00', '2017-12-06 11:05:35', NULL);
INSERT INTO `c_cargos` VALUES (5, 'Jefe de Área', 'Jefa de Área', '2016-08-25 04:00:00', '2017-12-06 11:05:45', NULL);
INSERT INTO `c_cargos` VALUES (6, 'Secretario Particular', 'Secretaria Particular', '2017-02-02 06:00:00', '2017-12-06 11:05:54', NULL);
INSERT INTO `c_cargos` VALUES (7, 'Secretario Técnica', 'Secretaria Técnica', '2017-02-02 06:00:00', '2019-01-23 12:16:32', NULL);
INSERT INTO `c_cargos` VALUES (8, 'Coordinador', 'Coordinadora', '2017-02-02 06:00:00', '2017-12-06 11:06:18', NULL);
INSERT INTO `c_cargos` VALUES (9, 'Asesor de la C. Secretaria', 'Asesora del C. Secretario', '2018-02-21 09:59:05', '2019-01-29 10:48:07', NULL);
INSERT INTO `c_cargos` VALUES (10, 'Contralor Interno', 'Contralora Interna', NULL, '2019-01-29 12:37:27', NULL);
INSERT INTO `c_cargos` VALUES (11, 'Contralor', 'Contralora', NULL, '2019-01-29 12:31:32', NULL);
INSERT INTO `c_cargos` VALUES (12, 'Contralor Social', 'Contralora Social', NULL, '2019-01-29 12:37:20', NULL);
INSERT INTO `c_cargos` VALUES (13, 'Encargado', 'Ecargada', NULL, '2019-02-19 10:41:32', NULL);
INSERT INTO `c_cargos` VALUES (14, 'Contralor de Auditoría Pública', 'Contralor de Auditoría Pública', NULL, '2019-02-19 10:41:35', NULL);
INSERT INTO `c_cargos` VALUES (15, 'Presidente', 'Presidenta', NULL, '2019-07-03 12:07:21', NULL);

-- ----------------------------
-- Table structure for c_dependencias
-- ----------------------------
DROP TABLE IF EXISTS `c_dependencias`;
CREATE TABLE `c_dependencias`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_sector_clasificacion` int NOT NULL,
  `id_tipo_organismo` int NULL DEFAULT NULL,
  `nombre` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `titular` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `direccion` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `conmutador` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pagina` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_tipo_organismo`(`id_tipo_organismo` ASC) USING BTREE,
  INDEX `id_sector_clasificacion`(`id_sector_clasificacion` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 322 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of c_dependencias
-- ----------------------------
INSERT INTO `c_dependencias` VALUES (1, 1, 1, 'Oficina del Gobernador', 'Lic. Manuel Velasco Coello', 'Palacio de Gobierno, 1er. Piso, Centro C.P. 29000 Tuxtla Gutiérrez, Chiapas.', '01 (961) 61 8-80-50', 'www.gubernatura.chiapas.gob.mx', '2018-01-23 11:49:29', '2018-01-23 11:49:39', NULL);
INSERT INTO `c_dependencias` VALUES (2, 1, 2, 'Secretaría General de Gobierno', 'Lic. Juan Carlos Gómez Aranda', 'Palacio De Gobierno, 2o. Piso, Centro C.P. 29000 Tuxtla Gutiérrez, Chiapas.', '(961) 61 2-90-47, 61 8-74-60', 'www.sgg.chiapas.gob.mx', '2018-01-23 11:49:29', '2018-01-23 11:49:39', NULL);
INSERT INTO `c_dependencias` VALUES (3, 1, 2, 'Secretaría de Hacienda', 'Humberto Pedrero Moreno', 'Boulevard Andrés Serra Rojas No. 1090, Torre Chiapas, Col. El Retiro C.P. 29045 Tuxtla Gutiérrez, Chiapas.', '(01 961)69 1-40 -40, 69 1-40 -20, 69 1 -40 -43', 'www.haciendachiapas.gob.mx', '2018-01-23 11:49:29', '2018-01-23 11:49:39', NULL);
INSERT INTO `c_dependencias` VALUES (4, 1, 2, 'Secretaría de la Honestidad y Función Publica', 'Mtr. Liliana Angell González', 'Blvd. Los Castillos No. 410, Fracc.  Montes Azules C.P. 29056, Tuxtla Gutiérrez, Chiapas.  ', '01(961) 61 8 75 30 Ext 22 210 Teléfono: Quejas y denuncias 01-800-900-9000', 'www.fpchiapas.gob.mx', '2018-01-23 11:49:29', '2019-01-08 13:12:24', NULL);
INSERT INTO `c_dependencias` VALUES (5, 1, 2, 'Secretaría de Salud', 'Dr. Francisco Ortega Farrera', 'Unidad Administrativa, Edificio “C”, Maya C.P. 29010 Tuxtla Gutiérrez, Chiapas.', '(961) 61 89250', 'http://www.salud.chiapas.gob.mx/', '2018-01-23 11:49:29', '2018-01-23 11:49:39', NULL);
INSERT INTO `c_dependencias` VALUES (6, 1, 2, 'Secretaría de Planeación, Gestión Pública y Programa de Gobierno', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:32', NULL);
INSERT INTO `c_dependencias` VALUES (7, 1, 2, 'Secretaría del Trabajo', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:39', NULL);
INSERT INTO `c_dependencias` VALUES (8, 1, 2, 'Secretaría para el Desarrollo y Empoderamiento de las Mujeres', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:39', NULL);
INSERT INTO `c_dependencias` VALUES (9, 1, 2, 'Secretaría de Protección Civil', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:39', NULL);
INSERT INTO `c_dependencias` VALUES (10, 1, 2, 'Secretaría de Obra Pública y Comunicaciones', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:39', NULL);
INSERT INTO `c_dependencias` VALUES (11, 1, 2, 'Secretaría de Medio Ambiente e Historia Natural', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:39', NULL);
INSERT INTO `c_dependencias` VALUES (12, 1, 2, 'Secretaría de Economía', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:39', NULL);
INSERT INTO `c_dependencias` VALUES (13, 1, 2, 'Secretaría de Desarrollo Social', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:39', NULL);
INSERT INTO `c_dependencias` VALUES (14, 1, 2, 'SECRETARÍA DEL CAMPO', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-02-01 16:39:19', NULL);
INSERT INTO `c_dependencias` VALUES (15, 1, 2, 'Secretaría de Turismo', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:39', NULL);
INSERT INTO `c_dependencias` VALUES (16, 1, 2, 'Secretaría de Pesca y Acuacultura', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:39', NULL);
INSERT INTO `c_dependencias` VALUES (17, 1, 2, 'Secretaría para el Desarrollo Sustentable de los Pueblos Indígenas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:39', NULL);
INSERT INTO `c_dependencias` VALUES (18, 1, 2, 'Secretaría de Educación', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:39', NULL);
INSERT INTO `c_dependencias` VALUES (19, 1, 2, 'Secretaría de Seguridad y Protección Ciudadana', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:40', NULL);
INSERT INTO `c_dependencias` VALUES (20, 1, 2, 'Secretaría de Transportes', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:40', NULL);
INSERT INTO `c_dependencias` VALUES (21, 1, 2, 'Secretaría para el Desarrollo de la Frontera Sur y Enlace para la Cooperación Internacional', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:40', NULL);
INSERT INTO `c_dependencias` VALUES (22, 1, 2, 'Secretaría de la Juventud, Recreación y Deporte', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:40', NULL);
INSERT INTO `c_dependencias` VALUES (23, 1, 2, 'Instituto de la Consejería Jurídica y de Asistencia Legal', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:40', NULL);
INSERT INTO `c_dependencias` VALUES (24, 1, 2, 'Instituto de Población y Ciudades Rurales', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:40', NULL);
INSERT INTO `c_dependencias` VALUES (25, 1, 2, 'Instituto de Población y Ciudades Rurales', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:40', NULL);
INSERT INTO `c_dependencias` VALUES (26, 1, 3, 'Parque Agroindustrial para el Desarrollo Regional del Sureste \"Chiapas\"', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:40', NULL);
INSERT INTO `c_dependencias` VALUES (27, 1, 3, 'Coordinación de Fomento Agroalimentario Sustentable', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:40', NULL);
INSERT INTO `c_dependencias` VALUES (28, 1, 3, 'Junta Local de Conciliación y Arbitraje del Estado de Chiapas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:40', NULL);
INSERT INTO `c_dependencias` VALUES (29, 1, 3, 'Coordinación Estatal para el Mejoramiento del Zoológico \"Miguel Álvarez del Toro\"', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:40', NULL);
INSERT INTO `c_dependencias` VALUES (30, 1, 3, 'Procuraduría Ambiental en el Estado de Chiapas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:40', NULL);
INSERT INTO `c_dependencias` VALUES (31, 1, 3, 'Comisión Estatal de Mejora Regulatoria', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:40', NULL);
INSERT INTO `c_dependencias` VALUES (32, 1, 3, 'Coordinacion Ejecutiva del Fondo de Fomento Económico Chiapas Solidario \"FOFOE\"', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:40', NULL);
INSERT INTO `c_dependencias` VALUES (33, 1, 3, 'Instituto de Protección Social y Beneficencia Pública del Estado de Chiapas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:40', NULL);
INSERT INTO `c_dependencias` VALUES (34, 1, 3, 'Instituto de Estudios de Postgrado', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:40', NULL);
INSERT INTO `c_dependencias` VALUES (35, 1, 3, 'Instituto Estatal de Evaluación e Innovacion Educativa', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:40', NULL);
INSERT INTO `c_dependencias` VALUES (36, 1, 3, 'Instituto de Formación Policial', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:40', NULL);
INSERT INTO `c_dependencias` VALUES (37, 1, 3, 'Centro Estatal de Prevencion Social de la Violencia y Participación Ciudadana', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:40', NULL);
INSERT INTO `c_dependencias` VALUES (38, 1, 3, 'Centro Estatal de Control de Confianza Certificado del Estado de Chiapas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:40', NULL);
INSERT INTO `c_dependencias` VALUES (39, 1, 3, 'Confía Chiapas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:40', NULL);
INSERT INTO `c_dependencias` VALUES (40, 1, 4, 'Instituto para la Gestión Integral de Riesgos de Desastres del Estado de Chiapas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:40', NULL);
INSERT INTO `c_dependencias` VALUES (41, 1, 4, 'Talleres Gráficos de Chiapas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:40', NULL);
INSERT INTO `c_dependencias` VALUES (42, 1, 4, 'Instituto de Capacitación y Vinculación Tecnologíca del Estado de Chiapas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:41', NULL);
INSERT INTO `c_dependencias` VALUES (43, 1, 4, 'Instituto Estatal del Agua', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:41', NULL);
INSERT INTO `c_dependencias` VALUES (44, 1, 4, 'Instituto Casa de las Artesanías de Chiapas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:41', NULL);
INSERT INTO `c_dependencias` VALUES (45, 1, 4, 'Coordinación Ejecutiva del Fondo de Fomento Agropecuario del Estado de Chiapas \"FOFAE\"', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:41', NULL);
INSERT INTO `c_dependencias` VALUES (46, 1, 4, 'Instituto de Salud', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:41', NULL);
INSERT INTO `c_dependencias` VALUES (47, 1, 4, 'Sistema para el Desarrollo Integral de la Familia del Estado de Chiapas (SISTEMA DIF CHIAPAS)', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:41', NULL);
INSERT INTO `c_dependencias` VALUES (48, 1, 4, 'Régimen Estatal de Protección Social en Salud', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:41', NULL);
INSERT INTO `c_dependencias` VALUES (49, 1, 4, 'Colegio de Bachilleres de Chiapas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:41', NULL);
INSERT INTO `c_dependencias` VALUES (50, 1, 4, 'Consejo de Ciencia y Tecnología del Estado de Chiapas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:41', NULL);
INSERT INTO `c_dependencias` VALUES (51, 1, 4, 'CONALEP Chiapas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:41', NULL);
INSERT INTO `c_dependencias` VALUES (52, 1, 4, 'Universidad Tecnológica de la Selva', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:41', NULL);
INSERT INTO `c_dependencias` VALUES (53, 1, 4, 'Colegio de Estudios Científicos y Tecnológicos del Estado de Chiapas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:41', NULL);
INSERT INTO `c_dependencias` VALUES (54, 1, 4, 'Instituto Chiapaneco de Educación para Jóvenes y Adultos', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:41', NULL);
INSERT INTO `c_dependencias` VALUES (55, 1, 4, 'Instituto Tecnológico Superior de Cintalapa', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:41', NULL);
INSERT INTO `c_dependencias` VALUES (56, 4, 9, 'Universidad Politécnica de Chiapas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2019-02-06 11:19:28', NULL);
INSERT INTO `c_dependencias` VALUES (57, 1, 4, 'Universidad Politécnica de Tapachula', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:41', NULL);
INSERT INTO `c_dependencias` VALUES (58, 1, 4, 'Universidad Intercultural de Chiapas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:41', NULL);
INSERT INTO `c_dependencias` VALUES (59, 1, 4, 'Instituto de la Infraestructura Física Educativa del Estado de Chiapas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:41', NULL);
INSERT INTO `c_dependencias` VALUES (60, 1, 4, 'Promotora de Vivienda Chiapas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:41', NULL);
INSERT INTO `c_dependencias` VALUES (61, 1, 4, 'Sistema Chiapaneco de Radio, Televisión y Cinematografía', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:41', NULL);
INSERT INTO `c_dependencias` VALUES (62, 1, 5, 'Instituto de Seguridad Social de los Trabajadores del Estado de Chiapas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:41', NULL);
INSERT INTO `c_dependencias` VALUES (63, 1, 5, 'Consejo Estatal para las Culturas y las Artes de Chiapas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:41', NULL);
INSERT INTO `c_dependencias` VALUES (64, 1, 5, 'Comisión Estatal de Conciliación y Arbitraje Médico del Estado de Chiapas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:41', NULL);
INSERT INTO `c_dependencias` VALUES (65, 1, 5, 'Secretariado Ejecutivo del Sistema Estatal de Seguridad Pública', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:41', NULL);
INSERT INTO `c_dependencias` VALUES (66, 1, 5, 'Centro Regional de Formación Docente e Investigación Educativa', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:41', NULL);
INSERT INTO `c_dependencias` VALUES (67, 1, 5, 'Instituto de Desarrollo de Energías del Estado de Chiapas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:41', NULL);
INSERT INTO `c_dependencias` VALUES (68, 1, 5, 'Instituto del Café de Chiapas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:42', NULL);
INSERT INTO `c_dependencias` VALUES (69, 1, 6, 'Comisión de Caminos e Infraestructura Hidráulica', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:42', NULL);
INSERT INTO `c_dependencias` VALUES (70, 1, 6, 'Comision Ejecutiva Estatal de Atención a Víctimas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:42', NULL);
INSERT INTO `c_dependencias` VALUES (71, 1, 6, 'Centro Estatal de Trasplantes del Estado de Chiapas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:42', NULL);
INSERT INTO `c_dependencias` VALUES (72, 1, 6, 'Instituto AMANECER', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:42', NULL);
INSERT INTO `c_dependencias` VALUES (73, 1, 6, 'Instituto de Comunicación Social del Estado de Chiapas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:42', NULL);
INSERT INTO `c_dependencias` VALUES (74, 1, 6, 'Oficina de Convenciones y Visitantes', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:42', NULL);
INSERT INTO `c_dependencias` VALUES (75, 1, 6, 'Instituto de Bienestar Social', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:42', NULL);
INSERT INTO `c_dependencias` VALUES (76, 1, 7, 'Sociedad Operadora del Aeropuerto Internacional \"Ángel Albino Corzo\"', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 11:49:42', NULL);
INSERT INTO `c_dependencias` VALUES (77, 2, 11, 'Congreso del Estado', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:25:23', NULL);
INSERT INTO `c_dependencias` VALUES (78, 2, 11, 'Organo de Fiscalización Superior del Congreso del Estado', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:25:23', NULL);
INSERT INTO `c_dependencias` VALUES (79, 3, 12, 'Tribunal Superior de Justicia', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:28:12', NULL);
INSERT INTO `c_dependencias` VALUES (80, 3, 12, 'Consejo de la Judicatura', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:28:12', NULL);
INSERT INTO `c_dependencias` VALUES (81, 3, 12, 'Tribunal de Justicia Electoral y Administrativa', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:28:12', NULL);
INSERT INTO `c_dependencias` VALUES (82, 3, 12, 'Tribunal del Trabajo Burocrático', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:28:12', NULL);
INSERT INTO `c_dependencias` VALUES (83, 4, 9, 'Instituto de Elecciones y Participación Ciudadana', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:28:56', NULL);
INSERT INTO `c_dependencias` VALUES (84, 4, 9, 'Comisión Estatal de los Derechos Humanos', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:28:56', NULL);
INSERT INTO `c_dependencias` VALUES (85, 4, 9, 'Universidad Autónoma de Chiapas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:28:56', NULL);
INSERT INTO `c_dependencias` VALUES (86, 4, 9, 'Universidad de Ciencias y Artes de Chiapas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:28:56', NULL);
INSERT INTO `c_dependencias` VALUES (87, 4, 9, 'Instituto de Acceso a la Información Pública del Estado de Chiapas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:28:56', NULL);
INSERT INTO `c_dependencias` VALUES (88, 6, 2, 'Presidencia de la República', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:29:55', NULL);
INSERT INTO `c_dependencias` VALUES (89, 6, 2, 'Secretaría de Gobernación', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:29:55', NULL);
INSERT INTO `c_dependencias` VALUES (90, 6, 2, 'Secretaría de Relaciones Exteriores', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:29:55', NULL);
INSERT INTO `c_dependencias` VALUES (91, 6, 2, 'Secretaría de la Defensa Nacional', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:29:55', NULL);
INSERT INTO `c_dependencias` VALUES (92, 6, 2, 'Secretaría de Marina', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:29:55', NULL);
INSERT INTO `c_dependencias` VALUES (93, 6, 2, 'Secretaría de Hacienda y Crédito Público', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:29:56', NULL);
INSERT INTO `c_dependencias` VALUES (94, 6, 2, 'Secretaría de Desarrollo Social', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:29:56', NULL);
INSERT INTO `c_dependencias` VALUES (95, 6, 2, 'Secretaría de Medio Ambiente y Recursos Naturales', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:29:56', NULL);
INSERT INTO `c_dependencias` VALUES (96, 6, 2, 'Secretaría de Energía', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:29:56', NULL);
INSERT INTO `c_dependencias` VALUES (97, 6, 2, 'Secretaría de Economía', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:29:56', NULL);
INSERT INTO `c_dependencias` VALUES (98, 6, 2, 'Secretaría de Educación Pública', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:29:56', NULL);
INSERT INTO `c_dependencias` VALUES (99, 6, 2, 'Secretaría de Agricultura, Ganadería, Desarrollo Rural, Pesca y Alimentación', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:29:56', NULL);
INSERT INTO `c_dependencias` VALUES (100, 6, 2, 'Secretaría de Comunicaciones y Transporte', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:29:56', NULL);
INSERT INTO `c_dependencias` VALUES (101, 6, 2, 'Secretaría de la Función Pública', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:29:56', NULL);
INSERT INTO `c_dependencias` VALUES (102, 6, 2, 'Secretaría de Salud', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:29:56', NULL);
INSERT INTO `c_dependencias` VALUES (103, 6, 2, 'Secretaría del Trabajo y Prevención Social', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:29:56', NULL);
INSERT INTO `c_dependencias` VALUES (104, 6, 2, 'Secretaría de Desarrollo Agrario, Territorial y Urbano', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:29:56', NULL);
INSERT INTO `c_dependencias` VALUES (105, 6, 2, 'Secretaría de Turismo', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:29:56', NULL);
INSERT INTO `c_dependencias` VALUES (106, 6, 2, 'Secretaría de Cultura', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:29:56', NULL);
INSERT INTO `c_dependencias` VALUES (107, 6, 2, 'Procuraduría General de la República', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:29:56', NULL);
INSERT INTO `c_dependencias` VALUES (108, 6, 2, 'Consejería Jurídica del Ejecutivo Federal', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:29:56', NULL);
INSERT INTO `c_dependencias` VALUES (109, 5, 8, 'H. Ayuntamiento de Acala', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:21:41', NULL);
INSERT INTO `c_dependencias` VALUES (110, 5, 8, 'H. Ayuntamiento de Acacoyagua', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:21:43', NULL);
INSERT INTO `c_dependencias` VALUES (111, 5, 8, 'H. Ayuntamiento de Acacapetahua', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:21:43', NULL);
INSERT INTO `c_dependencias` VALUES (112, 5, 8, 'H. Ayuntamiento de Aldama', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:21:44', NULL);
INSERT INTO `c_dependencias` VALUES (113, 5, 8, 'H. Ayuntamiento de Altamirano', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:21:44', NULL);
INSERT INTO `c_dependencias` VALUES (114, 5, 8, 'H. Ayuntamiento de Amatán', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:14', NULL);
INSERT INTO `c_dependencias` VALUES (115, 5, 8, 'H. Ayuntamiento de Amatenango de la Frontera', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:14', NULL);
INSERT INTO `c_dependencias` VALUES (116, 5, 8, 'H. Ayuntamiento de Amatenango del Valle', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:14', NULL);
INSERT INTO `c_dependencias` VALUES (117, 5, 8, 'H. Ayuntamiento de Ángel Albino Corzo', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:14', NULL);
INSERT INTO `c_dependencias` VALUES (118, 5, 8, 'H. Ayuntamiento de Arriaga', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:15', NULL);
INSERT INTO `c_dependencias` VALUES (119, 5, 8, 'H. Ayuntamiento de Bejucal de Ocampo', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:15', NULL);
INSERT INTO `c_dependencias` VALUES (120, 5, 8, 'H. Ayuntamiento de Belisario Domínguez', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:15', NULL);
INSERT INTO `c_dependencias` VALUES (121, 5, 8, 'H. Ayuntamiento de Bellavista', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:15', NULL);
INSERT INTO `c_dependencias` VALUES (122, 5, 8, 'H. Ayuntamiento de Benemérito de las Américas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:15', NULL);
INSERT INTO `c_dependencias` VALUES (123, 5, 8, 'H. Ayuntamiento de Berriozábal', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:16', NULL);
INSERT INTO `c_dependencias` VALUES (124, 5, 8, 'H. Ayuntamiento de Bochil', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:16', NULL);
INSERT INTO `c_dependencias` VALUES (125, 5, 8, 'H. Ayuntamiento de Cacahoatán', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:16', NULL);
INSERT INTO `c_dependencias` VALUES (126, 5, 8, 'H. Ayuntamiento de Catazajá', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:16', NULL);
INSERT INTO `c_dependencias` VALUES (127, 5, 8, 'H. Ayuntamiento de Chalchihuitán', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:16', NULL);
INSERT INTO `c_dependencias` VALUES (128, 5, 8, 'H. Ayuntamiento de Chamula', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:17', NULL);
INSERT INTO `c_dependencias` VALUES (129, 5, 8, 'H. Ayuntamiento de Chanal', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:17', NULL);
INSERT INTO `c_dependencias` VALUES (130, 5, 8, 'H. Ayuntamiento de Chapultenango', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:17', NULL);
INSERT INTO `c_dependencias` VALUES (131, 5, 8, 'H. Ayuntamiento de Chenalhó', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:17', NULL);
INSERT INTO `c_dependencias` VALUES (132, 5, 8, 'H. Ayuntamiento de Chiapa de Corzo', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:18', NULL);
INSERT INTO `c_dependencias` VALUES (133, 5, 8, 'H. Ayuntamiento de Chiapilla', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:18', NULL);
INSERT INTO `c_dependencias` VALUES (134, 5, 8, 'H. Ayuntamiento de Chicoasen', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:20', NULL);
INSERT INTO `c_dependencias` VALUES (135, 5, 8, 'H. Ayuntamiento de Chicomuselo', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:18', NULL);
INSERT INTO `c_dependencias` VALUES (136, 5, 8, 'H. Ayuntamiento de Chilón', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:21', NULL);
INSERT INTO `c_dependencias` VALUES (137, 5, 8, 'H. Ayuntamiento de Cintalapa de Figueroa', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:19', NULL);
INSERT INTO `c_dependencias` VALUES (138, 5, 8, 'H. Ayuntamiento de Coapilla', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:22', NULL);
INSERT INTO `c_dependencias` VALUES (139, 5, 8, 'H. Ayuntamiento de Comitán de Domínguez', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:22', NULL);
INSERT INTO `c_dependencias` VALUES (140, 5, 8, 'H. Ayuntamiento de Copainalá', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:22', NULL);
INSERT INTO `c_dependencias` VALUES (141, 5, 8, 'H. Ayuntamiento de El Bosque', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:24', NULL);
INSERT INTO `c_dependencias` VALUES (142, 5, 8, 'H. Ayuntamiento de El Porvenir', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:23', NULL);
INSERT INTO `c_dependencias` VALUES (143, 5, 8, 'H. Ayuntamiento de Emiliano Zapata', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:23', NULL);
INSERT INTO `c_dependencias` VALUES (144, 5, 8, 'H. Ayuntamiento de Escuintla', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:26', NULL);
INSERT INTO `c_dependencias` VALUES (145, 5, 8, 'H. Ayuntamiento de Francisco León', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:27', NULL);
INSERT INTO `c_dependencias` VALUES (146, 5, 8, 'H. Ayuntamiento de Frontera Comalapa', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:27', NULL);
INSERT INTO `c_dependencias` VALUES (147, 5, 8, 'H. Ayuntamiento de Frontera Hidalgo', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:28', NULL);
INSERT INTO `c_dependencias` VALUES (148, 5, 8, 'H. Ayuntamiento de Huehuetán', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:29', NULL);
INSERT INTO `c_dependencias` VALUES (149, 5, 8, 'H. Ayuntamiento de Huitiupán', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:30', NULL);
INSERT INTO `c_dependencias` VALUES (150, 5, 8, 'H. Ayuntamiento de Huixtán', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:30', NULL);
INSERT INTO `c_dependencias` VALUES (151, 5, 8, 'H. Ayuntamiento de Huixtla', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:39', NULL);
INSERT INTO `c_dependencias` VALUES (152, 5, 8, 'H. Ayuntamiento de Ixhuatán', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:50', NULL);
INSERT INTO `c_dependencias` VALUES (153, 5, 8, 'H. Ayuntamiento de Ixtacomitán', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:50', NULL);
INSERT INTO `c_dependencias` VALUES (154, 5, 8, 'H. Ayuntamiento de Ixtapa', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:50', NULL);
INSERT INTO `c_dependencias` VALUES (155, 5, 8, 'H. Ayuntamiento de Ixtapangajoya', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:50', NULL);
INSERT INTO `c_dependencias` VALUES (156, 5, 8, 'H. Ayuntamiento de Jiquipilas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:50', NULL);
INSERT INTO `c_dependencias` VALUES (157, 5, 8, 'H. Ayuntamiento de Jitotol', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:51', NULL);
INSERT INTO `c_dependencias` VALUES (158, 5, 8, 'H. Ayuntamiento de Juárez', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:51', NULL);
INSERT INTO `c_dependencias` VALUES (159, 5, 8, 'H. Ayuntamiento de La concordia', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:51', NULL);
INSERT INTO `c_dependencias` VALUES (160, 5, 8, 'H. Ayuntamiento de La Grandeza', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:51', NULL);
INSERT INTO `c_dependencias` VALUES (161, 5, 8, 'H. Ayuntamiento de La Independencia', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:51', NULL);
INSERT INTO `c_dependencias` VALUES (162, 5, 8, 'H. Ayuntamiento de La Libertad', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:51', NULL);
INSERT INTO `c_dependencias` VALUES (163, 5, 8, 'H. Ayuntamiento de La Trinitaria', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:51', NULL);
INSERT INTO `c_dependencias` VALUES (164, 5, 8, 'H. Ayuntamiento de Larraninzar', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:51', NULL);
INSERT INTO `c_dependencias` VALUES (165, 5, 8, 'H. Ayuntamiento de Las Margaritas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:51', NULL);
INSERT INTO `c_dependencias` VALUES (166, 5, 8, 'H. Ayuntamiento de Las Rosas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:51', NULL);
INSERT INTO `c_dependencias` VALUES (167, 5, 8, 'H. Ayuntamiento de Mapastepec', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:51', NULL);
INSERT INTO `c_dependencias` VALUES (168, 5, 8, 'H. Ayuntamiento de Maravilla Tenejapa', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:51', NULL);
INSERT INTO `c_dependencias` VALUES (169, 5, 8, 'H. Ayuntamiento de Marqués de Comillas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:51', NULL);
INSERT INTO `c_dependencias` VALUES (170, 5, 8, 'H. Ayuntamiento de Mazapa de Madero', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:51', NULL);
INSERT INTO `c_dependencias` VALUES (171, 5, 8, 'H. Ayuntamiento de Mazatán', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:51', NULL);
INSERT INTO `c_dependencias` VALUES (172, 5, 8, 'H. Ayuntamiento de Metapa', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:51', NULL);
INSERT INTO `c_dependencias` VALUES (173, 5, 8, 'H. Ayuntamiento de Mezcalapa', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:51', NULL);
INSERT INTO `c_dependencias` VALUES (174, 5, 8, 'H. Ayuntamiento de Mitontic', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:51', NULL);
INSERT INTO `c_dependencias` VALUES (175, 5, 8, 'H. Ayuntamiento de Montecristo de Guerrero', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:51', NULL);
INSERT INTO `c_dependencias` VALUES (176, 5, 8, 'H. Ayuntamiento de Motozintla', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:51', NULL);
INSERT INTO `c_dependencias` VALUES (177, 5, 8, 'H. Ayuntamiento de Nicolás Ruíz', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:51', NULL);
INSERT INTO `c_dependencias` VALUES (178, 5, 8, 'H. Ayuntamiento de Ocosingo', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:51', NULL);
INSERT INTO `c_dependencias` VALUES (179, 5, 8, 'H. Ayuntamiento de Ocotepec', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:51', NULL);
INSERT INTO `c_dependencias` VALUES (180, 5, 8, 'H. Ayuntamiento de Ocozocoautla de Espinoza', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:51', NULL);
INSERT INTO `c_dependencias` VALUES (181, 5, 8, 'H. Ayuntamiento de Ostuacán', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:51', NULL);
INSERT INTO `c_dependencias` VALUES (182, 5, 8, 'H. Ayuntamiento de Osumacinta', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:51', NULL);
INSERT INTO `c_dependencias` VALUES (183, 5, 8, 'H. Ayuntamiento de Oxchuc', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:51', NULL);
INSERT INTO `c_dependencias` VALUES (184, 5, 8, 'H. Ayuntamiento de Palenque', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:51', NULL);
INSERT INTO `c_dependencias` VALUES (185, 5, 8, 'H. Ayuntamiento de Pantelhó', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:51', NULL);
INSERT INTO `c_dependencias` VALUES (186, 5, 8, 'H. Ayuntamiento de Pantepec', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:52', NULL);
INSERT INTO `c_dependencias` VALUES (187, 5, 8, 'H. Ayuntamiento de El Parral', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:52', NULL);
INSERT INTO `c_dependencias` VALUES (188, 5, 8, 'H. Ayuntamiento de Pichucalco', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:52', NULL);
INSERT INTO `c_dependencias` VALUES (189, 5, 8, 'H. Ayuntamiento de Pijijiapan', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:52', NULL);
INSERT INTO `c_dependencias` VALUES (190, 5, 8, 'H. Ayuntamiento de Pueblo Nuevo Solistahuacán', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:52', NULL);
INSERT INTO `c_dependencias` VALUES (191, 5, 8, 'H. Ayuntamiento de Rayón', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:52', NULL);
INSERT INTO `c_dependencias` VALUES (192, 5, 8, 'H. Ayuntamiento de Reforma', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:52', NULL);
INSERT INTO `c_dependencias` VALUES (193, 5, 8, 'H. Ayuntamiento de Sabanilla', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:52', NULL);
INSERT INTO `c_dependencias` VALUES (194, 5, 8, 'H. Ayuntamiento de Salto de Agua', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:52', NULL);
INSERT INTO `c_dependencias` VALUES (195, 5, 8, 'H. Ayuntamiento de San Cristóbal de las Casas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:52', NULL);
INSERT INTO `c_dependencias` VALUES (196, 5, 8, 'H. Ayuntamiento de San Fernando', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:52', NULL);
INSERT INTO `c_dependencias` VALUES (197, 5, 8, 'H. Ayuntamiento de San Juan Cancuc', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:52', NULL);
INSERT INTO `c_dependencias` VALUES (198, 5, 8, 'H. Ayuntamiento de San Lucas', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:52', NULL);
INSERT INTO `c_dependencias` VALUES (199, 5, 8, 'H. Ayuntamiento de Santiago el Pinar', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:52', NULL);
INSERT INTO `c_dependencias` VALUES (200, 5, 8, 'H. Ayuntamiento de Siltepec', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:52', NULL);
INSERT INTO `c_dependencias` VALUES (201, 5, 8, 'H. Ayuntamiento de Simojovel', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:52', NULL);
INSERT INTO `c_dependencias` VALUES (202, 5, 8, 'H. Ayuntamiento de Sitalá', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:52', NULL);
INSERT INTO `c_dependencias` VALUES (203, 5, 8, 'H. Ayuntamiento de Socoltenango', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:52', NULL);
INSERT INTO `c_dependencias` VALUES (204, 5, 8, 'H. Ayuntamiento de Solosuchiapa', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:52', NULL);
INSERT INTO `c_dependencias` VALUES (205, 5, 8, 'H. Ayuntamiento de Soyaló', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:52', NULL);
INSERT INTO `c_dependencias` VALUES (206, 5, 8, 'H. Ayuntamiento de San Andrés Duraznal', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:52', NULL);
INSERT INTO `c_dependencias` VALUES (207, 5, 8, 'H. Ayuntamiento de Suchiapa', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:52', NULL);
INSERT INTO `c_dependencias` VALUES (208, 5, 8, 'H. Ayuntamiento de Suchiate', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:52', NULL);
INSERT INTO `c_dependencias` VALUES (209, 5, 8, 'H. Ayuntamiento de Sunuapa', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:52', NULL);
INSERT INTO `c_dependencias` VALUES (210, 5, 8, 'H. Ayuntamiento de Tapachula', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:52', NULL);
INSERT INTO `c_dependencias` VALUES (211, 5, 8, 'H. Ayuntamiento de Tapalapa', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:52', NULL);
INSERT INTO `c_dependencias` VALUES (212, 5, 8, 'H. Ayuntamiento de Tapilula', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:52', NULL);
INSERT INTO `c_dependencias` VALUES (213, 5, 8, 'H. Ayuntamiento de Tecpatán', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:52', NULL);
INSERT INTO `c_dependencias` VALUES (214, 5, 8, 'H. Ayuntamiento de Tenejapa', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:52', NULL);
INSERT INTO `c_dependencias` VALUES (215, 5, 8, 'H. Ayuntamiento de Teopisca', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:53', NULL);
INSERT INTO `c_dependencias` VALUES (216, 5, 8, 'H. Ayuntamiento de Tila', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:53', NULL);
INSERT INTO `c_dependencias` VALUES (217, 5, 8, 'H. Ayuntamiento de Tonalá', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:53', NULL);
INSERT INTO `c_dependencias` VALUES (218, 5, 8, 'H. Ayuntamiento de Totolapa', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:53', NULL);
INSERT INTO `c_dependencias` VALUES (219, 5, 8, 'H. Ayuntamiento de Tumbalá', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:53', NULL);
INSERT INTO `c_dependencias` VALUES (220, 5, 8, 'H. Ayuntamiento de Tuxtla Chico', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:53', NULL);
INSERT INTO `c_dependencias` VALUES (221, 5, 8, 'H. Ayuntamiento de Tuxtla Gutiérrez', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:53', NULL);
INSERT INTO `c_dependencias` VALUES (222, 5, 8, 'H. Ayuntamiento de Tuzantán', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:53', NULL);
INSERT INTO `c_dependencias` VALUES (223, 5, 8, 'H. Ayuntamiento de Tzimol', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:53', NULL);
INSERT INTO `c_dependencias` VALUES (224, 5, 8, 'H. Ayuntamiento de Unión Juárez', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:53', NULL);
INSERT INTO `c_dependencias` VALUES (225, 5, 8, 'H. Ayuntamiento de Venustiano Carranza', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:53', NULL);
INSERT INTO `c_dependencias` VALUES (226, 5, 8, 'H. Ayuntamiento de Villa Comaltitlán', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:53', NULL);
INSERT INTO `c_dependencias` VALUES (227, 5, 8, 'H. Ayuntamiento de Villa Corzo', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:53', NULL);
INSERT INTO `c_dependencias` VALUES (228, 5, 8, 'H. Ayuntamiento de Villaflores', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:53', NULL);
INSERT INTO `c_dependencias` VALUES (229, 5, 8, 'H. Ayuntamiento de Yajalón', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:53', NULL);
INSERT INTO `c_dependencias` VALUES (230, 5, 8, 'H. Ayuntamiento de Zinacantán', 'a', 'd', 'c', NULL, '2018-01-23 11:49:29', '2018-01-23 12:22:53', NULL);
INSERT INTO `c_dependencias` VALUES (231, 1, 2, 'Secretaría de Igualdad de Genero', '', '', NULL, NULL, '2019-01-11 14:07:59', '2019-01-11 09:09:25', NULL);
INSERT INTO `c_dependencias` VALUES (232, 1, 2, 'Secretaría de Movilidad y Transporte del Estado de Chiapas', '', '', NULL, NULL, '2019-01-14 09:21:25', '2019-01-14 04:22:55', NULL);
INSERT INTO `c_dependencias` VALUES (233, 1, 2, 'Particular', '', '', NULL, NULL, '2019-01-14 09:47:39', '2019-01-14 04:49:09', NULL);
INSERT INTO `c_dependencias` VALUES (234, 1, 2, 'Instituto Mexicano del Seguro Social', '', '', NULL, NULL, '2019-01-15 08:18:38', '2019-01-15 08:17:55', NULL);
INSERT INTO `c_dependencias` VALUES (235, 4, 9, 'Colegio de Ingenieros Mecanicos y Electrisistas del Estado de Chiapas AC', '', '', NULL, NULL, NULL, '2019-01-15 09:50:32', NULL);
INSERT INTO `c_dependencias` VALUES (236, 3, 12, 'Tribunal Electoral del Estao de Chiapas', '', '', NULL, NULL, NULL, '2019-01-15 11:22:15', NULL);
INSERT INTO `c_dependencias` VALUES (237, 3, 12, 'Juzgado Cuarto de Distrito de Amparo y Juicios Federales en el Estado de Chiapas', '', '', NULL, NULL, NULL, '2019-01-16 07:59:29', NULL);
INSERT INTO `c_dependencias` VALUES (238, 3, 12, 'Tribunal de Justicia Administrativa del Estado de Chiapas', '', '', NULL, NULL, NULL, '2019-01-15 13:26:02', NULL);
INSERT INTO `c_dependencias` VALUES (240, 1, 2, 'Secretaría de Economia y del Trabajo', '', '', NULL, NULL, NULL, '2019-01-15 14:04:10', NULL);
INSERT INTO `c_dependencias` VALUES (241, 1, 2, 'Instituto de Comunicación Social y Relaciones Públicas', '', '', NULL, NULL, NULL, '2019-01-16 06:36:06', NULL);
INSERT INTO `c_dependencias` VALUES (242, 3, 12, 'Juzgado Tercero de Distrito de Amparo y Juicios Federales en el Estado de Chiapas', '', '', NULL, NULL, NULL, '2019-01-16 07:59:41', NULL);
INSERT INTO `c_dependencias` VALUES (243, 1, 9, 'Instituto de Ciencias, Tecnolgía e Inovación', '', '', NULL, NULL, NULL, '2019-01-16 09:56:27', NULL);
INSERT INTO `c_dependencias` VALUES (244, 1, 2, 'Secretaría de Bienestar', '', '', NULL, NULL, NULL, '2019-01-16 11:01:51', NULL);
INSERT INTO `c_dependencias` VALUES (245, 4, 9, 'Sociedad Operadora de la Torre Chiapas', '', '', NULL, NULL, NULL, '2019-01-14 13:16:58', NULL);
INSERT INTO `c_dependencias` VALUES (246, 7, 10, 'Privado', '', '', NULL, NULL, NULL, '2019-01-17 15:50:33', NULL);
INSERT INTO `c_dependencias` VALUES (247, 7, 10, 'Persona Fisica', '', '', NULL, NULL, NULL, '2019-01-17 15:52:21', NULL);
INSERT INTO `c_dependencias` VALUES (248, 1, 2, 'Consejería Juridica del Gobernador', '', '', NULL, NULL, NULL, '2019-01-24 11:07:42', NULL);
INSERT INTO `c_dependencias` VALUES (249, 4, 9, 'Colegio de Arquitectos Chiapanecos A.C.', '', '', NULL, NULL, NULL, '2019-01-18 12:11:37', NULL);
INSERT INTO `c_dependencias` VALUES (250, 4, 13, 'Poder Judicial de la Federación ', '', '', NULL, NULL, NULL, '2019-01-22 06:07:08', NULL);
INSERT INTO `c_dependencias` VALUES (251, 1, 2, 'Secretaría de Obras Públicas', '', '', NULL, NULL, NULL, '2019-01-18 15:20:20', NULL);
INSERT INTO `c_dependencias` VALUES (252, 1, 2, 'Instituto del Deporte', '', '', NULL, NULL, NULL, '2019-01-21 06:05:16', NULL);
INSERT INTO `c_dependencias` VALUES (253, 6, 2, 'Auditoría Superior de la Federación', '', '', NULL, NULL, NULL, '2019-01-24 10:12:03', NULL);
INSERT INTO `c_dependencias` VALUES (254, 6, 2, 'Instituto Nacional de Estadística y Geografía', '', '', NULL, NULL, NULL, '2019-01-22 06:19:45', NULL);
INSERT INTO `c_dependencias` VALUES (255, 1, 2, 'Secretaría de Aguicultura, Ganadería y Pesca', '', '', NULL, NULL, NULL, '2019-01-22 06:59:11', NULL);
INSERT INTO `c_dependencias` VALUES (256, 6, 2, 'Secretaría de la Contraloría General del Estado de Nayarit', '', '', NULL, NULL, NULL, '2019-01-23 10:47:57', NULL);
INSERT INTO `c_dependencias` VALUES (257, 1, 2, 'Fideicomiso de Prestaciones de Seguridad Social para los Trabajadores del Sector Policial Operativo al Servicio del Poder Ejecutivo del Estado de Chiapas', '', '', NULL, NULL, NULL, '2019-01-23 12:04:01', NULL);
INSERT INTO `c_dependencias` VALUES (258, 4, 9, 'Confederación Patronal de la República Mexicana del Estado de Chiapas (COPARMEX)', '', '', NULL, NULL, NULL, '2019-01-23 13:15:40', NULL);
INSERT INTO `c_dependencias` VALUES (259, 1, 2, 'Fondo de Protección para Vehiculos del Poder Ejecutivo Estatal (FOPROVEP)', '', '', NULL, NULL, NULL, '2019-01-24 11:02:09', NULL);
INSERT INTO `c_dependencias` VALUES (260, 8, 14, 'Juzgado Segundo de Distrito de Amparo y Jucios Federales en el Estado de Chiapas', '', '', NULL, NULL, NULL, '2019-01-24 13:15:27', NULL);
INSERT INTO `c_dependencias` VALUES (261, 8, 14, 'Juzgado Tercero de Distrito de Amparo y Jucios Federales en el Estado de Chiapas', '', '', NULL, NULL, NULL, '2019-01-24 13:22:05', NULL);
INSERT INTO `c_dependencias` VALUES (262, 6, 2, 'Secretaría de la Contraloría de Queretaro', '', '', NULL, NULL, NULL, '2019-01-25 09:10:39', NULL);
INSERT INTO `c_dependencias` VALUES (263, 1, 2, 'COPLADE', '', '', NULL, NULL, NULL, '2019-01-28 08:55:43', NULL);
INSERT INTO `c_dependencias` VALUES (264, 4, 9, 'Universidad Intercultural de Chiapas', '', '', NULL, NULL, NULL, '2019-01-28 12:47:06', NULL);
INSERT INTO `c_dependencias` VALUES (265, 1, 2, 'Oficialia Mayor del Estado de Chiapas', '', '', NULL, NULL, NULL, '2019-01-28 15:14:37', NULL);
INSERT INTO `c_dependencias` VALUES (266, 1, 2, 'Gubernatura de Estado de Chiapas', '', '', NULL, NULL, NULL, '2019-01-29 12:35:43', NULL);
INSERT INTO `c_dependencias` VALUES (267, 7, 10, 'Suministros Tuxtla ', '', '', NULL, NULL, NULL, '2019-01-29 12:48:38', NULL);
INSERT INTO `c_dependencias` VALUES (268, 1, 2, 'IMSS', '', '', NULL, NULL, NULL, '2019-01-29 13:55:46', NULL);
INSERT INTO `c_dependencias` VALUES (269, 8, 14, 'Poder Judicial de la Federación', '', '', NULL, NULL, NULL, '2019-01-29 14:42:43', NULL);
INSERT INTO `c_dependencias` VALUES (270, 4, 9, 'Colegio de Ingenieros Civiles Tuxtla Gutiérrez, A.C. ', '', '', NULL, NULL, NULL, '2019-01-30 10:09:34', NULL);
INSERT INTO `c_dependencias` VALUES (271, 4, 9, 'Colegio de Arquitectos Chiapanecos Nueva Generación, A.C.', '', '', NULL, NULL, NULL, '2019-01-30 10:57:08', NULL);
INSERT INTO `c_dependencias` VALUES (272, 4, 9, 'Colegio de Arquitectos Chiapanecos Nueva Generación, A.C.', '', '', NULL, NULL, NULL, '2019-01-30 10:57:28', NULL);
INSERT INTO `c_dependencias` VALUES (273, 1, 2, 'Fiscalia General del Estado', '', '', NULL, NULL, NULL, '2019-01-31 14:01:29', NULL);
INSERT INTO `c_dependencias` VALUES (274, 4, 9, 'Constructora VPA de los Altos, S.A de C.V.', '', '', NULL, NULL, NULL, '2019-01-31 14:39:27', NULL);
INSERT INTO `c_dependencias` VALUES (275, 6, 2, 'Secretaría de Administración del Estado de Morelos', '', '', NULL, NULL, NULL, '2019-01-31 14:26:31', NULL);
INSERT INTO `c_dependencias` VALUES (276, 6, 2, 'Instituto de Seguridad y Servicios Sociales de los Trabajadores del Estado', '', '', NULL, NULL, NULL, '2019-02-01 10:06:48', NULL);
INSERT INTO `c_dependencias` VALUES (277, 3, 12, 'Juzgado Quinto de Distrito de Amparo y Jucios Federales en el Estado de Chiapas', '', '', NULL, NULL, NULL, '2019-02-01 12:03:02', NULL);
INSERT INTO `c_dependencias` VALUES (278, 4, 9, 'Asociación Mexicana de Ingeniería de Vías Terrestres, A.C. Delegación Chiapas', '-', '-', NULL, NULL, '2019-02-05 16:20:54', '2019-02-05 10:35:42', '2019-02-05 16:28:11');
INSERT INTO `c_dependencias` VALUES (279, 4, 9, 'Asociación Mexicana de Ingeniería de Vías Terrestres, A.C. Delegación Chiapas', '-', '-', NULL, NULL, '2019-02-05 16:28:43', '2019-02-05 10:35:43', NULL);
INSERT INTO `c_dependencias` VALUES (280, 4, 9, 'Colegio de Ingenieros Civiles Profesionales Autónomos, A.C', '-', '-', NULL, NULL, '2019-02-05 16:50:26', '2019-02-05 10:53:47', NULL);
INSERT INTO `c_dependencias` VALUES (281, 0, NULL, 'Universidad Politécnica de Chiapas', '', '', NULL, NULL, NULL, '2019-02-06 17:18:22', '2019-02-06 17:18:22');
INSERT INTO `c_dependencias` VALUES (282, 6, 2, 'IMSS', '-', '-', NULL, NULL, '2019-02-08 14:08:14', '2019-02-08 14:08:19', NULL);
INSERT INTO `c_dependencias` VALUES (283, 1, 2, 'Gobierno del Estado de Chiapas', '-', '-', NULL, NULL, NULL, '2019-02-14 13:40:29', NULL);
INSERT INTO `c_dependencias` VALUES (284, 6, 2, 'Secretaría de la Contraloría Puebla', '-', '-', NULL, NULL, NULL, '2019-02-15 12:11:38', NULL);
INSERT INTO `c_dependencias` VALUES (285, 4, 9, 'Sindicato Nacional de Trabajadores de la Educación, Comision Ejecutiva (Seccion 40)', '-', '-', NULL, NULL, NULL, '2019-02-18 12:38:17', NULL);
INSERT INTO `c_dependencias` VALUES (286, 3, 12, 'Juez Primero de lo Familiar del Distrito Judicial de Tuxtla ', '-', '-', NULL, NULL, NULL, '2019-02-19 09:44:02', NULL);
INSERT INTO `c_dependencias` VALUES (287, 8, 14, 'Fiscalía General de la República', '', '', NULL, NULL, NULL, '2019-02-26 08:19:41', NULL);
INSERT INTO `c_dependencias` VALUES (288, 8, 14, 'Procuraduría General de la República', '', '', NULL, NULL, NULL, '2019-02-26 14:51:01', NULL);
INSERT INTO `c_dependencias` VALUES (289, 6, 13, 'TELECOMM TELEGRAFOS\r\n', '-', '-', NULL, NULL, NULL, '2019-02-28 12:52:11', NULL);
INSERT INTO `c_dependencias` VALUES (290, 4, 9, ' Colegio de Contadores Publicos Chiapanecos, A.C.', '-', '-', NULL, NULL, NULL, '2019-03-04 09:56:31', NULL);
INSERT INTO `c_dependencias` VALUES (291, 1, 2, 'Instituto Nacional de Antropologia e Historia', '-', '-', NULL, NULL, NULL, '2019-03-04 12:36:49', NULL);
INSERT INTO `c_dependencias` VALUES (292, 9, 13, 'Comisión Permanente de Contralores Estados Federación (CPCE-F)', '-', '-', NULL, NULL, NULL, '2019-03-21 11:49:56', NULL);
INSERT INTO `c_dependencias` VALUES (293, 6, 2, 'Secretaría de la Contraloria y Transparencia Gubernamental (Oaxaca)', '-', '-', NULL, NULL, NULL, '2019-03-07 09:48:23', NULL);
INSERT INTO `c_dependencias` VALUES (294, 6, 2, 'Instituto Nacional de Transparencia, Acceso a la información y Protección de Datos (INAI)', '-', '-', NULL, NULL, NULL, '2019-03-07 14:50:52', NULL);
INSERT INTO `c_dependencias` VALUES (295, 0, NULL, 'Fiscalia General de la Republica (PGR)', '', '', NULL, NULL, NULL, '2019-03-07 14:50:16', NULL);
INSERT INTO `c_dependencias` VALUES (296, 6, 2, 'Fiscalia General de la Republica (PGR)', '', '', NULL, NULL, NULL, '2019-03-07 14:50:50', NULL);
INSERT INTO `c_dependencias` VALUES (297, 4, 9, 'Comisión Intercolegial', '', '', NULL, NULL, NULL, '2019-03-08 12:46:46', NULL);
INSERT INTO `c_dependencias` VALUES (298, 6, 2, 'Secretaría de la Contraloría de Pachuca, Hidalgo', '-', '-', NULL, NULL, NULL, '2019-03-08 15:03:26', NULL);
INSERT INTO `c_dependencias` VALUES (299, 1, 2, 'Instituto de la Juventud', '-', '-', NULL, NULL, NULL, '2019-03-14 10:27:59', NULL);
INSERT INTO `c_dependencias` VALUES (300, 3, 12, 'Poder judicial', '-', '-', NULL, NULL, NULL, '2019-03-15 10:37:42', NULL);
INSERT INTO `c_dependencias` VALUES (301, 5, 8, 'Sistema Municipal de Agua Potable y Alcantarillado SMAPA', '', '', NULL, NULL, NULL, '2019-03-19 13:20:15', NULL);
INSERT INTO `c_dependencias` VALUES (302, 1, 2, 'Servicio de Administración Triburaria (SAT)', '-', '-', NULL, NULL, NULL, '2019-03-19 14:51:43', NULL);
INSERT INTO `c_dependencias` VALUES (303, 6, 2, 'Comisión Nacional del Agua (CONAGUA) ', '', '', NULL, NULL, NULL, '2019-04-01 12:58:52', NULL);
INSERT INTO `c_dependencias` VALUES (304, 6, 2, 'Auditoría Superior del Estado de Chiapas (ASE)', '-', '-', NULL, NULL, NULL, '2019-04-01 15:07:41', NULL);
INSERT INTO `c_dependencias` VALUES (305, 5, 8, 'H. Ayuntamiento de Capitán Luis Angel Vidal', '-', '-', NULL, NULL, NULL, '2019-04-03 13:03:09', NULL);
INSERT INTO `c_dependencias` VALUES (306, 6, 2, 'Secretaría de la Contraloría del Poder Ejecutivo del Estado de Campeche', '-', '-', NULL, NULL, NULL, '2019-05-21 07:42:08', NULL);
INSERT INTO `c_dependencias` VALUES (307, 1, 2, 'Ejemplo Dependencia', '-', '-', '-', '-', '2019-05-22 16:08:26', '2019-05-22 16:08:26', NULL);
INSERT INTO `c_dependencias` VALUES (308, 4, 9, 'Universidad de Ciencia y Tecnología Descartes', '-', '-', '-', '-', '2019-05-23 17:35:22', '2019-05-23 17:35:22', NULL);
INSERT INTO `c_dependencias` VALUES (309, 1, 3, 'Instituo de Administración Pública del Estado de Chiapas, A.C.', '-', '-', '-', '-', '2019-05-24 17:05:16', '2019-05-24 17:05:16', NULL);
INSERT INTO `c_dependencias` VALUES (310, 9, 13, 'Instituto Nacional Electoral', '-', '-', '-', '-', '2019-05-24 18:21:42', '2019-05-24 18:21:42', NULL);
INSERT INTO `c_dependencias` VALUES (311, 5, 8, 'SMAPA', 'ING. FREDY GÓMEZ RUIZ', '.', '.', '.', '2019-05-27 18:05:55', '2019-05-27 18:05:55', NULL);
INSERT INTO `c_dependencias` VALUES (312, 1, 2, 'Comité de adquisiciones, arrendamiento de bienes muebles y contratación de servicios del poder ejecutivo', '-', '-', '-', '-', '2019-06-03 14:37:41', '2019-06-03 14:37:41', NULL);
INSERT INTO `c_dependencias` VALUES (313, 4, 10, 'ICOSA  S.A. DE C.V', '-', '-', '-', '-', '2019-06-05 19:16:26', '2019-06-05 19:16:26', NULL);
INSERT INTO `c_dependencias` VALUES (314, 2, 9, 'Auditoría Superior del Estado de Chiapas', '-', '-', '-', '-', '2019-06-10 17:19:32', '2019-06-10 17:19:32', NULL);
INSERT INTO `c_dependencias` VALUES (315, 6, 2, 'Comisión Nacional de los Derechos Humanos', '-', '-', '-', NULL, '2019-06-24 18:09:09', '2019-06-24 18:09:09', NULL);
INSERT INTO `c_dependencias` VALUES (316, 5, 8, 'H. Ayuntamiento Mazapa de Madero.', '....', '...', '...', '...', '2019-06-25 19:37:54', '2019-06-25 19:37:54', NULL);
INSERT INTO `c_dependencias` VALUES (317, 5, 8, 'H. Ayuntamiento Capitán Luis Ángel Vidal, Chiapas', '.', '.', '.', '.', '2019-06-28 20:27:03', '2019-06-28 20:27:03', NULL);
INSERT INTO `c_dependencias` VALUES (318, 4, 10, 'Colegio de Abogado A.C Capítulo Chiapas', '-', '-', '-', '-', '2019-07-04 16:19:09', '2019-07-04 16:19:09', NULL);
INSERT INTO `c_dependencias` VALUES (319, 10, 3, 'Camara De Diputados LXIV Legislatura', '-', '-', '-', '-', '2019-07-08 18:58:47', '2019-07-08 18:58:47', NULL);
INSERT INTO `c_dependencias` VALUES (320, 1, 2, 'PROPERA (Programa de Inclusión Social)', 'Jesús Ernesto Gómez Panana', '.', '.', '.', '2019-08-12 16:33:12', '2019-08-12 16:33:12', NULL);
INSERT INTO `c_dependencias` VALUES (321, 4, 7, 'CFE.', 'Ing. Rafael Martínez Bernal', '.', '.', '.', '2019-08-15 14:57:53', '2019-08-15 14:57:53', NULL);

-- ----------------------------
-- Table structure for c_sectores
-- ----------------------------
DROP TABLE IF EXISTS `c_sectores`;
CREATE TABLE `c_sectores`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of c_sectores
-- ----------------------------
INSERT INTO `c_sectores` VALUES (1, 'Sector Estatal', '2017-02-20 00:00:00', '2017-02-20 12:10:59', NULL);
INSERT INTO `c_sectores` VALUES (2, 'Sector Federal', '2017-02-20 00:00:00', '2017-02-20 12:10:59', NULL);
INSERT INTO `c_sectores` VALUES (3, 'Sector Social', '2017-02-21 00:00:00', '2017-02-21 13:39:49', NULL);
INSERT INTO `c_sectores` VALUES (4, 'Sector Privado', '2017-02-21 00:00:00', '2017-02-21 13:39:49', NULL);

-- ----------------------------
-- Table structure for c_sectores_clasificacion
-- ----------------------------
DROP TABLE IF EXISTS `c_sectores_clasificacion`;
CREATE TABLE `c_sectores_clasificacion`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_sector` int NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_sector`(`id_sector` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of c_sectores_clasificacion
-- ----------------------------
INSERT INTO `c_sectores_clasificacion` VALUES (1, 1, 'Poder Ejecutivo', '2017-02-20 00:00:00', '2017-02-20 12:17:25', NULL);
INSERT INTO `c_sectores_clasificacion` VALUES (2, 1, 'Poder Legislativo', '2017-02-20 00:00:00', '2017-02-20 12:17:25', NULL);
INSERT INTO `c_sectores_clasificacion` VALUES (3, 1, 'Poder Judicial', '2017-02-20 00:00:00', '2017-02-20 12:17:47', NULL);
INSERT INTO `c_sectores_clasificacion` VALUES (4, 1, 'Órganos Autónomos', '2017-02-20 00:00:00', '2017-02-20 12:17:47', NULL);
INSERT INTO `c_sectores_clasificacion` VALUES (5, 1, 'Gobiernos Municipales', '2017-02-20 00:00:00', '2017-02-20 12:18:11', NULL);
INSERT INTO `c_sectores_clasificacion` VALUES (6, 2, 'Poder Ejecutivo Federal', '2017-02-20 00:00:00', '2019-01-22 06:18:05', NULL);
INSERT INTO `c_sectores_clasificacion` VALUES (7, 4, 'Privado', '2019-01-17 15:44:40', '2019-01-17 15:44:06', NULL);
INSERT INTO `c_sectores_clasificacion` VALUES (8, 2, 'Poder Judicial Federal', '2019-01-22 10:57:21', '2019-01-22 06:02:55', NULL);
INSERT INTO `c_sectores_clasificacion` VALUES (9, 2, 'Órganos Autónomos Federales ', NULL, '2019-01-22 06:04:09', NULL);
INSERT INTO `c_sectores_clasificacion` VALUES (10, 2, 'Poder Legislativo Federal', NULL, '2019-07-08 12:52:44', NULL);

-- ----------------------------
-- Table structure for c_status
-- ----------------------------
DROP TABLE IF EXISTS `c_status`;
CREATE TABLE `c_status`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `style` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of c_status
-- ----------------------------
INSERT INTO `c_status` VALUES (1, 'Pendiente', 'warning', '2016-08-24 23:00:00', '2019-10-02 10:27:41', NULL);
INSERT INTO `c_status` VALUES (2, 'Proceso', 'info', '2016-08-24 23:00:00', '2019-10-02 10:27:41', NULL);
INSERT INTO `c_status` VALUES (3, 'Concluido', 'success', '2016-08-24 23:00:00', '2019-10-02 10:27:41', NULL);
INSERT INTO `c_status` VALUES (4, 'Temporalmente concluido', 'default', '2019-04-24 09:00:11', '2019-10-02 10:27:41', NULL);
INSERT INTO `c_status` VALUES (5, 'Conocimiento', 'warning', '2018-01-26 15:15:55', '2019-10-02 10:27:41', NULL);
INSERT INTO `c_status` VALUES (6, 'Rechazado', 'danger', '2019-11-14 00:00:00', '2019-11-14 09:07:25', NULL);

-- ----------------------------
-- Table structure for c_tipo_envio
-- ----------------------------
DROP TABLE IF EXISTS `c_tipo_envio`;
CREATE TABLE `c_tipo_envio`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `color` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of c_tipo_envio
-- ----------------------------
INSERT INTO `c_tipo_envio` VALUES (1, 'Original', 'info', NULL, '2019-11-23 10:09:06', NULL);
INSERT INTO `c_tipo_envio` VALUES (2, 'Copia', 'warning', NULL, '2019-11-23 10:09:06', NULL);

-- ----------------------------
-- Table structure for c_tipos_documentos
-- ----------------------------
DROP TABLE IF EXISTS `c_tipos_documentos`;
CREATE TABLE `c_tipos_documentos`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_clasificacion` int NOT NULL COMMENT '1. Interna, 2. Externa, 3. Interna y Externa',
  `internos` tinyint(1) NULL DEFAULT 0,
  `externos` tinyint(1) NULL DEFAULT 0,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `color` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_clasificacion`(`id_clasificacion` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of c_tipos_documentos
-- ----------------------------
INSERT INTO `c_tipos_documentos` VALUES (1, 2, 0, 1, 'Oficio', 'info', '2017-02-06 00:00:00', '2020-01-29 09:59:32', NULL);
INSERT INTO `c_tipos_documentos` VALUES (2, 1, 1, 1, 'Memorándum', 'success', '2017-02-06 00:00:00', '2020-02-05 11:49:27', NULL);
INSERT INTO `c_tipos_documentos` VALUES (3, 3, 1, 1, 'Circular', 'info', '2017-02-06 00:00:00', '2020-02-05 11:50:43', NULL);
INSERT INTO `c_tipos_documentos` VALUES (4, 3, 0, 1, 'Tarjeta informativa', 'warning', '2017-02-10 22:09:20', '2020-01-29 09:59:32', NULL);
INSERT INTO `c_tipos_documentos` VALUES (5, 3, 0, 1, 'Informe', 'default', '2017-02-20 00:00:00', '2020-01-29 09:59:32', NULL);
INSERT INTO `c_tipos_documentos` VALUES (6, 3, 0, 1, 'Boletin', 'alert', '2017-02-20 00:00:00', '2020-01-29 09:59:32', NULL);
INSERT INTO `c_tipos_documentos` VALUES (7, 3, 0, 1, 'Folio', 'dark', '2019-01-15 15:16:50', '2020-01-29 09:59:32', NULL);
INSERT INTO `c_tipos_documentos` VALUES (8, 3, 0, 1, 'Personal', 'default', '2019-01-14 09:52:48', '2020-01-29 09:59:32', NULL);
INSERT INTO `c_tipos_documentos` VALUES (9, 3, 0, 1, 'Convocatoria', 'default', '2019-01-14 12:47:06', '2020-01-29 09:59:32', NULL);
INSERT INTO `c_tipos_documentos` VALUES (10, 3, 0, 1, 'Sobres', 'default', '2019-01-14 16:40:19', '2020-01-29 09:59:32', NULL);
INSERT INTO `c_tipos_documentos` VALUES (11, 3, 0, 1, 'Invitación', 'default', '2019-01-23 13:49:59', '2020-01-29 09:59:32', NULL);
INSERT INTO `c_tipos_documentos` VALUES (12, 3, 0, 1, 'Oficial', 'default', '2019-01-23 13:50:02', '2020-01-29 09:59:32', NULL);

-- ----------------------------
-- Table structure for c_tipos_organismos
-- ----------------------------
DROP TABLE IF EXISTS `c_tipos_organismos`;
CREATE TABLE `c_tipos_organismos`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of c_tipos_organismos
-- ----------------------------
INSERT INTO `c_tipos_organismos` VALUES (1, 'Oficina del Gobernador', '2017-02-09 00:00:00', '2017-02-09 19:43:44', NULL);
INSERT INTO `c_tipos_organismos` VALUES (2, 'Dependencias', '2017-02-09 00:00:00', '2017-02-09 19:43:44', NULL);
INSERT INTO `c_tipos_organismos` VALUES (3, 'Órganos Desconcentrados', '2017-02-09 00:00:00', '2017-02-09 19:45:11', NULL);
INSERT INTO `c_tipos_organismos` VALUES (4, 'Organismos Públicos Descentralizados Sectorizados', '2017-02-09 00:00:00', '2017-02-09 19:47:26', NULL);
INSERT INTO `c_tipos_organismos` VALUES (5, 'Organismos Públicos Descentralizados Desectorizados', '2017-02-09 00:00:00', '2017-02-09 19:49:13', NULL);
INSERT INTO `c_tipos_organismos` VALUES (6, 'Organismos Auxiliares del Ejecutivo', '2017-02-09 00:00:00', '2017-02-09 19:49:13', NULL);
INSERT INTO `c_tipos_organismos` VALUES (7, 'Empresas de Participación Estatal', '2017-02-09 00:00:00', '2017-02-09 19:49:35', NULL);
INSERT INTO `c_tipos_organismos` VALUES (8, 'Gobiernos municipales', '2017-02-09 00:00:00', '2017-02-09 19:52:52', NULL);
INSERT INTO `c_tipos_organismos` VALUES (9, 'Órganos Autónomos Estatales', '2017-02-09 00:00:00', '2017-02-09 19:53:41', NULL);
INSERT INTO `c_tipos_organismos` VALUES (10, 'Sector Privado', '2017-02-09 00:00:00', '2017-02-09 19:53:41', NULL);
INSERT INTO `c_tipos_organismos` VALUES (11, 'Poder Legislativo', '2018-01-22 15:14:26', '2018-01-22 15:14:32', NULL);
INSERT INTO `c_tipos_organismos` VALUES (12, 'Poder Judicial Estatal', '2018-01-22 15:14:46', '2019-02-01 12:39:15', NULL);
INSERT INTO `c_tipos_organismos` VALUES (13, 'Organismos Autónomos Federal', '2018-01-22 15:15:08', '2019-01-22 05:56:50', NULL);
INSERT INTO `c_tipos_organismos` VALUES (14, 'Poder Judicial Federal', NULL, '2019-01-18 15:09:28', NULL);

-- ----------------------------
-- Table structure for c_titulares
-- ----------------------------
DROP TABLE IF EXISTS `c_titulares`;
CREATE TABLE `c_titulares`  (
  `id` int NOT NULL,
  `id_area` int NOT NULL,
  `id_titulo` int NOT NULL,
  `id_cargo` int NOT NULL,
  `sexo` char(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ap_paterno` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ap_materno` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of c_titulares
-- ----------------------------
INSERT INTO `c_titulares` VALUES (1, 1, 10, 1, 'F', 'Liliana', 'Angell', 'Gonzalez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (2, 2, 2, 6, 'F', 'María del Rocío', 'Aguilar', 'Jiménez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (3, 3, 4, 7, 'F', 'María Claudia', 'Vázquez', 'Castillejos', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (4, 4, 2, 8, 'F', 'Ana Beatriz', 'Kanter', 'Macal', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (5, 5, 4, 8, 'M', 'José Roberto', 'García', 'Gordillo', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (6, 6, 4, 5, 'F', 'Zulma del Roció', 'Nuricumbo', 'Corzo', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (7, 7, 2, 5, 'F', 'Patricia', 'Juárez', 'Nafate', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (8, 8, 4, 8, 'M', 'Diego', 'Lugo', 'Segovia', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (9, 9, 2, 5, 'F', 'Grisel Isabel', 'Espinosa', 'Coello', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (10, 10, 1, 5, 'F', 'Consuelo', 'Santiago', 'Mendoza', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (11, 11, 2, 4, 'F', 'Maritza del Carmen', 'Pintado ', 'Ortega', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (12, 12, 5, 4, 'M', 'Joel', 'Pereira', 'Hernandez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (13, 13, 2, 5, 'F', 'Magally Elizabeth', 'Guillen', 'Montesinos', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (14, 14, 4, 5, 'M', 'José Isidro', 'Ovando', 'Perez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (15, 15, 2, 5, 'F', 'Ana Melina', 'Zárate', 'Valencia', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (16, 16, 2, 4, 'M', 'Rodolfo', 'Jiménez', 'Santos', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (17, 17, 3, 5, 'M', 'Manuel Jesús', 'Aguiar', 'Gamez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (18, 18, 3, 5, 'M', 'Gabriel', 'Narcia', 'Gómez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (19, 19, 3, 5, 'M', 'Calixto David', 'Gutiérrez', 'Gomez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (20, 20, 3, 5, 'M', 'Roberto David', 'Hernández', 'Martinez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (21, 21, 3, 4, 'M', 'Carlos Alberto', 'Jiménez', 'Aquino', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (22, 22, 4, 5, 'M', 'Humberto', 'Ross', 'Zuñiga', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (23, 23, 5, 5, 'M', 'Carlos', 'López', 'Limon', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (24, 24, 2, 8, 'F', 'Lorena', 'Maza', 'Leon', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (25, 25, 4, 5, 'F', 'Elizabeth', 'Soto', 'Figueroa', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (26, 26, 3, 8, 'M', 'Ramiro', 'Flores', 'Cartagena', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (27, 27, 6, 5, 'M', 'Arturo', 'Moguel', 'Nuricumbo', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (28, 28, 3, 5, 'M', 'Manlio Favio', 'Chacón', 'Sol', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (29, 29, 8, 2, 'M', 'Antonio', 'Ovando', 'Ocaña', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (30, 30, 4, 3, 'M', 'Luis Roberto', 'Sánchez', 'Aguilar', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (31, 31, 4, 5, 'M', 'Francisco Javier', 'Chandomi', 'Hernandez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (32, 32, 3, 11, 'M', 'Luis Alberto', 'Sandoval', 'Jiménez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (33, 33, 9, 10, 'M', 'Jesús', 'Díaz', 'García', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (34, 34, 4, 11, 'F', 'Birene', 'Chandomi', 'Escobar', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (35, 36, 4, 11, 'M', 'Miguel Ángel', 'Bautista', 'Trujillo', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (36, 37, 4, 14, 'M', 'Gerardo', 'Espinosa', 'Cifuentes', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (37, 38, 2, 11, 'M', 'Heber Antonio', 'Rincon', 'Sarmiento', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (38, 39, 9, 11, 'F', 'Martha', 'Cigarroa', 'Ovando', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (39, 40, 4, 11, 'F', 'Mirna Araceli', 'Ordoñez', 'Gómez ', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (40, 41, 4, 3, 'M', 'Antonio Ismael', 'Torres', 'Bouchot', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (41, 43, 4, 5, 'M', 'Juan Carlos', 'Morellon', 'Hernandez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (42, 44, 4, 10, 'M', 'Julián German', 'Borrego', 'Vidal', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (43, 45, 4, 10, 'M', 'José Fredi', 'López', 'Méndez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (44, 46, 4, 10, 'M', 'Carlos Arturo', 'Lara', 'Nucamendi', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (45, 47, 3, 10, 'M', 'Arturo de Jesús', 'Paniagua', 'Cruz', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (46, 48, 3, 11, 'M', 'Ramón Walter', 'Camejo', 'Magariño', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (47, 49, 11, 11, 'F', 'María Celia', 'Reyes', 'Cruz', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (48, 50, 4, 11, 'M', 'José Ain', 'Narcia', 'Perez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (49, 51, 4, 3, 'M', 'Carlos Alberto', 'Góngora', 'Solis', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (50, 52, 4, 5, 'M', 'Carlos Jesus', 'Gómez', 'Saad', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (51, 53, 6, 5, 'M', 'José Alberto', 'Gutiérrez', 'Schroeder', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (52, 54, 4, 2, 'M', 'Oscar', 'Gómez', 'Nangullasmu', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (53, 55, 3, 3, 'M', 'Marco Antonio', 'Cáceres', 'Rodas', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (54, 56, 4, 5, 'M', 'Hugo Alberto', 'Castro', 'Ruiz', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (55, 58, 4, 11, 'M', 'Gabriel ', 'Toala', 'Moreno', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (56, 59, 2, 11, 'M', 'Everardo', 'López', 'Dominguez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (57, 60, 2, 11, 'M', 'Julio', 'Ruíz', 'Ramírez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (58, 61, 4, 11, 'F', 'Annabell', 'García', 'Cruz', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (59, 62, 4, 11, 'F', 'Griselda María Antonieta', 'Luis', 'Gutiérrez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (60, 63, 3, 11, 'M', 'Ramiro', 'Cruz', 'Martinez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (61, 64, 4, 3, 'F', 'Verónica', 'Cruz', 'Samayoa', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (62, 65, 2, 5, 'F', 'Araceli', 'Solís', 'Rios', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (63, 66, 2, 11, 'F', 'Ana Silvia', 'Rovelo', 'Ruiz', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (64, 67, 4, 10, 'F', 'Dolores Soledad', 'Martínez', 'Castañon', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (65, 68, 4, 11, 'F', 'Sahily', 'Ruiz', 'Burguete', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (66, 69, 4, 10, 'M', 'Eliazar', 'Ramirez', 'Torres', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (67, 70, 2, 3, 'F', 'María del Carmen', 'Zebadua', 'Pérez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (68, 71, 2, 5, 'M', 'Jorge Arturo', 'Ruiz', 'Coutiño', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (69, 72, 2, 5, 'M', 'Anuar Pavel', 'Ulloa', 'Montiel', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (70, 73, 2, 12, 'M', 'Hermelinda', 'Herrera', 'Corzo', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (71, 74, 5, 12, 'F', 'Ana Cristel', 'Aguirre', 'Rodriguez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (72, 75, 2, 12, 'M', 'Eleodoro Genaro', 'Mendoza', 'Latournerie', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (73, 76, 2, 12, 'M', 'Jairo Raquel', 'Tino', 'Sanchez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (74, 77, 2, 12, 'F', 'Alejandra', 'Aranda', 'Nieto', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (75, 78, 2, 12, 'M', 'Jorge Daniel', 'Flores', 'Crocker', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (76, 79, 2, 12, 'M', 'Antonio', 'Santiago', 'Ambrosio', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (77, 80, 3, 12, 'F', 'Mirna Araceli', 'Ordoñez', 'Gómez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (78, 81, 4, 12, 'F', 'Perla del Roció', 'Pérez', 'Aguilar', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (79, 82, 2, 12, 'F', 'Lucero', 'Núñez', 'Bonfil', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (80, 83, 4, 12, 'M', 'Rafael', 'Alfaro', 'Cruz', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (81, 84, 5, 2, 'M', 'Jesús David', 'Pineda', 'Carpio', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (82, 85, 2, 3, 'F', 'Patricia', 'Mendoza', 'Bravo', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (83, 86, 2, 8, 'F', 'María de Lourdes', 'Rivera', 'Centeno', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (84, 87, 2, 8, 'F', 'Ana Luisa', 'Bielma', 'Noriega', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (85, 88, 2, 8, 'M', 'Raúl Rodolfo', 'Camacho', 'Juarez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (86, 89, 2, 5, 'M', 'Jorge Israel', 'Sarmiento', 'Gonzalez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (87, 91, 2, 3, 'F', 'Nadia', 'López', 'Diaz', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (88, 92, 6, 5, 'M', 'Juan Carlos', 'Castro', 'Alegria', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (89, 93, 2, 5, 'M', 'Adalberto', 'Ruiz', 'Aguilar', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (90, 94, 2, 3, 'M', 'Daniel de Jesús', 'Alhor', 'Zea', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (91, 95, 2, 5, 'M', 'Marco Antonio', 'Escobar', 'Alvarez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (92, 96, 2, 5, 'M', 'Amado', 'Pérez', 'Rodriguez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (93, 97, 2, 5, 'F', 'Ana Paulina', 'Ovando', 'Gallardo', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (94, 98, 2, 3, 'F', 'Sandra del Carmen', 'Domínguez', 'Lopez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (95, 99, 2, 5, 'M', 'Johny', 'Iglesias', 'Reyes', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (96, 100, 2, 5, 'M', 'Fredy', 'Ventura', 'De Los Santos', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (97, 101, 2, 5, 'M', 'Wilson', 'Espinosa', 'Aguilar', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (98, 102, 2, 9, 'M', 'Julio Antonio', 'Renaud', 'Hernandez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (99, 103, 2, 4, 'F', 'Maritza del Carmen', 'Pintado', 'Ortega', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (100, 104, 2, 5, 'F', 'Claudia', 'Melchor', 'Grajales', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (101, 105, 2, 5, 'F', 'Norma Elena', 'Vázquez', 'Castillejos', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (102, 106, 2, 5, 'M', 'Oscar', 'Coello', 'Perez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (103, 107, 2, 5, 'F', 'Norma de Jesús', 'López', 'Juarez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (104, 108, 2, 5, 'M', 'Benito Martin', 'Díaz', 'Ballinas', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (105, 109, 2, 5, 'F', 'Isela', 'Rodríguez', 'Oliva', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (106, 110, 2, 5, 'F', 'Verónica Janett', 'Domínguez', 'Farrera', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (107, 111, 2, 5, 'M', 'Raúl', 'Camas', 'Vida', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (108, 112, 2, 5, 'F', 'Elizabeth', 'Sánchez', 'Cruz', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (109, 113, 2, 5, 'F', 'Eréndira', 'Corzo', 'Reyes', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (110, 114, 2, 5, 'M', 'Heber Antonio', 'Rincón', 'Sarmiento', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (111, 115, 2, 5, 'F', 'Amanda', 'Escobar', 'Muñoz', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (112, 116, 2, 5, 'M', 'Francisco', 'Cundapi', 'Hernandez ', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (113, 117, 2, 5, 'M', 'Cesar', 'Zebadua', 'Hernandez ', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (114, 118, 2, 5, 'F', 'Hermila Antonia', 'Morales', 'Lesciur', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (115, 119, 2, 5, 'M', 'Julio Cesar', 'Santiago', 'Meza', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (116, 120, 2, 5, 'F', 'Norma Elena', 'Vázquez', 'Castillejos', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (117, 121, 2, 5, 'F', 'Rusbi Adriana', 'Carrascosa', 'Solis', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (118, 122, 2, 5, 'M', 'Ignacio', 'Posadas ', 'Rios ', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (119, 123, 2, 5, 'M', 'Rene Armando', 'Juárez', 'Palacios', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (120, 124, 2, 5, 'F', 'María Agustina', 'Cantoral', 'Molina', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (121, 125, 2, 5, 'M', 'Fabricio', 'Espinosa', 'Hernandez ', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (122, 126, 2, 5, 'M', 'Amado', 'Alegría', 'Hernandez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (123, 127, 2, 5, 'M', 'Gilberto Nicanor', 'Hernández', 'Dominguez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (124, 128, 2, 5, 'F', 'María de Lourdes', 'Salinas', 'Escobar', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (125, 129, 2, 5, 'F', 'Faustina', 'Reyes', 'Hernandez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (126, 130, 2, 5, 'M', 'Humberto Carlos', 'López', 'Campos', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (127, 131, 2, 5, 'M', 'Ciro', 'López', 'Esquipulas ', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (128, 132, 2, 5, 'M', 'Benjamín', 'Palafox', 'Palacios', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (129, 133, 2, 5, 'M', 'José Rafael', 'Castañeda', 'Vazquez ', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (130, 134, 2, 5, 'M', 'José Emilio', 'Mandujano', 'Wilson', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (131, 135, 2, 5, 'M', 'Edy', 'Cabrera', 'Rodriguez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (132, 136, 3, 5, 'M', 'Carlos Adán', 'Vázquez', 'Lara ', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (133, 137, 2, 5, 'M', 'José Manuel', 'Salazar', 'Ovando', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (134, 138, 2, 5, 'F', 'Marina Siboney', 'Peña', 'Merino', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (135, 139, 2, 5, 'F', 'Elda Ruth', 'Zambrano', 'Gutierrez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (136, 140, 2, 5, 'F', 'Verónica', 'Juárez', 'Nafate', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (137, 141, 2, 5, 'F', 'María Magdalena', 'Grajales', 'Garcia', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (138, 142, 2, 5, 'M', 'Lisandro', 'Nucamendi', 'Gonzalez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (139, 143, 2, 5, 'M', 'Juan Antonio', 'Jiménez', 'Martinez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (140, 144, 2, 5, 'M', 'Raúl', 'Camacho', 'Juarez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (141, 145, 2, 5, 'M', 'Carlos Ricardo', 'Esponda', 'Canela', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (142, 148, 2, 13, 'M', 'Zayder', 'Antonio', 'Solorza', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (143, 150, 4, 5, 'M', 'Rosario', 'Hernandez', 'Jimenez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (144, 151, 4, 15, 'M', 'Joel ', 'Pereyra', 'Hernandez', NULL, '2019-12-18 05:58:50', NULL, 1);
INSERT INTO `c_titulares` VALUES (145, 152, 2, 2, 'F', 'Nadia', 'López', 'Díaz', NULL, '2019-12-18 05:58:50', NULL, 1);

-- ----------------------------
-- Table structure for c_titulos
-- ----------------------------
DROP TABLE IF EXISTS `c_titulos`;
CREATE TABLE `c_titulos`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of c_titulos
-- ----------------------------
INSERT INTO `c_titulos` VALUES (1, 'C.', '2016-08-24 23:00:00', '2016-08-25 11:26:13', NULL);
INSERT INTO `c_titulos` VALUES (2, 'Lic.', '2016-08-24 23:00:00', '2019-01-14 11:32:02', NULL);
INSERT INTO `c_titulos` VALUES (3, 'Ing.', '2016-08-24 23:00:00', '2019-01-14 11:32:07', NULL);
INSERT INTO `c_titulos` VALUES (4, 'C.P.', '2016-08-24 23:00:00', '2016-08-25 11:26:39', NULL);
INSERT INTO `c_titulos` VALUES (5, 'Mtro.', '2017-02-10 00:00:00', '2019-01-14 11:32:11', NULL);
INSERT INTO `c_titulos` VALUES (6, 'Arq.', '2017-02-10 00:00:00', '2019-01-14 11:32:16', NULL);
INSERT INTO `c_titulos` VALUES (7, 'Dr.', '2017-02-10 00:00:00', '2019-01-14 11:32:19', NULL);
INSERT INTO `c_titulos` VALUES (8, 'C.P.C.', '2017-11-30 16:48:18', '2017-11-30 16:48:22', NULL);
INSERT INTO `c_titulos` VALUES (9, 'LAE.', NULL, '2019-01-22 05:46:08', NULL);
INSERT INTO `c_titulos` VALUES (10, 'Mtra.', NULL, '2019-01-25 10:53:04', NULL);
INSERT INTO `c_titulos` VALUES (11, 'Dra.', NULL, '2019-05-16 09:09:27', NULL);

-- ----------------------------
-- Table structure for permission_role
-- ----------------------------
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role`  (
  `permission_id` int UNSIGNED NOT NULL,
  `role_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `permission_role_role_id_foreign`(`role_id` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permission_role
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_menu` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `permissions_name_unique`(`name` ASC) USING BTREE,
  INDEX `id_menu`(`id_menu` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permissions
-- ----------------------------

-- ----------------------------
-- Table structure for role_user
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user`  (
  `user_id` int UNSIGNED NOT NULL,
  `role_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`, `role_id`) USING BTREE,
  INDEX `role_user_role_id_foreign`(`role_id` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role_user
-- ----------------------------
INSERT INTO `role_user` VALUES (1, 1, NULL, '2024-03-06 21:27:49', NULL);
INSERT INTO `role_user` VALUES (2, 4, NULL, '2024-03-06 21:29:12', NULL);
INSERT INTO `role_user` VALUES (3, 4, NULL, '2024-03-06 21:29:20', NULL);
INSERT INTO `role_user` VALUES (4, 4, NULL, '2024-03-06 21:29:22', NULL);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_unique`(`name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Administrador', 'Administrador General', 'Administrador del sistema', '2016-08-18 23:00:00', '2019-11-22 18:20:58', NULL);
INSERT INTO `roles` VALUES (2, 'Oficialia', 'Oficialia de partes', 'Oficialia de partes', '2019-11-22 00:00:00', '2019-11-22 18:21:21', NULL);
INSERT INTO `roles` VALUES (3, 'Coordinacion', 'Coordinacion', 'Coordinacion Ejecutiva', '2019-11-22 00:00:00', '2019-11-22 18:21:21', NULL);
INSERT INTO `roles` VALUES (4, 'Titular', 'Subsecretarios/Directores/Jefes de unidad', 'Responsables de las areas', '2017-02-06 00:00:00', '2019-11-22 18:19:26', NULL);
INSERT INTO `roles` VALUES (5, 'Enlace', 'Secretarias', 'Secretarias de oficinas', '2017-02-06 00:00:00', '2019-11-22 18:19:26', NULL);

-- ----------------------------
-- Table structure for t_anexos
-- ----------------------------
DROP TABLE IF EXISTS `t_anexos`;
CREATE TABLE `t_anexos`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_documento_externo` int NULL DEFAULT NULL,
  `id_documento_interno` int NULL DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `extension` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `peso` float(10, 2) NOT NULL,
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_documento_externo`(`id_documento_externo` ASC) USING BTREE,
  INDEX `id_documento_interno`(`id_documento_interno` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_anexos
-- ----------------------------
INSERT INTO `t_anexos` VALUES (1, 1, NULL, 'Anexo-sfp.jpg', 'jpg', 158218.00, 'archivos/oficialia-de-partes/2020/folio/1', '2020-02-10 17:57:07', '2020-02-10 17:57:07', NULL);
INSERT INTO `t_anexos` VALUES (2, NULL, 11, 'Anexo-ficha.pdf', 'pdf', 37057.00, 'archivos/unidad-de-informatica-y-desarrollo-digital/2020/memorandum/11', '2020-03-31 20:18:05', '2020-03-31 20:18:05', NULL);
INSERT INTO `t_anexos` VALUES (3, NULL, 8, 'Anexo-ficha.pdf', 'pdf', 37057.00, 'archivos/unidad-de-informatica-y-desarrollo-digital/2020/memorandum/8', '2020-03-31 20:26:28', '2020-03-31 20:26:28', NULL);
INSERT INTO `t_anexos` VALUES (4, NULL, 18, '212912Anexo-actividades.docx', 'docx', 13967.00, 'archivos/unidad-de-informatica-y-desarrollo-digital/2024/memorandum/18', '2024-03-07 21:29:12', '2024-03-07 21:29:12', NULL);
INSERT INTO `t_anexos` VALUES (5, NULL, 18, '212943Anexo-actividades.docx', 'docx', 13967.00, 'archivos/unidad-de-informatica-y-desarrollo-digital/2024/memorandum/18', '2024-03-07 21:29:43', '2024-03-07 21:29:43', NULL);

-- ----------------------------
-- Table structure for t_conocimiento
-- ----------------------------
DROP TABLE IF EXISTS `t_conocimiento`;
CREATE TABLE `t_conocimiento`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_documento` int NOT NULL,
  `id_area` int NOT NULL,
  `area_nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `area_responsable` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `es_nuevo` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_area`(`id_area` ASC) USING BTREE,
  INDEX `id_documento`(`id_documento` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_conocimiento
-- ----------------------------

-- ----------------------------
-- Table structure for t_destinatarios
-- ----------------------------
DROP TABLE IF EXISTS `t_destinatarios`;
CREATE TABLE `t_destinatarios`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_documento_externo` int NULL DEFAULT NULL,
  `id_documento_interno` int NULL DEFAULT NULL,
  `id_area` int NOT NULL,
  `area_responsable` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `responsable_area` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `es_nuevo` tinyint(1) NOT NULL,
  `acuse` datetime NULL DEFAULT NULL,
  `id_usuario_acuse` int NULL DEFAULT NULL,
  `id_tipo_envio` int NOT NULL COMMENT '(Destinatario original o copia)',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_area`(`id_area` ASC) USING BTREE,
  INDEX `id_usuario_acuse`(`id_usuario_acuse` ASC) USING BTREE,
  INDEX `id_documento_interno`(`id_documento_interno` ASC) USING BTREE,
  INDEX `id_documento_externo`(`id_documento_externo` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 137 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_destinatarios
-- ----------------------------
INSERT INTO `t_destinatarios` VALUES (1, NULL, 3, 12, 'Unidad de Apoyo Administrativo', 'Mtro. Joel Pereira Hernandez', 1, NULL, NULL, 1, '2020-02-07 18:31:05', '2020-02-07 18:31:05', NULL);
INSERT INTO `t_destinatarios` VALUES (2, NULL, 3, 16, 'Unidad de Informática y Desarrollo Digital', 'Lic. Rodolfo Jiménez Santos', 0, '2024-01-14 16:03:00', 371, 2, '2020-02-07 18:31:05', '2024-01-14 16:03:00', NULL);
INSERT INTO `t_destinatarios` VALUES (3, NULL, 2, 16, 'Unidad de Informática y Desarrollo Digital', 'Lic. Rodolfo Jiménez Santos', 0, NULL, NULL, 1, '2020-02-07 18:32:55', '2020-05-07 15:35:51', NULL);
INSERT INTO `t_destinatarios` VALUES (4, NULL, 2, 4, 'Encargada de Gestión Ejecutiva Interna', 'Lic. Eréndira Dayani Bravo Garcia', 0, NULL, NULL, 2, '2020-02-07 18:32:55', '2020-02-21 20:19:25', NULL);
INSERT INTO `t_destinatarios` VALUES (5, NULL, 1, 4, 'Encargada de Gestión Ejecutiva Interna', 'Lic. Eréndira Dayani Bravo Garcia', 1, NULL, NULL, 1, '2020-02-07 18:34:37', '2020-02-07 18:34:37', NULL);
INSERT INTO `t_destinatarios` VALUES (6, NULL, 1, 3, 'Secretaria Técnica', 'C.P. María Claudia Vázquez Castillejos', 1, NULL, NULL, 2, '2020-02-07 18:34:37', '2020-02-07 18:34:37', NULL);
INSERT INTO `t_destinatarios` VALUES (7, NULL, 4, 88, 'Coordinación \"C\" de Procedimientos Administrativos', 'Lic. Raúl Rodolfo Camacho Juarez', 1, NULL, NULL, 1, '2020-02-07 18:51:58', '2020-02-07 18:51:58', NULL);
INSERT INTO `t_destinatarios` VALUES (8, NULL, 4, 87, 'Coordinación \"B\" de Procedimientos Administrativos', 'Lic. Ana Luisa Bielma Noriega', 1, NULL, NULL, 1, '2020-02-07 18:51:58', '2020-02-07 18:51:58', NULL);
INSERT INTO `t_destinatarios` VALUES (9, NULL, 4, 86, 'Coordinación \"A\" de Procedimientos Administrativos', 'Lic. María de Lourdes Rivera Centeno', 1, NULL, NULL, 1, '2020-02-07 18:51:58', '2020-02-07 18:51:58', NULL);
INSERT INTO `t_destinatarios` VALUES (10, NULL, 4, 26, 'Coord. de Verificación de la Supervisión Externa de la Obra Pública Estatal', 'Ing. Ramiro Flores Cartagena', 1, NULL, NULL, 1, '2020-02-07 18:51:58', '2020-02-07 18:51:58', NULL);
INSERT INTO `t_destinatarios` VALUES (11, NULL, 4, 24, 'Coordinación de Comisarios y Despachos Externos', 'Lic. Lorena Maza Leon', 1, NULL, NULL, 1, '2020-02-07 18:51:58', '2020-02-07 18:51:58', NULL);
INSERT INTO `t_destinatarios` VALUES (12, NULL, 4, 8, 'Coordinación de Enlace de Auditorías Estado-Federación', 'C.P. Diego Lugo Segovia', 1, NULL, NULL, 1, '2020-02-07 18:51:58', '2020-02-07 18:51:58', NULL);
INSERT INTO `t_destinatarios` VALUES (13, NULL, 4, 5, 'Coordinación de Programación de Auditorías y Evaluación Interna', 'C.P. José Roberto García Gordillo', 1, NULL, NULL, 1, '2020-02-07 18:51:58', '2020-02-07 18:51:58', NULL);
INSERT INTO `t_destinatarios` VALUES (14, NULL, 4, 4, 'Encargada de Gestión Ejecutiva Interna', 'Lic. Eréndira Dayani Bravo Garcia', 1, NULL, NULL, 1, '2020-02-07 18:51:58', '2020-02-07 18:51:58', NULL);
INSERT INTO `t_destinatarios` VALUES (15, NULL, 4, 98, 'Dirección de Evolución Patrimonial Conflicto de Interés y Ética', 'Lic. Sandra del Carmen Domínguez Lopez', 1, NULL, NULL, 1, '2020-02-07 18:51:58', '2020-02-07 18:51:58', NULL);
INSERT INTO `t_destinatarios` VALUES (16, NULL, 4, 94, 'Dirección Jurídica', 'Lic. Daniel de Jesús Alhor Zea', 1, NULL, NULL, 1, '2020-02-07 18:51:58', '2020-02-07 18:51:58', NULL);
INSERT INTO `t_destinatarios` VALUES (17, NULL, 4, 91, 'Dirección de Enlace de Fiscalización', 'Lic. Nadia López Diaz', 1, NULL, NULL, 1, '2020-02-07 18:51:58', '2020-02-07 18:51:58', NULL);
INSERT INTO `t_destinatarios` VALUES (18, NULL, 4, 85, 'Dirección de Responsabilidades', 'Lic. Patricia Mendoza Bravo', 1, NULL, NULL, 1, '2020-02-07 18:51:58', '2020-02-07 18:51:58', NULL);
INSERT INTO `t_destinatarios` VALUES (19, NULL, 4, 70, 'Dirección de Contraloría Social', 'Lic. María del Carmen Zebadua Pérez', 1, NULL, NULL, 1, '2020-02-07 18:51:58', '2020-02-07 18:51:58', NULL);
INSERT INTO `t_destinatarios` VALUES (20, NULL, 4, 64, 'Dirección de Auditoría en Entidades \"B\"', 'C.P. Verónica Cruz Samayoa', 1, NULL, NULL, 1, '2020-02-07 18:51:58', '2020-02-07 18:51:58', NULL);
INSERT INTO `t_destinatarios` VALUES (21, NULL, 4, 55, 'Dirección de Auditoría en Entidades \"A\"', 'Ing. Marco Antonio Cáceres Rodas', 1, NULL, NULL, 1, '2020-02-07 18:51:58', '2020-02-07 18:51:58', NULL);
INSERT INTO `t_destinatarios` VALUES (22, NULL, 4, 51, 'Dirección de Auditoría a Programas Federales', 'C.P. Carlos Alberto Góngora Solis', 1, NULL, NULL, 1, '2020-02-07 18:51:58', '2020-02-07 18:51:58', NULL);
INSERT INTO `t_destinatarios` VALUES (23, NULL, 4, 41, 'Dirección de Auditorías en Dependencias \"B\"', 'C.P. Antonio Ismael Torres Bouchot', 1, NULL, NULL, 1, '2020-02-07 18:51:58', '2020-02-07 18:51:58', NULL);
INSERT INTO `t_destinatarios` VALUES (24, NULL, 4, 30, 'Dirección de  Auditoría en Dependencias \"A\"', 'C.P. Luis Roberto Sánchez Aguilar', 1, NULL, NULL, 1, '2020-02-07 18:51:58', '2020-02-07 18:51:58', NULL);
INSERT INTO `t_destinatarios` VALUES (25, NULL, 4, 3, 'Secretaria Técnica', 'C.P. María Claudia Vázquez Castillejos', 1, NULL, NULL, 1, '2020-02-07 18:51:58', '2020-02-07 18:51:58', NULL);
INSERT INTO `t_destinatarios` VALUES (26, NULL, 4, 1, 'Oficina de la C. Secretaria', 'Mtra. Liliana Angell Gonzalez', 1, NULL, NULL, 2, '2020-02-07 18:51:58', '2020-02-07 18:51:58', NULL);
INSERT INTO `t_destinatarios` VALUES (27, NULL, 5, 98, 'Dirección de Evolución Patrimonial Conflicto de Interés y Ética', 'Lic. Sandra del Carmen Domínguez Lopez', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (28, NULL, 5, 94, 'Dirección Jurídica', 'Lic. Daniel de Jesús Alhor Zea', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (29, NULL, 5, 91, 'Dirección de Enlace de Fiscalización', 'Lic. Nadia López Diaz', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (30, NULL, 5, 85, 'Dirección de Responsabilidades', 'Lic. Patricia Mendoza Bravo', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (31, NULL, 5, 70, 'Dirección de Contraloría Social', 'Lic. María del Carmen Zebadua Pérez', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (32, NULL, 5, 64, 'Dirección de Auditoría en Entidades \"B\"', 'C.P. Verónica Cruz Samayoa', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (33, NULL, 5, 55, 'Dirección de Auditoría en Entidades \"A\"', 'Ing. Marco Antonio Cáceres Rodas', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (34, NULL, 5, 51, 'Dirección de Auditoría a Programas Federales', 'C.P. Carlos Alberto Góngora Solis', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (35, NULL, 5, 41, 'Dirección de Auditorías en Dependencias \"B\"', 'C.P. Antonio Ismael Torres Bouchot', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (36, NULL, 5, 30, 'Dirección de  Auditoría en Dependencias \"A\"', 'C.P. Luis Roberto Sánchez Aguilar', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (37, NULL, 5, 150, 'Área de Recursos Financieros y Contabilidad', 'C.P. Rosario Hernandez Jimenez', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (38, NULL, 5, 145, 'Área Coordinadora de Archivos', 'Lic. Carlos Ricardo Esponda Canela', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (39, NULL, 5, 144, 'Departamento de Impugnaciones', 'Lic. Raúl Camacho Juarez', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (40, NULL, 5, 143, 'Área de Auditoría Pública  en el Régimen Estatal de Protección Social en la Salud', 'Lic. Juan Antonio Jiménez Martinez', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (41, NULL, 5, 142, 'Área de Control Seguimiento Evaluación y Normatividad Jurídica de Salud', 'Lic. Lisandro Nucamendi Gonzalez', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (42, NULL, 5, 141, 'Área de Auditoría Pública de Salud', 'Lic. María Magdalena Grajales Garcia', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (43, NULL, 5, 140, 'Área de Auditoría Pública  a Entidades Productivas', 'Lic. Verónica Juárez Nafate', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (44, NULL, 5, 139, 'Área de Control Seguimiento Evaluación y Normatividad Jurídica en el ISSTECH', 'Lic. Elda Ruth Zambrano Gutierrez', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (45, NULL, 5, 138, 'Área de Auditoría Pública en el ISSTECH', 'Lic. Marina Siboney Peña Merino', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (46, NULL, 5, 137, 'Área de Auditoría Pública en Organismos Desectorizados', 'Lic. José Manuel Salazar Ovando', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (47, NULL, 5, 136, 'Área de Control Seguimiento Evaluación y Normatividad Jurídica del INIFECH', 'Ing. Carlos Adán Vázquez Lara ', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (48, NULL, 5, 135, 'Área de Auditoría Pública  del Inifech', 'Lic. Edy Cabrera Rodriguez', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (49, NULL, 5, 134, 'Área de Auditoría Pública en Organismos Descentralizados', 'Lic. José Emilio Mandujano Wilson', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (50, NULL, 5, 133, 'Área de Control Seguimiento Evaluación y Normatividad Jurídica para el Sector de Educación Media', 'Lic. José Rafael Castañeda Vazquez ', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (51, NULL, 5, 132, 'Área de Auditoría Pública para el Sector de Educación Media', 'Lic. Benjamín Palafox Palacios', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (52, NULL, 5, 131, 'Área de Auditoría Pública para el Sector Seguridad y Protección Civil', 'Lic. Ciro López Esquipulas ', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (53, NULL, 5, 130, 'Área de Control Seguimiento Evaluación y Normatividad Jurídica para el Sector Educativo Tecnológico', 'Lic. Humberto Carlos López Campos', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (54, NULL, 5, 129, 'Área de Auditoría Pública para el Sector Educativo Tecnológico', 'Lic. Faustina Reyes Hernandez', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (55, NULL, 5, 128, 'Área de Auditoría Pública  Región Istmo-Costa', 'Lic. María de Lourdes Salinas Escobar', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (56, NULL, 5, 127, 'Área de Auditoría Pública para el Sector Medio Ambiente y Trabajo', 'Lic. Gilberto Nicanor Hernández Dominguez', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (57, NULL, 5, 126, 'Área de Control Seguimiento Evaluacion y Normatividad Juridica en los Sectores Carreteros e Hidráulico', 'Lic. Amado Alegría Hernandez', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (58, NULL, 5, 125, 'Área de Auditoría Pública en los Sectores Carreteros E Hidráulico', 'Lic. Fabricio Espinosa Hernandez ', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (59, NULL, 5, 124, 'Área de Control Seguimiento Evaluacion y Normatividad Juridica en la Secretaría de Obra Pública y Comunicaciones', 'Lic. María Agustina Cantoral Molina', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (60, NULL, 5, 123, 'Área de Auditoría Pública en la Secretaría de Obra Pública y Comunicaciones', 'Lic. Rene Armando Juárez Palacios', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (61, NULL, 5, 122, 'Área de Control Seguimiento Evaluacion y Normatividad Juridica en la Subsecretaria de Educación Federalizada', 'Lic. Ignacio Posadas  Rios ', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (62, NULL, 5, 121, 'Área de Auditoría Pública en la Subsecretaria de Educación Federalizada', 'Lic. Rusbi Adriana Carrascosa Solis', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (63, NULL, 5, 120, 'Área de Control Seguimiento Evaluacion y Normatividad Juridica Secretaria de Educación', 'Lic. Norma Elena Vázquez Castillejos', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (64, NULL, 5, 119, 'Área de Auditoría Pública Secretaria de Educación', 'Lic. Julio Cesar Santiago Meza', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (65, NULL, 5, 118, 'Área de Control Seguimiento Evaluacion y Normatividad Juridica Seguridad y Protección Ciudadana', 'Lic. Hermila Antonia Morales Lesciur', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (66, NULL, 5, 117, 'Área de Auditoría Pública Seguridad y Protección Ciudadana', 'Lic. Cesar Zebadua Hernandez ', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (67, NULL, 5, 116, 'Área de Control Seguimiento Evaluacion y Normatividad Juridica  Región Soconusco', 'Lic. Francisco Cundapi Hernandez ', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (68, NULL, 5, 115, 'Área de Auditoría Pública  Región Soconusco', 'Lic. Amanda Escobar Muñoz', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (69, NULL, 5, 114, 'Área de Control Seguimiento Evaluacion y Normatividad Juridica Sector Desarrollo Social', 'Lic. Heber Antonio Rincón Sarmiento', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (70, NULL, 5, 113, 'Área de Auditoría Pública Sector desarrollo Social', 'Lic. Eréndira Corzo Reyes', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (71, NULL, 5, 112, 'Área de Control Seguimiento Evaluacion y Normatividad Juridica Sector Gobierno y Planeación', 'Lic. Elizabeth Sánchez Cruz', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (72, NULL, 5, 111, 'Área de Auditoría Pública Sector Gobierno y Planeación', 'Lic. Raúl Camas Vida', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (73, NULL, 5, 110, 'Área de Auditoría Pública para el Sector Campo', 'Lic. Verónica Janett Domínguez Farrera', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (74, NULL, 5, 109, 'Área de Control Seguimiento Evaluacion y Normatividad Juridica a Fideicomisos', 'Lic. Isela Rodríguez Oliva', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (75, NULL, 5, 108, 'Área de Auditoría Pública a Fideicomisos', 'Lic. Benito Martin Díaz Ballinas', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (76, NULL, 5, 107, 'Área de Control Seguimiento Evaluación y Normatividad Jurídica en la Secretaria de Hacienda', 'Lic. Norma de Jesús López Juarez', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (77, NULL, 5, 106, 'Área de Auditoría Pública en la Secretaria de Hacienda', 'Lic. Oscar Coello Perez', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (78, NULL, 5, 105, 'Área de Control Seguimiento Evaluación y Normatividad Jurídica Sector Económico, Turismo y Transporte', 'Lic. Norma Elena Vázquez Castillejos', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (79, NULL, 5, 104, 'Área de Auditoría Pública Sector Económico, Turismo y Transporte', 'Lic. Claudia Melchor Grajales', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (80, NULL, 5, 101, 'Departamento de Ética y Prevención de Conflicto de Interés', 'Lic. Wilson Espinosa Aguilar', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (81, NULL, 5, 100, 'Departamento de Declaración Patrimonial', 'Lic. Fredy Ventura De Los Santos', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (82, NULL, 5, 99, 'Departamento de Evolución Patrimonial', 'Lic. Johny Iglesias Reyes', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (83, NULL, 5, 97, 'Departamento de Querellas y Denuncias', 'Lic. Ana Paulina Ovando Gallardo', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (84, NULL, 5, 96, 'Departamento de Asuntos Jurídicos', 'Lic. Amado Pérez Rodriguez', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (85, NULL, 5, 95, 'Departamento de Procedimientos Administrativos', 'Lic. Marco Antonio Escobar Alvarez', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (86, NULL, 5, 93, 'Departamento de Análisis Documental', 'Lic. Adalberto Ruiz Aguilar', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (87, NULL, 5, 92, 'Departamento de Informe Técnico de la Fiscalización', 'Arq. Juan Carlos Castro Alegria', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (88, NULL, 5, 89, 'Departamento de Proyectistas', 'Lic. Jorge Israel Sarmiento Gonzalez', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (89, NULL, 5, 72, 'Departamento de Asesoría de Contraloría Social', 'Lic. Anuar Pavel Ulloa Montiel', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (90, NULL, 5, 71, 'Departamento de Evaluación de la Gestión Pública', 'Lic. Jorge Arturo Ruiz Coutiño', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (91, NULL, 5, 65, 'Departamento de Control y Apoyo de Auditorías a Entidades \"B\"', 'Lic. Araceli Solís Rios', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (92, NULL, 5, 56, 'Departamento de Control y Apoyo de Auditorías a Entidades \"A\"', 'C.P. Hugo Alberto Castro Ruiz', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (93, NULL, 5, 53, 'Departamento de Auditoría Técnica', 'Arq. José Alberto Gutiérrez Schroeder', 1, NULL, NULL, 1, '2020-02-07 19:45:54', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_destinatarios` VALUES (94, NULL, 5, 52, 'Departamento de Auditoría Financiera', 'C.P. Carlos Jesus Gómez Saad', 1, NULL, NULL, 1, '2020-02-07 19:45:55', '2020-02-07 19:45:55', NULL);
INSERT INTO `t_destinatarios` VALUES (95, NULL, 5, 43, 'Departamento de Control y Apoyo de Auditorías a Dependencias \"B\"', 'C.P. Juan Carlos Morellon Hernandez', 1, NULL, NULL, 1, '2020-02-07 19:45:55', '2020-02-07 19:45:55', NULL);
INSERT INTO `t_destinatarios` VALUES (96, NULL, 5, 31, 'Departamento de Control y Apoyo de Auditorías a Dependencias \"A\"', 'C.P. Francisco Javier Chandomi Hernandez', 1, NULL, NULL, 1, '2020-02-07 19:45:55', '2020-02-07 19:45:55', NULL);
INSERT INTO `t_destinatarios` VALUES (97, NULL, 5, 28, 'Área de Verificación de la Supervisión Externa', 'Ing. Manlio Favio Chacón Sol', 1, NULL, NULL, 1, '2020-02-07 19:45:55', '2020-02-07 19:45:55', NULL);
INSERT INTO `t_destinatarios` VALUES (98, NULL, 5, 27, 'Área de Registro de Contratistas y Supervisores de Obra Pública', 'Arq. Arturo Moguel Nuricumbo', 1, NULL, NULL, 1, '2020-02-07 19:45:55', '2020-02-07 19:45:55', NULL);
INSERT INTO `t_destinatarios` VALUES (99, NULL, 5, 25, 'Área de Supervisión de Comisarios y despachos Externos', 'C.P. Elizabeth Soto Figueroa', 1, NULL, NULL, 1, '2020-02-07 19:45:55', '2020-02-07 19:45:55', NULL);
INSERT INTO `t_destinatarios` VALUES (100, NULL, 5, 23, 'Área de Desarrollo Institucional', 'Mtro. Carlos López Limon', 1, NULL, NULL, 1, '2020-02-07 19:45:55', '2020-02-07 19:45:55', NULL);
INSERT INTO `t_destinatarios` VALUES (101, NULL, 5, 22, 'Área de Planeación y Seguimiento Operativo', 'C.P. Humberto Ross Zuñiga', 1, NULL, NULL, 1, '2020-02-07 19:45:55', '2020-02-07 19:45:55', NULL);
INSERT INTO `t_destinatarios` VALUES (102, NULL, 5, 20, 'Área de Firma Electrónica', 'Ing. Roberto David Hernández Martinez', 1, NULL, NULL, 1, '2020-02-07 19:45:55', '2020-02-07 19:45:55', NULL);
INSERT INTO `t_destinatarios` VALUES (103, NULL, 5, 19, 'Área de Diseño E Imagen', 'Ing. Calixto David Gutiérrez Gomez', 1, NULL, NULL, 1, '2020-02-07 19:45:55', '2020-02-07 19:45:55', NULL);
INSERT INTO `t_destinatarios` VALUES (104, NULL, 5, 18, 'Área de Servicios a Usuarios', 'Ing. Gabriel Narcia Gómez', 1, NULL, NULL, 1, '2020-02-07 19:45:55', '2020-02-07 19:45:55', NULL);
INSERT INTO `t_destinatarios` VALUES (105, NULL, 5, 17, 'Área de Desarrollo de Sistemas', 'Ing. Manuel Jesús Aguiar Gamez', 1, NULL, NULL, 1, '2020-02-07 19:45:55', '2020-02-07 19:45:55', NULL);
INSERT INTO `t_destinatarios` VALUES (106, NULL, 5, 15, 'Área de Recursos Materiales y Servicios', 'Lic. Ana Melina Zárate Valencia', 1, NULL, NULL, 1, '2020-02-07 19:45:55', '2020-02-07 19:45:55', NULL);
INSERT INTO `t_destinatarios` VALUES (107, NULL, 5, 14, 'Área de Recursos Financieros y Contabilidad', 'C.P. José Isidro Ovando Perez', 1, NULL, NULL, 1, '2020-02-07 19:45:55', '2020-02-07 19:45:55', NULL);
INSERT INTO `t_destinatarios` VALUES (108, NULL, 5, 13, 'Área de Recursos Humanos', 'Lic. Magally Elizabeth Guillen Montesinos', 1, NULL, NULL, 1, '2020-02-07 19:45:55', '2020-02-07 19:45:55', NULL);
INSERT INTO `t_destinatarios` VALUES (109, NULL, 5, 10, 'Recepción', 'C. Consuelo Santiago Mendoza', 1, NULL, NULL, 1, '2020-02-07 19:45:55', '2020-02-07 19:45:55', NULL);
INSERT INTO `t_destinatarios` VALUES (110, NULL, 5, 9, 'Oficialía de Partes', 'Lic. Grisel Isabel Espinosa Coello', 1, NULL, NULL, 1, '2020-02-07 19:45:55', '2020-02-07 19:45:55', NULL);
INSERT INTO `t_destinatarios` VALUES (111, NULL, 5, 7, 'Área de Evaluación Interna', 'Lic. Patricia Juárez Nafate', 1, NULL, NULL, 1, '2020-02-07 19:45:55', '2020-02-07 19:45:55', NULL);
INSERT INTO `t_destinatarios` VALUES (112, NULL, 5, 6, 'Área de Programación de Auditorías', 'C.P. Zulma del Roció Nuricumbo Corzo', 1, NULL, NULL, 1, '2020-02-07 19:45:55', '2020-02-07 19:45:55', NULL);
INSERT INTO `t_destinatarios` VALUES (113, NULL, 5, 7, 'Área de Evaluación Interna', 'Lic. Patricia Juárez Nafate', 1, NULL, NULL, 2, '2020-02-07 19:45:55', '2020-02-07 19:45:55', NULL);
INSERT INTO `t_destinatarios` VALUES (114, NULL, 5, 16, 'Unidad de Informatica y Desarrollo Digital', 'Lic. Rodolfo Jimenez Santos', 0, NULL, NULL, 1, NULL, '2020-02-07 21:06:41', NULL);
INSERT INTO `t_destinatarios` VALUES (115, 1, NULL, 1, 'Oficina de la C. Secretaria', 'Mtra. Liliana Angell Gonzalez', 0, '2020-02-10 18:01:20', 374, 1, '2020-02-10 17:57:06', '2020-02-10 18:01:20', NULL);
INSERT INTO `t_destinatarios` VALUES (116, NULL, 6, 16, 'Unidad de Informática y Desarrollo Digital', 'Lic. Rodolfo Jiménez Santos', 0, '2020-03-31 19:31:16', 371, 1, '2020-02-13 17:00:29', '2020-03-31 19:31:16', NULL);
INSERT INTO `t_destinatarios` VALUES (117, NULL, 6, 2, 'Secretaria Particular', 'Lic. María del Rocío Aguilar Jiménez', 1, NULL, NULL, 2, '2020-02-13 17:00:29', '2020-02-13 17:00:29', NULL);
INSERT INTO `t_destinatarios` VALUES (118, NULL, 7, 103, 'Unidad de Trasparencia', 'Lic. Maritza del Carmen Pintado Ortega', 1, NULL, NULL, 1, '2020-02-13 17:36:22', '2020-02-13 17:36:22', NULL);
INSERT INTO `t_destinatarios` VALUES (119, NULL, 7, 21, 'Unidad de Planeación', 'Ing. Carlos Alberto Jiménez Aquino', 1, NULL, NULL, 1, '2020-02-13 17:36:22', '2020-02-13 17:36:22', NULL);
INSERT INTO `t_destinatarios` VALUES (120, NULL, 7, 16, 'Unidad de Informática y Desarrollo Digital', 'Lic. Rodolfo Jiménez Santos', 1, NULL, NULL, 1, '2020-02-13 17:36:22', '2020-02-13 17:36:22', NULL);
INSERT INTO `t_destinatarios` VALUES (121, NULL, 7, 12, 'Unidad de Apoyo Administrativo', 'Mtro. Joel Pereira Hernandez', 1, NULL, NULL, 1, '2020-02-13 17:36:22', '2020-02-13 17:36:22', NULL);
INSERT INTO `t_destinatarios` VALUES (122, NULL, 7, 11, 'Unidad de Transparencia', 'Lic. Maritza del Carmen Pintado  Ortega', 1, NULL, NULL, 1, '2020-02-13 17:36:22', '2020-02-13 17:36:22', NULL);
INSERT INTO `t_destinatarios` VALUES (123, NULL, 7, 3, 'Secretaria Técnica', 'C.P. María Claudia Vázquez Castillejos', 1, NULL, NULL, 2, '2020-02-13 17:36:22', '2020-02-13 17:36:22', NULL);
INSERT INTO `t_destinatarios` VALUES (124, NULL, 10, 11, 'Unidad de Transparencia', 'Lic. Maritza del Carmen Pintado  Ortega', 1, NULL, NULL, 1, '2020-03-20 19:44:52', '2020-03-20 19:44:52', NULL);
INSERT INTO `t_destinatarios` VALUES (125, NULL, 10, 2, 'Secretaria Particular', 'Lic. María del Rocío Aguilar Jiménez', 1, NULL, NULL, 2, '2020-03-20 19:44:53', '2020-03-20 19:44:53', NULL);
INSERT INTO `t_destinatarios` VALUES (126, NULL, 9, 3, 'Secretaria Técnica', 'C.P. María Claudia Vázquez Castillejos', 1, NULL, NULL, 1, '2020-03-20 20:34:32', '2020-03-20 20:34:32', NULL);
INSERT INTO `t_destinatarios` VALUES (127, NULL, 11, 12, 'Unidad de Apoyo Administrativo', 'Mtro. Joel Pereira Hernandez', 1, NULL, NULL, 1, '2020-03-31 20:24:38', '2020-03-31 20:24:38', NULL);
INSERT INTO `t_destinatarios` VALUES (128, NULL, 13, 2, 'Secretaria Particular', 'Lic. María del Rocío Aguilar Jiménez', 1, NULL, NULL, 1, '2024-03-07 03:20:36', '2024-03-07 03:20:36', NULL);
INSERT INTO `t_destinatarios` VALUES (129, NULL, 16, 16, 'Unidad de Informática y Desarrollo Digital', 'Lic. Rodolfo Jiménez Santos', 1, NULL, NULL, 1, '2024-03-07 20:21:34', '2024-03-07 20:21:34', NULL);
INSERT INTO `t_destinatarios` VALUES (130, NULL, 17, 2, 'Secretaria Particular', 'Lic. María del Rocío Aguilar Jiménez', 1, NULL, NULL, 1, '2024-03-07 21:03:55', '2024-03-07 21:03:55', NULL);
INSERT INTO `t_destinatarios` VALUES (131, NULL, 18, 7, 'Área de Evaluación Interna', 'Lic. Patricia Juárez Nafate', 1, NULL, NULL, 1, '2024-03-07 21:28:55', '2024-03-07 21:28:55', NULL);
INSERT INTO `t_destinatarios` VALUES (132, NULL, 18, 7, 'Área de Evaluación Interna', 'Lic. Patricia Juárez Nafate', 1, NULL, NULL, 1, '2024-03-07 21:29:12', '2024-03-07 21:29:12', NULL);
INSERT INTO `t_destinatarios` VALUES (133, NULL, 18, 7, 'Área de Evaluación Interna', 'Lic. Patricia Juárez Nafate', 1, NULL, NULL, 1, '2024-03-07 21:29:43', '2024-03-07 21:29:43', NULL);
INSERT INTO `t_destinatarios` VALUES (134, NULL, 15, 3, 'Secretaria Técnica', 'C.P. María Claudia Vázquez Castillejos', 1, NULL, NULL, 1, '2024-03-07 21:48:24', '2024-03-07 21:48:24', NULL);
INSERT INTO `t_destinatarios` VALUES (135, NULL, 15, 2, 'Secretaria Particular', 'Lic. María del Rocío Aguilar Jiménez', 1, NULL, NULL, 2, '2024-03-07 21:48:24', '2024-03-07 21:48:24', NULL);
INSERT INTO `t_destinatarios` VALUES (136, NULL, 15, 12, 'Unidad de Apoyo Administrativo', 'Mtro. Joel Pereira Hernandez', 1, NULL, NULL, 2, '2024-03-07 21:48:24', '2024-03-07 21:48:24', NULL);

-- ----------------------------
-- Table structure for t_documentos_bitacoras
-- ----------------------------
DROP TABLE IF EXISTS `t_documentos_bitacoras`;
CREATE TABLE `t_documentos_bitacoras`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_area` int NULL DEFAULT NULL,
  `id_status` int NULL DEFAULT NULL,
  `id_usuario` int NULL DEFAULT NULL,
  `id_dependencia` int NULL DEFAULT NULL,
  `id_tipo_documento` int NULL DEFAULT NULL,
  `folio` varchar(80) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `asunto` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `destinatario` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `cargo_destinatario` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `codigo_clasificacion` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fecha_documento` date NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_documentos_bitacoras
-- ----------------------------
INSERT INTO `t_documentos_bitacoras` VALUES (1, 16, 1, 371, 4, 7, 'aswrw34543q', 'nnnnn', 'desd desd desd', 'ddddeeee', NULL, '2020-02-20', '2020-02-20 18:22:45', '2020-02-20 18:22:45', NULL);

-- ----------------------------
-- Table structure for t_documentos_externos
-- ----------------------------
DROP TABLE IF EXISTS `t_documentos_externos`;
CREATE TABLE `t_documentos_externos`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_area_envia` int NOT NULL,
  `id_dependencia` int NOT NULL,
  `id_destinatario` int NULL DEFAULT NULL,
  `remitente` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_tipo_documento` int NOT NULL,
  `numero` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fecha` date NOT NULL,
  `observacion` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `enviado` tinyint(1) NOT NULL DEFAULT 0,
  `id_usuario` int NOT NULL,
  `acusado` tinyint(1) NULL DEFAULT 0,
  `turnado` tinyint(1) NULL DEFAULT 0,
  `responsable_area` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `area_responsable` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `lugar_area` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `fecha_envio` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_dependencia`(`id_dependencia` ASC) USING BTREE,
  INDEX `id_tipo_documento`(`id_tipo_documento` ASC) USING BTREE,
  INDEX `id_area_envia`(`id_area_envia` ASC) USING BTREE,
  INDEX `id_usuario`(`id_usuario` ASC) USING BTREE,
  INDEX `id_destinatario`(`id_destinatario` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_documentos_externos
-- ----------------------------
INSERT INTO `t_documentos_externos` VALUES (1, 9, 3, 1, NULL, 7, 'SH/001/2020', '2020-02-10', 'Hasta el momento ninguna', 1, 370, 0, 0, 'Lic. Grisel Isabel Espinosa Coello', 'Oficialía de Partes', NULL, '2020-02-10 17:02:06', '2020-02-10 17:57:06', '2020-02-10 17:57:06', NULL);

-- ----------------------------
-- Table structure for t_documentos_internos
-- ----------------------------
DROP TABLE IF EXISTS `t_documentos_internos`;
CREATE TABLE `t_documentos_internos`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_documento_interno` int NULL DEFAULT NULL,
  `id_documento_aux` int NULL DEFAULT NULL,
  `id_dependencia` int NOT NULL,
  `id_area_envia` int NOT NULL,
  `id_area_aux` int NOT NULL,
  `id_usuario` int NOT NULL,
  `id_tipo_documento` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `folio` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `anio_folio` year NULL DEFAULT NULL,
  `destinatario_text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `destinatario` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `ccp` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `asunto` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cuerpo` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `area_responsable` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cargo_responsable` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `responsable_area` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `turnado` tinyint(1) NULL DEFAULT 0,
  `firma` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL COMMENT 'Firma Electrónica en base64',
  `serie` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT 'Serie del certificado electrónico',
  `secuencia` int NULL DEFAULT NULL COMMENT 'Secuencia de firmado electrónico',
  `fecha_firma` datetime NULL DEFAULT NULL COMMENT 'Fecha del firmado electrónico',
  `acusado` tinyint(1) NULL DEFAULT 0 COMMENT 'Cambiara a 1 cuando todos hayan acusado el documentos enviado.',
  `sended_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_documentos_internos
-- ----------------------------
INSERT INTO `t_documentos_internos` VALUES (1, NULL, 1, 4, 2, 0, 373, '2', 'SHyFP/SP/00003/2020', 2020, '[{\"responsable\":\"Lic. Er\\u00e9ndira Dayani Bravo Garcia\",\"area\":\"Encargada de Gesti\\u00f3n Ejecutiva Interna\"}]', '[\"4\"]', '[\"3\"]', 'Seguimiento de todos los folios del 2020', '<p>En esta sección encontrarás una adaptación al Banco de\r\n  Textos de las 20 actividades, basadas en textos expositivos, para mejorar \r\nla lectura comprensiva en el aula para tercer ciclo de Educación Primaria y primer ciclo de E.S.O. <br></p>', 'Secretaria Particular', 'Secretario Particular', 'Lic. María del Rocío Aguilar Jiménez', 0, 'Nm92wbVtlPPFxdCW8GJtheA2tYS+y5ry/0oovJ+aJg0DE8YH6IdipgsOUmeDtFT89VdDpanG1Wct5EPmku9hoXIuRqThOkQiR0yssUmPe7GQVWaoH5n7PaLOV7xd5jdvaKE2nD1Dzghn/sTQuDo50N32jGTyeDQ4OJHT5IGPVmw=', '00d41f', 6836735, '2020-02-07 11:39:43', 0, '2020-02-07 18:34:37', '2020-02-07 18:02:02', '2020-02-07 18:34:37', NULL);
INSERT INTO `t_documentos_internos` VALUES (2, NULL, 2, 4, 2, 0, 373, '2', 'SHyFP/SP/00002/2020', 2020, '[{\"responsable\":\"Lic. Rodolfo Jim\\u00e9nez Santos\",\"area\":\"Unidad de Inform\\u00e1tica y Desarrollo Digital\"}]', '[\"16\"]', '[\"4\"]', 'Como van con el seguimiento del sistema de documentos', '<p>En esta sección encontrarás una adaptación al Banco de\r\n  Textos de las 20 actividades, basadas en textos expositivos, para mejorar \r\nla lectura comprensiva en el aula para tercer ciclo de Educación Primaria y primer ciclo de E.S.O. <br></p>', 'Secretaria Particular', 'Secretario Particular', 'Lic. María del Rocío Aguilar Jiménez', 0, 'UxRWhuFAGn2qw6pqHMh1WTwDSgDajt+gInBUc+WX7HI1BCIk/x6xweToWUNdfjdB4LpRSnYTMuYtUTKTmdDEzmu9Q94euyg1mSahfcvQJcSf+284kn91FGoqQnFMtlluszBaqcDTJ4zFJStmhFFCNNJ4ykyAe/nrYAodvnGHClI=', '00d41f', 6836729, '2020-02-07 11:38:01', 0, '2020-02-07 18:32:55', '2020-02-07 18:07:43', '2020-02-07 18:32:55', NULL);
INSERT INTO `t_documentos_internos` VALUES (3, NULL, 3, 4, 2, 0, 373, '2', 'SHyFP/SP/00001/2020', 2020, '[{\"responsable\":\"Mtro. Joel Pereira Hernandez\",\"area\":\"Unidad de Apoyo Administrativo\"}]', '[\"12\"]', '[\"16\"]', 'Solicitud de cuentas para el SGDv2', '<p>En esta sección encontrarás una adaptación al Banco de\r\n  Textos de las 20 actividades, basadas en textos expositivos, para mejorar \r\nla lectura comprensiva en el aula para tercer ciclo de Educación Primaria y primer ciclo de E.S.O. <br></p>', 'Secretaria Particular', 'Secretario Particular', 'Lic. María del Rocío Aguilar Jiménez', 0, 'OTQ/H85ek9GlVdubWvkzXwSQkD2Au5eFyH8kBEFnAyXQlS2zsifoo2LnHtswO96pijK+jScqNAsEk36ycVw7HzfN2QmxT4k1mYN11fawW+laZttuCRphT1mXy4kYqrbZ6JOJWt0Iapngttk5EYN2PTc8orkgUoeI9XplzeeUm7E=', '00d41f', 6836672, '2020-02-07 11:36:11', 0, '2020-02-07 18:31:05', '2020-02-07 18:29:41', '2020-02-07 18:31:05', NULL);
INSERT INTO `t_documentos_internos` VALUES (4, NULL, 4, 4, 2, 0, 373, '3', 'SHyFP/SP/00001/2020', 2020, '[{\"responsable\":\"Coordinador\"},{\"responsable\":\"Director\"},{\"responsable\":\"Secretario Técnica\"}]', '[\"8\",\"3\",\"7\"]', '[\"1\"]', 'Circular de no comer en las oficinas', '<p>No se sabe que la liebre tenga amigos en el mundo animal. En cambio, \r\nson muchísimos sus enemigos: todos ellos carnívoros, desde la minúscula \r\ncomadreja al perezosísimo tejón semivegetariano.</p><p>Por sentirse tan perseguida, la liebre ha aprendido a desconfiar de \r\ntodo, actuar con máxima cautela y potenciar sus dotes de huida. Una \r\nliebre acosada no huye en línea recta, como los demás animales, sino en \r\nzig-zag, y da unos curiosos saltos, todos ellos con el objeto de \r\nperturbar a sus enemigos. Si la suerte le permite llegar a las cercanías\r\n de su madriguera, no penetra en ella directamente, sino que se \r\nentretiene en confundir sus rastros, también para desorientar al \r\nperseguidor.</p>', 'Secretaria Particular', 'Secretario Particular', 'Lic. María del Rocío Aguilar Jiménez', 0, 'hxdzMM/5kJDfA0R9UblxqOQYPFnmy2tO+zglSO4321ExCNgMToz2tZiONhdK5RJwyxHAeh04gg/wx6L7Dy76IYtSjxYsWyqh+vMuk3qL/IS67jlc4u3AOo+qvqhN+qoLmiaFUPFeL80EGyhqs2cUfDF0Ge0PLkhcew43L8zdVIE=', '00d41f', 6836782, '2020-02-07 11:57:02', 0, '2020-02-07 18:51:58', '2020-02-07 18:51:15', '2020-02-07 18:51:58', NULL);
INSERT INTO `t_documentos_internos` VALUES (5, NULL, 5, 4, 2, 0, 373, '3', 'SHyFP/SP/00002/2020', 2020, '[{\"responsable\":\"Director\"},{\"responsable\":\"Jefe de Area\"}]', '[\"3\",\"5\"]', '[\"7\"]', 'prueba de envio de circular', '<p>prueba de circular<br></p>', 'Secretaria Particular', 'Secretario Particular', 'Lic. María del Rocío Aguilar Jiménez', 0, 'e8tDaccvi7lrFR4sCEEP5mTfndnH0ZqDSpTupys71jiEgYl3PMReww0r6wdBuVOvCOmzB2fMIuccPidr5uFmqy/G7nYgyGZxXLaXT0myb7kna8SdDVwWeRy0t974zXjsuZMkk/oGvuaHuQXl5WJsKjkPNtEGV+5mPfzEmQJ27c0=', '00d41f', 6836941, '2020-02-07 12:51:00', 0, '2020-02-07 19:45:54', '2020-02-07 19:29:59', '2020-02-07 19:45:54', NULL);
INSERT INTO `t_documentos_internos` VALUES (6, NULL, 6, 4, 4, 0, 374, '2', 'SHyFP/SP/GEI/00001/2020', 2020, '[{\"responsable\":\"Lic. Rodolfo Jim\\u00e9nez Santos\",\"area\":\"Unidad de Inform\\u00e1tica y Desarrollo Digital\"}]', '[\"16\"]', '[\"2\"]', 'ejemplo', '<p>se esta haciendo un ejemplo de envio de memorandums<br></p>', 'Encargada de Gestión Ejecutiva Interna', 'Coordinador', 'C.P. Ana Beatriz Kanter Macal', 0, 'i7KPWSmm/r+uiItxx6+Vtz0P6DmbPZAs7d3V+yLSrXbBMFBQS8odW1YVVnHpwFUJttMlPaK++ceHFvyI5vSL0mhfqPhxdg4PDZRlCF/sr5tE40w4EobMXrBwb1zIfPHXFW20ZG/Gg/IoZg00VvsjVJWTgCvA0O5EX5ECoMB58Ss=', '00d41f', 6850400, '2020-02-13 10:05:06', 0, '2020-02-13 17:00:29', '2020-02-13 16:59:41', '2020-02-13 17:00:29', NULL);
INSERT INTO `t_documentos_internos` VALUES (7, NULL, 7, 4, 4, 0, 374, '3', 'SHyFP/SP/GEI/00001/2020', 2020, '[{\"responsable\":\"Jefe de Unidad\"}]', '[\"4\"]', '[\"3\"]', 'Publicacion de Nuevo sistema', 'Se publicara el  nuevo sistema para inicios del mes de marzo<br>', 'Encargada de Gestión Ejecutiva Interna', 'Coordinador', 'C.P. Ana Beatriz Kanter Macal', 0, 'u64WCk+tap4hR3hxdXIx0UACrkslTqFfQ1D4Ct7xwTHWJ5VLbacMH0G/cI4MWqqYU1wSVHJqg4MRsBgp0Av0CjElv9g/aqnlAeZsZXQ6xw2eyYv7qaNg7TxJYQZ4iU/CJCTRYBm/YiSQUa09rZTimIq18NeSW1jLRDm7FLYKuec=', '00d41f', 6852048, '2020-02-13 10:40:56', 0, '2020-02-13 17:36:22', '2020-02-13 17:06:27', '2020-02-13 17:36:22', NULL);
INSERT INTO `t_documentos_internos` VALUES (8, NULL, 8, 4, 16, 0, 2, '2', NULL, NULL, '[{\"responsable\":\"Lic. Mar\\u00eda del Roc\\u00edo Aguilar Jim\\u00e9nez\",\"area\":\"Secretaria Particular\"}]', '[\"2\"]', NULL, 'nnn weqweqw qwe qweqw', '<p>nnnnnnnn<br></p> ertertret ert asdasda', 'Unidad de Informática y Desarrollo Digital', 'Jefe de Unidad', 'Lic. Rodolfo Jiménez Santos', 0, NULL, NULL, NULL, NULL, 0, NULL, '2020-02-20 18:23:15', '2024-03-07 21:34:40', NULL);
INSERT INTO `t_documentos_internos` VALUES (9, NULL, 9, 4, 16, 0, 371, '2', 'SHyFP/UIyDD/00002/2020', 2020, '[{\"responsable\":\"C.P. Mar\\u00eda Claudia V\\u00e1zquez Castillejos\",\"area\":\"Secretaria T\\u00e9cnica\"}]', '[\"3\"]', NULL, 'uiuiuiu', '<p>uiuiuiuiuiu<br></p>', 'Unidad de Informática y Desarrollo Digital', 'Jefe de Unidad', 'Lic. Rodolfo Jiménez Santos', 0, 'dIdOqk+w0KaNEpiLw0p04M/a5mUi517UMr9V07vC9yp5HiB+EQ/3XJzctcK615vxWRjJZfy2Jv2IxlEdYOaa4i+iSZ8wfSnjr8Cm8plMosiFQzG+P4b8G0E6XvrZRLth8jgLsNBRG1B0b2gJp0eAUPraywU4iN5kuaLpyTsJaOc=', '00d41f', 6970009, '2020-03-20 14:33:57', 0, '2020-03-20 20:34:31', '2020-02-20 18:23:59', '2020-03-20 20:34:31', NULL);
INSERT INTO `t_documentos_internos` VALUES (10, NULL, 10, 4, 16, 0, 371, '2', 'SHyFP/UIyDD/00001/2020', 2020, '[{\"responsable\":\"Lic. Maritza del Carmen Pintado  Ortega\",\"area\":\"Unidad de Transparencia\"}]', '[\"11\"]', '[\"2\"]', 'trtrt rtr tr tr trtr t', '<p>r tr tr trt r w wewew ewqw    q    q    q    q    q    q    q    qq    q    qq    q    q    q    q    q    q    wqwweretgdfd<br></p>', 'Unidad de Informática y Desarrollo Digital', 'Jefe de Unidad', 'Lic. Rodolfo Jiménez Santos', 0, 'jGpSXkRNnDctvn5I0IoSwHGmFXD0JwWC/QmgltPtis7058Z3MxWG3Svdk1JLMJtTSSmz0M7ICB8vmK7AJDqNqymbGngTg5SX8hAe2pOUwhvK3vKy674i2LZJBGi+1R88Y1TugiQcGbB0OQ2qPd+DLJ//GcnaNZjqMgfUzjJ90YY=', '00d41f', 6969443, '2020-03-20 13:44:18', 0, '2020-03-20 19:44:52', '2020-02-20 18:24:51', '2020-03-20 19:44:52', NULL);
INSERT INTO `t_documentos_internos` VALUES (11, NULL, 11, 4, 16, 0, 371, '2', 'SHyFP/UIyDD/00003/2020', 2020, '[{\"responsable\":\"Mtro. Joel Pereira Hernandez\",\"area\":\"Unidad de Apoyo Administrativo\"}]', '[\"12\"]', NULL, 'Prueba de memo', 'se estan haciendo pruebas en el sistema<br>', 'Unidad de Informática y Desarrollo Digital', 'Jefe de Unidad', 'Lic. Rodolfo Jiménez Santos', 0, 'pZ5ghyLySHjPonijd62VQmUE67wl/eQSDsAGI+b00uvzFVeeBSQ1QFJqOVfd8OvI2rsdADQZ3F8duXREHYsxk0RXf48r2KeUO3G/pMT5RUxCrzeXywGonbrqDCVzse/JauKFtReb3UwJK9w9M540JrnZOf+FUCqSl+ftlVNbqlE=', '00d41f', 6994708, '2020-03-31 14:23:11', 0, '2020-03-31 20:24:38', '2020-03-31 20:18:05', '2020-03-31 20:24:38', NULL);
INSERT INTO `t_documentos_internos` VALUES (12, NULL, 12, 4, 16, 0, 371, '2', NULL, NULL, '[{\"responsable\":\"Lic. Mar\\u00eda del Roc\\u00edo Aguilar Jim\\u00e9nez\",\"area\":\"Secretaria Particular\"}]', '[\"2\"]', NULL, 'Prueba', '<p>Prueba de contenido<br></p>', 'Unidad de Informática y Desarrollo Digital', 'Jefe de Unidad', 'Lic. Rodolfo Jiménez Santos', 0, NULL, NULL, NULL, NULL, 0, NULL, '2024-01-14 15:58:32', '2024-01-14 15:58:32', NULL);
INSERT INTO `t_documentos_internos` VALUES (13, 3, 13, 4, 16, 0, 371, '2', 'SHyFP/UIyDD/00001/2024', 2024, '[{\"responsable\":\"Lic. Mar\\u00eda del Roc\\u00edo Aguilar Jim\\u00e9nez\",\"area\":\"Secretaria Particular\"}]', '[\"2\"]', NULL, 'prueba de envio', '<p>envio de documentación <br></p>', 'Unidad de Informática y Desarrollo Digital', 'Jefe de Unidad', 'Lic. Rodolfo Jiménez Santos', 0, NULL, NULL, NULL, NULL, 0, '2024-03-07 03:20:36', '2024-01-14 16:03:29', '2024-03-07 03:20:36', NULL);
INSERT INTO `t_documentos_internos` VALUES (14, NULL, 14, 4, 16, 0, 2, '2', NULL, NULL, '[{\"responsable\":\"C.P. Mar\\u00eda Claudia V\\u00e1zquez Castillejos\",\"area\":\"Secretaria T\\u00e9cnica\"}]', '[\"3\"]', '[\"2\"]', 'prueba envio', 'estamos haciendo pruebas de envio', 'Unidad de Informática y Desarrollo Digital', 'Jefe de Unidad', 'Lic. Rodolfo Jiménez Santos', 0, NULL, NULL, NULL, NULL, 0, NULL, '2024-03-07 19:32:28', '2024-03-07 19:32:28', NULL);
INSERT INTO `t_documentos_internos` VALUES (15, NULL, 15, 4, 16, 0, 2, '2', 'SHyFP/UIyDD/00004/2024', 2024, '[{\"responsable\":\"C.P. Mar\\u00eda Claudia V\\u00e1zquez Castillejos\",\"area\":\"Secretaria T\\u00e9cnica\"}]', '[\"3\"]', '[\"2\",\"12\"]', 'Solicitud de informacionn, enviar hoy', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', 'Unidad de Informática y Desarrollo Digital', 'Jefe de Unidad', 'Lic. Rodolfo Jiménez Santos', 0, NULL, NULL, NULL, NULL, 0, '2024-03-07 21:48:24', '2024-03-07 19:35:13', '2024-03-07 21:48:24', NULL);
INSERT INTO `t_documentos_internos` VALUES (16, NULL, 16, 4, 2, 0, 4, '2', 'SHyFP/SP/00001/2024', 2024, '[{\"responsable\":\"Lic. Rodolfo Jim\\u00e9nez Santos\",\"area\":\"Unidad de Inform\\u00e1tica y Desarrollo Digital\"}]', '[\"16\"]', NULL, 'solicitud de informacion', 'mo por ejemplo \"Contenido aquí, contenido aquí\". Estos textos hacen parecerlo un español que se puede leer. Muchos paquetes de autoedición y editores de páginas web usan el Lorem Ipsum como su texto por defecto, y al hacer una búsqueda de \"Lorem Ipsum\" va a dar por resu', 'Secretaria Particular', 'Secretario Particular', 'Lic. María del Rocío Aguilar Jiménez', 0, NULL, NULL, NULL, NULL, 0, '2024-03-07 20:21:34', '2024-03-07 20:21:34', '2024-03-07 20:21:34', NULL);
INSERT INTO `t_documentos_internos` VALUES (17, NULL, 17, 4, 16, 0, 2, '2', 'SHyFP/UIyDD/00002/2024', 2024, '[{\"responsable\":\"Lic. Mar\\u00eda del Roc\\u00edo Aguilar Jim\\u00e9nez\",\"area\":\"Secretaria Particular\"}]', '[\"2\"]', NULL, 'animate__animated animate__fadeInDown __ docs', 'Use the rounded-pill bg-*-subtle text-* class with the below-mentioned variation to create a badge more rounded with a soft background.', 'Unidad de Informática y Desarrollo Digital', 'Jefe de Unidad', 'Lic. Rodolfo Jiménez Santos', 0, NULL, NULL, NULL, NULL, 0, '2024-03-07 21:03:55', '2024-03-07 21:00:01', '2024-03-07 21:03:55', NULL);
INSERT INTO `t_documentos_internos` VALUES (18, NULL, 18, 4, 16, 0, 2, '2', 'SHyFP/UIyDD/00004/2024', 2024, '[{\"responsable\":\"Lic. Patricia Ju\\u00e1rez Nafate\",\"area\":\"\\u00c1rea de Evaluaci\\u00f3n Interna\"}]', '[\"7\"]', NULL, 'sdadasdad dasd asd asd asdas asdas', '<p class=\"MsoNormal\" style=\"margin-bottom:0cm;margin-bottom:.0001pt;text-align:\r\njustify;text-justify:inter-ideograph;line-height:150%;background:white\"><span style=\"font-size:12.0pt;line-height:150%;font-family:Gotham;mso-fareast-font-family:\r\n\" times=\"\" new=\"\" roman\";mso-bidi-font-family:\"open=\"\" sans\";mso-fareast-language:es-mx\"=\"\">En\r\natención a la circular No. SHyFP/UT/ACA/00018/2024, de fecha 04 de marzo del\r\naño en curso y en cumplimiento al artículo 14 de la Ley de Archivos del Estado\r\nde Chiapas, anexo al presente remito a usted, la información requerida de esta\r\nContraloría Interna a mi cargo con las adecuaciones correspondientes:<o:p></o:p></span></p>\r\n\r\n\r\n<p class=\"MsoNormal\" style=\"margin-bottom:0cm;margin-bottom:.0001pt;text-align:\r\njustify;text-justify:inter-ideograph;line-height:150%;background:white\"><span style=\"font-size:12.0pt;line-height:150%;font-family:Gotham;mso-fareast-font-family:\r\n\" times=\"\" new=\"\" roman\";mso-bidi-font-family:\"open=\"\" sans\";mso-fareast-language:es-mx\"=\"\">&nbsp;</span></p>\r\n\r\n\r\n<p class=\"MsoNormal\" style=\"margin-bottom:0cm;margin-bottom:.0001pt;text-align:\r\njustify;text-justify:inter-ideograph;line-height:150%;background:white\"><span style=\"font-size:12.0pt;line-height:150%;font-family:Gotham;mso-fareast-font-family:\r\n\" times=\"\" new=\"\" roman\";mso-bidi-font-family:\"open=\"\" sans\";mso-fareast-language:es-mx\"=\"\">Cuadro\r\nde clasificación archivística 2024.<o:p></o:p></span></p>\r\n\r\n\r\n<p class=\"MsoNormal\" style=\"margin-bottom:0cm;margin-bottom:.0001pt;text-align:\r\njustify;text-justify:inter-ideograph;line-height:150%;background:white\"><span style=\"font-size:12.0pt;line-height:150%;font-family:Gotham;mso-fareast-font-family:\r\n\" times=\"\" new=\"\" roman\";mso-bidi-font-family:\"open=\"\" sans\";mso-fareast-language:es-mx\"=\"\">Cuadro\r\nde disposición documental 2024.<o:p></o:p></span></p>\r\n\r\n\r\n<p class=\"MsoNormal\" style=\"margin-bottom:0cm;margin-bottom:.0001pt;text-align:\r\njustify;text-justify:inter-ideograph;line-height:150%;background:white\"><span style=\"font-size:12.0pt;line-height:150%;font-family:Gotham;mso-fareast-font-family:\r\n\" times=\"\" new=\"\" roman\";mso-bidi-font-family:\"open=\"\" sans\";mso-fareast-language:es-mx\"=\"\">&nbsp;</span></p>\r\n\r\n\r\n<p class=\"MsoNormal\" style=\"margin-bottom:0cm;margin-bottom:.0001pt;text-align:\r\njustify;text-justify:inter-ideograph;line-height:150%;background:white\"><span style=\"font-size:12.0pt;line-height:150%;font-family:Gotham;mso-fareast-font-family:\r\n\" times=\"\" new=\"\" roman\";mso-bidi-font-family:\"open=\"\" sans\";mso-fareast-language:es-mx\"=\"\">Sin\r\notro particular, reciba un cordial saludo.<o:p></o:p></span></p>\r\n\r\n\r\n<p class=\"MsoNormal\" style=\"margin-bottom:0cm;margin-bottom:.0001pt;text-align:\r\njustify;text-justify:inter-ideograph;line-height:150%;background:white\"><span style=\"font-size:12.0pt;line-height:150%;font-family:Gotham;mso-fareast-font-family:\r\n\" times=\"\" new=\"\" roman\";mso-bidi-font-family:\"open=\"\" sans\";mso-fareast-language:es-mx\"=\"\">&nbsp;</span></p>', 'Unidad de Informática y Desarrollo Digital', 'Jefe de Unidad', 'Lic. Rodolfo Jiménez Santos', 0, NULL, NULL, NULL, NULL, 0, '2024-03-07 21:29:43', '2024-03-07 21:28:55', '2024-03-07 21:29:43', NULL);

-- ----------------------------
-- Table structure for t_folios
-- ----------------------------
DROP TABLE IF EXISTS `t_folios`;
CREATE TABLE `t_folios`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_documento_externo` int NULL DEFAULT NULL,
  `id_documento_interno` int NULL DEFAULT NULL COMMENT 'Origen destinatario',
  `id_area` int NOT NULL,
  `id_status` int NOT NULL COMMENT 'Proceso,Concluido,Rechazado',
  `fecha_vencimiento` date NULL DEFAULT NULL,
  `folio` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `es_urgente` tinyint(1) NOT NULL DEFAULT 0,
  `indicaciones` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `area_responsable` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `responsable_area` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `principal` tinyint(1) NULL DEFAULT 1 COMMENT 'Este campo identifica que es la raiz del folio cuando se turna.',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_destinatario`(`id_documento_interno` ASC) USING BTREE,
  INDEX `id_status`(`id_status` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_folios
-- ----------------------------
INSERT INTO `t_folios` VALUES (1, 1, NULL, 4, 2, '2020-02-17', 'SHyFP/SP/GEI/00001/2020', 0, 'Se estan haciendo pruebas de evio', 'Encargada de Gestión Ejecutiva Interna', 'Lic. Eréndira Dayani Bravo Garcia', 1, '2020-02-10 18:47:07', '2020-02-10 18:47:07', NULL);
INSERT INTO `t_folios` VALUES (2, NULL, 6, 16, 2, NULL, 'SHyFP/UIyDD/00001/2024', 0, 'para su seguimiento', 'Unidad de Informática y Desarrollo Digital', 'Lic. Rodolfo Jiménez Santos', 1, '2024-01-14 16:02:30', '2024-01-14 16:02:30', NULL);

-- ----------------------------
-- Table structure for t_turnados
-- ----------------------------
DROP TABLE IF EXISTS `t_turnados`;
CREATE TABLE `t_turnados`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_folio` int NOT NULL,
  `id_tipo_turnado` int NOT NULL COMMENT 'Atención,Copia',
  `subsecretaria` int NULL DEFAULT NULL,
  `direccion` int NULL DEFAULT NULL,
  `departamento` int NULL DEFAULT NULL,
  `oficina` int NULL DEFAULT NULL,
  `id_area` int NOT NULL,
  `area_responsable` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `responsable_area` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `es_nuevo` tinyint(1) NULL DEFAULT NULL,
  `acuse` datetime NULL DEFAULT NULL,
  `id_usuario_acuse` int NULL DEFAULT NULL,
  `id_status` int NULL DEFAULT NULL COMMENT 'Rechazado, Concluido, Proceso',
  `motivo_rechazo` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `informe` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_folio`(`id_folio` ASC) USING BTREE,
  INDEX `subsecretaria`(`subsecretaria` ASC) USING BTREE,
  INDEX `direccion`(`direccion` ASC) USING BTREE,
  INDEX `departamento`(`departamento` ASC) USING BTREE,
  INDEX `oficina`(`oficina` ASC) USING BTREE,
  INDEX `id_usuario_acuse`(`id_usuario_acuse` ASC) USING BTREE,
  INDEX `id_status`(`id_status` ASC) USING BTREE,
  INDEX `id_turnado`(`id_tipo_turnado` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_turnados
-- ----------------------------
INSERT INTO `t_turnados` VALUES (1, 1, 1, NULL, NULL, NULL, NULL, 16, 'Unidad de Informática y Desarrollo Digital', 'Lic. Rodolfo Jiménez Santos', 0, '2020-02-13 17:53:54', 371, 2, NULL, NULL, '2020-02-10 18:47:07', '2020-02-13 17:53:54', NULL);
INSERT INTO `t_turnados` VALUES (3, 1, 1, NULL, NULL, NULL, NULL, 12, 'Unidad de Apoyo Administrativo', 'Mtro. Joel Pereira Hernandez', 1, NULL, NULL, 2, NULL, NULL, '2020-02-13 18:12:55', '2020-02-13 18:12:55', NULL);
INSERT INTO `t_turnados` VALUES (4, 2, 1, NULL, NULL, NULL, NULL, 2, 'Secretaria Particular', 'Lic. María del Rocío Aguilar Jiménez', 1, NULL, NULL, 2, NULL, NULL, '2024-01-14 16:02:31', '2024-01-14 16:02:31', NULL);

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `id_area` int NULL DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nickname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `img` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `password` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `curp` varchar(18) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 377 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES (1, 1, 1, 'admin', 'admin', NULL, '$2y$10$XiygF1dP2dMagm/RhVfGheOlB7eVx0UzEQ4PVoWVXvhQKEDxJOiza', NULL, NULL, NULL, '2024-03-06 21:29:48', NULL);
INSERT INTO `usuarios` VALUES (2, 1, 16, 'Rodolfo Jimenez Santos', 'rjimenez', NULL, '$2y$10$XiygF1dP2dMagm/RhVfGheOlB7eVx0UzEQ4PVoWVXvhQKEDxJOiza', 'GOAS911204HCSMCN02', 'L7JJoA6DnUraYiPbRZFJXH0KiBoXGckeuwg5GzJ9iieJf1f3mjuJsn7u9SiQ', NULL, '2024-05-02 15:24:41', NULL);
INSERT INTO `usuarios` VALUES (3, 1, 98, 'Sandra del Carmen Dominguez Lopez', 'sdominguez', NULL, '$2y$10$XiygF1dP2dMagm/RhVfGheOlB7eVx0UzEQ4PVoWVXvhQKEDxJOiza', 'GOAS911204HCSMCN02', 'DhcflhNqY4k1ehNhaiYFmPX7GZiLziScdwSSJvWJ5Dp2t8AENmpmxLKYB0i1', NULL, '2024-03-06 21:28:31', NULL);
INSERT INTO `usuarios` VALUES (4, 1, 2, 'Joel Pereira Hernandez', 'jpereira', NULL, '$2y$10$XiygF1dP2dMagm/RhVfGheOlB7eVx0UzEQ4PVoWVXvhQKEDxJOiza', 'GOAS911204HCSMCN02', 'wleEmLYkSSlDxAgNrGvlTmUeKKMJLOuWWSz9ih5Xzd6TNYiQ0Ta9VcE8JBEP', NULL, '2024-03-07 14:20:23', NULL);

-- ----------------------------
-- View structure for vst_areas
-- ----------------------------
DROP VIEW IF EXISTS `vst_areas`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vst_areas` AS select `c_areas`.`id` AS `id`,`c_areas`.`id_dependencia` AS `id_dependencia`,`c_areas`.`subsecretaria` AS `subsecretaria`,`c_areas`.`direccion` AS `direccion`,`c_areas`.`departamento` AS `departamento`,`c_areas`.`oficina` AS `oficina`,`c_areas`.`area` AS `area`,`c_areas`.`folio_estructura` AS `folio_estructura`,`c_titulares`.`id` AS `id_titular`,`c_titulos`.`nombre` AS `titulo`,`c_cargos`.`nombre` AS `cargo`,`c_titulares`.`sexo` AS `sexo`,`c_titulares`.`nombre` AS `nombre`,`c_titulares`.`ap_paterno` AS `ap_paterno`,`c_titulares`.`ap_materno` AS `ap_materno`,`c_titulares`.`activo` AS `activo`,`c_areas`.`created_at` AS `created_at`,`c_areas`.`updated_at` AS `updated_at`,`c_areas`.`deleted_at` AS `deleted_at` from (((`c_areas` join `c_titulares` on(((`c_titulares`.`id_area` = `c_areas`.`id`) and (`c_titulares`.`activo` = 1)))) join `c_titulos` on((`c_titulos`.`id` = `c_titulares`.`id_titulo`))) join `c_cargos` on((`c_cargos`.`id` = `c_titulares`.`id_cargo`))) order by `c_areas`.`id`;

SET FOREIGN_KEY_CHECKS = 1;
