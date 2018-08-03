-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 03-Ago-2018 às 01:16
-- Versão do servidor: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `estudo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agrupamentos`
--

CREATE TABLE `agrupamentos` (
  `AGR_ID` int(10) UNSIGNED NOT NULL,
  `AGR_IDIMOVEL` int(10) UNSIGNED NOT NULL,
  `AGR_NOME` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `agrupamentos`
--

INSERT INTO `agrupamentos` (`AGR_ID`, `AGR_IDIMOVEL`, `AGR_NOME`, `created_at`, `updated_at`) VALUES
(1, 1, 'Torre 1', '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(2, 1, 'Torre 2', '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(3, 1, 'Torre 3', '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(4, 2, 'Torre X', '2018-08-03 00:55:00', '2018-08-03 00:55:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidades`
--

CREATE TABLE `cidades` (
  `CID_ID` int(10) UNSIGNED NOT NULL,
  `CID_NOME` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CID_IDESTADO` int(10) UNSIGNED NOT NULL,
  `CID_CODIBGE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `cidades`
--

INSERT INTO `cidades` (`CID_ID`, `CID_NOME`, `CID_IDESTADO`, `CID_CODIBGE`) VALUES
(1, 'Goiânia', 9, 5208707);

-- --------------------------------------------------------

--
-- Estrutura da tabela `estados`
--

CREATE TABLE `estados` (
  `EST_ID` int(10) UNSIGNED NOT NULL,
  `EST_NOME` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `EST_ABREVIACAO` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `estados`
--

INSERT INTO `estados` (`EST_ID`, `EST_NOME`, `EST_ABREVIACAO`) VALUES
(1, 'Acre', 'AC'),
(2, 'Alagoas', 'AL'),
(3, 'Amapá', 'AP'),
(4, 'Amazonas', 'AM'),
(5, 'Bahia', 'BA'),
(6, 'Ceará', 'CE'),
(7, 'Distrito Federal', 'DF'),
(8, 'Espírito Santo', 'ES'),
(9, 'Goiás', 'GO'),
(10, 'Maranhão', 'MA'),
(11, 'Mato Grosso', 'MT'),
(12, 'Mato Grosso do Sul', 'MS'),
(13, 'Minas Gerais', 'MG'),
(14, 'Pará', 'PA'),
(15, 'Paraíba', 'PB'),
(16, 'Paraná', 'PR'),
(17, 'Pernambuco', 'PE'),
(18, 'Piauí', 'PI'),
(19, 'Rio de Janeiro', 'RJ'),
(20, 'Rio Grande do Norte', 'RN'),
(21, 'Rio Grande do Sul', 'RS'),
(22, 'Rondônia', 'RO'),
(23, 'Roraima', 'RR'),
(24, 'Santa Catarina', 'SC'),
(25, 'São Paulo', 'SP'),
(26, 'Sergipe', 'SE'),
(27, 'Tocantins', 'TO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `imoveis`
--

CREATE TABLE `imoveis` (
  `IMO_ID` int(10) UNSIGNED NOT NULL,
  `IMO_NOME` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IMO_ENDERECO` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IMO_COMPLEMENTO` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IMO_NUMERO` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IMO_BAIRRO` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IMO_IDCIDADE` int(10) UNSIGNED NOT NULL,
  `IMO_IDESTADO` int(10) UNSIGNED NOT NULL,
  `IMO_CEP` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IMO_RESPONSAVEIS` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `IMO_TELEFONES` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `imoveis`
--

INSERT INTO `imoveis` (`IMO_ID`, `IMO_NOME`, `IMO_ENDERECO`, `IMO_COMPLEMENTO`, `IMO_NUMERO`, `IMO_BAIRRO`, `IMO_IDCIDADE`, `IMO_IDESTADO`, `IMO_CEP`, `IMO_RESPONSAVEIS`, `IMO_TELEFONES`, `created_at`, `updated_at`) VALUES
(1, 'Condomínio Residencial Maranata', 'Quadra 122 LT-14', '', '', 'Asa Sul', 1, 9, '74000-000', 'Eduardo Hudson Josué (Síndico)<br/>Maria Jordana Gomes (Sub-síndico)<br/>Tulio Cairo Pereira (Zelador)', '(61) 98999-0055 (Eduardo)<br/>(61) 98866-4411 (Tulio)<br/>(61) 4555-0078 (Tulio)', '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(2, 'Edifício Leo Lince', 'Rua 450', '', '788', 'Setor Universitário', 1, 9, '74000-000', 'Hudson Josué (Síndico)<br/>Jordana Gomes (Sub-síndico)<br/>Cairo Pereira (Zelador)', '(61) 98999-0055 (Hudson)<br/>(61) 98866-4411 (Jordana)<br/>(61) 4555-0078 (Cairo)', '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(3, 'Alphaville', 'BR 156', 'Km 45', 'S/N', 'Alphaville', 1, 9, '74000-000', 'Josué (Síndico)<br/>Gomes (Sub-síndico)<br/>Pereira (Zelador)', '(61) 98999-0055 (Josué)<br/>(61) 98866-4411 (Gomes)<br/>(61) 4555-0078 (Pereira)', '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(4, 'Condomínio 1', 'Rua A', 'Apto. 1', 'Nº 4', 'Setor Bueno', 1, 9, '74220000', 'Murillo (1)\r\nMurillo (2)', '(62) 2222-2222 (Fulano)\r\nMurillo (2)', '2018-08-02 13:20:00', '2018-08-02 13:20:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `leituras`
--

CREATE TABLE `leituras` (
  `LEI_ID` int(10) UNSIGNED NOT NULL,
  `LEI_IDPRUMADA` int(10) UNSIGNED NOT NULL,
  `LEI_VALOR` int(6) UNSIGNED ZEROFILL NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `leituras`
--

INSERT INTO `leituras` (`LEI_ID`, `LEI_IDPRUMADA`, `LEI_VALOR`, `created_at`, `updated_at`) VALUES
(1, 1, 000000, '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(2, 1, 000025, '2018-08-03 11:51:00', '2018-08-03 11:51:00'),
(3, 1, 000125, '2018-08-04 11:51:00', '2018-08-04 11:51:00'),
(4, 1, 000420, '2018-08-05 11:51:00', '2018-08-05 11:51:00'),
(5, 1, 001121, '2018-08-06 11:51:00', '2018-08-06 11:51:00'),
(6, 2, 000000, '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(7, 2, 000101, '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(8, 2, 000122, '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(9, 2, 000305, '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(10, 2, 000937, '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(11, 3, 000000, '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(12, 3, 000090, '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(13, 3, 000210, '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(14, 3, 000342, '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(15, 3, 000411, '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(16, 4, 000000, '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(17, 4, 000077, '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(18, 4, 001478, '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(19, 4, 001982, '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(20, 4, 002125, '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(21, 5, 000000, '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(22, 5, 000011, '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(23, 5, 000022, '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(24, 5, 000033, '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(25, 5, 000044, '2018-08-02 11:51:00', '2018-08-02 11:51:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2018_07_31_142637_postagem', 1),
(163, '2018_08_01_012638_create_estados_table', 2),
(164, '2018_08_01_013325_create_cidades_table', 2),
(165, '2018_08_01_014217_create_imoveis_table', 2),
(166, '2018_08_01_015833_create_agrupamentos_table', 2),
(167, '2018_08_01_021312_create_unidades_table', 2),
(168, '2018_08_01_022844_create_prumadas_table', 2),
(169, '2018_08_01_023457_create_leituras_table', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `prumadas`
--

CREATE TABLE `prumadas` (
  `PRU_ID` int(10) UNSIGNED NOT NULL,
  `PRU_IDUNIDADE` int(10) UNSIGNED NOT NULL,
  `PRU_IDFUNCIONAL` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PRU_STATUS` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `prumadas`
--

INSERT INTO `prumadas` (`PRU_ID`, `PRU_IDUNIDADE`, `PRU_IDFUNCIONAL`, `PRU_STATUS`, `created_at`, `updated_at`) VALUES
(1, 1, '1452851', 1, '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(2, 2, '1452852', 1, '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(3, 3, '1452853', 1, '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(4, 4, '1452854', 1, '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(5, 5, '1452855', 1, '2018-08-02 11:51:00', '2018-08-02 11:51:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `unidades`
--

CREATE TABLE `unidades` (
  `UNI_ID` int(10) UNSIGNED NOT NULL,
  `UNI_IDAGRUPAMENTO` int(10) UNSIGNED NOT NULL,
  `UNI_IDIMOVEL` int(10) UNSIGNED NOT NULL,
  `UNI_NOME` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `UNI_RESPONSAVEL` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `UNI_CPFRESPONSAVEL` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `UNI_TELRESPONSAVEL` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `unidades`
--

INSERT INTO `unidades` (`UNI_ID`, `UNI_IDAGRUPAMENTO`, `UNI_IDIMOVEL`, `UNI_NOME`, `UNI_RESPONSAVEL`, `UNI_CPFRESPONSAVEL`, `UNI_TELRESPONSAVEL`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '101', 'Wesley Batista', '111.111.111-44', '(61) 2525-6868', '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(2, 2, 1, '102', 'Jefferson Costa', '222.222.222-77', '(61) 98585-7878', '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(3, 2, 1, '103', 'Caruso Moura', '333.333.333-00', '(61) 94747-2222', '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(4, 2, 1, '104', 'Maria Marta', '444.444.444-00', '(61) 3232-5566', '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(5, 2, 1, '105', 'Otávio Julio', '777.777.777-22', '(61) 7747-1425', '2018-08-02 11:51:00', '2018-08-02 11:51:00'),
(6, 1, 1, '1110', 'Rogério Flausino', '144.144.144-44', '(61) 7444-8585', '2018-08-03 01:51:00', '2018-08-03 01:51:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'MedirWeb', 'contato@medirweb.com.br', '$2y$10$E.PUBzCjFZKz/9VMI5Q.NeFPyrFRJw3RigBSmmpQgdkpZTz5V2/VO', 'OlmHcEoedM8JcH79MXkf7rC5HX6uSWM8XjnmK40YqfMHiX2AkXS4ZXdBz4YD', '2018-08-01 07:29:24', '2018-08-01 07:29:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agrupamentos`
--
ALTER TABLE `agrupamentos`
  ADD PRIMARY KEY (`AGR_ID`),
  ADD KEY `agrupamentos_agr_idimovel_foreign` (`AGR_IDIMOVEL`);

--
-- Indexes for table `cidades`
--
ALTER TABLE `cidades`
  ADD PRIMARY KEY (`CID_ID`),
  ADD KEY `cidades_cid_idestado_foreign` (`CID_IDESTADO`);

--
-- Indexes for table `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`EST_ID`);

--
-- Indexes for table `imoveis`
--
ALTER TABLE `imoveis`
  ADD PRIMARY KEY (`IMO_ID`),
  ADD KEY `imoveis_imo_idcidade_foreign` (`IMO_IDCIDADE`),
  ADD KEY `imoveis_imo_idestado_foreign` (`IMO_IDESTADO`);

--
-- Indexes for table `leituras`
--
ALTER TABLE `leituras`
  ADD PRIMARY KEY (`LEI_ID`),
  ADD KEY `leituras_lei_idprumada_foreign` (`LEI_IDPRUMADA`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prumadas`
--
ALTER TABLE `prumadas`
  ADD PRIMARY KEY (`PRU_ID`),
  ADD KEY `prumadas_pru_idunidade_foreign` (`PRU_IDUNIDADE`);

--
-- Indexes for table `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`UNI_ID`),
  ADD KEY `unidades_uni_idagrupamento_foreign` (`UNI_IDAGRUPAMENTO`),
  ADD KEY `unidades_uni_idimovel_foreign` (`UNI_IDIMOVEL`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agrupamentos`
--
ALTER TABLE `agrupamentos`
  MODIFY `AGR_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cidades`
--
ALTER TABLE `cidades`
  MODIFY `CID_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `estados`
--
ALTER TABLE `estados`
  MODIFY `EST_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `imoveis`
--
ALTER TABLE `imoveis`
  MODIFY `IMO_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `leituras`
--
ALTER TABLE `leituras`
  MODIFY `LEI_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `prumadas`
--
ALTER TABLE `prumadas`
  MODIFY `PRU_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `unidades`
--
ALTER TABLE `unidades`
  MODIFY `UNI_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `agrupamentos`
--
ALTER TABLE `agrupamentos`
  ADD CONSTRAINT `agrupamentos_agr_idimovel_foreign` FOREIGN KEY (`AGR_IDIMOVEL`) REFERENCES `imoveis` (`IMO_ID`);

--
-- Limitadores para a tabela `cidades`
--
ALTER TABLE `cidades`
  ADD CONSTRAINT `cidades_cid_idestado_foreign` FOREIGN KEY (`CID_IDESTADO`) REFERENCES `estados` (`EST_ID`);

--
-- Limitadores para a tabela `imoveis`
--
ALTER TABLE `imoveis`
  ADD CONSTRAINT `imoveis_imo_idcidade_foreign` FOREIGN KEY (`IMO_IDCIDADE`) REFERENCES `cidades` (`CID_ID`),
  ADD CONSTRAINT `imoveis_imo_idestado_foreign` FOREIGN KEY (`IMO_IDESTADO`) REFERENCES `estados` (`EST_ID`);

--
-- Limitadores para a tabela `leituras`
--
ALTER TABLE `leituras`
  ADD CONSTRAINT `leituras_lei_idprumada_foreign` FOREIGN KEY (`LEI_IDPRUMADA`) REFERENCES `prumadas` (`PRU_ID`);

--
-- Limitadores para a tabela `prumadas`
--
ALTER TABLE `prumadas`
  ADD CONSTRAINT `prumadas_pru_idunidade_foreign` FOREIGN KEY (`PRU_IDUNIDADE`) REFERENCES `unidades` (`UNI_ID`);

--
-- Limitadores para a tabela `unidades`
--
ALTER TABLE `unidades`
  ADD CONSTRAINT `unidades_uni_idagrupamento_foreign` FOREIGN KEY (`UNI_IDAGRUPAMENTO`) REFERENCES `agrupamentos` (`AGR_ID`),
  ADD CONSTRAINT `unidades_uni_idimovel_foreign` FOREIGN KEY (`UNI_IDIMOVEL`) REFERENCES `imoveis` (`IMO_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
