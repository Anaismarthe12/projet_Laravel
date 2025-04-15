<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'birth_name',
        'middle_names',
        'date_of_birth',
        'created_by',
    ];

    // Relation avec l'utilisateur créateur
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relations pivot : enfants (ce que cette personne est parent de)
    public function children()
    {
        return $this->belongsToMany(
            Person::class,
            'relationships',
            'parent_id',
            'child_id'
        )->withPivot('parent_id', 'child_id');
    }

    // Relations pivot : parents (ce que cette personne est l’enfant de)
    public function parents()
    {
        return $this->belongsToMany(
            Person::class,
            'relationships',
            'child_id',
            'parent_id'
        )->withPivot('parent_id', 'child_id');
    }

    /**
     * Renvoie uniquement le degré de parenté (sans le chemin) entre la personne courante et une cible.
     * Retourne false si le degré dépasse 25 ou si aucune relation n’est trouvée.
     */
   // Modèle Person
// Modèle Person
public function getDegreeAndPathWith($target_person_id)
{
    // Liste des personnes déjà visitées pour éviter les boucles infinies
    $visited = [];
    // Initialisation de la queue pour une recherche en largeur [person_id, degree, path]
    $queue = [[$this->id, 0, []]];  // Cette personne commence avec un degré de 0 et un chemin vide

    // Boucle de recherche en largeur
    while (!empty($queue)) {
        // Déqueue un élément (la personne, son degré, et le chemin suivi)
        [$currentId, $degree, $path] = array_shift($queue);

        // Si la personne courante est la personne cible, on renvoie le degré et le chemin
        if ($currentId == $target_person_id) {
            return [
                'degree' => $degree,
                'path' => array_merge($path, [$currentId]), // Ajoute la personne cible au chemin
            ];
        }

        // Si la personne a déjà été visitée, on continue avec la prochaine
        if (in_array($currentId, $visited)) continue;

        // Ajout de la personne courante à la liste des visitées
        $visited[] = $currentId;

        // Récupération des relations (enfants et parents)
        $person = Person::find($currentId);
        if (!$person) continue;  // Si la personne n'existe pas, on passe à la suivante

        // Charger les relations
        $person->load('children', 'parents');

        // Ajouter les enfants à la queue avec un degré incrémenté et le chemin mis à jour
        foreach ($person->children as $child) {
            if (!in_array($child->id, $visited)) {
                $queue[] = [$child->id, $degree + 1, array_merge($path, [$currentId])];  // Mettre à jour le chemin
            }
        }

        // Ajouter les parents à la queue avec un degré incrémenté et le chemin mis à jour
        foreach ($person->parents as $parent) {
            if (!in_array($parent->id, $visited)) {
                $queue[] = [$parent->id, $degree + 1, array_merge($path, [$currentId])];  // Mettre à jour le chemin
            }
        }

        // Si le degré dépasse 25, on arrête la recherche
        if ($degree >= 25) {
            return false;  // On ne calcule plus après 25 niveaux
        }
    }

    // Si aucune relation n'est trouvée, on renvoie false
    return false;
}


}
