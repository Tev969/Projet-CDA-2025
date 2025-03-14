<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CoachController extends AbstractController{
    #[Route('/coach', name: 'app_coach')]
    public function index( #[Autowire('%env(STRIPE_API_KEY)%')] string $stripeApiKey , Request $request ) : Response
    {
        $stripe = new \Stripe\StripeClient($stripeApiKey);
        $host = $request -> getSchemeAndHttpHost();
        $session = $stripe->checkout->sessions->create([
          'customer_email' => $this->getUser()->getUserIdentifier(),
          'success_url' => $host . '/coach/success?session_id={CHECKOUT_SESSION_ID}',
          'cancel_url' => $host . '/coach/cancel?session_id={CHECKOUT_SESSION_ID}',
          'line_items' => [
            [
              'price' => 'price_1QsPfJCky60V9v1dSR3z9Gna',
              'quantity' => 1,
            ],
          ],
          'mode' => 'payment',
        ]);

        return $this->redirect($session->url);
    }
    
    #[Route('/coach/success', name: 'app_coach_success')]
    public function success(
        Request $request, 
        #[Autowire('%env(STRIPE_API_KEY)%')] string $stripeApiKey , 
        EntityManagerInterface $entityManager , 
        UserRepository $userRepository
    ): Response
    {
        $sessionId = $request->query->get('session_id');
        $stripe = new \Stripe\StripeClient($stripeApiKey);
        $session = $stripe->checkout->sessions->retrieve($sessionId); 
        
        if ($session->payment_status === 'paid') {
            if ($this->getUser()?->getUserIdentifier() === null) {
                throw new \Exception('User not found');
            }

            $user = $userRepository->findOneBy(['email' => $this->getUser()->getUserIdentifier()]);
            $user->setRoles(['ROLE_COACH']);
            $entityManager->persist($user);
            $entityManager->flush();
        }
        return $this->render('coach/success.html.twig', [
            'session' => $session
        ]);
    }
    #[Route('/coach/cancel', name: 'app_coach_cancel')]
    public function cancel(Request $request, #[Autowire('%env(STRIPE_API_KEY)%')] string $stripeApiKey): Response
    {
        $sessionId = $request->query->get('session_id');
        $stripe = new \Stripe\StripeClient($stripeApiKey);
        $session = $stripe->checkout->sessions->retrieve($sessionId);
        return $this->render('coach/cancel.html.twig', [
            'session' => $session
        ]);
    }
}