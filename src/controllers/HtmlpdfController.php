<?php

namespace Aashiv\Htmlpdf\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use Aashiv\Htmlpdf\Workspace;
use Aashiv\Htmlpdf\Table;
use Aashiv\Htmlpdf\Row;
use Aashiv\Htmlpdf\Column;
use Aashiv\Htmlpdf\User;
use PDF;
use Session;
use DB;
use App;

class HtmlpdfController extends Controller
{
	public function index(){
		
		if(Session::get('userid') != ''){
		
			$isValidUser = (!empty(DB::select("select * from users where id =".Session::get('userid')))?true:false);

			if($isValidUser == true){
				Session::forget('htmlString');
				$data['project_list'] = DB::select("select * from workspaces where iUserId =".Session::get('userid'));
				return view('htmlpdf::welcome', $data);			
				
			} else {
				
				return redirect('/login');				
			}
		} else {
			
			return redirect('/login');
		}
	}
	
	public function logout(){
		if(Session::get('userid') != ''){
			
			Session::flush();			
		}		
		return redirect('/login');
	}
	public function login(){
		
		if(Session::get('userid') != ''){
			
			return redirect('/');
			
		} else {
			
			return view('htmlpdf::login');
		}
	}

	public function doLogin(Request $request){

		$data = Request::post();
		
		if(Session::get('userid') != ''){

			return redirect('/');
			
		} else {						
			$email = (!empty($data['email'])?$data['email']:'');
			$email = base64_encode($email); 

			$password = (!empty($data['password'])?$data['password']:'');
			$password = base64_encode($password);

			$data = User::where('email','=',$email)->where('password','=',$password)->first();
			if(!empty($data)){
				
				Session::put('name',base64_encode($data['name']));
				Session::put('email',$data['email']);
				Session::put('userid',$data['id']);
				return redirect('/');
			}
			else {
				return redirect('/login');
			}
		}
	}	

	public function doNewProject(Request $request){

		$data = Request::post();
		
		if($data['addproject']){

			$name = (!empty($data['name'])?$data['name']:'');
			$userid = Session::get('userid');
			
			$r = DB::select('select * from workspaces where iUserid="'.$userid.'" and vName="'.$name.'"');
			if(count($r) == 0){

				$r1 = DB::table('workspaces')->insert([
					'vName' => $name,
					'iUserid' => $userid,
					'tDocname' => $name
				]);

				if($r1 == TRUE){

					$iworkspaceid = DB::getPdo()->lastInsertId();
					Session::put('workspaces', $iworkspaceid);
					return redirect('/doworkspace/'.$iworkspaceid);
				}
			} else {
				Session::put('message','Name is already exist. Enter another one.');
				return redirect('/');
			}
		}
	}
	
	public function removeTable(Request $request){
		$data = Request::post();
		if(isset($data['context']) && $data['context']=='removetable'){
			
		} else {
			$response['status']='false';
			$response['error']='invalid request.';
			$response['data']=array();
		}
		echo json_encode($response);
	}
	
