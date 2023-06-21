<?php
/* Se declara una nueva clase */
class product extends connect{
    private $queryPost = 'INSERT INTO tb_product(product_id,product_name,product_amount,product_value) VALUES(:id,:name,:amount,:value)';
    private $queryGetAll = 'SELECT * FROM tb_product';
    private $queryDelete = 'DELETE FROM tb_product WHERE product_id = :productId';
    private $queryUpdate = 'UPDATE tb_product SET product_name = :pName, product_amount = :pAmount, product_value = :pValue WHERE product_id = :productId';
    private $message;
    use getInstance;
    function __construct(public $id_product,public $name_product, public $amount, public $value_product){parent::__construct();}
    public function postProduct(){
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
    public function getAllProduct(){
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
    public function deleteProduct($IdProduct){
        try{
            $res = $this->conx->prepare($queryDelete);
            $res->bindValue(':productId', $IdProduct);
            $res->execute();
            $this->message = ["Code" => 200, "Message" => "Deleted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function updateProduct($IdProduct, $newName, $newAmount, $newValue){
        try{
            $res = $this->conx->prepare($queryUpdate);
            $res->bindValue(':pName', $newName);
            $res->bindValue(':pAmount', $newAmount);
            $res->bindValue(':pValue', $newValue);
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
