<?php
    require_once("models/Unidade.php");
    require_once("models/Message.php");

    class UnidadeDAO implements UnidadeDAOInterface{
        private $conn;
        private $url;
        private $message;

        public function __construct(PDO $conn, $url){
            $this->conn = $conn;
            $this->url = $url;
            $this->message = new Message($url);
        }
        public function buildUnidade($data){
            $unidade = new Unidade;
            
            $unidade->id = $data["uc_id"];
            $unidade->descricao = $data["uc_descricao"];
            $unidade->sigla = $data["uc_sigla"];
           

            return $unidade;
            
        }
        public function create(Unidade $unidade){
            $stmt = $this->conn->prepare("INSERT INTO unidade_cadastro(
                uc_descricao,uc_sigla
            ) VALUES (
                :descricao,:sigla
            )");
            $stmt->bindParam(":descricao",$unidade->descricao);
            $stmt->bindParam(":sigla",$unidade->sigla);
            $stmt->execute();             
            
            $this->message->setMessage("Sigla gravado com sucesso","success","unidade_cadastro.php");
            
        }
        public function update(Unidade $unidade){
             $stmt = $this->conn->prepare("UPDATE unidade_cadastro SET
                uc_descricao = '$unidade->descricao',uc_sigla = '$unidade->sigla' 
                WHERE uc_id = '$unidade->id'      
            ");
            

            $stmt->execute();

            // Mensagem de sucesso por editar filme
            $this->message->setMessage("Unidade atualizado com sucesso!", "success", "unidade_cadastro.php");
            
        }
        public function findByDescricao($search){
            $unidades = [];

            $stmt = $this->conn->prepare("SELECT * FROM  unidade_cadastro
                                          WHERE uc_id LIKE '%$search%' OR uc_descricao LIKE '%$search%'OR uc_sigla LIKE '%$search%'");
            $stmt->execute();

            if($stmt->rowCount() > 0) {

                $unidadesArray = $stmt->fetchAll();

                foreach($unidadesArray as $unidade) {
                    $unidades[] = $this->buildUnidade($unidade);
                }

            }

            return $unidades;
            
        }
        public function findById($id){
             if($id != ""){
                $stmt = $this->conn->prepare("SELECT * FROM unidade_cadastro
                                            WHERE uc_id = :id");
                $stmt->bindParam(":id",$id);
                $stmt->execute();

                if($stmt->rowCount()> 0){
                    $data = $stmt->fetch();
                    $unidade = $this->buildUnidade($data);
                    if($unidade){
                        return $unidade;
                    }else{
                        return false;
                    }
                    
                }else{
                    return false;
                }

            }else{
                return false;
            }
            
        }
        public function deleteUnidade($id){
            $stmt = $this->conn->prepare("DELETE FROM unidade_cadastro WHERE uc_id LIKE '$id'");            

            $stmt->execute();

            // Mensagem de sucesso por remover unidade
            $this->message->setMessage("unidade removida com sucesso!", "success", "unidade_cadastro.php");
                    
            
        }
        public function findAll(){
            $unidades = [];
            $stmt = $this->conn->prepare("SELECT *FROM unidade_cadastro");            
            $stmt->execute();  
            if($stmt->rowCount()> 0){
                $unidadearray = $stmt->fetchAll();
                foreach($unidadearray as $unidade) {
                    $unidades[] = $this->buildUnidade($unidade);
                }                  
                    
            }  
            return $unidades;      
            
        }
    }



