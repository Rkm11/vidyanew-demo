<?php 
namespace App\Http\Traits;
use Carbon\Carbon;
use App\Models\Batch;
use App\Models\Student;
use App\Models\Medium;
use App\Models\Standard;

trait GetData{	

	public function autoId($b,$m,$s)
	{
		if(!empty($b)&&$b!=0){
		$batch = substr(Batch::find($b)->batch_name,0,1);
		}else{
			$batch ='';
		}
		$std=Standard::find($s)->std_name;
		if(is_numeric($std)){
			$std = substr((preg_replace("/[^0-9,.]/", "", Standard::find($s)->std_name) + 100),1,2);
		}else{
			$std='';
		}
		
		$med = strtoupper(substr(Medium::find($m)->med_name,0,3));
		// $stu = substr((Student::max('stu_id') + 1001),1,3);
		$stu = substr((Student::join('admission_details','admission_details.ad_student','=','students.stu_id')->where('admission_details.ad_standard',$s)->count() + 1001),1,3);
		return $med.$std.$stu.$batch;		
	}

	public function resizeImage($image, $quality = 35){    
		$sourceImage = $image;
		$targetImage = $image;

		list($maxWidth, $maxHeight, $type, $attr) = getimagesize($image);
		
		if (!$image = @imagecreatefromjpeg($sourceImage)){
			return false;
		}

		list($origWidth, $origHeight) = getimagesize($sourceImage);

		if ($maxWidth == 0){
			$maxWidth  = $origWidth;
		}

		if ($maxHeight == 0){
			$maxHeight = $origHeight;
		}

		$widthRatio = $maxWidth / $origWidth;
		$heightRatio = $maxHeight / $origHeight;

		$ratio = min($widthRatio, $heightRatio);

		$newWidth  = (int)$origWidth  * $ratio;
		$newHeight = (int)$origHeight * $ratio;

		$newImage = imagecreatetruecolor($newWidth, $newHeight);
		imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
		imageinterlace($image, 1);
		imagejpeg($newImage, $targetImage, $quality);

		imagedestroy($image);
		imagedestroy($newImage);
	}

	public function changeKeys($rep, $arr = []){
		$new = [];
		foreach ($arr as $key => $value) {			
			$new[$rep.$key] = $value;
		}		
		return $new;
	}

	public function dateParser($date){
		return Carbon::parse($date)->format('Y-m-d h:i:s');
	}

	public function removePrefix($data){
		foreach ($data as $k => $v) {            
            $data[explode('_', $k)[1]] = $v;
            unset($data[$k]);
        }
		return $data;        
	}
	public function romanic_number($integer, $upcase = true) 
	{ 
		$table = array('M'=>1000, 'CM'=>900, 'D'=>500, 'CD'=>400, 'C'=>100, 'XC'=>90, 'L'=>50, 'XL'=>40, 'X'=>10, 'IX'=>9, 'V'=>5, 'IV'=>4, 'I'=>1); 
		$return = ''; 
		while($integer > 0) 
		{ 
			foreach($table as $rom=>$arb) 
			{ 
				if($integer >= $arb) 
				{ 
					$integer -= $arb; 
					$return .= $rom; 
					break; 
				} 
			} 
		} 

		return $return; 
	} 	
	// public function insertSmall($r, $pre, $table){

	// 	if(!$table::where($pre.'name',$r->name)->first()){
 //            $n = $this->changeKeys($pre, $r->all());
 //            return $table::create($n) ? 'success' : 'error';
 //        }else{
 //            return 'exist';
 //        }
	// }
}