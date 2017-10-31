<?php
/**
 * Farm Active Record
 * @author  <your-name-here>
 */
class Farm extends TRecord
{
    const TABLENAME = 'farm';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    
    private $farm_blocks;

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('id');
        parent::addAttribute('description');
        parent::addAttribute('area');
        parent::addAttribute('address_id');
    }

    
    /**
     * Method addFarmBlock
     * Add a FarmBlock to the Farm
     * @param $object Instance of FarmBlock
     */
    public function addFarmBlock(FarmBlock $object)
    {
        $this->farm_blocks[] = $object;
    }
    
    /**
     * Method getFarmBlocks
     * Return the Farm' FarmBlock's
     * @return Collection of FarmBlock
     */
    public function getFarmBlocks()
    {
        return $this->farm_blocks;
    }

    
    /**
     * Method getFarmName
     */
    public function getFarmName(  )
    {
        
    }
    

    /**
     * Reset aggregates
     */
    public function clearParts()
    {
        $this->farm_blocks = array();
    }

    /**
     * Load the object and its aggregates
     * @param $id object ID
     */
    public function load($id)
    {
        $this->farm_blocks = parent::loadComposite('FarmBlock', 'farm_id', $id);
    
        // load the object itself
        return parent::load($id);
    }

    /**
     * Store the object and its aggregates
     */
    public function store()
    {
        // store the object itself
        parent::store();
    
        parent::saveComposite('FarmBlock', 'farm_id', $this->id, $this->farm_blocks);
    }

    /**
     * Delete the object and its aggregates
     * @param $id object ID
     */
    public function delete($id = NULL)
    {
        $id = isset($id) ? $id : $this->id;
        parent::deleteComposite('FarmBlock', 'farm_id', $id);
    
        // delete the object itself
        parent::delete($id);
    }


}
