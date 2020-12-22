<?php
/**
 * Base.php
 *
 * @package    App/Models
 * @author     Fernando Campos de Oliveira <fernando@odesenvolvedor.net>
 * @version    $Id$
 **/

namespace App\Models;

use PDO;

class Base
{
    /**
     * @var PDO $conn
     */
    protected $conn;

    /**
     * @var string $table
     */
    protected $table;



    /**
     * Class constructor.
     * 
     * Cria uma instância da classe PDO e abre conexão com o banco de dados
     * importando as configurações de config/database.php
     */
    public function __construct()
    {
        $config = include ROOT . "config/database.php";

        $this->conn = new PDO( 
            "mysql:host={$config['host']};dbname={$config['dbname']}", 
            $config['dbuser'], 
            $config['dbpassword'] );

        $this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }



    /**
     * Retorna todos os registros da tabela
     * @return array|null
     */
    public function all()
    {
        $sql = "SELECT * FROM $this->table";
        $req = $this->conn->prepare( $sql );
        $req->execute();

        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }



    /**
     * Insere um novo registro na tabela
     * @param array $data
     * @return boolean   true para sucesso ou false para falha
     */
    public function create( $data )
    {

        $fields = implode( ',', array_keys( $data ) );
        $values = ':' . str_replace( ',', ',:', $fields );

        $sql = "INSERT INTO $this->table ({$fields}) VALUES ({$values})";

        $req = $this->conn->prepare( $sql );

        return $req->execute( $data );
    }



    /**
     * Retorna um único registro da tabela
     * @param int $id
     * @return array|null
     */
    public function show( $id )
    {
        $sql = "SELECT * FROM $this->table WHERE id = $id";
        $req = $this->conn->prepare( $sql );
        $req->execute();
        return $req->fetch(\PDO::FETCH_ASSOC);
    }



    /**
     * Atualiza um registro na tabela
     * @param int $id
     * @param array $data
     * @return boolean   true para sucesso ou false para falha
     */
    public function update( $id, $data )
    {
        foreach ( $data as $key => $val ) {
            $sets[] = "$key = :$key";
        }
        $data['id'] = $id;

        $sql = "UPDATE $this->table SET " . implode( ', ', $sets ) . " WHERE id = :id";

        $req = $this->conn->prepare( $sql );

        return $req->execute( $data );
    }



    /**
     * Remove um registro na tabela
     * @param int $id
     * @return boolean   true para sucesso ou false para falha
     */
    public function delete( $id )
    {
        $sql = "DELETE FROM $this->table WHERE id = ?";
        $req = $this->conn->prepare( $sql );
        return $req->execute( [$id] );
    }



    /**
     * Retorna o último id inserido no banco de dados
     * @return int|null
     */
    public function getLastInsertedId()
    {
        return $this->conn->lastInsertId();
    }
}
