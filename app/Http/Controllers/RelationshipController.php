<?php

namespace App\Http\Controllers;

use App\Models\Relationship;
use Illuminate\Http\Request;

class RelationshipController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $new_relation = Relationship::create([
            'publisher1_id' => $request->publisher1,
            'publisher2_id' => $request->publisher2,
            'reltype' => $request->reltype
        ]);
        $relType = $request->reltype;

        if($relType == "Block"){
            return redirect()->route('breaking_news');
        }
        elseif($relType == "Pending"){
            return redirect()->route('breaking_news');
        }

        
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Relationship  $relationship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Relationship $relationship)
    {
        return redirect()->route('breaking_news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Relationship  $relationship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Relationship $relationship)
    {
        return redirect()->route('breaking_news');
    }
}
