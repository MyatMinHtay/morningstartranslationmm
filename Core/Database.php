<?php  


namespace Core;

use PDO;
use App\Config;
use PDOException;

class Database{
    /**
     * Get the PDO database connection
     *
     * @return mixed
     */
    protected static function getDB()
    {
        static $db = null;

        if ($db === null) {
            $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';

            try{
                $db = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            

           
        }

        

        return $db;
    }

    public function query($query,$data = array())
	{
	
		$con = $this->getDB();
        
		
        try{
            $smt = $con->prepare($query);
            $check = $smt->execute($data);
          
            if($check){
                
                $result = [true];
                return $result;

            
            }
            
        }catch(PDOException $e){
            $error = $e->getMessage();
            $boolean = false;
            $result = [
                $boolean,$error
            ];
            return $result;
        }
        

		
        
	
	}

    public function search($query,$data = array())
	{
	
		$con = $this->getDB();
        
		$smt = $con->prepare($query);
		$check = $smt->execute($data);
        
		if($check)
		{
			$result = $smt->fetchAll(PDO::FETCH_ASSOC);
			if(is_array($result) && count($result) > 0){

				return $result;
			}
			
		}

		return false;
	}

    public function jsonObjectToArray($data){
        $array = [];

        foreach($data as $key => $value) {
            $array[$key] = $value;


        }

        return $array;
    }

    public function generateid($code){ 
        $con = $this->getDB();
        switch ($code) {
            
            case 'saleId':
                    $saleId = $con->prepare("SELECT * FROM sales ORDER BY VoucherNo DESC LIMIT 1");
                    $saleId->execute();
    
                    $count = $saleId->rowCount();
                    if($count > 0){
                        
                        $row = $saleId->fetch(PDO::FETCH_ASSOC);
                        $primaryId = $row['VoucherNo'];
                        $realId = trim($primaryId, "V-");
                       
                        $realId = substr($realId,6,4);
                        $realId = (int)$realId;
                        $getdate = date("ymd");
                        $realId = $realId+1;
                        
                        if($realId < 10){
                            
                            $realId = "V-".$getdate."000".$realId;
                        }else if($realId >= 10 && $realId < 100){
                            $realId = "V-".$getdate."00".$realId;
                        }else if($realId > 10 && $realId >= 100 && $realId < 1000){
                            $realId = "V-".$getdate."0".$realId;
                        }else if($realId > 10 && $realId > 100 && $realId >= 1000 && $realId < 10000){
                            $realId = "V-".$getdate.$realId;
                        }
    
                        return $realId;
                        
                        
                    }else{
                        $getdate = date("ymd");
                            return "V-".$getdate."0001";
                    }
                    break;
            case 'PlayingCardId':
                $PlayingCardId = $con->prepare("SELECT * FROM playing_card ORDER BY PlayingCardId DESC LIMIT 1");
                $PlayingCardId->execute();

                $count = $PlayingCardId->rowCount();
                if($count > 0){
                    
                    $row = $PlayingCardId->fetch(PDO::FETCH_ASSOC);
                    $primaryId = $row['PlayingCardId'];
                    // PC0001
                    // P-2209120001
                    $realId = trim($primaryId, "PC");
                    // 2209120001
                    // $trimdate = substr($realId, 0, 6);
                    // $realId = substr($realId,6,4);
                    $realId = (int)$realId;
                    // $getdate = date("ymd");
                    $realId = $realId+1;
                    if($realId < 10){
                        
                        $realId = "PC"."000".$realId;
                    }else if($realId >= 10 && $realId < 100){
                        $realId = "PC"."00".$realId;
                    }else if($realId > 10 && $realId >= 100 && $realId < 1000){
                        $realId = "PC"."0".$realId;
                    }else if($realId > 10 && $realId > 100 && $realId >= 1000 && $realId < 10000){
                        $realId = "PC".$realId;
                    }

                    return $realId;
                    
                    
                }else{
                    $getdate = date("ymd");
                        return "PC0001";
                }
                break;

            case 'CaddyCharges':
                $CaddyCharges = $con->prepare("SELECT * FROM caddy_charges ORDER BY CaddyChargesId DESC LIMIT 1");
                $CaddyCharges->execute();

                $count = $CaddyCharges->rowCount();
                if($count > 0){
                    
                    $row = $CaddyCharges->fetch(PDO::FETCH_ASSOC);
                    $primaryId = $row['CaddyChargesId'];
                    // PC0001
                    // P-2209120001
                    $realId = trim($primaryId, "CC");
                    // 2209120001
                    // $trimdate = substr($realId, 0, 6);
                    // $realId = substr($realId,6,4);
                    $realId = (int)$realId;
                    // $getdate = date("ymd");
                    $realId = $realId+1;
                    if($realId < 10){
                        
                        $realId = "CC"."000".$realId;
                    }else if($realId >= 10 && $realId < 100){
                        $realId = "CC"."00".$realId;
                    }else if($realId > 10 && $realId >= 100 && $realId < 1000){
                        $realId = "CC"."0".$realId;
                    }else if($realId > 10 && $realId > 100 && $realId >= 1000 && $realId < 10000){
                        $realId = "CC".$realId;
                    }

                    return $realId;
                    
                    
                }else{
                    $getdate = date("ymd");
                        return "CC0001";
                }
                break;
            case 'BaggyCharges':
                $BaggyCharges = $con->prepare("SELECT * FROM baggy_charges ORDER BY BaggyChargesId DESC LIMIT 1");
                $BaggyCharges->execute();

                $count = $BaggyCharges->rowCount();
                if($count > 0){
                    
                    $row = $BaggyCharges->fetch(PDO::FETCH_ASSOC);
                    $primaryId = $row['BaggyChargesId'];
                    // PC0001
                    // P-2209120001
                    $realId = trim($primaryId, "BC");
                    // 2209120001
                    // $trimdate = substr($realId, 0, 6);
                    // $realId = substr($realId,6,4);
                    $realId = (int)$realId;
                    // $getdate = date("ymd");
                    $realId = $realId+1;
                    if($realId < 10){
                        
                        $realId = "BC"."000".$realId;
                    }else if($realId >= 10 && $realId < 100){
                        $realId = "BC"."00".$realId;
                    }else if($realId > 10 && $realId >= 100 && $realId < 1000){
                        $realId = "BC"."0".$realId;
                    }else if($realId > 10 && $realId > 100 && $realId >= 1000 && $realId < 10000){
                        $realId = "BC".$realId;
                    }

                    return $realId;
                    
                    
                }else{
                    $getdate = date("ymd");
                        return "BC0001";
                }
                break;

            case 'TrollyCharges':
                $TrollyCharges = $con->prepare("SELECT * FROM trolly_charges ORDER BY TrollyChargesId DESC LIMIT 1");
                $TrollyCharges->execute();

                $count = $TrollyCharges->rowCount();
                if($count > 0){
                    
                    $row = $TrollyCharges->fetch(PDO::FETCH_ASSOC);
                    $primaryId = $row['TrollyChargesId'];
                    // PC0001
                    // P-2209120001
                    $realId = trim($primaryId, "TC");
                    // 2209120001
                    // $trimdate = substr($realId, 0, 6);
                    // $realId = substr($realId,6,4);
                    $realId = (int)$realId;
                    // $getdate = date("ymd");
                    $realId = $realId+1;
                    if($realId < 10){
                        
                        $realId = "TC"."000".$realId;
                    }else if($realId >= 10 && $realId < 100){
                        $realId = "TC"."00".$realId;
                    }else if($realId > 10 && $realId >= 100 && $realId < 1000){
                        $realId = "TC"."0".$realId;
                    }else if($realId > 10 && $realId > 100 && $realId >= 1000 && $realId < 10000){
                        $realId = "TC".$realId;
                    }

                    return $realId;
                    
                    
                }else{
                    $getdate = date("ymd");
                        return "TC0001";
                }
                break;
            case 'GolfBallCharges':
                $GolfBallCharges = $con->prepare("SELECT * FROM golf_ball_charges ORDER BY GolfBallChargesId DESC LIMIT 1");
                $GolfBallCharges->execute();

                $count = $GolfBallCharges->rowCount();
                if($count > 0){
                    
                    $row = $GolfBallCharges->fetch(PDO::FETCH_ASSOC);
                    $primaryId = $row['GolfBallChargesId'];
                    // PC0001
                    // P-2209120001
                    $realId = trim($primaryId, "GBC");
                    // 2209120001
                    // $trimdate = substr($realId, 0, 6);
                    // $realId = substr($realId,6,4);
                    $realId = (int)$realId;
                    // $getdate = date("ymd");
                    $realId = $realId+1;
                    if($realId < 10){
                        
                        $realId = "GBC"."000".$realId;
                    }else if($realId >= 10 && $realId < 100){
                        $realId = "GBC"."00".$realId;
                    }else if($realId > 10 && $realId >= 100 && $realId < 1000){
                        $realId = "GBC"."0".$realId;
                    }else if($realId > 10 && $realId > 100 && $realId >= 1000 && $realId < 10000){
                        $realId = "GBC".$realId;
                    }

                    return $realId;
                    
                    
                }else{
                    $getdate = date("ymd");
                        return "GBC0001";
                }
                break;
            case 'GolfSetCharges':
                $GolfSetCharges = $con->prepare("SELECT * FROM golf_set_charges ORDER BY GolfSetChargesId DESC LIMIT 1");
                $GolfSetCharges->execute();

                $count = $GolfSetCharges->rowCount();
                if($count > 0){
                    
                    $row = $GolfSetCharges->fetch(PDO::FETCH_ASSOC);
                    $primaryId = $row['GolfSetChargesId'];
                   
                    $realId = trim($primaryId, "GSC");
             
                    $realId = (int)$realId;
             
                    $realId = $realId+1;

                    if($realId < 10){
                        
                        $realId = "GSC"."000".$realId;
                    }else if($realId >= 10 && $realId < 100){
                        $realId = "GSC"."00".$realId;
                    }else if($realId > 10 && $realId >= 100 && $realId < 1000){
                        $realId = "GSC"."0".$realId;
                    }else if($realId > 10 && $realId > 100 && $realId >= 1000 && $realId < 10000){
                        $realId = "GSC".$realId;
                    }

                    return $realId;
                    
                    
                }else{
                    
                        return "GSC0001";
                }
                break;

            case 'GolfShoesCharges':
                $GolfShoesCharges = $con->prepare("SELECT * FROM golf_set_charges ORDER BY GolfShoesChargesId DESC LIMIT 1");
                $GolfShoesCharges->execute();

                $count = $GolfShoesCharges->rowCount();
                if($count > 0){
                    
                    $row = $GolfShoesCharges->fetch(PDO::FETCH_ASSOC);
                    $primaryId = $row['GolfShoesChargesId'];
                    
                    $realId = trim($primaryId, "GSSC");
                
                    $realId = (int)$realId;
                
                    $realId = $realId+1;
                    
                    if($realId < 10){
                        
                        $realId = "GSSC"."000".$realId;
                    }else if($realId >= 10 && $realId < 100){
                        $realId = "GSSC"."00".$realId;
                    }else if($realId > 10 && $realId >= 100 && $realId < 1000){
                        $realId = "GSSC"."0".$realId;
                    }else if($realId > 10 && $realId > 100 && $realId >= 1000 && $realId < 10000){
                        $realId = "GSSC".$realId;
                    }

                    return $realId;
                    
                    
                }else{
                    
                        return "GSSC0001";
                }
                break;
            case 'CameraCharges':
                $CameraCharges = $con->prepare("SELECT * FROM camera_charges ORDER BY CameraChargesId DESC LIMIT 1");
                $CameraCharges->execute();

                $count = $CameraCharges->rowCount();
                if($count > 0){
                    
                    $row = $CameraCharges->fetch(PDO::FETCH_ASSOC);
                    $primaryId = $row['CameraChargesId'];
                    
                    $realId = trim($primaryId, "CMC");
                
                    $realId = (int)$realId;
                
                    $realId = $realId+1;
                    
                    if($realId < 10){
                        
                        $realId = "CMC"."000".$realId;
                    }else if($realId >= 10 && $realId < 100){
                        $realId = "CMC"."00".$realId;
                    }else if($realId > 10 && $realId >= 100 && $realId < 1000){
                        $realId = "CMC"."0".$realId;
                    }else if($realId > 10 && $realId > 100 && $realId >= 1000 && $realId < 10000){
                        $realId = "CMC".$realId;
                    }

                    return $realId;
                    
                    
                }else{
                    
                        return "CMC0001";
                }
                break;
            case 'ElectricCharges':
                $ElectricCharges = $con->prepare("SELECT * FROM electric_charges ORDER BY ElectricChargesId DESC LIMIT 1");
                $ElectricCharges->execute();

                $count = $ElectricCharges->rowCount();
                if($count > 0){
                    
                    $row = $ElectricCharges->fetch(PDO::FETCH_ASSOC);
                    $primaryId = $row['ElectricChargesId'];
                    
                    $realId = trim($primaryId, "EC");
                
                    $realId = (int)$realId;
                
                    $realId = $realId+1;
                    
                    if($realId < 10){
                        
                        $realId = "EC"."000".$realId;
                    }else if($realId >= 10 && $realId < 100){
                        $realId = "EC"."00".$realId;
                    }else if($realId > 10 && $realId >= 100 && $realId < 1000){
                        $realId = "EC"."0".$realId;
                    }else if($realId > 10 && $realId > 100 && $realId >= 1000 && $realId < 10000){
                        $realId = "EC".$realId;
                    }

                    return $realId;
                    
                    
                }else{
                    
                        return "EC0001";
                }
                break;
            case 'MatchCharges':
                $MatchCharges = $con->prepare("SELECT * FROM match_charges ORDER BY MatchChargesId DESC LIMIT 1");
                $MatchCharges->execute();

                $count = $MatchCharges->rowCount();
                if($count > 0){
                    
                    $row = $MatchCharges->fetch(PDO::FETCH_ASSOC);
                    $primaryId = $row['MatchChargesId'];
                    
                    $realId = trim($primaryId, "MC");
                
                    $realId = (int)$realId;
                
                    $realId = $realId+1;
                    
                    if($realId < 10){
                        
                        $realId = "MC"."000".$realId;
                    }else if($realId >= 10 && $realId < 100){
                        $realId = "MC"."00".$realId;
                    }else if($realId > 10 && $realId >= 100 && $realId < 1000){
                        $realId = "MC"."0".$realId;
                    }else if($realId > 10 && $realId > 100 && $realId >= 1000 && $realId < 10000){
                        $realId = "MC".$realId;
                    }

                    return $realId;
                    
                    
                }else{
                    
                        return "MC0001";
                }
                break;
            case 'booking':
                $MatchCharges = $con->prepare("SELECT * FROM booking ORDER BY BookingId DESC LIMIT 1");
                $MatchCharges->execute();

                $count = $MatchCharges->rowCount();
                if($count > 0){
                    
                    $row = $MatchCharges->fetch(PDO::FETCH_ASSOC);
                    $primaryId = $row['BookingId'];
                    
                    $realId = trim($primaryId, "B");
                
                    $realId = (int)$realId;
                
                    $realId = $realId+1;
                    
                    if($realId < 10){
                        
                        $realId = "B"."000".$realId;
                    }else if($realId >= 10 && $realId < 100){
                        $realId = "B"."00".$realId;
                    }else if($realId > 10 && $realId >= 100 && $realId < 1000){
                        $realId = "B"."0".$realId;
                    }else if($realId > 10 && $realId > 100 && $realId >= 1000 && $realId < 10000){
                        $realId = "B".$realId;
                    }

                    return $realId;
                    
                    
                }else{
                    
                        return "B0001";
                }
                break;
                
            
        }
    }
}

