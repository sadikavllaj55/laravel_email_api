<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $visible = ['id', 'name'];

    public int $id;

    public string $name;

    public string $username;

    public string $email;

    public string $phone;

    public string $website;

    public ?Company $company = null;

    public ?Address $address = null;

    /**
     * @var array|Post[]
     */
    public array $posts = [];

    public static function fromArray(array $data): User
    {
        $user = new User();

        $user->id = $data['id'];
        $user->name = $data['name'];
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->website = $data['website'];

        $user->company = new Company();
        $user->company->name = $data['company']['name'];
        $user->company->catchPhrase = $data['company']['catchPhrase'];
        $user->company->bs = $data['company']['bs'];

        $user->address = new Address();
        $user->address->street = $data['address']['street'];
        $user->address->suite = $data['address']['suite'];
        $user->address->city = $data['address']['city'];
        $user->address->zipCode = $data['address']['zipcode'];
        $user->address->latitude = $data['address']['geo']['lat'];
        $user->address->longitude = $data['address']['geo']['lng'];

        return $user;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'phone' => $this->phone,
            'website' => $this->website,
            'company' => $this->company,
            'address' => $this->address
        ];
    }
}
