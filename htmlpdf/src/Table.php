<?php

namespace Aashiv\Htmlpdf;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
	protected $table = 'tables';
	protected $fillable = [
		'iWorkspaceid', 
		'tTagstart',
		'tTagend',
		'tHtml',	
		'tJson'
	];
}
