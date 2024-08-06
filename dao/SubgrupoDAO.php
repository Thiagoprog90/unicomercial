<?php
    require_once("models/Subgrupo.php");
    require_once("models/Message.php");

    class SubgrupoDAO implements SubgrupoDAOInterface{
        private $conn;
        private $url;
        private $message;

        public function __construct(PDO $conn, $url){
            $this->conn = $conn;
            $this->url = $url;
            $this->message = new Message($url);
        }

        public function buildSubGrupo($data){
            $subgrupo = new Subgrupo;
            
            $subgrupo->id = $data["sc_id"];
            $subgrupo->idgrupo = $data["gc_id"];
            $subgrupo->descricao = $data["sc_descricao"];
            $subgrupo->descricaoGrupo = $data["gc_descricao"];
           

            return $subgrupo;
        }
        public function create(Subgrupo $subgrupo){
           

        }
        public function update(Subgrupo $subgrupo){
            
        }
        public function findByDescricao($search){
            $grupos = [];

            $stmt = $this->conn->prepare("SELECT subgrupo_cadastro.sc_id,subgrupo_cadastro.gc_id, subgrupo_cadastro.sc_descricao, grupo_cadastro.gc_descricao, grupo_cadastro.gc_id  
                                          FROM  subgrupo_cadastro, grupo_cadastro WHERE grupo_cadastro.gc_id = subgrupo_cadastro.gc_id AND sc_id LIKE '%$search%' OR sc_descricao LIKE '%$search%'");

            $stmt->execute();

            if($stmt->rowCount() > 0) {

                $gruposArray = $stmt->fetchAll();

                foreach($gruposArray as $grupo) {
                    $grupos[] = $this->buildSubGrupo($grupo);
                }

            }

            return $grupos;
            
        }
        public function findById($id){
           
        }
        public function findByGrupo($grupo){
            
        }
        public function deleteSubGrupo($id){
            
        }
        public function findAll(){
            $grupos = [];
            $stmt = $this->conn->prepare("SELECT subgrupo_cadastro.sc_id,subgrupo_cadastro.gc_id, subgrupo_cadastro.sc_descricao, grupo_cadastro.gc_descricao, grupo_cadastro.gc_id  
                                          FROM subgrupo_cadastro, grupo_cadastro
                                          WHERE grupo_cadastro.gc_id = subgrupo_cadastro.gc_id");            
            $stmt->execute();  
            if($stmt->rowCount()> 0){
                $grupoarray = $stmt->fetchAll();
                foreach($grupoarray as $grupo) {
                    $grupos[] = $this->buildSubGrupo($grupo);
                }                  
                    
            }  
            return $grupos;      
            
            
        }
    }