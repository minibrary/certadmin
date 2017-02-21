<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = ['fqdn', 'port', 'memo'];
    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function x509()
    {
      return $this->belongsTo(X509::class);
    }
}
