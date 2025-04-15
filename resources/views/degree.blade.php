<!-- resources/views/degree.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Calcul du Degré de Parenté</h1>

    <!-- Formulaire pour sélectionner deux personnes -->
    <form action="{{ route('people.degree', $person->id) }}" method="GET">
        @csrf
        <div>
            <label for="target_id">Sélectionner une personne cible :</label>
            <select name="target_id" id="target_id">
                @foreach($people as $personOption)
                    <option value="{{ $personOption->id }}">{{ $personOption->first_name }} {{ $personOption->last_name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Calculer le Degré</button>
    </form>

    <!-- Affichage du résultat du degré et du chemin -->
    @if(session('degree_result'))
        <h2>Résultat</h2>
        <p>Le degré de parenté est : {{ session('degree_result')['degree'] }}</p>
        <p>Chemin de parenté :</p>
        <ul>
            @foreach(session('degree_result')['path'] as $person_id)
                <li>{{ \App\Models\Person::find($person_id)->first_name }} {{ \App\Models\Person::find($person_id)->last_name }}</li>
            @endforeach
        </ul>
    @endif
@endsection
