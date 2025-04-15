@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold mb-6 text-indigo-700">Créer une nouvelle personne</h1>

        <form action="{{ route('people.store') }}" method="POST">
            @csrf  <!-- CSRF token pour la sécurité -->

            <div class="mb-6">
                <label for="first_name" class="block text-sm font-medium text-gray-700">Prénom</label>
                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('first_name')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="last_name" class="block text-sm font-medium text-gray-700">Nom de famille</label>
                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('last_name')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="birth_name" class="block text-sm font-medium text-gray-700">Nom de naissance</label>
                <input type="text" name="birth_name" id="birth_name" value="{{ old('birth_name') }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <div class="mb-6">
                <label for="middle_names" class="block text-sm font-medium text-gray-700">Prénoms intermédiaires</label>
                <input type="text" name="middle_names" id="middle_names" value="{{ old('middle_names') }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <div class="mb-6">
                <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date de naissance</label>
                <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <button type="submit" class="btn-submit">
                Créer la personne
            </button>
        </form>
    </div>
@endsection

<style>
    /* Style pour le titre */
    h1 {
        color: #4F46E5; /* Couleur indigo dynamique */
        font-weight: 600;
    }

    /* Style pour les champs de formulaire */
    input, select, textarea {
        background-color: #fff;
        padding: 0.75rem;
        border-radius: 0.75rem;
        border: 1px solid #d1d5db;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        transition: border-color 0.3s ease;
        font-size: 1rem;
        color: #4B5563;
    }

    input:focus, select:focus, textarea:focus {
        border-color: #4F46E5;
        box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.2);
        outline: none;
    }

    label {
        font-weight: 500;
        color: #6B7280;
    }

    /* Bouton de soumission du formulaire */
    .btn-submit {
        display: inline-block;
        padding: 0.75rem 1.5rem;
        background-color: #4F46E5; /* Couleur indigo */
        color: white;
        border-radius: 1rem;
        font-weight: 600;
        text-align: center;
        transition: background-color 0.3s ease-in-out, transform 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border: none;
        cursor: pointer;
    }

    .btn-submit:hover {
        background-color: #4338CA;
        transform: translateY(-2px); /* Effet de bouton flottant */
    }

    .btn-submit:focus {
        outline: none;
        box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.5); /* Focus avec une ombre plus marquée */
    }

    /* Messages d'erreur */
    .text-red-500 {
        color: #ef4444;
    }

    .text-xs {
        font-size: 0.75rem;
    }

    /* Espacement entre les éléments */
    .mb-6 {
        margin-bottom: 1.5rem;
    }
</style>
