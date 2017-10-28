<?php
/**
 * State Active Record
 * @author  <your-name-here>
 */
class State extends TRecord
{
    const TABLENAME = 'state';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    
    private $country;

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('id');
        parent::addAttribute('description');
        parent::addAttribute('country_id');
    }

    
    /**
     * Method set_country
     * Sample of usage: $state->country = $object;
     * @param $object Instance of Country
     */
    public function set_country(Country $object)
    {
        $this->country = $object;
        $this->country_id = $object->id;
    }
    
    /**
     * Method get_country
     * Sample of usage: $state->country->attribute;
     * @returns Country instance
     */
    public function get_country()
    {
        // loads the associated object
        if (empty($this->country))
            $this->country = new Country($this->country_id);
    
        // returns the associated object
        return $this->country;
    }
    

    
    /**
     * Method getCitys
     */
    public function getCitys()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('state_id', '=', $this->id));
        return City::getObjects( $criteria );
    }
    


}
