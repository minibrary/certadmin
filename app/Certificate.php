<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = ['fqdn', 'port', 'memo'];
    public function owner()
    {
      return $this->belongsTo(User::class, 'user_id');
    }

    public function x509()
    {
      return $this->belongsTo(X509::class);
    }
}
