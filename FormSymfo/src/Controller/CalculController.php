<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculController extends AbstractController
{
    
    /**
     * @Route( "/calcul", name="calcul")
     */
    public function indexAction()
    {
        //var_dump(func_get_args());

    return new Response('<form method="POST" action="/calcul_result" >
        <label for="nb1">Nb 1</label>
        <input type="text" id="nb1" name="nb1">
        <label for="ope">opérateur</label>
        <select id="ope" name="ope">
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="/">/</option>
            <option value="*">*</option>
        </select>
        <label for="nb2">Nb 2</label>
        <input type="text" id="nb2" name="nb2">
        <input type="submit" value="Valider">
    </form>');
/*
        return $this->render('front/calcul.html.twig', [
            'message' => 'Yes we can'
        ]);*/
    }
    
    /**
     * @Route( "/calcul_result", name="calcul_result")
     */
    public function calculAction(Request $request)
    {
        //var_dump(func_get_args());
        //$nb1, $ope, $nb2
        $nb1 = intval($request->request->get('nb1'));
        $ope = $request->request->get('ope');
        $nb2 = intval($request->request->get('nb2'));

        $result = null;

        switch ($ope) {
            case '+':
                $result = ($nb1 + $nb2);
                break;
            case '-':
                $result = ($nb1 - $nb2);
                break;
            case '*':
                $result = ($nb1 * $nb2);
                break;
            case '/':
                $result = ($nb1 / $nb2);
                break;
            
            default:
                # code...
                break;
        }

        return new Response($result);
        /*return $this->render('front/calcul_result.html.twig', [
            'message' => 'Yes we can'
        ]);*/
    }
}

