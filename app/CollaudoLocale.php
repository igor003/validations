<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CollaudoLocale extends Model
{
	protected $connection = 'mysql2';
    protected $table = 'pezzi';
    protected $fillable = [
        'idVecchio','NomeBanco','Codice', 'Data','RevisioneCablaggio',''
    ];

    
     
}
