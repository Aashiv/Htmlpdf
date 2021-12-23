<?php

namespace Aashiv\Htmlpdf;

use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
	protected $table = 'workspaces';
	protected $fillable = [ 
		'vName',
		'iUserid',
		'tTable',	
		'tRow',
		'tColumn',
		'tDocname',
	];
}
