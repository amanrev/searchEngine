<?php 	
$basedir = "/var/customer/signature_db_import";
$config = json_decode(file_get_contents("{$basedir}/dbconfig.json"));	
$conn = mysql_connect($config->host, $config->user, $config->password) or die ('Error connecting to mysql');
mysql_select_db($config->database) or die ('Error selecting schema');
	if($_GET['source']=='destinations' || $_GET['source']=='destination_cruises'){			getDestinations();	}
	if($_GET['source']=='prices'){					getPrices();	}
	if($_GET['source']=='lengths'){					getLength();	}
	if($_GET['source']=='cruise_lines'){			getCruiseLines();	}	
	//if($_GET['source']=='months' || $_GET['source']=='month_cruises'){					getMonths();	}
	//if($_GET['source']=='years' || $_GET['source']=='year_cruises'){					getYears();	}
	if($_GET['source']=='ships'){					getShips();	}
	if($_GET['source']=='departure_ports'){			getDeparturePorts();	}
	if($_GET['source']=='themes'){					getThemes();	}

/*	if($_GET['source']=='froms'){					dateFrom();	}
*/	if($_GET['source']=='tos'){					dateTo();	}



	function getDestinations(){
      	$query = "select distinct d.DestinationID val, d.destination_name txt FROM sig_cruise_offers o
                    join sig_cruise_offer_destinations od on od.offer_id = o.offer_id
                    join sig_destination_to_offer_destination tod on tod.offer_destid = od.offer_dest_id
                    join sig_cruise_destinations d on d.destinationID = tod.destinationID ";
		$where = " ";
        $and = " where ";      					
		if (!empty($_GET['cruise_line'])){
			$where .= $and . " o.sup_id = " . $_GET['cruise_line'];
			$and = " and ";
		}
		if (!empty($_GET['ship'])){
			$where .= $and . " o.product_id = '" . $_GET['ship'] . "'";
			$and = " and ";
        }
        if (!empty($_GET['price'])){
			$where .= $and . " o.from_price <= " . $_GET['price'];
			$and = " and ";
        }
        if (!empty($_GET['length'])){
			$where .= $and . " o.length >= " . $_GET['length'];
			$and = " and ";
        }
       /* if (!empty($_GET['month'])){
			$where .= $and . " month(o.depart_day) = " . $_GET['month'];
			$and = " and ";
        }
        if (!empty($_GET['year'])){
			$where .= $and . " year(o.depart_day) = " . $_GET['year'];
          	$and = " and ";
        }*/
        if (!empty($_GET['departure_port'])){
			$where .= $and . " o.departure_port_id = " . $_GET['departure_port'];
          	$and = " and ";
        }
        if (!empty($_GET['theme'])){
			$where .= $and . " o.theme = '" . $_GET['theme'] . "'";
          	$and = " and ";
        }
        if (!empty($_GET['deal_type'])){          
			$query .= " join sig_deal_offers sdo on sdo.searchable_object_offer_id = o.offer_id ";
			$where .= $and . " sdo.deal_type_id in (" . $_GET['deal_type'] . ")";
			$and = " and ";
        }
       
	   
		
    	 if ($_GET['from']!="" && $_GET['to']!=""){ 
	        	extract($_GET);	        	
	        	//$from.=' 00:00:00';
	        	//$to.=' 00:00:00';
				$where.=$and ." o.depart_day BETWEEN '$from' and '$to'";
				$and = " and ";
				//$query .= $where." order by txt";
	        }

	    $query .= $where." order by txt";
		//result showing start
        echo $query;
		$concat="<option value=''>Destination</option>";
		$q=mysql_query($query);
		while($r=mysql_fetch_array($q)){
			if($r['val']!=''){
				if($r['val']==$_GET['dest']){
					$concat.="<option selected value='".$r['val']."'>".$r['txt']."</option>";	
				}
				else{
					$concat.="<option value='".$r['val']."'>".$r['txt']."</option>";
				}
			}
		}
		echo $concat;
		//result showing end          
	}
	function getPrices(){
      	$query = "select distinct
                    case
                      when o.from_price <= 100 then 100
                      when o.from_price <= 500 then 500
                      when o.from_price <= 1000 then 1000  
                      when o.from_price <= 2000 then 2000
                      when o.from_price <= 3000 then 3000
                      when o.from_price <= 5000 then 5000
                      when o.from_price <= 10000 then 10000
                      when o.from_price <= 50000 then 50000
                      when o.from_price <= 100000 then 100000
                      end val,
                    case
                      when o.from_price <= 100 then 100
                      when o.from_price <= 500 then 500
                      when o.from_price <= 1000 then 1000  
                      when o.from_price <= 2000 then 2000
                      when o.from_price <= 3000 then 3000
                      when o.from_price <= 5000 then 5000
                      when o.from_price <= 10000 then 10000
                      when o.from_price <= 50000 then 50000
                      when o.from_price <= 100000 then 100000
                      end txt
                   from sig_cruise_offers o ";
		$where = " ";
        $and = " where ";      					
        if (!empty($_GET['dest'])){
			$query .= "join sig_cruise_offer_destinations od on od.offer_id = o.offer_id
					   join sig_destination_to_offer_destination tod on tod.offer_destid = od.offer_dest_id ";          
			$where .= $and . " tod.destinationID = " . $_GET['dest'];
			$and = " and ";
		}
		if (!empty($_GET['cruise_line'])){
			$where .= $and . " o.sup_id = " . $_GET['cruise_line'];
			$and = " and ";
		}
		if (!empty($_GET['ship'])){
			$where .= $and . " o.product_id = '" . $_GET['ship'] . "'";
			$and = " and ";
        }
        if (!empty($_GET['length'])){
			$where .= $and . " o.length >= " . $_GET['length'];
			$and = " and ";
        }
     /*   if (!empty($_GET['month'])){
			$where .= $and . " month(o.depart_day) = " . $_GET['month'];
			$and = " and ";
        }
        if (!empty($_GET['year'])){
			$where .= $and . " year(o.depart_day) = " . $_GET['year'];
          	$and = " and ";
        }*/
        if (!empty($_GET['departure_port'])){
			$where .= $and . " o.departure_port_id = " . $_GET['departure_port'];
          	$and = " and ";
        }
        if (!empty($_GET['theme'])){
			$where .= $and . " o.theme = '" . $_GET['theme'] . "'";
          	$and = " and ";
        }
        if (!empty($_GET['deal_type'])){          
			$query .= " join sig_deal_offers sdo on sdo.searchable_object_offer_id = o.offer_id ";
			$where .= $and . " sdo.deal_type_id in (" . $_GET['deal_type'] . ")";
			$and = " and ";
        }

        if ($_GET['from']!="" && $_GET['to']!=""){ 
	        	extract($_GET);	        	
	        	//$from.=' 00:00:00';
	        	//$to.=' 00:00:00';
				$where.=$and ." o.depart_day BETWEEN '$from' and '$to'";
				$and = " and ";
				//$query .= $where." order by txt";
	        }
		$query .= $where." order by val asc";
		//result showing start
		$concat="<option value=''>Price</option>";
		$q=mysql_query($query);
		while($r=mysql_fetch_array($q)){
			if($r['val']!=''){
				if($r['val']==$_GET['price']){
					$concat.="<option selected value='".$r['val']."'>".$r['txt']."</option>";	
				}
				else{
					$concat.="<option value='".$r['val']."'>".$r['txt']."</option>";
				}
			}
		}
		echo $concat;
		//result showing end          
	}
	function getLength(){
      	$query = "select distinct
                    case
                      when o.length >= 100 then 100
                      when o.length >= 50 then 50
                      when o.length >= 20 then 20
                      when o.length >= 10 then 10  
                      when o.length >= 5 then 5
                      when o.length >= 1 then 1
                      end val,
                    case
                      when o.length >= 100 then '100 days'  
                      when o.length >= 50 then '50 days'
                      when o.length >= 20 then '20 days'
                      when o.length >= 10 then '10 days' 
                      when o.length >= 5 then '5 days'
                      when o.length >= 1 then '1 day'
                      end txt
                    from sig_cruise_offers o ";
		$where = " ";
        $and = " where ";      					
        if (!empty($_GET['dest'])){
			$query .= "join sig_cruise_offer_destinations od on od.offer_id = o.offer_id
					   join sig_destination_to_offer_destination tod on tod.offer_destid = od.offer_dest_id ";          
			$where .= $and . " tod.destinationID = " . $_GET['dest'];
			$and = " and ";
		}
		if (!empty($_GET['cruise_line'])){
			$where .= $and . " o.sup_id = " . $_GET['cruise_line'];
			$and = " and ";
		}
		if (!empty($_GET['ship'])){
			$where .= $and . " o.product_id = '" . $_GET['ship'] . "'";
			$and = " and ";
        }  
        if (!empty($_GET['price'])){
			$where .= $and . " o.from_price <= " . $_GET['price'];
         	$and = " and ";
        }       
      
        if (!empty($_GET['departure_port'])){
			$where .= $and . " o.departure_port_id = " . $_GET['departure_port'];
          	$and = " and ";
        }
        if (!empty($_GET['theme'])){
			$where .= $and . " o.theme = '" . $_GET['theme'] . "'";
          	$and = " and ";
        }
        if (!empty($_GET['deal_type'])){          
			$query .= " join sig_deal_offers sdo on sdo.searchable_object_offer_id = o.offer_id ";
			$where .= $and . " sdo.deal_type_id in (" . $_GET['deal_type'] . ")";
			$and = " and ";
        }
        if ($_GET['from']!="" && $_GET['to']!=""){ 
	        	extract($_GET);	        	
	        	//$from.=' 00:00:00';
	        	//$to.=' 00:00:00';
				$where.=$and ." o.depart_day BETWEEN '$from' and '$to'";
				$and = " and ";
				//$query .= $where." order by txt";
	        }
		$query .= $where." order by val asc";
		//result showing start
		$concat.="<option selected value=''>Length</option>";
		$q=mysql_query($query);
		$arr = array();
		while($r=mysql_fetch_array($q)){
			if($r['val']!=''){
				$arr[]=$r['val'];		
			}	
		}
		$arr2=array();
		for($i=0;$i<count($arr);$i++){	
            $arr2[$i]=$arr[$i+1]-1;
		}
		$arr3=array();
		$arr3 = array_combine($arr, $arr2);
		$last=end($arr3);
		foreach ($arr3 as $key => $value) {
			if($value==$last){
				$value="+";
			}
			else{
				$value="-".$value;	
			}			
			if($_GET['length']==$key){
		      $concat.="<option selected value='".$key."'>".$key.$value." days</option>";
			}
			else{				
				$concat.="<option value='".$key."'>".$key.$value." days</option>";
			}
		}
		echo $concat; 
	}
	function getCruiseLines(){
      	$query = "select distinct s.sup_id val, s.sup_name txt from sig_cruise_offers o
                  join sig_cruise_suppliers s on s.sup_id = o.sup_id ";
		$where = " ";
        $and = " where ";      					
        if (!empty($_GET['dest'])){
			$query .= "join sig_cruise_offer_destinations od on od.offer_id = o.offer_id
					   join sig_destination_to_offer_destination tod on tod.offer_destid = od.offer_dest_id ";          
			$where .= $and . " tod.destinationID = " . $_GET['dest'];
			$and = " and ";
		}
		if (!empty($_GET['ship'])){
			$where .= $and . " o.product_id = '" . $_GET['ship'] . "'";
			$and = " and ";
        }  
        if (!empty($_GET['price'])){
			$where .= $and . " o.from_price <= " . $_GET['price'];
         	$and = " and ";
        } 
		if (!empty($_GET['length'])){
			$where .= $and . " o.length >= " . $_GET['length'];
          	$and = " and ";
		}
        
        if (!empty($_GET['departure_port'])){
			$where .= $and . " o.departure_port_id = " . $_GET['departure_port'];
          	$and = " and ";
        }
        if (!empty($_GET['theme'])){
			$where .= $and . " o.theme = '" . $_GET['theme'] . "'";
          	$and = " and ";
        }
        if (!empty($_GET['deal_type'])){          
			$query .= " join sig_deal_offers sdo on sdo.searchable_object_offer_id = o.offer_id ";
			$where .= $and . " sdo.deal_type_id in (" . $_GET['deal_type'] . ")";
			$and = " and ";
        }
         if ($_GET['from']!="" && $_GET['to']!=""){ 
	        	extract($_GET);	        	
	        	//$from.=' 00:00:00';
	        	//$to.=' 00:00:00';
				$where.=$and ." o.depart_day BETWEEN '$from' and '$to'";
				$and = " and ";
				//$query .= $where." order by txt";
	        }
		$query .= $where." order by txt";
		//result showing start
		$concat="<option value=''>Cruise Line</option>";
		$q=mysql_query($query);
		while($r=mysql_fetch_array($q)){
			if($r['val']!=''){
				if($r['val']==$_GET['cruise_line']){
					$concat.="<option selected value='".$r['val']."'>".str_replace('?','',$r['txt'])."</option>";	
				}
				else{
					$concat.="<option value='".$r['val']."'>".str_replace('?','',$r['txt'])."</option>";
				}
			}
		}
		echo $concat;
		//result showing end          
	}

	function dateFrom(){
      	$query = "select distinct max(o.depart_day) val, min(o.depart_day) txt from sig_cruise_offers o ";
		$where = " ";
        $and = " where ";      					
        if (!empty($_GET['dest'])){
        	
			$query .= "join sig_cruise_offer_destinations od on od.offer_id = o.offer_id
					   join sig_destination_to_offer_destination tod on tod.offer_destid = od.offer_dest_id ";          
			$where .= $and . " tod.destinationID = " . $_GET['dest'];
			$and = " and ";
		}
		if (!empty($_GET['cruise_line'])){
			$where .= $and . " o.sup_id = " . $_GET['cruise_line'];
          	$and = " and ";
        }
		if (!empty($_GET['ship'])){
			$where .= $and . " o.product_id = '" . $_GET['ship'] . "'";
			$and = " and ";
        }  
        if (!empty($_GET['price'])){
			$where .= $and . " o.from_price <= " . $_GET['price'];
         	$and = " and ";
        } 
		if (!empty($_GET['length'])){
			$where .= $and . " o.length >= " . $_GET['length'];
          	$and = " and ";
		}		             
        if (!empty($_GET['year'])){
			$where .= $and . " year(o.depart_day) = " . $_GET['year'];
          	$and = " and ";
        }
        if (!empty($_GET['departure_port'])){
			$where .= $and . " o.departure_port_id = " . $_GET['departure_port'];
          	$and = " and ";
        }
        if (!empty($_GET['theme'])){
			$where .= $and . " o.theme = '" . $_GET['theme'] . "'";
          	$and = " and ";
        }
        if (!empty($_GET['deal_type'])){          
			$query .= " join sig_deal_offers sdo on sdo.searchable_object_offer_id = o.offer_id ";
			$where .= $and . " sdo.deal_type_id in (" . $_GET['deal_type'] . ")";
			$and = " and ";
        }
        if ($_GET['from']!="" && $_GET['to']!=""){ 
	        	extract($_GET);	        	
	        	//$from.=' 00:00:00';
	        	//$to.=' 00:00:00';
				$where.=$and ." o.depart_day BETWEEN '$from' and '$to'";
				$and = " and ";
				//$query .= $where." order by txt";
	        }
		$query .= $where." order by o.depart_day asc";
		//result showing start
		$concat="";
		//$concat="<option value=''>Month</option>";
		$q=mysql_query($query);
		$r=mysql_fetch_array($q);
			if($r['val']!=''){
					
				$d=str_replace("00:00:00", "", $r['val']);
				$e=str_replace("00:00:00", "", $r['txt']);
				$dd=trim($d);
				$ee=trim($e);
				$concat=$dd;
				

				//echo $r;
			
		}
		//setcookie('aa', 'hi', time() + (86400 * 30), "/"); // 86400 = 1 day
		echo $concat;
		//result showing end          
	}
	function dateTo(){
      	$query = "select distinct max(o.depart_day) val, min(o.depart_day) txt from sig_cruise_offers o ";
		$where = " ";
        $and = " where ";      					
        if (!empty($_GET['dest'])){
        	
			$query .= "join sig_cruise_offer_destinations od on od.offer_id = o.offer_id
					   join sig_destination_to_offer_destination tod on tod.offer_destid = od.offer_dest_id ";          
			$where .= $and . " tod.destinationID = " . $_GET['dest'];
			$and = " and ";
		}
		if (!empty($_GET['cruise_line'])){
			$where .= $and . " o.sup_id = " . $_GET['cruise_line'];
          	$and = " and ";
        }
		if (!empty($_GET['ship'])){
			$where .= $and . " o.product_id = '" . $_GET['ship'] . "'";
			$and = " and ";
        }  
        if (!empty($_GET['price'])){
			$where .= $and . " o.from_price <= " . $_GET['price'];
         	$and = " and ";
        } 
		if (!empty($_GET['length'])){
			$where .= $and . " o.length >= " . $_GET['length'];
          	$and = " and ";
		}		             
        if (!empty($_GET['year'])){
			$where .= $and . " year(o.depart_day) = " . $_GET['year'];
          	$and = " and ";
        }
        if (!empty($_GET['departure_port'])){
			$where .= $and . " o.departure_port_id = " . $_GET['departure_port'];
          	$and = " and ";
        }
        if (!empty($_GET['theme'])){
			$where .= $and . " o.theme = '" . $_GET['theme'] . "'";
          	$and = " and ";
        }
        if (!empty($_GET['deal_type'])){          
			$query .= " join sig_deal_offers sdo on sdo.searchable_object_offer_id = o.offer_id ";
			$where .= $and . " sdo.deal_type_id in (" . $_GET['deal_type'] . ")";
			$and = " and ";
        }
        if ($_GET['from']!="" && $_GET['to']!=""){ 
	        	extract($_GET);	        	
	        	//$from.=' 00:00:00';
	        	//$to.=' 00:00:00';
				$where.=$and ." o.depart_day BETWEEN '$from' and '$to'";
				$and = " and ";
				//$query .= $where." order by txt";
	        }
		$query .= $where." order by o.depart_day asc";
		//result showing start
		$concat="";
		//$concat="<option value=''>Month</option>";
		$q=mysql_query($query);
		$r=mysql_fetch_array($q);
			if($r['val']!=''){
					
					$d=str_replace("00:00:00", "", $r['val']);
					$e=str_replace("00:00:00", "", $r['txt']);
					$dd=trim($d);
					$ee=trim($e);
					$concat=$dd;
			

				//echo $r;
			
		}
		echo $concat;
		//result showing end          
	}	


	function aman(){
      	$query = "select distinct max(o.depart_day) val, min(o.depart_day) txt from sig_cruise_offers o ";
		$where = " ";
        $and = " where ";      					
        if (!empty($_GET['dest'])){
        	
			$query .= "join sig_cruise_offer_destinations od on od.offer_id = o.offer_id
					   join sig_destination_to_offer_destination tod on tod.offer_destid = od.offer_dest_id ";          
			$where .= $and . " tod.destinationID = " . $_GET['dest'];
			$and = " and ";
		}
		if (!empty($_GET['cruise_line'])){
			$where .= $and . " o.sup_id = " . $_GET['cruise_line'];
          	$and = " and ";
        }
		if (!empty($_GET['ship'])){
			$where .= $and . " o.product_id = '" . $_GET['ship'] . "'";
			$and = " and ";
        }  
        if (!empty($_GET['price'])){
			$where .= $and . " o.from_price <= " . $_GET['price'];
         	$and = " and ";
        } 
		if (!empty($_GET['length'])){
			$where .= $and . " o.length >= " . $_GET['length'];
          	$and = " and ";
		}		             
        if (!empty($_GET['year'])){
			$where .= $and . " year(o.depart_day) = " . $_GET['year'];
          	$and = " and ";
        }
        if (!empty($_GET['departure_port'])){
			$where .= $and . " o.departure_port_id = " . $_GET['departure_port'];
          	$and = " and ";
        }
        if (!empty($_GET['theme'])){
			$where .= $and . " o.theme = '" . $_GET['theme'] . "'";
          	$and = " and ";
        }
        if (!empty($_GET['deal_type'])){          
			$query .= " join sig_deal_offers sdo on sdo.searchable_object_offer_id = o.offer_id ";
			$where .= $and . " sdo.deal_type_id in (" . $_GET['deal_type'] . ")";
			$and = " and ";
        }
        if ($_GET['from']!="" && $_GET['to']!=""){ 
	        	extract($_GET);	        	
	        	//$from.=' 00:00:00';
	        	//$to.=' 00:00:00';
				$where.=$and ." o.depart_day BETWEEN '$from' and '$to'";
				$and = " and ";
				//$query .= $where." order by txt";
	        }
		$query .= $where." order by o.depart_day asc";
		//result showing start
		$concat="";
		//$concat="<option value=''>Month</option>";
		$q=mysql_query($query);
		$r=mysql_fetch_array($q);
			if($r['val']!=''){
					
					$d=str_replace("00:00:00", "", $r['val']);
					$e=str_replace("00:00:00", "", $r['txt']);
					$dd=trim($d);
					$ee=trim($e);
					$concat=$dd;
			

				//echo $r;
			
		}
		echo $concat;
		//result showing end          
	}	

	/*function dateTo(){
      	$query = "select distinct year(o.depart_day) val, year(o.depart_day) txt from sig_cruise_offers o ";
		$where = " ";
        $and = " where ";      					
        if (!empty($_GET['dest'])){
			$query .= "join sig_cruise_offer_destinations od on od.offer_id = o.offer_id
					   join sig_destination_to_offer_destination tod on tod.offer_destid = od.offer_dest_id ";          
			$where .= $and . " tod.destinationID = " . $_GET['dest'];
			$and = " and ";
		}
		if (!empty($_GET['cruise_line'])){
			$where .= $and . " o.sup_id = " . $_GET['cruise_line'];
          	$and = " and ";
        }
		if (!empty($_GET['ship'])){
			$where .= $and . " o.product_id = '" . $_GET['ship'] . "'";
			$and = " and ";
        }  
        if (!empty($_GET['price'])){
			$where .= $and . " o.from_price <= " . $_GET['price'];
         	$and = " and ";
        } 
		if (!empty($_GET['length'])){
			$where .= $and . " o.length >= " . $_GET['length'];
          	$and = " and ";
		}		             
        if (!empty($_GET['month'])){
			$where .= $and . " month(o.depart_day) = " . $_GET['month'];
          	$and = " and ";
        }
        if (!empty($_GET['departure_port'])){
			$where .= $and . " o.departure_port_id = " . $_GET['departure_port'];
          	$and = " and ";
        }
        if (!empty($_GET['theme'])){
			$where .= $and . " o.theme = '" . $_GET['theme'] . "'";
          	$and = " and ";
        }
        if (!empty($_GET['deal_type'])){          
			$query .= " join sig_deal_offers sdo on sdo.searchable_object_offer_id = o.offer_id ";
			$where .= $and . " sdo.deal_type_id in (" . $_GET['deal_type'] . ")";
			$and = " and ";
        }
		$query .= $where." order by year(o.depart_day) asc";
		$concat="";
		//$concat="<option value=''>Year</option>";
		$q=mysql_query($query);
		while($r=mysql_fetch_array($q)){
			if($r['val']!=''){
				if($r['val']==$_GET['year']){
					$concat.="<option selected value='".$r['val']."'>".$r['txt']."</option>";	
				}
				else{
					$concat.="<option value='".$r['val']."'>".$r['txt']."</option>";
				}
			}
		}
		echo $concat;
		         
	}*/

	function getShips(){
      	$query = "select distinct sh.product_id val, sh.ship_name txt from sig_cruise_offers o
                  join sig_cruise_ships sh on sh.product_id = o.product_id ";
		$where = " ";
        $and = " where ";      					
        if (!empty($_GET['dest'])){
			$query .= "join sig_cruise_offer_destinations od on od.offer_id = o.offer_id
					   join sig_destination_to_offer_destination tod on tod.offer_destid = od.offer_dest_id ";          
			$where .= $and . " tod.destinationID = " . $_GET['dest'];
			$and = " and ";
		}
		if (!empty($_GET['cruise_line'])){
			$where .= $and . " o.sup_id = " . $_GET['cruise_line'];
          	$and = " and ";
        }  
        if (!empty($_GET['price'])){
			$where .= $and . " o.from_price <= " . $_GET['price'];
         	$and = " and ";
        } 
		if (!empty($_GET['length'])){
			$where .= $and . " o.length >= " . $_GET['length'];
          	$and = " and ";
		}		             
       
        if (!empty($_GET['departure_port'])){
			$where .= $and . " o.departure_port_id = " . $_GET['departure_port'];
          	$and = " and ";
        }
        if (!empty($_GET['theme'])){
			$where .= $and . " o.theme = '" . $_GET['theme'] . "'";
          	$and = " and ";
        }
        if (!empty($_GET['deal_type'])){          
			$query .= " join sig_deal_offers sdo on sdo.searchable_object_offer_id = o.offer_id ";
			$where .= $and . " sdo.deal_type_id in (" . $_GET['deal_type'] . ")";
			$and = " and ";
        }
         if ($_GET['from']!="" && $_GET['to']!=""){ 
	        	extract($_GET);	        	
	        	//$from.=' 00:00:00';
	        	//$to.=' 00:00:00';
				$where.=$and ." o.depart_day BETWEEN '$from' and '$to'";
				$and = " and ";
				//$query .= $where." order by txt";
	        }
		$query .= $where." order by txt";
		//result showing start
		$concat="<option value=''>Ship</option>";
		$q=mysql_query($query);
		while($r=mysql_fetch_array($q)){
			if($r['val']!=''){
				if($r['val']==$_GET['ship']){
					$concat.="<option selected value='".$r['val']."'>".str_replace('?','',$r['txt'])."</option>";	
				}
				else{
					$concat.="<option value='".$r['val']."'>".str_replace('?','',$r['txt'])."</option>";
				}
			}
		}
		echo $concat;
		//result showing end          
	}
	function getDeparturePorts(){
      	$query = "select distinct o.departure_port_id val, d2.Destination_Name txt from sig_cruise_offers o
                  join sig_cruise_destinations d2 on d2.destinationID = o.departure_port_id ";
		$where = " ";
        $and = " where ";      					
        if (!empty($_GET['dest'])){
			$query .= "join sig_cruise_offer_destinations od on od.offer_id = o.offer_id
					   join sig_destination_to_offer_destination tod on tod.offer_destid = od.offer_dest_id ";          
			$where .= $and . " tod.destinationID = " . $_GET['dest'];
			$and = " and ";
		}
		if (!empty($_GET['cruise_line'])){
			$where .= $and . " o.sup_id = " . $_GET['cruise_line'];
          	$and = " and ";
        }
        if (!empty($_GET['ship'])){
			$where .= $and . " o.product_id = " . $_GET['ship'];
         	$and = " and ";
        }
        if (!empty($_GET['price'])){
			$where .= $and . " o.from_price <= " . $_GET['price'];
         	$and = " and ";
        } 
		if (!empty($_GET['length'])){
			$where .= $and . " o.length >= " . $_GET['length'];
          	$and = " and ";
		}		             
              
        if (!empty($_GET['theme'])){
			$where .= $and . " o.theme = '" . $_GET['theme'] . "'";
          	$and = " and ";
        }
        if (!empty($_GET['deal_type'])){          
			$query .= " join sig_deal_offers sdo on sdo.searchable_object_offer_id = o.offer_id ";
			$where .= $and . " sdo.deal_type_id in (" . $_GET['deal_type'] . ")";
			$and = " and ";
        }
         if ($_GET['from']!="" && $_GET['to']!=""){ 
	        	extract($_GET);	        	
	        	//$from.=' 00:00:00';
	        	//$to.=' 00:00:00';
				$where.=$and ." o.depart_day BETWEEN '$from' and '$to'";
				$and = " and ";
				//$query .= $where." order by txt";
	        }
		$query .= $where." order by txt";
		//result showing start
		$concat="<option value=''>Departure Port</option>";
		$q=mysql_query($query);
		while($r=mysql_fetch_array($q)){
			if($r['val']!=''){
				if($r['val']==$_GET['departure_port']){
					$concat.="<option selected value='".$r['val']."'>".$r['txt']."</option>";	
				}
				else{
					$concat.="<option value='".$r['val']."'>".$r['txt']."</option>";
				}
			}
		}
		echo $concat;
		//result showing end          
	}
	function getThemes(){
      	$query = "select distinct theme val, theme txt from sig_cruise_offers o ";
		$where = " ";
        $and = " where ";
        if (!empty($_GET['dest'])){        	
			$query .= "join sig_cruise_offer_destinations od on od.offer_id = o.offer_id
					   join sig_destination_to_offer_destination tod on tod.offer_destid = od.offer_dest_id ";          
			$where .= $and . " tod.destinationID = " . $_GET['dest'];
			$and = " and ";
		}
		if (!empty($_GET['cruise_line'])){
			$where .= $and . " o.sup_id = " . $_GET['cruise_line'];
          	$and = " and ";
        }
        if (!empty($_GET['ship'])){
			$where .= $and . " o.product_id = " . $_GET['ship'];
         	$and = " and ";
        }
        if (!empty($_GET['price'])){
			$where .= $and . " o.from_price <= " . $_GET['price'];
         	$and = " and ";
        } 
		if (!empty($_GET['length'])){
			$where .= $and . " o.length >= " . $_GET['length'];
          	$and = " and ";
		}		             
              
        if (!empty($_GET['departure_port'])){
			$where .= $and . " o.departure_port_id = " . $_GET['departure_port'];
          	$and = " and ";
        }
        if (!empty($_GET['deal_type'])){          
			$query .= " join sig_deal_offers sdo on sdo.searchable_object_offer_id = o.offer_id ";
			$where .= $and . " sdo.deal_type_id in (" . $_GET['deal_type'] . ")";
			$and = " and ";
        }
         if ($_GET['from']!="" && $_GET['to']!=""){ 
	        	extract($_GET);	        	
	        	//$from.=' 00:00:00';
	        	//$to.=' 00:00:00';
				$where.=$and ." o.depart_day BETWEEN '$from' and '$to'";
				$and = " and ";
				//$query .= $where." order by txt";
	        }
		$query .= $where . $and ." theme <> '' and theme is not null ";
		//result showing start
		$concat="<option value=''>Theme</option>";
		$q=mysql_query($query);
		while($r=mysql_fetch_array($q)){
			if($r['val']!=''){
				if($r['val']==$_GET['theme']){
					$concat.="<option selected value='".$r['val']."'>".$r['txt']."</option>";	
				}
				else{
					$concat.="<option value='".$r['val']."'>".$r['txt']."</option>";
				}
			}
		}
		echo $concat;
		//result showing end          
	}
?>