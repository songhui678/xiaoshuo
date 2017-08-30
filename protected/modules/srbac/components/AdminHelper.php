<?php

class AdminHelper {

//计算商家合作天数
	public static function getDaysValue($strattime,$stoptime) {
	    
	    $startdate=strtotime(date('Y-m-d',strtotime($strattime)));
		$enddate=strtotime(date('Y-m-d',strtotime($stoptime))); 
		$days= round(($enddate-$startdate)/3600/24) ;
	    return $days;
    }
//计算商家好评值
   public static function getWorthValue($recommend,$down,$money,$day) {
	    
		return (log($recommend+2)/log($down+2)*($money/$day));

    }

    //计算日期间隔
   public static function getDateInterval($interval) {
	
		// return date('Y-m-d H:i:s',strtotime("+20 minutes"));;
   	return date('Y-m-d H:i:s',strtotime("+".$interval));

    }

   

   

}

?>