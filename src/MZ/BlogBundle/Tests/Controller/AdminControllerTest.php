<?php

namespace MZ\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{
	public function testRedirect()
	{
		$client = static::createClient();
		
		$client->request('GET', '/admin/');
		$this->assertEquals(302, $client->getResponse()->getStatusCode());
	}
	
	public function testLogin()
	{
		$client = static::createClient();
		$crawler = $client->request('GET', '/login/');
		
		$form = $crawler->selectButton('_submit')->form();
		
		$form['_username'] = 'miguel';
		$form['_password'] = 'miguel';
		
		$crawler = $client->submit($form);
		
	 //$this->assertEquals(302, $client->getResponse()->getStatusCode());
	}
}