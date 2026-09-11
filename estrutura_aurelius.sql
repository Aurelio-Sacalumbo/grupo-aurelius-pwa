-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: aurelius_salao
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `agendamentos`
--

DROP TABLE IF EXISTS `agendamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agendamentos` (
  `id_agendamento` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `id_servico` int(11) NOT NULL,
  `data_servico` date NOT NULL,
  `hora_servico` time NOT NULL,
  `status` enum('Pendente','Confirmado','Concluido','Cancelado') DEFAULT 'Pendente',
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_agendamento`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_funcionario` (`id_funcionario`),
  KEY `id_servico` (`id_servico`),
  CONSTRAINT `agendamentos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  CONSTRAINT `agendamentos_ibfk_2` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionarios` (`id_funcionario`),
  CONSTRAINT `agendamentos_ibfk_3` FOREIGN KEY (`id_servico`) REFERENCES `servicos` (`id_servico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `alertas_barbearia`
--

DROP TABLE IF EXISTS `alertas_barbearia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alertas_barbearia` (
  `id_alerta` int(11) NOT NULL AUTO_INCREMENT,
  `id_barbearia` int(11) NOT NULL,
  `mensagem` text NOT NULL,
  `lido` tinyint(1) DEFAULT 0,
  `data_criacao` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id_alerta`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `anuncios`
--

DROP TABLE IF EXISTS `anuncios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anuncios` (
  `id_anuncio` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) DEFAULT NULL,
  `imagem` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `link_afiliado` varchar(500) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT 1,
  `likes_adoro` int(11) DEFAULT 0,
  `likes_ncurto` int(11) DEFAULT 0,
  `cliques_agendamento` int(11) DEFAULT 0,
  `contagem_partilhas` int(11) DEFAULT 0,
  `pontos_recompensa` int(11) DEFAULT 0,
  `percentual_desconto_ganho` int(11) DEFAULT 0,
  `id_barbearia` int(11) DEFAULT 20,
  `data_publicacao` date DEFAULT curdate(),
  `tipo_media` varchar(20) DEFAULT 'foto',
  PRIMARY KEY (`id_anuncio`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `assinaturas`
--

DROP TABLE IF EXISTS `assinaturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assinaturas` (
  `id_assinatura` int(11) NOT NULL AUTO_INCREMENT,
  `cliente` varchar(100) NOT NULL,
  `plano` varchar(50) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `data_inicio` datetime NOT NULL,
  `data_fim` datetime NOT NULL,
  `status` varchar(20) DEFAULT 'Ativo',
  `telefone_express` varchar(20) NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_assinatura`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `atendimentos`
--

DROP TABLE IF EXISTS `atendimentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atendimentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente` varchar(150) NOT NULL,
  `profissional` varchar(100) NOT NULL,
  `data_sessao` date NOT NULL,
  `horario` time NOT NULL,
  `servico` varchar(150) NOT NULL,
  `valor` decimal(10,2) NOT NULL DEFAULT 0.00,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_atendimento` varchar(50) DEFAULT 'Pendente',
  `tipo_operacao` varchar(100) DEFAULT 'Serviço / Geral',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cargos_salarios`
--

DROP TABLE IF EXISTS `cargos_salarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cargos_salarios` (
  `id_cargo` int(11) NOT NULL AUTO_INCREMENT,
  `nome_cargo` varchar(50) NOT NULL,
  `salario_base` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_cargo`),
  UNIQUE KEY `nome_cargo` (`nome_cargo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `carteira_adiantamentos`
--

DROP TABLE IF EXISTS `carteira_adiantamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carteira_adiantamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `telefone_cliente` varchar(20) NOT NULL,
  `valor_adiantado` decimal(10,2) DEFAULT 0.00,
  `data_deposito` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `carteira_saldos_clientes`
--

DROP TABLE IF EXISTS `carteira_saldos_clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carteira_saldos_clientes` (
  `id_carteira` int(11) NOT NULL AUTO_INCREMENT,
  `telefone_cliente` varchar(30) NOT NULL,
  `nome_cliente` varchar(100) NOT NULL,
  `saldo_acumulado` decimal(10,2) DEFAULT 0.00,
  `ultima_atualizacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_carteira`),
  UNIQUE KEY `telefone_cliente` (`telefone_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `tipo_conta` varchar(20) DEFAULT 'Gratis',
  `data_expiracao_premium` date DEFAULT NULL,
  `desconto_percentual` int(11) DEFAULT 0,
  `id` int(11) DEFAULT NULL,
  `nivel` varchar(30) DEFAULT 'Normal',
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `clientes_vip`
--

DROP TABLE IF EXISTS `clientes_vip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes_vip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status_assinatura` enum('Pendente','Ativo') DEFAULT 'Pendente',
  `referencia_pagamento` varchar(50) NOT NULL,
  `data_ativacao` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `telefone` (`telefone`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comentarios_reels`
--

DROP TABLE IF EXISTS `comentarios_reels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comentarios_reels` (
  `id_comentario` int(11) NOT NULL AUTO_INCREMENT,
  `id_anuncio` int(11) NOT NULL,
  `autor_nome` varchar(100) NOT NULL,
  `mensagem` text NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_comentario`),
  KEY `id_anuncio` (`id_anuncio`),
  CONSTRAINT `comentarios_reels_ibfk_1` FOREIGN KEY (`id_anuncio`) REFERENCES `anuncios` (`id_anuncio`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `configuracoes_plataforma`
--

DROP TABLE IF EXISTS `configuracoes_plataforma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuracoes_plataforma` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chave` varchar(50) NOT NULL,
  `valor` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `chave` (`chave`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `depoimentos`
--

DROP TABLE IF EXISTS `depoimentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `depoimentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `foto_url` text DEFAULT NULL,
  `estrelas` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `resposta_gerente` text DEFAULT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `despesas_fluxo`
--

DROP TABLE IF EXISTS `despesas_fluxo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `despesas_fluxo` (
  `id_despesa` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `data_movimento` date NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_despesa`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `encomendas_marketplace`
--

DROP TABLE IF EXISTS `encomendas_marketplace`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `encomendas_marketplace` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_comprador` int(11) NOT NULL,
  `produto_nome` varchar(255) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `total_produtos` decimal(10,2) NOT NULL,
  `valor_frete` decimal(10,2) NOT NULL,
  `retencao_aurelius` decimal(10,2) NOT NULL,
  `repasse_parceiro` decimal(10,2) NOT NULL,
  `total_pago` decimal(10,2) NOT NULL,
  `forma_pagamento` varchar(100) NOT NULL,
  `detalhes_logistica` text NOT NULL,
  `status_encomenda` varchar(50) DEFAULT 'Aguardando Confirmacao Push',
  `data_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `estoque_produto_parceiros`
--

DROP TABLE IF EXISTS `estoque_produto_parceiros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estoque_produto_parceiros` (
  `id_estoque` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) NOT NULL,
  `nome_empresa` varchar(150) NOT NULL,
  `preco_parceiro` decimal(10,2) NOT NULL,
  `tamanho` varchar(50) NOT NULL,
  `cor_branca` varchar(50) NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  PRIMARY KEY (`id_estoque`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `faturamento_parceiros`
--

DROP TABLE IF EXISTS `faturamento_parceiros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faturamento_parceiros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loja_id` int(11) DEFAULT NULL,
  `pedido_id` int(11) NOT NULL,
  `valor_bruto` decimal(10,2) NOT NULL,
  `comissao_retida` decimal(10,2) NOT NULL,
  `valor_liquido` decimal(10,2) NOT NULL,
  `status_pagamento` varchar(50) DEFAULT 'Aguardando_Liberacao_SaaS',
  `data_registro` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `loja_id` (`loja_id`),
  CONSTRAINT `faturamento_parceiros_ibfk_1` FOREIGN KEY (`loja_id`) REFERENCES `lojas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `franquias_saas`
--

DROP TABLE IF EXISTS `franquias_saas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `franquias_saas` (
  `id_franquia` int(11) NOT NULL AUTO_INCREMENT,
  `nome_empresa` varchar(255) NOT NULL,
  `nome_gestor` varchar(255) NOT NULL,
  `bi_gestor` varchar(30) NOT NULL,
  `bi_status` varchar(50) DEFAULT 'Pendente',
  `email_corporativo` varchar(255) NOT NULL,
  `telefone_angola` varchar(20) NOT NULL,
  `cidade_sede` varchar(100) NOT NULL,
  `bairro_sede` varchar(100) NOT NULL,
  `plano_assinatura` varchar(50) NOT NULL,
  `configuracoes_json` longtext NOT NULL,
  `data_criacao` datetime NOT NULL,
  PRIMARY KEY (`id_franquia`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `funcionarios`
--

DROP TABLE IF EXISTS `funcionarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `funcionarios` (
  `id_funcionario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `status` varchar(50) DEFAULT 'Disponível',
  `especialidade` varchar(150) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT 1,
  `foto_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_funcionario`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `funcionarios_dados_pessoais`
--

DROP TABLE IF EXISTS `funcionarios_dados_pessoais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `funcionarios_dados_pessoais` (
  `id_dado` int(11) NOT NULL AUTO_INCREMENT,
  `id_funcionario` int(11) NOT NULL,
  `id_cargo` int(11) NOT NULL,
  `numero_bi` varchar(20) NOT NULL,
  `arquivo_bi` varchar(255) DEFAULT NULL,
  `data_nascimento` date NOT NULL,
  `telefone_pessoal` varchar(20) NOT NULL,
  `morada_bairro` varchar(100) NOT NULL,
  `nivel_academico` varchar(50) NOT NULL,
  `arquivo_certificado` varchar(255) DEFAULT NULL,
  `formacao_profissional` varchar(100) NOT NULL,
  `arquivo_diploma` varchar(255) DEFAULT NULL,
  `outros_cursos` text DEFAULT NULL,
  `experiencias_anteriores` text DEFAULT NULL,
  `data_admissao` date NOT NULL,
  `salario_base` decimal(10,2) DEFAULT 0.00,
  `bonus_horas_extras` decimal(10,2) DEFAULT 0.00,
  `data_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `file_bi` varchar(255) DEFAULT NULL,
  `file_certificado` varchar(255) DEFAULT NULL,
  `file_diploma` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_dado`),
  KEY `id_funcionario` (`id_funcionario`),
  KEY `id_cargo` (`id_cargo`),
  CONSTRAINT `funcionarios_dados_pessoais_ibfk_1` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionarios` (`id_funcionario`) ON DELETE CASCADE,
  CONSTRAINT `funcionarios_dados_pessoais_ibfk_2` FOREIGN KEY (`id_cargo`) REFERENCES `cargos_salarios` (`id_cargo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `historico_vendas`
--

DROP TABLE IF EXISTS `historico_vendas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historico_vendas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produto_id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `metodo_pagamento` varchar(50) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `comissao_aurelius` decimal(10,2) NOT NULL,
  `valor_barbearia` decimal(10,2) NOT NULL,
  `data_venda` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lojas`
--

DROP TABLE IF EXISTS `lojas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lojas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_publico` varchar(20) DEFAULT NULL,
  `pin_acesso` varchar(9) DEFAULT NULL,
  `nome_loja` varchar(255) NOT NULL,
  `email_mercantil` varchar(255) NOT NULL,
  `telefone_corporativo` varchar(50) NOT NULL,
  `endereco_armazem` text NOT NULL,
  `slug_loja` varchar(255) NOT NULL,
  `senha_administracao` varchar(255) NOT NULL,
  `transacao_status` varchar(50) DEFAULT 'Confirmado',
  `visivel_no_site` int(11) DEFAULT 1,
  `especificacoes_json` text DEFAULT NULL,
  `data_cadastro` date NOT NULL,
  `iban_bancario` varchar(50) DEFAULT 'AO06.0000.0000.0000.0000.0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_mercantil` (`email_mercantil`)
) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `metodos_pagamento`
--

DROP TABLE IF EXISTS `metodos_pagamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `metodos_pagamento` (
  `id_metodo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  PRIMARY KEY (`id_metodo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pagamentos`
--

DROP TABLE IF EXISTS `pagamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagamentos` (
  `id_pagamento` int(11) NOT NULL AUTO_INCREMENT,
  `id_parceiro` int(11) NOT NULL,
  `tipo_parceiro` enum('barbearia','loja') NOT NULL,
  `cliente` varchar(150) NOT NULL,
  `cliente_telefone` varchar(20) DEFAULT NULL,
  `profissional` varchar(100) NOT NULL,
  `funcionario` varchar(255) DEFAULT NULL,
  `data_servico` date NOT NULL,
  `horario` varchar(255) DEFAULT NULL,
  `hora_servico` time NOT NULL,
  `servico` varchar(150) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `status_atendimento` varchar(50) DEFAULT 'Pendente',
  `status_trabalho` enum('Pendente','Concluido') DEFAULT 'Pendente',
  `assinatura_cliente` varchar(50) DEFAULT NULL,
  `desconto` decimal(10,2) NOT NULL DEFAULT 0.00,
  `valor_liquido` decimal(10,2) NOT NULL DEFAULT 0.00,
  `data_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `visto_admin` int(11) DEFAULT 0,
  `tipo_pagamento` enum('PWA','Físico') DEFAULT 'PWA',
  PRIMARY KEY (`id_pagamento`)
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pedidos_emprego`
--

DROP TABLE IF EXISTS `pedidos_emprego`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedidos_emprego` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_barbearia` int(11) NOT NULL,
  `nome_candidato` varchar(255) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `provincia` varchar(100) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `experiencia` text NOT NULL,
  `data_envio` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `planos`
--

DROP TABLE IF EXISTS `planos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `planos` (
  `id_plano` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `duracao_meses` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_plano`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `produto_parceiros`
--

DROP TABLE IF EXISTS `produto_parceiros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produto_parceiros` (
  `id_parceiro_prod` int(11) NOT NULL AUTO_INCREMENT,
  `id_anuncio` int(11) NOT NULL,
  `nome_empresa` varchar(100) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `tamanho` varchar(20) NOT NULL,
  `cor_branca` varchar(20) NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  PRIMARY KEY (`id_parceiro_prod`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_fornecedor` int(11) NOT NULL,
  `nome_produto` varchar(255) NOT NULL,
  `numero_série` varchar(100) NOT NULL,
  `tipo_produto` varchar(100) NOT NULL,
  `cor_produto` varchar(50) DEFAULT NULL,
  `data_validade` date NOT NULL,
  `quantidade_stock` int(11) NOT NULL DEFAULT 0,
  `preco_venda` decimal(10,2) NOT NULL,
  `imagem_url` varchar(255) DEFAULT 'default_cosmetico.webp',
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `produtos_cosmeticos`
--

DROP TABLE IF EXISTS `produtos_cosmeticos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos_cosmeticos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `nome_produto` varchar(255) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `stock_atual` int(11) NOT NULL,
  `imagem` varchar(255) DEFAULT 'default_cosmetico.jpg',
  `desconto_relampago` int(11) DEFAULT 0,
  `tamanho` varchar(50) DEFAULT 'Padrão',
  `cor_branca` varchar(20) DEFAULT 'Tem',
  `stock` varchar(30) DEFAULT 'Disponível',
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `profissionais`
--

DROP TABLE IF EXISTS `profissionais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profissionais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `nome_profissional` varchar(150) NOT NULL,
  `classe_nivel` varchar(50) DEFAULT 'Master Barber',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `saloes_parceiros`
--

DROP TABLE IF EXISTS `saloes_parceiros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `saloes_parceiros` (
  `id_parceiro` int(11) NOT NULL AUTO_INCREMENT,
  `nome_estabelecimento` varchar(100) NOT NULL,
  `responsavel` varchar(255) DEFAULT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `provincia_cidade` varchar(50) DEFAULT 'Huambo',
  `percentual_comissao` decimal(5,2) DEFAULT 10.00,
  `status` varchar(20) DEFAULT 'Ativo',
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `feedback_profissional` text DEFAULT NULL,
  `resposta_admin` text DEFAULT NULL,
  `bi_frente` varchar(255) DEFAULT NULL,
  `bi_verso` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_parceiro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `saques_parceiros`
--

DROP TABLE IF EXISTS `saques_parceiros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `saques_parceiros` (
  `id_saque` int(11) NOT NULL AUTO_INCREMENT,
  `parceiro_id` int(11) NOT NULL,
  `tipo_parceiro` enum('barbearia','loja') NOT NULL,
  `valor_sacado` decimal(10,2) NOT NULL,
  `data_solicitacao` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_saque`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `servicos`
--

DROP TABLE IF EXISTS `servicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servicos` (
  `id_servico` int(11) NOT NULL AUTO_INCREMENT,
  `id_subcategoria` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_servico`),
  KEY `id_subcategoria` (`id_subcategoria`),
  CONSTRAINT `servicos_ibfk_1` FOREIGN KEY (`id_subcategoria`) REFERENCES `subcategorias` (`id_subcategoria`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=704 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subcategorias`
--

DROP TABLE IF EXISTS `subcategorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subcategorias` (
  `id_subcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  PRIMARY KEY (`id_subcategoria`),
  KEY `id_categoria` (`id_categoria`),
  CONSTRAINT `subcategorias_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tenant_notificacoes_multimedia`
--

DROP TABLE IF EXISTS `tenant_notificacoes_multimedia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tenant_notificacoes_multimedia` (
  `id_media` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `titulo_notificacao` varchar(255) NOT NULL,
  `descricao_texto` text DEFAULT NULL,
  `tipo_media` enum('imagem','video','texto_puro') DEFAULT 'texto_puro',
  `url_ficheiro` varchar(255) NOT NULL,
  `data_publicacao` datetime NOT NULL,
  PRIMARY KEY (`id_media`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `triagem_pedidos`
--

DROP TABLE IF EXISTS `triagem_pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `triagem_pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_interno` varchar(50) DEFAULT 'Pendente Triagem',
  `tipo_atendimento` varchar(20) DEFAULT 'Balcao',
  `confirmado_na_entrega` tinyint(1) DEFAULT 0,
  `loja_id` int(11) DEFAULT NULL,
  `usuario_codigo` int(11) DEFAULT NULL,
  `nome` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `loja` varchar(255) NOT NULL,
  `local` varchar(255) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `detalhes` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `loja_id` (`loja_id`),
  KEY `usuario_codigo` (`usuario_codigo`),
  CONSTRAINT `triagem_pedidos_ibfk_1` FOREIGN KEY (`loja_id`) REFERENCES `lojas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `triagem_pedidos_ibfk_2` FOREIGN KEY (`usuario_codigo`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `pin_acesso` varchar(9) DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `nome_funcionario` varchar(255) DEFAULT 'Não preenchido',
  `email` varchar(100) NOT NULL,
  `telefone` varchar(30) NOT NULL,
  `endereco` varchar(100) DEFAULT 'Huambo',
  `tipos_de_servico` varchar(50) DEFAULT 'Geral',
  `preco` decimal(10,2) DEFAULT 0.00,
  `transacao_status` varchar(30) DEFAULT 'Aguardando Validação',
  `visivel_no_site` int(1) DEFAULT 1,
  `nivel` varchar(30) DEFAULT 'parceiro_hospedado',
  `slug` varchar(50) DEFAULT 'Login',
  `bi_frente` varchar(255) DEFAULT NULL,
  `bi_verso` varchar(255) DEFAULT NULL,
  `logo_empresa` varchar(255) DEFAULT 'OIP (6).webp',
  `senha` varchar(255) DEFAULT NULL,
  `data` date NOT NULL,
  `especificacoes_json` text DEFAULT NULL,
  `iban_bancario` varchar(50) DEFAULT 'AO06.0000.0000.0000.0000.0',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=265 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `vagas_trabalho`
--

DROP TABLE IF EXISTS `vagas_trabalho`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vagas_trabalho` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_barbearia` int(11) NOT NULL,
  `cargo` varchar(255) NOT NULL,
  `salario` varchar(100) NOT NULL,
  `requisitos` text NOT NULL,
  `data_criacao` datetime NOT NULL,
  `cliques` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-11 13:22:27
