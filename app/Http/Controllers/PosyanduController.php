<?php

namespace App\Http\Controllers;

use App\Models\Posyandu;
use Illuminate\Http\Request;

class PosyanduController extends Controller
{
    function getAge($date) {
        return intval(date('Y', time() - strtotime($date))) - 1970;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $items = $user->posyandus;
        $age = $this->getAge($user->baby_birthdate);

        return view('laravel-examples/posyandu-card', ['items' => $items, 'age' => $age]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        for($i = 0; $i < 12; $i++) {
            $posyandu = Posyandu::findOrFail($request->id[$i]);
            $posyandu->update([
                'date'     => $request->date[$i],
                'weight'     => $request->weight[$i],
                'height'     => $request->height[$i],
                'immunization'     => $request->immunization[$i],
                'vit_a'     => $request->vit_a[$i],
            ]);
        }

        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
