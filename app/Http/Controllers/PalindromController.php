<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PalindromController extends Controller
{
    // Palindrome
    public function Palindrome(Request $request)
    {
        // mendapatkan word yg dikirim
        $Word = $request->word;

        if ($Word == null) {
            return response()->json([
                "code" => 400,
                "message" => "Not value"
            ]);
        }
        $WordStr = strtolower($Word);

        $StraArray = [];
        $StraArray = str_split($WordStr);

        $Index = sizeof($StraArray);
        $Reverse = [];

        for ($i = $Index - 1; $i >= 0; $i--) {
            $Reverse[] = $StraArray[$i];
        }
        if ($StraArray == $Reverse) {
            $message = "Palindrome";
        } else {
            $message = "Not palindrome";
        }

        return response()->json([
            "code" => 200,
            "message" => $message
        ]);
    }
}
