<?php
use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\MinkContext;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
/**
* classe FeatureContext to run fonctïonnel test
*/
class FeatureContext extends MinkContext
{
/**
* driver PHP pour selenium
* */
protected $driver;
/**
* URL du serveur selenium
*/
protected $serverUrl = 'http://localhost:4444';
/**
* Constructor.
*
*
*/
public function __construct()
{
$desiredCapabilities = DesiredCapabilities::chrome();
// Disable accepting SSL certificates
$desiredCapabilities->setCapability('acceptSslCerts', false);
$this->driver = RemoteWebDriver::create($this->serverUrl,
$desiredCapabilities);
}
/**
* @Given I am on the authentification page
*/
public function iAmOnTheAuthentificationPage()
{
$this->driver->get('http://localhost/TestSelenium');
}
/**
* @Given /I authenticated as "(?P<username>[^"]*)" using "(?P<password>[^"]*)"/
*/
public function iAuthenticatedWithUsernameAndPassword($username,
$password)
{
$this->driver->findElement(WebDriverBy::id('login'))
->sendKeys($username);
$this->driver->findElement(WebDriverBy::id('password-input'))
->sendKeys($password);
}
/**
* @When I submit the form
*/
public function iSubmitTheForm()
{
$this->driver->findElement(WebDriverBy::id('valider'))
->submit();
}
/**
* @Then I should see Accueil
*/
public function iShouldSeeAccueil()
{
//wait to load the web page
$this->driver->wait(10, 1000)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::linktext("Ajax")));
// Find link Les tests unitaires (PHPUNIT) element of 'Accueil' page
$this->driver->findElement(WebDriverBy::linkText("Les tests unitaires (PHPUNIT)"));
// Make sure to always call quit() at the end to terminate the browser session
$this->driver->quit();
}
}
