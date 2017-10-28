<?php
/**
 * City Active Record
 * @author  <your-name-here>
 */
class City extends TRecord
{
    const TABLENAME = 'city';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    
    private $state;

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('id');
        parent::addAttribute('description');
        parent::addAttribute('state_id');
    }

    
    /**
     * Method set_state
     * Sample of usage: $city->state = $object;
     * @param $object Instance of State
     */
    public function set_state(State $object)
    {
        $this->state = $object;
        $this->state_id = $object->id;
    }
    
    /**
     * Method get_state
     * Sample of usage: $city->state->attribute;
     * @returns State instance
     */
    public function get_state()
    {
        // loads the associated object
        if (empty($this->state))
            $this->state = new State($this->state_id);
    
        // returns the associated object
        return $this->state;
    }
    

    
    /**
     * Method getFarms
     */
    public function getFarms()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('city_id', '=', $this->id));
        return Farm::getObjects( $criteria );
    }
    


}
