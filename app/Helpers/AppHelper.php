<?php
/**
 * Created by PhpStorm.
 * User: hungln
 * Date: 10/30/16
 * Time: 2:53 AM
 */

namespace App\Helpers;


use App\Common\Utility;
use App\Models\AppModules;
use App\Models\FAMenu;
use Dwij\Laraadmin\Helpers\LAHelper;
use Dwij\Laraadmin\Models\Module;

class AppHelper extends LAHelper
{
    public static function print_menu($menu, $active = false) {
        $childrens = \Dwij\Laraadmin\Models\Menu::where("parent", $menu->id)->orderBy('hierarchy', 'asc')->get();

        $treeview = "";
        $subviewSign = "";
        if(count($childrens)) {
            $treeview = " class=\"treeview\"";
            $subviewSign = '<i class="fa fa-angle-left pull-right"></i>';
        }
        $active_str = '';
        if($active) {
            $active_str = 'class="active"';
        }

        $str = '<li'.$treeview.' '.$active_str.'><a href="'.url(config("laraadmin.adminRoute") . '/' . $menu->url ) .'"><i class="fa '.$menu->icon.'"></i> <span>'.LAHelper::real_module_name($menu->name).'</span> '.$subviewSign.'</a>';

        if(count($childrens)) {
            $str .= '<ul class="treeview-menu">';

            foreach($childrens as $children) {
                $temp_module_obj = Module::get($children->name);
                if(!empty($temp_module_obj)){
                    $access = AppModules::hasAccessModule($temp_module_obj->id);
                    if($access){
                        $str .= LAHelper::print_menu($children);
                    }
                }else{
                    $str .= '<li'.$treeview.' '.$active_str.'><a href="'.url(config("laraadmin.adminRoute") . $children->url ) .'"><i class="fa '.$children->icon.'"></i> <span>'.LAHelper::real_module_name($children->name).'</span></a>';
                }


            }
            $str .= '</ul>';
        }
        $str .= '</li>';
        return $str;
    }

    public static function print_menu_editor($menu) {
        $editing = \Collective\Html\FormFacade::open(['route' => [config('laraadmin.adminRoute').'.famenus.destroy', $menu->id], 'method' => 'delete', 'style'=>'display:inline']);
        $editing .= '<button class="btn btn-xs btn-danger pull-right"><i class="fa fa-times"></i></button>';
        $editing .= \Collective\Html\FormFacade::close();
        if($menu->type != "module") {
            $info = (object) array();
            $info->id = $menu->id;
            $info->name = $menu->name;
            $info->url = $menu->url;
            $info->type = $menu->type;
            $info->position = $menu->position;
            $info->lang = $menu->lang;

            $editing .= '<a class="editMenuBtn btn btn-xs btn-success pull-right" info=\''.json_encode($info).'\'><i class="fa fa-edit"></i></a>';
        }
        $str = '<li class="dd-item dd3-item" data-id="'.$menu->id.'">
			<div class="dd-handle dd3-handle"></div>
			<div class="dd3-content">'.$menu->name.' '.$editing.'</div>';

        $childrens =  FAMenu::where("parent", $menu->id)->orderBy('hierarchy', 'asc')->get();

        if(count($childrens) > 0) {
            $str .= '<ol class="dd-list">';
            foreach($childrens as $children) {
                $str .= self::print_menu_editor($children);
            }
            $str .= '</ol>';
        }
        $str .= '</li>';
        return $str;
    }

    public static function print_menu_tree($menu){
        if(empty($menu)) return false;
        $out = "";
        foreach ($menu as $item) {
            $space = "";
            if($item["level"]>0){
                for ($i=0;$i<$item["level"];$i++) {
                    $space .= "-";
                }
            }

            $out .= "<li>{$space} {$item["name"]} <a cate_id='{$item["id"]}' class=\"addCateMenu pull-right\"><i class=\"fa fa-plus\"></i></a> </li>";
        }

        return $out;
    }

    public static function printTree($data){
        if(empty($data)) return false;
        $out = array();
        foreach ($data as $item) {
            $space = "";
            if($item["level"]>0){
                for ($i=0;$i<$item["level"];$i++) {
                    $space .= "-";
                }
            }
            $out[$item["id"]] = $space. " ". $item["name"];
        }

        if(!empty($out)){
            $out[0] = "";
            ksort($out);
        }

        return $out;
    }

    public static function thumbimg($src, $options = array(),$attributes = array()){
        if(empty($src)) return "";
        $options["w"] = \Config::get("constants.IMG_WITH");
        //$options["h"] = \Config::get("constants.IMG_HEIGHT");
        $h = 0;
        if(!empty($options["w"])){
            $w = $options["w"];
        }
        if(!empty($options["h"])){
            $h = $options["h"];
        }
        $imageUrl = url("showImage/$w/$h/$src");
        $origImg = url($src);
        $html = (isset($options["html"]) && $options["html"] == true)?true:false;
        if($html == false){
            return $imageUrl;
        }else{
            $attribute = $attributeLink  = "";
            if(!empty($attributes["link"])){
                foreach ($attributes["link"] as $key=>$value) {
                    $attributeLink .= " $key='$value'";
                }
                unset($attributes["link"]);
            }
            if(!empty($attributes)){
                foreach ($attributes as $key=>$value) {
                    $attribute .= " $key='$value'";
                }
            }

            return "<div class='uploaded_image'>
                        <a href='{$origImg}' $attributeLink>
							<img $attribute src='{$imageUrl}' >
							</a>
							</div>";

        }


    }


}