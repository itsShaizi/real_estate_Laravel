<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Hubspot extends Model
{
    private $client;
    use HasFactory;

    function __construct() {
        $this->client = \SevenShores\Hubspot\Factory::create(env('HUBSPOT_API_KEY'));
    }

    public function createOrUpdateContact($email, $data) {
        try {
            $this->client->contacts()->createOrUpdate($email, $data);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getAllContacts() {
        try {
            $response = $this->contacts()->all();
            return $response->contacts;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getContactByEmail($email) {
        try {
            $response = $this->client->contacts()->getByEmail($email);
            return $response;
        } catch (Exception $e) {
            return false;
        }
    }

}
