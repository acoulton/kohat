<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//
require_once 'mink/autoload.php';


/**
 * KOhat feature context extends Mink to provide some useful aliases including
 * past-tense "I have filled in" rather than "I fill in" to allow these to make
 * grammatical sense as a Given rather than When (to avoid multiple When steps
 * in eg filling a form).
 * 
 */
class KOhat_MinkContext extends Behat\Mink\Behat\Context\MinkContext
{
    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param   array   $parameters     context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
    }

    /**
	 * Alias for I fill in "" with ""
	 *
     * @Given /^I have entered "([^"]*)" in "([^"]*)"$/
     */
    public function iHaveEnteredIn($value, $field)
    {
        return new When("I fill in \"$value\" in \"$field\"");
    }

    /**
	 * Alias for I should see an "" element
	 *
     * @Given /^I should see a "([^"]*)" field$/
     */
    public function iShouldSeeAField($field)
    {
        return new Then("I should see a \"input[name=$field]\" element");
    }

    /**
	 * Alias for I fill in the following
	 *
     * @Given /^I have filled in the following:$/
     */
    public function iHaveFilledInTheFollowing(TableNode $table)
    {
        return new When("I fill in the following:", $table);
    }

}
