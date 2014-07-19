<?php 

class Products_model extends CI_Model {
	
	function getFeatProd()
	{
		$query = $this->db->query("SELECT p.idProduct as p_id,p.name as p_name,p.image,pf.feature_descr as f_descr,idFeatures_feat as fid FROM product p,product_features pf WHERE idProduct_feat=idProduct and p.featured='y' GROUP BY p_id,fid HAVING fid=8 OR fid=10");
		
		return $query;
	}

	function getByCat($catid,$from,$offset,$filters)
	{
		if($from == '')
			$from='';
		else
			$from=$from.',';
			
		$filter_query=$this->getFilterSubquery($filters);	
		$price_id=$this->getPriceOptId($catid);
		
		//return a short description of the product with its price 
		$query = $this->db->query("SELECT p.idProduct as p_id,p.name as p_name,c.name as c_name,p.descr as p_descr,p.image,pf.feature_descr as f_descr,idFeatures_feat as fid FROM product p,category c,product_features pf WHERE Category_idCategory=$catid and Category_idCategory=idCategory and idProduct_feat=idProduct $filter_query GROUP BY p_id,fid HAVING fid=$price_id LIMIT $from $offset");
		
		return $query;
	}
	
	function getCatCount($catid,$filters)
	{
		$price_id=$this->getPriceOptId($catid);
		
		$filter_query=$this->getFilterSubquery($filters);	
		
		$price_id=$this->getPriceOptId($catid);
		
		$query = $this->db->query("SELECT count(*) as count,idProduct_feat FROM product p,category c,product_features pf WHERE Category_idCategory=$catid and Category_idCategory=idCategory and idProduct_feat=idProduct $filter_query GROUP BY idFeatures_feat HAVING idFeatures_feat=$price_id");
		
		if ($query->num_rows() > 0){
			$row=$query->row();
			return $row->count;
		}
		else
			return 0;
	}
	
	function getProductDetails($pid)
	{
		$query = $this->db->query("SELECT p.idProduct as p_id,p.name as p_name,c.name as c_name,p.descr as p_descr,p.image,f.name as f_name,pf.feature_descr as f_descr FROM product p,category c,product_features pf,features f WHERE idProduct=$pid and idProduct_feat=idProduct and idFeatures_feat=idFeatures and Category_idCategory=idCategory");
		
		return $query;
	}
	
	function getProductReviews($pid)
	{
		$query = $this->db->query("SELECT * FROM review r,user u WHERE Product_idProduct=$pid and User_idUser=idUser ORDER BY idReview DESC");
		
		return $query;
	}
	
	function getFeatures($cat)
	{
		$query_feat = $this->db->query("select f.name,f.idFeatures,f.filterable,idFeatures from product p, product_features pf, features f,featureoptions fo where Category_idCategory=$cat and idProduct=idProduct_feat and idFeatures_feat=idFeatures and filterable='y' group by idFeatures");
			
		$features=array();
		$options=array();
		foreach ($query_feat->result() as $row)
		{ 
			$idFeat=$row->idFeatures;
			$query_opt = $this->db->query("select fo.value from featureoptions fo where $idFeat=idFeaturesOpt_feat");	
			$options=array();
			foreach ($query_opt->result() as $row2)
			{
					$options[]=$row2->value;
			}
			$features[]=array('feat_name' => $row->name,
							  'feat_id' => $row->idFeatures,
							  'feat_opt' => $options
							  );
		}	
		return $features;
	}
	
	//mas epistrefei to id tou price feature epeidh ka8e kathgoria proionton exei ta dika ths price options(thn 
	//dikia ths emveleia apo prices)
	function getPriceOptId($catid)
	{
		$price_option = $this->db->query("select f.name,idFeatures from product p, product_features pf, features f,featureoptions fo where Category_idCategory=$catid and idProduct=idProduct_feat and idFeatures_feat=idFeatures and f.name='Price' group by idFeatures");
		
		$row=$price_option->row();
		return $row->idFeatures;
	}
	
	function getProductCat($pid)
	{
		$cat = $this->db->query("select p.Category_idCategory as catid from product p where idProduct=$pid");
		
		$row=$cat->row();
		return $row->catid;
	}
	
	function getCatName($catid)
	{
		$cat = $this->db->query("select name from category where idCategory=$catid");
		
		$row=$cat->row();
		return $row->name;
	}
	
	function getFilterSubquery($filters)
	{
		/*$filter_query='';
		if($filters!=FALSE)
		{
			$filter_query="and idProduct_feat in (SELECT idProduct_feat FROM product_features r WHERE ";
			foreach($filters as $f)
			{
				$pieces = explode(",", $f);
				$filter_query.="idFeatures_feat={$pieces[0]} and r.value='{$pieces[1]}' OR ";
			}
			$filter_query.="0=1)";
		}
			
		return $filter_query; */
		
		/*$filter_query='';
		
		
		if($filters!=FALSE)
		{
			$filter_query="";

			foreach($filters as $f)
			{
				
				$pieces = explode(",", $f);
						
			
				
				$filter_query.="and idProduct_feat in (SELECT idProduct_feat FROM product_features r WHERE  idFeatures_feat={$pieces[0]} and r.value='{$pieces[1]}'";
																																		
			}
			
			foreach($filters as $f)
			{
				$filter_query.=")";
			}
			
		}
			//echo "SQL: $filter_query";
		return $filter_query;
		*/
		
				$filter_query='';
		
		
		if($filters!=FALSE)
		{
			array_multisort($filters);
			//print_r($filters);
			$filter_query="";
			$i=0;
			$flag=0;
			$paren=0;
			foreach($filters as $f)
			{
				
				$pieces = explode(",", $f);
						
				if($i==0)
				{
					$buffer=$pieces[0];
					$paren++;
					$filter_query.="and idProduct_feat in (SELECT idProduct_feat FROM product_features r WHERE (idFeatures_feat={$pieces[0]} and r.value='{$pieces[1]}'";
				}
				else
				{
					if($buffer==$pieces[0])
					{
						$filter_query.=" OR idFeatures_feat={$pieces[0]} and r.value='{$pieces[1]}'";
						$flag=1;
					}
					else
					{
						$filter_query.=") and idProduct_feat in (SELECT idProduct_feat FROM product_features r WHERE (idFeatures_feat={$pieces[0]} and r.value='{$pieces[1]}'";
						$buffer=$pieces[0];
						$flag=0;
						$paren++;
					}
				}
				
				
				
				//$filter_query.="and idProduct_feat in (SELECT idProduct_feat FROM product_features r WHERE  idFeatures_feat={$pieces[0]} and r.value='{$pieces[1]}'";
																																							   				$i++;
																																		
			}
			
			/*$j=0;
			foreach($filters as $f)
			{
				$pieces = explode(",", $f);
				if($j==0)
				{
					$buffer2=$f;
					$filter_query.=")";
				}
				else
				{
					if($pieces[0]!=$buffer2)
						$filter_query.=")";
				}			
			}*/
			
			for($j=0;$j<$paren;$j++)
				$filter_query.=")";
			
			//if($flag==1)
				$filter_query.=")";
	
			
		}
			//echo "SQL: $filter_query";
		return $filter_query;
	}
}

?>