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

    $dbUser = array('tipo' => 'admin', 'id' => 1);

    // Call verifyLogin with mocked results (consider using actual function call)
    $message = verifyLogin(array($dbUser), 'admin');

    // Assert expected JSON output for successful login
    $this->assertEquals(json_encode($expectedResults), $message);
  }

  public function testNegativeLogin() {
    // Call verifyLogin with mocked results (empty array)
    $message = verifyLogin(array(), 'admin');

    // Assert expected JSON output for failed login (null message)
    $this->assertEquals(json_encode(null), $message);
  }
}