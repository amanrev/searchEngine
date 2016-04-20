<?php 	

$basedir = "/var/customer/signature_db_import";
$config = json_decode(file_get_contents("{$basedir}/dbconfig.json")); 

$conn = mysql_connect($config->host, $config->user, $config->password) or die ('Error connecting to mysql');
mysql_select_db($config->database) or die ('Error selecting schema');
	/*mysql_connect("localhost",$_GET['db_user'],$_GET['db_password']);
	mysql_select_db($_GET['db_name']) or die ('Error selecting schema');*/	

	if($_GET['source']=='tours'){				getToursOperators();	}
	if($_GET['source']=='months'){				getMonths();	}
	if($_GET['source']=='years'){				getYears();	}
	if($_GET['source']=='lengths'){				getLengths();	}
	if($_GET['source']=='destinations'){		getDestinations();	}
	if($_GET['source']=='prices'){				getPrices();	}
	if($_GET['source']=='depart_froms'){		getDepartFrom();	}
	if($_GET['source']=='interests'){			getInterests();	}
	if($_GET['source']=='rates'){				getRates();	}
/*  if($_GET['source']=='froms'){         dateFrom(); }
*/  if($_GET['source']=='tos'){         dateTo(); }
	function getDestinations(){
      	$query = "select distinct d.offer_dest_id val, d.offer_dest_name txt from sig_tour_offers o 
      			join sig_tour_offer_destinations od on od.offer_id = o.offer_id
  				join sig_offer_destinations d on d.offer_dest_id = od.offer_dest_id ";
		    $where = " ";
        $and = " where ";      					
		if (!empty($_GET['tour'])){			
			$where .= $and . " o.sup_id = " . $_GET['tour'];
			$and = " and ";
		}
		if (!empty($_GET['depart_from'])){
           $where .= $and . " o.air_depart_city = '" . $_GET['depart_from'];
          $and = " and ";
        }

        if (!empty($_GET['price'])){
          $where .= $and . " o.priced_from <= " . $_GET['price'];
          $and = " and ";
        }
        if (!empty($_GET['length'])){
          $where .= $and . " o.length >= " . $_GET['length'];
          $and = " and ";
        }
		
        if (!empty($_GET['interest'])){          
		  $query .= "join sig_tour_hotels th on th.offer_id = o.offer_id and th.hotel_product_id = o.product_id
  									join sig_tour_hotel_interests hi on hi.product_id = th.hotel_product_id ";
          $where .= $and . " hi.interest_id = " . $_GET['interest'];
          $and = " and ";
        }
        if (!empty($_GET['rate'])){
          $where .= $and . " o.package_rating = " . $_GET['rate'];
          $and = " and ";
        } 
        if (!empty($_GET['deal_type'])){          
		  $query .= " join sig_deal_offers sdo on sdo.searchable_object_offer_id = o.offer_id ";
          $where .= $and . " sdo.deal_type_id in (" . $_GET['deal_type'];
          $and = " and ";
        }

         if ($_GET['from']!="" && $_GET['to']!=""){ 
            extract($_GET);           
            //$from.=' 00:00:00';
            //$to.=' 00:00:00';
        $where.=$and ." o.drop_day BETWEEN '$from' and '$to'";
        $and = " and ";
        //$query .= $where." order by txt";
          }

		 $query .= $where." order by txt";
		//result showing start
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
                      when o.priced_from <= 100 then 100
                      when o.priced_from <= 500 then 500
                      when o.priced_from <= 1000 then 1000  
                      when o.priced_from <= 2000 then 2000
                      when o.priced_from <= 3000 then 3000
                      when o.priced_from <= 5000 then 5000
                      when o.priced_from <= 10000 then 10000
                      when o.priced_from <= 50000 then 50000
                      when o.priced_from <= 100000 then 100000
                      end val,
                    case
                      when o.priced_from <= 100 then 100
                      when o.priced_from <= 500 then 500
                      when o.priced_from <= 1000 then 1000  
                      when o.priced_from <= 2000 then 2000
                      when o.priced_from <= 3000 then 3000
                      when o.priced_from <= 5000 then 5000
                      when o.priced_from <= 10000 then 10000
                      when o.priced_from <= 50000 then 50000
                      when o.priced_from <= 100000 then 100000
                      end txt 
      						from sig_tour_offers o ";
		$where = " ";
        $and = " where ";      					
		if (!empty($_GET['dest'])){
			$query .= "join sig_tour_offer_destinations od on od.offer_id = o.offer_id ";
			$where .= $and . " od.offer_dest_id = " . $_GET['dest'];
			$and = " and ";
		}
	
        if (!empty($_GET['depart_from'])){
          $where .= $and . " o.air_depart_city = '" . $_GET['depart_from'] . "'";
          $and = " and ";
        }
        if (!empty($_GET['tour'])){
          $where .= $and . " o.sup_id = '" . $_GET['tour'] . "'";
          $and = " and ";
        }        
        if (!empty($_GET['length'])){
          $where .= $and . " o.length >= '" . $_GET['length'] . "'";
          $and = " and ";
        }
        if (!empty($_GET['interest'])){          
		  $query .= "join sig_tour_hotels th on th.offer_id = o.offer_id and th.hotel_product_id = o.product_id
  					 join sig_tour_hotel_interests hi on hi.product_id = th.hotel_product_id ";
          $where .= $and . " hi.interest_id = " . $_GET['interest'];
          $and = " and ";
        }
        if (!empty($_GET['rate'])){
          $where .= $and . " o.package_rating = '" . $_GET['rate'] . "'";
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
        $where.=$and ." o.drop_day BETWEEN '$from' and '$to'";
        $and = " and ";
        //$query .= $where." order by txt";
          }
  
		 $query .= $where." order by txt";
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
    function getLengths(){
      	$query = "select distinct
                    case
                      when o.length <= 10 then 10
                      when o.length <= 20 then 20
                      when o.length <= 50 then 50
                      end val,
                    case
                      when o.length <= 10 then '10 days'
                      when o.length <= 20 then '20 days'
                      when o.length <= 50 then '50 days'
                      end txt 
      						from sig_tour_offers o ";
		$where = " ";
        $and = " where ";      					
		if (!empty($_GET['dest'])){
			$query .= "join sig_tour_offer_destinations od on od.offer_id = o.offer_id ";
			$where .= $and . " od.offer_dest_id = " . $_GET['dest'];
			$and = " and ";
		}
		if (!empty($_GET['tour'])){
          $where .= $and . " o.sup_id = '" . $_GET['tour'] . "'";
          $and = " and ";
        }
        if (!empty($_GET['depart_from'])){
          $where .= $and . " o.air_depart_city = '" . $_GET['depart_from'] . "'";
          $and = " and ";
        }
        if (!empty($_GET['price'])){
          $where .= $and . " o.priced_from< = '" . $_GET['price'] . "'";
          $and = " and ";
        }
		     
        if (!empty($_GET['interest'])){          
		  $query .= "join sig_tour_hotels th on th.offer_id = o.offer_id and th.hotel_product_id = o.product_id
  					 join sig_tour_hotel_interests hi on hi.product_id = th.hotel_product_id ";
          $where .= $and . " hi.interest_id = " . $_GET['interest'];
          $and = " and ";
        }
        if (!empty($_GET['rate'])){
          $where .= $and . " o.package_rating = '" . $_GET['rate'] . "'";
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
        $where.=$and ." o.drop_day BETWEEN '$from' and '$to'";
        $and = " and ";
        //$query .= $where." order by txt";
          }
		$query .= $where." order by txt";
		//result showing start
		$concat="<option value=''>Length</option>";
		$q=mysql_query($query);
		while($r=mysql_fetch_array($q)){
			if($r['val']!=''){
				if($r['val']==$_GET['length']){
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
	function getToursOperators(){
      	$query = "select distinct s.sup_id val, s.sup_name txt from sig_tour_offers o
      			join sig_tour_suppliers s on s.sup_id = o.sup_id ";
		$where = " ";
        $and = " where ";      					
		if (!empty($_GET['dest'])){
			$query .= "join sig_tour_offer_destinations od on od.offer_id = o.offer_id ";
			$where .= $and . " od.offer_dest_id = " . $_GET['dest'];
			$and = " and ";
		}
		
        if (!empty($_GET['depart_from'])){
          $where .= $and . " o.air_depart_city = '" . $_GET['depart_from'] . "'";
          $and = " and ";
        }
        if (!empty($_GET['price'])){
          $where .= $and . " o.priced_from <= '" . $_GET['price'] . "'";
          $and = " and ";
        }
        if (!empty($_GET['length'])){
          $where .= $and . " o.length >= '" . $_GET['length'] . "'";
          $and = " and ";
        }
        if (!empty($_GET['interest'])){
          $query .= "join sig_tour_hotels th on th.offer_id = o.offer_id and th.hotel_product_id = o.product_id
  									join sig_tour_hotel_interests hi on hi.product_id = th.hotel_product_id ";
          $where .= $and . " hi.interest_id = " . $_GET['interest'];
          $and = " and ";
        }
        if (!empty($_GET['rate'])){
          $where .= $and . " o.package_rating = '" . $_GET['rate'] . "'";
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
        $where.=$and ." o.drop_day BETWEEN '$from' and '$to'";
        $and = " and ";
        //$query .= $where." order by txt";
          }
		 $query .= $where." order by txt";
		//result showing start
		$concat="<option value=''>Tour Operator</option>";
		$q=mysql_query($query);
		while($r=mysql_fetch_array($q)){
			if($r['val']!=''){
				if($r['val']==$_GET['tour']){
					$concat.="<option selected value='".$r['val']."'>".str_replace('?', '®', $r['txt'])."</option>";	
				}
				else{
					$concat.="<option value='".$r['val']."'>".str_replace('?', '®', $r['txt'])."</option>";
				}
			}
		}
		echo $concat;
		//result showing end      
    }

    function dateFrom(){
        $query = "select distinct max(o.drop_day) val, min(o.drop_day) txt from sig_tour_offers o ";
		$where = " ";
        $and = " where ";      					
		if (!empty($_GET['dest'])){
			$query .= "join sig_tour_offer_destinations od on od.offer_id = o.offer_id ";
			$where .= $and . " od.offer_dest_id = " . $_GET['dest'];
			$and = " and ";
		}
		if (!empty($_GET['tour'])){
          $where .= $and . " o.sup_id = " . $_GET['tour'];
          $and = " and ";
        }
		if (!empty($_GET['depart_from'])){
          $where .= $and . " o.air_depart_city = '" . $_GET['depart_from'] . "'";
          $and = " and ";
        }
        if (!empty($_GET['price'])){
          $where .= $and . " o.priced_from <= " . $_GET['price'];
          $and = " and ";
        }     
        if (!empty($_GET['length'])){
          $where .= $and . " o.length >= " . $_GET['length'];
          $and = " and ";
        }
      
        if (!empty($_GET['interest'])){
			$query .= "join sig_tour_hotels th on th.offer_id = o.offer_id and th.hotel_product_id = o.product_id
					join sig_tour_hotel_interests hi on hi.product_id = th.hotel_product_id ";
          $where .= $and . " hi.interest_id = " . $_GET['interest'];
          $and = " and ";
		}		
		if (!empty($_GET['rate'])){
          $where .= $and . " o.package_rating = " . $_GET['rate'];
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
        $where.=$and ." o.drop_day BETWEEN '$from' and '$to'";
        $and = " and ";
        //$query .= $where." order by txt";
          }

		 $query .= $where." order by val";

		$q=mysql_query($query);
		$r=mysql_fetch_array($q);
  	 if($r['val']!=''){
          $d=str_replace("00:00:00", "", $r['val']);
          $e=str_replace("00:00:00", "", $r['txt']);
          $dd=trim($d);
          $ee=trim($e);
          $concat=$dd;  
      }
		
		echo $concat;
		//result showing end      
    }


    /*function getYears(){
      	$query = "select distinct year(o.drop_day) val, year(o.drop_day) txt from sig_tour_offers o ";
		$where = " ";
        $and = " where ";      					
		if (!empty($_GET['dest'])){
			$query .= "join sig_tour_offer_destinations od on od.offer_id = o.offer_id ";
			$where .= $and . " od.offer_dest_id = " . $_GET['dest'];
			$and = " and ";
		}
		if (!empty($_GET['tour'])){
          $where .= $and . " o.sup_id = " . $_GET['tour'];
          $and = " and ";
        }
		if (!empty($_GET['depart_from'])){
          $where .= $and . " o.air_depart_city = '" . $_GET['depart_from'] . "'";
          $and = " and ";
        }
        if (!empty($_GET['price'])){
          $where .= $and . " o.priced_from <= " . $_GET['price'];
          $and = " and ";
        }     
        if (!empty($_GET['length'])){
          $where .= $and . " o.length >= " . $_GET['length'];
          $and = " and ";
        }
        if (!empty($_GET['month'])){
          $where .= $and . " month(o.drop_day) = " . $_GET['month'];
          $and = " and ";
        }
        if (!empty($_GET['interest'])){
			$query .= "join sig_tour_hotels th on th.offer_id = o.offer_id and th.hotel_product_id = o.product_id
					join sig_tour_hotel_interests hi on hi.product_id = th.hotel_product_id ";
          $where .= $and . " hi.interest_id = " . $_GET['interest'];
          $and = " and ";
		}		
		if (!empty($_GET['rate'])){
          $where .= $and . " o.package_rating = " . $_GET['rate'];
          $and = " and ";
        }
        if (!empty($_GET['deal_type'])){
          $query .= " join sig_deal_offers sdo on sdo.searchable_object_offer_id = o.offer_id ";
          $where .= $and . " sdo.deal_type_id in (" . $_GET['deal_type'] . ")";
          $and = " and ";
        }
		$query .= $where." order by val";
		//result showing start
		$concat="<option value=''>Year</option>";
		$q=mysql_query($query);
		while($r=mysql_fetch_array($q)){
			if($r['val']==$_GET['year']){
				$concat.="<option selected value='".$r['val']."'>".$r['txt']."</option>";	
			}
			else{
				$concat.="<option value='".$r['val']."'>".$r['txt']."</option>";
			}
		}
		echo $concat;
		//result showing end      
    }*/



  function dateTo(){
        $query = "select distinct max(o.drop_day) val, min(o.drop_day) txt from sig_tour_offers o ";
    $where = " ";
        $and = " where ";               
    if (!empty($_GET['dest'])){
      $query .= "join sig_tour_offer_destinations od on od.offer_id = o.offer_id ";
      $where .= $and . " od.offer_dest_id = " . $_GET['dest'];
      $and = " and ";
    }
    if (!empty($_GET['tour'])){
          $where .= $and . " o.sup_id = " . $_GET['tour'];
          $and = " and ";
        }
    if (!empty($_GET['depart_from'])){
          $where .= $and . " o.air_depart_city = '" . $_GET['depart_from'] . "'";
          $and = " and ";
        }
        if (!empty($_GET['price'])){
          $where .= $and . " o.priced_from <= " . $_GET['price'];
          $and = " and ";
        }     
        if (!empty($_GET['length'])){
          $where .= $and . " o.length >= " . $_GET['length'];
          $and = " and ";
        }
      
        if (!empty($_GET['interest'])){
      $query .= "join sig_tour_hotels th on th.offer_id = o.offer_id and th.hotel_product_id = o.product_id
          join sig_tour_hotel_interests hi on hi.product_id = th.hotel_product_id ";
          $where .= $and . " hi.interest_id = " . $_GET['interest'];
          $and = " and ";
    }   
    if (!empty($_GET['rate'])){
          $where .= $and . " o.package_rating = " . $_GET['rate'];
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
        $where.=$and ." o.drop_day BETWEEN '$from' and '$to'";
        $and = " and ";
        //$query .= $where." order by txt";
          }

    $query .= $where." order by val";
    $q=mysql_query($query);
    $r=mysql_fetch_array($q);

     if($r['val']!=''){
          $d=str_replace("00:00:00", "", $r['val']);
          $e=str_replace("00:00:00", "", $r['txt']);
          $dd=trim($d);
          $ee=trim($e);
          $concat=$dd;  
      }
    
    echo $concat;
    //result showing end      
    }


    function getDepartFrom(){
      	$query = "select distinct ac.airport_code val, ac.city_name txt from sig_tour_offers o 
      			join sig_air_cities ac on ac.airport_code = o.air_depart_city ";
		$where = " ";
        $and = " where ";      					
		if (!empty($_GET['dest'])){
			$query .= "join sig_tour_offer_destinations od on od.offer_id = o.offer_id ";
			$where .= $and . " od.offer_dest_id = " . $_GET['dest'];
			$and = " and ";
		}
		if (!empty($_GET['tour'])){
          $where .= $and . " o.sup_id = " . $_GET['tour'];
          $and = " and ";
        }		
        if (!empty($_GET['price'])){
          $where .= $and . " o.priced_from <= " . $_GET['price'];
          $and = " and ";
        }     
        if (!empty($_GET['length'])){
          $where .= $and . " o.length >= " . $_GET['length'];
          $and = " and ";
        }
      
        if (!empty($_GET['interest'])){
			$query .= "join sig_tour_hotels th on th.offer_id = o.offer_id and th.hotel_product_id = o.product_id
					join sig_tour_hotel_interests hi on hi.product_id = th.hotel_product_id ";
          $where .= $and . " hi.interest_id = " . $_GET['interest'];
          $and = " and ";
		}		
		if (!empty($_GET['rate'])){
          $where .= $and . " o.package_rating = " . $_GET['rate'];
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
        $where.=$and ." o.drop_day BETWEEN '$from' and '$to'";
        $and = " and ";
        //$query .= $where." order by txt";
          }
		$query .= $where." order by val";
		//result showing start
		$concat="<option value=''>Departing From</option>";
		$q=mysql_query($query);
		while($r=mysql_fetch_array($q)){
			if($r['val']==$_GET['depart_from']){
				$concat.="<option selected value='".$r['val']."'>".$r['txt']."</option>";	
			}
			else{
				$concat.="<option value='".$r['val']."'>".$r['txt']."</option>";
			}
		}
		echo $concat;
		//result showing end      
    }
    function getInterests(){
      	$query = "select distinct i.interest_id val, i.interest_name txt from sig_tour_offers o 
				join sig_tour_hotels th on th.offer_id = o.offer_id and th.hotel_product_id = o.product_id
				join sig_tour_hotel_interests hi on hi.product_id = th.hotel_product_id
				join sig_tour_interests i on i.interest_id = hi.interest_id ";
		$where = " ";
        $and = " where ";      					
		if (!empty($_GET['dest'])){
			$query .= "join sig_tour_offer_destinations od on od.offer_id = o.offer_id ";
			$where .= $and . " od.offer_dest_id = " . $_GET['dest'];
			$and = " and ";
		}
		if (!empty($_GET['tour'])){
          $where .= $and . " o.sup_id = " . $_GET['tour'];
          $and = " and ";
        }		        
        if (!empty($_GET['depart_from'])){
          $where .= $and . " o.air_depart_city = " . $_GET['depart_from'];
          $and = " and ";
        }
        if (!empty($_GET['price'])){
          $where .= $and . " o.priced_from <= " . $_GET['price'];
          $and = " and ";
        }
        if (!empty($_GET['length'])){
          $where .= $and . " o.length >= " . $_GET['length'];
          $and = " and ";
        }
       
		if (!empty($_GET['rate'])){
          $where .= $and . " o.package_rating = " . $_GET['rate'];
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
        $where.=$and ." o.drop_day BETWEEN '$from' and '$to'";
        $and = " and ";
        //$query .= $where." order by txt";
          }
		$query .= $where." order by val";
		//result showing start
		$concat="<option value=''>Interest</option>";
		$q=mysql_query($query);
		while($r=mysql_fetch_array($q)){
			if($r['val']==$_GET['interest']){
				$concat.="<option selected value='".$r['val']."'>".$r['txt']."</option>";	
			}
			else{
				$concat.="<option value='".$r['val']."'>".$r['txt']."</option>";
			}
		}
		echo $concat;
		//result showing end      
    }
    function getRates(){
      	$query = "select distinct pr.rate_id val, pr.categories txt from sig_tour_offers o 
      			join sig_package_ratings pr on pr.rate_id = o.package_rating ";
		$where = " ";
        $and = " where ";      					
		if (!empty($_GET['dest'])){
			$query .= "join sig_tour_offer_destinations od on od.offer_id = o.offer_id ";
			$where .= $and . " od.offer_dest_id = " . $_GET['dest'];
			$and = " and ";
		}
		if (!empty($_GET['tour'])){
          $where .= $and . " o.sup_id = " . $_GET['tour'];
          $and = " and ";
        }		        
        if (!empty($_GET['depart_from'])){
          $where .= $and . " o.air_depart_city = " . $_GET['depart_from'];
          $and = " and ";
        }
        if (!empty($_GET['price'])){
          $where .= $and . " o.priced_from <= " . $_GET['price'];
          $and = " and ";
        }
        if (!empty($_GET['length'])){
          $where .= $and . " o.length >= " . $_GET['length'];
          $and = " and ";
        }
      
        if (!empty($_GET['interest'])){
          $query .= "join sig_tour_hotels th on th.offer_id = o.offer_id and th.hotel_product_id = o.product_id
					join sig_tour_hotel_interests hi on hi.product_id = th.hotel_product_id ";
          $where .= $and . " hi.interest_id = " . $_GET['interest'];
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
        $where.=$and ." o.drop_day BETWEEN '$from' and '$to'";
        $and = " and ";
        //$query .= $where." order by txt";
          }
		$query .= $where." order by val";
		//result showing start
		$concat="<option value=''>Rating</option>";
		$q=mysql_query($query);
		while($r=mysql_fetch_array($q)){
			if($r['val']==$_GET['rate']){
				$concat.="<option selected value='".$r['val']."'>".$r['txt']."</option>";	
			}
			else{
				$concat.="<option value='".$r['val']."'>".$r['txt']."</option>";
			}
		}
		echo $concat;
		//result showing end      
    }
?>