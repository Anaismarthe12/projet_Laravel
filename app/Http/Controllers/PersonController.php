<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PersonController extends Controller
{
    // Affiche la liste de toutes les personnes
    public function index()
    {
        $people = Person::all(); // Récupère toutes les personnes depuis la base de données
        return view('people.index', compact('people')); // Passe la variable $people à la vue
    }

    // Affiche le formulaire de création
    public function create()
    {
        return view('people.create'); // Retourne la vue de création
    }

    // Enregistre une nouvelle personne
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_name' => 'nullable|string|max:255',
            'middle_names' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
        ]);

        // Préparation des données avant de les enregistrer
        $validated['created_by'] = Auth::id();
        $validated['first_name'] = ucfirst(strtolower($validated['first_name']));
        $validated['last_name'] = strtoupper($validated['last_name']);
        $validated['birth_name'] = $validated['birth_name'] ?? $validated['last_name'];

        // Si des prénoms intermédiaires sont fournis, les formater
        if (!empty($validated['middle_names'])) {
            $validated['middle_names'] = collect(explode(',', $validated['middle_names']))
                ->map(fn($name) => ucfirst(strtolower(trim($name))))
                ->implode(', ');
        } else {
            $validated['middle_names'] = null;
        }

        // Crée la nouvelle personne dans la base de données
        Person::create($validated);

        // Redirige avec un message de succès
        return redirect()->route('people.index')->with('success', 'Personne créée avec succès !');
    }

    // Affiche les détails d'une personne
    public function show($id)
    {
        // Récupérer la personne avec ses parents et enfants
        $person = Person::with(['parents', 'children'])->findOrFail($id);

        // Récupérer toutes les personnes pour le calcul du degré
        $people = Person::all();

        // Passer à la vue les données nécessaires
        return view('people.show', compact('person', 'people'));
    }

    // Méthode pour calculer le degré de parenté entre deux personnes
    public function degree(Request $request, $personId)
    {
        // Validation des données
        $request->validate([
            'target_id' => 'required|integer|exists:people,id',
        ]);

        // Recherche la personne par son ID
        $person = Person::findOrFail($personId);

        // Récupère l'ID de la personne cible (la personne pour laquelle on veut calculer le degré)
        $targetId = $request->input('target_id');

        // Log des performances pour l'analyse
        DB::enableQueryLog();
        $timestart = microtime(true);

        // Appel de la méthode pour obtenir le degré et le chemin de parenté
        $result = $person->getDegreeAndPathWith($targetId);

        // Log des requêtes et du temps de calcul
        logger()->info('Degré + chemin calculé', [
            'result' => $result,
            'time' => microtime(true) - $timestart,
            'queries' => count(DB::getQueryLog()),
        ]);

        // Redirige avec le résultat du calcul de degré
        return redirect()
            ->route('people.show', $personId)
            ->with('degree_result', $result)
            ->with('target_id', $targetId);
    }

    // Fonction de test de calcul de degré entre deux personnes spécifiques
    public function testDegree()
    {
        DB::enableQueryLog();
        $timestart = microtime(true);

        // Test avec les IDs 84 et 1265 comme exemple
        $person = \App\Models\Person::findOrFail(84);
        $result = $person->getDegreeAndPathWith(1265);

        $time = microtime(true) - $timestart;
        $queries = count(DB::getQueryLog());

        if (!$result) {
            return [
                'degree' => 'non trouvé ou > 25',
                'time' => $time,
                'nb_queries' => $queries
            ];
        }

        $pathNames = [];
        foreach ($result['path'] as $id) {
            $p = \App\Models\Person::find($id);
            $pathNames[] = "{$p->first_name} {$p->last_name} (ID: {$p->id})";
        }

        return [
            'degree' => $result['degree'],
            'path_ids' => $result['path'],
            'path_names' => $pathNames,
            'time' => $time,
            'nb_queries' => $queries
        ];
    }
}
