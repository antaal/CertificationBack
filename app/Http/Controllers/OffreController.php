<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class OffreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Offre::all();
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
        $offre = new Offre();
        $request->validate([
            'titre'=>'required',
            'image'=>'required|image',
            'description'=>'required',
            
        ]);

        try{
            $imageName = Str::random().'.'.$request->image->getClientOriginalExtension();
            $image=Storage::disk('public')->putFileAs('offres/image', $request->image,$imageName);
            // return($image);
            $offre->titre=$request->titre;
            $offre->image=$image;
            $offre->description=$request->description;
            $offre->date_Lancement=$request->date_Lancement;
            $offre->fin_Depot=$request->fin_Depot;
           



            $offre->save();

            return response()->json([
                'message'=>'offres Created Successfully!!'
            ]);
        }catch(\Exception $e){
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'Something goes wrong while creating a offres!!'
            ],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $offre = Offre::findorfail($id);
        return response()->json($offre);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Offre  $offre
     * @return \Illuminate\Http\Response
     */
    public function edit(Offre $offre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Offre  $offre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offre $offre)
    {
        // $offre = Offre::findorfail($id);
        // $offre->update($request->all());
        // return response()->json($offre, 200);
        /////////////////////////////
        $request->validate([
            'title'=>'required',
            'image'=>'nullable',
            'description'=>'required'
            
        ]);

        try{

            $offre->fill($request->post())->update();

            if($request->hasFile('image')){

                // remove old image
                if($offre->image){
                    $exists = Storage::disk('public')->exists("offres/image/{$offre->image}");
                    if($exists){
                        Storage::disk('public')->delete("offres/image/{$offre->image}");
                    }
                }

                $imageName = Str::random().'.'.$request->image->getClientOriginalExtension();
                $image=Storage::disk('public')->putFileAs('offres/image', $request->image,$imageName);
                // $offre->titre=$request->titre;
                $offre->image=$image;
                // $offre->description=$request->description;
                // $offre->date_Lancement=$request->date_Lancement;
                // $offre->fin_Depot=$request->fin_Depot;
                $offre->save();
            }

            return response()->json([
                'message'=>'offres Updated Successfully!!'
            ]);

        }catch(\Exception $e){
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'Something goes wrong while updating a offres!!'
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offre  $offre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offre $offre)
    {
        // Offre::findorfail($id)->delete();
        // return response()->json(null, 204);
        ///////////////
        
        try {

            if($offre->image){
                $exists = Storage::disk('public')->exists("offres/image/{$offre->image}");
                if($exists){
                    Storage::disk('public')->delete("offres/image/{$offre->image}");
                }
            }

            $offre->delete();

            return response()->json([
                'message'=>'offres Deleted Successfully!!'
            ]);
            
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'Something goes wrong while deleting a offres!!'
            ]);
        }
    }
}
