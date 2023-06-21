<?php
/* Se declara una nueva clase */
class seller extends connect{
    private $queryPost = 'INSERT INTO tb_seller(seller_id,seller_name) VALUES(:cc,:name)';
    private $queryGetAll = 'SELECT * FROM tb_seller';
    private $queryDelete = 'DELETE FROM tb_seller WHERE seller_id = :sellerId';
    private $queryUpdate = 'UPDATE tb_seller SET seller_name = :sName WHERE seller_id = :sellerId';
    private $message;
    use getInstance;
    function __construct(private $Seller_Id,public $Seller_Name){parent::__construct();}
    public function postSeller(){
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
    public function getAllSeller(){
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
    public function deleteSeller($IdSeller){
        try{
            $res = $this->conx->prepare($queryDelete);
            $res->bindValue(':sellerId', $IdSeller);
            $res->execute();
            $this->message = ["Code" => 200, "Message" => "Deleted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function updateSeller($IdSeller, $newName){
        try{
            $res = $this->conx->prepare($queryUpdate);
            $res->bindValue(':sName', $newName);
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
