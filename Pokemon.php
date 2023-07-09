<?php
class Pokemon
{
	public $Trade_ID;
	public $Pokemon_Name;
	public $Trainer_Region;
	public $Pokemon_Region;
	public $Level;
	public $Level_Met;
	public $Gender;
	public $Type1;
	public $Type2;
	public $Nature;
	public $Pokeball;
	public $Held_Item;
	public $Perfect_IVs;

	public function __construct($id, $pkmnname, $tr_region, $pkm_region, $level, $lv_met, $gen, $type_1, $type_2, $nat, $ball, $held_i, $perf_iv)
    {
		$this->Trade_ID = $id;
        $this->Pokemon_Name = $pkmnname;
		$this->Trainer_Region = $tr_region;
		$this->Pokemon_Region = $pkm_region;
		$this->Level = $level; 
		$this->Level_Met = $lv_met;
		$this->Gender = $gen;
		$this->Type1 = $type_1; 
		$this->Type2 = $type_2;
		$this->Nature = $nat;
		$this->Pokeball = $ball;
		$this->Held_Item = $held_i;
		$this->Perfect_IVs = $perf_iv;
    }
	
	public function getTrade_ID()
    {
        return $this->Trade_ID;
    }
	
	public function getPokemon_Name()
    {
        return $this->Pokemon_Name;
    }
	
	public function getTrainer_Region()
    {
        return $this->Trainer_Region;
    }
	
	public function getPokemon_Region()
    {
        return $this->Pokemon_Region;
    }
	
	public function getLevel()
    {
        return $this->Level;
    }
	
	public function getLevel_Met()
    {
        return $this->Level_Met;
    }
	
	public function getGender()
    {
        return $this->Gender;
    }
	
	public function getType1()
    {
        return $this->Type1;
    }
	
	public function getType2()
    {
        return $this->Type2;
    }
	
	public function getNature()
    {
        return $this->Nature;
    }
	
	public function getPokeball()
    {
        return $this->Pokeball;
    }
	
	public function getHeld_Item()
    {
        return $this->Held_Item;
    }
	
	public function getPerfect_IVs()
    {
        return $this->Perfect_IVs;
    }
}
?>
