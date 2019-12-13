<?php
	if(!session_id()){ 
   	session_start(); 
	}
	
	class Panier {
		private $objets = array();
		
		public function __construct() {
			$this->objets = !empty($_SESSION['objets'])?$_SESSION['objets']:NULL;
			if($this->objets === NULL) {
				$this->objets = array('valeur'=> 0, 'total' =>0);
			}
		}
		
		public function contenu() {
			$panier = array_reverse($this->objets);
			unset($panier['valeur']);
			unset($panier['total']);
			return $panier;
		}
		public function get_article($id) {
			if(in_array($id, array('valeur', 'total'))) {
				return $this->objet[$id];
			}
		}
		
		public function total_objets(){
			return $this->objets['total'];
		}
		public function prix_total() {
			return $this->objets['valeur'];
		}
		public function ajouter($article = array()) {
			if(!is_array($article) || count($article) === NULL) {
				return false;
			} elseif(!isset($article['id'],$article['nom'], $article['prix'], $article['quantite'])) {
				return false;
			} else {
				$article['quantite'] = (int) $article['quantite'];
				if($article['quantite'] == 0){
					return false;
				}
				$article['prix'] = (float) $article['prix'];
				$id = md5($article['id']);
	         $ancienne_qty = isset($this->objets[$id]['quantite']) ? (int) $this->objets[$id]['quantite'] : 0; 
	         $article['id'] = $id; 
	         $article['quantite'] += $ancienne_qty; 
	         $this->objets[$id] = $article;  
	         if($this->sauv_panier()){ 
	              return isset($id) ? $id : TRUE; 
	          }else{ 
	              return FALSE; 
				}
			}
		}
		
	  public function update($article = array()){ 
     if (!is_array($article) || count($article) === 0){ 
         return FALSE; 
     }else{ 
         if (!isset($article['id'], $this->objets[$article['id']])){ 
             return FALSE; 
         }else{  
             if(isset($article['quantite'])){ 
                 $article['quantite'] = (float) $article['quantite']; 
                 if ($article['quantite'] == 0){ 
                     unset($this->objets[$article['id']]); 
                     return TRUE; 
                 } 
             } 
             $keys = array_intersect(array_keys($this->objets[$article['id']]), array_keys($article)); 
             if(isset($article['prix'])){ 
                 $article['prix'] = (float) $article['price']; 
             } 
             foreach(array_diff($keys, array('id', 'nom')) as $key){ 
                 $this->objets[$article['id']][$key] = $article[$key]; 
             } 
             $this->sauv_panier(); 
             return TRUE; 
         } 
     } 
 } 
 
 
 	     
    protected function sauv_panier(){ 
        $this->objets['total'] = $this->objets['total'] = 0; 
        foreach ($this->objets as $key => $val){ 
            if(!is_array($val) || !isset($val['prix'], $val['quantite'])){ 
                continue; 
            } 
      
            $this->objets['valeur'] += ($val['prix'] * $val['quantity']); 
            $this->objets['total'] += $val['quantite']; 
            $this->objets[$key]['subtotal'] = ($this->objets[$key]['prix'] * $this->objets[$key]['quantite']); 
        } 
         
        if(count($this->objets) <= 2){ 
            unset($_SESSION['objets']); 
            return FALSE; 
        }else{ 
            $_SESSION['objets'] = $this->objets; 
            return TRUE; 
        } 
    } 
     
     public function remove($id){ 
        unset($this->objets[$id]); 
        $this->sauv_paniert(); 
        return TRUE; 
     } 
    public function destroy(){ 
        $this->objets = array('valeur' => 0, 'total' => 0); 
        unset($_SESSION['objets']); 
    } 
}
?>