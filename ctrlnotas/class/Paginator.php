<?php
	class Paginator
	{
		//Atributos publicos
		public $_num_page;
		public $_per_page;
		public $_padding;
		public $_row_count;
		public $_current_page;
		public $_gets;
		public $_output;
		//Atributos Privados
		private $_page;
		private $_num_of_pages;
		
		//Constructor
		public function __construct($a, $b, $c, $d, $e, $f=NULL)
		{
			$this->_num_page = $a;
			$this->_per_page = $b;
			$this->_padding = $c;
			$this->_row_count = $d;
			$this->_current_page = $e;
			$this->_gets = $f;
			$this->_output="";
			$this->_page = $_SERVER['PHP_SELF'].'?';
			//Damos valor a la pagina
			$this->_page .= (!empty($this->_gets))?$this->_gets."&":"";
			//Total de las paginas
			$this->_num_of_pages = ceil($this->_row_count->Total / $this->_per_page);
		}
		
		
		//Limite menor
		private function lowerLimit()
		{
			if(($this->_num_page - $this->_padding)>1):
				
				$this->_output .= "<strong>...</strong>";
				
				$_lower_limit  = $this->_num_page - $this->_padding;
				for($i=$_lower_limit; $i< $this->_num_page; $i++):
					$this->_output .= " <a href='{$this->_page}page={$i}'>{$i}</a> ";
				endfor;
			else:
				for($i=2;$i<$this->_num_page; $i++):
					$this->_output .= " <a href='{$this->_page}page={$i}'>{$i}</a> ";
				endfor;
			endif;
		}
		
		//Limite Mayor
		private function upperLimit()
		{
			if(($this->_num_page + $this->_padding) < $this->_num_of_pages):
			
				$_upperLimit = $this->_num_page + $this->_padding;
				for($i = ($this->_num_page + 1); $i < $_upperLimit; $i ++):
					$this->_output .= " <a href='{$this->_page}page={$i}'>{$i}</a> ";
				endfor;
				$this->_output .= "<strong>...</strong>";
			else:
				for($i = ($this->_num_page + 1); $i < $this->_num_of_pages; $i++):
					$this->_output .= " <a href='{$this->_page}page={$i}'>{$i}</a> ";
				endfor;
			endif;
		}
		
		//pagina actual
		private function currentPage()
		{
			if(($this->_num_page != 0) && ($this->_num_page != 1) && ($this->_num_page != $this->_num_of_pages)):
				$this->_output .= "<a href='{$this->_page}page={$this->_num_page}' class='current'><strong>{$this->_num_page}</strong></a>";
			endif;
		}
		
		//Salida
		public function showPaginator()
		{
			$this->_output .= "\n\n <div class='paginator'>";
			//$this->_output .= "\n\n <span style='display:block;'>Pagina <b>{$this->_current_page}</b> de <b>{$this->_num_of_pages}</b></span><br/>";
			$this->_output .= "<a href='#'>Pagina <b><i>{$this->_current_page}</i></b> de <b><i>{$this->_num_of_pages}</i></b></a> ";
			$this->_output .= "<a href='{$this->_page}page=1'>&laquo; Primera</a> ";
			$this->lowerLimit();
			$this->currentPage();
			$this->upperLimit();
			$this->_output .= " <a href='{$this->_page}page={$this->_num_of_pages}'>Ultima &raquo;</a>";
			$this->_output .= "</div>\n\n";
			return $this->_output;
		}	
	}
?>
