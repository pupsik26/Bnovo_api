<?php

namespace App\Repositories;

use App\Interfaces\GuestInterface;
use App\Models\Guests;

class GuestRepository implements GuestInterface
{

    public function index()
    {
        return Guests::all();
    }

    public function getById($id)
    {
        return Guests::findOrFail($id);
    }

    public function store(array $data)
    {
        return Guests::create($data);
    }

    public function update(array $data, $id)
    {
        return Guests::whereId($id)->update($data);
    }

    public function delete($id)
    {
        Guests::destroy($id);
    }
}
