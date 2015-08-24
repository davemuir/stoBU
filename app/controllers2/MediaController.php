<?php
use Illuminate\Support\MessageBag;
use Illuminate\Console\Command;



class MediaController extends BaseController {
	public function index(){
		return View::make('/media/index');
	}

	public function Uploader(){
		$user      = Auth::user();
		$last      = $_REQUEST['last'    ];
		$realeName = $_REQUEST['realName'];
		$name      = $_REQUEST['name'    ];
		$media = new Media;
//		$media->id                = $fileID;
		$media->filename          = $realeName;
		$media->thumbnailfilename = 'thumb_'.$realeName;
		$media->userID            = $user->_id;
		$media->company           = $user->companyID;
		$media->image_name        = $name;
//		$media->date              = filemtime("userlogo/{$user->companyID}/{$realeName}");
		$media->status            = 1;
		$media->save();
		list($w , $h , $t , $a )  = getimagesize("userlogo/{$user->companyID}/thumb_{$realeName}");

		return Response::json(array('result'=>'ok' , 'path'=>"{$user->companyID}/{$media->thumbnailfilename}" , 'name'=>$name , 'last'=>$last , 'w'=>$w , 'h'=>$h ));
	}
	
	public function deleteLogo(){
		$id    = $_REQUEST['id'];
		$media = Media::where('_id','=',$id)->update(array('status'=>2));
		return Response::json(array('result' => 'ok'));
	}
	
	public function renameLogo(){
		$id      = $_REQUEST['id'];
		$newName = $_REQUEST['newName'];
		$media   = Media::where('_id','=',$id)->update(array('image_name'=>$newName));
		return Response::json(array('result' => 'ok'));
	}

	public function restoreLogo(){
		$id    = $_REQUEST['id'];
		$media = Media::where('_id','=',$id)->update(array('status'=>1));
		return Response::json(array('result' => 'ok'));
	}

	public function deleteRlogo(){
		$id    = $_REQUEST['id'];
		$media = Media::where('_id','=',$id)->get();
		foreach($media as $key => $row){
			$src1="userlogo/{$row->company}/{$row->filename}";
			$src2="userlogo/{$row->company}/{$row->thumbnailfilename}";
			if( @unlink($src2) ){
				if( @unlink($src1) ){
					$media = Media::where('_id','=',$row->_id)->delete();
				}
			}
		}
		return Response::json(array('result' => 'ok'));
	}

	public function deleteARlogo(){
		$id    = $_REQUEST['id'];
		$media = Media::where('status','=',2)->get();
		foreach($media as $key => $row){
			$src1="userlogo/{$row->company}/{$row->filename}";
			$src2="userlogo/{$row->company}/{$row->thumbnailfilename}";
			try{ @unlink($src1); }catch(Exception $e){}
			try{ @unlink($src2); }catch(Exception $e){}
			$media = Media::where('_id','=',$row->_id)->delete();
		}
		return Response::json(array('result' => 'ok'));
	}

	public function listLogo(){
		$id    = $_REQUEST['companyID'];
		$media = Media::where('company','=',$id)->where('status','=',1)->get();
		$list=array();
		foreach($media as $key => $row){
			array_push(	$list,array(
								'name'  => $row->image_name,
								'path1' => "/userlogo/{$row->company}/{$row->filename}",
								'path2' => "/userlogo/{$row->company}/{$row->thumbnailfilename}" )
						);
		}
		return Response::json(array('result' => 'ok', 'list' => $list));
	}
}

