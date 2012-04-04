<?php
use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

/**
 * Features context for general Kohana activities
 */
class KohanaFeatureContext extends BehatContext
{

	/**
     * @Given /^the config value "([^"]*)" is set to "([^"]*)"$/
	 *
	 * Sets a configuration value to a known state
     */
    public function theConfigValueIsSetTo($key, $value)
    {
		// Split into the group and the remainder of the setting
		list($group, $key) = explode('.', $key, 2);
        Kohana::$config->load($group)
				->set($key, $value);
    }

}