<?php
    require_once("models/User.php");
    require_once("dao/UserDAO.php");
    class DbCreaterUni{
        private $url;
        private $conn;
        
        public function __construct($url,$conn) {
            $this->url = $url;
            $this->conn = $conn;
        }
        public function createDB(){
            $this->createUser();

            // cria tabelas pra unisystem 
            $this->createRole();
            $this->createContract();
            $this->createTipoPagto();
            $this->createEmpresa();
            $this->createUsuarioEmpresa();
        }
        public function createUser(){
            $stmt = $this->conn->prepare(
                "CREATE TABLE IF NOT EXISTS `users` (
                    `u_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                    `u_name` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
                    `u_senha` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
                    `u_cpf` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
                    `u_foto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
                    `u_user_ativo` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
                    `u_cep` text NOT NULL,
                    `u_telefone` text NOT NULL,
                    `u_data_n` date DEFAULT NULL,
                    `u_email` text NOT NULL,
                    `u_end_usuario` text NOT NULL,
                    `u_numero` text NOT NULL,
                    PRIMARY KEY (`u_id`) USING BTREE
                )
                COLLATE='utf8mb4_general_ci'
                ENGINE=InnoDB
                ;"
            );           
            $stmt->execute();
            $password = "Uni123";
            $password = password_hash($password, PASSWORD_DEFAULT);
            if($this->verifyUser()){
               $stmt = $this->conn->prepare("INSERT INTO `unisystem`.`users` 
                                                    (`u_name`,  `u_email`,`u_senha`
                                            ) VALUES(
                                                    'Admin','unisystem@unisystemsistemas.com.br', :password);");
                $stmt->bindParam(":password",$password);                                
                $stmt->execute();

                $stmt = $this->conn->prepare("INSERT INTO `unisystem`.`users` (`u_name`, `u_senha`, `u_cpf`, `u_foto`, `u_user_ativo`, `u_cep`, `u_telefone`, `u_data_n`, `u_email`, `u_end_usuario`, `u_numero`) VALUES
                                            ('Administrador', '865acee32733b3c3c43adc6d254d6338', '04104618144', 'foto-2-20230527050536-4f11284ddd29211b6a2b921f2daa8534.jfif', '1', '', '', NULL, '', '0', '')");
                                           
                $stmt->execute();
                $stmt = $this->conn->prepare("INSERT INTO `unisystem`.`users` (`u_name`, `u_senha`, `u_cpf`, `u_foto`, `u_user_ativo`, `u_cep`, `u_telefone`, `u_data_n`, `u_email`, `u_end_usuario`, `u_numero`) VALUES
                                            ('admin', '865acee32733b3c3c43adc6d254d6338', '25778838115', 'foto-2-20230527050536-4f11284ddd29211b6a2b921f2daa8534.jfif', '1', '79004630', '(67) 99311-7408', '1991-07-07', 'guilher_pereira@hotmail.com', 'Rua Clóvis Beviláqua', '643')");
                                           
                $stmt->execute();
            }
        }
        public function createRole(){
            $stmt = $this->conn->prepare(
                "CREATE TABLE IF NOT EXISTS `role` (
                    `r_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                    `r_nome` varchar(300) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci', 

                    PRIMARY KEY (`r_id`) USING BTREE
                )
                COLLATE='utf8mb4_general_ci'
                ENGINE=InnoDB
                AUTO_INCREMENT=1
                ;"
            );
            
            $stmt->execute();
            if($this->verifyRole()){
                $stmt = $this->conn->prepare("INSERT INTO `unisystem`.`role` 
                                                    (r_nome
                                            ) VALUES(
                                                    'Administrador' );");             
                $stmt->execute();
                $stmt = $this->conn->prepare("INSERT INTO `unisystem`.`role` 
                                                    (r_nome
                                            ) VALUES(
                                                    'r_Admin' );");             
                $stmt->execute();
                $stmt = $this->conn->prepare("INSERT INTO `unisystem`.`role` 
                                                    (r_nome
                                            ) VALUES(
                                                    'Usuario' );");             
                $stmt->execute();
            }         
            
        } 
        public function createContract(){
            $stmt = $this->conn->prepare(
                "CREATE TABLE IF NOT EXISTS `contrato` (
                            `c_id` BIGINT(20) NOT NULL AUTO_INCREMENT,
                            `c_id_empresa` BIGINT(20) NULL DEFAULT NULL,
                            `c_cntrt_nome` VARCHAR(300) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_520_ci',
                            `c_cntrt_dt_inicio` DATETIME NULL DEFAULT NULL,
                            `c_cntrt_dt_final` DATETIME NULL DEFAULT NULL,
                            `c_cntrt_dt_assinatura` DATETIME NULL DEFAULT NULL,
                            `c_cntrt_dt_vencimento` TEXT NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_520_ci',
                            `c_cntrt_primeira_parcela` DATETIME NULL DEFAULT NULL,
                            `c_cntrt_qtde_parcelas` BIGINT(20) NULL DEFAULT NULL,
                            `c_cntrt_valor_parcela` DOUBLE NULL DEFAULT NULL,
                            `c_cntrt_ativo` TINYINT(1) NULL DEFAULT NULL,
                            `c_id_usuario_insert` BIGINT(20) NULL DEFAULT NULL,
                            `c_id_usuario_update` BIGINT(20) NULL DEFAULT NULL,
                            `c_id_usuario_dt_insert` DATETIME NULL DEFAULT NULL,
                            `c_id_usuario_dt_update` DATETIME NULL DEFAULT NULL,
                            `c_cntrt_email` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_520_ci',
                            `c_cntrt_telefone` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_520_ci',
                            `c_cntrt_celular` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_520_ci',
                            `c_cntrt_a_arquivo` TEXT NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_520_ci',
                            `c_cntrt_responsavel` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_520_ci',
                            `c_cntrt_cargo` VARCHAR(300) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_520_ci',
                            `c_id_tfp` INT(11) NULL DEFAULT NULL,
                            PRIMARY KEY (`c_id`) USING BTREE
                        )
                        COLLATE='utf8mb4_unicode_520_ci'
                        ENGINE=InnoDB
                        ;"
            );
           
            $stmt->execute();
            if($this->verifyContract()){
                $stmt = $this->conn->prepare("INSERT INTO `contrato` (`c_id_empresa`, `c_cntrt_nome`, `c_cntrt_dt_inicio`, `c_cntrt_dt_final`, `c_cntrt_dt_assinatura`, `c_cntrt_dt_vencimento`, `c_cntrt_primeira_parcela`, `c_cntrt_qtde_parcelas`, `c_cntrt_valor_parcela`, `c_cntrt_ativo`, `c_id_usuario_insert`, `c_id_usuario_update`, `c_id_usuario_dt_insert`, `c_id_usuario_dt_update`, `c_cntrt_email`, `c_cntrt_telefone`, `c_cntrt_celular`, `c_cntrt_a_arquivo`, `c_cntrt_responsavel`, `c_cntrt_cargo`, `c_id_tfp`) VALUES
                    (2, 'unisystem', '2021-01-01 00:00:00', '2021-01-01 00:00:00', '2021-01-01 00:00:00', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ECINTRON.pdf',  NULL, NULL),
                    (55, 'empresa', '2023-12-27 00:00:00', '2024-12-27 00:00:00', '2024-01-04 00:00:00', '10', '2024-01-04 00:00:00', 12, 1000, 1, 2, NULL, '2023-12-27 11:34:23', NULL,  'personalizado@personalizado.com', '47984478116', NULL, 'PAC-ARQ--2-20231227031223-8c2a73cbbb5b64485939e74d42708495.jfif', 'romeu', 'corretor', 2)");             
                $stmt->execute();
                
            }         

        }

        public function createTipoPagto(){
            $stmt = $this->conn->prepare(
                "CREATE TABLE IF NOT EXISTS `tipo_forma_pagto` (
                    `tp_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                    `tp_nome` varchar(300) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL, 
                    PRIMARY KEY (`tp_id`) USING BTREE
                )
                COLLATE='utf8mb4_general_ci'
                ENGINE=InnoDB
                AUTO_INCREMENT=1
                ;                
                "
            );
            $stmt->execute();

            if($this->verifyTipoPagto()){
                $stmt = $this->conn->prepare("INSERT INTO `tipo_forma_pagto` (`tp_nome`) VALUES
                                            ( 'Dinheiro'),
                                            ( 'pix'),
                                            ('Cartão Debito'),
                                            ( 'Cartão Credito');");             
                $stmt->execute();

            }
        }
        public function createEmpresa(){
            $stmt = $this->conn->prepare(
                "CREATE TABLE IF NOT EXISTS `empresa` (
                    `e_id` BIGINT(20) NOT NULL AUTO_INCREMENT,
                    `e_nome` VARCHAR(300) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_520_ci',
                    `e_razao_social` VARCHAR(300) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_520_ci',
                    `e_nome_fantasia` VARCHAR(300) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_520_ci',
                    `e_nome_curto` VARCHAR(300) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_520_ci',
                    `e_empr_endereco` VARCHAR(300) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_520_ci',
                    `e_empr_end_numero` VARCHAR(300) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_520_ci',
                    `e_empr_end_bairro` VARCHAR(300) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_520_ci',
                    `e_empr_end_complemento` VARCHAR(300) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_520_ci',
                    `e_empr_end_cep` VARCHAR(300) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_520_ci',
                    `e_cnpj` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_520_ci',
                    `e_insc_estadual` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_520_ci',
                    `e_insc_municipal` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_520_ci',
                    `e_empr_telefone` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_520_ci',
                    `e_empr_email` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_520_ci',
                    `e_empr_logo` TEXT NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_520_ci',
                    `e_empr_ativo` TEXT NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_520_ci',
                    `e_id_usuario_insert` TEXT NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_520_ci',
                    `e_id_usuario_update` TEXT NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_520_ci',
                    `e_id_usuario_dt_insert` DATETIME NULL DEFAULT NULL,
                    `e_id_usuario_dt_update` DATETIME NULL DEFAULT NULL,
                    PRIMARY KEY (`e_id`)
                )
                COLLATE='utf8mb4_general_ci'
                ENGINE=InnoDB
                AUTO_INCREMENT=1
                ;                
                "
            );
            $stmt->execute();
        }
        public function createUsuarioEmpresa(){
            $stmt = $this->conn->prepare(
                "CREATE TABLE IF NOT EXISTS `usuario_empresa` (
                    `ue_id` BIGINT(20) NOT NULL AUTO_INCREMENT,
                    `ue_id_contrato` BIGINT(20) NULL DEFAULT NULL,
                    `ue_id_usuario` BIGINT(20) NULL DEFAULT NULL,
                    `ue_id_role` BIGINT(20) NULL DEFAULT NULL,
                    PRIMARY KEY (`ue_id`) USING BTREE
                )
                COLLATE='utf8mb4_general_ci'
                ENGINE=InnoDB
                AUTO_INCREMENT=1
                ;                
                "
            );
            $stmt->execute();
            if($this->verifyUsuarioEmpresa()){
                $stmt = $this->conn->prepare("INSERT INTO `usuario_empresa` (`ue_id_contrato`, `ue_id_usuario`, `ue_id_role`) VALUES
                                            ( 1, 2, 1),
                                            ( 125, 164, 2);
                                            ");             
                $stmt->execute();

            }
        }

        public function verifyUser(){
            $userDao = new UserDAO($this->conn, $this->url);
            $stmt = $this->conn->prepare("SELECT * FROM users");
            $stmt->execute();

            if($stmt->rowCount()> 0){               
                return false;
            }else{
                return true;
            }
        }
        public function verifyRole(){
            $userDao = new UserDAO($this->conn, $this->url);
            $stmt = $this->conn->prepare("SELECT * FROM role");
            $stmt->execute();

            if($stmt->rowCount()> 0){               
                return false;
            }else{
                return true;
            }
        }
        public function verifyContract(){
            $userDao = new UserDAO($this->conn, $this->url);
            $stmt = $this->conn->prepare("SELECT * FROM contrato");
            $stmt->execute();

            if($stmt->rowCount()> 0){               
                return false;
            }else{
                return true;
            }
        }
        public function verifyTipoPagto(){
            $userDao = new UserDAO($this->conn, $this->url);
            $stmt = $this->conn->prepare("SELECT * FROM tipo_forma_pagto");
            $stmt->execute();

            if($stmt->rowCount()> 0){               
                return false;
            }else{
                return true;
            }
        }

        public function verifyUsuarioEmpresa(){
             $userDao = new UserDAO($this->conn, $this->url);
            $stmt = $this->conn->prepare("SELECT * FROM usuario_empresa");
            $stmt->execute();

            if($stmt->rowCount()> 0){               
                return false;
            }else{
                return true;
            }

        }
    }
