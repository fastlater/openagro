<?php
/**
 * Address Active Record
 * @author  <your-name-here>
 */
class Address extends TRecord
{
    const TABLENAME = 'address';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    
    private $city;
    private $farms;

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('id');
        parent::addAttribute('street');
        parent::addAttribute('number');
        parent::addAttribute('complement');
        parent::addAttribute('district');
        parent::addAttribute('zipcode');
        parent::addAttribute('city_id');
    }

    
    /**
     * Method set_city
     * Sample of usage: $address->city = $object;
     * @param $object Instance of City
     */
    public function set_city(City $object)
    {
        $this->city = $object;
        $this->city_id = $object->id;
    }
    
    /**
     * Method get_city
     * Sample of usage: $address->city->attribute;
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
     * Method addFarm
     * Add a Farm to the Address
     * @param $object Instance of Farm
     */
    public function addFarm(Farm $object)
    {
        $this->farms[] = $object;
    }
    
    /**
     * Method getFarms
     * Return the Address' Farm's
     * @return Collection of Farm
     */
    public function getFarms()
    {
        return $this->farms;
    }

    /**
     * Reset aggregates
     */
    public function clearParts()
    {
        $this->farms = array();
    }

    /**
     * Load the object and its aggregates
     * @param $id object ID
     */
    public function load($id)
    {
        $this->farms = parent::loadComposite('Farm', 'address_id', $id);
    
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
    
        parent::saveComposite('Farm', 'address_id', $this->id, $this->farms);
    }

    /**
     * Delete the object and its aggregates
     * @param $id object ID
     */
    public function delete($id = NULL)
    {
        $id = isset($id) ? $id : $this->id;
        parent::deleteComposite('Farm', 'address_id', $id);
    
        // delete the object itself
        parent::delete($id);
    }


}
