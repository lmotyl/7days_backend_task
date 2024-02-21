<?php

namespace App\Controller;

use App\Form\DaysLongType;
use App\Helper\DatetimeHelper;
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
        $minsToUtc = false;
        $februaryInYear = false;
        $givenMonthName = false;
        $daysInGivenMonth = false;
        $timezone = false;

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $submitted = true;
            $time = strtotime($data['date']);
            $timezone = $data['timezone'];
            $calculateDate = new \DateTime();
            $calculateDate->setTimestamp($time);

            $timezoneDate = new \DateTimeZone($data['timezone']);
            $calculateDate->setTimezone($timezoneDate);
            $februaryInYear = DatetimeHelper::getDaysInMonth((int) $calculateDate->format('Y'), 2);
            $minsToUtc = DatetimeHelper::getMinutesOffsetUTC($calculateDate);
            $givenMonthName = $calculateDate->format('F');
            $daysInGivenMonth = DatetimeHelper::getDaysInMonth(
                (int)$calculateDate->format('Y'),
                (int)$calculateDate->format('m')
            );
        }

        return $this->renderForm('date/index.html.twig', [
            'controller_name' => 'DateController',
            'form' => $form,
            'submitted' => $submitted,
            'februaryInYear' => $februaryInYear,
            'timezone' => $timezone,
            'minsToUtc' => $minsToUtc,
            'givenMonthName' => $givenMonthName,
            'daysInGivenMonth' => $daysInGivenMonth
        ]);
    }
}
