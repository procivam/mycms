<?php

namespace laravel\Http\Controllers\Backend;

use Illuminate\Http\Request;
use DB;
use laravel\Http\Requests;
use laravel\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * update sorting in DB
     * 
     * @param  Request $request
     * @return json_object
     */
    public function updateSort(Request $request)
    {
        $table = $request->input('table');
        $json  = $request->input('json');
        $data  = json_decode($json); 
        if (!$table OR !$data) {
            return $this->makeJson(['text' => 'Данные не получены', 'type' => 'warning'], true);
        }
        $this->saveRank($table, $data, 0);


        return $this->makeJson(['text' => 'Данные сохранены', 'type' => 'success', 'time' => 2], true);
    }

    private function saveRank($table, $data, $parentId)
    {
        foreach ($data as $key => $value) {
            // Set sort
            DB::update("UPDATE $table 
                SET sort = $key, parent_id = $parentId
                WHERE id = {$value->id}");

            if (property_exists($value, 'children')) {
                $listIds = array_map(function($array){ return $array->id; }, $value->children);
                // Set parent_id
                DB::update("UPDATE $table
                    SET parent_id = {$value->id}
                    WHERE id IN (".implode(',', $listIds).")"); 
                $this->saveRank($table, $value->children, $value->id);
            }
        }
    }


    /**
     * Create JSON object from Array $data and return.
     *
     * @param  Array  $data - data for answer. Must have "text" and "type" 
     * @return json_object  - answer
     */
    private function makeJson(Array $data, $smokeMessage = false)
    {
        if ($smokeMessage !== false) {
            $data = array_add($data, 'smoke', true);
        }
        return json_encode($data);
    }
}
