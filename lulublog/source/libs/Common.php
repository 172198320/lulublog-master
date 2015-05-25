<?php

namespace source\libs;


use yii\web\UploadedFile;
use source\models\Config;
class Common 
{
	public static function getConfig($id)
	{
		$model = Config::findOne(['id'=>$id]);	
		return $model;
	}
	public static function getConfigValue($id)
	{
		$model = Config::findOne(['id'=>$id]);
		if($model===null)
		{
			return '不存在配置项：'.$id;
		}
		return $model->value;
	}
	
	public static function getThemeDir()
	{
		
	}
	public static function getThemeUrl()
	{
		
	}
	
	public static function buildTreeOptionsForSelf($treeArray,$model=null)
	{
		$options = '<option value="0">根节点</option>';
		
		$found=false;;
		
		foreach($treeArray as $row)
		{
			$theId = intval($row['id']);
			$style = '';
		
			if($model!=null)
			{
				if($model['parent_id'] == $theId)
				{
					$style = ' selected';
				}
				if($model['id']===$theId)
				{
					$model['level']=intval($row['level']);
					$found=true;
					continue;
				}
				if($found)
				{
					if(intval($row['level'])>$model['level'])
					{
						continue;
					}
					else
					{
						$found=false;
					}
				}
			}
			
			$options .= '<option value="' . $row['id'] . '"' . $style . '>' . str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$row['level']) . $row['name'] . '</option>';
		}
		return $options;
	}
	
	public static function buildTreeOptions($treeArray /*,$selectedId=null*/)
	{
	    $options=[];
	    foreach($treeArray as $row)
	    {
	        $options[$row['id']]=str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$row['level']) . $row['name'];
	    }
	    return $options;
	    
		/* $options = '<option value="">请选择</option>';
	
		$selectedId=$selectedId==null?-1:intval($selectedId);
		
		foreach($treeArray as $row)
		{
			$theId = intval($row['id']);
			$style = '';
	
			if( $theId===$selectedId)
			{
				$style = ' selected';
			}
				
			$options .= '<option value="' . $row['id'] . '"' . $style . '>' . str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$row['level']) . $row['name'] . '</option>';
		}
		
		return $options; */
	}
	
	public static function uploadFile($name)
	{
		
		$uploadedFile = UploadedFile::getInstanceByName($name);
	
		var_dump($uploadedFile);
		if($uploadedFile === null || $uploadedFile->hasError)
		{
			return null;
		}
	
		$ymd = date("Ymd");
	
		$save_path = \Yii::getAlias('@attachmentPath') . '/' . $ymd . "/";
		$save_url =  'data/attachment/' . $ymd . "/";
	
		if(! file_exists($save_path))
		{
			mkdir($save_path);
		}
	
		$file_name = $uploadedFile->getBaseName();
		$file_ext = $uploadedFile->getExtension();
	
		// 新文件名
		$new_file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file_ext;
	
		$uploadedFile->saveAs($save_path . $new_file_name);
	
		return ['path' => $save_path, 'url' => $save_url, 'name' => $file_name, 'new_name' => $new_file_name, 'ext' => $file_ext];
	}
}
