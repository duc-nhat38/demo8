<?php

namespace App\Repositories;

interface HouseRepositoryInterface {
    public function all();

    public function create(Array $array);

    public function show($id);

    public function getPhotos($id);

    public function getComments($id);

    public function rate(Array $array);

    public function getMyVote(Array $array);

    public function getVotes($house_id);

    public function comment(array $array);

    public function delComment($id);

    public function editComment(array $array);

    public function view($id);

    public function businessHouse($id);

    public function searchHouseAll($data);

    public function searchByTypeAndAddress($data);

    public function searchByTypeAndAddressAndArea($data);

    public function searchByTypeAndDistrict($data);

    public function getAddressHouse($id);

    public function getDistrictHouse($id);

    public function getHouseInUser($id);

    public function houseDelete($id);

    public function update($data);
}
?>