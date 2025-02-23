<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{

    // Nomor 3 GET
    public function Index()
    {
        return response()->json(
            "Hello Go Developer"
        );
    }

    // Nomor 3 GET/language
    public function Language()
    {
        $data = [
            "language" => "C",
            "appeared" => 1972,
            "created" => [
                "Dennis Ritchie"
            ],
            "functional" => true,
            "object-oriented" => false,
            "relation" => [
                "influenced-by" => [
                    "B",
                    "ALGOL 68",
                    "Assembly",
                    "FORTRAN"
                ],
                "influences" => [
                    "C++",
                    "Objective-C",
                    "C#",
                    "Java",
                    "JavaScript",
                    "PHP",
                    "Go"
                ]
            ]
        ];


        return response()->json(
            [
                "code" => 200,
                "message" => "success",
                "data" => $data

            ]
        );
    }

    // GET All Language
    public function IndexLanguage()
    {
        return response()->json(Session::all());
    }
    // GET Language
    public function GetLanguage($id)
    {
        $languages =  Session::get('language');

        $Data = array_filter($languages, function ($lang) use ($id) {
            return $lang["id"] == $id;
        });
        return response()->json(array_values($Data));
    }

    // Create Language
    public function Created(Request $request)
    {

        // Ambil data language 
        $languages = session("language", []);
        // membuat urutan id
        $Id = count($languages) == null ? 1 : count($languages) + 1;


        $NewLag = [
            "id" => $Id,
            "language" => $request->language,
            "appeared" => $request->appeared,
            "created" => $request->created,
            "functional" => $request->functional,
            "object-oriented" => $request->input("object-oriented"),
            "relation" => $request->relation
        ];

        $languages[] = $NewLag;
        Session::put("language", $languages);

        return response()->json([
            "code" => 200,
            "message" => "success",
        ]);
    }
    // Update data language
    public function Updated(Request $request, $id)
    {

        $languages =  Session::get('language');

        
        $Data = collect($languages)->search(function ($lang) use ($id) {
            return $lang['id'] == $id;
        });

        $languages[$Data]["language"] = $request->language;
        $languages[$Data]["appeared"] = $request->appeared;
        $languages[$Data]["created"] = $request->created;
        $languages[$Data]["functional"] = $request->functional;
        $languages[$Data]["object-oriented"] = false;
        $languages[$Data]["relation"] = $request->relation;

        Session::put("language", $languages);


        return response()->json([
            "code" => 200,
            "message" => "success",
        ]);
    }

    // Delete data language
    public function Deleted(Request $request, $id)
    {
        $languages =  Session::get('language');


        $Data = array_filter($languages, function ($lang) use ($id) {
            return $lang["id"] != $id;
        });

        if (count($Data) == count($languages)) {
            return response()->json([
                "code" => 404,
                "message" => "Data not found",
            ]);
        }

        Session::put("language", $Data);


        return response()->json([
            "code" => 200,
            "message" => "success",
        ]);
    }
}
