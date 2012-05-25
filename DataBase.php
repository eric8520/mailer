<?php

class DataBase{
       public $host;
       public $user;
       public $pass;
       public function __construct(){
            $this->host="localhost";
            $this->user="rzbac701_eric";
            $this->pass="info2012";
       }
       public function Insert($array=array(),$db,$table,$autoincrement=true,$totalregistros)
       {
                $sql="";
			     $campos=array();
                 $values=array();
                 $i=0;
                 if(is_array($array))
                 {
                    
					 if(sizeof($array)>1){
					 	foreach($array as $key => $value)
                     	{
                              //$values[]=$value;
                               $values[]="'".$value."'";
                     	}
					 }
					 else{
						  $values[]=$array[0]; 
					  }
					 if($i==0){
					$result=$this->mysql_fetch_fields($table,$db,$autoincrement);
					 }
                     $result['campos']=join(",",$result);
                     
					 $values['values']=join(",",$values);
                     $sql.="insert into ".$table. "(".$result['campos'].") values "."(".$values['values'].")";
                       
                  		 
	            
                     $coneccion=mysql_connect($this->host,$this->user,$this->pass);
                     $db=mysql_select_db($db,$coneccion);
                     $res=mysql_query($sql,$coneccion);
                      
                     return mysql_insert_id();
                 }
				 
				 $i++;
                
       }
	   public function Importa($array=array(),$db,$table,$autoincrement=true,$totalregistros){
		      $sql="";
			  $i=0;
			  if(is_array($array)){
				    if(sizeof($array)>0){
					     if(sizeof($array)>1){
					 		foreach($array as $key => $value)
                     		{
                              //$values[]=$value;
                               	$values[]="'".$value."'";
                     		}
						 }
					 	else{
						  $values[]=$array[0]; 
					  	}
						 if($i==0){
					$result=$this->mysql_fetch_fields($table,$db,$autoincrement);
					 }
                     $result['campos']=join(",",$result);
                     
					 $values['values']=join(",",$values);
                     $sql.="insert into ".$table. "(".$result['campos'].") values "."(".$values['values'].")\n";
                    
                  		 
	            
                    
                      
                    
					
					}  
				  
			  }
			  $i++;
			  if($i==($totalregistros-1)){
				     echo $i;
				      
				     $this->save_import($sql); 
				  }
	   }
	   public function Load_Data($db,$table,$archivo){
		    $archivo=$archivo;
			$sql="LOAD DATA  LOCAL  INFILE '".$archivo."' INTO TABLE ".$table."  FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n';";
			$coneccion=mysql_connect($this->host,$this->user,$this->pass);
            $db=mysql_select_db($db,$coneccion);
            $data=$res=mysql_query($sql,$coneccion);
			mysql_close($coneccion);
			return $data;
	   }
	  public function save_import($sql){
		          $coneccion=mysql_connect($this->host,$this->user,$this->pass);
                  $db=mysql_select_db($db,$coneccion);
                   $res=mysql_query($sql,$coneccion);
				   mysql_close();
      } 
      public function mysql_real_string($value){
                     $nuevoValor="";
                     $caracter=array("/","<",">","{","}","&","and","or","OR","insert","update","select");
                                 
                     $value=str_replace($caracter,"",$value);
                        
                     
                                    
                              
                    return $value;      
                     
       }
       public function Retrive_LAST_INSERT($db,$table,$id){
                  $sql_id = "SELECT * FROM $table ORDER BY ".$id." DESC LIMIT 1;"; 
                  
                    $coneccion=mysql_connect($this->host,$this->user,$this->pass);
                     $db=mysql_select_db($db,$coneccion);
                     $result=mysql_query($sql_id,$coneccion);
                     $result=mysql_fetch_array($result);
                    
                     return  $result[$id];
        
       }
       function Update($db,$table,$datos=array(),$idcampo){
                $sql="";
                $campos=array();
                $values=array();
                foreach($datos as $key => $value){
                           $campos[]=$key." = '".$value."'"; 
                    
                }
                $campos['campos']=join(",",$campos);
                $sql="update  ".$table." set ".$campos['campos']. " where ".$idcampo;
               
                $coneccion=mysql_connect($this->host,$this->user,$this->pass);
                $db=mysql_select_db($db,$coneccion);
                $res=mysql_query($sql,$coneccion);
                return mysql_affected_rows($coneccion);
        
       }
       public function Retrive($db,$table){
                $coneccion=mysql_connect($this->host,$this->user,$this->pass);
                     $db=mysql_select_db($db,$coneccion);
                     $sql="select * from ".$table;
                     $res=mysql_query($sql,$coneccion);
                     $result=array();
                     while($row=mysql_fetch_array($res,MYSQL_ASSOC))
                     {
                          $result[]=$row;
                     }
                     return $result;
                     
       }
       public function RetriveByRow($id,$db,$table,$campo){
                    $coneccion=mysql_connect($this->host,$this->user,$this->pass);
                     $db=mysql_select_db($db,$coneccion);
                     $sql="select * from ".$table ." where ".$id." = (select ".$table.".$campo)";
                     
                     $result=array();
                     $res=mysql_query($sql,$coneccion);
                       
                     $num=mysql_num_rows($res);
                     if($num>0)
                     { $row=mysql_fetch_row($res);
                        $result=array();
                        $result[]=$row;
                     }
                     else
                     {
                         $result='0';
                     }  
                      
                     return $result;
       }
       public function get_rows_num($db,$table){
                     
                     $coneccion=mysql_connect($this->host,$this->user,$this->pass);
                     $db=mysql_select_db($db,$coneccion);
                     $sql="select * from  ".$table;
                     $res=mysql_query($sql,$coneccion);
                     $num=mysql_num_rows($res);
                    
                     return $num;
        
       }
       public function RetriveByCondition($db,$table,$camposreferencia,$campos=array(),$join=array(),$orderby=""){
                     $condiciones=array();
                     $union="";
                     $sql="";
                     if(sizeof($camposreferencia)>0)
                     {   foreach($camposreferencia as $key => $value)
                        {
                            
                            if(is_numeric($value))
                            {
                                $value=$value;
                               
                            }
                            else
                            {
                                $value="'".$value."'";
                            }
                            $condiciones[]=$key."=".$value; 
                        }
                     }
                     if(sizeof($condiciones)>0)
                     {
                        if(sizeof($condiciones)>1) 
                        { $condiciones['condiciones']=join(' and ',$condiciones);
                        }
                        else
                        if(sizeof($condiciones)==1)
                        {
                            $condiciones['condiciones']=$condiciones[0];
                        }
                     }
                    
                     if(!empty($campos)){
                          if(sizeof($join)==0) 
                          { 
                             $c=array();
                             foreach($campos as $campo){
                                $c[]=$campo;
                            }
                             $campos['campos']=join(",",$c);
                            $sql="select ". $campos['campos'] ." from ".$table." where ".$condiciones['condiciones']." ".$orderby;
                          }
                          
                     }
                    else{
                           
                          $sql="select * from ".$table." where ".$condiciones['condiciones']." ".$orderby;
                        
                     }
                      if(sizeof($join)>=1)
                       {
                          for($j=0;$j<sizeof($join);$j++)
                         {  $tablejoin=explode('=',$join[$j]);
                           $tablejoin=explode('.',$tablejoin[1]);
                           $union.=" inner join ".$tablejoin[0]." on ". $join[$j];
                         
                         }
                         if(sizeof($campos)==0 && sizeof($condiciones)>0)
                         { 
                           
                          
                           $sql="select *  from ".$table." ".$union." where ".$condiciones['condiciones']." ".$orderby;
                          
                         }
                         
                         if(sizeof($campos)>0 && sizeof($condiciones)==0)
                         {
                             $c=array();
                             foreach($campos as $campo){
                                $c[]=$campo;
                            }
                             $campos['campos']=join(",",$c);
                            $sql="select ". $campos['campos'] ." from ".$table." ".$union;
                         }
                         if(sizeof($campos)>0 && sizeof($condiciones)>0){
                               $c=array();
                             foreach($campos as $campo){
                                $c[]=$campo;
                            }
                             $campos['campos']=join(",",$c);
                            $sql="select ". $campos['campos'] ." from ".$table." ".$union." where ".$condiciones['condiciones']." ".$orderby; 
                            
                         }
                       }
                       
                      
                    
                     $coneccion=mysql_connect($this->host,$this->user,$this->pass);
                     $db=mysql_select_db($db,$coneccion);
                     
                     
                     
                     $res=mysql_query($sql,$coneccion);
                     echo mysql_error($coneccion);
                     $result=array();
                     while($row=mysql_fetch_array($res,MYSQL_ASSOC))
                     {
                          $result[]=$row;
                     }
                     return $result;
       }
	   public function RetriveByLimit($db,$table,$ini,$fin){
		            $sql="select * from ".$table." limit ".$ini.",".$fin;
					$coneccion=mysql_connect($this->host,$this->user,$this->pass);
                   $db=mysql_select_db($db,$coneccion);
				   $res=mysql_query($sql,$coneccion);
                   
                     $result=array();
                     while($row=mysql_fetch_array($res,MYSQL_ASSOC))
                     {
                          $result[]=$row;
                     }
                     return $result;
	   }
       public function mysql_error(){
             $coneccion=mysql_connect($this->host,$this->user,$this->pass);
             return mysql_error($coneccion);
       }
	   public function mysql_fetch_fields($table,$db,$autoincrment=true) {
        // LIMIT 1 means to only read rows before row 1 (0-indexed)
         
		 $coneccion=mysql_connect($this->host,$this->user,$this->pass);
         $db=mysql_select_db($db,$coneccion);
		 
	    $result = mysql_query("SELECT * FROM $table",$coneccion);
        
		
        
		$num = mysql_num_fields($result);
        
		$output = array();
        $inicio=1;
        if($autoincrment==false){
              $inicio=0;
        }
        for ($i = $inicio; $i < $num;$i++) {
                $field = mysql_fetch_field($result, $i);
                 
               
                $output[] = $field->name;
        }
       
		return $output;
       }
       
}
$database=new DataBase();



?>
