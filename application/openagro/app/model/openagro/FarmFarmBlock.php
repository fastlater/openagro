<?php
/**
 * FarmFarmBlock Active Record
 * @author  <your-name-here>
 */
class FarmFarmBlock extends TRecord
{
    const TABLENAME = 'farm_farm_block';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('farm_id');
        parent::addAttribute('farm_block_id');
    }


}
