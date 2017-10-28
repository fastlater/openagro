<?php
/**
 * FarmBlock Active Record
 * @author  <your-name-here>
 */
class FarmBlock extends TRecord
{
    const TABLENAME = 'farm_block';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('id');
        parent::addAttribute('description');
    }

    
    /**
     * Method getFarmPlots
     */
    public function getFarmPlots()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('farmblock_id', '=', $this->id));
        return FarmPlot::getObjects( $criteria );
    }
    


}
