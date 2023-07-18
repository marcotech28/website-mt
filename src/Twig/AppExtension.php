<?php

namespace App\Twig;

use App\Form\SearchForm;
use Symfony\Component\Form\FormFactoryInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    private $formFactory;

    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('search_form', [$this, 'createSearchForm'], ['is_safe' => ['html']]),
        ];
    }

    public function createSearchForm()
    {
        $form = $this->formFactory->create(SearchForm::class);

        return $form->createView();
    }
}
