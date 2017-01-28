<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class X509 extends Model
{
    protected $table = 'x509s';
    protected $fillable = ['fqdn', 'port'];

    public function Certificates()
    {
      return $this->hasMany(Certificate::class);
    }

}
