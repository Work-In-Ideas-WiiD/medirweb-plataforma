<?php

namespace App\Traits;
use Illuminate\Support\Facades\File;

trait UploadFile
{
    public function uploadFile($file, $path)
	{
		$fileName = rand(0, time()) . '.' . $file->getClientOriginalExtension();
		$file->move($path, $fileName);
        
        return $fileName;
    }
    
    public function updateUploadFile($model, $file, $campo, $path)
	{
		$this->destroyFile($model, $campo, $path);
		
		$fileName = $this->uploadFile($file, $path);
		
		return $fileName;
    }
    
	public function cropImage($image, $path)
	{
		preg_match_all('/^data:image\/(.*);base64,(.*)$/m', $image, $match);

		$name = md5(uniqid(rand(), true)).'.'.$match[1][0];
		$source = base64_decode($match[2][0]);
		
		file_put_contents($path . $name, $source);
		
		return $name;
	}
	
    public function destroyFile($model, $campo, $path)
	{
		if (file_exists($path . $model->$campo))
			File::delete($path . $model->$campo);
	}
	
}
