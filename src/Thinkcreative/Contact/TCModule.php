<?php
/**
 * THIS FILE ALWAYS NEEDS ADDING AND THEN
 * CALLING WHEN USING THE FRAMEWORK.
 * 
 */
namespace Thinkcreative\Contact;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class TCModule extends Model
{

    protected $table = 'modules';


    public static function AddModule($name, $showinmenu = true) {
        $module = new Self;
        $module->name = $name;
        $module->show_in_menu = $showinmenu;
        $module->save();
    }
}
