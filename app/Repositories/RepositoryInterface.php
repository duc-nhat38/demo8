<?php
namespace App\Repositories;

interface RepositoryInterface {

 public function all();

 public function create( array $array);
 
 public function show($id);

 public function update(Array $array);

 public function destroy($id);

}
?>