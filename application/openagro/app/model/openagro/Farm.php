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
    
    
    private $city;
    private $farm_blocks;

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('id');
        parent::addAttribute('description');
        parent::addAttribute('city_id');
    }

    
    /**
     * Method set_city
     * Sample of usage: $farm->city = $object;
     * @param $object Instance of City
     */
    public function set_city(City $object)
    {
        $this->city = $object;
        $this->city_id = $object->id;
    }
    
    /**
     * Method get_city
     * Sample of usage: $farm->city->attribute;
     * @returns City instance
     */
    public function get_city()
    {
        // loads the associated object
        if (empty($this->city))
            $this->city = new City($this->city_id);
    
        // returns the associated object
        return $this->city;
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
        $this->farm_blocks = parent::loadAggregate('FarmBlock', 'FarmFarmBlock', 'farm_id', 'farm_block_id', $id);
    
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
    
        parent::saveAggregate('FarmFarmBlock', 'farm_id', 'farm_block_id', $this->id, $this->farm_blocks);
    }

    /**
     * Delete the object and its aggregates
     * @param $id object ID
     */
    public function delete($id = NULL)
    {
        $id = isset($id) ? $id : $this->id;
        parent::deleteComposite('FarmFarmBlock', 'farm_id', $id);
    
        // delete the object itself
        parent::delete($id);
    }


}
