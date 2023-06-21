<?php
/* Se declara una nueva clase */
class bill extends connect{
    private $queryPost = 'INSERT INTO tb_bill(n_bill, bill_date) VALUES(:id_Bill,:date_Bill)';
    private $queryGetAll = 'SELECT * FROM tb_bill';
    private $queryDelete = 'DELETE FROM tb_bill WHERE n_bill = :IdBill';
    private $queryUpdate = 'UPDATE tb_bill SET bill_date = :bDate WHERE n_bill = :IdBill';
    use getInstance;
    function __construct(public $N_Bill,public $Bill_Date){}
    public function postBill(){
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
    public function getAllBill(){
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
    public function deleteBill($Id_bill){
        try{
            $res = $this->conx->prepare($queryDelete);
            $res->bindValue(':IdBill', $Id_bill);
            $res->execute();
            $this->message = ["Code" => 200, "Message" => "Deleted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function updateBill($Id_bill, $newDate){
        try{
            $res = $this->conx->prepare($queryUpdate);
            $res->bindValue(':bDate', $newDate);
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
