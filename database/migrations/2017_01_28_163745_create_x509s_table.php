<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateX509sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('x509s', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fqdn')->unique();
            $table->integer('port');
            $table->integer('daysleft')->nullable();
            $table->string('name')->nullable();
            $table->string('subject_C')->nullable();
            $table->string('subject_ST')->nullable();
            $table->string('subject_L')->nullable();
            $table->string('subject_O')->nullable();
            $table->string('subject_CN')->nullable();
            $table->string('hash')->nullable();
            $table->string('issuer_C')->nullable();
            $table->string('issuer_O')->nullable();
            $table->string('issuer_CN')->nullable();
            $table->string('version')->nullable();
            $table->string('serialNumber')->nullable();
            $table->string('validFrom')->nullable();
            $table->string('validTo')->nullable();
            $table->string('validFrom_time_t')->nullable();
            $table->string('validTo_time_t')->nullable();
            $table->string('signatureTypeSN')->nullable();
            $table->string('signatureTypeLN')->nullable();
            $table->string('signatureTypeNID')->nullable();
            $table->string('extensions_extendedKeyUsage')->nullable();
            $table->text('extensions_subjectAltName')->nullable();
            $table->string('extensions_keyUsage')->nullable();
            $table->string('extensions_authorityInfoAccess')->nullable();
            $table->string('extensions_subjectKeyIdentifier')->nullable();
            $table->string('extensions_basicConstraints')->nullable();
            $table->string('extensions_authorityKeyIdentifier')->nullable();
            $table->text('extensions_certificatePolicies')->nullable();
            $table->string('extensions_crlDistributionPoints')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('x509s');
    }
}
