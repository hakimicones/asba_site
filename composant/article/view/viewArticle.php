<?php 

class viewArticle {
    public $rows ;
	public $lg;
	public $id;
	public function __construct($rows, $obj)
		{
			 $this->rows	= $rows;
			 $this->lg		= $obj->lg; 
			 $this->id		= $obj->id; 
			 
		}
    public function display() {
	
	   $li =  '<section id="agences"   style="margin-top: 20px;">'.$this->rows['intro_text'].'</section>';
		 
		return $li;
	
	}
	 

 
}
?>
