<?php
use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

/**
 * Features context for operations relating to the database
 */
class DatabaseFeatureContext extends BehatContext
{
	protected $_default_row_values=array();

	/**
	 * @Given /^the "([^"]+)" table is empty$/
	 */
	public function theTableIsEmpty($table)
	{
		// Clear the queue table
		DB::query(Database::DELETE,
				"TRUNCATE $table")
				->execute();
	}

    /**
     * @Given /^the "([^"]+)" table contains (only |)the following records:$/
     */
    public function theTableContainsTheFollowingRecords($table, $only, TableNode $rows)
    {
		if ($only)
		{
			$this->theTableIsEmpty($table);
		}

		$query = NULL;

		// Get the default row data for this table
		$defaults = $this->default_row_values($table);

		// Add the new records
		foreach ($rows->getHash() as $row)
		{
			// Fill out default values
			$record = Arr::merge($defaults, $row);

			// Set up the query if required
			if ( ! $query)
			{
				$query = DB::insert($table, array_keys($record));
			}

			// Add the customer
			$query->values($record);
		}

		// Execute the query
		if ($query)
		{
			$query->execute();
		}
    }

	/**
	 * Returns the default row values for the given table
	 * @param string $table Name of the table to store defaults for
	 */
	protected function default_row_values($table)
	{
		return Arr::get($this->_default_row_values, $table, array());
	}

	/**
	 * @Given /^the default values for the "([^"]+)" table are:$/
	 */
	public function theDefaultValuesForTableAre($table, TableNode $values)
	{
		$values = $values->getHash();
		$this->_default_row_values[$table] = $values[0];

	}

	/**
	 * @Then /^the "([^"]+)" record with "([^"]+)" equal to "([^"]+)" should have:$/
	 */
	public function theRecordWithFieldEqualToShouldHave($table, $field, $value, TableNode $expected)
	{
		throw new PendingException;
	}

}