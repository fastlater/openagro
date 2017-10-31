<?php
/**
 * CountryList Listing
 * @author  <your name here>
 */
class CountryList extends TStandardList
{
    protected $form;     // registration form
    protected $datagrid; // listing
    protected $pageNavigation;
    protected $formgrid;
    protected $deleteButton;
    protected $transformCallback;
    
    /**
     * Page constructor
     */
    public function __construct()
    {
        parent::__construct();
        
        parent::setDatabase('openagro');            // defines the database
        parent::setActiveRecord('Country');   // defines the active record
        parent::setDefaultOrder('id', 'asc');         // defines the default order
        // parent::setCriteria($criteria) // define a standard filter

        parent::addFilterField('id', '=', 'id'); // filterField, operator, formField
        parent::addFilterField('description', 'like', 'description'); // filterField, operator, formField
        
        // creates the form
        $this->form = new TQuickForm('form_search_Country');
        $this->form->class = 'tform'; // change CSS class
        $this->form = new BootstrapFormWrapper($this->form);
        $this->form->style = 'display: table;width:100%'; // change style
        $this->form->setFormTitle('Country');
        

        // create the form fields
        $id = new TEntry('id');
        $description = new TEntry('description');


        // add the fields
        $this->form->addQuickField('ID', $id,  '100%' );
        $this->form->addQuickField('Country', $description,  '100%' );

        
        // keep the form filled during navigation with session data
        $this->form->setData( TSession::getValue('Country_filter_data') );
        
        // add the search form actions
        $btn = $this->form->addQuickAction(_t('Find'), new TAction(array($this, 'onSearch')), 'fa:search');
        $btn->class = 'btn btn-sm btn-primary';
        $this->form->addQuickAction(_t('New'),  new TAction(array('CountryForm', 'onEdit')), 'bs:plus-sign green');
        
        // creates a DataGrid
        $this->datagrid = new TDataGrid;
        $this->datagrid = new BootstrapDatagridWrapper($this->datagrid);
        $this->datagrid->style = 'width: 100%';
        $this->datagrid->datatable = 'true';
        // $this->datagrid->enablePopover('Popover', 'Hi <b> {name} </b>');
        

        // creates the datagrid columns
        $column_id = new TDataGridColumn('id', 'ID', 'left');
        $column_description = new TDataGridColumn('description', 'Country', 'left');


        // add the columns to the DataGrid
        $this->datagrid->addColumn($column_id);
        $this->datagrid->addColumn($column_description);


        // creates the datagrid column actions
        $order_description = new TAction(array($this, 'onReload'));
        $order_description->setParameter('order', 'description');
        $column_description->setAction($order_description);
        

        // define the transformer method over image
        $column_description->setTransformer( function($value, $object, $row) {
            return strtoupper($value);
        });

        
        // create EDIT action
        $action_edit = new TDataGridAction(array('CountryForm', 'onEdit'));
        //$action_edit->setUseButton(TRUE);
        //$action_edit->setButtonClass('btn btn-default');
        $action_edit->setLabel(_t('Edit'));
        $action_edit->setImage('fa:pencil-square-o blue fa-lg');
        $action_edit->setField('id');
        $this->datagrid->addAction($action_edit);
        
        // create DELETE action
        $action_del = new TDataGridAction(array($this, 'onDelete'));
        //$action_del->setUseButton(TRUE);
        //$action_del->setButtonClass('btn btn-default');
        $action_del->setLabel(_t('Delete'));
        $action_del->setImage('fa:trash-o red fa-lg');
        $action_del->setField('id');
        $this->datagrid->addAction($action_del);
        
        // create the datagrid model
        $this->datagrid->createModel();
        
        // create the page navigation
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->setAction(new TAction(array($this, 'onReload')));
        $this->pageNavigation->setWidth($this->datagrid->getWidth());
        


        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        // $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->add(TPanelGroup::pack('Title', $this->form));
        $container->add(TPanelGroup::pack('', $this->datagrid, $this->pageNavigation));
        
        parent::add($container);
    }
    

}
