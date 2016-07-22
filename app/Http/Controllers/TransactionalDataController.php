<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class TransactionalDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rowsData = DB::table('transactions')->lists('data');
        $rowsId = DB::table('transactions')->lists('id');
        $rowsProcessedTime = DB::table('transactions')->lists('processed_time');

        //REAL DATA
        //$allData = DB::table('transactions')->lists('data', 'id');
        //dump($allData);

        $arrayMain = array();
        for ($i = 0; $i < count($rowsData); $i++) {

            if ($rowsData[$i] != null && $rowsData[$i] != "" && $rowsData[$i] != "null") {
                $decode = json_decode($rowsData[$i]);

                foreach ($decode as $key => $value) {
                    $arrayValues = array();

                    //When the key does not exists - add it and add empty array value

                    //For every available column create array with name of the column as key
                    //and array as value; The array in the value has key ID (bigserial) and
                    //the required value for value.
                    if ($key == "request_data") {
                        if (!array_key_exists($key, $arrayMain)) {
                            $arrayMain[$key] = [];
                            foreach ($value as $k => $v) {
                                $arrayValues[$rowsId[$i]] = $v;
                            }
                            $arrayMain[$key] = $arrayValues;
                        } else {
                            $arrayValues = $arrayMain[$key];
                            foreach ($value as $k => $v) {
                                $arrayValues[$rowsId[$i]] = $v;
                            }
                            $arrayMain[$key] = $arrayValues;
                        }
                    } else {
                        if (!array_key_exists($key, $arrayMain)) {
                            $arrayValues[$rowsId[$i]] = $value;
                            $arrayMain[$key] = $arrayValues;
                        } else {

                            $arrayValues = $arrayMain[$key];
                            $arrayValues[$rowsId[$i]] = $value;

                            $arrayMain[$key] = $arrayValues;
                        }
                    }
                }
            }
            //There is no need for the nulls and empty rows
        }

        /*foreach($arrayMain as $key => $value) {
            echo "-> $key <br />";
            foreach ($value as $key2 => $val2) {
                echo "&nbsp &nbsp -> $key2 | $val2 <br />";
            }
        }*/

        //TIMESTAMP DATA

        $arrayProcessedTime = array();
        for ($i = 0; $i < count($rowsProcessedTime); $i++) {
            $arrayProcessedTime[$rowsId[$i]] = $rowsProcessedTime[$i];
        }

        /*for($i=0; $i<count($rowsProcessedTime); $i++) {
            echo $rowsId[$i] . "| " . $arrayProcessedTime[$rowsId[$i]] . "<br />";
        }*/

        return view('trans.index', compact("rowsId", "arrayMain", "arrayProcessedTime"));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
