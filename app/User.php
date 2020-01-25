<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf',
        'number',
        'complement',
        'district',
        'postal_code',
        'city',
        'state',
        'country',
        'phone',
        'area_code',
        'birth_date'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'cpf' => 'required|unique:users',
            'number' => 'required|integer',
            'complement' => 'max:200',
            'district' => 'required',
            'postal_code' => 'required|integer',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'phone' => 'required',
            'area_code' => 'required|integer',
            'birth_date' => 'required|date'
        ];
    }

    public function rulesUpdateProfile()
    {
        $rules = $this->rules();

        unset($rules['password']);
        unset($rules['cpf']);
        unset($rules['email']);

        return $rules;
    }

    public function profileUpdate(array $data)
    {
        return $this->update($data);
    }

    public function updatePassword(array $newPassoword)
    {
        $newPassoword = bcrypt($newPassoword);

        return $this->update([
            'newPassoword' => $newPassoword
        ]);

        return $this->bcrypt($newPassoword);
    }

    //public function orders()
    //{
    //    $this->hasMany(\App\Models\Order::class);
    //}
}
