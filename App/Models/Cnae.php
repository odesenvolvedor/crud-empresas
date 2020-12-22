<?php

namespace App\Models;

class Cnae extends Base 
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->table = 'cnae';
        parent::__construct();
    }

    /**
     * Retorna registros da tabela
     * @param string $term
     * @return array|null
     */
    public function search( $term )
    {
        $sql = "
            SELECT * FROM $this->table 
            WHERE 
                codigo_cnae LIKE '%$term%'
            OR 
                desc_cnae LIKE '%$term%' ";

        $req = $this->conn->prepare( $sql );
        $req->execute();

        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }
}