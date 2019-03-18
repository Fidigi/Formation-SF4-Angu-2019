<?php
header('Content-Type: text/html; charset=utf-8');

// Vous recevez 51 cartes (il en manque donc une) trouvez celle manquante !
// les cartes sont nommé comme suit (tous les caractères alpha sont en MAJUSCULE) :
// VALEUR : 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, V, D, R (V= Valet, D = Dame, R = Roi) 
// COULEUR : P,C,T,K (P = Pique, C = Coeur, T = Trèfle, K = Carreau)
// Les cartes sont donc nommées : VALEUR+COULEUR
// Exemple = 1P = As de Pique, VK = Valet de Carreau
// le retour doit être du même type (VALEUR+COULEUR)
/*
function laCarteManquante($aAllCards) {
	//$sCardName = '';
	$valeur = ['1','2','3','4','5','6','7','8','9','10','V','D','R'];
	$couleur = ['P','C','T','K'];

	foreach ($valeur as $v) {
		foreach ($couleur as $c) {
			if (!in_array($v.$c,$aAllCards)) return $v.$c;
		}
	}

	// VOTRE CODE ICI (
	// vous pouvez faire un var_dump pour controler l'argument en entrée

	//return $sCardName;
}


// Pas le droit de toucher à ça :-p
eval(base64_decode('JGExPVtdOyRhMz1leHBsb2RlKCctJywnUCxDLFQsSy0xLDIsMyw0LDUsNiw3LDgsOSwxMCxWLEQsUicpOyRhMj1leHBsb2RlKCcsJywkYTNbMF0pOyRzMj1leHBsb2RlKCcsJywkYTNbMV0pO2ZvcmVhY2goKGFycmF5KSRhMiBhcyAkczEpe2ZvcmVhY2goKGFycmF5KSRzMiBhcyAkczMpeyRhMVtdPSRzMy4kczE7fX11bnNldCgkYTFbcmFuZCgwLGNvdW50KCRhMSktMSldKTtzaHVmZmxlKCRhMSk7aWYoY3RybChsYUNhcnRlTWFucXVhbnRlKCRhMSkpKXtwcmludCBiYXNlNjRfZGVjb2RlKCdWbTkxY3lCaGRtVjZJSExEcVhWemMya2dJU0JDYVdWdUlFcHZkY09wSUNFaElRPT0nKTt9ZWxzZXtwcmludCBiYXNlNjRfZGVjb2RlKCdWbTkxY3lCaGRtVjZJTU9wWTJodmRjT3BJQ0VnUTI5dWRHbHVkV1Y2TGc9PScpO31mdW5jdGlvbiBjdHJsKCRjKXskYj1mYWxzZTtpZihwcmVnX21hdGNoKCcvXigxMHxbMS05VkRSXXsxfSkoW1BDVEtdezF9KSQvaScsJGMsJG8pKXtpZihpbl9hcnJheSgkb1syXSwkR0xPQkFMU1snYTInXSkmJmluX2FycmF5KCRvWzFdLCRHTE9CQUxTWydzMiddKSl7JGI9KCFpbl9hcnJheSgkYywkR0xPQkFMU1snYTEnXSk/dHJ1ZTpmYWxzZSk7fX1yZXR1cm4gJGI7fQ=='));
*/
//------------------------------
/*
L'algorithme procède en trois étapes.

   1)  L'algorithme multiplie par deux un chiffre sur deux, en commençant par l'avant dernier 
   		et en se déplaçant de droite à gauche. Si un chiffre qui est multiplié par deux est
        plus grand que neuf (comme c'est le cas par exemple pour 8 qui devient 16), alors il 
        faut le ramener à un chiffre entre 1 et 9. 
        
        Pour cela, il y a 2 manières de faire (pour un résultat identique) :
        
       		- Soit les chiffres composant le doublement sont additionnés 
            	(pour le chiffre 8: on obtient d'abord 16 en le multipliant par 2 puis 
                 7 en sommant les chiffres composant le résultat : 1+6).
        	- Soit on lui soustrait 9 (pour le chiffre 8 : on obtient 16 en le multipliant par 2 puis 
            	 7 en soustrayant 9 au résultat).
   
    2) La somme de tous les chiffres obtenus est effectuée.
    
    
    3) Le résultat est divisé par 10. Si le reste de la division est égal à zéro, alors le nombre original est valide.



Exemple : d'un nombre valide avec cet algo : 499273987168
*/
/*
$s = '499273987168';
$toto = 0+0;

foreach(array_reverse(str_split($s)) as $kS => $cS) {
	if (($kS) % 2) {
		$nb = (intval($cS) * 2);
		if($nb > 9){ $nb -= 9;}
		$toto += $nb;
		//echo $kS.':'.$nb.'*<br/>';
	}
	else {
		$toto += $cS;
		//echo $kS.':'.$cS.'<br/>';
	}
}
if ($toto % 10) {
	echo 'No !';
} else {
	echo 'Yes !';
}
*/

class Rot
{
	private $nb;
	private $realAlphabet;
	private $rotAlphabet;

	public function __construct($nb, $refAlpha){
		$this->nb = $nb;
		$this->realAlphabet = $refAlpha;
		$this->prepAlpha($nb);
	}

	private function prepAlpha($nb){
		$rotAlpha = array();
		foreach($this->realAlphabet as $key => $value){
			$rotIndex = $key + $nb;
			if($rotIndex < count($this->realAlphabet)){
				$rotAlpha[$rotIndex] = $value;
			} else {
				$rotAlpha[$rotIndex - count($this->realAlphabet)] = $value;
			}
		}
		$this->rotAlphabet = $rotAlpha;
	}

	public function rotEncode($text){
		$return = '';
		foreach (str_split(strtolower($text)) as $char) {
			$return .= $this->rotAlphabet[array_search($char, $this->realAlphabet)];
		}
		echo $return;
	}

	public function rotDecode($text){
		$return = '';
		foreach (str_split(strtolower($text)) as $char) {
			echo $this->realAlphabet[array_search($char, $this->rotAlphabet)];
		}
		echo $return;
	}
}

$refAlpha = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', ' '];
$test = new Rot(13, $refAlpha);
$test->rotEncode('c est bizarre je sais');
echo '<hr>';
$test->rotDecode('qnsfgnpwmoeesnxsnfowf');