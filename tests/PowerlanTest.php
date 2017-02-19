<?php

use PowerLan\OAuth2\Client\Provider\PowerLan as SSOPowerLan;

class DrupalTest extends \PHPUnit_Framework_TestCase
{
    public function testProvider()
    {
        $provider = new SSOPowerLan(array(
            'clientId' => 'id',
            'clientSecret' => 'secret',
            'redirectUri' => 'https://www.exemple.com/oauth/cb',
        ));
    }
}
