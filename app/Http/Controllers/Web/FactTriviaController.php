<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\FactTrivia;

use App\Http\Requests\FactTrivia\CreateFactTriviaRequest;
use App\Http\Requests\FactTrivia\UpdateFactTriviaRequest;

class FactTriviaController extends Controller
{
    public function fact_trivia(Request $request) {
        if($request->ajax()) {

        }
    }

    public function create(Request $request) {

    }

    public function store(Request $request) {

    }

    public function edit(Request $request) {

    }

    public function update(Request $request) {

    }

    public function destroy(Request $request) {

    }
}
