@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-6 py-8">
        <h1 class="text-3xl font-semibold mb-6 text-indigo-700">Mon profil</h1>

        <div class="mb-6">
            <p><strong>Nom :</strong> {{ $user->name }}</p>
            <p><strong>Email :</strong> {{ $user->email }}</p>
        </div>

        <form method="POST" action="{{ route('profile.update') }}" class="bg-white p-6 rounded-lg shadow-lg">
            @csrf
            @method('PATCH')

            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('name')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('email')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn-submit">
                Mettre à jour
            </button>
        </form>
    </div>
@endsection

<style>
    /* Titre */
    h1 {
        color: #4F46E5;
        font-weight: 600;
    }

    /* Champs de formulaire */
    input {
        background-color: #fff;
        padding: 0.75rem;
        border-radius: 0.75rem;
        border: 1px solid #d1d5db;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        transition: border-color 0.3s ease;
        font-size: 1rem;
        color: #4B5563;
    }

    input:focus {
        border-color: #4F46E5;
        box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.2);
        outline: none;
    }

    /* Labels */
    label {
        font-weight: 500;
        color: #6B7280;
    }

    /* Bouton de soumission */
    .btn-submit {
        display: inline-block;
        padding: 0.75rem 1.5rem;
        background-color: #4F46E5;
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
        box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.5);
    }

    /* Espacement entre les éléments */
    .mb-6 {
        margin-bottom: 1.5rem;
    }

    /* Messages d'erreur */
    .text-red-500 {
        color: #ef4444;
    }

    .text-xs {
        font-size: 0.75rem;
    }
</style>
