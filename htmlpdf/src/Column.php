<?php

namespace Aashiv\Htmlpdf;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
	protected $table = 'columns';
	protected $fillable = [
		'iRowid', 
		'iTableid', 
		'iWorkspaceid', 
		'tTagstart',
		'tTagend',
		'tHtml',	
		'tJson',
		'iWidthpx',	
		'iWidthcent'
	];
}