	public function createTableRequest(Request $request){
		
		$data = Request::post();
		if(isset($data['context']) && $data['context']=='createtable'){
			
			//no of columns
			$table = (!empty($data['table'])?$data['table']:'');
			$iworkspaceid = Session::get('workspaces');

			$table_start = htmlentities('<table style="width:100%;">');
			$table_end = htmlentities('</table>');

			$row_start = htmlentities('<tr>');
			$row_end = htmlentities('</tr>');

			$width_in_percentage = '';
			$width_in_pixel = '';

			$column_start = '';
			$column_end = htmlentities('</td>');

			//create table using workspaces
			$r = DB::table('tables')->insert([
				'iworkspaceid' => $iworkspaceid,
				'tTagstart' => $table_start,
				'tTagend' => $table_end
			]);

			if($r == TRUE){
				
				$iTableid = DB::getPdo()->lastInsertId();
				for($a=0;$a<1;++$a){
					
					$r2 = DB::table('rows')->insert([
						'iTableid' => $iTableid,
						'iWorkspaceid' => $iworkspaceid,
						'tTagstart' => $row_start,
						'tTagend' => $row_end
					]);

					if($r2 == TRUE){

						$iRowid = DB::getPdo()->lastInsertId();
						$no_of_columns = $table;
						$width_in_percentage = (100/$no_of_columns);
						$width_in_percentage = number_format((float)$width_in_percentage, 2, '.', '');  // Outputs -> 105.00
						$width_in_percentage .= "%";
						$width_in_pixel = (1080/$no_of_columns);
						$width_in_pixel = number_format((float)$width_in_pixel, 2, '.', '');
						$width_in_pixel .= "px";
						$column_start = htmlentities('<td style="width:'.$width_in_percentage.'; width:'.$width_in_pixel.'">');

						for($b=0;$b<$no_of_columns;++$b){

							$r3 = DB::table('columns')->insert([
								'iRowid' => $iRowid,
								'iTableid' => $iTableid,
								'iworkspaceid' => $iworkspaceid,
								'tTagstart' => $column_start,
								'tTagend' => $column_end
							]);
						}
					}
				}
				$response['status']='true';
				$response['error']='table create successful.';
				$response['data']=array('id'=>$iTableid);

			} else {
				$response['status']='false';
				$response['error']='could not create table.';
				$response['data']=array();
			}
		} else {
			$response['status']='false';
			$response['error']='invalid request.';
			$response['data']=array();
		}
		echo json_encode($response);
	}
	public function dashboard($iworkspaceid){

		if(Session::get('userid') != ''){
		
			Session::put('workspaces',$iworkspaceid);
			
			$workspaceName = DB::select('select vName from workspaces where id='.$iworkspaceid)[0]->vName;
			/* Start Load Table Tree View */
			$tableArr = DB::select('select id from tables where iWorkspaceid='.$iworkspaceid);

			$data = '';
			if(count($tableArr) > 0){
				
				$data.= '<ul class="nav nav-sidebar">';

				foreach($tableArr as $row2){
					
					$iTableid = $row2->id;
					
					
					$rowArr = DB::select('select id from rows where iTableid="'.$iTableid.'"');

					if(count($rowArr) > 0){
						$data.= '<li><a href="javascript:void(0);">Table-'.$iTableid.'<span class="sr-only">(current)</span></a></li>';
						
						$data.= '<ul class="nav nav-sidebar" style="padding-left: 50px; background-color: #ccc;">';
						
						foreach($rowArr as $row3){
							
							$iRowid = $row3->id;						
							
							$columnArr = DB::select('select id from columns where iRowid="'.$iRowid.'"');

							if(count($columnArr) > 0){
								$data.= '<li><a href="javascript:void(0);">Row-'.$iRowid.'<span class="sr-only">(current)</span></a></li>';
								
								$data.= '<ul class="nav nav-sidebar" style="padding-left: 70px; background-color: #ccc;">';
				
								foreach($columnArr as $row4){
								
									$iColumnid = $row4->id;

									$data.= '<li><a href="javascript:void(0);" onclick="getHtml('.$iTableid.','.$iRowid.','.$iColumnid.')">Column-'.$iColumnid.'<span class="sr-only">(current)</span></a></li>';
								}

								$data.= '</ul>';
							}
							
						}
						
						$data.= '</ul>';
					}
				}
				
				$data.= '</ul>';  
			}
			
			return view('htmlpdf::dashboard',array('sidebar'=>$data, 'iWorkspaceid'=>$iworkspaceid, 'workspaceName'=> $workspaceName));
		} else {
			
			return redirect('/login');
		}		
	}
	public function getColumnHtmlData(Request $request){
		
		$data = Request::post();
	  
		if(isset($data['context']) && $data['context']=='html'){
			
			$iTableid = $data['tableid'];
			$iRowid = $data['rowid'];
			$iColumnid = $data['columnid'];

			$r = DB::select('select * from columns as c where c.iTableid = "'.$iTableid.'" and c.iRowid = "'.$iRowid.'" and c.id="'.$iColumnid.'"')[0];

			echo ($r->tTagstart !='')?html_entity_decode($r->tTagstart):'empty!';
			exit;
		}		
	}
	
