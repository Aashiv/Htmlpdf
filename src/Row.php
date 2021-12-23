<?php

namespace Aashiv\Htmlpdf;

use Illuminate\Database\Eloquent\Model;

class Row extends Model
{
	protected $table = 'rows';
	protected $fillable = [
		'iTableid', 
		'iWorkspaceid', 
		'tTagstart',
		'tTagend',
		'tHtml',	
		'tJson'
	];
}
