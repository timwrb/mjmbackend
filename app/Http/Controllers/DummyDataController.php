<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DummyDataController extends Controller
{
    public function getData($id)
    {
        // Dummy-Daten für den gegebenen $id-Wert erstellen
        $data = [
            'id' => $id,
            'title' => "Aushilfe Shell Tankstelle 538€ Basis (m / w / d)",
            'date' => "14 März, 2024",
            'city' => "Würzburg",
            'street' => "Schweinfurter Straße",
            'salary' => "12,50€",
            'company' => "Shell Tankstellen",
            'content' => "Das hier ist der Content.\nHier ist eine Aufzählung:\n- das ist der erste Punkt\n- der 2. Punkt ist hier\n- und das ist der letzte\n\nDas ist alles Dummy Data hier, aber sollte reichen um es zu veranschaulichen",
        ];

        // Daten im JSON-Format zurückgeben
        return response()->json($data);
    }
}