	public function saveColumnHtmlData(Request $request){
		
		$data = Request::post();
		// workspacesid: w,
		// tableid: a,
		// rowid: b,
		// columnid: c,
		// columnhtml: columnhtml,
		// context: 'savehtml',		
		
		if(isset($data['context']) && $data['context']=='savehtml'){
			
			$iworkspaceid = $data['workspaceid'];
			$iTableid = $data['tableid'];
			$iRowid = $data['rowid'];
			$iColumnid = $data['columnid'];

			//column html data
			$columnhtml = htmlentities(stripslashes($_POST['columnhtml']));

			//$tTagend = '</td>';
			$tTagstart = $columnhtml;

			$q = DB::update('update columns set tTagstart = "'.$tTagstart.'" where iTableid = ? and iRowid = ? and id = ?', [$iTableid, $iRowid , $iColumnid]);

			if($q){

					$table_id_array = array();
					/* Start Load Table Tree View */
					$r2 = DB::select('select id, tTagstart, tTagend from tables where iWorkspaceid='.$iworkspaceid);

					$table_index = 1;
					foreach($r2 as $row2){

						// echo "<pre>";
						// echo $row2['id'];
						// echo $row2['tTagstart'];
						// echo $row2['tTagend'];
						
						$table_id_array[$table_index]['id'] = $row2->id;
						$table_id_array[$table_index]['tTagstart'] = $row2->tTagstart;
						$table_id_array[$table_index]['tTagend'] = $row2->tTagend;

						++$table_index;
					}

					$row_id_array = array();
					$row_index = 1;
					for($a=1;$a<=count($table_id_array);++$a){

						$iTableid = $table_id_array[$a]['id'];
						$r3 = DB::select('select id, iTableid, tTagstart, tTagend from rows where iTableid="'.$iTableid.'"');

						foreach($r3 as $row3){
							
							// echo "<pre>";
							// echo $row3['id'];
							// echo $row3['iTableid'];
							// echo $row3['tTagstart'];
							// echo $row3['tTagend'];

							$row_id_array[$row_index]['id'] = $row3->id;
							$row_id_array[$row_index]['iTableid'] = $row3->iTableid;
							$row_id_array[$row_index]['tTagstart'] = $row3->tTagstart;
							$row_id_array[$row_index]['tTagend'] = $row3->tTagend;                                

							++$row_index;
						}
					}
					
					$column_id_array = array();
					$column_index = 1;
					for($b=1;$b<=count($row_id_array);++$b){

						$iTableid = $row_id_array[$b]['iTableid'];
						$iRowid = $row_id_array[$b]['id'];
						
						$r4 = DB::select('select id, iTableid, iRowid, tTagstart, tTagend from columns where iRowid="'.$iRowid.'" and iTableid="'.$iTableid.'"');

						foreach($r4 as $row4){

							$column_id_array[$column_index]['id'] = $row4->id;
							$column_id_array[$column_index]['iRowid'] = $row4->iRowid;
							$column_id_array[$column_index]['iTableid'] = $row4->iTableid;
							$column_id_array[$column_index]['tTagstart'] = $row4->tTagstart;
							$column_id_array[$column_index]['tTagend'] = $row4->tTagend;                                

							++$column_index;
						}
					}
					
					$htmlString = '';

					//table
					for($a=1;$a<=count($table_id_array);++$a){

						$tableid = $table_id_array[$a]['id'];

						$htmlString.= $table_id_array[$a]['tTagstart'];

						//row
						for($b=1;$b<=count($row_id_array);++$b){

							if($row_id_array[$b]['iTableid']==$tableid){

								
								$htmlString.= $row_id_array[$b]['tTagstart'];
								
								$rowid = $row_id_array[$b]['id'];

								//column
								for($c=1;$c<=count($column_id_array);++$c){

									if($column_id_array[$c]['iRowid'] == $rowid && $column_id_array[$c]['iTableid'] == $tableid){

										$htmlString.= $column_id_array[$c]['tTagstart'];
										$htmlString.= $column_id_array[$c]['tTagend'];
									}
								}
								
								$htmlString.= $row_id_array[$b]['tTagend'];
								
							}
						}

						$htmlString.= $table_id_array[$a]['tTagend'];        
						
					}
					$html = html_entity_decode($htmlString);
					$html = '<table id="myTable" style="width:100%; width:1080px;"><tr><td style="width:100%;">'.$html.'</td></tr></table>';

					Session::put('htmlString', $html);
					$strLength = strlen($html);
				
					$r5 = DB::select('select tDocname from workspaces where id="'.$iworkspaceid.'"')[0];
					
					$fileName = $r5->tDocname;
					$handle = fopen($fileName.'.html', "w");
					fwrite($handle, $html);
					fclose( $handle );	

				echo "1";
			}
			else {
				echo "0";            
			}
		} else {
			Session::forget('htmlString');			
		}		
	}
	public function tcpdf_gen($iworkspaceid = null){

		if(!empty($iworkspaceid)){

			$r6 = DB::select('select tDocname from workspaces where id="'.$iworkspaceid.'"')[0];
			$fileName = $r6->tDocname;

			$htmlString = (Session::has('htmlString') && Session::get('htmlString') != '')?Session::get('htmlString'):'';

			if(!empty($htmlString)){
				
				/* Generate Pdf */				
				$pdf = App::make('dompdf.wrapper');
				$pdf->loadHTML($htmlString)->setPaper('A4', 'portrait')->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
				return $pdf->stream();
			}
		}
	}
}
