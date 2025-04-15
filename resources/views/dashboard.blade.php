@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow sm:rounded-lg custom-card">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium custom-title">
                    Tableau de bord
                </h3>
                <p class="mt-1 max-w-2xl text-sm custom-description">
                    Bienvenue sur votre tableau de bord !
                </p>
            </div>

            <!-- Lien vers la page des personnes avec un bouton stylisé -->
            <div class="px-4 py-5 sm:px-6">
                <a href="{{ route('people.index') }}" class="custom-button">
                    Voir la liste des personnes
                </a>
            </div>
        </div>
    </div>
@endsection

<style>
    /* Custom styles */
    .custom-card {
        background-color: #ffffff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
        border-radius: 0.375rem;
    }

    .custom-title {
        font-size: 1.125rem;
        font-weight: 500;
        color: #1f2937; /* Dark gray */
    }

    .custom-description {
        color: #6b7280; /* Gray */
    }

    .custom-button {
        display: inline-block;
        padding: 0.5rem 1.25rem;
        background-color: #4f46e5; /* Indigo */
        color: #ffffff;
        border-radius: 0.375rem;
        font-weight: 600;
        text-align: center;
        transition: background-color 0.2s;
    }

    .custom-button:hover {
        background-color: #4338ca; /* Darker indigo on hover */
    }

    .custom-button:focus {
        outline: none;
        box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.5);
    }

    .custom-button:active {
        background-color: #3730a3; /* Even darker indigo on active */
    }
</style>
