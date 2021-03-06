<?php


/**
 * Skeleton subclass for representing a row from the 'bp_steps' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
abstract class Ezer_PropelStep extends BaseEzer_PropelStep implements Ezer_IntStep, Ezer_IntObject
{
	/**
	 * @var Ezer_PropelData
	 */
	protected $dataObject = null;
	
	public function getCustomFields()
	{
		return array();
	}

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		parent::hydrate($row, $startcol, $rehydrate);
		
		$data = $this->getData();
		if($data)
			$this->dataObject = unserialize($this->getData());
	}

	/**
	 * Code to be run before persisting the object
	 * @param PropelPDO $con
	 * @return bloolean
	 */
	public function preSave(PropelPDO $con = null)
	{
		if($this->dataObject)
			$this->setData(serialize($this->dataObject));
			
		return true;
	}
	
	/**
	 * @param Ezer_PropelStepContainer $container
	 * @param int $order
	 */
	public function setContainer(Ezer_PropelStepContainer $container, $order = null)
	{
		$this->setContainerId($container->getId());
		$this->setContainerType($container->getType());
		
		if($order)
			$this->setOrder($order);
	}
	
} // Ezer_PropelStep
