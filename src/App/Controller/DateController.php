<?php

namespace App\Controller;

use App\Form\DaysLongType;
use App\Helper\DatetimeHelper;
use Domain\Date\DateManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class DateController extends AbstractController
{
    /**
     * @Route("/date", name="app_date")
     */
    public function index(Request $request): Response
    {
        $form = $this->createForm(DaysLongType::class);
        $form->handleRequest($request);
        $submitted = false;
        $timezone = false;
        $dateManager = new DateManager(date('Y-m-d'), date_default_timezone_get());

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $submitted = true;

            $dateManager = new DateManager($data['date'], $data['timezone']);
            $timezone = $data['timezone'];
        }

        return $this->renderForm('date/index.html.twig', [
            'controller_name' => 'DateController',
            'form' => $form,
            'submitted' => $submitted,
            'februaryInYear' => $dateManager->daysLongOfFebruary(),
            'timezone' => $timezone,
            'minsToUtc' => $dateManager->minsToUtc(),
            'givenMonthName' => $dateManager->monthName(),
            'daysInGivenMonth' => $dateManager->daysInMonth()
        ]);
    }
}
