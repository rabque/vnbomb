<?php
/**
 * Created by PhpStorm.
 * User: hungln
 * Date: 11/1/16
 * Time: 11:41 PM
 */
namespace App\Common;

use App\Helpers\AppHelper;
use Dwij\Laraadmin\Models\ModuleFieldTypes;
use Schema;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\LAFormMaker;
use Dwij\Laraadmin\Models\Module;

class FormMaker extends LAFormMaker
{
    /**
     * Print input field enclosed within form-group
     **/
    public static function input($module, $field_name, $default_val = null, $required2 = null, $class = 'form-control', $params = [])
    {
        // Check Field Write Aceess
        if(Module::hasFieldAccess($module->id, $module->fields[$field_name]['id'], $access_type = "write")) {

            $row = null;
            if(isset($module->row)) {
                $row = $module->row;
            }

            //print_r($module->fields);
            $label = $module->fields[$field_name]['label'];
            $field_type = $module->fields[$field_name]['field_type'];
            $unique = $module->fields[$field_name]['unique'];
            $defaultvalue = $module->fields[$field_name]['defaultvalue'];
            $minlength = $module->fields[$field_name]['minlength'];
            $maxlength = $module->fields[$field_name]['maxlength'];
            $required = $module->fields[$field_name]['required'];
            $popup_vals = $module->fields[$field_name]['popup_vals'];

            if($required2 != null) {
                $required = $required2;
            }

            $field_type = ModuleFieldTypes::find($field_type);

            $out = '<div class="form-group">';
            $required_ast = "";

            if(!isset($params['class'])) {
                $params['class'] = $class;
            }
            if(!isset($params['placeholder'])) {
                $params['placeholder'] = 'Enter '.$label;
            }
            if($minlength) {
                $params['data-rule-minlength'] = $minlength;
            }
            if($maxlength) {
                $params['data-rule-maxlength'] = $maxlength;
            }
            if($unique && !isset($params['unique'])) {
                $params['data-rule-unique'] = "true";
                $params['field_id'] = $module->fields[$field_name]['id'];
                $params['adminRoute'] = config('laraadmin.adminRoute');
                if(isset($row)) {
                    $params['isEdit'] = true;
                    $params['row_id'] = $row->id;
                } else {
                    $params['isEdit'] = false;
                    $params['row_id'] = 0;
                }
                $out .= '<input type="hidden" name="_token_'.$module->fields[$field_name]['id'].'" value="'.csrf_token().'">';
            }

            if($required && !isset($params['required'])) {
                $params['required'] = $required;
                $required_ast = "*";
            }

            switch ($field_type->name) {

                case 'File':
                    $out .= '<label for="'.$field_name.'" style="display:block;">'.$label.$required_ast.' :</label>';

                    if($default_val == null) {
                        $default_val = $defaultvalue;
                    }
                    // Override the edit value
                    if(isset($row) && isset($row->$field_name)) {
                        $default_val = $row->$field_name;
                    }
                    if(!is_numeric($default_val)) {
                        $default_val = 0;
                    }
                    $out .= Form::hidden($field_name, $default_val, $params);

                    if($default_val != 0) {
                        $upload = \App\Models\Upload::find($default_val);
                    }
                    if(isset($upload->id)) {
                        $out .= "<a class='btn btn-default btn_upload_file hide' file_type='file' selecter='".$field_name."'>Upload <i class='fa fa-cloud-upload'></i></a>
							<a class='uploaded_file' target='_blank' href='".url("files/".$upload->hash.DIRECTORY_SEPARATOR.$upload->name)."'><i class='fa fa-file-o'></i><i title='Remove File' class='fa fa-times'></i></a>";
                    } else {
                        $out .= "<a class='btn btn-default btn_upload_file' file_type='file' selecter='".$field_name."'>Upload <i class='fa fa-cloud-upload'></i></a>
							<a class='uploaded_file hide' target='_blank'><i class='fa fa-file-o'></i><i title='Remove File' class='fa fa-times'></i></a>";
                    }
                    break;

                case 'Files':
                    $out .= '<label for="'.$field_name.'" style="display:block;">'.$label.$required_ast.' :</label>';

                    if($default_val == null) {
                        $default_val = $defaultvalue;
                    }
                    // Override the edit value
                    if(isset($row) && isset($row->$field_name)) {
                        $default_val = $row->$field_name;
                    }
                    if(is_array($default_val)) {
                        $default_val = json_encode($default_val);
                    }

                    $default_val_arr = json_decode($default_val);

                    if(is_array($default_val_arr) && count($default_val_arr) > 0) {
                        $uploadIds = array();
                        $uploadImages = "";
                        foreach ($default_val_arr as $uploadId) {
                            $upload = \App\Models\Upload::find($uploadId);
                            if(isset($upload->id)) {
                                $uploadIds[] = $upload->id;
                                $fileImage = "";
                                if(in_array($upload->extension, ["jpg", "png", "gif", "jpeg"])) {
                                    $fileImage = "<img src='".url("files/".$upload->hash.DIRECTORY_SEPARATOR.$upload->name."?s=90")."'>";
                                } else {
                                    $fileImage = "<i class='fa fa-file-o'></i>";
                                }
                                $uploadImages .= "<a class='uploaded_file2' upload_id='".$upload->id."' target='_blank' href='".url("files/".$upload->hash.DIRECTORY_SEPARATOR.$upload->name)."'>".$fileImage."<i title='Remove File' class='fa fa-times'></i></a>";
                            }
                        }

                        $out .= Form::hidden($field_name, json_encode($uploadIds), $params);
                        if(count($uploadIds) > 0) {
                            $out .= "<div class='uploaded_files'>".$uploadImages."</div>";
                        }
                    } else {
                        $out .= Form::hidden($field_name, "[]", $params);
                        $out .= "<div class='uploaded_files'></div>";
                    }
                    $out .= "<a class='btn btn-default btn_upload_files' file_type='files' selecter='".$field_name."' style='margin-top:5px;'>Upload <i class='fa fa-cloud-upload'></i></a>";
                    break;


                case 'Image':
                case 'TextField':
                    $nameArr = array("logo","image","favicon");
                    if(in_array($field_name,$nameArr) || $field_type->name == "image"){
                        $out .= '<label for="'.$field_name.'" style="display:block;">'.$label.$required_ast.' :</label>';

                        if($default_val == null) {
                            $default_val = $defaultvalue;
                        }
                        // Override the edit value
                        if(isset($row) && isset($row->$field_name)) {
                            $default_val = $row->$field_name;
                        }
                        if(!is_numeric($default_val)) {
                            $default_val = 0;
                        }
                        //$out .= Form::hidden($field_name, $default_val, $params);

                        $idFile = time()."_img_".$field_name;
                        $idUpload = time()."_".$field_name;
                        $inputUpload = time()."_input_".$field_name;
                        $out .= "<div class=\"input-group\">
                                    <span class=\"input-group-btn\">
                                        <a class='btn btn-primary' id='$idUpload' file_type='image' data-input=\"$inputUpload\" onclick=\"uploadLfm('$idUpload')\" data-preview=\"{$idFile}\" selecter='".$field_name."'>
                                            Upload <i class='fa fa-cloud-upload'></i>
                                        </a>
                                    </span>
                                   
                                    ";
                        $image = "";
                        if(isset($row->id)) {
                            $out .= " <input id=\"$inputUpload\" name='$field_name' class=\"form-control\" type=\"text\" value='{$row->{$field_name}}' name=\"$field_name\">";
                            $image = AppHelper::thumbimg($row->{$field_name},array("html"=>true),array("id"=>$idFile,"link"=>array("class"=>"fancybox")));
                        }

                            $out .= "</div>
							<div class='uploaded_image'>
							$image
							</div>";

                    }



                    break;


            }
            $out .= '</div>';
            return $out;
        } else {
            return "";
        }
    }

}