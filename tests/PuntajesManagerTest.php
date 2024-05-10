<?php

include "./core/php/PuntajesManajer.php";
use PHPUnit\Framework\TestCase;

class PuntajesManagerTest extends TestCase {

  // Mock DataBaseManager
  public function createMockDataBaseManager($expectedResults) {
    $mock = $this->createMock(DataBaseManager::class);
    $mock->method('realizeQuery')->willReturn($expectedResults);
    $mock->method('insertQuery')->willReturn($expectedResults);

    return $mock;
  }

  public function testPositiveSetPuntaje() {
    $idUsuario = 1;
    $idMateria = 2;
    $fecha = "2024-04-20";
    $dificultad = "Facil";
    $puntaje = 100;
    $foundPeers = 3;
    
    // Simular consulta exitosa
    $mock = $this->createMockDataBaseManager(true);
    
    // Inyectar mock en PuntajesManajer
    $puntajesManajer = new PuntajesManajer($mock);
    
    // Llamar a la función setPuntaje
    $resultado = $puntajesManajer->setPuntaje($idUsuario, $idMateria, $fecha, $dificultad, $puntaje, $foundPeers);
    
    // Verificar que la función retorna una cadena vacía (éxito)
    $this->assertEquals(true, $resultado);
    }

    public function testNegativeSetPuntaje() {
      $idUsuario = null; // ID de usuario inválido
      $idMateria = 2;
      $fecha = "2024-04-20";
      $dificultad = "Facil";
      $puntaje = 100;
      $foundPeers = 3;
      
      // Simular consulta fallida
      $mock = $this->createMockDataBaseManager(false);
      
      // Inyectar mock en PuntajesManajer
      $puntajesManajer = new PuntajesManajer($mock);
      
      // Llamar a la función setPuntaje
      $resultado = $puntajesManajer->setPuntaje($idUsuario, $idMateria, $fecha, $dificultad, $puntaje, $foundPeers);
      
      // Verificar que la función retorna el mensaje de error
      $this->assertEquals(false, $resultado);
      }

      public function testPositiveDeletePuntaje() {
        $idUsuario = 1;
        $idMateria = 2;
        $fecha = "2024-04-20";
        $dificultad = "Facil";
      
        // Simular consulta exitosa
        $mock = $this->createMockDataBaseManager(true);
      
        // Inyectar mock en PuntajesManajer
        $puntajesManajer = new PuntajesManajer($mock);
      
        // Llamar a la función deletePuntaje
        $resultado = $puntajesManajer->deletePuntaje($idUsuario, $idMateria, $fecha, $dificultad);
      
        // Verificar que la función retorna una cadena vacía (éxito)
        $this->assertEquals(true, $resultado);
      }
      
      public function testNegativeDeletePuntaje() {
        $idUsuario = null; // ID de usuario inválido
        $idMateria = 2;
        $fecha = "2024-04-20";
        $dificultad = "Facil";
      
        // Simular consulta fallida
        $mock = $this->createMockDataBaseManager(false);
      
        // Inyectar mock en PuntajesManajer
        $puntajesManajer = new PuntajesManajer($mock);
      
        // Llamar a la función deletePuntaje
        $resultado = $puntajesManajer->deletePuntaje($idUsuario, $idMateria, $fecha, $dificultad);
      
        // Verificar que la función retorna el mensaje de error
        $this->assertEquals(false, $resultado);
      }

      public function testGetAllPuntajeForUsuario_SingleResult() {
        $idUsuario = 1;
        $expectedPuntaje = array('id' => 1, 'id_materia' => 2, 'fecha' => '2024-04-20', 'dificultad' => 'Facil', 'puntaje' => 100, 'parejas_encontradas' => 3);
      
        // Simular consulta con un resultado
        $mock = $this->createMockDataBaseManager(array($expectedPuntaje));
      
        // Inyectar mock en PuntajesManajer
        $puntajesManajer = new PuntajesManajer($mock);
      
        // Llamar a la función getAllPuntajeForUsuario
        $resultado = $puntajesManajer->getAllPuntajeForUsuario($idUsuario);
      
        // Verificar que la función retorna el JSON del puntaje obtenido
        $this->assertEquals(json_encode(array($expectedPuntaje)), $resultado);
      }

      public function testGetAllPuntajeForUsuario_EmptyTable() {
        $idUsuario = 1;
      
        // Simular consulta con tabla vacía
        $mock = $this->createMockDataBaseManager(null);
      
        // Inyectar mock en PuntajesManajer
        $puntajesManajer = new PuntajesManajer($mock);
      
        // Llamar a la función getAllPuntajeForUsuario
        $resultado = $puntajesManajer->getAllPuntajeForUsuario($idUsuario);
      
        // Verificar que la función retorna el mensaje "tabla materia vacia"
        $this->assertEquals("tabla materia vacia", $resultado);
      }
      
      
      public function testGetAllPuntajeForMateria_UnResultado() {
        $idMateria = 2;
        $puntajeEsperado = array('id' => 1, 'id_usuario' => 1, 'fecha' => '2024-04-20', 'dificultad' => 'Facil', 'puntaje' => 100, 'parejas_encontradas' => 3);
      
        // Simular consulta con un resultado
        $mock = $this->createMockDataBaseManager(array($puntajeEsperado));
      
        // Inyectar mock en PuntajesManajer
        $puntajesManajer = new PuntajesManajer($mock);
      
        // Llamar a la función getAllPuntajeForMateria
        $resultado = $puntajesManajer->getAllPuntajeForMateria($idMateria);
      
        // Verificar que la función retorne el JSON del puntaje obtenido
        $this->assertEquals(json_encode(array($puntajeEsperado)), $resultado);
      }

      public function testGetAllPuntajeForMateria_TablaVacia() {
        $idMateria = 2;
      
        // Simular consulta con tabla vacía
        $mock = $this->createMockDataBaseManager(null);
      
        // Inyectar mock en PuntajesManajer
        $puntajesManajer = new PuntajesManajer($mock);
      
        // Llamar a la función getAllPuntajeForMateria
        $resultado = $puntajesManajer->getAllPuntajeForMateria($idMateria);
      
        // Verificar que la función retorne el mensaje "tabla materia vacia"
        $this->assertEquals("tabla materia vacia", $resultado);
      }
      


}
