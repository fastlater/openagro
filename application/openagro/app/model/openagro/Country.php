<?php
/**
 * Country Active Record
 * @author  <your-name-here>
 */
class Country extends TRecord
{
    const TABLENAME = 'country';
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
     * Method getStates
     */
    public function getStates()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('country_id', '=', $this->id));
        return State::getObjects( $criteria );
    }
    


}
