<?php
/**
 * Created by PhpStorm.
 * User: Jorge
 * Date: 05/02/2016
 * Time: 17:51
 */

namespace JJSquad\EnumerableField;

use Illuminate\Support\Facades\DB;


trait EnumerableField
{
    public static function getEnumFromField($name){
        $instance = new static; // create an instance of the model to be able to get the table name
        $type = DB::select( DB::raw('SHOW COLUMNS FROM '.$instance->getTable().' WHERE Field = "'.$name.'"') )[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach(explode(',', $matches[1]) as $value){
            $v = trim( $value, "'" );
            $enum[] = $v;
        }
        return $enum;
    }
}