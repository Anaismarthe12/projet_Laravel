<!-- resources/views/people/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="profile-header">
            <h1>{{ $person->first_name }} {{ $person->last_name }}</h1>
            <p class="birth-date"><strong>Date de naissance :</strong> {{ $person->date_of_birth }}</p>
            <p class="birth-name"><strong>Nom de naissance :</strong> {{ $person->birth_name }}</p>
            <p class="middle-names"><strong>Prénoms intermédiaires :</strong> {{ $person->middle_names ?? 'Aucun' }}</p>
        </div>

        <div class="family-info">
            <h2>Parents :</h2>
            <ul class="family-list">
                @foreach($person->parents as $parent)
                    <li>{{ $parent->first_name }} {{ $parent->last_name }}</li>
                @endforeach
            </ul>

            <h2>Enfants :</h2>
            <ul class="family-list">
                @foreach($person->children as $child)
                    <li>{{ $child->first_name }} {{ $child->last_name }}</li>
                @endforeach
            </ul>
        </div>

        <!-- Formulaire pour calculer le degré de parenté -->
        <div class="degree-form">
            <form action="{{ route('people.degree', $person->id) }}" method="GET">
                <label for="target_id">Sélectionnez une personne pour calculer le degré de parenté :</label>
                <select name="target_id" id="target_id" class="select-person">
                    @foreach($people as $personOption)
                        <option value="{{ $personOption->id }}">{{ $personOption->first_name }} {{ $personOption->last_name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn-primary">Calculer le Degré</button>
            </form>
        </div>

        <!-- Affichage du résultat du degré de parenté -->
        @if(session('degree_result'))
            <div class="degree-box">
                <h3>🔍 Résultat du Calcul :</h3>
                <p><strong>Degré de parenté :</strong> {{ session('degree_result')['degree'] }}</p>
                <p><strong>Chemin de parenté :</strong></p>
                <ul class="path-list">
                    @foreach(session('degree_result')['path'] as $person_id)
                        @php $p = \App\Models\Person::find($person_id); @endphp
                        <li>{{ $p->first_name }} {{ $p->last_name }} <span class="id-tag">#{{ $p->id }}</span></li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <!-- CSS Global -->
    <style>
        /* Style global de la page */
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            background-color: #f4f4f9;
            color: #333;
            padding: 20px 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        /* En-tête du profil */
        .profile-header h1 {
            color: #007bff;
            font-size: 36px;
            margin-bottom: 15px;
        }

        .profile-header p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .birth-date, .birth-name, .middle-names {
            color: #555;
        }

        /* Informations de la famille (parents et enfants) */
        .family-info h2 {
            font-size: 24px;
            margin-top: 30px;
            color: #444;
        }

        .family-list {
            list-style: none;
            padding-left: 0;
        }

        .family-list li {
            font-size: 18px;
            background-color: #eaf1fb;
            padding: 10px;
            margin-bottom: 8px;
            border-radius: 4px;
            border-left: 4px solid #007bff;
        }

        /* Formulaire de calcul du degré de parenté */
        .degree-form {
            margin-top: 30px;
            background-color: #fafafa;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .degree-form label {
            font-size: 16px;
            margin-right: 10px;
        }

        .select-person {
            font-size: 16px;
            padding: 8px;
            margin-right: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .btn-primary {
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Résultat du calcul du degré de parenté */
        .degree-box {
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #f9f9f9;
            margin-top: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        .degree-box h3 {
            font-size: 22px;
            margin-bottom: 20px;
            color: #007bff;
        }

        .path-list {
            list-style: none;
            padding-left: 0;
        }

        .path-list li {
            margin-bottom: 8px;
            padding: 8px;
            background-color: #eaf1fb;
            border-left: 4px solid #007bff;
            border-radius: 4px;
        }

        .id-tag {
            background-color: #007bff;
            color: white;
            padding: 2px 6px;
            font-size: 0.85em;
            border-radius: 5px;
            margin-left: 10px;
        }
    </style>
@endsection
