<?php

namespace App\Http\Controllers;

use App\Sistema;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class NewsletterController
 * @package App\Http\Controllers
 */
class NewsletterController extends Controller
{
    /**
     * Este método obtém toda a informação necessária para, dinamicamente, gerar a newsletter a ser apresentada.
     * @param Sistema $sistema
     * @return Application|Factory|View
     */
    public function setup(Sistema $sistema)
    {
        $handler = $sistema->getNewsletterHandler();
        $epoca = $handler->getCurrentEpoca();
        $sugestoes = $epoca->sugestoes;
        $promocoes = $handler->getCurrentPromocoes();

        return view('newsletter.newsletter',compact(['epoca', 'sugestoes', 'promocoes']));
    }
}
