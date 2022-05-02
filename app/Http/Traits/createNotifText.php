<?php

namespace App\Http\Traits;

use Carbon\Carbon;

trait createNotifText
{

    public function createNotifText($type, $user)
    {
        switch ($type) {
            case 'approved':
                $text = "<strong>Bine ai venit " . $user->username . "!</strong> </br> Contul tau a fost aprobat si acum poti folosi toate functiile site-ului! </br> Scopul acestui site este de a aduce aproape fotografii pe film din Romania si de a-i lasa sa isi impartaseasca fotografiile sau sa faca schimb de echipamente.
                </br> Ajuta-ne sa cream un mediu placut si raporteaza-ne utilizatorii care incalca regulile si problemele de functionalitate pe care le observi pe site.</br> Iti multumim! Mult succes!";
                break;
            case 'restricted':
                $rest_date = Carbon::parse($user->upl_rest_date)->format('d/m/Y') . ' ora 23:59';
                $text = "<strong>Atentie! Contul tau a fost restrictionat</strong> de la a mai adauga continut pana pe data de " . $rest_date . '. </br> Nu este permis adaugarea de fotografii care nu sunt realizate pe film, fotografii cu caracter obscen, violent sau care nu apartin utilizatorului.</br>Pentru a evita blocarea contului pe viitor incearca sa nu te abati de la regulile site-ului!';
                break;
            case 'muted':
                $mute_date = Carbon::parse($user->mute_date)->format('d/m/Y') . ' ora 23:59';
                $text = '<strong>Atentie! Contul tau a fost restrictionat</strong> si nu mai poti comenta pana la data ' . $mute_date . '. Alti utilizatori au raportat unul sau mai multe din comentariile tale.</br> Amenintarile si jignirile fara motiv nu sunt permise.</br> Te rugam sa respecti regulile site-ului si sa contribui la crearea unui mediu placut.';
                break;
            case 'unmuted':
                $text = 'Restrictia s-a ridicat si poti comenta din nou. Te rugam sa respecti pe viitor regulile site-ului. Iti multumim!';
                break;
            case 'unrestricted':
                $text = 'Restrictia s-a ridicat si poti adauga continut din nou. Te rugam sa respecti pe viitor regulile site-ului. Iti multumim!';
                break;
            default:
                $text = null;
        }
        return $text;
    }
}
