<?php

include "./core/php/MateriasManager.php";
use PHPUnit\Framework\TestCase;

class MateriasManagerTest extends TestCase {

  // Mock DataBaseManager
  public function createMockDataBaseManager($expectedResults) {
    $mock = $this->createMock(DataBaseManager::class);
    $mock->method('realizeQuery')->willReturn($expectedResults);
    $mock->method('insertQuery')->willReturn($expectedResults);
    return $mock;
  }

  // GET ONE MATERIA
  public function testPositiveGetMateria() {
    // Expected materia data
    $expectedMateria = array('id' => 1, 'nombre' => 'Math');

    // Mock DataBaseManager with expected results (array)
    $mock = $this->createMockDataBaseManager(array($expectedMateria));

    // Inject mock into MateriasManager (optional, depends on implementation)
    $materiasManager = new MateriasManager($mock);

    // Call getMateria with an existing ID
    $materiaData = $materiasManager->getMateria(1);

    // Assert expected JSON output for successful retrieval
    $this->assertEquals(json_encode(array($expectedMateria)), $materiaData);
  }

  public function testNegativeGetMateria() {
    // Mock DataBaseManager with empty results (no materia found)
    $mock = $this->createMockDataBaseManager(array());
  
    // Inject mock into MateriasManager
    $materiasManager = new MateriasManager($mock);
  
    // Call getMateria with a non-existent ID
    $materiaData = $materiasManager->getMateria(100);
  
    // Assert expected message for not found scenario
    $this->assertEquals("Tabla de materias esta vacia", $materiaData);
  }

  // GET ALL MATERIA
  public function testPositiveGetAllMateria() {
    // Expected materia data obtained (array of arrays)
    $expectedMaterias = [
      ['id' => 1, 'name' => 'Math'],
      ['id' => 2, 'name' => 'Physics'],
      ['id' => 3, 'name' => 'Chemistry'],
    ];
    
    // Database data to return
    $databaseMaterias = [
      ['id' => 1, 'nombre' => 'Math'],
      ['id' => 2, 'nombre' => 'Physics'],
      ['id' => 3, 'nombre' => 'Chemistry'],
    ];

    // Mock DataBaseManager with db results (array of arrays)
    $mock = $this->createMockDataBaseManager($databaseMaterias);

    // Inject mock into MateriasManager (optional)
    $materiasManager = new MateriasManager($mock);

    // Call getAllMateria
    $materiasData = $materiasManager->getAllMateria();

    // Assert expected JSON output for successful retrieval
    $this->assertEquals(json_encode($expectedMaterias), $materiasData);
  }

  public function testNegativeGetAllMateria() {
    // Mock DataBaseManager with empty results (no materia found)
    $mock = $this->createMockDataBaseManager(array());
  
    // Inject mock into MateriasManager (optional)
    $materiasManager = new MateriasManager($mock);
  
    // Call getAllMateria
    $materiasData = $materiasManager->getAllMateria();
  
    // Assert expected message for not found scenario
    $this->assertEquals("tabla materia vacia", $materiasData);
  }

  // SET MATERIA
  public function testPositiveSetMateria() {
    // Nombre de materia válido
    $materiaName = "Matemáticas";

    // Mock de DataBaseManager con consulta exitosa
    $mock = $this->createMockDataBaseManager(true);

    // Inyectar mock en MateriasManager
    $materiasManager = new MateriasManager($mock);

    // Llamar a la función setMateria
    $resultado = $materiasManager->setMateria($materiaName);

    // Verificar que la función retorna una cadena vacía
    $this->assertEquals(true, $resultado);
}

  public function testNegativeSetMateria() {
    // Nombre de materia inválido (null)
    $materiaName = null;

    // Mock de DataBaseManager con consulta fallida
    $mock = $this->createMockDataBaseManager(false);

    // Inyectar mock en MateriasManager
    $materiasManager = new MateriasManager($mock);

    // Llamar a la función setMateria
    $resultado = $materiasManager->setMateria($materiaName);

    // Verificar que la función retorna el string vacío
    $this->assertEquals(false, $resultado);
}

// UPDATE MATERIA
public function testPositiveUpdateMateria() {
  // ID de materia válido
  $materiaId = 1;

  // Nombre de materia válido
  $materiaName = "Física";

  // Mock de DataBaseManager con consulta exitosa
  $mock = $this->createMockDataBaseManager(true);

  // Inyectar mock en MateriasManager
  $materiasManager = new MateriasManager($mock);

  // Llamar a la función updateMateria
  $resultado = $materiasManager->updateMateria($materiaId, $materiaName);

  // Verificar que la función retorna una cadena vacía
  $this->assertEquals(true, $resultado);
}

public function testNegativeUpdateMateria() {
  // ID de materia inválido (null) y nombre de materia válido
  $materiaId = null;
  $materiaName = "Química";

  // Mock de DataBaseManager con consulta fallida
  $mock = $this->createMockDataBaseManager(false);

  // Inyectar mock en MateriasManager
  $materiasManager = new MateriasManager($mock);

  // Llamar a la función updateMateria
  $resultado = $materiasManager->updateMateria($materiaId, $materiaName);

  // Verificar que la función retorna el mensaje de error
  $this->assertEquals(false, $resultado);
}

// DELETE MATERIA
public function testPositiveDeleteMateria() {
  // ID de materia válido
  $materiaId = 2;

  // Mock de DataBaseManager con consulta exitosa
  $mock = $this->createMockDataBaseManager(true);

  // Inyectar mock en MateriasManager
  $materiasManager = new MateriasManager($mock);

  // Llamar a la función deleteMateria
  $resultado = $materiasManager->deleteMateria($materiaId);

  // Verificar que la función retorna una cadena vacía
  $this->assertEquals(true, $resultado);
}

public function testNegativeDeleteMateria() {
  // ID de materia inválido (null)
  $materiaId = null;

  // Mock de DataBaseManager con consulta fallida
  $mock = $this->createMockDataBaseManager(false);

  // Inyectar mock en MateriasManager
  $materiasManager = new MateriasManager($mock);

  // Llamar a la función deleteMateria
  $resultado = $materiasManager->deleteMateria($materiaId);

  // Verificar que la función retorna el mensaje de error
  $this->assertEquals(false, $resultado);
}



}
