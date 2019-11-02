<?php

class MysqlAdapter{

    private $conffig=array();
    private $link;
    private $result;


     public function __construct($host="localhost" , $user="root" , $pass="rootroot" , $db="php" ){
        $this->conffig=[$host,$user,$pass,$db];
    }

    function connect(){
        if($this->link===null){
            list($host,$user,$pass,$db)=$this->conffig;

            if(!$this->link=@mysqli_connect($host,$user,$pass,$db)){
                throw new ErrorException("error connect to db");
            }
            unset($host,$user,$pass,$db);
            }
            return $this->link;
        }

    function query($query){
        if(!is_string($query) || empty($query)){
            throw new ErrorException("invalid query" . $query );
        }
        //connect to DB
        $this->connect();
        if(!$this->result=mysqli_query($this->link,$query)){
            throw new ErrorException("error in exuting query" . $query );
        }
        return $this->result;
    }


    public function select($table,$where='',$fields='*',$order='',$limit=null,$offset=null){
        $query=' select '.$fields.' from '.$table
                .( ($where) ? ' where ' . $where : '')
                .( ($limit) ? ' limit ' . $limit : '')
                .( ($offset && $limit) ? ' offset ' . $offset :'' )
                .( ($order) ? ' order by ' . $order : '' );

        $this->query($query);
        return $this->countRows();
    }

    public function insert($table,array $data){
        $fields=implode(',',array_keys($data));
        $values=implode(',', array_map(array( $this,'quoteValue' ), array_values($data) ) );
        $query= 'insert into ' . $table . ' (' . $fields . ') ' . ' values (' . $values . ')' ;
        $this->query($query);
        return $this->getInsertedID();
    }


    public function update( $table , array $data , $where = '' ){
        $set=array();
        foreach($data as $field=>$value){
            $set[]=$field . '='. $this->quoteValue($value);
        }
        $set=implode(',',$set);
        $query='update ' . $table . ' set ' . $set . ( ($where) ? 'where' . $where : '' );
        $this->query($query);
        return $this->getAffectedRows();
    }


    public function delete($table , $where = '' ){
        $query='delete from ' . $table . ( ($where) ? ' where ' . $where : '' );
        $this->query($query);
        return $this->getAffectedRows(); 
    }


    
    public function quoteValue($value){
        $this->connect();

        if($value===null){
            $value='null';
        }
        else if(!is_numeric($value)){
            $value="'".mysqli_real_escape_string($this->link,$value)."'";
        }
        return $value;

    }


    public function fetch(){


        if($this->result!==null){
            if(($row=mysqli_fetch_array($this->result,MYSQLI_ASSOC))===false){
                mysqli_free_result($this->result);
            }            
            return $row;
        }
        return false;
    }

    public function fetchALL(){


        if($this->result!==null){
            if(($all=mysqli_fetch_all($this->result,MYSQLI_ASSOC))===false){
                mysqli_free_result($this->result);
            }
            return $all;

        }
        return false;
    }

    function getInsertedID()
    {
        return $this->link!==null ? mysqli_insert_id($this->link) : null ;
    }

    function countRows()
    {
        return $this->link!==null ? mysqli_num_rows($this->result) : null ;
    }
    
    function getAffectedRows(){
        return $this->link!==null ? mysqli_affected_rows($this->link) : 0 ;
    }

}

