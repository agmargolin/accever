<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    /**
     * @return array
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'accesses_users', 'access_id', 'user_id');
    }

    /**
     * @return array
     */
    public function packages()
    {
        return $this->belongsToMany('App\Access', 'packages_accesses', 'access_id', 'package_id');
    }

    /**
     * @return array
     */
    public function projects()
    {
        return $this->belongsTo('App\Project', 'project_id');
    }

    public function decryptPassword($encrypted)
    {
        $key = md5("Cdfasdsd3daerr#$%^&*(_3495%65\c2", true); //todo move to global config

        $decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_256,$key, base64_decode(urldecode($encrypted)),MCRYPT_MODE_ECB);
        return $decrypted;
    }
    public function encryptPassword($password)
    {
        $key = md5("Cdfasdsd3daerr#$%^&*(_3495%65\c2", true); //todo move to global config

        $encrypted = urlencode(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $password, MCRYPT_MODE_ECB)));
        return $encrypted;
    }
}
