<?php
class client extends connect{
    private $queryPost = 'INSERT INTO tb_client(client_id,client_fullname,client_email,client_address,client_phone) VALUES(:cc,:name,:email,:direction,:cellphone)';
    private $queryGetAll = 'SELECT * FROM tb_client';
    private $queryDelete = 'DELETE FROM tb_client WHERE client_id = :clientId';
    private $queryUpdate = 'UPDATE tb_client SET client_fullname = :fullName, client_email = :email, client_address = :address, client_phone = :phone WHERE identificacion = :clientId';
    private $message;
    use getInstance;
    function __construct(private $Identification, public $Full_Name, public $Email, private $Address, private $Phone){parent::__construct();}
    public function postClient(){
        try{
            $res = $this->conx->prepare($this->queryPost);  
            $res->execute();
            $this->message = ["Code"=>200+$res->rowCount(), "Message" => "Inserted data"];
        }catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=>$res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
    public function getAllClient(){
        try{
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $this->message = ["Code"=> 200, "Message"=> $res->fetchAll(PDO::FETCH_ASSOC)];
        }catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=>$res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
    public function deleteClient($clientId){
        try{
            $res = $this->conx->prepare($queryDelete);
            $res->bindValue(':clientId', $clientId);
            $res->execute();
            $this->message = ["Code" => 200, "Message" => "Deleted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function updateClient($clientId, $newFullName, $newEmail, $newAddress, $newPhone){
        try{
            $res = $this->conx->prepare($queryUpdate);
            $res->bindValue(':fullName', $newFullName);
            $res->bindValue(':email', $newEmail);
            $res->bindValue(':address', $newAddress);
            $res->bindValue(':phone', $newPhone);
            $res->bindValue(':clientId', $clientId);
            $res->execute();
            $this->message = ["Code" => 200, "Message" => "Updated data"];
        } catch(\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
}
?>
