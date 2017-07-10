<?php

namespace App\Http\Controllers;

use App\Models\Petition;
use App\Models\PetitionsEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class PetitionsController extends Controller
{
    public function index()
    {
        $petitions = Petition::all()->toArray();

        return response()->json($petitions);
    }

    public function show($id)
    {
        $petition = Petition::with(['petitions_entries' => function ($query) {
            Auth::check() ?: $query->addSelect('petition_id', 'first_name', 'last_name');
        }])
        ->where('id', $id)
        ->first();

        if ($petition) {
            return response()->json($petition);
        } else {
            return response()->json(
                ['error' => 'Could not find petition']
            );
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'petition' => 'required',
            'email' => 'required|email',
            'firstName' => 'required|alpha',
            'lastName' => 'required|alpha',
            'gender' => 'required',
        ]);

        $validator->validate();

        $petition = Petition::find($request->petition);

        if (!$petition) {
            return response()->json(['error' => 'Could not find petition'], 404);
        }

        $petitionEntry = $petition->petitions_entries()->create([
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'gender' => $request->gender
        ])->toArray();

        if ($petitionEntry) {
            return response()->json( Auth::check() ?  $petitionEntry : array_only($petitionEntry, ['first_name', 'last_name']));
        }

        return response()->json(['error' => 'Unknown error'], 501);
    }
}
