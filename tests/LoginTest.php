<?php

include "./core/php/Login.php"; // Assuming Login.php is in the core/php directory
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase {

  // Mock DataBaseManager (optional)
  public function createMockDataBaseManager($expectedResults) {
    $mock = $this->createMock(DataBaseManager::class);
    $mock->method('realizeQuery')->willReturn($expectedResults);
    return $mock;
  }

  public function testPositiveLogin() {
    // Expected user data for positive test
    $expectedUser = array('type' => 'admin', 'id' => 1);
    $expectedResults = array($expectedUser);

    // Mock DataBaseManager (optional, replace with actual database interaction)
    $mock = $this->createMockDataBaseManager($expectedResults);

    // Call verifyLogin with mocked results (consider using actual function call)
    $message = verifyLogin($expectedResults, 'admin');

    // Assert expected JSON output for successful login
    $this->assertEquals(json_encode(array($expectedUser)), $message);
  }

  public function testNegativeLogin() {
    // Mock DataBaseManager with empty results (no user found)
    $mock = $this->createMockDataBaseManager(array());

    // Call verifyLogin with mocked results (empty array)
    $message = verifyLogin(array(), 'admin');

    // $this->assertNull($message);


    // Assert expected JSON output for failed login (null message)
    $this->assertEquals(json_encode(null), $message);
  }
}