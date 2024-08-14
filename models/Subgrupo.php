<?php
    class Subgrupo{
        public $id;
        public $idgrupo;
        public $descricao;
    }
    interface SubgrupoDAOInterface{
        public function buildSubGrupo($data);
        public function create(Subgrupo $subgrupo);
        public function update(Subgrupo $subgrupo);
        public function findByDescricao($search);
        public function findById($id);
        public function deleteSubGrupo($id);
        public function findAll();
    }