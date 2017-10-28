<?php
/**
 * FarmPlot Active Record
 * @author  <your-name-here>
 */
class FarmPlot extends TRecord
{
    const TABLENAME = 'farm_plot';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    
    private $farm_block;

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('id');
        parent::addAttribute('description');
        parent::addAttribute('area');
        parent::addAttribute('farm_block_id');
    }

    
    /**
     * Method set_farm_block
     * Sample of usage: $farm_plot->farm_block = $object;
     * @param $object Instance of FarmBlock
     */
    public function set_farm_block(FarmBlock $object)
    {
        $this->farm_block = $object;
        $this->farm_block_id = $object->id;
    }
    
    /**
     * Method get_farm_block
     * Sample of usage: $farm_plot->farm_block->attribute;
     * @returns FarmBlock instance
     */
    public function get_farm_block()
    {
        // loads the associated object
        if (empty($this->farm_block))
            $this->farm_block = new FarmBlock($this->farm_block_id);
    
        // returns the associated object
        return $this->farm_block;
    }
    

    
    /**
     * Method getPlotShape
     */
    public function getPlotShape(  )
    {
        
    }
    


}
