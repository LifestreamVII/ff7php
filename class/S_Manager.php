<?php

class S_Manager
{

  private $_db;

  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function add(SOLDIER $char)
  {
    $query = $this -> _db-> prepare('INSERT INTO soldier(pv, atk, name) VALUES(:pv, :atk, :name)');
    $query -> bindValue(':pv', $char->get_pv());
    $query -> bindValue(':atk', $char->get_atk());
    $query -> bindValue(':name', $char->get_name());
    $query -> execute();
    $char -> set_id($this -> _db -> lastInsertId());
  }
  
  public function count()
  {
    return $this->_db->query('SELECT COUNT(*) FROM soldier')->fetchColumn();
  }
  
  public function delete(SOLDIER $char)
  {
    $this->_db->exec('DELETE FROM soldier WHERE id = '.$char->get_id());
  }

  public function get($charInfo)
  {
    if (is_int($charInfo))
    {
      $query = $this -> _db -> query('SELECT * FROM soldier WHERE id = '.$charInfo);
      $data = $query -> fetch(PDO::FETCH_ASSOC);
      return new SOLDIER($data['id'], $data['pv'], $data['atk'], $data['name'], $data['selsprite']);
    }
    else
    {
      $query = $this -> _db -> prepare('SELECT * FROM soldier WHERE name = :name');
      $query -> execute([':name' => $charInfo]);
      $data = $query -> fetch(PDO::FETCH_ASSOC);
      return new SOLDIER($data['id'], $data['pv'], $data['atk'], $data['name'], $data['selsprite']);
    }
  }

  public function getMateria($matInfo)
  {
    if (is_int($matInfo))
    {
      $query = $this -> _db -> query('SELECT * FROM materias WHERE id = '.$matInfo);
      $data = $query -> fetch(PDO::FETCH_ASSOC);
      return new Materia($data['atk'], $data['pv'], $data['type'], $data['name'], $data['color']);
    }
    else
    {
      $query = $this -> _db -> prepare('SELECT * FROM materias WHERE name = :name');
      $query -> execute([':name' => $matInfo]);
      $data = $query -> fetch(PDO::FETCH_ASSOC);
      return new Materia($data['atk'], $data['pv'], $data['type'], $data['name'], $data['color']);
    }
  }
  
  public function getAll($name)
  {

    $charList = [];
    
    $query = $this -> _db -> prepare('SELECT * FROM soldier WHERE name <> :name ORDER BY name');
    $query -> execute([':name' => $name]);
    
    while ($data = $query -> fetch(PDO::FETCH_ASSOC))
    {
      $charList[] = new SOLDIER($data);
    }
    
    return $charList;
  }

  public function list(){
    $query = $this -> _db -> prepare('SELECT * FROM soldier');
    $query -> execute();
    $list = $query->fetchAll();
    return $list;
  }
  
  public function update(SOLDIER $char)
  {
    $query = $this -> _db -> prepare('UPDATE soldier SET pv = :pv WHERE id = :id');
    
    $query -> bindValue(':pv', $char->get_pv(), PDO::PARAM_INT);
    $query -> bindValue(':id', $char->get_id(), PDO::PARAM_INT);
    
    $query -> execute();
  }
  
  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}