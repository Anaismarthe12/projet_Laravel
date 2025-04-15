@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold mb-6 text-indigo-700">Liste des personnes</h1>

        <!-- Bouton ou lien pour créer une nouvelle personne -->
        <a href="{{ route('people.create') }}" class="btn-create mb-6">✨ Ajouter une nouvelle personne</a>

        <ul class="space-y-6 mt-6">
            @foreach($people as $personOption)
                <li class="person-item hover:shadow-xl hover:bg-indigo-50 transition-shadow duration-300 p-4 rounded-lg">
                    <a href="{{ route('people.show', $personOption->id) }}" class="text-indigo-600 hover:text-indigo-800 font-semibold text-lg">
                        {{ $personOption->first_name }} {{ $personOption->last_name }}
                    </a>
                    <div class="text-sm text-gray-600 mt-2">
                        <span class="font-medium text-gray-900">Créé par : </span>{{ $personOption->creator->name ?? 'Inconnu' }}
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection

<style>
    /* Style pour le titre */
    h1 {
        color: #4F46E5; /* Couleur indigo dynamique */
        font-weight: 600;
    }

    /* Bouton "Ajouter une nouvelle personne" */
    .btn-create {
        display: inline-block;
        padding: 0.75rem 1.5rem;
        background-color: #4F46E5; /* Couleur indigo */
        color: white;
        border-radius: 1rem;
        font-weight: 600;
        text-align: center;
        transition: background-color 0.3s ease-in-out, transform 0.3s ease;
        text-decoration: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-create:hover {
        background-color: #4338CA; /* Couleur plus foncée au survol */
        transform: translateY(-2px); /* Effet de bouton flottant */
    }

    .btn-create:focus {
        outline: none;
        box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.5); /* Focus avec une ombre plus marquée */
    }

    /* Style pour les éléments de la liste des personnes */
    .person-item {
        background-color: #fff;
        padding: 1.25rem;
        border-radius: 1rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
        transition: box-shadow 0.3s ease, background-color 0.3s ease-in-out;
    }

    .person-item:hover {
        background-color: #E0E7FF; /* Couleur de fond douce au survol */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15), 0 1px 3px rgba(0, 0, 0, 0.12); /* Ombre plus marquée */
    }

    .person-item a {
        color: #4F46E5; /* Couleur indigo pour les liens */
        transition: color 0.3s ease-in-out;
    }

    .person-item a:hover {
        color: #4338CA; /* Couleur plus foncée au survol */
    }

    /* Style pour la section "Créé par" */
    .person-item .text-sm {
        color: #6B7280; /* Gris pour la petite description */
        margin-top: 0.5rem;
    }

    .person-item .font-medium {
        font-weight: 500;
        color: #4B5563; /* Gris pour le texte "Créé par" */
    }

    /* Espacement entre les éléments */
    .space-y-6 {
        margin-bottom: 1.5rem;
    }

</style>
